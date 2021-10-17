<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subcategory extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('subcategory_model');
		$this->load->model('log_model');
	}
	public function index(){
		$data['data'] = $this->subcategory_model->getSubcategory();
		$this->load->view('subcategory/list',$data);
	}
	/*
		generate subcategory list pdf
	*/
	public function list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'subcategory_list';
		$data['data'] = $this->subcategory_model->getSubcategory();
		$html = $this->load->view('subcategory/list_pdf',$data,true);

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
		filter subcategory 
	*/
	public function filter_subcategory(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->subcategory_model->getFilteredSubcategory($status);
		
		echo json_encode($data);
	}
	/*
		filter subcategory pdf
	*/
	public function filterSubcategoryPDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered subcategory record and display list
		$data['data'] = $this->subcategory_model->getFilteredSubcategory($status);

		$file_name = 'subcategory_list';
		$html = $this->load->view('subcategory/list_pdf',$data,true);

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
		call add subcategory view to add subcategory 
	*/
	public function add(){
		$data= $this->getCategory();
		$this->load->view('subcategory/add',$data);
	} 
	/* 
		this function is  used to get category list to select 
	*/
	public function getCategory(){
		$data['data'] = $this->subcategory_model->getCategory();
		return $data;
	}
	/* 
		this function is used to add subcategory record in database 
	*/
	public function addSubcategory(){
		$this->form_validation->set_rules('subcategory_name', 'Subcategory Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('category', 'Category', 'trim|required|greater_than[0]');
        if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
			$subcategory_code = $this->subcategory_model->getMaxId();
			date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
					"category_id"        => $this->input->post('category'),
					"sub_category_code"  => $subcategory_code,
					"sub_category_name"  => $this->input->post('subcategory_name'),
				      "sub_category_desc" => $this->input->post('sub_category_desc'),
						"sub_category_status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);

			if($id = $this->subcategory_model->addModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Subcategory Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('subcategory/add');	
			}
			else{
				$this->session->set_flashdata('fail', 'Subcategory can not be Inserted.');
				redirect("subcategory/add",'refresh');
			}
		}
	}
	/* 
		call edit view to edit record  
	*/
	public function edit($id){
		$data['category']  = $this->subcategory_model->getCategory1();
		$data['data'] = $this->subcategory_model->getRecord($id);
		$this->load->view('subcategory/edit',$data);
	}
	/* 
		this function is used to save edited record in database 
	*/
	public function editSubcategory(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('subcategory_name', 'Subcategory Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('category', 'Category', 'trim|required|greater_than[0]');
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {    date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
					"category_id"        => $this->input->post('category'),
					"sub_category_name"  => $this->input->post('subcategory_name'),
				      "sub_category_desc" => $this->input->post('sub_category_desc'),
						"sub_category_status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);
			if($this->subcategory_model->editModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Subcategory Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('subcategory');
			}
			else{
				$this->session->set_flashdata('fail', 'Subcategory can not be Updated.');
				redirect("subcategory",'refresh');
			}
		}
	}
	/* 
		This function is to delete subcategory from database  
	*/
	public function delete($id){
		if($this->subcategory_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Subcategory Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('subcategory','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Subcategory can not be Deleted.');
			redirect("subcategory",'refresh');
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