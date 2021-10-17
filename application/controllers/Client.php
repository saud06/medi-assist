<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('client_model');
		$this->load->model('log_model');
	}
	public function index(){
		//get all client records to display list
		$data['data'] = $this->client_model->getClient();
		$this->load->view('client/list',$data);
	}
	/*
		generate client list pdf
	*/
	public function list_pdf($type){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'client_list';
		$data['type'] = $type;
		$data['data'] = $this->client_model->getClient();
		$html = $this->load->view('client/list_pdf',$data,true);

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
	/*
		get filtered clients
	*/
	public function filter_client(){
		$client_id = $this->input->post('client_id');
		$category_id = $this->input->post('category_id');
		$user_id = $this->input->post('user_id');
		$status = $this->input->post('status');
		if($client_id == 0) $client_id = '';
		if($category_id == 0) $category_id = '';
		if($user_id == 0) $user_id = '';
		if($status == '0') $status = '';

		$data['data'] = $this->client_model->getFilteredClient($client_id, $category_id, $user_id, $status);

		foreach ($data['data'] as $key => $client){
			$var = $client->category_id;
	        $category_id = explode(",", $var);

	        $categories = $this->db->select('category_id, category_name')
		        					->where_in('category_id', $category_id)
		        					->get('category')->result();

		    $data['data'][$key]->categories = $categories;

		    $var2 = $client->responsible_person_id;
	        $responsible_person_id = explode(",", $var2);

	        $responsible_persons = $this->db->select('id, first_name, last_name')
		        					->where_in('id', $responsible_person_id)
		        					->get('users')->result();

		    $data['data'][$key]->responsible_persons = $responsible_persons;
		}
		
		echo json_encode($data);
	}
	/*
		filter client pdf
	*/
	public function filterClientPDF2($client_id, $category_id, $user_id, $status){
		if($client_id == 0) $country_id = '';
		if($category_id == 0) $category_id = '';
		if($user_id == 0) $user_id = '';
		if($status == '0') $status = '';

		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered client record and display list
		$data['type'] = 2;
		$data['data'] = $this->client_model->getFilteredClient($client_id, $category_id, $user_id, $status);

		foreach ($data['data'] as $key => $client){
			$var = $client->category_id;
	        $category_id = explode(",", $var);

	        $categories = $this->db->select('category_id, category_name')
		        					->where_in('category_id', $category_id)
		        					->get('category')->result();

		    $data['data'][$key]->categories = $categories;

		    $var2 = $client->responsible_person_id;
	        $responsible_person_id = explode(",", $var2);

	        $responsible_persons = $this->db->select('id, first_name, last_name')
		        					->where_in('id', $responsible_person_id)
		        					->get('users')->result();

		    $data['data'][$key]->responsible_persons = $responsible_persons;
		}

		$file_name = 'bd_customer_list';
		$html = $this->load->view('client/list_pdf',$data,true);

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
	/*
		get filtered clients 2
	*/
	public function filter_client2(){
		$country_id = $this->input->post('country_id');
		$category_id = $this->input->post('category_id');
		$user_id = $this->input->post('user_id');
		$status = $this->input->post('status');
		if($country_id == 0) $country_id = '';
		if($category_id == 0) $category_id = '';
		if($user_id == 0) $user_id = '';
		if($status == '0') $status = '';

		$data['data'] = $this->client_model->getFilteredClient2($country_id, $category_id, $user_id, $status);

		foreach ($data['data'] as $key => $client){
			$var = $client->category_id;
	        $category_id = explode(",", $var);

	        $categories = $this->db->select('category_id, category_name')
		        					->where_in('category_id', $category_id)
		        					->get('category')->result();

		    $data['data'][$key]->categories = $categories;

		    $var2 = $client->responsible_person_id;
	        $responsible_person_id = explode(",", $var2);

	        $responsible_persons = $this->db->select('id, first_name, last_name')
		        					->where_in('id', $responsible_person_id)
		        					->get('users')->result();

		    $data['data'][$key]->responsible_persons = $responsible_persons;
		}
		
		echo json_encode($data);
	}
	/*
		filter client pdf
	*/
	public function filterClientPDF($country_id, $category_id, $user_id, $status){
		if($country_id == 0) $country_id = '';
		if($category_id == 0) $category_id = '';
		if($user_id == 0) $user_id = '';
		if($status == '0') $status = '';

		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered client record and display list
		$data['type'] = 1;
		$data['data'] = $this->client_model->getFilteredClient2($country_id, $category_id, $user_id, $status);

		foreach ($data['data'] as $key => $client){
			$var = $client->category_id;
	        $category_id = explode(",", $var);

	        $categories = $this->db->select('category_id, category_name')
		        					->where_in('category_id', $category_id)
		        					->get('category')->result();

		    $data['data'][$key]->categories = $categories;

		    $var2 = $client->responsible_person_id;
	        $responsible_person_id = explode(",", $var2);

	        $responsible_persons = $this->db->select('id, first_name, last_name')
		        					->where_in('id', $responsible_person_id)
		        					->get('users')->result();

		    $data['data'][$key]->responsible_persons = $responsible_persons;
		}

		$file_name = 'manufacturer_and_supplier_list';
		$html = $this->load->view('client/list_pdf',$data,true);

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
	/*
		get all state of country
	*/
	public function getState($id){
		$data = $this->client_model->getState($id);
		echo json_encode($data);
	}
	/*
		get all city of state
	*/
	public function getCity($id){
		$data = $this->client_model->getCity($id);
		echo json_encode($data);
	}
	/* 
		Delete selected  Client Record 
	*/
	public function delete($id){
		if($this->client_model->deleteModel($id)){
			$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Client Deleted'
					);
				$this->log_model->insert_log($log_data);
			redirect('client','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Client can not be Deleted.');
			//redirect("client",'refresh');
		}
	}
	/* 
		Delete selected  Client Type Record 
	*/
	public function deleteType($id){
		if($this->client_model->deleteTypeModel($id)){
			$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Client Type Deleted'
					);
				$this->log_model->insert_log($log_data);
			redirect('client/type','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Client Type can not be Deleted.');
			redirect("client/type",'refresh');
		}
	}
	/* 
		call add view to add client record 
	*/
	public function add(){
		$data['country']  = $this->client_model->getCountry();
		$data['client_type']  = $this->client_model->getClientType();
		$data['client_cat']  = $this->client_model->getClientCat();
		$data['user']  = $this->client_model->getUser();
		$this->load->view('client/add',$data);
	}
	/* 
		call add view to add client type record 
	*/
	public function addType(){
		$this->load->view('client/addType');
	}
	/* 
		call edit view to edit client record 
	*/
	public function edit($id){
		$data['data'] = $this->client_model->getRecord($id);
		$data['country']  = $this->client_model->getCountry();
		$data['state'] = $this->client_model->getState($data['data'][0]->country_id);
		$data['city'] = $this->client_model->getCity($data['data'][0]->state_id);
		$data['client_type']  = $this->client_model->getClientType();
		$data['client_cat']  = $this->client_model->getClientCat();
		$data['user']  = $this->client_model->getUser();
		$data['kind_att']  = $this->client_model->getKindAtt($id);
		$this->load->view('client/edit',$data);
	}
	/* 
		get all client type
	*/
	public function type(){
		$data['data'] = $this->client_model->getClientType();
		$this->load->view('client/type',$data);
	}
	/* 
		call edit view to edit client type record 
	*/
	public function editType($id){
		$data['data'] = $this->client_model->getTypeRecord($id);
		$this->load->view('client/editType',$data);
	}
	/* 
		This function used to add record in database 
	*/
	public function addClient(){
		$this->form_validation->set_rules('company_name','Company Name','trim|required|min_length[3]|callback_alpha_dash_space1');
		/*$this->form_validation->set_rules('contact_person','Contact Person Name','trim|required|min_length[3]|callback_alpha_dash_space1');
		$this->form_validation->set_rules('contact_person_phone', 'Contact Person Phone', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');*/
		$this->form_validation->set_rules('client_type', 'Client Type', 'trim|required');
		/*if($this->input->post('country') == 18){
			$this->form_validation->set_rules('loc_city', 'Local City', 'trim|required');
		}
		else{
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'State', 'trim|required');
		}*/
		$this->form_validation->set_rules('country', 'Country', 'trim|required');

		if($this->form_validation->run()==false){
			$this->add();
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');

        	if($this->input->post('country') == 18){
        		$state_id = 348;
        		$city_id = 491;
        		$loc_city = $this->input->post('loc_city');
        		$loc_area = $this->input->post('loc_area');
        	}
        	else{
        		$loc_city = NULL;
        		$loc_area = NULL;

        		if($this->input->post('state')){
        			$state_id = $this->input->post('state');
        		}
        		else{
        			$state_id = 4121;
        		}
        		
        		if($this->input->post('city')){
        			$city_id = $this->input->post('city');
        		}
        		else{
        			$city_id = 48316;
        		}
        	}

			$client_data = array(
						"company_name"	=>	$this->input->post('company_name'),
						"company_phone"	=>	$this->input->post('company_phone'),
						"contact_person"	=>	$this->input->post('contact_person'),
						"contact_person_phone"	=>	$this->input->post('contact_person_phone'),
						"email"		=>	$this->input->post('email'),
						"cc"		=>	$this->input->post('cc'),
						"bcc"		=>	$this->input->post('bcc'),
						"client_type_id"	=>	$this->input->post('client_type'),
						"category_id"	=>	implode(",", $this->input->post('client_cat')),
						"responsible_person_id"	=>	implode(",", $this->input->post('responsible_person')),
						"country_id"	=>	$this->input->post('country'),
						"state_id"	=>	$state_id,
						"city_id"	=>	$city_id,
						"loc_city"	=>	$loc_city,
						"loc_area"	=>	$loc_area,
						"road_no"	=>	$this->input->post('road_no'),
						"house_no"	=>	$this->input->post('house_no'),
						"zip_code"	=>	$this->input->post('zip_code'),
						"factory_address"	=>	$this->input->post('factory_address'),
						"skype"	=>	$this->input->post('skype'),
						"qq"	=>	$this->input->post('qq'),
						"whatsapp"	=>	$this->input->post('whatsapp'),
						"wechat"	=>	$this->input->post('wechat'),
						"client_status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);

			$kind_name = $this->input->post('kind_name');
			$kind_designation = $this->input->post('kind_designation');

			$names = serialize($kind_name);
		  	$designations = serialize($kind_designation);

			$kind_data = array(
						"name"	=>	$names,
						"designation"	=>	$designations,
						"user_id" => $this->session->userdata('user_id'),
						"datetime"	=>	$datetime,
					);

			if($id = $this->client_model->addModel($client_data, $kind_data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Client Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('client/add','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Client can not be Inserted.');
				redirect("client/add",'refresh');
			}
		}
	}
	/* 
		This function used to store client type record in database  
	*/
	public function addTypeDetails(){
        $this->form_validation->set_rules('type_name', 'Type Name', 'trim|required|min_length[3]|callback_alpha_dash_space1');
        if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
        	date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
						"name" => $this->input->post('type_name'),
						"status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);

			if($id = $this->client_model->addTypeModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Client Type Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('client/type','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Client Type can not be Inserted.');
				redirect("client/type",'refresh');
			}
        }	
		
	}
	/* 
		This function used to edit client record in database 
	*/
	public function editClient(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('company_name','Company Name','trim|required|min_length[3]|callback_alpha_dash_space1');
		/*$this->form_validation->set_rules('contact_person','Contact Person Name','trim|required|min_length[3]|callback_alpha_dash_space1');
		$this->form_validation->set_rules('contact_person_phone', 'Contact Person Phone', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');*/
		$this->form_validation->set_rules('client_type', 'Client Type', 'trim|required');
		/*if($this->input->post('country') == 18){
			$this->form_validation->set_rules('loc_city', 'Local City', 'trim|required');
		}
		else{
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'State', 'trim|required');
		}*/
		$this->form_validation->set_rules('country', 'Country', 'trim|required');

		if($this->form_validation->run()==false){
			$this->edit($id);
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');

        	if($this->input->post('country') == 18){
        		$state_id = 348;
        		$city_id = 491;
        		$loc_city = $this->input->post('loc_city');
        		$loc_area = $this->input->post('loc_area');
        	}
        	else{
        		$loc_city = NULL;
        		$loc_area = NULL;

        		if($this->input->post('state')){
        			$state_id = $this->input->post('state');
        		}
        		else{
        			$state_id = 4121;
        		}
        		
        		if($this->input->post('city')){
        			$city_id = $this->input->post('city');
        		}
        		else{
        			$city_id = 48316;
        		}
        	}
			
			$client_data = array(
						"company_name"	=>	$this->input->post('company_name'),
						"company_phone"	=>	$this->input->post('company_phone'),
						"contact_person"	=>	$this->input->post('contact_person'),
						"contact_person_phone"	=>	$this->input->post('contact_person_phone'),
						"email"		=>	$this->input->post('email'),
						"cc"		=>	$this->input->post('cc'),
						"bcc"		=>	$this->input->post('bcc'),
						"client_type_id"	=>	$this->input->post('client_type'),
						"category_id"	=>	implode(",", $this->input->post('client_cat')),
						"responsible_person_id"	=>	implode(",", $this->input->post('responsible_person')),
						"country_id"	=>	$this->input->post('country'),
						"state_id"	=>	$state_id,
						"city_id"	=>	$city_id,
						"loc_city"	=>	$loc_city,
						"loc_area"	=>	$loc_area,
						"road_no"	=>	$this->input->post('road_no'),
						"house_no"	=>	$this->input->post('house_no'),
						"zip_code"	=>	$this->input->post('zip_code'),
						"factory_address"	=>	$this->input->post('factory_address'),
						"skype"	=>	$this->input->post('skype'),
						"qq"	=>	$this->input->post('qq'),
						"whatsapp"	=>	$this->input->post('whatsapp'),
						"wechat"	=>	$this->input->post('wechat'),
						"client_status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);
			
			$kind_name = $this->input->post('kind_name');
			$kind_designation = $this->input->post('kind_designation');

			$names = serialize($kind_name);
		  	$designations = serialize($kind_designation);

			$kind_data = array(
						"name"	=>	$names,
						"designation"	=>	$designations,
						"user_id" => $this->session->userdata('user_id'),
						"datetime"	=>	$datetime,
					);

			if($this->client_model->editModel($client_data, $kind_data, $id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Client Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('client','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Client can not be Updated.');
				redirect("client",'refresh');
			}
		}
	}
	/* 
		This function used to edit client type record in database 
	*/
	public function editTypeDetails(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('type_name','Type Name','trim|required|min_length[3]|callback_alpha_dash_space1');

		if($this->form_validation->run()==false){
			$this->edit($id);
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
						"name"	=>	$this->input->post('type_name'),
						"status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime,
						"client_type_id"	=>	$this->input->post('id')
					);
			if($this->client_model->editTypeModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Client Type Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('client/type','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Client Type can not be Updated.');
				redirect("client/type",'refresh');
			}
		}
	}
	function alpha_dash_space($str) {
		if (! preg_match("/^([-a-zA-Z ])+$/i", $str))
	    {
	        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha, spaces and dashes.');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}
	function alpha_dash_space1($str) {
		if (! preg_match("/^[a-z0-9\040\.\-\,\/]+$/i", $str))
	    {
	        $this->form_validation->set_message('alpha_dash_space1', 'The %s field may only contain alpha and spaces.');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}
	function generateRandomString($length) {
	    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	public function test(){
		$data = array(
				'client_name' => $this->input->post('client_name'),
				'address'	 =>	$this->input->post('address'),
				'city_id'	 =>	$this->input->post('city'),
				'country_id'	=>	$this->input->post('country'),
				'state_id'	 =>	$this->input->post('state'),
				'mobile'	 =>$this->input->post('mobile')
			);
		echo $this->db->insert('client',$data);
	}
}
?>