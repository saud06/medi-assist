<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class rack extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('rack_model');
		$this->load->model('log_model');
	}
	public function index(){
		// get all rack to display list
		$data['data'] = $this->rack_model->getrack();
		$this->load->view('rack/list',$data);
	}
	/*
		generate rack list pdf
	*/
	public function list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'rack_list';
		$data['data'] = $this->rack_model->getrack();
		$html = $this->load->view('rack/list_pdf',$data,true);

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
		filter rack record 
	*/
	public function filter_rack(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->rack_model->getFilteredRack($status);
		
		echo json_encode($data);
	}
	/*
		filter rack pdf
	*/
	public function filterRackPDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered rack record and display list
		$data['data'] = $this->rack_model->getFilteredRack($status);

		$file_name = 'rack_list';
		$html = $this->load->view('rack/list_pdf',$data,true);

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
		call add view to add rack record 
	*/
		public function add(){
			$data= $this->getshelf();
			$this->load->view('rack/add',$data);
		} 
	/* 
		this function is used to get all shelf to select 
	*/
		public function getshelf(){
			$data['data'] = $this->rack_model->getshelf();
			return $data;
		}
	/* 
		this function is add rack in database 
	*/
		public function addrack(){
			$this->form_validation->set_rules('shelf', 'shelf', 'trim|required');
			$this->form_validation->set_rules('rack_name', 'Rack Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
			if ($this->form_validation->run() == FALSE)
			{
				$this->add();
			}
			else
			{
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"rack_name" => $this->input->post('rack_name'),
					"shelf_id" => $this->input->post('shelf'),
					"rack_location" => $this->input->post('rack_location'),
					"rack_status" => $this->input->post('confirm'),
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);

				if($id = $this->rack_model->addModel($data)){ 
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Rack Inserted'
					);
					$this->log_model->insert_log($log_data);
					redirect('rack/add','refresh');
				}
				else{
					$this->session->set_flashdata('fail', 'Rack can not be Inserted.');
					redirect("rack/add",'refresh');
				}
			}

		}
	/* 
		call edit view to edit rack record 
	*/
		public function edit($id){
			$data['shelf'] =  $this->rack_model->getshelf();;
			$data['data'] = $this->rack_model->getRecord($id);
			$this->load->view('rack/edit',$data);
		}
	/* 
		this function is used to save edited rack record  
	*/
		public function editrack(){
			$id =  $this->input->post('id');
			$this->form_validation->set_rules('shelf', 'shelf', 'trim|required');
			$this->form_validation->set_rules('rack_name', 'Rack Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
			if ($this->form_validation->run() == FALSE)
			{
				$this->edit($id);
			}
			else
			{
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');	
				$data = array(
					"rack_name" => $this->input->post('rack_name'),
					"shelf_id"      => $this->input->post('shelf'),
					"rack_location" => $this->input->post('rack_loation'),
					"rack_status"      => $this->input->post('confirm'),
					"user_id" => $this->session->userdata('user_id'),
					"datetime" => $datetime
				);

				if($this->rack_model->editModel($data,$id)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'rack Updated'
					);
					$this->log_model->insert_log($log_data);
					redirect('rack');
				}
				else{
					$this->session->set_flashdata('fail', 'rack can not be Updated.');
					redirect("rack",'refresh');
				}
			}
		}
	/* 
		this function is used to delete rack record in database 
	*/
		public function delete($id){
			if($this->rack_model->deleteModel($id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Rack Deleted'
				);
				$this->log_model->insert_log($log_data);
				redirect('rack','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Rack can not be Deleted.');
				redirect("rack",'refresh');
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