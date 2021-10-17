<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('payment_model');
		$this->load->model('log_model');
	}
	public function index(){
		$data['data'] = $this->payment_model->getPayment();
		$this->load->view('payment/list',$data);
	} 
	/*
		generate payment list pdf
	*/
	public function list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'payment_list';
		$data['data'] = $this->payment_model->getPayment();
		$html = $this->load->view('payment/list_pdf',$data,true);

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
		filter payment list
	*/
	public function filterPayment(){
		$date_range = $this->input->post('date_range');
		if($date_range){
			$explode = explode(' - ', $date_range);
			$start_date = $explode[0];
			$start_date = date("Y-m-d", strtotime($start_date));
			$end_date = $explode[1];
			$end_date = date("Y-m-d", strtotime($end_date));
		}

		// get all filtered sales record and display list
		$data['data'] = $this->payment_model->getFilteredPayment($start_date, $end_date);

		echo json_encode($data);
	} 
	/*
		filter payment pdf
	*/
	public function filterPaymentPDF($start_date, $end_date){
		$start_date = date("Y-m-d", strtotime($start_date));
		$end_date = date("Y-m-d", strtotime($end_date));

		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'payment_list';

		// get all filtered payment record and display list
		$data['data'] = $this->payment_model->getFilteredPayment($start_date, $end_date);

		$html = $this->load->view('payment/list_pdf',$data,true);

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
	public function edit($id){
		$data['data'] = $this->payment_model->getDetails($id);
		$this->load->view('payment/edit',$data);
	}
	public function editPayment(){
		$id = $this->input->post('id');
		$paying_by = $this->input->post('paying_by');
		$this->form_validation->set_rules('date','Date','trim|required');
		$this->form_validation->set_rules('paying_by','Paying By','trim|required');
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('contact','Contact','trim|required');
		if($paying_by == "Cheque"){
			$this->form_validation->set_rules('bank_name','Bank Name','trim|required|callback_alpha_dash_space');
			$this->form_validation->set_rules('cheque_no','Cheque No','trim|required|numeric');
		}
		if($this->form_validation->run()==false){
			$this->edit($id);
		}
		else
		{
			if($paying_by == "Cheque"){
				$bank_name = $this->input->post('bank_name');
				$cheque_no = $this->input->post('cheque_no');
			}
			else{
				$bank_name = "";
				$cheque_no = "";
			}
			$data = array(
					"date"         => $this->input->post('date'),
					"paying_by"    => $this->input->post('paying_by'),
					"bank_name"    => $bank_name,
					"cheque_no"    => $cheque_no,
					"name"    	   => $this->input->post('name'),
					"contact"	   => $this->input->post('contact'),
					"designation"  => $this->input->post('designation'),
					"description"  => $this->input->post('note')
				);
			if($this->payment_model->editPayment($id,$data)){ 
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Payment Updated'
				);
				$this->log_model->insert_log($log_data);
				redirect('payment','refresh');
			}
			else{
				$this->session->set_flashdata('message', 'Error in Payment.');
				redirect("payment",'refresh');
			}
		}
	}
	/*
		check character and space validation 
	*/
	function alpha_dash_space($str) {
		if (! preg_match("/^([a-zA-Z ])+$/i", $str))
	    {
	        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha and spaces');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}/*

	*/
	public function delete($id){
		if($this->payment_model->delete($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Payment Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('payment','refresh');
		}
		else{
			$this->session->set_flashdata('message', 'Error in Delete.');
			redirect("payment",'refresh');
		}
	}
}