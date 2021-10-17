<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tax extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('tax_model');
		$this->load->model('log_model');
	}
	public function index(){
		//get all tax to dispaly list
		$data['data'] = $this->tax_model->getTax();
		$this->load->view('tax/list',$data);
	}
	/* 
		call add view to add tax 
	*/
	public function add(){
		$this->load->view('tax/add');
	} 
	/* 
		this function is used to add tax record in database 
	*/
	public function addTax(){
		$this->form_validation->set_rules('tax_name', 'Tax Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('calculate_on', 'Calculate On', 'trim|required|numeric');
		$this->form_validation->set_rules('tax_value', 'Tax Value', 'trim|required|numeric');
		if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
        	$p_tax = $this->input->post('purchase_tax_value');
        	$s_tax = $this->input->post('tax_value');
        	if($p_tax==null){
        		$p_tax=0;
        	}
        	if($s_tax==null){
        		$s_tax=0;
        	}
			$data = array(
						"tax_name"  => $this->input->post('tax_name'),
						"start_from" => $this->input->post('start_from'),
						"registration_number" => $this->input->post('registration_number'),
						"filling_frequency" => $this->input->post('frequency'),
						"calculate_on" => $this->input->post('calculate_on'),
						"tax_value" => $s_tax,
						"purchase_tax_value" => $p_tax,
						"description" => $this->input->post('description')
					);

			if($id = $this->tax_model->addModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Tax Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('tax');	
			}
			else{
				$this->session->set_flashdata('fail', 'Discount can not be Inserted.');
				redirect("tax",'refresh');
			}
		}
		
	}
	/* 
		call edit view to edit tax record 
	*/
	public function edit($id){
		$data['data'] = $this->tax_model->getRecord($id);
		$this->load->view('tax/edit',$data);
	}
	/* 
		This function is used to save edited tax record in database 
	*/
	public function editTax(){
		$id =$this->input->post('id');
		$this->form_validation->set_rules('tax_name', 'Tax Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('calculate_on', 'Calculate On', 'trim|required|numeric');
		$this->form_validation->set_rules('tax_value', 'Tax Value', 'trim|required|numeric');
		if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {
        		$p_tax = $this->input->post('purchase_tax_value');
        	$s_tax = $this->input->post('tax_value');
        	if($p_tax==null){
        		$p_tax=0;
        	}
        	if($s_tax==null){
        		$s_tax=0;
        	}
			$data = array(
						"tax_name"  => $this->input->post('tax_name'),
						"start_from" => $this->input->post('start_from'),
						"registration_number" => $this->input->post('registration_number'),
						"filling_frequency" => $this->input->post('frequency'),
						"calculate_on" => $this->input->post('calculate_on'),
						"tax_value" => $s_tax,
						"purchase_tax_value" => $p_tax,
						"description" => $this->input->post('description')
						);

			if($this->tax_model->editModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Tax Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('tax');
			}
			else{
				$this->session->set_flashdata('fail', 'Discount can not be Updated.');
				redirect("tax",'refresh');
			}
		}
	}
	/* 
		this function is used to delete tax record from databse 
	*/
	public function delete($id){
		if($this->tax_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Tax Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('tax');
		}
		else{
			$this->session->set_flashdata('fail', 'Discount can not be Deleted.');
			redirect("tax",'refresh');
		}
	}
	/*
		in active tax
	*/
	public function in_active($id){
		$date =  $this->input->post('date');
		if($date==null){
			$date = date('Y-m-d');
		}
		if($this->tax_model->in_active($id,$date)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Tax Deactived'
				);
				$this->log_model->insert_log($log_data);
			redirect('tax','refresh');
		}
		else{
			redirect("tax",'refresh');
		}
	}
	/*
		active tax
	*/
	public function active($id){
		if($this->tax_model->active($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Tax Actived'
				);
			$this->log_model->insert_log($log_data);
			redirect('tax','refresh');
		}
		else{
			redirect("tax",'refresh');
		}
	}
	function alpha_dash_space($str) {
		if (! preg_match("/^([a-zA-Z0-9@% ])+$/i", $str))
	    {
	        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha, spaces and dashes.');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}
}
?>