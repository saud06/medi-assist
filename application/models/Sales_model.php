<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sales_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	/* 
		return all sales details to display list 
	*/
	public function getSales(){
		$this->db->select('s.*,c.client_id,c.company_name,i.*')
		         ->from('sales s')
		         ->join('client c','s.client_id = c.client_id')
		         ->join('invoice i ','s.sales_id = i.sales_id');
		return $this->db->get()->result();
	}
	public function getFilteredSales($start_date, $end_date){
		$this->db->select('s.*,c.client_id,c.company_name,i.*')
				 ->from('sales s')
		         ->join('client c','s.client_id = c.client_id')
		         ->join('invoice i ','s.sales_id = i.sales_id')
				 ->where('s.date >=', $start_date)
				 ->where('s.date <=', $end_date);
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
		return warehouse details available in warehouse products 
	*/
	public function getWarehouseProducts(){
		$this->db->select('warehouse.warehouse_id,warehouses_products.product_id,quantity')
		         ->from('warehouse')
		         ->join('warehouses_products','warehouse.warehouse_id = warehouses_products.warehouse_id');
		return $this->db->get()->result();
	}
	/* 
		return user detail use drop down 
	*/
	public function getUsers(){
		$this->db->select('id,emp_id,first_name');
		$data =	$this->db->get('users');
		return $data->result();
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
		return $this->db->select('*')
			->from('client')
			->where('client_type_id',1)
			->get()
			->result();
	}
	/* 
		return courier detail use drop down 
	*/
	public function getCouriers(){
		return $this->db->get('courier')->result();
	}
	/* 
		return currency detail use drop down 
	*/
	public function getCurrency(){
		return $this->db->get('currency')->result();
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
		return shelf detail use dynamic table
	*/
	public function getShelf(){
		return $this->db->get_where('shelf',array('shelf_status'=>'active'))->result();
	}
	/* 
		return rack detail use dynamic table
	*/
	public function getRack(){
		return $this->db->get_where('rack',array('rack_status'=>'active'))->result();
	}
	/*
		generate invoive no
	*/
	public function generateInvoiceNo(){
		$query = $this->db->query("SELECT * FROM invoice ORDER BY id DESC LIMIT 1");
		$result = $query->result();
		if($result==null){
            $no = sprintf('%06d',intval(101));
        }
        else{
          foreach ($result as $value) {
            $no = sprintf('%06d',intval($value->id)+101); 
          }
        }
		return "WB-".$no;
	}
	/*	
		generate payment reference no
	*/
	public function generateReferenceNo(){
		$query = $this->db->query("SELECT * FROM payment ORDER BY id DESC LIMIT 1");
		$result = $query->result();
		return $result;
	}
	/* 
		return last purchase id 
	*/
	public function createReferenceNo(){
		$query = $this->db->query("SELECT * FROM sales ORDER BY sales_id DESC LIMIT 1");
		$result = $query->result();
		return $result;
	}
	/* 
		return sales record 
	*/
	public function getRecord($id){
		$sql = "select * from sales where sales_id = ?";
		if($query = $this->db->query($sql,array($id))){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		add new sales record in database 
	*/
	public function addModel($data,$invoice){
		/*$sql = "insert into sales (date,reference_no,warehouse_id,client_id,biller_id,total,discount_value,tax_value,note,shipping_city_id,shipping_state_id,shipping_country_id,shipping_address,shipping_charge,internal_note,user) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		if($this->db->query($sql,$data)){*/
		if($this->db->insert('sales',$data)){
			$insert_id = $this->db->insert_id(); 
			$invoice['sales_id'] = $insert_id;
			$this->db->insert('invoice',$invoice);
			return $insert_id;
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
	public function checkProductInSales($sales_id,$product_id){
		$sql = "select * from sales_items where sales_id = ? AND product_id = ?";
		if($quantity = $this->db->query($sql,array($sales_id,$product_id))->num_rows() > 0){

			$sql = "select * from sales_items where sales_id = ? AND product_id = ?";
			$quantity = $this->db->query($sql,array($sales_id,$product_id));
			return $quantity->row()->quantity;
		}
		else{
			return false;
		}
		
	}
	/* 
		update quantity in product table 
	*/
	public function updateQuantity($sales_id,$product_id,$warehouse_id,$quantity,$old_quantity,$data){
		/*$sql = "update sales_items set quantity=?,price =?,gross_total=?,discount=?,tax=? where sales_id = ? AND product_id = ?";
		$this->db->query($sql,array($quantity,$data['price'],$data['gross_total'],$data['discount'],$data['tax'],$sales_id,$product_id));*/
		$where = "sales_id = $sales_id AND product_id = $product_id";
		$this->db->where($where);
		$this->db->update('sales_items',$data);
		
		$sql = "select * from warehouses_products where warehouse_id = ? AND product_id = ?";
		$warehouse_quantity = $this->db->query($sql,array($warehouse_id,$product_id))->row()->quantity;
		
		$wquantity = $warehouse_quantity - $quantity + $old_quantity;
		$sql = "update warehouses_products set quantity = ? where warehouse_id = ? AND product_id = ?";
		$this->db->query($sql,array($wquantity,$warehouse_id,$product_id));
		

		$sql = "select * from products where product_id = ?";
		$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;
		
		$pquantity = $product_quantity - $quantity + $old_quantity;
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
			$warehouse_quantity = $query->row()->quantity;
			if($warehouse_quantity >= $quantity){
				$wquantity = $warehouse_quantity - $quantity;
				$sql = "update warehouses_products set quantity = ? where product_id = ? AND warehouse_id = ?";
				$this->db->query($sql,array($wquantity,$product_id,$warehouse_id));
				
				$sql = "select * from products where product_id = ?";
				$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;
				
				$pquantity = $product_quantity - $quantity ;	
				$sql = "update products set quantity = ? where product_id = ?";
				$this->db->query($sql,array($pquantity,$product_id));
			}
		}
	}
	/*  
		add newly sales items record in database 
	*/
	/*public function addSalesItem($data,$product_id,$warehouse_id,$quantity){
		$sql = "select * from warehouses_products where warehouse_id = ? AND product_id = ?";
		$warehouse_quantity = $this->db->query($sql,array($warehouse_id,$product_id))->row()->quantity;
		
		$wquantity = $warehouse_quantity - $quantity;
		$sql = "update warehouses_products set quantity = ? where warehouse_id = ? AND product_id = ?";
		$this->db->query($sql,array($wquantity,$warehouse_id,$product_id));
		
		$sql = "select * from products where product_id = ?";
		$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;
		
		$pquantity = $product_quantity - $quantity ;	
		$sql = "update products set quantity = ? where product_id = ?";
		$this->db->query($sql,array($pquantity,$product_id));

	  	$sql = "insert into sales_items (product_id,quantity,price,gross_total,discount_id,discount_value,discount,tax_id,tax_value,tax,sales_id) values (?,?,?,?,?,?,?,?,?,?,?)";
		if($this->db->query($sql,$data)){
			return true;
		}
		else{
			return false;
		}
	}*/

	/*  
		add newly sales items record in database 
	*/
	public function addSalesItem($data){
		$product_id = $data['product_id'];
		$gross_total = $data['gross_total'];
		$quantity = $data['quantity'];
		$cost = $gross_total/$quantity;
		if($cost == 0){
			$fop_status = 1;
		}
		else{
			$fop_status = 0;
		}

		$sql = "insert into sales_items(sales_id,product_id,shelf_id,rack_id,quantity,fop_status,cost,gross_total,sales_items_status,user_id,datetime) values (?,?,?,?,?,$fop_status,$cost,?,?,?,?)";
		if($this->db->query($sql,$data)){
		/*if($this->db->insert('purchase_items',$data)){*/
			return true;
		}
		else{
			return false;
		}
	}

	/*
		add items in inventory
	*/
	public function addUpdateInventory($inventory_data){
		$sql = "INSERT INTO inventory(purchase_id,sales_id,shelf_id,rack_id,product_id,cost,quantity,sales_qty,ck_out_qty,ck_in_qty,inventory_status,user_id,datetime) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
		if($this->db->query($sql,$inventory_data)){
			return true;
		}
		else{
			return false;
		}
	}
	/*
		update items in inventory
	*/
	public function updateInventory($inventory_data){
		$sales_id = $inventory_data['sales_id'];
		$product_id = $inventory_data['product_id'];

		$inv_sql = "SELECT * FROM inventory WHERE sales_id = ? AND product_id = ?";
		$result = $this->db->query($inv_sql,array($sales_id,$product_id));

		if($result->num_rows()>0){
			$sql = "UPDATE inventory SET purchase_id = ?, sales_id = ?, shelf_id = ?, rack_id = ?, product_id = ?, cost = ?, quantity = ?, inventory_status = ?, user_id = ?, datetime = ? where (sales_id = '$sales_id' and product_id = '$product_id')";
			if($this->db->query($sql,$inventory_data)){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			$sql = "INSERT INTO inventory(purchase_id,sales_id,shelf_id,rack_id,product_id,cost,quantity,sales_qty,ck_out_qty,ck_in_qty,inventory_status,user_id,datetime) VALUES (?,?,?,?,?,?,?,0,0,0,?,?,?)";
			if($this->db->query($sql,$inventory_data)){
				return true;
			}
			else{
				return false;
			}
		}
	}

	/* 
		add or update sales items in database 
	*/
	public function addUpdateSalesItem($sales_id,$product_id,$data){
		$sql = "select * from sales_items where sales_id = ? AND product_id = ?";
		$result = $this->db->query($sql,array($sales_id,$product_id));
		
		if($result->num_rows()>0){
			$where = "sales_id = $sales_id AND product_id = $product_id";
			$this->db->where($where);
			
			if($this->db->update('sales_items',$data)){
				return true;
			}

			else{
				return false;
			}
		}
		else{
			$sql2 = "insert into sales_items(sales_id,product_id,,shelf_id,rack_id,quantity,fop_status,cost,gross_total,purchase_items_status,user_id,datetime) values (?,?,?,?,?,?,?,?,?,?,?)";
			
			if($this->db->insert('sales_items',$data)){
				return true;
			}

			else{
				return false;
			}
		}
	}

	/* 
		return sales item data when edited 
	*/
	/*public function getSalesItems($sales_id,$warehouse_id){
		$this->db->select('si.*,wp.quantity as warehouses_quantity,p.product_id,p.code,p.name,p.unit,p.price,p.cost,p.hsn_sac_code')
				 ->from('sales_items si')
				 ->join('products p','si.product_id = p.product_id')
				 ->join('warehouses_products wp','wp.product_id = p.product_id')
				 ->where('si.sales_id',$sales_id)
				 ->where('wp.warehouse_id',$warehouse_id);
		if($query = $this->db->get()){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}*/

	public function getSalesItems($sales_id){
			$this->db->select('sales_items.*,products.product_id,products.code,products.name')
			->from('sales_items')
			->join('products','sales_items.product_id = products.product_id')
			->where('sales_items.sales_id',$sales_id);
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
	/*public function getProduct($product_id,$warehouse_id){
		return $this->db->select('p.product_id,p.code,p.hsn_sac_code,p.unit,p.name,p.size,p.cost,p.price,p.alert_quantity,p.image,p.category_id,p.subcategory_id,p.tax_id,wp.quantity,wp.warehouse_id,t.tax_value')
			 ->from('products p')
			 ->join('warehouses_products wp','p.product_id = wp.product_id')
			 ->join('tax t','p.tax_id = t.tax_id','left')
			 ->where('wp.warehouse_id',$warehouse_id)
			 ->where('wp.product_id',$product_id)
		     ->get()
		     ->result();
	}*/
	/*
		return products details
	*/
	public function getProduct(){		
		$query = $this->db->query("SELECT * FROM products WHERE is_inventory='1'");
		$result = $query->result();
		return $result;
	}
	/* 
		return  product code or name it use to purchase table in web page 
	*/
	public function getProductAjax($id){
		return $this->db->select('p.*, SUM(i.quantity) as pQuantity, SUM(i.ck_out_qty) as ckoQuantity, SUM(i.ck_in_qty) as ckiQuantity')
	                 ->from('products p')
	                 ->join('inventory i','p.product_id = i.product_id')
	                 ->where('p.product_id',$id)
	                 ->get()
	                 ->result();
	}
	/* 
		return  products available quantity it use to purchase table in web page 
	*/
		public function getAvailableQty($product_id, $shelf_id, $rack_id){
			$query = $this->db->query("SELECT SUM(quantity) AS available_qty FROM inventory WHERE product_id = '$product_id' AND shelf_id = '$shelf_id' AND rack_id = '$rack_id'");
			$result = $query->result();
			return $result;
		}
	/*
		return products details
	*/
	public function getProductList($id){
		return $this->db->select('p.product_id as id, p.name')
	                 ->from('products p')
	                 ->where('p.is_inventory',1)
	                 ->like('p.client_id', $id)
	                 ->get()
	                 ->result();
	}
	/* 
		save edited record in database 
	*/
	public function editModel($id,$data){
		/*$data['sales_id'] = $id;
		$sql = "update sales set date = ?,reference_no = ?,warehouse_id = ?,client_id = ?,biller_id = ?,total = ?,discount_value=?,tax_value=?,note = ?,shipping_city_id = ?,shipping_state_id= ?,shipping_country_id =?,shipping_address =?,shipping_charge =?,internal_note = ?,mode_of_transport=?,transporter_name=?,transporter_code=?,vehicle_regn_no=?,user = ? where sales_id = ?";
		if($this->db->query($sql,$data)){*/
		$this->db->where('sales_id',$id);
		if($this->db->update('sales',$data)){
			return true;
		}
		else{
			return false;
		}
	}
	/* 
		delete old purchase item when edit purchse  
	*/
	public function deleteSalesItems($sales_id,$product_id){
		/*$sql = "select * from sales_items where sales_id = ? AND product_id = ?";
		$delete_quantity = $this->db->query($sql,array($sales_id,$product_id))->row()->quantity;

		$sql = "select * from warehouses_products where warehouse_id = ? AND product_id = ?";
		$warehouse_quantity = $this->db->query($sql,array($warehouse_id,$product_id))->row()->quantity;
		
		$wquantity = $warehouse_quantity + $delete_quantity;
		$sql = "update warehouses_products set quantity = ? where warehouse_id = ? AND product_id = ?";
		$this->db->query($sql,array($wquantity,$warehouse_id,$product_id));
	

		$sql = "select * from products where product_id = ?";
		$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;
		
		$pquantity = $product_quantity + $delete_quantity;
		$sql = "update products set quantity = ? where product_id = ?";
		$this->db->query($sql,array($pquantity,$product_id));*/
		
		$sql = "DELETE FROM sales_items WHERE sales_id = ? AND product_id = ?";
		if($this->db->query($sql,array($sales_id,$product_id))){
			return true;
		}
		else{
			return false;
		}
	}

	public function updateInventoryQuantity($sales_id,$product_id){
		$sql = "SELECT * FROM sales_items WHERE sales_id = ? AND product_id = ?";
		$delete_quantity = $this->db->query($sql,array($sales_id,$product_id))->row()->quantity;

		$sql = "SELECT * FROM inventory WHERE sales_id = ? AND product_id = ?";
		$product_quantity = $this->db->query($sql,array($sales_id, $product_id))->row()->quantity;

		$pquantity = $product_quantity + $delete_quantity;
		$sql = "UPDATE inventory SET quantity = ? WHERE sales_id = ? AND product_id = ?";

		if($this->db->query($sql,array($pquantity,$sales_id,$product_id))){
			return true;
		}
		else{
			return false;
		}
	}

	/* 
		when warehouse change selected items is delete this function  
	*/
	public function changeWarehouseDeleteSalesItems($sales_id,$product_id,$warehouse_id,$old_warehouse_id){

		$sql = "select * from sales_items where sales_id = ? AND product_id = ?";
		$delete_quantity = $this->db->query($sql,array($sales_id,$product_id))->row()->quantity;

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
		
		$sql = "delete from sales_items where sales_id = ? AND product_id = ?";
		if($this->db->query($sql,array($sales_id,$product_id))){
			return true;
		}
		else{
			return false;
		}
	}
	/* 
		delete sales record in database 
	*/
	public function deleteModel($id){
		$sql = "DELETE FROM sales WHERE sales_id = ?";
		if($this->db->query($sql,array($id))){
			$sql = "DELETE FROM invoice where sales_id = ?";
			if($this->db->query($sql,array($id))){
				$sql = "DELETE FROM sales_items WHERE sales_id = ?";
				if($this->db->query($sql,array($id))){
					$sql = "DELETE FROM payment WHERE sales_id = ?";
					if($this->db->query($sql,array($id))){
						return TRUE;
					}
				}
			}
		}
		else{
			return FALSE;
		}
	}
	/* 
		return all details of sales 
	*/
	public function getSalesData(){
		return $this->db->get('sales')->result();
	}
	/*
		return all details of purchase
	*/
	public function getPurchaseData(){		
		return $this->db->get('purchases')->result();
	}
	/* 
		return sales data for calendar
	*/
	public function getCalendarData(){
		return $this->db->get('sales')->result();
	}
	/* 
		return sales details
	*/
	public function getDetails($id){
		return  $this->db->select('s.*,i.invoice_no,i.invoice_date,i.paid_amount,c.company_name,c.house_no,c.road_no,c.country_id,c.state_id,c.city_id,c.zip_code,c.company_phone,c.email,u.first_name,u.last_name')
						 ->from('sales s')
						 ->join('invoice i','s.sales_id = i.sales_id')
						 ->join('client c','s.client_id = c.client_id')
						 ->join('users u','s.user_id = u.id')
						 ->where('s.sales_id',$id)
						 ->get()
						 ->result();
	}
	/*
		return details for payment
	*/
	public function getDetailsPayment($id){
		return  $this->db->select('s.*,c.company_name,c.house_no,c.road_no,c.country_id,c.state_id,c.city_id,c.zip_code,c.company_phone,c.email,u.first_name,u.last_name')
						 ->from('sales s')
						 ->join('client c','s.client_id = c.client_id')
						 ->join('users u','s.user_id = u.id')
						 ->where('s.sales_id',$id)
						 ->get()
						 ->result();
	}
	/*		
		return purchase items details
	*/
	public function itemsView($id){
		return $this->db->select('si.*, pr.name as product_name')
		->from('sales_items si')
		->join('products pr','si.product_id = pr.product_id')
		->where('si.sales_id',$id)
		->get()
		->result();
	}
	/*
		return sales item details
	*/
	public function getItems($id){
		return  $this->db->select('si.*,pr.name,pr.code,pr.unit_id,pr.size')
						 ->from('sales_items si')
						 ->join('sales s','si.sales_id = s.sales_id')
						 ->join('products pr','si.product_id = pr.product_id')
						 ->where('si.sales_id',$id)
						 ->get()
						 ->result();
	}
	/*
		return supplier details
	*/
	public function getClientEmail($id){

		return $this->db->select('*')
						 ->from('sales s')
						 ->join('client c','c.client_id = s.client_id')
						 ->where('s.sales_id',$id)
						 ->get()
						 ->result();
	}
	/*
		add payment details
	*/
	public function addPayment($data){

		$sql = "INSERT INTO payment (sales_id,date,reference_no,amount,currency_id,paying_by,bank_name,cheque_no,name,contact,designation,description) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
		if($this->db->query($sql,$data)){
		/*if($this->db->insert('payment',$data)){*/

			$this->db->where('sales_id',$data['sales_id']);
			$this->db->update('invoice',array("paid_amount"=>$data['amount']));
			return true;
		}else{
			return false;
		}
	}
	/*
		return invoice
	*/
	public function invoice(){
		return $this->db->select('*')
					    ->from('invoice i')
					    ->join('sales s','s.sales_id = i.sales_id')
					    ->get()
					    ->result();
	}
	public function getFilteredInvoice($start_date, $end_date){
		$this->db->select('*')
				 ->from('invoice i')
				 ->join('sales s','s.sales_id = i.sales_id')
				 ->where('i.invoice_date >=', $start_date)
				 ->where('i.invoice_date <=', $end_date);

		$data = $this->db->get();
		log_message('debug', print_r($data, true));
		return $data->result();
	}
	/*
		return SMTP server Data
	*/
	public function getSmtpSetup(){
		return $this->db->get('email_setup')->row();
	} 
	/*
		return client data for shipping address
	*/
	public function getClientData($id){
		$this->db->where('client_id',$id);
		return $this->db->get_where('client')->row();
	}
	/*
		return country
	*/
	public function getCountry(){
		return $this->db->get('countries')->result();
	}
	/*
		return state
	*/
	public function getState($id){	
		return $this->db->select('s.*')
		                 ->from('states s')
		                 ->join('countries c','c.id = s.country_id')
		                 ->where('s.country_id',$id)
		                 ->get()
		                 ->result();
	}
	/*
		return city 
	*/
	public function getCity($id){
		return $this->db->select('c.*')
		                 ->from('cities c')
		                 ->join('states s','s.id = c.state_id')
		                 ->where('c.state_id',$id)
		                 ->get()
		                 ->result();
	} 
}
?>