<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Discount extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('discount_model');
		$this->load->model('log_model');
	}
	public function index(){
		// get all record of Discount to Display list
		$data['data'] = $this->discount_model->getDiscount();
		$this->load->view('discount/list',$data);
	} 
	/* 
		call add view ro add discount record 
	*/
	public function add(){
		$this->load->view('discount/add');
	} 
	/* 
		This function used to add discount record in database 
	*/
	public function addDiscount(){
		/*$this->form_validation->set_rules('discount_type', 'Discount Type', 'trim|required|callback_select');*/
		$this->form_validation->set_rules('discount_name', 'Discount Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('discount_value', 'Discount Value', 'trim|required|numeric');
		/*$discount_type = $this->input->post('discount_type');
		if($discount_type=="Fixed"){
			$this->form_validation->set_rules('discount_amount', 'Discount Amount', 'trim|required|numeric');
			$amount = $this->input->post('discount_amount');
		}
		else{
			$amount=null;
		}*/
        if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
			
			$data = array(
					/*"discount_type"  => $discount_type,*/
					"discount_name"  => $this->input->post('discount_name'),
					/*"amount"         => $amount,*/
					"discount_value" => $this->input->post('discount_value'),
					"user_id"        => $this->session->userdata('user_id')
					);
			
			if($id = $this->discount_model->addModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Discount Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('discount','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Discount can not be Inserted.');
				redirect("discount",'refresh');
			}
		}
	}
	/* 
		call edit view to edit discount record 
	*/
	public function edit($id){
		$data['data'] = $this->discount_model->getRecord($id);
		$this->load->view('discount/edit',$data);
	}
	/* 
		This function used to edit discount record in database 
	*/
	public function editDiscount(){
		$id = $this->input->post('id');
		/*$this->form_validation->set_rules('discount_type', 'Discount Type', 'trim|required|callback_select');*/
		$this->form_validation->set_rules('discount_name', 'Discount Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('discount_value', 'Discount Value', 'trim|required|numeric');
		/*$discount_type = $this->input->post('discount_type');
		if($discount_type=="Fixed"){
			$this->form_validation->set_rules('discount_amount', 'Discount Amount', 'trim|required|numeric');
			$amount = $this->input->post('discount_amount');
		}
		else{
			$amount=null;
		}*/
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {
			$data = array(
				/*"discount_type" => $this->input->post('discount_type'),*/
				"discount_name" => $this->input->post('discount_name'),
				"discount_value" => $this->input->post('discount_value')
			);
			
			if($this->discount_model->editModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Discount Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('discount','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Discount can not be Updated.');
				redirect("discount",'refresh');
			}
		}
	}
	/* 
		This function is used to delete discount record in databse 
	*/
	public function delete($id){
		if($this->discount_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Discount Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('discount');
		}
		else{
			$this->session->set_flashdata('fail', 'Discount can not be Deleted.');
			redirect("discount",'refresh');
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
	function value($str) {
		if (! preg_match("/^\$?[1-9][0-9]*(\.[0-9][0-9])?$/", $str))
	    {
	        $this->form_validation->set_message('value', 'The %s field may only contain numeric. Ex(1000 or 10.10)');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}
	function select($str) {
		if ($str == "Select Type")
	    {
	        $this->form_validation->set_message('select', 'Please Select %s.');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}
}
?>