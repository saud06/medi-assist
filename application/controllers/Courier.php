<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class courier extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('courier_model');
		$this->load->model('log_model');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
	}
	public function index(){
		//get All Category  to display list
		$data['data'] = $this->courier_model->getcourier();
		$this->load->view('courier/list',$data);
	}
	/*
		generate courier list pdf
	*/
	public function list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'courier_list';
		$data['data'] = $this->courier_model->getcourier();
		$html = $this->load->view('courier/list_pdf',$data,true);

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
		filter courier
	*/
	public function filter_courier(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->courier_model->getFilteredCourier($status);
		
		echo json_encode($data);
	}
	/*
		filter courier pdf
	*/
	public function filterCourierPDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered courier record and display list
		$data['data'] = $this->courier_model->getFilteredCourier($status);

		$file_name = 'courier_list';
		$html = $this->load->view('courier/list_pdf',$data,true);

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
		$this->load->view('courier/add');
		
	} 
	
	/* 
		This function used to store category record in database  
	*/
	public function addcourier(){
        $this->form_validation->set_rules('courier_name', 'courier Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
        if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {        	
        	date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(						
						"courier_name" => $this->input->post('courier_name'),
						"courier_details" => $this->input->post('courier_details'),
						"courier_status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);
			//echo $data['courier_name'];

			if($id = $this->courier_model->addModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'courier Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('courier/add','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'courier can not be Inserted.');
				redirect("courier/add",'refresh');
			}
        }	
		
	}
	/* 
		call edit view to edit Category Record 
	*/
	public function edit($id){
		$data['data'] = $this->courier_model->getRecord($id);
		$this->load->view('courier/edit',$data);
	}
	/* 
		This function is used to edit category record in database 
	*/
	public function editcourier(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('courier_name', 'courier Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {        	
        	date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
						"courier_name" => $this->input->post('courier_name'),
						"courier_details"=> $this->input->post('courier_details'),							
						"courier_status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);
			if($this->courier_model->editModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'courier Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('courier','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'courier can not be Updated.');
				redirect("courier",'refresh');
			}
		}
	}
	/* 
		Delete selected  Category Record 
	*/
	public function delete($id){
		if($this->courier_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'courier Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('courier');
		}
		else{
			$this->session->set_flashdata('fail', 'courier can not be Deleted (status inactive).');
			redirect("courier",'refresh');
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