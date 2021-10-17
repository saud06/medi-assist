<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Branch extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('branch_model');
		$this->load->model('log_model');
	}
	public function index(){
		//get Branch Name and Id 
		$data['data'] = $this->branch_model->getBranch();
		$this->load->view('branch/list',$data);
	} 
	/* 
		call add view to add Branch 
	*/
	public function add(){
		$this->load->view('branch/add');
	} 
	/*  
		Add Benach Record in Database 
	*/
	public function addBranch(){
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[3]|callback_alpha_space_city');
		$this->form_validation->set_rules('address', 'Branch Address', 'trim|required');

		if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {	
        	$data = array(
					"branch_name" => $this->input->post('branch_name'),
					"city"        => $this->input->post('city'),
					"address"  	  => $this->input->post('address')
				);
			if($id = $this->branch_model->addModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Branch Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('branch');
			}
			else{
				$this->session->set_flashdata('fail', 'Branch can not be Inserted.');
				redirect("branch",'refresh');
			}
		}
	}
	/*  
		call Edit view to edit record 
	*/
	public function edit($id){
		$data['data'] = $this->branch_model->getRecord($id);
		$this->load->view('branch/edit',$data);	
	}
	/* 
		Edit Branch in Database  
	*/
	public function editBranch(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[3]|callback_alpha_space_city');
		$this->form_validation->set_rules('address', 'Branch Address', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {
			$data = array(
					"branch_name" => $this->input->post('branch_name'),
					"city"        => $this->input->post('city'),
					"address"     => $this->input->post('address')
				);
			if($this->branch_model->editModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Branch Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('branch');
			}
			else{
				$this->session->set_flashdata('fail', 'Branch can not be Updated.');
				redirect("branch",'refresh');
			}
		}
	}
	/* 
		Display selected  Branch Record 
	*/
	public function single($id){
		$data['data'] = $this->branch_model->getRecord($id);
		$this->load->view('header');
		$this->load->view('branch/single',$data);
		$this->load->view('footer');
	}
	/* 
		Delete selected  Branch Record 
	*/
	public function delete($id){
		if($this->branch_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Branch Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('branch');
		}
		else{
			$this->session->set_flashdata('fail', 'Branch can not be Deleted.');
			redirect("branch",'refresh');
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
	function alpha_space_city($str) {
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