<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	}
	/* 
		return last product id 
	*/
		public function createCode(){
			$query = $this->db->query("SELECT * FROM products ORDER BY product_id DESC LIMIT 1");
			$result = $query->result();
			return $result;
		}
	/* 
		return category id and name to use drop down manu 
	*/
		public function getCategory(){
			$this->db->select('category_id,category_name');
			$data =	$this->db->get('category');
			return $data->result();
		}
		
	/* 
		return brand name to use drop down manu 
	*/
		/*public function getBrand(){
			$this->db->select('brand_id,brand_name');
			$data =	$this->db->get('brand');
			return $data->result();
		}*/

		public function getUnit(){
			$this->db->select('unit_id,unit_name');
			$data =	$this->db->get('unit');
			return $data->result();
		}
	/* 
		return subcategory id and name to use drop down manu 
	*/
		public function getSubcategory($id){
			$sql = "SELECT s.* FROM sub_category s INNER JOIN products p ON s.category_id = p.category_id where p.product_id = ?";
			$data = $this->db->query($sql,array($id));
			/*$this->db->select('sub_category_id,sub_category_name');
			$data =	$this->db->get('sub_category');*/
			return $data->result();
		}
	/* 
		Add product approval
	*/
		public function addApproval($data){
			$product_id = $data['product_id'];
			$client_id = $data['client_id'];
			$sql = "SELECT * FROM product_approval_local where product_id = ? AND client_id = ?";
			$result = $this->db->query($sql, array($product_id, $client_id));
	    	
	    	if ($result->num_rows() == 0){
	    		$sql2 = "INSERT INTO product_approval_local (product_id, client_id, approval_clients, approved_by) VALUES(?,?,?,?)";
				if($this->db->query($sql2, $data)){
					return true;
				}
				else{
					return false;
				}
	    	}

			else{
				$sql2 = "UPDATE product_approval_local SET approval_clients = ? WHERE product_id = ? AND client_id = ?";
				if($this->db->query($sql2, array($data['approval_clients'], $product_id, $client_id))){
					return true;
				}
				else{
					return false;
				}
			}
		}
		public function prodApproveStatus($data){
			$product_id = $data['product_id'];
			$sql = "SELECT * FROM prod_approve_status where product_id = ? LIMIT 1";
			$result = $this->db->query($sql, array($product_id));
	    	
	    	if ($result->num_rows() == 0){
	    		$sql2 = "INSERT INTO prod_approve_status (product_id, approval_status, approved_by) VALUES(?,?,?)";
				if($this->db->query($sql2, $data)){
					return true;
				}
				else{
					return false;
				}
	    	}

			else{
				$sql2 = "UPDATE prod_approve_status SET approval_status = ? WHERE product_id = ?";
				if($this->db->query($sql2, array($data['approval_status'], $product_id))){
					return true;
				}
				else{
					return false;
				}
			}
		}
		public function addApprovalStatus($data){
			$product_id = $data['product_id'];
			$client_id = $data['client_id'];
			$sql = "SELECT * FROM product_approval_status where product_id = ? AND client_id = ?";
			$result = $this->db->query($sql, array($product_id, $client_id));
	    	
	    	if ($result->num_rows() == 0){
	    		$sql2 = "INSERT INTO product_approval_status (product_id, client_id, approval_status, approved_by) VALUES(?,?,?,?)";
				if($this->db->query($sql2, $data)){
					return true;
				}
				else{
					return false;
				}
	    	}

			else{
				$sql2 = "UPDATE product_approval_status SET approval_status = ? WHERE product_id = ? AND client_id = ?";
				if($this->db->query($sql2, array($data['approval_status'], $product_id, $client_id))){
					return true;
				}
				else{
					return false;
				}
			}
		}
	/* 
		return approved product list
	*/
		public function getApprovedProducts($client_id, $product_id)
		{
			$this->db->select('a.*, c1.company_name AS company_name, c2.company_name AS company_name2, p.name AS product_name')
					 ->from('product_approval a')
					 ->join('client c1','a.client_id = c1.client_id')
					 ->join('client c2','a.client_id2 = c2.client_id')
					 ->join('products p','a.product_id = p.product_id')
					 ->where('a.client_id2', $client_id)
					 ->where('a.product_id', $product_id);
			
			return $this->db->get()->result();
		}
		public function editApprovalStatus($data){
			$this->db->where('product_approval_id', $data['product_approval_id']);
			
			if($this->db->update('product_approval', $data)) {
				return true;
			}
			else{
				return false;
			}
		}
	/* 
		return tax id and name to use drop down manu 
	*/
		public function getTax(){
			$this->db->select('tax_id,tax_name');
			$data =	$this->db->get('tax');
			return $data->result();
		}
		public function getClient1(){
			$type_id = array(2, 3, 4);
			$this->db->select('client_id,company_name,client_type_id')
					 ->where_in('client_type_id', $type_id);
			$data =	$this->db->get('client');
			return $data->result();
		}
		public function getClient2(){
			$this->db->select('client_id,company_name,client_type_id')
					 ->where('client_type_id', 1);
			$data =	$this->db->get('client');
			return $data->result();
		}
		public function getApprovalClient(){
			$type_id = array(2, 3, 4);
			$this->db->select('*')
					 ->where_in('client_type_id', $type_id);
			$data =	$this->db->get('client');
			return $data->result();
		}
		public function getUser(){
			$this->db->select('id,first_name,last_name,category_id');
			$data =	$this->db->get('users');
			return $data->result();
		}


	/*
		return sac data
	*/
		public function getSac(){

			return $this->db->get('sac')->result();
		}
	/*
		return hsn chapter
	*/
		public function getHsnChapter(){
			return $this->db->get('hsn_chapter')->result();
		}
	/*
		return hsn data
	*/
		public function getHsn(){
			return $this->db->get_where('hsn',array('chapter'=>1))->result();
		}
	/*

	*/
	public function getHsnData($id){
		return $this->db->get_where('hsn',array('chapter'=>$id))->result();
	}


	public function getClientData($id){
		return $this->db->get_where('client',array('client_id'=>$id))->result();
	}
	/* 
		return subcategory details when category change 
	*/
		public function selectSubcategory($id){
			$sql = "select * from sub_category where category_id = ?";
			$data = $this->db->query($sql,array($id));
		/*$this->db->where('category_id',$id);
		$data = $this->db->get('sub_category');*/
		return $data->result();
	}

	/* 
		return all product details to display list 
	*/
		public function getProducts($char){
			$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name, client.*')
			->from('products')
			->join('category','products.category_id = category.category_id')
			->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
			->join('client','products.client_id = client.client_id')
			->where('products.product_status', 'active')
			->like('products.name', $char, 'after');
			return $this->db->get()->result();
		}
	/* 
		return all client details to dispaly list 
	*/
		public function getFilteredProduct($char, $category_id, $sub_category_id, $client_id, $user_id, $status){
			if(!empty($sub_category_id) && empty($client_id) && empty($user_id) && empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->where('products.subcategory_id', $sub_category_id)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(empty($sub_category_id) && !empty($client_id) && empty($user_id) && empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->like('products.client_id', $client_id)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(empty($sub_category_id) && empty($client_id) && !empty($user_id) && empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->like('client.responsible_person_id', $user_id)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(empty($sub_category_id) && empty($client_id) && empty($user_id) && !empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->where('products.product_status', $status)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(!empty($sub_category_id) && !empty($client_id) && empty($user_id) && empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->where('products.subcategory_id', $sub_category_id)
					->like('products.client_id', $client_id)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(!empty($sub_category_id) && empty($client_id) && !empty($user_id) && empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->where('products.subcategory_id', $sub_category_id)
					->like('client.responsible_person_id', $user_id)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(!empty($sub_category_id) && empty($client_id) && empty($user_id) && !empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->where('products.subcategory_id', $sub_category_id)
					->where('products.product_status', $status)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(empty($sub_category_id) && !empty($client_id) && !empty($user_id) && empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->like('products.client_id', $client_id)
					->like('client.responsible_person_id', $user_id)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(empty($sub_category_id) && !empty($client_id) && empty($user_id) && !empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->like('products.client_id', $client_id)
					->where('products.product_status', $status)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(empty($sub_category_id) && empty($client_id) && !empty($user_id) && !empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->where('products.product_status', $status)
					->like('client.responsible_person_id', $user_id)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(!empty($sub_category_id) && !empty($client_id) && !empty($user_id) && empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->where('products.subcategory_id', $sub_category_id)
					->like('client.responsible_person_id', $user_id)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(empty($sub_category_id) && !empty($client_id) && !empty($user_id) && !empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->like('products.client_id', $client_id)
					->like('client.responsible_person_id', $user_id)
					->where('products.product_status', $status)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(!empty($sub_category_id) && !empty($client_id) && empty($user_id) && !empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->where('products.subcategory_id', $sub_category_id)
					->like('products.client_id', $client_id)
					->where('products.product_status', $status)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(!empty($sub_category_id) && empty($client_id) && !empty($user_id) && !empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->where('products.subcategory_id', $sub_category_id)
					->like('client.responsible_person_id', $user_id)
					->where('products.product_status', $status)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			elseif(empty($sub_category_id) && empty($client_id) && empty($user_id) && empty($status)){
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->where('products.product_id', 465)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
			else{
				$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name, client.house_no, client.road_no, client.company_phone, client.contact_person, client.contact_person_phone')
					->from('products')
					->join('category','products.category_id = category.category_id')
					->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
					->join('client','products.client_id = client.client_id')
					->where('products.category_id', $category_id)
					->where('products.subcategory_id', $sub_category_id)
					->like('products.client_id', $client_id)
					->like('client.responsible_person_id', $user_id)
					->where('products.product_status', $status)
					->like('products.name', $char, 'after');
					return $this->db->get()->result();
			}
		}
	/* 
		find product in inventory
	*/
		function findProductInInventory($product_id){
			return $this->db->where('product_id', $product_id)
							->count_all_results('inventory');
		}
	/* 
		ckech product code already exist or not 
	*/
		function codeExist($key)
		{
			$sql = "select * from products where code = ?";
			$query = $this->db->query($sql,array("code" => $key));
	    /*$this->db->where('code',$key);
	    $query = $this->db->get('products');*/
	    if ($query->num_rows() > 0){
	    	return true;
	    }
	    else{
	    	return false;
	    }
	}
	/* 
		add new product record in database 
	*/
		public function addModel($data, $approval_data){
			log_message('debug', print_r($data, true));
				
			$sql = "insert into products (code,name,unit_id,size,cost,price,alert_quantity, image, category_id,subcategory_id,quantity,details, is_inventory,product_status,client_id,client_email,user_id,datetime,last_update_by, last_update_date) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			if($this->db->query($sql,$data)){
				$product_id = $this->db->insert_id();
				$approval_status = $approval_data['approval_status'];

				if($approval_status != ''){
					$approved_by = $approval_data['approved_by'];

		    		$sql2 = "INSERT INTO prod_approve_status (product_id, approval_status, approved_by) VALUES('$product_id','$approval_status','$approved_by')";
					if($this->db->query($sql2, $data)){
						return TRUE;
					}
					else{
						return FALSE;
					}
		    	}

				return $product_id;
			}
			else{
				return FALSE;
			}
		}
	/* 
		return all product details when product edit 
	*/
		public function getRecord($data){
		//$this->db->where('product_id',$data);
			$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name,  client.company_name')
			->from('products')
			->join('category','products.category_id = category.category_id')
			->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
			->join('client','products.client_id = client.client_id')
			/*->join('unit','products.unit_id = unit.unit_id')*/
			->where('products.product_id',$data);
			$query = $this->db->get();
			if($query){
				return $query->result();
			}
			else{
				return FALSE;
			}
		}
	/* 
		save edited product record in database  
	*/
		public function editModel($data,$approval_data,$id){
			$sql = "update products set  code = ?,name = ?,unit_id =?,size = ?,cost = ?,price = ?,alert_quantity = ?,image = ?,category_id = ?,subcategory_id = ?,quantity = ?,details = ?,is_inventory = ?, product_status = ?,client_id = ?, client_email = ?, last_update_by = ?, last_update_date = ? where product_id = ?";
			if($this->db->query($sql,array($data['code'],$data['name'],$data['unit_id'],$data['size'],$data['cost'],$data['price'],$data['alert_quantity'],$data['image'],$data['category_id'],$data['subcategory_id'],$data['quantity'],$data['details'],$data['is_inventory'],$data['product_status'],$data['client_id'],$data['client_email'],$data['last_update_by'],$data['last_update_date'],$id))){
				$approval_status = $approval_data['approval_status'];

				if($approval_status != ''){
					$product_id = $approval_data['product_id'];
					$approved_by = $approval_data['approved_by'];

					$sql2 = "SELECT * FROM prod_approve_status where product_id = '$product_id' LIMIT 1";
					$result = $this->db->query($sql2, array($product_id));
			    	
			    	if ($result->num_rows() == 0){
			    		$sql3 = "INSERT INTO prod_approve_status (product_id, approval_status, approved_by) VALUES('$product_id','$approval_status','$approved_by')";
						if($this->db->query($sql3, $approval_data)){
							return true;
						}
						else{
							return false;
						}
			    	}

					else{
						$sql3 = "UPDATE prod_approve_status SET approval_status = '$approval_status' WHERE product_id = '$product_id'";
						if($this->db->query($sql3, array($approval_status, $product_id))){
							return true;
						}
						else{
							return false;
						}
					}
				}

				return TRUE;
			}
			else{
				return FALSE;
			}
		}

	public function getClientMultiple(){
		return $this->db->get('client')->result();
	}

	
	/* 
		delete product record from database 
	*/


	public function deleteMul($selected_id){
		if (count($selected_id) > 0 ){
			$all = implode(",", $_POST["selected_id"]);
			$sql = "DELETE FROM products WHERE 1 AND product_id IN($all)";
			if($this->db->query($sql,array($all))){
				$sql2 = "DELETE FROM inventory WHERE 1 AND product_id IN($all)";
				$sql3 = "DELETE FROM check_out_history WHERE 1 AND product_id IN($all)";
				$sql4 = "DELETE FROM check_in_history WHERE 1 AND product_id IN($all)";
				$sql5 = "DELETE FROM purchase_items WHERE 1 AND product_id IN($all)";
				$sql6 = "DELETE FROM sales_items WHERE 1 AND product_id IN($all)";

				return TRUE;
			}
			else {
				return FALSE;
			}
		}
	}





public function deleteModel($id){
	$sql = "DELETE FROM products WHERE product_id = ?";
	if($this->db->query($sql,array($id))){
		$this->db->where('product_id', $id)->delete('inventory');
		$this->db->where('product_id', $id)->delete('check_out_history');
		$this->db->where('product_id', $id)->delete('check_in_history');
		$this->db->where('product_id', $id)->delete('purchase_items');
		$this->db->where('product_id', $id)->delete('sales_items');
		
		return TRUE;
	}
	else{
		return FALSE;
	}
}

	public function addCsvData($data){

	}
}
?>