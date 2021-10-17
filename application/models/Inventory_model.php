<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class inventory_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	}

	public function getCategories(){
		$this->db->select('*')->from('category');

		$query = $this->db->get();
		if($query){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}

	public function getSubCategories(){
		$this->db->select('*')->from('sub_category');

		$query = $this->db->get();
		if($query){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}

	public function getFilteredInventoryItem($category_id, $sub_category_id){
		if(empty($category_id) && empty($sub_category_id)){
			return $this->db->select('*')
							->select_sum('i.quantity', 'totalProduct')
							->select_sum('i.sales_qty', 'totalSales')
							->select_sum('i.ck_out_qty', 'totalOut')
							->select_sum('i.ck_in_qty', 'totalIn')
							->from('inventory i')
							->join('products p', 'i.product_id = p.product_id')
							->group_by(array('i.product_id', 'i.shelf_id', 'i.rack_id'))
							->get()
							->result();
		}
		else if(!empty($category_id) && empty($sub_category_id)){
			return $this->db->select('*')
							->select_sum('i.quantity', 'totalProduct')
							->select_sum('i.sales_qty', 'totalSales')
							->select_sum('i.ck_out_qty', 'totalOut')
							->select_sum('i.ck_in_qty', 'totalIn')
							->from('inventory i')
							->join('products p', 'i.product_id = p.product_id')
							->where('p.category_id', $category_id)
							->group_by(array('i.product_id', 'i.shelf_id', 'i.rack_id'))
							->get()
							->result();
		}
		else if(empty($category_id) && !empty($sub_category_id)){
			return $this->db->select('*')
						->select_sum('i.quantity', 'totalProduct')
						->select_sum('i.sales_qty', 'totalSales')
						->select_sum('i.ck_out_qty', 'totalOut')
						->select_sum('i.ck_in_qty', 'totalIn')
						->from('inventory i')
						->join('products p', 'i.product_id = p.product_id')
						->where('p.subcategory_id', $sub_category_id)
						->group_by(array('i.product_id', 'i.shelf_id', 'i.rack_id'))
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->select_sum('i.quantity', 'totalProduct')
						->select_sum('i.sales_qty', 'totalSales')
						->select_sum('i.ck_out_qty', 'totalOut')
						->select_sum('i.ck_in_qty', 'totalIn')
						->from('inventory i')
						->join('products p', 'i.product_id = p.product_id')
						->where('p.category_id', $category_id)
						->where('p.subcategory_id', $sub_category_id)
						->group_by(array('i.product_id', 'i.shelf_id', 'i.rack_id'))
						->get()
						->result();
		}
	}

	public function getFilteredStockRecord($category_id, $sub_category_id){
		if(empty($category_id) && empty($sub_category_id)){
			return $this->db->select('*, i.quantity AS totalProduct')
							->from('inventory i')
							->join('products p', 'i.product_id = p.product_id')
							->join('shelf s','i.shelf_id = s.shelf_id')
							->join('rack r','i.rack_id = r.rack_id')
							->get()
							->result();
		}
		else if(!empty($category_id) && empty($sub_category_id)){
			return $this->db->select('*, i.quantity AS totalProduct')
							->from('inventory i')
							->join('products p', 'i.product_id = p.product_id')
							->join('shelf s','i.shelf_id = s.shelf_id')
							->join('rack r','i.rack_id = r.rack_id')
							->where('p.category_id', $category_id)
							->get()
							->result();
		}
		else if(empty($category_id) && !empty($sub_category_id)){
			return $this->db->select('*, i.quantity AS totalProduct')
						->from('inventory i')
						->join('products p', 'i.product_id = p.product_id')
						->join('shelf s','i.shelf_id = s.shelf_id')
						->join('rack r','i.rack_id = r.rack_id')
						->where('p.subcategory_id', $sub_category_id)
						->get()
						->result();
		}
		else{
			return $this->db->select('*, i.quantity AS totalProduct')
						->from('inventory i')
						->join('products p', 'i.product_id = p.product_id')
						->join('shelf s','i.shelf_id = s.shelf_id')
						->join('rack r','i.rack_id = r.rack_id')
						->where('p.category_id', $category_id)
						->where('p.subcategory_id', $sub_category_id)
						->get()
						->result();
		}
	}

	public function getFilteredCheckOutHistory($category_id, $sub_category_id){
		if(empty($category_id) && empty($sub_category_id)){
			return $this->db->select('*')
							->from('check_out_history c')
							->join('products p', 'c.product_id = p.product_id')
							->join('client cl', 'c.client_id = cl.client_id')
							->get()
							->result();
		}
		else if(!empty($category_id) && empty($sub_category_id)){
			return $this->db->select('*')
							->from('check_out_history c')
							->join('products p', 'c.product_id = p.product_id')
							->join('client cl', 'c.client_id = cl.client_id')
							->where('p.category_id', $category_id)
							->get()
							->result();
		}
		else if(empty($category_id) && !empty($sub_category_id)){
			return $this->db->select('*')
							->from('check_out_history c')
							->join('products p', 'c.product_id = p.product_id')
							->join('client cl', 'c.client_id = cl.client_id')
							->where('p.subcategory_id', $sub_category_id)
							->get()
							->result();
		}
		else{
			return $this->db->select('*')
							->from('check_out_history c')
							->join('products p', 'c.product_id = p.product_id')
							->join('client cl', 'c.client_id = cl.client_id')
							->where('p.category_id', $category_id)
							->where('p.subcategory_id', $sub_category_id)
							->get()
							->result();
		}
	}

	public function getFilteredCheckInHistory($category_id, $sub_category_id){
		if(empty($category_id) && empty($sub_category_id)){
			return $this->db->select('*')
							->from('check_in_history c')
							->join('products p', 'c.product_id = p.product_id')
							->join('client cl', 'c.client_id = cl.client_id')
							->get()
							->result();
		}
		else if(!empty($category_id) && empty($sub_category_id)){
			return $this->db->select('*')
							->from('check_in_history c')
							->join('products p', 'c.product_id = p.product_id')
							->join('client cl', 'c.client_id = cl.client_id')
							->where('p.category_id', $category_id)
							->get()
							->result();
		}
		else if(empty($category_id) && !empty($sub_category_id)){
			return $this->db->select('*')
							->from('check_in_history c')
							->join('products p', 'c.product_id = p.product_id')
							->join('client cl', 'c.client_id = cl.client_id')
							->where('p.subcategory_id', $sub_category_id)
							->get()
							->result();
		}
		else{
			return $this->db->select('*')
							->from('check_in_history c')
							->join('products p', 'c.product_id = p.product_id')
							->join('client cl', 'c.client_id = cl.client_id')
							->where('p.category_id', $category_id)
							->where('p.subcategory_id', $sub_category_id)
							->get()
							->result();
		}
	}

	public function getProduct($product_id){
		$this->db->select('products.*, category.category_id,category.category_name, sub_category.sub_category_id, sub_category.sub_category_name, client.company_name')
		->from('products')
		->join('category','products.category_id = category.category_id')
		->join('sub_category','products.subcategory_id = sub_category.sub_category_id')
		->join('client','products.client_id = client.client_id')
		->where('products.product_id',$product_id);
		$query = $this->db->get();
		if($query){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}

	public function checkoutHistory(){
		$this->db->select('check_out_history.*, client.company_name')
		->from('check_out_history')
		->join('client','check_out_history.client_id = client.client_id');

		return $this->db->get()->result();
		
	} 

	public function createReferenceNo(){
		$query = $this->db->query("SELECT * FROM check_out_history ORDER BY check_out_history_id DESC LIMIT 1");
		$result = $query->result();
		return $result;
	}

	public function createReferenceNoSales(){
		$query = $this->db->query("SELECT sales_id FROM sales ORDER BY sales_id DESC LIMIT 1");
		$result = $query->result();
		return $result;
	}

	public function checkInHistory(){
		$this->db->select('check_in_history.*, client.company_name')
		->from('check_in_history')
		->join('client','check_in_history.client_id = client.client_id');

		return $this->db->get()->result();
	} 

	public function getinventory(){
		$this->db->select('inventory.inventory_id, inventory.inventory_status, inventory.product_id,  products.*, SUM(inventory.quantity) As totalProduct, SUM(inventory.sales_qty) As totalSales, SUM(inventory.ck_out_qty) As totalOut, SUM(inventory.ck_in_qty) As totalIn, products.client_id')
		->from('inventory')
		->join('products','inventory.product_id = products.product_id')
		->group_by(array('inventory.product_id', 'inventory.shelf_id', 'inventory.rack_id'));
		return $this->db->get()->result();
	}

	public function getStock(){
		$this->db->select('inventory.*, products.*, (inventory.quantity) As totalProduct, (inventory.ck_out_qty) As totalOut, (inventory.ck_in_qty) As totalIn, products.client_id, shelf.shelf_name, rack.rack_name')
		->from('inventory')
		->join('products','inventory.product_id = products.product_id')
		->join('shelf','inventory.shelf_id = shelf.shelf_id')
		->join('rack','inventory.rack_id = rack.rack_id');
		return $this->db->get()->result();
	}

	public function getItems($id){
		return $this->db->select('pi.*,pr.name')
		->from('purchase_items pi')
		->join('products pr','pi.product_id = pr.product_id')
		->where('pi.purchase_id',$id)
		->get()
		->result();
	}
	public function getCompany(){
		return $this->db->select('cs.*,c.name as city_name,s.name as state_name,co.name as country_name')
		->from('company_settings cs')
		->join('cities c','cs.city_id = c.id')
		->join('states s','cs.state_id = s.id')
		->join('countries co','cs.country_id = co.id')
		->get()
		->result();
	}

	public function getDetails($id){
		$this->db->select('inventory.*, products.product_id, products.name, products.code, rack.rack_name, shelf.shelf_name'
	)
		->from('inventory')
		->join('products','inventory.product_id = products.product_id')
		->join('rack','inventory.rack_id = rack.rack_id')
		->join('shelf','inventory.shelf_id = shelf.shelf_id')
		->where('inventory.product_id',$id);
		return $this->db->get()->result();
	}

	public function getClient(){
		$this->db->select('client_id,company_name')
		->where('client.client_type_id',1);

		$data =	$this->db->get('client');

		return $data->result();
	}


	public function checkOutClient($id){
		$this->db->select('check_out_history.*, client.company_name, client.client_id')
		->from('check_out_history')
		->join('client','check_out_history.client_id = client.client_id')
		->where('check_out_history.inventory_id',$id);

		return $this->db->get()->result();
	}

	public function checkOutQuantity($id){
		$sql = "select * from check_out_history where inventory_id =? AND client_id = ?";
		$data = $this->db->query($sql,array($id));
		return $data->result();
	}



	public function get_by_id($id)
	{
		$this->db->select('inventory.*, products.name, products.product_id, products.client_id, shelf.shelf_name, rack.rack_name')
		->from('inventory')
		->join('products','inventory.product_id = products.product_id')
		->join('rack','inventory.rack_id = rack.rack_id')
		->join('shelf','inventory.shelf_id = shelf.shelf_id')
		->where('inventory.inventory_id',$id);
		return $this->db->get()->result();

/*		$sql = "select * from inventory where inventory_id = ?";
		$data = $this->db->query($sql,array($id));
		return $data->result();*/

	}

	public function client_data($client_id)
	{
		$this->db->select('check_out_history.inventory_id, check_out_history.client_id, check_out_history.product_id, SUM(check_out_history.out_quantity) AS out_quantity, client.company_name, inventory.*, products.*')
		->from('check_out_history')
		->join('client','check_out_history.client_id = client.client_id')	
		->join('products','check_out_history.product_id = products.product_id')	
		->join('inventory','check_out_history.inventory_id = inventory.inventory_id')
		->where('check_out_history.client_id',$client_id)
		->group_by(array('inventory.product_id', 'inventory.shelf_id', 'inventory.rack_id'));
		return $this->db->get()->result();
	}



	public function checkin_id($id)
	{
		$this->db->select('check_out_history.*, c1.company_name AS company_name1, c2.company_name AS company_name2, inventory.*, products.name')
		->from('check_out_history')
		->join('client c1','check_out_history.client_id = c1.client_id')
		->join('client c2','check_out_history.client_id2 = c2.client_id')
		->join('products','check_out_history.product_id = products.product_id')	
		->join('inventory','check_out_history.inventory_id = inventory.inventory_id')
		->where('check_out_history.check_out_history_id',$id);
		return $this->db->get()->result();
	}

	public function addCheckOut($data, $approval_data){
		$quantity =	$data['out_quantity'];
		$inventory_id =	$data['inventory_id'];

		$sql = "select * from inventory where inventory_id = '$inventory_id'";
		$product_quantity = $this->db->query($sql,array($inventory_id))->row()->ck_out_qty;

		$remainQuantity = $product_quantity + $quantity; 

		$sql = "update inventory set ck_out_qty = '$remainQuantity' where inventory_id = '$inventory_id'";
		if($this->db->query($sql,$data)){
			$sql = "insert into check_out_history(inventory_id, out_quantity, client_id, client_id2, product_id, out_date, user_id, user_name, remarks, reference_no) values(?,?,?,?,?,?,?,?,?,?)";

			if($this->db->query($sql,$data)){
				$insert_id = $this->db->insert_id();

				$client_id = $approval_data['client_id'];
				$client_id2 = $approval_data['client_id2'];
				$product_id = $approval_data['product_id'];

				$query = $this->db->select('*')
						 		  ->where('client_id', $client_id)
						 		  ->where('client_id2', $client_id2)
						 		  ->where('product_id', $product_id)
								  ->get('product_approval');
				
				if($query->num_rows() == 0){
					$this->db->insert('product_approval', $approval_data);
				}

				return $insert_id;
			}

			else{
				return FALSE;
			}
		}
	}


	public function addCheckIn($data, $approval_data){

		$quantity=	$data['in_quantity'];
		$inventory_id =	$data['inventory_id'];

		$check_out_history_id = $data['check_out_history_id'];

		$sql = "select * from check_out_history where check_out_history_id = '$check_out_history_id'";
		$out_quantity = $this->db->query($sql,array($inventory_id))->row()->out_quantity;
		$remainCheckOut = $out_quantity - $quantity;
		$sql = "update check_out_history set out_quantity = '$remainCheckOut' where check_out_history_id = '$check_out_history_id'";
		$this->db->query($sql, $data);


		$sql = "select * from inventory where inventory_id = '$inventory_id'";
		$product_quantity = $this->db->query($sql,array($inventory_id))->row()->ck_in_qty;

		$remainQuantity = $product_quantity+ $quantity; 

		$sql = "update inventory set ck_in_qty = '$remainQuantity' where inventory_id = '$inventory_id'";
		if($this->db->query($sql, $data)){
			$sql = "insert into check_in_history(check_out_history_id, in_quantity, in_date, client_id, client_id2, product_id, inventory_id,user_id, user_name, status, remarks) values(?,?,?,?,?,?,?,?,?,?,?)";		

			if($this->db->query($sql, $data)){
				$insert_id = $this->db->insert_id();
				$product_approval_id = $approval_data['product_approval_id'];

				if($this->db->where('product_approval_id', $product_approval_id)->update('product_approval', $approval_data)) {
					return $insert_id;
				}

				else{
					return FALSE;
				}
			}
			else{
				return FALSE;
			}
		}

	}


/*	public function addUpdateInventory($inventory_data){
		$quantity=	$inventory_data['out_quantity'];
		$inventory_id =	$inventory_data['inventory_id'];

		$sql = "select * from inventory where inventory_id = '$inventory_id'";
		$product_quantity = $this->db->query($sql,array($product_id))->row()->quantity;

		$remainQuantity = $product_quantity- $quantity; 

		$sql = "update inventory set quantity = '$remainQuantity' where inventory_id = '$inventory_id'";
		if($this->db->query($sql,$inventory_data)){
			return true;
		}
		else{
			return false;
		}
	}*/

}
?>
