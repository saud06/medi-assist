<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Biller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('biller_model');
		$this->load->model('log_model');
		$this->load->model('company_setting_model');
	}
	public function index(){
		
		$data['data'] = $this->biller_model->getBillers(); 
		$this->load->view('biller/list',$data);
	} 
	/*
		get all state of country
	*/
	public function getState($id){
		$data = $this->biller_model->getState($id);
		echo json_encode($data);
	}
	/*
		get all city of state
	*/
	public function getCity($id){
		$data = $this->biller_model->getCity($id);
		echo json_encode($data);
	}
	/*
		return state code
	*/
	public function getStateCode($id,$country){
		if($country == 101){
			$data = $this->biller_model->getStateCode($id);
			echo $data;
		}
		else{
			echo "";
		}
	}
	public function getBranch(){
		//get Branch name and Id
		$data = $this->biller_model->getBranch(); 
		return $data;
	}
	/* 
		get Branch name and Id  
	*/
	public function add(){
		$data['country']  = $this->biller_model->getCountry();
		$data['branch']= $this->biller_model->getBranch(); 
		$this->load->view('biller/add',$data);
	}
	/* 
		Add New Biller in database 
	*/
	public function addBiller(){ 
		$this->load->library('form_validation');
		$this->form_validation->set_rules('biller_name','Biller Name','trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('gstid', 'GSTID', 'trim|required');
		$this->form_validation->set_rules('branch','Branch','trim|required');
		$this->form_validation->set_rules('company_name','Company Name','trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('address','Address','required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('country','Country','trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		/*$this->form_validation->set_rules('fax','Fax','trim|required|numeric|callback_fax');*/
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|min_length[10]|max_length[10]|callback_mobile');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('telephone','Telephone','trim|required|numeric|callback_tel');

		if($this->form_validation->run()==false){
			$this->add();
		}
		else
		{
				
				$data = array(
					"branch_id"     =>  $this->input->post('branch'),
					"biller_name"   =>  $this->input->post('biller_name'),
					"company_name"  =>  $this->input->post('company_name'),
					"address"       =>  $this->input->post('address'),
					"city_id"		=>  $this->input->post('city'),
					"state_id"		=>  $this->input->post('state'),
					"state_code"	=>  $this->input->post('state_code'),
					"country_id"	=>  $this->input->post('country'),
					"fax"			=>  $this->input->post('fax'),
					"mobile"		=>  $this->input->post('mobile'),
					"email"			=>  $this->input->post('email'),
					"telephone"		=>  $this->input->post('telephone'),
					"gstid"			=>  $this->input->post('gstid')
				);
			if($id = $this->biller_model->addModel($data)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Biller Inserted'
					);
				$this->log_model->insert_log($log_data);
				$this->session->set_flashdata('fail', 'Biller Successfully Inserted.'); 
				redirect('biller','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Biller can not be Inserted.');				redirect("biller",'refresh');
			}
		}
	}
	/* 
		call view editr Biller 
	*/
	public function edit($id){ 
		$data['data'] = $this->biller_model->getRecord($id);
		$data['country']  = $this->biller_model->getCountry();
		$data['state'] = $this->biller_model->getState($data['data'][0]->country_id);
		$data['city'] = $this->biller_model->getCity($data['data'][0]->state_id);
		//get Branch Name and Id
		$data['branch'] =  $this->biller_model->getBranch(); 
		// get Biller record in database.
		
		$this->load->view('biller/edit',$data);
	}
	/*  
		Edit Biller in Database  
	*/
	public function editBiller(){ 
		$this->load->library('form_validation');
		$id = $this->input->post('id');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('biller_name','Biller Name','trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('gstid', 'GSTID', 'trim|required');
		$this->form_validation->set_rules('branch','Branch','trim|required');
		$this->form_validation->set_rules('company_name','Company Name','trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('address','Address','required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('country','Country','trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		/*$this->form_validation->set_rules('fax','Fax','trim|required|numeric|callback_fax');*/
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|min_length[10]|max_length[10]|callback_mobile');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('telephone','Telephone','trim|required|numeric|callback_tel');

		if($this->form_validation->run()==false){

			$this->edit($id);
		}
		else
		{
			$data = array(
						"branch_id"		=>	$this->input->post('branch'),
						"biller_name"	=>	$this->input->post('biller_name'),
						"company_name"	=>	$this->input->post('company_name'),
						"address"		=>	$this->input->post('address'),
						"city_id"		=>	$this->input->post('city'),
						"state_id"		=>	$this->input->post('state'),
						"state_code"	=>	$this->input->post('state_code'),
						"country_id"	=>	$this->input->post('country'),
						"fax"			=>	$this->input->post('fax'),
						"mobile"		=>	$this->input->post('mobile'),
						"email"			=>	$this->input->post('email'),
						"telephone"		=>	$this->input->post('telephone'),
						"gstid"			=>	$this->input->post('gstid'),
						"biller_id"		=>	$this->input->post('id')
						);
			if($this->biller_model->editModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Biller Updated'
					);
				$this->log_model->insert_log($log_data);
				$this->session->set_flashdata('fail', 'Biller Updated Successfully.');
				redirect('biller','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Biller can not be Updated.');
				redirect("biller",'refresh');
			}
		}
	
	}
	/* 
		Delete Biller in Database 
	*/
	public function delete($id){
		if($this->biller_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Biller deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('biller','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Biller can not be Deleted.');
			redirect("biller",'refresh');
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
		if (! preg_match("/^([a-zA-Z ])+$/i", $str))
	    {
	        $this->form_validation->set_message('alpha_dash_space1', 'The %s field may only contain alpha and spaces.');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}
	function mobile($str) {
		if (! preg_match("/^[6-9][0-9]{9}$/", $str))
	    {
	        $this->form_validation->set_message('mobile', 'The %s field may only contain Numeric and 10 digit(Ex.9898767654)');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}
	function fax($str) {
		if (! preg_match("/^[1-9][0-9]{6}$/", $str))
	    {
	        $this->form_validation->set_message('fax', 'The %s field may only contain Numeric and 7 digit (Ex.2199876)');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}
	function tel($str) {
		if (! preg_match("/^[1-9][0-9]{5}$/", $str))
	    {
	        $this->form_validation->set_message('tel', 'The %s field may only contain Numeric and 6 digit(Ex.294910)');
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
}
?>