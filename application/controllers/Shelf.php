<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class shelf extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('shelf_model');
		$this->load->model('log_model');
	}
	public function index(){
		//get shelf Name and Id 
		$data['data'] = $this->shelf_model->getshelf();
		$this->load->view('shelf/list',$data);
	}
	/*
		generate shelf list pdf
	*/
	public function list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'shelf_list';
		$data['data'] = $this->shelf_model->getshelf();
		$html = $this->load->view('shelf/list_pdf',$data,true);

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
		filter shelf 
	*/
	public function filter_shelf(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->shelf_model->getFilteredShelf($status);
		
		echo json_encode($data);
	}
	/*
		filter shelf pdf
	*/
	public function filterShelfPDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered shelf record and display list
		$data['data'] = $this->shelf_model->getFilteredShelf($status);

		$file_name = 'shelf_list';
		$html = $this->load->view('shelf/list_pdf',$data,true);

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
		call add view to add shelf 
	*/
		public function add(){
			$this->load->view('shelf/add');
		} 
	/*  
		Add Benach Record in Database 
	*/
		public function addShelf(){
			$this->form_validation->set_rules('shelf_name', 'shelf Name', 'trim|required|min_length[3]|callback_alpha_dash_space');

			if ($this->form_validation->run() == FALSE)
			{
				$this->add();
			}
			else
			{	
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"shelf_name" => $this->input->post('shelf_name'),
					"shelf_location" => $this->input->post('shelf_location'),
					"shelf_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);
				if($id = $this->shelf_model->addModel($data)){ 
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Shelf Inserted'
					);
					$this->log_model->insert_log($log_data);
					redirect('shelf/add');
				}
				else{
					$this->session->set_flashdata('fail', 'Shelf can not be Inserted.');
					redirect("shelf/add",'refresh');
				}
			}
		}
	/*  
		call Edit view to edit record 
	*/
		public function edit($id){
			$data['data'] = $this->shelf_model->getRecord($id);
			$this->load->view('shelf/edit',$data);	
		}
	/* 
		Edit shelf in Database  
	*/
		public function editShelf(){
			$id = $this->input->post('id');
			$this->form_validation->set_rules('shelf_name', 'shelf Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->edit($id);
			}
			else
			{
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"shelf_name" => $this->input->post('shelf_name'),
					"shelf_location" => $this->input->post('shelf_location'),
					"shelf_status" => $this->input->post('confirm'),								
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);
				if($this->shelf_model->editModel($data,$id)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Shelf Updated'
					);
					$this->log_model->insert_log($log_data);
					redirect('shelf');
				}
				else{
					$this->session->set_flashdata('fail', 'Shelf can not be Updated.');
					redirect("shelf",'refresh');
				}
			}
		}
	/* 
		Display selected  shelf Record 
	*/
		public function single($id){
			$data['data'] = $this->shelf_model->getRecord($id);
			$this->load->view('header');
			$this->load->view('shelf/single',$data);
			$this->load->view('footer');
		}
	/* 
		Delete selected  shelf Record 
	*/
		public function delete($id){
			if($this->shelf_model->deleteModel($id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Shelf Deleted'
				);
				$this->log_model->insert_log($log_data);
				redirect('shelf');
			}
			else{
				$this->session->set_flashdata('fail', 'Shelf can not be Deleted.');
				redirect("shelf",'refresh');
			}
		}
		function alpha_dash_space($str) {
			if (! preg_match("/^[a-z0-9\040\.\-\,\/]+$/i", $str))
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