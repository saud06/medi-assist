<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Documents extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('documents_model');
		$this->load->model('log_model');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
	}
	public function index(){
		//get All Document  to display list
		$data['data'] = $this->documents_model->getDocument();
		$this->load->view('documents/list',$data);
	}
	/* 
		filter document list 
	*/
	public function filter_document(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->documents_model->getFilteredDocument($status);
		
		echo json_encode($data);
	}
	/* 
		call Add view to add document  
	*/
	public function add(){
		$this->load->view('documents/add');
	} 
	/* 
		This function used to store document record in database  
	*/
	public function addDocument(){
		date_default_timezone_set('Asia/Dhaka');
    	$datetime = date('Y-m-d H:i:s');
		$data = array(
					"document_code" => '',
					"document_name" => 'New Document',
					"document_desc" => '',
					"document_status" => 'Active',
					"user_id" => $this->session->userdata('user_id'),
					"created_by" => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
					"datetime" => $datetime
				);

		if($id = $this->documents_model->addModel($data)){ 
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'New Document Added'
				);
			$this->log_model->insert_log($log_data);

			echo json_encode(array("status" => TRUE));
		}
	}
	/* 
		call edit view to edit Document Record 
	*/
	public function edit($id){
		$data['data'] = $this->documents_model->getRecord($id);
		$this->load->view('documents/edit',$data);
	}
	/* 
		This function is used to edit document record in database 
	*/
	public function editDocument(){
		$document_id = $this->input->post('document_id');

    	date_default_timezone_set('Asia/Dhaka');
    	$datetime = date('Y-m-d H:i:s');
		$data = array(
					"document_name" => $this->input->post('document_name'),
					"document_status" => 'Active',
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);
		if($this->documents_model->editModel($data,$document_id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $document_id,
					'message'  => 'Document Updated'
				);
			$this->log_model->insert_log($log_data);

			echo json_encode(array("status" => TRUE));
		}
	}
	/* 
		Delete selected  Document Record 
	*/
	public function delete(){
		$id = $this->input->post('document_id');

		if($this->documents_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Document Deleted'
				);
			$this->log_model->insert_log($log_data);

			echo json_encode(array("status" => TRUE));
		}
	}
	public function view($id){
		$this->load->view('documents/view');
	}
	public function export($id){
		$this->load->view('documents/export');
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