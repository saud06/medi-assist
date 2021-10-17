<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Warehouse extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('warehouse_model');
		$this->load->model('log_model');
	}
	public function index(){
		// get all warehouse to display list
		$data['data'] = $this->warehouse_model->getWarehouse();
		$this->load->view('warehouse/list',$data);
	} 
	/* 
		call add view to add warehouse record 
	*/
	public function add(){
		$data= $this->getBranch();
		$this->load->view('warehouse/add',$data);
	} 
	/* 
		this function is used to get all branch to select 
	*/
	public function getBranch(){
		$data['data'] = $this->warehouse_model->getBranch();
		return $data;
	}
	/* 
		this function is add warehouse in database 
	*/
	public function addWarehouse(){
		$this->form_validation->set_rules('branch', 'Branch', 'trim|required');
		$this->form_validation->set_rules('warehouse_name', 'Waarehouse Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
			$data = array(
					"warehouse_name" => $this->input->post('warehouse_name'),
					"branch_id"      => $this->input->post('branch'),
					"user_id"        => $this->session->userdata('user_id')
				);

			if($id = $this->warehouse_model->addModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Warehouse Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('warehouse','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Warehouse can not be Inserted.');
				redirect("warehouse",'refresh');
			}
		}
		
	}
	/* 
		call edit view to edit warehouse record 
	*/
	public function edit($id){
		$data['branch'] =  $this->warehouse_model->getBranch();;
		$data['data'] = $this->warehouse_model->getRecord($id);
		$this->load->view('warehouse/edit',$data);
	}
	/* 
		this function is used to save edited warehouse record  
	*/
	public function editWarehouse(){
		$id =  $this->input->post('id');

		$this->form_validation->set_rules('branch', 'Branch', 'trim|required');
		$this->form_validation->set_rules('warehouse_name', 'Warehouse Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {
			$data = array(
					"branch_id"      => $this->input->post('branch'),
					"warehouse_name" => $this->input->post('warehouse_name'),
					"user_id"        => $this->session->userdata('user_id')
				);
			
			if($this->warehouse_model->editModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Warehouse Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('warehouse');
			}
			else{
				$this->session->set_flashdata('fail', 'Warehouse can not be Updated.');
				redirect("warehouse",'refresh');
			}
		}
	}
	/* 
		this function is used to delete warehouse record in database 
	*/
	public function delete($id){
		if($this->warehouse_model->deleteModel($id)){
			$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Warehouse Deleted'
					);
				$this->log_model->insert_log($log_data);
			redirect('warehouse','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Warehouse can not be Deleted.');
			redirect("warehouse",'refresh');
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
}
?>