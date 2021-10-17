<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Unit extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('unit_model');
		$this->load->model('log_model');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
	}
	public function index(){
		//get All Category  to display list
		$data['data'] = $this->unit_model->getUnit();
		$this->load->view('unit/list',$data);
	}
	/*
		generate unit list pdf
	*/
	public function list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'unit_list';
		$data['data'] = $this->unit_model->getUnit();
		$html = $this->load->view('unit/list_pdf',$data,true);

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
		filter unit  
	*/
	public function filter_unit(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->unit_model->getFilteredUnit($status);
		
		echo json_encode($data);
	}
	/*
		filter unit pdf
	*/
	public function filterUnitPDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered unit record and display list
		$data['data'] = $this->unit_model->getFilteredUnit($status);

		$file_name = 'unit_list';
		$html = $this->load->view('unit/list_pdf',$data,true);

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
		call Add view to add category  
	*/
	public function add(){
		$this->load->view('unit/add');
	} 
	
	/* 
		This function used to store category record in database  
	*/
	public function addUnit(){
        $this->form_validation->set_rules('unit_name', 'Unit Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
        if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
        	//$category_code = $this->category_model->getMaxId();
        	date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
						//"category_code" => $category_code,
						"unit_name" => $this->input->post('unit_name'),
						"unit_symbol" => $this->input->post('unit_symbol'),
						"unit_size" => $this->input->post('unit_size'),
						"category_status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);

			if($id = $this->unit_model->addModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Unit Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('unit/add','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Unit can not be Inserted.');
				redirect("Unit/add",'refresh');
			}
        }	
		
	}
	/* 
		call edit view to edit Category Record 
	*/
	public function edit($id){
		$data['data'] = $this->unit_model->getRecord($id);
		$this->load->view('unit/edit',$data);
	}
	/* 
		This function is used to edit category record in database 
	*/
	public function editUnit(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('unit_name', 'Unit Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {
        	//$category_code = $this->category_model->getMaxId();
        	date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
						"unit_name" => $this->input->post('unit_name'),
						"unit_symbol" => $this->input->post('unit_symbol'),
						"unit_size" => $this->input->post('unit_size'),	
						"unit_status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);
			if($this->unit_model->editModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Unit Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('unit','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Unit can not be Updated.');
				redirect("unit",'refresh');
			}
		}
	}
	/* 
		Delete selected  Category Record 
	*/
	public function delete($id){
		if($this->unit_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Unit Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('unit');
		}
		else{
			$this->session->set_flashdata('fail', 'Unit can not be Deleted (status inactive).');
			redirect("unit",'refresh');
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