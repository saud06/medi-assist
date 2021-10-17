<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product_alert extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('product_alert_model');
		$this->load->model('log_model');
	}
	public function index(){
		// get all product , its quantity is less than alert quantity.
		$data['data'] = $this->product_alert_model->getProductAlert();
		$this->load->view('product_alert/list',$data);
	}
	
	public function create_pdf(){
		$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => 0,
				'message'  => 'Product Alert PDF Generated'
			);
		$this->log_model->insert_log($log_data);
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['data'] = $this->product_alert_model->getProductAlert();
		$this->load->view('product_alert/list',$data);
		$html = $this->load->view('product_alert/pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('alert_quantity.pdf','I');
	}
	public function create_csv(){
		$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => 0,
				'message'  => 'Product Alert CSV Generated'
			);
		$this->log_model->insert_log($log_data);
		ob_start();
		$this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "product_alert.csv";
        $result = $this->product_alert_model->getCsvData();
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
	}
}
?>