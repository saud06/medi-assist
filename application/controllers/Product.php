<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('log_model');
	}
	public function index(){

	}
	public function local_list($char = NULL){
		//get all product details to display list
		if($char){
			$data['data'] = $this->product_model->getProducts($char);
			$data['approval_client'] = $this->product_model->getApprovalClient();
			$data['user'] = $this->product_model->getUser();
			$this->load->view('product/local_list', $data);
		}
		else{
			$this->load->view('product/local_list');
		}
	}
	public function other_list($char = NULL){
		//get all product details to display list
		if($char){
			$data['data'] = $this->product_model->getProducts($char);
			$data['user'] = $this->product_model->getUser();
			$this->load->view('product/other_list', $data);
		}
		else{
			$this->load->view('product/other_list');
		}
	}
	public function add_approval(){
		$product_id = $this->input->post('product_id');
		$client_id = $this->input->post('client_id');
		$approval_clients = $this->input->post('approval_clients');
		$approval_clients = implode(',', $approval_clients);
		
		$data = array(
					"product_id" 		=> $product_id,
					"client_id"			=> $client_id,
					"approval_clients" 	=> $approval_clients,
					"user_id" 			=> $this->session->userdata('user_id')
		);

		if($this->product_model->addApproval($data)){
			echo json_encode(array("status" => TRUE));
		}
	}
	public function prod_approve_status(){
		$product_id = $this->input->post('product_id');
		$approval_status = $this->input->post('approval_status');

		$data = array(
					"product_id" 		=> $product_id,
					"approval_status" 	=> $approval_status,
					"user_id" 			=> $this->session->userdata('user_id')
		);

		if($this->product_model->prodApproveStatus($data)){
			echo json_encode(array("status" => TRUE));
		}
	}
	public function add_approval_status(){
		$product_id = $this->input->post('product_id');
		$client_id = $this->input->post('client_id');
		$approval_status = $this->input->post('approval_status');
		
		$data = array(
					"product_id" 		=> $product_id,
					"client_id"			=> $client_id,
					"approval_status" 	=> $approval_status,
					"user_id" 			=> $this->session->userdata('user_id')
		);

		if($this->product_model->addApprovalStatus($data)){
			echo json_encode(array("status" => TRUE));
		}
	}
	public function product_approval_list($client_id, $product_id){
		//get all product approval details to display list
		$data = $this->product_model->getApprovedProducts($client_id, $product_id);

		echo json_encode($data);
	}
	public function edit_approval_status(){
		$data = array(
					"product_approval_id" 	=> $this->input->post('product_approval_id'),
					"approval_status"		=> $this->input->post('approval_status'),
					"user_id" 				=> $this->session->userdata('user_id')
		);

		if($this->product_model->editApprovalStatus($data)){
			echo json_encode(array("status" => TRUE));
		}
	}
	/*
		generate product list pdf
	*/
	public function list_pdf($type, $char, $category_name){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'product_list';
		$data['category_name'] = $category_name;
		$data['data'] = $this->product_model->getProducts($char);
		$data['user'] = $this->product_model->getUser();
		if($type == 'local'){
			$html = $this->load->view('product/local_list_pdf',$data,true);
		}
		else{
			$html = $this->load->view('product/other_list_pdf',$data,true);
		}

        include(APPPATH.'third_party/mpdf/vendor/autoload.php');
        ini_set("memory_limit","256M");
		$mpdf = new \Mpdf\Mpdf();

        $mpdf->packTableData = true;
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name.'.pdf','I');
	}
	/*
		get filtered products
	*/
	public function filter_product($char){
		$client_type = $this->input->post('client_type');
		$category_id = $this->input->post('category_id');
		$sub_category_id = $this->input->post('sub_category_id');
		$client_id = $this->input->post('client_id');
		$user_id = $this->input->post('user_id');
		$status = $this->input->post('status');

		if($sub_category_id == 0) $sub_category_id = '';
		if($client_id == 0) $client_id = '';
		if($user_id == 0) $user_id = '';
		if($status == '0') $status = '';

		$data['data'] = $this->product_model->getFilteredProduct($char, $category_id, $sub_category_id, $client_id, $user_id, $status);

		foreach ($data['data'] as $key => $product){
	        $var = $product->client_id;
	        $client_idd = explode(",", $var);

	        if($client_type == "local"){
		        $clients = $this->db->select('*')
		        					->where_in('client_id', $client_idd)
		        					->where('client_type_id', 1)
		        					->get('client')->result();
		    }
		    else{
		    	$clients = $this->db->select('*')
		        					->where_in('client_id', $client_idd)
		        					->group_start()
		        					->where('client_type_id', 2)
		        					->or_where('client_type_id', 3)
		        					->or_where('client_type_id', 4)
		        					->group_end()
		        					->get('client')->result();
		    }

			$data['data'][$key]->clients = $clients;
		    $data['data'][$key]->users = $this->product_model->getUser();

		    /*$approvals_arr = [];
		    foreach ($clients as $ckey => $value){
			    $this->db->select('*')
	                     ->where('product_id', $product->product_id)
	                     ->where('client_id', $value->client_id);
	            $approvals = $this->db->limit(1)->get('product_approval_status')->result_array();
	            array_push($approvals_arr, $approvals[0]['approval_status']);
	        }

	        $data['data'][$key]->approvals = $approvals_arr;*/

		    $this->db->select('ch.client_id, cl.company_name, SUM(ch.out_quantity) AS out_quantity')
                     ->where('ch.product_id', $product->product_id)
                     ->join('client cl', 'ch.client_id = cl.client_id')
                     ->group_by('ch.client_id');
            
            $data['data'][$key]->check_outs = $this->db->get('check_out_history ch')->result_array();

            $this->db->select('a.*, p.product_id')
                     ->where('a.product_id', $product->product_id)
                     ->join('products p', 'a.product_id = p.product_id');
            
            $data['data'][$key]->approvals = $this->db->get('prod_approve_status a')->result_array();
		}
		
		echo json_encode($data);
	}
	/*
		filter product pdf
	*/
	public function filterProductPDF($char, $client_type, $category_id, $sub_category_id, $client_id, $user_id, $status){
		if($sub_category_id == 0) $sub_category_id = '';
		if($client_id == 0) $client_id = '';
		if($user_id == 0) $user_id = '';
		if($status == '0') $status = '';

		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered product record and display list
		$sql = "SELECT category_name FROM category WHERE category_id = '$category_id'";
        $category_name = $this->db->query($sql,array($category_id))->row()->category_name;

		$data['category_name'] = $category_name;
		$data['client_id'] = $client_id;
		$data['data'] = $this->product_model->getFilteredProduct($char, $category_id, $sub_category_id, $client_id, $user_id, $status);

		foreach ($data['data'] as $key => $product){
	        $var = $product->client_id;
	        $client_idd = explode(",", $var);

	        if($client_type == "local"){
		        $clients = $this->db->select('*')
		        					->where_in('client_id', $client_idd)
		        					->where('client_type_id', 1)
		        					->get('client')->result();
		    }
		    else{
		    	$clients = $this->db->select('*')
		        					->where_in('client_id', $client_idd)
		        					->group_start()
		        					->where('client_type_id', 2)
		        					->or_where('client_type_id', 3)
		        					->or_where('client_type_id', 4)
		        					->group_end()
		        					->get('client')->result();
		    }

			$data['data'][$key]->clients = $clients;
		    $data['data'][$key]->users = $this->product_model->getUser();

		    $approvals_arr = [];
		    foreach ($clients as $ckey => $value){
			    $this->db->select('*')
	                     ->where('product_id', $product->product_id)
	                     ->where('client_id', $value->client_id);
	            $approvals = $this->db->limit(1)->get('product_approval_status')->result_array();
	            array_push($approvals_arr, $approvals[0]['approval_status']);
	        }

	        $data['data'][$key]->approvals = $approvals_arr;

		    $this->db->select('ch.client_id, cl.company_name, SUM(ch.out_quantity) AS out_quantity')
                     ->where('ch.product_id', $product->product_id)
                     ->join('client cl', 'ch.client_id = cl.client_id')
                     ->group_by('ch.client_id');
            
            $data['data'][$key]->check_outs = $this->db->get('check_out_history ch')->result_array();
		}

		$file_name = 'product_list';
		if($client_type == 'local'){
			$html = $this->load->view('product/filtered_local_list_pdf',$data,true);
		}
		else{
			$html = $this->load->view('product/filtered_other_list_pdf',$data,true);
		}
		
		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
        ini_set("memory_limit","256M");
		$mpdf = new \Mpdf\Mpdf();
		
        $mpdf->packTableData = true;
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name.'.pdf','I');
	}
	/*
		find product in inventory
	*/
	public function find_in_inventory(){
		$product_id = $this->input->post('product_id');

		$data['data'] = $this->product_model->findProductInInventory($product_id);
		
		echo json_encode($data);
	}
	/* 
		call add view to add product record 
	*/
		public function add(){
			$data['code'] = $this->product_model->createCode();
			$data['category'] = $this->product_model->getCategory();
			$data['client1'] = $this->product_model->getClient1();
			$data['client2'] = $this->product_model->getClient2();
			$this->load->view('product/add',$data);
		}
		
	/* 
		This function used when category is change subcategory list change  
	*/
		public function getSubcategory($id){
			$data = $this->product_model->selectSubcategory($id);
			echo json_encode($data);
		}
	/*

	*/
	public function getHsnData($id){
		$data = $this->product_model->getHsnData($id);
		echo json_encode($data);
	}


	public function getClient($id){
		$data = $this->product_model->getClient($id);
		echo json_encode($data);
	}
	/* 
		This function is used to add product record in database 
	*/
		public function addProduct(){
			$this->load->helper('security');
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|callback_alpha_dash_space|xss_clean');
			$this->form_validation->set_rules('category', 'Category', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('type_id', 'Type', 'trim|required|numeric|xss_clean');

			if ($this->form_validation->run() == FALSE)
			{
				$this->add();
			}
			else
			{
				if($_FILES["image"]["name"]){
					$type = explode('.',$_FILES["image"]["name"]);
					$type = $type[count($type)-1];
					$url = "assets/images/product/".uniqid(rand()).'.'.$type;

					if(in_array($type,array("jpg","jpeg","gif","png"))){

						if(is_uploaded_file($_FILES["image"]["tmp_name"])){

							if(move_uploaded_file($_FILES["image"]["tmp_name"],$url)){

							}
						}	
					}
				}
				else{
					$url = "assets/images/product/no_image.jpg";
				}
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');

				if(!$this->input->post('subcategory')){
					$sub_category_id = 1;
				}
				else{
					$sub_category_id = $this->input->post('subcategory');
				}

				if(!$this->input->post('email')){
					$client_email = '';
				}
				else{
					$client_email = implode(",", $this->input->post('email'));
				}

				if($this->input->post('client1')) $client_id1 = implode(",", $this->input->post('client1'));
				else $client_id1 = '';

				if($this->input->post('client2')) $client_id2 = implode(",", $this->input->post('client2'));
				else $client_id2 = '';

				if($client_id1 == '') $client_id = $client_id2;
				else $client_id = $client_id1 . ',' . $client_id2;

				$data = array(
					"code"           => $this->input->post('code'),
					"name"           => $this->input->post('name'),
					"unit_id"        =>0,
					"size"           =>0,
					"cost"           =>0,
					"price"          =>0,
					"alert_quantity" => 0,				
					"image"          => base_url().''.$url,
					"category_id"    => $this->input->post('category'),
					"subcategory_id" => $sub_category_id,
					"quantity"       => 0,	
					"details"        => $this->input->post('note'),
					"is_inventory"        => $this->input->post('is_inventory'),
					"product_status" => $this->input->post('confirm'),
					"client_id"	=>	$client_id,
					"client_email"	=>	$client_email,
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime,
					"last_update_by" => $this->session->userdata('user_id'),
					"last_update_date" => $datetime
				);

				$approval_data = array(
					"approval_status" => $this->input->post('approve_status'),
					"approved_by" => $this->session->userdata('user_id')
				);

				if($id = $this->product_model->addModel($data, $approval_data)){ 
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Product Inserted'
					);
					$this->log_model->insert_log($log_data);
					redirect('product/add','refresh');
				}
				else{
					$this->session->set_flashdata('fail', 'Product can not be Inserted.');
					redirect('product/add','refresh');
				}
			}
		}
	/*
		call edit view to edit product record 
	*/
		public function edit($type_id, $id){
			$data['data']        = $this->product_model->getRecord($id);
			$data['category']    = $this->product_model->getCategory();
			$data['subcategory'] = $this->product_model->getSubcategory($id);
			$data['unit']	  = $this->product_model->getUnit();	
			$data['client1']	  = $this->product_model->getClient1();
			$data['client2']	  = $this->product_model->getClient2();
			$data['client_cat']  = $this->product_model->getClientMultiple();
			$data['type_id']  = $type_id;
			$this->load->view('product/edit',$data);
		}
	/* 
		This function is used to edit product in database 
	*/
		public function editProduct(){
			$id = $this->input->post('id');
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
			$this->form_validation->set_rules('category', 'Category', 'trim|required|numeric');
			//$this->form_validation->set_rules('subcategory', 'Subcategory', 'trim|required|numeric');

			if ($this->form_validation->run() == FALSE)
			{
				$this->edit($id);
			}
			else
			{
				if($_FILES["image"]["name"] == null){
					$url = $this->input->post('hidden_image');
				}
				else{
					$type = explode('.',$_FILES["image"]["name"]);
					$type = $type[count($type)-1];
					$url = "assets/images/product/".uniqid(rand()).'.'.$type;

					if(in_array($type,array("jpg","jpeg","gif","png"))){

						if(is_uploaded_file($_FILES["image"]["tmp_name"])){

							if(move_uploaded_file($_FILES["image"]["tmp_name"],$url)){
								$url = base_url().''.$url;	
							}
						}	
					}
				}

				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');

				if(!$this->input->post('subcategory')){
					$sub_category_id = 1;
				}
				else{
					$sub_category_id = $this->input->post('subcategory');
				}

				$data = array(
					"code"           => $this->input->post('code'),
					"name"           => $this->input->post('name'),
					"unit_id"        => 0,
					"size"           => 0,
					"cost"           => 0,
					"price"          => 0,
					"alert_quantity" => 0,				
					"image"          => $url,
					"category_id"    => $this->input->post('category'),
					"subcategory_id" => $sub_category_id,					
					"quantity"       => 0,	
					"details"        => $this->input->post('note'),
					"is_inventory"        => $this->input->post('is_inventory'),
					"product_status" => $this->input->post('confirm'),
					"client_id"	=>	implode(",", $this->input->post('client_cat')),
					"client_email"	=>	implode(",", $this->input->post('email')),
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime,
					"last_update_by" =>  $this->session->userdata('user_id'),
					"last_update_date" =>  $datetime
				);

				$approval_data = array(
					"product_id" => $id,
					"approval_status" => $this->input->post('approve_status'),
					"approved_by" => $this->session->userdata('user_id')
				);

				if($this->product_model->editModel($data,$approval_data,$id)){ 
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Product Updated'
					);
					$this->log_model->insert_log($log_data);
					if($this->input->post('type_id') == 1){
						redirect('product/local_list','refresh');
					}
					else{
						redirect('product/other_list','refresh');
					}
				}
				else{
					$this->session->set_flashdata('fail', 'Product can not be Updated.');
					if($this->input->post('type_id') == 1){
						redirect('product/local_list','refresh');
					}
					else{
						redirect('product/other_list','refresh');
					}
				}
			}
		}
		/* 
			This function is used to delete product record in databse 
		*/
		public function DeleteMul(){
			$selected_id = $this->input->post('selected_id');

			if(!empty($selected_id)){
				if($this->product_model->DeleteMul($selected_id)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => '',
						'message'  => 'Multiple Product Deleted'
					);
					$this->log_model->insert_log($log_data);
					redirect('product','refresh');
				}
				else{
					$this->session->set_flashdata('fail', 'Product can not be Deleted.');
					redirect("product",'refresh');
				}
			}
			else{
				$this->session->set_flashdata('fail', 'Nothing Selected.');
				redirect("product",'refresh');
			}
		}

		public function delete($type_id, $id){
			if($this->product_model->deleteModel($id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Product Deleted'
				);
				$this->log_model->insert_log($log_data);
				if($type_id == 1){
						redirect('product/local_list','refresh');
					}
					else{
						redirect('product/other_list','refresh');
					}
			}
			else{
				$this->session->set_flashdata('fail', 'Product can not be Deleted.');
				if($type_id == 1){
						redirect('product/local_list','refresh');
					}
					else{
						redirect('product/other_list','refresh');
					}
			}
		}
	/*
		this function call CSV file view
	*/
		public function import(){
			$data['category'] = $this->product_model->getCategory();
			$this->load->view('product/import',$data);
		}
	/*
		this  function get csv file data
	*/
		public function import_csv(){

			$category_id = $this->input->post('category');
			$subcategory_id = $this->input->post('subcategory');
			$filename=$_FILES["csv"]["tmp_name"];      

			if($_FILES["csv"]["size"] > 0)
			{
				$file = fopen($filename, "r");

				for ($lines = 0; $data = fgetcsv($file,1000,",",'"'); $lines++) 
				{
					if ($lines == 0) continue;

					$sql = "INSERT INTO `products`(`category_id`,`subcategory_id`,`code`, `name`, `hsn_sac_code`, `unit`, `size`, `cost`, `price`, `alert_quantity`, `details`) VALUES ($category_id,$subcategory_id,'".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."')";
					$this->db->query($sql);
				}
				fclose($file); 
			}
			else{
				redirect("product/import",'refresh'); 
			}
			redirect('product','refresh');
		}
		function code_exists($code) {
			if($this->product_model->codeExist($code)){
				$this->form_validation->set_message('code_exists', 'Code Already Exist');
				return false;
			}
			else{
				return true;
			}
		}
		function alpha_dash_space($str) {
			if (! preg_match("/^([-a-zA-Z0-9_ ])+$/i", $str))
			{
				$this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha-numeric characters, spaces, underscores, and dashes.');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	} 
	?>