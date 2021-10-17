<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Assign_warehouse extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('assign_warehouse_model');
		$this->load->model('log_model');
	}
	public function index(){
		$data['data'] = $this->assign_warehouse_model->getAssignWarehouse(); 
		$this->load->view('assign_warehouse/list',$data);
	}
	/*
		Display all Data
	*/
	public function add(){
		//get All User Name and Id		
		$data['user'] = $this->assign_warehouse_model->getUser(); 
		//get All Warehouse Name And Id
		//$data['warehouse'] = $this->assign_warehouse_model->getWarehouse(); 
		$this->load->view('assign_warehouse/add',$data);
	}
	/*
		return not assign warehouse
	*/
	public function getWarehouse($id){
		$data = $this->assign_warehouse_model->getWarehouse($id);
		//log_message('debug',print_r($data,true));
		echo json_encode($data);
	}
	/* 
		Add warehouse in database. 
	*/
	public function assignWarehouse(){ 
		$data = array(
				"user_id" => $this->input->post('user_id'),
				"warehouse_id" => $this->input->post('warehouse_id')
			);
		
		if($id = $this->assign_warehouse_model->assignWarehouse($data)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Assign Warehouse Inserted'
				);
			$this->log_model->insert_log($log_data);
			redirect('assign_warehouse','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Warehouse assign is unsuccessful.');
			redirect("assign_warehouse",'refresh');
		}
	}
	/*
		delete assign warehouse from database
	*/
	public function delete($id){
		if($this->assign_warehouse_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Assign Warehouse deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('assign_warehouse','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Assign Warehouse can not be Deleted.');
			redirect("assign_warehouse",'refresh');
		}
	}
}
?>