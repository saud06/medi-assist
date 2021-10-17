<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email_config extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('email_config_model');
		$this->load->model('log_model');
	}
	public function index(){
		//get shipping_mode_ec Name and Id 
		$data['data'] = $this->email_config_model->getshipping_mode_list();
		$this->load->view('email_setup/shipping_mode_list',$data);

	} 
	/* 
		call add view to add shipping_mode_ec 
	*/
		public function shipping_mode_add(){
			$this->load->view('email_setup/shipping_mode_add');
		} 

		public function commission_add(){
			$this->load->view('email_setup/commission_add');
		}

		public function port_add(){
			$this->load->view('email_setup/port_add');
		}

		public function payment_add(){
			$this->load->view('email_setup/payment_add');
		}

		public function bankers_add(){
			$this->load->view('email_setup/bankers_add');
		}

		public function port_of_discharge_add(){
			$this->load->view('email_setup/port_of_discharge_add');
		}

		public function consignee_add(){
			$this->load->view('email_setup/consignee_add');
		}


		public function shipping_mode_list(){
			$data['data'] = $this->email_config_model->getshipping_mode_list();
			$this->load->view('email_setup/shipping_mode_list',$data);
		} 

		public function commission_list(){
			$data['data'] = $this->email_config_model->getCommission_list();
			$this->load->view('email_setup/commission_list',$data);
		} 

		public function port_list(){
			$data['data'] = $this->email_config_model->getPort_list();
			$this->load->view('email_setup/port_list',$data);
		} 

		public function payment_list(){
			$data['data'] = $this->email_config_model->getPayment_list();
			$this->load->view('email_setup/payment_list',$data);
		} 

		public function bankers_list(){
			$data['data'] = $this->email_config_model->getBankers_list();
			$this->load->view('email_setup/bankers_list',$data);
		} 

		public function port_of_discharge_list(){
			$data['data'] = $this->email_config_model->getPort_of_discharge_list();
			$this->load->view('email_setup/port_of_discharge_list',$data);
		} 

		public function consignee_list(){
			$data['data'] = $this->email_config_model->getConsignee_list();
			$this->load->view('email_setup/consignee_list',$data);
		} 

	/*  
		Add Benach Record in Database 
	*/
		public function addShippingMode(){
			$this->form_validation->set_rules('shipping_mode_ec_name', 'shipping mode Name', 'trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->shipping_mode_add();
			}
			else
			{	
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"shipping_mode_ec_name" => $this->input->post('shipping_mode_ec_name'),
					"shipping_mode_ec_details"        => $this->input->post('shipping_mode_ec_details'),
					"shipping_mode_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);
				if($id = $this->email_config_model->addShippingMode($data)){ 
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'shipping mode Inserted'

					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/shipping_mode_list');
				}
				else{
					$this->session->set_flashdata('fail', 'shipping mode can not be Inserted.');
					redirect("email_config/shipping_mode_list",'refresh');
				}
			}
		}

		public function addCommission(){
			$this->form_validation->set_rules('commission_ec_name', 'Commission Name', 'trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->commission_add();
			}
			else
			{	
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"commission_ec_name" => $this->input->post('commission_ec_name'),
					"commission_ec_value" => $this->input->post('commission_ec_value'),
					"commission_ec_details"        => $this->input->post('commission_ec_details'),
					"commission_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);	


				if($id = $this->email_config_model->addCommission($data)){ 
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Commission Inserted'
					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/commission_list');
				}
				else{
					$this->session->set_flashdata('fail', 'Commission can not be Inserted.');
					redirect("email_config/commission_list",'refresh');
				}
			}
		}

		public function addPort(){
			$this->form_validation->set_rules('port_ec_name', 'Port Name', 'trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->port_add();
			}
			else
			{	
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"port_ec_name" => $this->input->post('port_ec_name'),
					"port_ec_details"        => $this->input->post('port_ec_details'),
					"port_ec_location" => $this->input->post('port_ec_location'),
					"port_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);	


				if($id = $this->email_config_model->addPort($data)){ 
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Port Inserted'
					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/port_list');
				}
				else{
					$this->session->set_flashdata('fail', 'Port can not be Inserted.');
					redirect("email_config/port_list",'refresh');
				}
			}
		}

		public function addPayment(){
			$this->form_validation->set_rules('payment_ec_name', 'Payment Name', 'trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->payment_add();
			}
			else
			{	
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"payment_ec_name" => $this->input->post('payment_ec_name'),
					"payment_ec_details"        => $this->input->post('payment_ec_details'),
					"payment_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);	


				if($id = $this->email_config_model->addPayment($data)){ 
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Payment Inserted'
					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/payment_list');
				}
				else{
					$this->session->set_flashdata('fail', 'Payment can not be Inserted.');
					redirect("email_config/payment_list",'refresh');
				}
			}
		}

		public function addBankers(){
			$this->form_validation->set_rules('bankers_ec_name', 'Bankers Name', 'trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->bankers_add();
			}
			else
			{	
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"bankers_ec_name" => $this->input->post('bankers_ec_name'),
					"bankers_ec_details"        => $this->input->post('bankers_ec_details'),
					"bankers_ec_address"        => $this->input->post('bankers_ec_address'),
					"bankers_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);	


				if($id = $this->email_config_model->addBankers($data)){ 
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Bankers Inserted'
					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/bankers_list');
				}
				else{
					$this->session->set_flashdata('fail', 'Bankers can not be Inserted.');
					redirect("email_config/bankers_list",'refresh');
				}
			}
		}

		public function addPortOfDischarge(){
			$this->form_validation->set_rules('port_of_discharge_ec_name', 'Port Name', 'trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->port_add();
			}
			else
			{	
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"port_of_discharge_ec_name" => $this->input->post('port_of_discharge_ec_name'),
					"port_of_discharge_ec_details"        => $this->input->post('port_of_discharge_ec_details'),
					"port_of_discharge_ec_location" => $this->input->post('port_of_discharge_ec_location'),
					"port_of_discharge_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);	


				if($id = $this->email_config_model->addPortOfDischarge($data)){ 
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Port Of Discharge Inserted'
					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/port_of_discharge_list');
				}
				else{
					$this->session->set_flashdata('fail', 'Port Of Discharge can not be Inserted.');
					redirect("email_config/port_of_discharge_list",'refresh');
				}
			}
		}

		public function addConsignee(){
			$this->form_validation->set_rules('consignee_ec_name', 'Consignee Name', 'trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->bankers_add();
			}
			else
			{	
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"consignee_ec_name" => $this->input->post('consignee_ec_name'),
					"consignee_ec_details"        => $this->input->post('consignee_ec_details'),
					"consignee_ec_address"        => $this->input->post('consignee_ec_address'),
					"consignee_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);	


				if($id = $this->email_config_model->addConsignee_($data)){ 
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Consignee Inserted'
					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/consignee_list');
				}
				else{
					$this->session->set_flashdata('fail', 'Consignee can not be Inserted.');
					redirect("email_config/consignee_list",'refresh');
				}
			}
		}

	/*  
		call Edit view to edit record 
	*/
		public function shipping_mode_edit($id){
			$data['data'] = $this->email_config_model->getShippingModeRecord($id);
			$this->load->view('email_setup/shipping_mode_edit',$data);	
		}

		public function commission_edit($id){
			$data['data'] = $this->email_config_model->getCommissionRecord($id);
			$this->load->view('email_setup/commission_edit',$data);	
		}


		public function port_edit($id){
			$data['data'] = $this->email_config_model->getPortRecord($id);
			$this->load->view('email_setup/port_edit',$data);	
		}

		public function payment_edit($id){
			$data['data'] = $this->email_config_model->getPaymentRecord($id);
			$this->load->view('email_setup/payment_edit',$data);	
		}

		public function bankers_edit($id){
			$data['data'] = $this->email_config_model->getBankersRecord($id);
			$this->load->view('email_setup/bankers_edit',$data);	
		}

		public function port_of_discharge_edit($id){
			$data['data'] = $this->email_config_model->getPortOfDischargeRecord($id);
			$this->load->view('email_setup/port_of_discharge_edit',$data);	
		}

		public function Consignee_edit($id){
			$data['data'] = $this->email_config_model->getConsigneeRecord($id);
			$this->load->view('email_setup/Consignee_edit',$data);	
		}
	/* 
		Edit shipping_mode_ec in Database  
	*/
		public function editShippingMode(){
			$id = $this->input->post('id');
			$this->form_validation->set_rules('shipping_mode_ec_name', 'shipping mode Name', 'trim|required|min_length[3]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->shipping_mode_edit($id);
			}
			else
			{
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"shipping_mode_ec_name" => $this->input->post('shipping_mode_ec_name'),
					"shipping_mode_ec_details"        => $this->input->post('shipping_mode_ec_details'),
					"shipping_mode_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);
				if($this->email_config_model->editShippingMode($data,$id)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'shipping mode Updated'
					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/shipping_mode_list');
				}
				else{
					$this->session->set_flashdata('fail', 'shipping mode can not be Updated.');
					redirect('email_config/shipping_mode_list');
				}
			}
		}

		public function editCommission(){
			$id = $this->input->post('id');
			$this->form_validation->set_rules('commission_ec_name', 'shipping mode Name', 'trim|required|min_length[3]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->shipping_mode_edit($id);
			}
			else
			{
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"commission_ec_name" => $this->input->post('commission_ec_name'),
					"commission_ec_value" => $this->input->post('commission_ec_value'),
					"commission_ec_details"        => $this->input->post('commission_ec_details'),
					"commission_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);
				if($this->email_config_model->editCommission($data,$id)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Commission Updated'
					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/commission_list');
				}
				else{
					$this->session->set_flashdata('fail', 'Commission can not be Updated.');
					redirect('email_config/commission_list');
				}
			}
		}

		public function editPort(){
			$id = $this->input->post('id');
			$this->form_validation->set_rules('port_ec_name', 'shipping mode Name', 'trim|required|min_length[3]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->port_edit($id);
			}
			else
			{
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"port_ec_name" => $this->input->post('port_ec_name'),
					"port_ec_details"        => $this->input->post('port_ec_details'),
					"port_ec_location" => $this->input->post('port_ec_location'),					
					"port_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);
				if($this->email_config_model->editPort($data,$id)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Port Updated'

					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/port_list');
				}
				else{
					$this->session->set_flashdata('fail', 'Port can not be Updated.');
					redirect('email_config/port_list');
				}
			}
		}

		public function editPayment(){
			$id = $this->input->post('id');
			$this->form_validation->set_rules('payment_ec_name', 'Payment Name', 'trim|required|min_length[3]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->port_edit($id);
			}
			else
			{
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"payment_ec_name" => $this->input->post('payment_ec_name'),
					"payment_ec_details"        => $this->input->post('payment_ec_details'),			
					"payment_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);
				if($this->email_config_model->editPayment($data,$id)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Payment Updated'

					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/payment_list');
				}
				else{
					$this->session->set_flashdata('fail', 'Payment can not be Updated.');
					redirect('email_config/payment_list');
				}
			}
		}

		public function editBankers(){
			$id = $this->input->post('id');
			$this->form_validation->set_rules('bankers_ec_name', 'Bankers Name', 'trim|required|min_length[3]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->port_edit($id);
			}
			else
			{
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"bankers_ec_name" => $this->input->post('bankers_ec_name'),
					"bankers_ec_details"        => $this->input->post('bankers_ec_details'),
					"bankers_ec_address" => $this->input->post('bankers_ec_address'),			
					"bankers_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);
				if($this->email_config_model->editBankers($data,$id)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Bankers Updated'

					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/bankers_list');
				}
				else{
					$this->session->set_flashdata('fail', 'Bankers can not be Updated.');
					redirect('email_config/bankers_list');
				}
			}
		}

		public function editPortOfDischarge(){
			$id = $this->input->post('id');
			$this->form_validation->set_rules('port_of_discharge_ec_name', ' Name', 'trim|required|min_length[3]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->port_edit($id);
			}
			else
			{
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"port_of_discharge_ec_name" => $this->input->post('port_of_discharge_ec_name'),
					"port_of_discharge_ec_details"        => $this->input->post('port_of_discharge_ec_details'),
					"port_of_discharge_ec_location" => $this->input->post('port_of_discharge_ec_location'),					
					"port_of_discharge_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);
				if($this->email_config_model->editPortOfDischarge($data,$id)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Port Updated'

					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/port_of_discharge_list');
				}
				else{
					$this->session->set_flashdata('fail', 'Port can not be Updated.');
					redirect('email_config/port_of_discharge_list');
				}
			}
		}

		public function editConsignee(){
			$id = $this->input->post('id');
			$this->form_validation->set_rules('consignee_ec_name', 'Consignee Name', 'trim|required|min_length[3]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->port_edit($id);
			}
			else
			{
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"consignee_ec_name" => $this->input->post('consignee_ec_name'),
					"consignee_ec_details"        => $this->input->post('consignee_ec_details'),
					"consignee_ec_address"        => $this->input->post('consignee_ec_address'),
					"consignee_ec_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);
				if($this->email_config_model->editConsignee($data,$id)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Consignee Updated'

					);
					$this->log_model->insert_log($log_data);
					redirect('email_config/Consignee_list');
				}
				else{
					$this->session->set_flashdata('fail', 'Consignee can not be Updated.');
					redirect('email_config/Consignee_list');
				}
			}
		}

	/* 
		Display selected  shipping_mode_ec Record 
	*/
		public function single($id){
			$data['data'] = $this->email_config_model->getRecord($id);
			$this->load->view('header');
			$this->load->view('shipping_mode_ec/single',$data);
			$this->load->view('footer');
		}
	/* 
		Delete selected  shipping_mode_ec Record 
	*/
		public function shipping_mode_delete($id){
			if($this->email_config_model->deleteShippingMode($id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'shipping mode Deleted'
				);
				$this->log_model->insert_log($log_data);
				redirect('email_config/shipping_mode_list');
			}
			else{
				$this->session->set_flashdata('fail', 'shipping mode can not be Deleted.');
				redirect("email_config/shipping_mode_list",'refresh');
			}
		}


		public function commission_delete($id){
			if($this->email_config_model->deleteCommission($id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'commission Deleted'
				);
				$this->log_model->insert_log($log_data);
				redirect('email_config/commission_list');
			}
			else{
				$this->session->set_flashdata('fail', 'Commission can not be Deleted.');
				redirect("email_config/commission_list",'refresh');
			}
		}

		public function port_delete($id){
			if($this->email_config_model->deletePort($id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Port Deleted'
				);
				$this->log_model->insert_log($log_data);
				redirect('email_config/port_list');
			}
			else{
				$this->session->set_flashdata('fail', 'Port can not be Deleted.');
				redirect("email_config/port_list",'refresh');
			}
		}

		public function payment_delete($id){
			if($this->email_config_model->deletePayment($id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Payment Deleted'
				);
				$this->log_model->insert_log($log_data);
				redirect('email_config/payment_list');
			}
			else{
				$this->session->set_flashdata('fail', 'Payment can not be Deleted.');
				redirect("email_config/payment_list",'refresh');
			}
		}

		public function bankers_delete($id){
			if($this->email_config_model->deleteBankers($id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Bankers Deleted'
				);
				$this->log_model->insert_log($log_data);
				redirect('email_config/bankers_list');
			}
			else{
				$this->session->set_flashdata('fail', 'Bankers can not be Deleted.');
				redirect("email_config/bankers_list",'refresh');
			}
		}


		public function port_of_discharge_delete($id){
			if($this->email_config_model->deletePortOfDischarge($id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Port Deleted'
				);
				$this->log_model->insert_log($log_data);
				redirect('email_config/port_of_discharge_list');
			}
			else{
				$this->session->set_flashdata('fail', 'Port can not be Deleted.');
				redirect("email_config/port_of_discharge_list",'refresh');
			}
		}

		public function Consignee_delete($id){
			if($this->email_config_model->deleteConsignee($id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Consignee Deleted'
				);
				$this->log_model->insert_log($log_data);
				redirect('email_config/Consignee_list');
			}
			else{
				$this->session->set_flashdata('fail', 'Consignee can not be Deleted.');
				redirect("email_config/Consignee_list",'refresh');
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


		function alpha_space_shipping_mode_ec_details($str) {
			if (! preg_match("/^([a-zA-Z ])+$/i", $str))
			{
				$this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha and spaces.');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}

	}
	?>