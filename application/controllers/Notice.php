<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notice extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('notice_model');
		$this->load->model('log_model');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
	}
	public function index(){
		//get All Notice  to display list
		$data['data'] = $this->notice_model->getNotice();
		$this->load->view('notice/list',$data);
	}
	/*
		generate notice list pdf
	*/
	public function list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'notice_list';
		$data['data'] = $this->notice_model->getNotice();
		$html = $this->load->view('notice/list_pdf',$data,true);

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
		filter notice list 
	*/
	public function filter_notice(){
		$date_range = $this->input->post('date_range');
		if($date_range){
			$explode = explode(' - ', $date_range);
			$start_date = $explode[0];
			$start_date = date("Y-m-d", strtotime($start_date));
			$end_date = $explode[1];
			$end_date = date("Y-m-d", strtotime($end_date));
		}

		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->notice_model->getFilteredNotice($start_date, $end_date, $status);
		
		echo json_encode($data);
	}
	/*
		filter notice pdf
	*/
	public function filterNoticePDF($start_date, $end_date, $status){
		$start_date = date("Y-m-d", strtotime($start_date));
		$end_date = date("Y-m-d", strtotime($end_date));

		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered notice record and display list
		$data['data'] = $this->notice_model->getFilteredNotice($start_date, $end_date, $status);

		$file_name = 'asset_list';
		$html = $this->load->view('notice/list_pdf',$data,true);

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
		call Add view to add notice  
	*/
	public function add(){
		$this->load->view('notice/add');
	} 
	/* 
		This function used to store notice record in database  
	*/
	public function addNotice(){
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|callback_alpha_dash_space');
        $this->form_validation->set_rules('date', 'Date', 'trim|required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
        	date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
						"notice_title" => $this->input->post('title'),
						"notice_date" => $this->input->post('date'),
						"notice_desc" => $this->input->post('notice_desc'),
						"notice_status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);

			if($id = $this->notice_model->addModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Notice Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('notice/add','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Notice can not be Inserted.');
				redirect("notice/add",'refresh');
			}
        }	
		
	}
	/* 
		call edit view to edit Notice Record 
	*/
	public function edit($id){
		$data['data'] = $this->notice_model->getRecord($id);
		$this->load->view('notice/edit',$data);
	}
	/* 
		This function is used to edit notice record in database 
	*/
	public function editNotice(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|callback_alpha_dash_space');
        $this->form_validation->set_rules('date', 'Date', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {
        	date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
						"notice_title" => $this->input->post('title'),
						"notice_date" => $this->input->post('date'),
						"notice_desc" => $this->input->post('notice_desc'),
						"notice_status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);
			if($this->notice_model->editModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Notice Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('notice','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Notice can not be Updated.');
				redirect("notice",'refresh');
			}
		}
	}
	/* 
		Delete selected  Notice Record 
	*/
	public function delete($id){
		if($this->notice_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Notice Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('notice');
		}
		else{
			$this->session->set_flashdata('fail', 'Notice can not be Deleted.');
			redirect("notice",'refresh');
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