<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class inventory extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('inventory_model');
		$this->load->model('sales_model');
		$this->load->model('log_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	public function index($product_id = NULL){
		$data['data'] = $this->inventory_model->getinventory();
		$data['client']	= $this->inventory_model->getClient();
		$data['reference_no'] = $this->inventory_model->createReferenceNo();
		$data['categories'] = $this->inventory_model->getCategories();
		$data['subcategories'] = $this->inventory_model->getSubCategories();

		if($product_id){
			$data['product_id'] = $product_id;
		}
		
		$this->load->view('inventory/list',$data);
	}

	/*
		generate inventory item list pdf
	*/
	public function list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'inventory_item_list';
		$data['data'] = $this->inventory_model->getinventory();
		$data['client']	= $this->inventory_model->getClient();
		$data['reference_no'] = $this->inventory_model->createReferenceNo();
		$html = $this->load->view('inventory/list_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name.'.pdf','I');
	}

	public function filter_inventory_item(){
		$category_id = $this->input->post('category_id');
		if($category_id == '0') $category_id = '';
		
		$sub_category_id = $this->input->post('sub_category_id');
		if($sub_category_id == '0') $sub_category_id = '';

		$data['data'] = $this->inventory_model->getFilteredInventoryItem($category_id, $sub_category_id);

		foreach ($data['data'] as $key => $row){
			// category name
			$category_id = $row->category_id;
            $this->db->where('category_id', $category_id);
            $cat_id = $this->db->get('products')->result_array();
            $var = $cat_id[0]['category_id'];
            $cat_idd = explode(",", $var);

            foreach ($cat_idd as $value) {
              $this->db->where('category_id', $value);
              $cat_name = $this->db->get('category')->result_array();
              $data['data'][$key]->category_name = $cat_name[0]['category_name'];
            }

            //subcategory name
            $sub_category_id = $row->subcategory_id;
            $this->db->where('subcategory_id', $sub_category_id);
            $sub_cat_id = $this->db->get('products')->result_array();
            $var = $sub_cat_id[0]['subcategory_id'];
            $sub_cat_idd = explode(",", $var);
            foreach ($sub_cat_idd as $value) {
              $this->db->where('sub_category_id', $value);
              $sub_cat_name = $this->db->get('sub_category')->result_array();
              $data['data'][$key]->sub_category_name = $sub_cat_name[0]['sub_category_name'];
            }

            // client name
            $client_id = $row->client_id;
            $client_idd = explode(",", $client_id);
	        $clients = $this->db->select('company_name')
	        					->where_in('client_id', $client_idd)
	        					->get('client')->result();
			$data['data'][$key]->client_name = $clients;
		}
		
		echo json_encode($data);
	}

	public function filter_stock_record(){
		$category_id = $this->input->post('category_id');
		if($category_id == '0') $category_id = '';
		
		$sub_category_id = $this->input->post('sub_category_id');
		if($sub_category_id == '0') $sub_category_id = '';

		$data['data'] = $this->inventory_model->getFilteredStockRecord($category_id, $sub_category_id);

		foreach ($data['data'] as $key => $row){
			// category name
			$category_id = $row->category_id;
            $this->db->where('category_id', $category_id);
            $cat_id = $this->db->get('products')->result_array();
            $var = $cat_id[0]['category_id'];
            $cat_idd = explode(",", $var);

            foreach ($cat_idd as $value) {
              $this->db->where('category_id', $value);
              $cat_name = $this->db->get('category')->result_array();
              $data['data'][$key]->category_name = $cat_name[0]['category_name'];
            }

            //subcategory name
            $sub_category_id = $row->subcategory_id;
            $this->db->where('subcategory_id', $sub_category_id);
            $sub_cat_id = $this->db->get('products')->result_array();
            $var = $sub_cat_id[0]['subcategory_id'];
            $sub_cat_idd = explode(",", $var);
            foreach ($sub_cat_idd as $value) {
              $this->db->where('sub_category_id', $value);
              $sub_cat_name = $this->db->get('sub_category')->result_array();
              $data['data'][$key]->sub_category_name = $sub_cat_name[0]['sub_category_name'];
            }

            // client name
            $client_id = $row->client_id;
            $client_idd = explode(",", $client_id);
	        $clients = $this->db->select('company_name')
	        					->where_in('client_id', $client_idd)
	        					->get('client')->result();
			$data['data'][$key]->client_name = $clients;
		}
		
		echo json_encode($data);
	}

	public function filter_check_out_history(){
		$category_id = $this->input->post('category_id');
		if($category_id == '0') $category_id = '';
		
		$sub_category_id = $this->input->post('sub_category_id');
		if($sub_category_id == '0') $sub_category_id = '';

		$data['data'] = $this->inventory_model->getFilteredCheckOutHistory($category_id, $sub_category_id);

		foreach ($data['data'] as $key => $row){
			// category name
			$category_id = $row->category_id;
            $this->db->where('category_id', $category_id);
            $cat_id = $this->db->get('products')->result_array();
            $var = $cat_id[0]['category_id'];
            $cat_idd = explode(",", $var);

            foreach ($cat_idd as $value) {
              $this->db->where('category_id', $value);
              $cat_name = $this->db->get('category')->result_array();
              $data['data'][$key]->category_name = $cat_name[0]['category_name'];
            }

            //subcategory name
            $sub_category_id = $row->subcategory_id;
            $this->db->where('subcategory_id', $sub_category_id);
            $sub_cat_id = $this->db->get('products')->result_array();
            $var = $sub_cat_id[0]['subcategory_id'];
            $sub_cat_idd = explode(",", $var);
            foreach ($sub_cat_idd as $value) {
              $this->db->where('sub_category_id', $value);
              $sub_cat_name = $this->db->get('sub_category')->result_array();
              $data['data'][$key]->sub_category_name = $sub_cat_name[0]['sub_category_name'];
            }
		}
		
		echo json_encode($data);
	}

	public function filter_check_in_history(){
		$category_id = $this->input->post('category_id');
		if($category_id == '0') $category_id = '';
		
		$sub_category_id = $this->input->post('sub_category_id');
		if($sub_category_id == '0') $sub_category_id = '';

		$data['data'] = $this->inventory_model->getFilteredCheckInHistory($category_id, $sub_category_id);

		foreach ($data['data'] as $key => $row){
			// category name
			$category_id = $row->category_id;
            $this->db->where('category_id', $category_id);
            $cat_id = $this->db->get('products')->result_array();
            $var = $cat_id[0]['category_id'];
            $cat_idd = explode(",", $var);

            foreach ($cat_idd as $value) {
              $this->db->where('category_id', $value);
              $cat_name = $this->db->get('category')->result_array();
              $data['data'][$key]->category_name = $cat_name[0]['category_name'];
            }

            //subcategory name
            $sub_category_id = $row->subcategory_id;
            $this->db->where('subcategory_id', $sub_category_id);
            $sub_cat_id = $this->db->get('products')->result_array();
            $var = $sub_cat_id[0]['subcategory_id'];
            $sub_cat_idd = explode(",", $var);
            foreach ($sub_cat_idd as $value) {
              $this->db->where('sub_category_id', $value);
              $sub_cat_name = $this->db->get('sub_category')->result_array();
              $data['data'][$key]->sub_category_name = $sub_cat_name[0]['sub_category_name'];
            }
		}
		
		echo json_encode($data);
	}

	public function filterInventoryItemPDF($category_id, $sub_category_id){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered inventory item record and display list
		$data['data'] = $this->inventory_model->getFilteredInventoryItem($category_id, $sub_category_id);
		$data['client']	= $this->inventory_model->getClient();
		$data['reference_no'] = $this->inventory_model->createReferenceNo();

		$file_name = 'inventory_item_list';
		$html = $this->load->view('inventory/list_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name.'.pdf','I');
	}

	public function filterStockRecordPDF($category_id, $sub_category_id){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered stock record and display list
		$data['data'] = $this->inventory_model->getFilteredStockRecord($category_id, $sub_category_id);
		$data['client']	= $this->inventory_model->getClient();
		$data['reference_no'] = $this->inventory_model->createReferenceNo();

		$file_name = 'stock_record_list';
		$html = $this->load->view('inventory/stock_record_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name.'.pdf','I');
	}
	
	public function filterCheckOutHistoryPDF($category_id, $sub_category_id){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered check out history record and display list
		$data['data'] = $this->inventory_model->getFilteredCheckOutHistory($category_id, $sub_category_id);
		$data['client']	= $this->inventory_model->getClient();

		$file_name = 'check_out_history';
		$html = $this->load->view('inventory/check_out_history_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name.'.pdf','I');
	}

	public function filterCheckInHistoryPDF($category_id, $sub_category_id){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered check in history record and display list
		$data['data'] = $this->inventory_model->getFilteredCheckInHistory($category_id, $sub_category_id);

		$file_name = 'check_in_history';
		$html = $this->load->view('inventory/check_in_history_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name.'.pdf','I');
	}

	public function get_product($product_id){
		$data['data'] = $this->inventory_model->getProduct($product_id);

		foreach ($data['data'] as $key => $product){
	        $var = $product->client_id;
	        $client_idd = explode(",", $var);
	 
	        $clients = $this->db->select('company_name')
	        					->where_in('client_id', $client_idd)
	        					->get('client')->result();

			$data['data'][$key]->clients = $clients;
		}
		
		echo json_encode($data);
	} 

	public function stock_record(){
		$data['data'] = $this->inventory_model->getStock();
		$data['client']	= $this->inventory_model->getClient();
		$data['reference_no'] = $this->inventory_model->createReferenceNo();
		$data['categories'] = $this->inventory_model->getCategories();
		$data['subcategories'] = $this->inventory_model->getSubCategories();
		
		$this->load->view('inventory/stock_record',$data);
	}

	/*
		generate stock record pdf
	*/
	public function stock_record_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'stock_record';
		$data['data'] = $this->inventory_model->getStock();
		$data['client']	= $this->inventory_model->getClient();
		$data['reference_no'] = $this->inventory_model->createReferenceNo();
		$html = $this->load->view('inventory/stock_record_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name.'.pdf','I');
	}

	public function check_out_history(){
		$data['data'] = $this->inventory_model->checkoutHistory();
		$data['client']	= $this->inventory_model->getClient();
		$data['categories'] = $this->inventory_model->getCategories();
		$data['subcategories'] = $this->inventory_model->getSubCategories();
		$this->load->view('inventory/check_out_history',$data);
	} 

	/*
		generate check out history pdf
	*/
	public function check_out_history_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'check_out_history';
		$data['data'] = $this->inventory_model->checkoutHistory();
		$data['client']	= $this->inventory_model->getClient();
		$html = $this->load->view('inventory/check_out_history_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name.'.pdf','I');
	}

	public function check_in_history(){
		$data['data'] = $this->inventory_model->checkInHistory();
		$data['categories'] = $this->inventory_model->getCategories();
		$data['subcategories'] = $this->inventory_model->getSubCategories();
		$this->load->view('inventory/check_in_history',$data);
	} 

	/*
		generate check in history pdf
	*/
	public function check_in_history_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'check_in_history';
		$data['data'] = $this->inventory_model->checkInHistory();
		$html = $this->load->view('inventory/check_in_history_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name.'.pdf','I');
	}

	public function view($id){
		$data['data'] = $this->inventory_model->getDetails($id);
		$this->load->view('inventory/view',$data);
	}

	public function check_out($id)
	{
		$data = $this->inventory_model->get_by_id($id);
		$sql = "SELECT * from inventory where inventory_id = '$id'";
		$product_id = $this->db->query($sql,array($id))->row()->product_id;
		$sql2 = "SELECT inventory.shelf_id, inventory.rack_id , (SUM(inventory.quantity) -((SUM(inventory.ck_out_qty))-(inventory.ck_in_qty))) as SUMQuantity from inventory where product_id = '$product_id' GROUP BY inventory.shelf_id, inventory.rack_id ";

		$data2 = $this->db->query($sql2,array($product_id))->row()->SUMQuantity;
		$data[0]->ProQuantity = $data2;

		$client_ids = $data[0]->client_id;
        $client_id = explode(",", $client_ids);
        
    	$clients = $this->db->select('client_id, company_name')
        					->where_in('client_id', $client_id)
        					->group_start()
        					->where('client_type_id', 2)
        					->or_where('client_type_id', 3)
        					->or_where('client_type_id', 4)
        					->group_end()
        					->get('client')->result();

		$data[0]->clients = $clients;

		echo json_encode($data);
	}

	public function check_in($id)
	{
		$data = $this->inventory_model->checkin_id($id);

        $client_id = $data[0]->client_id;
        $client_id2 = $data[0]->client_id2;
        $product_id = $data[0]->product_id;
        
    	$client_data = $this->db->select('a.*, c1.client_id AS client_id, c2.client_id AS client_id2, c1.company_name AS company_name, c2.company_name AS company_name2')
    						->from('product_approval a')
    						->join('client c1', 'a.client_id = c1.client_id')
    						->join('client c2', 'a.client_id2 = c2.client_id')
    						->join('products p', 'a.product_id = p.product_id')
    						->where('a.client_id', $client_id)
    						->where('a.client_id2', $client_id2)
    						->where('a.product_id', $product_id)
        					->get()->result();

		$data[0]->client_data = $client_data;

		echo json_encode($data);
	}

	public function saud($id)
	{
		$data = $this->inventory_model->checkOutClient($id);
		echo json_encode($data);
		/*$data['client'] = $this->inventory_model->client_id($id);*/
	}

	public function checkOutQuantity($id){
		$data = $this->inventory_model->checkOutQuantity($id);
		echo json_encode($data);
	}

	public function client_data($client_id){
		$data['data'] = $this->inventory_model->client_data($client_id);
		echo json_encode($data);
	}

	public function sales(){
		$selected_products = [];
		foreach ($this->input->post('selected_id') as $i => $product) {
			$data = explode(',', $product);

			$product_obj = (object) array(
				'product_id' => $data[0],
				'code' => $data[1],
				'name' => $data[2],
				'shelf_id' => $data[3],
				'rack_id' => $data[4],
				'quantity' => $data[5]
			);

			array_push($selected_products, $product_obj);
		}
		
		$data['client_id'] = $this->input->post('client_id');
		$data['reference_no'] = $this->inventory_model->createReferenceNoSales();
		$data['selected_product'] = $selected_products;

		//Sales model (loaded initially at construct)
		$data['client'] = $this->sales_model->getClient();
		$data['product'] = $this->sales_model->getProduct();
		$data['couriers'] = $this->sales_model->getCouriers();
		$data['currency'] = $this->sales_model->getCurrency();
		$data['users'] = $this->sales_model->getUsers();

		//print_r($data);
		$this->load->view('sales/add', $data);
	}


	/*public function check_out_history(){
		if ($this->form_validation->run() == FALSE)
		{
			$this->check_out($id);
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');
			$data = array(
				"inventory_id" => 0,
				"out_quantity" => $this->input->post('out_quantity'),
				"client_id" => 0,
				"product_id" =>$this->input->post('product_id'),				
				"out_date" => $datetime,
				"user_id" => $this->session->userdata('user_id'),
				"remarks" => ""
			);

			if($id = $this->inventory_model->addCheckOut($data)){ 
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Checkout history Inserted'
				);
				$this->log_model->insert_log($log_data);
				redirect('inventory','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Checkout history can not be Inserted.');
				redirect("inventory",'refresh');
			}
		}
	}*/

	public function ckh_add()
	{
		date_default_timezone_set('Asia/Dhaka');
		$datetime = date('Y-m-d H:i:s');

		$email = $this->input->post('email');

		$data = array(
			"inventory_id" => $this->input->post('inventory_id'),
			"out_quantity" => $this->input->post('out_quantity'),
			"client_id" => $this->input->post('client_id'),
			"client_id2" => $this->input->post('client_id2'),
			"product_id" =>$this->input->post('product_id'),
			"out_date" => $datetime,
			"user_id" => $this->session->userdata('user_id'),
			"user_name" => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
			"remarks" => $this->input->post('remarks'),
			"reference_no" => $this->input->post('reference_no')
		);

		$approval_data = array(
			"inventory_id" => $this->input->post('inventory_id'),
			"out_quantity" => $this->input->post('out_quantity'),
			"client_id" => $this->input->post('client_id'),
			"client_id2" => $this->input->post('client_id2'),
			"product_id" => $this->input->post('product_id'),
			"approval_status" => 'Pending',
			"user_id" => $this->session->userdata('user_id')
		);

		$insert = $this->inventory_model->addCheckOut($data, $approval_data);

		echo json_encode(array("status" => TRUE, "email" => $email));
	}


	public function checkin_add()
	{
		date_default_timezone_set('Asia/Dhaka');
		$datetime = date('Y-m-d H:i:s');
		$data = array(
			"check_out_history_id" =>$this->input->post('check_out_history_id'),
			"in_quantity" => $this->input->post('in_quantity'),
			"in_date" => $datetime,			
			"client_id" => $this->input->post('client_id'),
			"client_id2" => $this->input->post('client_id2'),
			"product_id" =>$this->input->post('product_id'),
			"inventory_id" => $this->input->post('inventory_id'),
			"user_id" => $this->session->userdata('user_id'),
			"user_name" => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
			"status" => $this->input->post('status'),
			"remarks" => $this->input->post('remarks')
		);

		$approval_data = array(
			"product_approval_id" => $this->input->post('product_approval_id'),
			"approval_status" => $this->input->post('approval_status'),
			"user_id" => $this->session->userdata('user_id')
		);

		$insert = $this->inventory_model->addCheckIn($data, $approval_data);
		echo json_encode(array("status" => TRUE));
	}
}
?>