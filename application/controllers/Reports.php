<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('reports_model');
		$this->load->model('log_model');
	}
	public function index(){
		$this->daily();
	} 
	public function purchase(){
		$data['data'] = $this->reports_model->getPurchase();
		$data['purchase_items'] = $this->reports_model->getPurchaseItems();
		$data['products'] = $this->reports_model->getProduct();
		$data['user'] = $this->reports_model->getUsers();
		$data['supplier'] = $this->reports_model->getSuppliers();
		$data['warehouse'] = $this->reports_model->getWarehouses();
		$this->load->view('reports/purchase',$data);
	}
	public function purchase_report(){
		$reference_no = $this->input->post('reference_no');
		$user_id = $this->input->post('user');
		$supplier_id = $this->input->post('supplier');
		$warehouse_id = $this->input->post('warehouse');
	 	$start_date =  $this->input->post('start_date');
		$end_date =  $this->input->post('end_date');
		if($this->input->post('submit') == "Submit"){
			$data['data'] = $this->reports_model->getPurchaseDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);
			$data['purchase_items'] = $this->reports_model->getPurchaseItems();
			$data['products'] = $this->reports_model->getProduct();
			$data['user'] = $this->reports_model->getUsers();
			$data['supplier'] = $this->reports_model->getSuppliers();
			$data['warehouse'] = $this->reports_model->getWarehouses();
			$this->load->view('reports/purchase',$data);
		}
		else if($this->input->post('submit') == "PDF"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Purchase PDF Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$data['purchase'] = $this->reports_model->getPurchaseDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);

			$data['purchase_items'] = $this->reports_model->getPurchaseItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/purchase_pdf',$data,true);

			include(APPPATH.'third_party/mpdf/mpdf.php');
	        $mpdf = new mPDF();
	        $mpdf->allow_charset_conversion = true;
	        $mpdf->charset_in = 'UTF-8';
	        $mpdf->WriteHTML($html);
	        $mpdf->Output('Purchase.pdf','I');
		}
		else if($this->input->post('submit') == "CSV"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Purchase CSV Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$this->load->dbutil();
			$delimiter = ",";
	        $newline = "\r\n";
	        $filename = "products_report.csv";
			$data  = $this->reports_model->getPurchaseDetailsForCSV($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);
			/*$products = $this->reports_model->getPurchaseProduct();
			foreach ($data as  $key => $row) {
				foreach ($products as $value) {
					if($row->purchase_id == $value->purchase_id){
						if(!isset($data[$key]->product)){
							$data[$key]->product = $value->name.'('.$value->quantity.")";
						}
						else{
							$data[$key]->product .= ','.$value->name.'('.$value->quantity.")";
						}
					}
				}
			}*/
			$data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        	force_download($filename, $data);
		}
		else if($this->input->post('submit') == "Print"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Purchase Print Generated'
				);
			$this->log_model->insert_log($log_data);
			$data['purchase'] = $this->reports_model->getPurchaseDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);
			$data['purchase_items'] = $this->reports_model->getPurchaseItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/purchase_pdf',$data);

			
		}
	}
	public function purchase_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['purchase'] = $this->reports_model->getPurchase();
		$data['purchase_items'] = $this->reports_model->getPurchaseItems();
		$data['products'] = $this->reports_model->getProduct();
		$html = $this->load->view('reports/purchase_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('purchase.pdf','I');
	}
	public function purchase_return(){
		$data['purchase_return'] = $this->reports_model->getPurchaseReturn();
		$data['purchase_return_items'] = $this->reports_model->getPurchaseReturnItems();
		$data['products'] = $this->reports_model->getProduct();
		$data['user'] = $this->reports_model->getUsers();
		$data['supplier'] = $this->reports_model->getSuppliers();
		$data['warehouse'] = $this->reports_model->getWarehouses();
		$this->load->view('reports/purchase_return',$data);
	}
	public function purchase_return_report(){
		$reference_no = $this->input->post('reference_no');
		$user_id = $this->input->post('user');
		$supplier_id = $this->input->post('supplier');
		$warehouse_id = $this->input->post('warehouse');
	 	$start_date =  $this->input->post('start_date');
		$end_date =  $this->input->post('end_date');
		if($this->input->post('submit') == "Submit"){
			$data['purchase_return'] = $this->reports_model->getPurchaseReturnDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);
			$data['purchase_return_items'] = $this->reports_model->getPurchaseReturnItems();
			$data['products'] = $this->reports_model->getProduct();
			$data['user'] = $this->reports_model->getUsers();
			$data['supplier'] = $this->reports_model->getSuppliers();
			$data['warehouse'] = $this->reports_model->getWarehouses();
			$this->load->view('reports/purchase_return',$data);
		}
		else if($this->input->post('submit') == "PDF"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Purchase Return PDF Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$data['purchase_return'] = $this->reports_model->getPurchaseReturnDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);

			$data['purchase_return_items'] = $this->reports_model->getPurchaseReturnItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/purchase_return_pdf',$data,true);

			include(APPPATH.'third_party/mpdf/mpdf.php');
	        $mpdf = new mPDF();
	        $mpdf->allow_charset_conversion = true;
	        $mpdf->charset_in = 'UTF-8';
	        $mpdf->WriteHTML($html);
	        $mpdf->Output('purchase_return.pdf','I');
		}
		else if($this->input->post('submit') == "CSV"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Purchase Return CSV Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$this->load->helper('download');
			$this->load->dbutil();
			$this->load->helper('file');
			$delimiter = ",";
	        $newline = "\r\n";
	        $filename = "products_report.csv";
			$data  = $this->reports_model->getPurchaseReturnDetailsForCSV($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);
			/*$products = $this->reports_model->getPurchaseReturnProduct();
			foreach ($data as  $key => $row) {
				foreach ($products as $value) {
					if($row->id == $value->purchase_return_id){
						if(!isset($data[$key]->product)){
							$data[$key]->product = $value->name.'('.$value->quantity.")";
						}
						else{
							$data[$key]->product .= ','.$value->name.'('.$value->quantity.")";
						}
					}
				}
			}*/
			$data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        	force_download($filename, $data);
		}

		else if($this->input->post('submit') == "Print"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Purchase Return Print Generated'
				);
			$this->log_model->insert_log($log_data);

			$data['purchase_return'] = $this->reports_model->getPurchaseReturnDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);

			$data['purchase_return_items'] = $this->reports_model->getPurchaseReturnItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/purchase_return_pdf',$data);

			
		}
	}
	public function purchase_return_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['purchase_return'] = $this->reports_model->getPurchaseReturn();
		$data['purchase_return_items'] = $this->reports_model->getPurchaseReturnItems();
		$data['products'] = $this->reports_model->getProduct();
		$html = $this->load->view('reports/purchase_return_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('purchase_return.pdf','I');
	}
	public function sales(){
		$data['sales'] = $this->reports_model->getSales();
		$data['sales_items'] = $this->reports_model->getSalesItems();
		$data['products'] = $this->reports_model->getProduct();
		$data['biller'] = $this->reports_model->getBillers();
		$data['user'] = $this->reports_model->getUsers();
		$data['warehouse'] = $this->reports_model->getWarehouses();
		$data['client'] = $this->reports_model->getClients();
		$data['discount'] = $this->reports_model->getDiscounts();
		$this->load->view('reports/sales',$data);
	}
	public function sales_report(){
		$reference_no = $this->input->post('reference_no');
		$user_id = $this->input->post('user');
		$biller_id = $this->input->post('biller');
		$warehouse_id = $this->input->post('warehouse');
		$client_id = $this->input->post('client');
		$discount_id = $this->input->post('discount');
	 	$start_date =  $this->input->post('start_date');
		$end_date =  $this->input->post('end_date');
		if($this->input->post('submit') == "Submit"){
			$data['sales'] = $this->reports_model->getSalesDetails($reference_no,$user_id,$biller_id,$warehouse_id,$client_id,$discount_id,$start_date,$end_date);

			$data['sales_items'] = $this->reports_model->getSalesItems();
			$data['products'] = $this->reports_model->getProduct();
			$data['biller'] = $this->reports_model->getBillers();
			$data['user'] = $this->reports_model->getUsers();
			$data['warehouse'] = $this->reports_model->getWarehouses();
			$data['client'] = $this->reports_model->getClients();
			$data['discount'] = $this->reports_model->getDiscounts();
			$this->load->view('reports/sales',$data);
		}
		else if($this->input->post('submit') == "PDF"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Sales PDF Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$data['sales'] = $this->reports_model->getSalesDetails($reference_no,$user_id,$biller_id,$warehouse_id,$client_id,$discount_id,$start_date,$end_date);

			$data['sales_items'] = $this->reports_model->getSalesItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/sales_pdf',$data,true);

			include(APPPATH.'third_party/mpdf/mpdf.php');
	        $mpdf = new mPDF();
	        $mpdf->allow_charset_conversion = true;
	        $mpdf->charset_in = 'UTF-8';
	        $mpdf->WriteHTML($html);
	        $mpdf->Output('sales.pdf','I');
		}
		else if($this->input->post('submit') == "CSV"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Sales CSV Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$this->load->helper('download');
			$this->load->dbutil();
			$this->load->helper('file');
			$delimiter = ",";
	        $newline = "\r\n";
	        $filename = "products_report.csv";
			$data  = $this->reports_model->getSalesDetailsForCSV($reference_no,$user_id,$biller_id,$warehouse_id,$client_id,$discount_id,$start_date,$end_date);
			/*$products = $this->reports_model->getSalesProduct();
			foreach ($data as  $key => $row) {
				foreach ($products as $value) {
					if($row->sales_id == $value->sales_id){
						if(!isset($data[$key]->product)){
							$data[$key]->product = $value->name.'('.$value->quantity.")";
						}
						else{
							$data[$key]->product .= ','.$value->name.'('.$value->quantity.")";
						}
					}
				}
			}*/
			$data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        	force_download($filename, $data);
		}
		else if($this->input->post('submit') == "Print"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Sales Print Generated'
				);
			$this->log_model->insert_log($log_data);

			$data['sales'] = $this->reports_model->getSalesDetails($reference_no,$user_id,$biller_id,$warehouse_id,$client_id,$discount_id,$start_date,$end_date);

			$data['sales_items'] = $this->reports_model->getSalesItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/sales_pdf.pdf',$data);

			
		}
	}
	public function sales_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['sales'] = $this->reports_model->getSales();
		$data['sales_items'] = $this->reports_model->getSalesItems();
		$data['products'] = $this->reports_model->getProduct();
		$html = $this->load->view('reports/sales_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('sales.pdf','I');
	}
	public function sales_return(){
		$data['sales_return'] = $this->reports_model->getSalesReturn();
		$data['sales_return_items'] = $this->reports_model->getSalesReturnItems();
		$data['products'] = $this->reports_model->getProduct();
		$data['biller'] = $this->reports_model->getBillers();
		$data['user'] = $this->reports_model->getUsers();
		$data['warehouse'] = $this->reports_model->getWarehouses();
		$data['client'] = $this->reports_model->getClients();
		$data['discount'] = $this->reports_model->getDiscounts();
		$this->load->view('reports/sales_return',$data);
	}
	public function sales_return_report(){
		$reference_no = $this->input->post('reference_no');
		$user_id =$this->input->post('user');
		$biller_id = $this->input->post('biller');
		$warehouse_id = $this->input->post('warehouse');
		$client_id = $this->input->post('client');
		$discount_id = $this->input->post('discount');
	 	$start_date =  $this->input->post('start_date');
		$end_date =  $this->input->post('end_date');
		if($this->input->post('submit') == "Submit"){
			$data['sales_return'] = $this->reports_model->getSalesReturnDetails($reference_no,$user_id,$biller_id,$warehouse_id,$client_id,$discount_id,$start_date,$end_date);

			$data['sales_return_items'] = $this->reports_model->getSalesReturnItems();
			$data['products'] = $this->reports_model->getProduct();
			$data['biller'] = $this->reports_model->getBillers();
			$data['user'] = $this->reports_model->getUsers();
			$data['warehouse'] = $this->reports_model->getWarehouses();
			$data['client'] = $this->reports_model->getClients();
			$data['discount'] = $this->reports_model->getDiscounts();
			$this->load->view('reports/sales_return',$data);
		}
		else if($this->input->post('submit') == "PDF"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Sales Return PDF Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$data['sales_return'] = $this->reports_model->getSalesReturnDetails($reference_no,$user_id,$biller_id,$warehouse_id,$client_id,$discount_id,$start_date,$end_date);

			$data['sales_return_items'] = $this->reports_model->getSalesReturnItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/sales_return_pdf',$data,true);

			include(APPPATH.'third_party/mpdf/mpdf.php');
	        $mpdf = new mPDF();
	        $mpdf->allow_charset_conversion = true;
	        $mpdf->charset_in = 'UTF-8';
	        $mpdf->WriteHTML($html);
	        $mpdf->Output('sales_return.pdf','I');
		}
		else if($this->input->post('submit') == "CSV"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Sales Return CSV Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$this->load->helper('download');
			$this->load->dbutil();
			$this->load->helper('file');
			$delimiter = ",";
	        $newline = "\r\n";
	        $filename = "products_report.csv";
			$data  = $this->reports_model->getSalesReturnDetailsForCSV($reference_no,$user_id,$biller_id,$warehouse_id,$client_id,$discount_id,$start_date,$end_date);
			/*$products = $this->reports_model->getSalesReturnProduct();
			foreach ($data as  $key => $row) {
				foreach ($products as $value) {
					if($row->id == $value->sale_return_id){
						if(!isset($data[$key]->product)){
							$data[$key]->product = $value->name.'('.$value->quantity.")";
						}
						else{
							$data[$key]->product .= ','.$value->name.'('.$value->quantity.")";
						}
					}
				}
			}*/
			$data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        	force_download($filename, $data);
		}

		else if($this->input->post('submit') == "Print"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Sales Return Print Generated'
				);
			$this->log_model->insert_log($log_data);

			$data['sales_return'] = $this->reports_model->getSalesReturnDetails($reference_no,$user_id,$biller_id,$warehouse_id,$client_id,$discount_id,$start_date,$end_date);

			$data['sales_return_items'] = $this->reports_model->getSalesReturnItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/sales_return_pdf.pdf',$data);

			
		}
	}
	public function sales_return_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['sales_return'] = $this->reports_model->getSalesReturn();
		$data['sales_return_items'] = $this->reports_model->getSalesReturnItems();
		$data['products'] = $this->reports_model->getProduct();
		$html = $this->load->view('reports/sales_return_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('sales_return.pdf','I');
	}
	public function products(){
		$data = $this->reports_model->getPurchaseSalse();
		$data['products'] = $this->reports_model->getProduct();
		$this->load->view('reports/products',$data);
	}
	public function products_report(){
		$product_id = $this->input->post('product');
	 	$start_date =  $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		if($this->input->post('submit') == "Submit"){
			$data = $this->reports_model->getProductsDetails($product_id,$start_date,$end_date);
			$data['products'] = $this->reports_model->getProduct();
			$this->load->view('reports/products',$data);
		}
		else if($this->input->post('submit') == "PDF"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Product PDF Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$data = $this->reports_model->getProductsDetails($product_id,$start_date,$end_date);
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/products_pdf',$data,true);

			include(APPPATH.'third_party/mpdf/mpdf.php');
	        $mpdf = new mPDF();
	        $mpdf->allow_charset_conversion = true;
	        $mpdf->charset_in = 'UTF-8';
	        $mpdf->WriteHTML($html);
	        $mpdf->Output('products.pdf','I');
		}
		else if($this->input->post('submit') == "CSV"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Product CSV Generated'
				);
			$this->log_model->insert_log($log_data);
            $this->load->dbutil();
	        $delimiter = ",";
	        $newline = "\r\n";
	        $filename = "filename_you_wish.csv";
	        $query = "SELECT * FROM category";
	        $result = $this->reports_model->getProductsDetailsForCSV($product_id,$start_date,$end_date);
	        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
	        force_download($filename, $data);
		}
	}
	public function daily(){
		$this->load->model('ion_auth_model');
		$data['current_month_sales'] = $this->ion_auth_model->currentMonthSales();
		$data['profit'] = $this->ion_auth_model->profit();
		$data['day_profit'] = $this->ion_auth_model->dayProfit();
		$data['sales'] =  $this->ion_auth_model->daySales();
		$data['sales_return'] =  $this->ion_auth_model->daySalesReturn();
		$this->load->view('reports/daily',$data);
	}
	public function tax(){
		$data['data'] = $this->reports_model->getTax();
		$this->load->view('reports/tax',$data);
	}
}
?>