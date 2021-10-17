<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ta_da_model extends CI_Model
{
	public function index(){
		
	} 
	/* 
		return all purchase details to display list 
	*/
	/*public function getPurchase(){
		$this->db->select('purchases.*,suppliers.*')
				 ->from('purchases')
				 ->join('suppliers','purchases.supplier_id = suppliers.supplier_id');
		$data = $this->db->get();
		log_message('debug', print_r($data, true));
		return $data->result();
	}*/
	

	public function getTaDa(){
		$this->db->select('*')
				 ->from('ta_da')
				 ->where('type', 'ta_da');
		$data = $this->db->get();
		log_message('debug', print_r($data, true));
		return $data->result();
	}
	public function getTaDaUser(){
		$this->db->select('user_id, expensed_by')
				 ->from('ta_da')
				 ->where('type', 'ta_da')
				 ->group_by('user_id');
		$data = $this->db->get();
		log_message('debug', print_r($data, true));
		return $data->result();
	}
	public function getTaDa2(){
		$this->db->select('*')
				 ->from('ta_da')
				 ->where('type', 'tiffin');
		$data = $this->db->get();
		log_message('debug', print_r($data, true));
		return $data->result();
	}
	public function getTaDaUser2(){
		$this->db->select('user_id, expensed_by')
				 ->from('ta_da')
				 ->where('type', 'tiffin')
				 ->group_by('user_id');
		$data = $this->db->get();
		log_message('debug', print_r($data, true));
		return $data->result();
	}
	public function getFilteredTaDa($type, $start_date = NULL, $end_date = NULL, $expensed_by){
		if($start_date && $end_date){
			if(!empty($start_date) && empty($expensed_by)){
				$this->db->select('*')
						 ->from('ta_da')
						 ->where('type', $type)
						 ->where('date >=', $start_date)
						 ->where('date <=', $end_date);
			}
			elseif(empty($start_date) && !empty($expensed_by)){
				$this->db->select('*')
						 ->from('ta_da')
						 ->where('type', $type)
						 ->where('user_id', $expensed_by);
			}
			elseif(empty($start_date) && empty($expensed_by)){
				$this->db->select('*')
						 ->from('ta_da');
			}
			else{
				$this->db->select('*')
						 ->from('ta_da')
						 ->where('type', $type)
						 ->where('date >=', $start_date)
						 ->where('date <=', $end_date)
						 ->where('user_id', $expensed_by);
			}
		}
		else{
			if(empty($expensed_by)){
				$this->db->select('*')
						 ->from('ta_da')
						 ->where('type', $type);
			}
			else{
				$this->db->select('*')
						 ->from('ta_da')
						 ->where('type', $type)
						 ->where('user_id', $expensed_by);
			}
		}

		$data = $this->db->get();
		log_message('debug', print_r($data, true));
		return $data->result();
	}
	public function updateStatus($id){
		$sql = "UPDATE ta_da SET finalization_status = 'Finalized' WHERE ta_da_id = '$id'";
		if($this->db->query($sql)){
			return true;
		}
		else{
			return false;
		}
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
		return supplier detail use drop down 
	*/
		public function getSupplier(){
			return $this->db->get('suppliers')->result();
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
		generate invoive no
	*/
		public function generateInvoiceNo(){
			$query = $this->db->query("SELECT * FROM account_receipts ORDER BY receipt_voucher_no DESC LIMIT 1");
			$result = $query->result();
			if($result==null){
				$no = sprintf('%06d',intval(1));
			}
			else{
				foreach ($result as $value) {
					$no = sprintf('%06d',intval($value->receipt_voucher_no)+1); 
				}
			}
			return "P-WINV-".$no;
		}
	/*	
		generate payment reference no
	*/
		public function generateReferenceNo(){
			$query = $this->db->query("SELECT * FROM account_payments ORDER BY payment_voucher_no DESC LIMIT 1");
			$result = $query->result();
			return $result;
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
		return user detail use dynamic table
	*/
		public function getUsers(){
			$this->db->select('*');
			$data =	$this->db->get('users');
			return $data->result();
		}
	/* 
		return client detail use dynamic table
	*/
		public function getClient(){
			return $this->db->select('*')
			->from('client')
			->where('client_type_id',2)
			->or_where('client_type_id',3)
			->or_where('client_type_id',4)
			->get()
			->result();
		}
	/* 
		add new purchase record in database 
	*/
		public function addModel($data){
			$sql = "insert into ta_da (date,title,total_amount,image,description,type,finalization_status,status,datetime,user_id,expensed_by) values(?,?,?,?,?,?,?,?,?,?,?)";

			if($this->db->query($sql,$data)){
				$insert_id = $this->db->insert_id(); 
				return $insert_id;
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
		public function addProductQuantity($product_id,$quantity){
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
		add newly purchse items record in database 
	*/
		public function addPurchaseItem($data){
			$sql = "insert into ta_da_categories(ta_da_id,category_name,category_details,amount,status,user_id,datetime) values (?,?,?,?,?,?,?)";
			if($this->db->query($sql,$data)){
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
			$purchase_id = $inventory_data['purchase_id'];
			$product_id = $inventory_data['product_id'];
			
			$inv_sql = "select * from inventory where purchase_id = ? AND product_id = ?";
			$result = $this->db->query($inv_sql,array($purchase_id,$product_id));

			if($result->num_rows()>0){
				$sql = "update inventory set purchase_id = ?, sales_id = ?, shelf_id = ?, rack_id = ?, product_id = ?, cost = ?, quantity = ?, inventory_status = ?, user_id = ?, datetime = ? where (purchase_id = '$purchase_id' and product_id = '$product_id')";
				if($this->db->query($sql,$inventory_data)){
					return true;
				}
				else{
					return false;
				}
			}
			/*else{
				$sql = "INSERT INTO inventory(purchase_id,sales_id,shelf_id,rack_id,product_id,cost,quantity,inventory_status,user_id,datetime) VALUES (?,?,?,?,?,?,?,?,?,?)";
				if($this->db->query($sql,$inventory_data)){
					return true;
				}
				else{
					return false;
				}
			}*/
		}
	/* 
		add or update purchase items in database 
	*/
		public function addUpdatePurchaseItem($ta_da_id,$data){
			$ta_da_id = $data['ta_da_id'];
			$category_name = $data['category_name'];
			$sql = "SELECT * FROM ta_da_categories WHERE ta_da_id = ?";
			$result = $this->db->query($sql,array($ta_da_id));
			
			if($result->num_rows()>0){
				$where = "ta_da_id = '$ta_da_id'";
				$this->db->where($where);
				$this->db->update('ta_da_categories',$data);
			}
			else{
				$sql2 = "INSERT INTO ta_da_categories(ta_da_id,category_name,category_details,amount,status,user_id,datetime) values (?,?,?,?,?,?,?)";
				$this->db->insert('ta_da_categories',$data);
			}
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
		return purchase record to edit 
	*/
		public function getRecord($id){
			$sql = "SELECT * FROM ta_da where ta_da_id = ?";
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
		public function getTaDaCategories($ta_da_id){
			$this->db->select('*')
			->from('ta_da_categories')
			->where('ta_da_id',$ta_da_id);
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
			$sql = "update ta_da set date = ?, title = ?, total_amount = ?, image = ?, description = ?, status = ?, datetime = ?, user_id = ?, expensed_by = ? where ta_da_id = '$id'";
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
			$sql = "DELETE FROM ta_da WHERE ta_da_id = ?";
			if($this->db->query($sql,array($id))){
				$sql = "DELETE FROM ta_da_categories WHERE ta_da_id = ?";
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
			$sql = "update inventory set quantity = ? where product_id = ?";
			$this->db->query($sql,array($pquantity,$product_id));

			$sql = "delete from purchase_items where purchase_id = ? AND product_id = ?";
			if($this->db->query($sql,array($purchase_id,$product_id))){
				return true;
			}
			else{
				return false;
			}
		}


		public function updateInventoryQuantity($purchase_id,$product_id){

			$sql = "select * from purchase_items where purchase_id = ? AND product_id = ?";
			$delete_quantity = $this->db->query($sql,array($purchase_id,$product_id))->row()->quantity;


			$sql = "select * from products where product_id = ?";
			$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;

			$pquantity = $product_quantity - $delete_quantity;
			$sql = "update inventory set quantity = ? where product_id = ?";
			/*$this->db->query($sql,array($pquantity,$product_id));*/

			if($this->db->query($sql,array($pquantity,$product_id))){
				echo "done";
				return true;
			}
			else{
				echo "fail";
				return false;
			}
		}
	/* 
		return purchase details
	*/
	public function getDetails($id){
		return  $this->db->select('*')
						 ->from('ta_da')
						 ->where('ta_da_id',$id)
						 ->get()
						 ->result();

	}
	public function itemsView($id){
		return $this->db->select('*')
		->from('ta_da_categories')
		->where('ta_da_id',$id)
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
			->join('states s','cs.state_id = s.id')
			->join('countries co','cs.country_id = co.id')
			->get()
			->result();
		}
	/*		
		return ta_da items details
	*/
		public function categoriesView($id){
			return $this->db->select('*')
			->from('ta_da_categories')
			->where('ta_da_id',$id)
			->get()
			->result();
		}
	/*
		return purchase item details
	*/
	public function getItems($id){
		return  $this->db->select('pi.*,pr.name,pr.code')
						 ->from('purchase_items pi')
						 ->join('purchases p','pi.purchase_id = p.purchase_id')
						 ->join('products pr','pi.product_id = pr.product_id')
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
	/*
		return discount value
	*/
		public function getDiscountValue($id){
			return $this->db->get_where('discount',array('discount_id'=>$id))->result();
		}
	/*
		return tax value
	*/
		public function getTaxValue($id){
			return $this->db->get_where('tax',array('tax_id'=>$id))->result();
		}
	/*
		return SMTP server Data
	*/
		public function getSmtpSetup(){
			return $this->db->get('email_setup')->row();
		} 
	/*
		add payment details
	*/
		public function addPayment($data){
		/*$sql = "INSERT INTO payment (sales_id,date,reference_no,amount,paying_by,bank_name,cheque_no,description) VALUES (?,?,?,?,?,?,?,?)";
		if($this->db->query($sql,$data)){*/
			if($this->db->insert('account_payments',$data)){
				$this->db->where('purchase_id',$data['purchase_id']);
				$this->db->update('account_receipts',array("paid_amount"=>$data['payment_amount']));
				return true;
			}else{
				return false;
			}
		}
	/*
		return receipt
	*/
	public function receipt(){
		return $this->db->select('*')
					    ->from('account_receipts a')
					    ->join('purchases p','p.purchase_id = a.purchase_id')
					    ->get()
					    ->result();
	}
	/*
		return ledger
	*/
		public function getLedger(){
			return $this->db->get('ledger')->result();
		}
	}
	?>