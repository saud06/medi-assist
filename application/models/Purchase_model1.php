<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase_model extends CI_Model
{
	public function index(){
		
	} 
	/* 
		return all purchase details to display list 
	*/
	public function getPurchase(){
		$this->db->select('purchases.*,suppliers.*')
				 ->from('purchases')
				 ->join('suppliers','purchases.supplier_id = suppliers.supplier_id');
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
		$query = $this->db->query("SELECT * FROM purchases ORDER BY purchase_id DESC LIMIT 1");
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
	/* 
		add new purchase record in database 
	*/
	public function addModel($data){
		$sql = "insert into purchases (date,reference_no,supplier_id,warehouse_id,total,note,user) values(?,?,?,?,?,?,?)";
		if($this->db->query($sql,$data)){
		/*if($this->db->insert('purchases',$data)){*/
			return $insert_id = $this->db->insert_id(); 
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
			  $pquantity = $quantity + $pvalue->quantity;
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
				$wquantity = $quantity + $value->quantity;
				$sql = "update warehouses_products set quantity = ? where product_id = ? AND warehouse_id = ?";
				$this->db->query($sql,array($wquantity,$product_id,$warehouse_id));
				$this->updateProductQuantity($product_id,$quantity);
			}
			
		}
		else{
			$sql = "insert into warehouses_products (product_id,warehouse_id,quantity) values (?,?,?)";
			$this->db->query($sql,$warehouse_data);
			$this->updateProductQuantity($product_id,$quantity);
		}

	}
	/*  
		add newly purchse items record in database 
	*/
	public function addPurchaseItem($data){
		$sql = "insert into purchase_items (product_id,quantity,gross_total,purchase_id) values (?,?,?,?)";
		if($this->db->query($sql,$data)){
		/*if($this->db->insert('purchase_items',$data)){*/
			return true;
		}
		else{
			return false;
		}
	}
	/* 
		add or update purchase items in database 
	*/
	public function addUpdatePurchaseItem($purchase_id,$product_id,$warehouse_id,$quantity,$data,$warehouse_data){
		$sql = "select * from purchase_items where purchase_id = ? AND product_id = ?";
		$result = $this->db->query($sql,array($purchase_id,$product_id));
		
		if($result->num_rows()>0){
			$purchase_quantity = $result->row()->quantity;
			$where = "purchase_id = $purchase_id AND product_id = $product_id";
			$this->db->where($where);
			$this->db->update('purchase_items',$data);
			$sql = "select * from warehouses_products where warehouse_id = ? AND product_id = ?";
			$warehouse_quantity = $this->db->query($sql,array($warehouse_id,$product_id))->row()->quantity;
			
			$new_quantity = $warehouse_quantity + $quantity - $purchase_quantity;
			$sql = "update warehouses_products set quantity = ? where warehouse_id = ? AND product_id = ?";
			$this->db->query($sql,array($new_quantity,$warehouse_id,$product_id));
			

			$sql = "select * from products where product_id = ?";
			$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;
			
			$new_quantity = $product_quantity + $quantity - $purchase_quantity;
			$sql = "update products set quantity = ? where product_id = ?";
			$this->db->query($sql,array($new_quantity,$product_id));
			
		}
		else{
			$this->addProductInWarehouse($product_id,$quantity,$warehouse_id,$warehouse_data);
			$this->addPurchaseItem($data);
		}

	}
	/*
		return products details
	*/
	public function getProduct(){
		return $this->db->get('products')->result();
	}
	/* 
		return  product code or name it use to purchase table in web page 
	*/
	public function getProductAjax($id){
		$sql = "select * from products where product_id = ?";
		$data = $this->db->query($sql,array($id));
		return $data->result();
	}
	/* 
		return purchase record to edit 
	*/
	public function getRecord($id){
		$sql = "select * from purchases where purchase_id = ?";
		if($query = $this->db->query($sql,array($id))){
		
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return purchase items to purchase 
	*/
	public function getPurchaseItems($purchase_id,$warehouse_id){
		$this->db->select('purchase_items.*,warehouses_products.quantity as warehouses_quantity,products.product_id,code,name,unit,price,cost')
				 ->from('purchase_items')
				 ->join('products','purchase_items.product_id = products.product_id')
				 ->join('warehouses_products','warehouses_products.product_id = products.product_id')
				 ->where('warehouses_products.warehouse_id',$warehouse_id)
				 ->where('purchase_items.purchase_id',$purchase_id);
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
		$data['purchase_id'] = $id;
		$sql = "update purchases set date = ?,reference_no = ?,supplier_id = ?,warehouse_id = ?,total = ?,note = ?,user = ? where purchase_id = ?";
		if($this->db->query($sql,$data)){
			return true;
		}
		else{
			return false;
		}
	}
	/* 
		delete purchase record in database 
	*/
	public function deleteModel($id){
		$sql = "delete from purchases where purchase_id = ?";
		if($this->db->query($sql,array($id))){
			$sql = "delete from purchase_items where purchase_id = ?";
			if($this->db->query($sql,array($id))){
				return TRUE;
			}
			
		}
		else{
			return FALSE;
		}
	}
	/* 
		delete old purchase item when edit purchse  
	*/
	public function deletePurchaseItems($purchase_id,$product_id,$warehouse_id){

		$sql = "select * from purchase_items where purchase_id = ? AND product_id = ?";
		$delete_quantity = $this->db->query($sql,array($purchase_id,$product_id))->row()->quantity;
		
		$sql = "select * from warehouses_products where warehouse_id = ? AND product_id = ?";
		$warehouse_quantity = $this->db->query($sql,array($warehouse_id,$product_id))->row()->quantity;
	
		$wquantity = $warehouse_quantity - $delete_quantity;
		$sql = "update warehouses_products set quantity = ? where warehouse_id = ? AND product_id = ?";
		$this->db->query($sql,array($wquantity,$warehouse_id,$product_id));
		
		$sql = "select * from products where product_id = ?";
		$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;
	
		$pquantity = $product_quantity - $delete_quantity;
		$sql = "update products set quantity = ? where product_id = ?";
		$this->db->query($sql,array($pquantity,$product_id));
		
		$sql = "delete from purchase_items where purchase_id = ? AND product_id = ?";
		if($this->db->query($sql,array($purchase_id,$product_id))){
			return true;
		}
		else{
			return false;
		}
	}
	/*
		return purchase details
	*/
	public function getDetails($id){
		return $this->db->select('p.*,
								  w.warehouse_name,
								  b.city as branch_city,
								  b.address as branch_address,
								  s.supplier_name,
								  s.address as supplier_address,
								  ct.name as supplier_city,
								  s.mobile as supplier_mobile,
								  s.email as supplier_email,
								  u.first_name,u.last_name'
								)
						 ->from('purchases p')
						 ->join('warehouse w','p.warehouse_id = w.warehouse_id')
						 ->join('branch b','w.branch_id = b.branch_id')
						 ->join('suppliers s','p.supplier_id = s.supplier_id')
						 ->join('cities ct','s.city_id = ct.id')
						 ->join('users u','p.user = u.id')
						 ->where('purchase_id',$id)
						 ->get()
						 ->result();
	}
	/*
		return company setting details
	*/
	public function getCompany(){
		return $this->db->select('cs.*,c.name as city_name,s.name as state_name,co.name as country_name')
		                ->from('company_settings cs')
		                ->join('cities c','cs.city_id = c.id')
		                ->join('states s','cs.country_id = s.id')
		                ->join('countries co','cs.country_id = co.id')
					    ->get()
					    ->result();
	}
	/*		
		return purchase items details
	*/
	public function getItems($id){
		return $this->db->select('pi.quantity,pi.gross_total,pr.name,pr.cost,t.tax_value,p.total')
						 ->from('purchase_items pi')
						 ->join('purchases p','pi.purchase_id = p.purchase_id')
						 ->join('products pr','pi.product_id = pr.product_id')
						 ->join('tax t','pr.tax_id = t.tax_id')
						 ->where('pi.purchase_id',$id)
						 ->get()
						 ->result();
	}
	/*
		return supplier details
	*/
	public function getSupplierEmail($id){

		return $this->db->select('*')
						 ->from('purchases p')
						 ->join('suppliers s','p.supplier_id = s.supplier_id')
						 ->where('p.purchase_id',$id)
						 ->get()
						 ->result();
	}
}
?>