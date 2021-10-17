<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sales_return_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	/* 
		return all sales return details to display list 
	*/
	public function getSales(){
		$this->db->select('sales_return.*,biller.*,client.*')
		         ->from('sales_return')
		         ->join('biller','sales_return.biller_id=biller.biller_id')
		         ->join('client','sales_return.client_id=client.client_id');
		return $this->db->get()->result();
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
		return warehouse details available in warehouse products 
	*/
	public function getWarehouseProducts(){
		$this->db->select('warehouse.warehouse_id,warehouses_products.product_id,quantity')
		         ->from('warehouse')
		         ->join('warehouses_products','warehouse.warehouse_id = warehouses_products.warehouse_id');
		return $this->db->get()->result();
	}
	/* 
		return biller detail use drop down 
	*/
	public function getBiller(){
		return $this->db->get('biller')->result();
	}
	/* 
		return client detail use drop down 
	*/
	public function getClient(){
		return $this->db->get('client')->result();
	}
	/* 
		return discount detail use drop down 
	*/
	public function getDiscount(){
		return $this->db->get('discount')->result();
	}
	/* 
		return tax detail use dynamic table
	*/
	public function getTax(){
		return $this->db->get_where('tax',array('delete_status'=>0))->result();
	}
	/* 
		return last purchase id 
	*/
	public function createReferenceNo(){
		$query = $this->db->query("SELECT * FROM sales_return ORDER BY id DESC LIMIT 1");
		$result = $query->result();
		return $result;
	}
	/* 
		return sales return record 
	*/
	public function getRecord($data){
		$this->db->where('id',$data);
		if($query = $this->db->get('sales_return')){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		add new sales return record in database 
	*/
	public function add($data){

		$sql = "insert into sales_return (date,reference_no,warehouse_id,client_id,discount_id,biller_id,total,discount_value,tax_value,note,internal_note,user) values(?,?,?,?,?,?,?,?,?,?,?,?)";
		if($this->db->query($sql,$data)){
			return $insert_id = $this->db->insert_id(); 
		}
		else{
			return FALSE;
		}
	}
	/* 
		return discount detail use drop down when discount change
	*/
	public function getDiscountAjax($id){
		$sql = "select * from discount where discount_id = ?";
		return $this->db->query($sql,array($id))->result();
	}
	/* 
		check product available in sales or not
	*/
	public function checkProductInSalesReturn($sale_return_id,$product_id){
		$sql = "select * from sale_return_items where sale_return_id = ? AND product_id = ?";
		if($quantity = $this->db->query($sql,array($sale_return_id,$product_id))->num_rows() > 0){

			$sql = "select * from sale_return_items where sale_return_id = ? AND product_id = ?";
			$quantity = $this->db->query($sql,array($sale_return_id,$product_id));
			return $quantity->row()->quantity;
		}
		else{
			return false;
		}
		
	}
	/* 
		update quantity in product table 
	*/
	public function updateQuantity($sale_return_id,$product_id,$warehouse_id,$quantity,$old_quantity,$data){
		/*$sql = "update sale_return_items set quantity = ? where sale_return_id = ? AND product_id = ?";
		$this->db->query($sql,array($quantity,$sale_return_id,$product_id));*/

		$where = "sale_return_id = $sale_return_id AND product_id = $product_id";
		$this->db->where($where);
		$this->db->update('sale_return_items',$data);
		
		$sql = "select * from warehouses_products where warehouse_id = ? AND product_id = ?";
		$warehouse_quantity = $this->db->query($sql,array($warehouse_id,$product_id))->row()->quantity;
		
		$wquantity = $warehouse_quantity + $quantity - $old_quantity;
		$sql = "update warehouses_products set quantity = ? where warehouse_id = ? AND product_id = ?";
		$this->db->query($sql,array($wquantity,$warehouse_id,$product_id));

		$sql = "select * from products where product_id = ?";
		$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;
		
		$pquantity = $product_quantity + $quantity - $old_quantity;
		$sql = "update products set quantity = ? where product_id = ?";
		$this->db->query($sql,array($pquantity,$product_id));
		
	}
	/* 
		check product available in warehouse or not 
	*/
	public function checkProductInWarehouse($product_id,$quantity,$warehouse_id){
		$sql = "select * from warehouses_products where product_id = ? AND warehouse_id = ?";
		$query = $this->db->query($sql,array($product_id,$warehouse_id));
		
		if($query->num_rows()>0){
			echo $warehouse_quantity = $query->row()->quantity;
			if($warehouse_quantity >= $quantity){
				echo $wquantity = $warehouse_quantity + $quantity;
				$sql = "update warehouses_products set quantity = ? where product_id = ? AND warehouse_id = ?";
				$this->db->query($sql,array($wquantity,$product_id,$warehouse_id));
				
				$sql = "select * from products where product_id = ?";
				$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;
				$pquantity = $product_quantity + $quantity ;	
				$sql = "update products set quantity = ? where product_id = ?";
				$this->db->query($sql,array($pquantity,$product_id));

			  	if($this->db->insert('sale_return_items',$data)){
					return true;
				}
				else{
					return false;
				}

			  	return true;
			}
		}
	}
	/*  
		add newly sales return items record in database 
	*/
	public function addSalesReturnItem($data,$product_id,$warehouse_id,$quantity){
		$sql = "select * from warehouses_products where warehouse_id = ? AND product_id = ?";
		$warehouse_quantity = $this->db->query($sql,array($warehouse_id,$product_id))->row()->quantity;
		
		$wquantity = $warehouse_quantity + $quantity;
		$sql = "update warehouses_products set quantity = ? where warehouse_id = ? AND product_id = ?";
		$this->db->query($sql,array($wquantity,$warehouse_id,$product_id));
		
		$sql = "select * from products where product_id = ?";
		$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;
		
		$pquantity = $product_quantity + $quantity ;	
		$sql = "update products set quantity = ? where product_id = ?";
		$this->db->query($sql,array($pquantity,$product_id));

	  	//$sql = "insert into sale_return_items (product_id,quantity,price,gross_total,discount_id,discount_value,discount,tax_id,tax_value,tax,sale_return_id) values (?,?,?,?,?,?,?,?,?,?,?)";
		if($this->db->insert('sale_return_items',$data)){
			return true;
		}
		else{
			return false;
		}
	}
	/* 
		return sales return item data when edited 
	*/
	public function getSalesReturnItems($sales_return_id,$warehouse_id){
		$this->db->select('si.*,wp.quantity as warehouses_quantity,pr.product_id,pr.code,pr.name,pr.unit,pr.price,pr.cost,pr.hsn_sac_code')
				 ->from('sale_return_items si')
				 ->join('products pr','si.product_id = pr.product_id')
				 ->join('warehouses_products wp','wp.product_id = pr.product_id')
				 ->where('si.sale_return_id',$sales_return_id)
				 ->where('wp.warehouse_id',$warehouse_id);
		if($query = $this->db->get()){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return  single product to add dynamic table 
	*/
	public function getProduct($product_id,$warehouse_id){
		return $this->db->select('p.product_id,code,unit,name,size,cost,price,alert_quantity,image,category_id,subcategory_id,wp.quantity,warehouse_id')
			 ->from('products p')
			 ->join('warehouses_products wp','p.product_id = wp.product_id')
			 ->where('wp.warehouse_id',$warehouse_id)
			 ->where('wp.product_id',$product_id)
		     ->get()
		     ->result();
	}
	/* 
		return  product list to add product 
	*/
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
		save edited record in database 
	*/
	public function edit($id,$data){
		$data['id'] = $id;
		$sql = "update sales_return set date = ?,reference_no = ?,warehouse_id = ?,client_id = ?,discount_id = ?,biller_id = ?,total = ?,discount_value = ?,tax_value = ?,note = ?,internal_note = ?,user = ? where id = ?";
		if($this->db->query($sql,$data)){
			return true;
		}
		else{
			return false;
		}
	}
	/* 
		delete old purchase item when edit purchse  
	*/
	public function deleteSalesReturnItems($sale_return_id,$product_id,$warehouse_id,$old_warehouse_id){
		
		$sql = "select * from sale_return_items where sale_return_id = ? AND product_id = ?";
		$delete_quantity = $this->db->query($sql,array($sale_return_id,$product_id))->row()->quantity;

		$sql = "select * from warehouses_products where warehouse_id = ? AND product_id = ?";
		$warehouse_quantity = $this->db->query($sql,array($warehouse_id,$product_id))->row()->quantity;

		$wquantity = $warehouse_quantity + $delete_quantity;
		$sql = "update warehouses_products set quantity = ? where warehouse_id = ? AND product_id = ?";
		$this->db->query($sql,array($wquantity,$warehouse_id,$product_id));

		$sql = "select * from products where product_id = ?";
		$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;

		$pquantity = $product_quantity + $delete_quantity;
		$sql = "update products set quantity = ? where product_id = ?";
		$this->db->query($sql,array($pquantity,$product_id));
		
		$sql = "delete from sale_return_items where sale_return_id = ? AND product_id = ?";
		if($this->db->query($sql,array($sale_return_id,$product_id))){
			return true;
		}
		else{
			return false;
		}
	}
	/* 
		when warehouse change selected items is delete this function  
	*/
	public function changeWarehouseDeleteSalesReturnItems($sale_return_id,$product_id,$warehouse_id,$old_warehouse_id){

		$sql = "select * from sale_return_items where sale_return_id = ? AND product_id = ?";
		$delete_quantity = $this->db->query($sql,array($sale_return_id,$product_id))->row()->quantity;

		$sql = "select * from warehouses_products where warehouse_id = ? AND product_id = ?";
		$warehouse_quantity = $this->db->query($sql,array($old_warehouse_id,$product_id))->row()->quantity;

		$wquantity = $warehouse_quantity + $delete_quantity;
		$sql = "update warehouses_products set quantity = ? where warehouse_id = ? AND product_id = ?";
		$this->db->query($sql,array($wquantity,$old_warehouse_id,$product_id));

		$sql = "select * from products where product_id = ?";
		$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;

		$pquantity = $product_quantity + $delete_quantity;
		$sql = "update products set quantity = ? where product_id = ?";
		$this->db->query($sql,array($pquantity,$product_id));
		
		$sql = "delete from sale_return_items where sale_return_id = ? AND product_id = ?";
		if($this->db->query($sql,array($sale_return_id,$product_id))){
			return true;
		}
		else{
			return false;
		}
	}
	/* 
		delete sales return  record in database 
	*/
	public function delete($id){
		$sql = "delete from sales_return where id = ?";
		if($this->db->query($sql,array($id))){
			$sql = "delete from sale_return_items where sale_return_id = ?";
			if($this->db->query($sql,array($id))){
				return TRUE;
			}
			
		}
		else{
			return FALSE;
		}
	}
}
?>