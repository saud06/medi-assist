<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase_return_model extends CI_Model
{
	public function index(){
		
	} 
	/* 
		return all purchase return details to display list 
	*/
	public function getPurchaseReturn(){
		$this->db->select('purchase_return.*,suppliers.*')
				 ->from('purchase_return')
				 ->join('suppliers','purchase_return.supplier_id = suppliers.supplier_id');
		$data = $this->db->get();
		log_message('debug', print_r($data, true));
		return $data->result();
	}
	/* 
		return warehouse detail use drop down 
	*/
	public function getWarehouse(){
		if($this->session->userdata('type') == "admin"){
			return $this->db->get('warehouse')->result();
		}
		else{
			$this->db->select('w.*')
					 ->from('warehouse w')
					 ->join('warehouse_management wm','wm.warehouse_id = w.warehouse_id')
					 ->where('wm.user_id',$this->session->userdata('user_id'));
			return $this->db->get()->result();
		}
	}
	/* 
		return supplier detail use drop down 
	*/
	public function getSupplier(){
		return $this->db->get('suppliers')->result();
	}
	/* 
		return last purchase id 
	*/
	public function createReferenceNo(){
		$query = $this->db->query("SELECT * FROM purchase_return ORDER BY id DESC LIMIT 1");
		$result = $query->result();
		return $result;
	}
	/* 
		return supplier name whose id get 
	*/
	public function getSupplierName($id){
		$sql = "select supplier_name from suppliers where supplier_id = ?";
		return $this->db->query($sql,array($id))->result();
	}
	/* add new purchase return record in database */
	public function addModel($data){
		$sql = "insert into purchase_return (date,reference_no,supplier_id,warehouse_id,total,discount_value,tax_value,note,user) values(?,?,?,?,?,?,?,?,?)";
		if($this->db->query($sql,$data)){
			return $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* 
		update quantity in product table 
	*/
	public function updateProductQuantity($product_id,$quantity){
		$sql = "select * from products where product_id = ?";
		$product_data = $this->db->query($sql,array($product_id));
		
		if($product_data->num_rows()>0){
			$p_data = $product_data->result();
			foreach ($p_data as $pvalue) {
			  $pquantity = $pvalue->quantity - $quantity;	
			  $sql = "update products set quantity = ? where product_id = ?";
			  $this->db->query($sql,array($pquantity,$product_id));	
			  
			} 
		}
	}
	/* 
		add new record or update quantity in warehouse_products table 
	*/
	public function addProductInWarehouse($product_id,$quantity,$warehouse_id,$warehouse_data){
		$sql = "select * from warehouses_products where product_id = ? AND warehouse_id = ?";
		$query = $this->db->query($sql,array($product_id,$warehouse_id));
		
		if($query->num_rows()>0){
			$result = $query->result();
			foreach ($result as  $value) {
				$wquantity = $value->quantity - $quantity;
				$sql = "update warehouses_products set quantity = ? where product_id = ? AND warehouse_id = ?";
				$this->db->query($sql,array($wquantity,$product_id,$warehouse_id));
				$this->updateProductQuantity($product_id,$quantity);
			}
			
		}
	}
	/*  
		add newly purchse items record in database 
	*/
	public function addPurchaseItem($data){
		if($this->db->insert('purchase_return_items',$data)){
			return true;
		}
		else{
			return false;
		}
	}
	/* 
		add or update purchase items in database 
	*/
	public function addUpdatePurchaseItem($id,$product_id,$warehouse_id,$quantity,$data,$warehouse_data){
		$sql = "select * from purchase_return_items where purchase_return_id = ? AND product_id = ?";
		$result = $this->db->query($sql,array($id,$product_id));
		$where = "purchase_return_id = $id AND product_id = $product_id";
		
		if($result->num_rows()>0){

			$purchase_quantity = $result->row()->quantity;
			$this->db->where($where);
			$this->db->update('purchase_return_items',$data);

			$sql = "select * from warehouses_products where warehouse_id = ? AND product_id = ?";
			$warehouse_quantity = $this->db->query($sql,array($warehouse_id,$product_id))->row()->quantity;
			
			$new_quantity = $warehouse_quantity - $quantity + $purchase_quantity;
			$sql = "update warehouses_products set quantity = ? where warehouse_id = ? AND product_id = ?";
			$this->db->query($sql,array($new_quantity,$warehouse_id,$product_id));

			$sql = "select * from products where product_id = ?";
			$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;
		
			$new_quantity = $product_quantity - $quantity + $purchase_quantity;
			$sql = "update products set quantity = ? where product_id = ?";
			$this->db->query($sql,array($new_quantity,$product_id));
	
		}
		else{
			$this->addProductInWarehouse($product_id,$quantity,$warehouse_id,$warehouse_data);
			$this->addPurchaseItem($data);
		}

	}
	/* 
		return  single product to add dynamic table 
	*/
	public function getProduct($product_id,$warehouse_id){
		return $this->db->select('p.*,wp.quantity,wp.warehouse_id')
			 ->from('products p')
			 ->join('warehouses_products wp','p.product_id = wp.product_id')
			 ->where('wp.warehouse_id',$warehouse_id)
			 ->where('wp.product_id',$product_id)
		     ->get()
		     ->result();
	}
	/* return  product list to add product dropdown */
	public function getProducts($warehouse_id){
		return  $this->db->select('p.*')
					 ->from('products p')
					 ->join('warehouses_products wp','p.product_id = wp.product_id')
					 ->where('wp.warehouse_id',$warehouse_id)
					 ->where('wp.quantity > 0')
					 ->get()
					 ->result();
	}
	/*  
		return purchase return record to edit 
	*/
	public function getRecord($id){
		$sql = "select * from purchase_return where id = ?";
		if($query = $this->db->query($sql,array($id))){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return purchase return items to purchase 
	*/
	public function getPurchaseReturnItems($id,$warehouse_id){
		$this->db->select('pi.*,wp.quantity as warehouses_quantity,pr.product_id,pr.code,pr.name,pr.unit,pr.price,pr.cost,pr.hsn_sac_code')
				 ->from('purchase_return_items pi')
				 ->join('products pr','pi.product_id = pr.product_id')
				 ->join('warehouses_products wp','wp.product_id = pr.product_id')
				 ->where('pi.purchase_return_id',$id)
				 ->where('wp.warehouse_id',$warehouse_id);
		if($query = $this->db->get()){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		save edited record in database 
	*/
	public function editModel($id,$data){
		$data['id'] = $id;


		$sql = "update purchase_return set date = ?,reference_no = ?,supplier_id = ?,warehouse_id = ?,total = ?,discount_value = ?,tax_value = ?,note = ?,user = ? where id = ?";
		if($this->db->query($sql,$data)){
			return true;
		}
		else{
			return false;
		}
	}
	/* 
		delete purchase return record in database 
	*/
	public function deleteModel($id){
		$sql = "delete from purchase_return where id = ?";
		if($this->db->query($sql,array($id))){
			$sql = "delete from purchase_return_items where purchase_return_id = ?";
			if($this->db->query($sql,array($id))){
				return TRUE;
			}
			
		}
		else{
			return FALSE;
		}
	}
	/* 
		delete old purchase return item when edit purchse  
	*/
	public function deletePurchaseReturnItems($id,$product_id,$warehouse_id){

		$where = "purchase_return_id = $id AND product_id = $product_id";
		$this->db->where($where);
		$delete_quantity = $this->db->get('purchase_return_items')->row()->quantity;
		
		$where = "warehouse_id = $warehouse_id AND product_id = $product_id";
		$this->db->where($where);
		$warehouse_quantity = $this->db->get('warehouses_products')->row()->quantity;
		$wquantity = $warehouse_quantity + $delete_quantity;
	
		$this->db->where($where);
		$this->db->update('warehouses_products',array("quantity"=>$wquantity));
		
		$this->db->where('product_id',$product_id);
		$product_quantity = $this->db->get('products')->row()->quantity;
		$pquantity = $product_quantity + $delete_quantity;
		
		$this->db->where('product_id',$product_id);
		$this->db->update('products',array("quantity"=>$pquantity));
		
		
		$where = "purchase_return_id = $id AND product_id = $product_id";
		$this->db->where($where);
		if($this->db->delete('purchase_return_items')){
			return true;
		}
		else{
			return false;
		}
	}
	/*
		return discount value
	*/
	public function getDiscountValue($id){
		return $this->db->get_where('discount',array('discount_id'=>$id))->result();
	}
	/*
		return discount value
	*/
	public function getTaxValue($id){
		return $this->db->get_where('tax',array('tax_id'=>$id))->result();
	}
}
?>