<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('email_model');
		$this->load->model('log_model');
		$this->load->library('email');
	}

	public function index(){
		$data['email_status'] = $this->email_model->getEmailStatus();
		$this->load->view('email/sent_email', $data);
	}

	public function email_history($query){
		$data['email_saved'] = $this->email_model->getEmailSaved();
		$this->load->view('email/email_history', $data);
	}

	public function filter_email(){
		$email_id = $this->input->post('email_id');
		$email_address = $this->input->post('email_address');

		$data['data'] = $this->email_model->getFilteredEmail($email_id, $email_address);
		echo json_encode($data);
	}

	public function get_bill_challan(){
		// get all filtered sales record and display list
		$data['data'] = $this->email_model->getBillChallan();

		echo json_encode($data);
	}

	public function bl_pdf($id){
		$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'Invoice Generated'
			);
		$this->log_model->insert_log($log_data);
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['data'] = $this->email_model->getSalesDetails($id);
		$data['items'] = $this->email_model->salesItemsView($id);
		$html = $this->load->view('email/compose/bl_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($data['data'][0]->reference_no.'pdf','I');
	}

	public function ch_pdf($id){
		$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'Invoice Generated'
			);
		$this->log_model->insert_log($log_data);
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['data'] = $this->email_model->getSalesDetails($id);
		$data['items'] = $this->email_model->salesItemsView($id);
		$html = $this->load->view('email/compose/ch_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($data['data'][0]->reference_no.'pdf','I');
	}

	public function send_email(){
		$type = $this->input->post('type');
		$ref_no = $this->input->post('ref_no');
		$mail_no = $this->input->post('mail_no');
		$mail_type = $this->input->post('mail_type');
		$from = $this->input->post('from');
        $to = $this->input->post('to');
        $cc = $this->input->post('cc');
        $bcc = $this->input->post('bcc');
        $subject = $this->input->post('subject');
        $body = $this->input->post('mail_body');

        $contact_person = $this->input->post('contact_person');
        $customer_id = $this->input->post('customer_id');
        $customer_name = $this->input->post('customer_name');
        $indent_no = $this->input->post('indent_no');
        $manufacturer_id = $this->input->post('manufacturer_id');
        $manufacturer_name = $this->input->post('manufacturer_name');
        $grand_total = $this->input->post('grand_total');

        $product_data = $this->input->post('product_data');
        $js_data = json_decode($product_data);

        date_default_timezone_set('Asia/Dhaka');
		$datetime = date('Y-m-d H:i:s');
        $data = array(
        		'ref_no' => $ref_no,
				'mail_no' => $mail_no,
				'fromm' => $from,
				'too' => $to,
				'cc' => $cc,
				'bcc' => $bcc,
				'subject' => $subject,
				'body' => $body,
				'customer_id' => $customer_id,
				'customer_name' => $customer_name,
				'status' => 'active', 
				'user_id'  => $this->session->userdata('user_id'),
				'datetime' => $datetime
			);

        $email_status = array(
				'ref_no' => $ref_no,
				'email' => $to,
				'sample_draft_status' => 'NO',
				'test_report_status' => 'NO',
				'inquiry_status' => 'NO',
				'price_quotation_status' => 'NO',
				'customer_feedback_status' => 'NO',
				'indent_status' => 'NO',
				'lc_status' => 'NO',
				'shipping_status' => 'NO',
				'payment_status' => 'NO',
				'status' => 'active', 
				'user_id'  => $this->session->userdata('user_id'),
				'datetime' => $datetime
			);

		/*$email_setting  = array(
				'mailtype'  =>'html',
				'charset'   => 'iso-8859-1',
				'wordwrap' 	=> TRUE
			);
		
		$this->email->set_mailtype("html");
		$this->email->initialize($email_setting);*/
		
		$this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        //$this->email->set_header('Header', 'Quotation');
        $this->email->from($from, 'Winmark'); 
        $this->email->to($to);
        if(!empty($cc)){
        	$this->email->cc($cc);
        }
        if(!empty($bcc)){
        	$this->email->bcc($bcc);
        }
        $this->email->subject($subject);
        $this->email->message($body);

        //Send mail 
        if($this->email_model->addModel($data, $mail_type, $type) && $this->email_model->addMailStatus($email_status, $mail_type)){
        	if($type == 'send'){
        		$this->email->send();

        		$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Email Sent'
				);
				$this->log_model->insert_log($log_data);
				$this->session->set_flashdata('fail', 'Email Sent Successfully.');
        	}

        	else{
        		$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Email Saved'
				);
				$this->log_model->insert_log($log_data);
				$this->session->set_flashdata('fail', 'Email Saved Successfully.');
        	}

			if($mail_type == 'indent'){
				$remittance_history = array(
					'email_date' => date('Y-m-d'),
					'contact_person' => $contact_person,
					'customer_id' => $customer_id,
					'customer_name' => $customer_name,
					'manufacturer_id' => $manufacturer_id,
					'manufacturer_name' => $manufacturer_name,
					'indent_no' => $indent_no,
					'grand_total' => $grand_total,
					'status' => 'active', 
					'user_id'  => $this->session->userdata('user_id'),
					'datetime' => $datetime
				);

				if($remittance_history_id = $this->email_model->addRemittanceHistory($remittance_history)){
					$log_data = array(
							'user_id'  => $this->session->userdata('user_id'),
							'table_id' => $remittance_history_id,
							'message'  => 'Remittance History data added.'
						);
					$this->log_model->insert_log($log_data);

					if($js_data == null){
					}
					else{
						foreach ($js_data as $key => $prod_value) {
							if($prod_value==null){
							}
							else{
								date_default_timezone_set('Asia/Dhaka');
								$datetime = date('Y-m-d H:i:s');
								$name = $prod_value->name;
								$price = $prod_value->price;
								$quantity = $prod_value->quantity;
								$value = $prod_value->value;

								$remittance_history_item = array(
											"remittance_history_id" => $remittance_history_id,
											"product_name" => $name,
											"price" => $price,
											"quantity" => $quantity,
											"total_value" => $value,
											"status" => 'active',
											"user_id" => $this->session->userdata('user_id'),
											"datetime" => $datetime
										);

								$this->email_model->addRemittanceHistoryItem($remittance_history_item);
							}
						}
					}
				}
			}

			if($this->input->post('process') == 'print'){
			}
			else{
				redirect('Email/preview_email','refresh');
			}
        }
    }

    public function view_pdf(){
    	ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$email_pdf = $this->input->post('email_pdf');
		$file_name = $this->input->post('file_name');
		$html = $email_pdf;

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

    public function preview_email(){
    	$data['type'] = $this->input->post('type');
		$data['ref_no'] = $this->input->post('ref_no');
		$data['mail_no'] = $this->input->post('mail_no');
		$data['mail_type'] = $this->input->post('mail_type');
		$data['from'] = $this->input->post('from');
        $data['to'] = $this->input->post('to');
        $data['cc'] = $this->input->post('cc');
        $data['bcc'] = $this->input->post('bcc');
        $data['subject'] = $this->input->post('subject');
        $data['body'] = $this->input->post('mail_body');

        $data['contact_person'] = $this->input->post('contact_person');
        $data['customer_id'] = $this->input->post('customer_id');
        $data['customer_name'] = $this->input->post('customer_name');
        $data['indent_no'] = $this->input->post('indent_no');
        $data['manufacturer_id'] = $this->input->post('manufacturer_id');
        $data['manufacturer_name'] = $this->input->post('manufacturer_name');
        $data['grand_total'] = $this->input->post('grand_total');

        $data['product_data'] = $this->input->post('product_data');

        $this->load->view('email/compose/preview_email', $data);
    }

    public function numtowords($num){ 
		$decones = array( 
		            '01' => "One", 
		            '02' => "Two", 
		            '03' => "Three", 
		            '04' => "Four", 
		            '05' => "Five", 
		            '06' => "Six", 
		            '07' => "Seven", 
		            '08' => "Eight", 
		            '09' => "Nine", 
		            10 => "Ten", 
		            11 => "Eleven", 
		            12 => "Twelve", 
		            13 => "Thirteen", 
		            14 => "Fourteen", 
		            15 => "Fifteen", 
		            16 => "Sixteen", 
		            17 => "Seventeen", 
		            18 => "Eighteen", 
		            19 => "Nineteen" 
		            );
		$ones = array( 
		            0 => " ",
		            1 => "One",     
		            2 => "Two", 
		            3 => "Three", 
		            4 => "Four", 
		            5 => "Five", 
		            6 => "Six", 
		            7 => "Seven", 
		            8 => "Eight", 
		            9 => "Nine", 
		            10 => "Ten", 
		            11 => "Eleven", 
		            12 => "Twelve", 
		            13 => "Thirteen", 
		            14 => "Fourteen", 
		            15 => "Fifteen", 
		            16 => "Sixteen", 
		            17 => "Seventeen", 
		            18 => "Eighteen", 
		            19 => "Nineteen" 
		            ); 
		$tens = array( 
		            0 => "",
		            2 => "Twenty", 
		            3 => "Thirty", 
		            4 => "Forty", 
		            5 => "Fifty", 
		            6 => "Sixty", 
		            7 => "Seventy", 
		            8 => "Eighty", 
		            9 => "Ninety" 
		            ); 
		$hundreds = array( 
		            "Hundred", 
		            "Thousand", 
		            "Million", 
		            "Billion", 
		            "Trillion", 
		            "Quadrillion" 
		            ); //limit t quadrillion 
		$num = number_format($num,2,".",","); 
		$num_arr = explode(".",$num); 
		$wholenum = $num_arr[0]; 
		$decnum = $num_arr[1]; 
		$whole_arr = array_reverse(explode(",",$wholenum)); 
		krsort($whole_arr); 
		$rettxt = ""; 
		foreach($whole_arr as $key => $i){ 
		    if($i < 20){ 
		        $rettxt .= $ones[$i]; 
		    }
		    elseif($i < 100){ 
		        $rettxt .= $tens[substr($i,0,1)]; 
		        $rettxt .= " ".$ones[substr($i,1,1)]; 
		    }
		    else{ 
		        $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
		        $rettxt .= " ".$tens[substr($i,1,1)]; 
		        $rettxt .= " ".$ones[substr($i,2,1)]; 
		    } 
		    if($key > 0){ 
		        $rettxt .= " ".$hundreds[$key]." "; 
		    } 

		} 

		if($decnum > 0){ 
		    $rettxt .= " point "; 
		    if($decnum < 20){ 
		        $rettxt .= $decones[$decnum]; 
		    }
		    elseif($decnum < 100){ 
		        $rettxt .= $tens[substr($decnum,0,1)]; 
		        $rettxt .= " ".$ones[substr($decnum,1,1)]; 
		    }
		} 

		echo json_encode($rettxt);
	}

	public function remittance_history(){
		$data['data'] = $this->email_model->getRemittanceHistory();

		$this->load->view('email/remittance_history', $data);
	}

	public function get_customer_data(){
		$data['data'] = $this->email_model->getCustomerData();
		echo json_encode($data);
	}

	public function get_manufacturer_data(){
		$data['data'] = $this->email_model->getManufacturerData();
		echo json_encode($data);
	}

	public function get_remittance_history($remittance_history_id)
	{
		$data = $this->email_model->getRemittanceHistory2($remittance_history_id);
		foreach ($data as $key) {
			$remittance_history_id = $key->remittance_history_id;
			$data['products'] = $this->email_model->getRemittanceHistoryItem($remittance_history_id);
		}

		echo json_encode($data);
	}

	public function edit_remittance_history()
	{
		date_default_timezone_set('Asia/Dhaka');
		$datetime = date('Y-m-d H:i:s');
		$data = array(
			"remittance_history_id" => $this->input->post('remittance_history_id'),
			"contact_person" => $this->input->post('contact_person'),
			"customer_id" => $this->input->post('customer_id'),
			"customer_name" => $this->input->post('customer_name'),
			"manufacturer_id" => $this->input->post('manufacturer_id'),
			"manufacturer_name" => $this->input->post('manufacturer_name'),
			"indent_no" => $this->input->post('indent_no'),
			"lc" => $this->input->post('lc'),
			"comission" => $this->input->post('comission'),
			"op" => $this->input->post('op'),
			"product_qty" => $this->input->post('product_qty'),
			"user_id" => $this->session->userdata('user_id'),
			"datetime" => $datetime,
		);

		$update = $this->email_model->editRemittanceHistory($data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_remittance_history($id){
		if($this->email_model->deleteRemittanceHistory($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Remittance History Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('email/remittance_history');
		}
		else{
			$this->session->set_flashdata('fail', 'Remittance History can not be Deleted.');
			redirect("email/remittance_history",'refresh');
		}
	}

	public function filterRemittanceHistory(){
		$date_range = $this->input->post('date_range');
		$prod_category = $this->input->post('prod_category');

		if($date_range){
			$explode = explode(' - ', $date_range);
			$start_date = $explode[0];
			$start_date = date("Y-m-d", strtotime($start_date));
			$end_date = $explode[1];
			$end_date = date("Y-m-d", strtotime($end_date));
		}

		// get all filtered remittance history record and display list
		if($prod_category == 0){
			$data['data'] = $this->email_model->getFilteredRemittanceHistory($start_date, $end_date);

			foreach ($data['data'] as $key => $product){
				$id = $product->remittance_history_id;

		        $products = $this->db->select('*')
			        				 ->where('remittance_history_id', $id)
			        				 ->get('remittance_history_item')->result();

			    $data['data'][$key]->products = $products;
			}

			echo json_encode($data);
		}

		else{
			$data['data'] = $this->email_model->getFilteredRemittanceHistory($start_date, $end_date);

			foreach ($data['data'] as $key => $product){
				$id = $product->remittance_history_id;

				$products = $this->db->select('r.*, p.name, p.category_id')
									 ->from('remittance_history_item r')
									 ->join('products p', 'p.name = r.product_name')
			        				 ->where('r.remittance_history_id', $id)
			        				 ->where('p.category_id', $prod_category)
			        				 ->group_by('p.name')
			        				 ->get()
			        				 ->result();

			    $data['data'][$key]->products = $products;
			}

			if(empty($products)) $data['data'] = [];

			echo json_encode($data);
		}
	}

    public function remarks($value){
		$id = $this->input->post('id');

		if($value == 1){
			$remarks['test_report_remark'] = $this->input->post('remarks');
		}
		else if($value == 2){
			$remarks['customer_feedback_remark'] = $this->input->post('remarks');
		}
		else if($value == 3){
			$remarks['lc_status_remark'] = $this->input->post('remarks');
		}
		else if($value == 4){
			$remarks['shipping_status_remark'] = $this->input->post('remarks');
		}
		else if($value == 5){
			$remarks['payment_status_remark'] = $this->input->post('remarks');
		}

		$this->email_model->editMailRemark($id, $remarks);
	}

	public function status($id){
		$name = $this->input->post('name');

		if($name == 'sample_draft_status'){
			$value['sample_draft_status'] = $this->input->post('value');
		}
		else if($name == 'test_report_status'){
			$value['test_report_status'] = $this->input->post('value');
		}
		else if($name == 'inquiry_status'){
			$value['inquiry_status'] = $this->input->post('value');
		}
		else if($name == 'price_quotation_status'){
			$value['price_quotation_status'] = $this->input->post('value');
		}
		else if($name == 'customer_feedback_status'){
			$value['customer_feedback_status'] = $this->input->post('value');
		}
		else if($name == 'indent_status'){
			$value['indent_status'] = $this->input->post('value');
		}
		else if($name == 'lc_status'){
			$value['lc_status'] = $this->input->post('value');
		}
		else if($name == 'shipping_status'){
			$value['shipping_status'] = $this->input->post('value');
		}
		else if($name == 'payment_status'){
			$value['payment_status'] = $this->input->post('value');
		}

		$this->email_model->editMailStatus($id, $value);
	}

	/* 
		Compose
	*/
	public function quotation(){
		$data['ref_no'] = $this->uri->segment('3');
		$data['reference_no'] = $this->email_model->createReferenceNo();
		$data['quotation_no'] = $this->email_model->createQuotationNo();
		$data['product'] = $this->email_model->getProduct();
		$data['client'] = $this->email_model->getClient();
		$data['client2'] = $this->email_model->getManufacturerAndSupplier();
		$data['currency'] = $this->email_model->getCurrency();
		$data['unit'] = $this->email_model->getUnit();
		$data['shipping'] = $this->email_model->getShippingMode();
		$data['payment_mode'] = $this->email_model->getPaymentMode();
		$data['email_status'] = $this->email_model->getEmailStatus();
		$this->load->view('email/compose/quotation', $data);
	}

	public function inquiry_mail(){
		$client_id = $this->uri->segment('3');
		$product_id = $this->uri->segment('4');

		if(!empty($client_id) && !empty($product_id)){
			$data['client'] = $this->email_model->getClient3($client_id);
			$data['product_id'] = $product_id;
		}
			
		$data['ref_no'] = $this->uri->segment('3');
		$data['reference_no'] = $this->email_model->createReferenceNo();
		$data['inquiry_no'] = $this->email_model->createInquiryNo();
		$data['clients'] = $this->email_model->getClient();
		$data['product'] = $this->email_model->getProduct();
		$data['shipping'] = $this->email_model->getShippingMode();
		$data['payment_mode'] = $this->email_model->getPaymentMode();
		$data['commission'] = $this->email_model->getCommission();
		$data['email_status'] = $this->email_model->getEmailStatus();
		
		$this->load->view('email/compose/inquiry_mail', $data);
	}

	public function sample_draft(){
		$data['client_id'] = $this->uri->segment('3');
		$data['client_id2'] = $this->uri->segment('4');
		$data['product_id'] = $this->uri->segment('5');
		$data['product_qty'] = $this->uri->segment('6');
		
		if($data['client_id']){
			$data['client_details1'] = $this->email_model->getClient3($data['client_id']);
		}
		if($data['client_id2']){
			$data['client_details2'] = $this->email_model->getClient3($data['client_id2']);
		}
		if($data['product_id']){
			$data['product_name'] = $this->email_model->getProduct2($data['product_id']);
		}

		if(is_numeric($this->uri->segment('3'))){
			$data['ref_no'] = '';
		}
		else{
			$data['ref_no'] = $this->uri->segment('3');
		}

		$data['reference_no'] = $this->email_model->createReferenceNo();
		$data['sample_draft_no'] = $this->email_model->createSampleDraftNo();
		$data['client'] = $this->email_model->getClient();
		$data['client2'] = $this->email_model->getManufacturerAndSupplier();
		$data['product'] = $this->email_model->getProduct();
		$data['currency'] = $this->email_model->getCurrency();
		$data['unit'] = $this->email_model->getUnit();
		$data['shipping'] = $this->email_model->getShippingMode();
		$data['payment_mode'] = $this->email_model->getPaymentMode();
		$data['email_status'] = $this->email_model->getEmailStatus();
		
		$this->load->view('email/compose/sample_draft', $data);
	}

	public function raw(){
		$this->load->view('email/compose/raw');
	}

	public function proforma_invoice(){
		$data['ref_no'] = $this->uri->segment('3');
		$data['reference_no'] = $this->email_model->createReferenceNo();
		$data['proforma_invoice_no'] = $this->email_model->createProformaInvoiceNo();
		$data['client'] = $this->email_model->getClient();
		$data['client2'] = $this->email_model->getManufacturer();
		$data['client3'] = $this->email_model->getSupplier();
		$data['product'] = $this->email_model->getProduct();
		$data['consignee'] = $this->email_model->getConsignee();
		$data['country_of_goods'] = $this->email_model->getCountryOfGoods();
		$data['port_of_loading'] = $this->email_model->getPortOfLoading();
		$data['port_of_discharge'] = $this->email_model->getPortOfDischarge();
		$data['country_of_final_destination'] = $this->email_model->getCountryOfGoods();
		$data['banker'] = $this->email_model->getBanker();
		$data['currency'] = $this->email_model->getCurrency();
		$data['unit'] = $this->email_model->getUnit();
		$data['shipping'] = $this->email_model->getShippingMode();
		$data['payment_mode'] = $this->email_model->getPaymentMode();
		$data['email_status'] = $this->email_model->getEmailStatus();
		
		$this->load->view('email/compose/proforma_invoice', $data);
	}

	public function emails_view($type, $ref_no){
		$data['data'] = $this->email_model->emailsView($type, $ref_no);

		echo json_encode($data);
	}

	/* 
		Get State Name
	*/
	public function get_state($id){
		$data = $this->email_model->getState($id);
		echo json_encode($data);
		//print_r(json_encode($data));
	}

	/* 
		Get City Name
	*/
	public function get_city($id){
		$data = $this->email_model->getCity($id);
		echo json_encode($data);
		//print_r(json_encode($data));
	}

	/* 
		Get Country Name
	*/
	public function get_country($id){
		$data = $this->email_model->getCountry($id);
		echo json_encode($data);
		//print_r(json_encode($data));
	}

	/* 
		Get Kind Attention
	*/
	public function get_kind_attention($id){
		$data = $this->email_model->getKindAttention($id);

		foreach ($data as $key) {
	        $names = $key->name;
	        $designations = $key->designation;
	    }

		$data2 = array();
		$data2['name'] = unserialize($names);
		$data2['designation'] = unserialize($designations);
		echo json_encode($data2);
		//print_r(json_encode($data));
	}

	/* 
		this function is used to have clientwise product list in email compose 
	*/
	public function get_product_list($id){
		$data = $this->email_model->getProductList($id);
		echo json_encode($data);
		//print_r(json_encode($data));
	}

	/* 
		this function is used to have multiple clientwise product list in email compose 
	*/
	public function get_product_list2($client1, $client2){
		$data = $this->email_model->getProductList2($client1, $client2);
		echo json_encode($data);
		//print_r(json_encode($data));
	}

	/* 
		this function is used to have product category in email compose 
	*/
	public function get_product_category($id){
		$data = $this->email_model->getProductCategory($id);
		echo json_encode($data);
		//print_r(json_encode($data));
	}

	/* 
		this function is used to have clientwise product list in email compose 
	*/
	public function get_client_list($id){
		$data = $this->email_model->getClient2($id);
		echo json_encode($data);
		//print_r(json_encode($data));
	}

    public function read_email($type, $id){
    	$data['data'] = $this->email_model->getRecord($type, $id);
    	$data['prev_record'] = $this->email_model->getPrevRecord($type, ($id - 1));
    	$data['nxt_record'] = $this->email_model->getNxtRecord($type, ($id + 1));
		$this->load->view('email/read_email', $data);
    }

    public function delete($type, $id){
		if($this->email_model->deleteModel($type, $id)){
			$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'Email Deleted'
			);
			$this->log_model->insert_log($log_data);
			redirect('Email','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Email can not be Deleted.');
			redirect('Email','refresh');
		}
	}

	public function delete_mul(){
		if($this->input->post('selected_id')){
			$selected_id = $this->input->post('selected_id');
		}
		else if($this->input->post('selected_id1')){
			$selected_id = $this->input->post('selected_id1');
		}
		else{
			$selected_id = $this->input->post('selected_id2');
		}

		if($this->input->post('type')){
			$type = $this->input->post('type');
		}
		else{
			$type = $this->input->post('type2');
		}

		if(!empty($selected_id)){
			if($this->email_model->deleteMul($type, $selected_id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => '',
					'message'  => 'Email Deleted'
				);
				$this->log_model->insert_log($log_data);
				$this->session->set_flashdata('fail', 'Email Deleted.');
				redirect('Email','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Email can not be Deleted.');
				redirect("Email",'refresh');
			}
		}
		else{
			$this->session->set_flashdata('fail', 'Nothing Selected.');
			redirect("Email",'refresh');
		}
	}

	public function add(){
		$data = array(
				'email_protocol' => $this->input->post('email_protocol'),
				'email_encription' => $this->input->post('email_encription'),
				'smtp_host' => $this->input->post('smtp_host'),
				'smtp_port' => $this->input->post('smtp_port'),
				'smtp_email' => $this->input->post('smtp_email'),
				'from_address' => $this->input->post('from_address'),
				'from_name' => $this->input->post('from_name'),
				'smtp_username' => $this->input->post('smtp_username'),
				'smtp_password' => $this->input->post('smtp_password')
			);

		if($this->email_model->add($data)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Email Setup Updated'
				);
			$this->log_model->insert_log($log_data);
			$this->session->set_flashdata('fail', 'Email Setup Successfully Updated.');
			redirect('email','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Error in Update Email Setup.');
			redirect('email','refresh');
		}
	}

	/* 
		Configuration
	*/
	/* 
		call add view to add record
	*/
	public function shipping_mode_add(){
		$this->load->view('email/configuration/shipping_mode_add');
	} 

	public function commission_add(){
		$this->load->view('email/configuration/commission_add');
	}

	public function port_add(){
		$this->load->view('email/configuration/port_add');
	}

	public function payment_add(){
		$this->load->view('email/configuration/payment_add');
	}

	public function bankers_add(){
		$this->load->view('email/configuration/bankers_add');
	}

	public function port_of_discharge_add(){
		$this->load->view('email/configuration/port_of_discharge_add');
	}

	public function consignee_add(){
		$this->load->view('email/configuration/consignee_add');
	}

	/* 
		call list view to show record
	*/
	public function shipping_mode_list(){
		$data['data'] = $this->email_model->getshipping_mode_list();
		$this->load->view('email/configuration/shipping_mode_list',$data);
	}

	public function shipping_mode_list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'shipping_mode_list';
		$data['data'] = $this->email_model->getshipping_mode_list();
		$html = $this->load->view('email/configuration/shipping_mode_list_pdf',$data,true);

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

	public function filter_shipping_mode(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->email_model->getFilteredShippingMode($status);
		
		echo json_encode($data);
	}

	public function filterShippingModePDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered unit record and display list
		$data['data'] = $this->email_model->getFilteredShippingMode($status);

		$file_name = 'shipping_mode_list';
		$html = $this->load->view('email/configuration/shipping_mode_list_pdf',$data,true);

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

	public function commission_list(){
		$data['data'] = $this->email_model->getCommission_list();
		$this->load->view('email/configuration/commission_list',$data);
	}

	public function commission_list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'commission_list';
		$data['data'] = $this->email_model->getCommission_list();
		$html = $this->load->view('email/configuration/commission_list_pdf',$data,true);

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

	public function filter_commission(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->email_model->getFilteredCommission($status);
		
		echo json_encode($data);
	}

	public function filterCommissionPDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered unit record and display list
		$data['data'] = $this->email_model->getFilteredCommission($status);

		$file_name = 'commission_list';
		$html = $this->load->view('email/configuration/commission_list_pdf',$data,true);

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

	public function port_list(){
		$data['data'] = $this->email_model->getPort_list();
		$this->load->view('email/configuration/port_list',$data);
	}

	public function port_of_loading_list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'port_of_loading_list';
		$data['data'] = $this->email_model->getPort_list();
		$html = $this->load->view('email/configuration/port_of_loading_list_pdf',$data,true);

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

	public function filter_port(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->email_model->getFilteredPortOfLoading($status);
		
		echo json_encode($data);
	}

	public function filterPortOfLoadingPDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered unit record and display list
		$data['data'] = $this->email_model->getFilteredPortOfLoading($status);

		$file_name = 'port_of_loading_list';
		$html = $this->load->view('email/configuration/port_of_loading_list_pdf',$data,true);

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

	public function payment_list(){
		$data['data'] = $this->email_model->getPayment_list();
		$this->load->view('email/configuration/payment_list',$data);
	}

	public function payment_mode_list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'payment_mode_list';
		$data['data'] = $this->email_model->getPayment_list();
		$html = $this->load->view('email/configuration/payment_mode_list_pdf',$data,true);

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

	public function filter_payment(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->email_model->getFilteredPayment($status);
		
		echo json_encode($data);
	}

	public function filterPaymentModePDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered unit record and display list
		$data['data'] = $this->email_model->getFilteredPayment($status);

		$file_name = 'payment_mode_list';
		$html = $this->load->view('email/configuration/payment_mode_list_pdf',$data,true);

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

	public function bankers_list(){
		$data['data'] = $this->email_model->getBankers_list();
		$this->load->view('email/configuration/bankers_list',$data);
	}

	public function bankers_list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'banker_list';
		$data['data'] = $this->email_model->getBankers_list();
		$html = $this->load->view('email/configuration/bankers_list_pdf',$data,true);

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

	public function filter_banker(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->email_model->getFilteredBanker($status);
		
		echo json_encode($data);
	}

	public function filterBankersPDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered unit record and display list
		$data['data'] = $this->email_model->getFilteredBanker($status);

		$file_name = 'banker_list';
		$html = $this->load->view('email/configuration/bankers_list_pdf',$data,true);

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

	public function port_of_discharge_list(){
		$data['data'] = $this->email_model->getPort_of_discharge_list();
		$this->load->view('email/configuration/port_of_discharge_list',$data);
	}

	public function port_of_discharge_list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'port_of_discharge_list';
		$data['data'] = $this->email_model->getPort_of_discharge_list();
		$html = $this->load->view('email/configuration/port_of_discharge_list_pdf',$data,true);

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

	public function filter_port_of_discharge(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->email_model->getFilteredPortOfDischarge($status);
		
		echo json_encode($data);
	}

	public function filterPortOfDischargePDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered unit record and display list
		$data['data'] = $this->email_model->getFilteredPortOfDischarge($status);

		$file_name = 'port_of_discharge_list';
		$html = $this->load->view('email/configuration/port_of_discharge_list_pdf',$data,true);

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

	public function consignee_list(){
		$data['data'] = $this->email_model->getConsignee_list();
		$this->load->view('email/configuration/consignee_list',$data);
	}

	public function consignee_list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'consignee_list';
		$data['data'] = $this->email_model->getConsignee_list();
		$html = $this->load->view('email/configuration/consignee_list_pdf',$data,true);

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

	public function filter_consignee(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->email_model->getFilteredConsignee($status);
		
		echo json_encode($data);
	}

	public function filterConsigneePDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered unit record and display list
		$data['data'] = $this->email_model->getFilteredConsignee($status);

		$file_name = 'consignee_list';
		$html = $this->load->view('email/configuration/consignee_list_pdf',$data,true);

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
		Add Email Record in Database 
	*/
	public function addShippingMode(){
		$this->form_validation->set_rules('shipping_mode_ec_name', 'shipping mode Name', 'trim|required|min_length[3]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->shipping_mode_add();
		}
		else
		{	
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"shipping_mode_ec_name" => $this->input->post('shipping_mode_ec_name'),
				"shipping_mode_ec_details"        => $this->input->post('shipping_mode_ec_details'),
				"shipping_mode_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);
			if($id = $this->email_model->addShippingMode($data)){ 
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Shipping Mode Inserted'

				);
				$this->log_model->insert_log($log_data);
				redirect('email/shipping_mode_add');
			}
			else{
				$this->session->set_flashdata('fail', 'Shipping Mode can not be Inserted.');
				redirect("email/shipping_mode_add",'refresh');
			}
		}
	}

	public function addCommission(){
		$this->form_validation->set_rules('commission_ec_name', 'Commission Name', 'trim|required|min_length[2]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->commission_add();
		}
		else
		{	
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"commission_ec_name" => $this->input->post('commission_ec_name'),
				"commission_ec_value" => $this->input->post('commission_ec_value'),
				"commission_ec_details"        => $this->input->post('commission_ec_details'),
				"commission_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);	


			if($id = $this->email_model->addCommission($data)){ 
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Commission Inserted'
				);
				$this->log_model->insert_log($log_data);
				redirect('email/Commission_add');
			}
			else{
				$this->session->set_flashdata('fail', 'Commission can not be Inserted.');
				redirect("email/Commission_add",'refresh');
			}
		}
	}

	public function addPort(){
		$this->form_validation->set_rules('port_ec_name', 'Port Name', 'trim|required|min_length[3]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->port_add();
		}
		else
		{	
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"port_ec_name" => $this->input->post('port_ec_name'),
				"port_ec_details"        => $this->input->post('port_ec_details'),
				"port_ec_location" => $this->input->post('port_ec_location'),
				"port_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);	


			if($id = $this->email_model->addPort($data)){ 
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Port Inserted'
				);
				$this->log_model->insert_log($log_data);
				redirect('email/Port_add');
			}
			else{
				$this->session->set_flashdata('fail', 'Port can not be Inserted.');
				redirect("email/Port_add",'refresh');
			}
		}
	}

	public function addPayment(){
		$this->form_validation->set_rules('payment_ec_name', 'Payment Name', 'trim|required|min_length[3]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->payment_add();
		}
		else
		{	
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"payment_ec_name" => $this->input->post('payment_ec_name'),
				"payment_ec_details"        => $this->input->post('payment_ec_details'),
				"payment_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);	


			if($id = $this->email_model->addPayment($data)){ 
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Payment Inserted'
				);
				$this->log_model->insert_log($log_data);
				redirect('email/Payment_add');
			}
			else{
				$this->session->set_flashdata('fail', 'Payment can not be Inserted.');
				redirect("email/Payment_add",'refresh');
			}
		}
	}

	public function addBankers(){
		$this->form_validation->set_rules('bankers_ec_name', 'Bankers Name', 'trim|required|min_length[3]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->bankers_add();
		}
		else
		{	
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"bankers_ec_name" => $this->input->post('bankers_ec_name'),
				"bankers_ec_details"        => $this->input->post('bankers_ec_details'),
				"bankers_ec_address"        => $this->input->post('bankers_ec_address'),
				"bankers_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);
			if($id = $this->email_model->addBankers($data)){ 
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Banker Inserted'
				);
				$this->log_model->insert_log($log_data);
				redirect('email/bankers_add');
			}
			else{
				$this->session->set_flashdata('fail', 'Banker can not be Inserted.');
				redirect("email/bankers_add",'refresh');
			}
		}
	}

	public function addPortOfDischarge(){
		$this->form_validation->set_rules('port_of_discharge_ec_name', 'Port Name', 'trim|required|min_length[3]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->port_of_discharge_add();
		}
		else
		{	
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"port_of_discharge_ec_name" => $this->input->post('port_of_discharge_ec_name'),
				"port_of_discharge_ec_details"        => $this->input->post('port_of_discharge_ec_details'),
				"port_of_discharge_ec_location" => $this->input->post('port_of_discharge_ec_location'),
				"port_of_discharge_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);	


			if($id = $this->email_model->addPortOfDischarge($data)){ 
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Port of Discharge Inserted'
				);
				$this->log_model->insert_log($log_data);
				redirect('email/port_of_discharge_add');
			}
			else{
				$this->session->set_flashdata('fail', 'Port of Discharge can not be Inserted.');
				redirect("email/port_of_discharge_add",'refresh');
			}
		}
	}

	public function addConsignee(){
		$this->form_validation->set_rules('consignee_ec_name', 'Consignee Name', 'trim|required|min_length[3]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->consignee_add();
		}
		else
		{	
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"consignee_ec_name" => $this->input->post('consignee_ec_name'),
				"consignee_ec_details"        => $this->input->post('consignee_ec_details'),
				"consignee_ec_address"        => $this->input->post('consignee_ec_address'),
				"consignee_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);	


			if($id = $this->email_model->addConsignee_($data)){ 
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Consignee Inserted'
				);
				$this->log_model->insert_log($log_data);
				redirect('email/consignee_add');
			}
			else{
				$this->session->set_flashdata('fail', 'Consignee can not be Inserted.');
				redirect("email/consignee_add",'refresh');
			}
		}
	}

	/*  
		call Edit view to edit record 
	*/
	public function shipping_mode_edit($id){
		$data['data'] = $this->email_model->getShippingModeRecord($id);
		$this->load->view('email/configuration/shipping_mode_edit',$data);	
	}

	public function commission_edit($id){
		$data['data'] = $this->email_model->getCommissionRecord($id);
		$this->load->view('email/configuration/commission_edit',$data);	
	}

	public function port_edit($id){
		$data['data'] = $this->email_model->getPortRecord($id);
		$this->load->view('email/configuration/port_edit',$data);
	}

	public function payment_edit($id){
		$data['data'] = $this->email_model->getPaymentRecord($id);
		$this->load->view('email/configuration/payment_edit',$data);	
	}

	public function bankers_edit($id){
		$data['data'] = $this->email_model->getBankersRecord($id);
		$this->load->view('email/configuration/bankers_edit',$data);	
	}

	public function port_of_discharge_edit($id){
		$data['data'] = $this->email_model->getPortOfDischargeRecord($id);
		$this->load->view('email/configuration/port_of_discharge_edit',$data);	
	}

	public function Consignee_edit($id){
		$data['data'] = $this->email_model->getConsigneeRecord($id);
		$this->load->view('email/configuration/consignee_edit',$data);	
	}

	/* 
		Edit Email in Database  
	*/
	public function editShippingMode(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('shipping_mode_ec_name', 'shipping mode Name', 'trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->shipping_mode_edit($id);
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"shipping_mode_ec_name" => $this->input->post('shipping_mode_ec_name'),
				"shipping_mode_ec_details"        => $this->input->post('shipping_mode_ec_details'),
				"shipping_mode_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);
			if($this->email_model->editShippingMode($data,$id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Shipping Mode Updated'
				);
				$this->log_model->insert_log($log_data);
				redirect('email/shipping_mode_list');
			}
			else{
				$this->session->set_flashdata('fail', 'Shipping Mode can not be Updated.');
				redirect('email/shipping_mode_list');
			}
		}
	}

	public function editCommission(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('commission_ec_name', 'Commission Name', 'trim|required|min_length[2]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->commission_edit($id);
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"commission_ec_name" => $this->input->post('commission_ec_name'),
				"commission_ec_value" => $this->input->post('commission_ec_value'),
				"commission_ec_details"        => $this->input->post('commission_ec_details'),
				"commission_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);
			if($this->email_model->editCommission($data,$id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Commission Updated'
				);
				$this->log_model->insert_log($log_data);
				redirect('email/commission_list');
			}
			else{
				$this->session->set_flashdata('fail', 'Commission can not be Updated.');
				redirect('email/commission_list');
			}
		}
	}

	public function editPort(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('port_ec_name', 'shipping mode Name', 'trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->port_edit($id);
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"port_ec_name" => $this->input->post('port_ec_name'),
				"port_ec_details"        => $this->input->post('port_ec_details'),
				"port_ec_location" => $this->input->post('port_ec_location'),					
				"port_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);
			if($this->email_model->editPort($data,$id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Port Updated'

				);
				$this->log_model->insert_log($log_data);
				redirect('email/port_list');
			}
			else{
				$this->session->set_flashdata('fail', 'Port can not be Updated.');
				redirect('email/port_list');
			}
		}
	}

	public function editPayment(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('payment_ec_name', 'Payment Name', 'trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->payment_edit($id);
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"payment_ec_name" => $this->input->post('payment_ec_name'),
				"payment_ec_details"        => $this->input->post('payment_ec_details'),			
				"payment_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);
			if($this->email_model->editPayment($data,$id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Payment Updated'

				);
				$this->log_model->insert_log($log_data);
				redirect('email/payment_list');
			}
			else{
				$this->session->set_flashdata('fail', 'Payment can not be Updated.');
				redirect('email/payment_list');
			}
		}
	}

	public function editBankers(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('bankers_ec_name', 'Bankers Name', 'trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->bankers_edit($id);
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"bankers_ec_name" => $this->input->post('bankers_ec_name'),
				"bankers_ec_details" => $this->input->post('bankers_ec_details'),
				"bankers_ec_address" => $this->input->post('bankers_ec_address'),			
				"bankers_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);
			if($this->email_model->editBankers($data,$id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Bankers Updated'

				);
				$this->log_model->insert_log($log_data);
				redirect('email/bankers_list');
			}
			else{
				$this->session->set_flashdata('fail', 'Bankers can not be Updated.');
				redirect('email/bankers_list');
			}
		}
	}

	public function editPortOfDischarge(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('port_of_discharge_ec_name', ' Name', 'trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->port_of_discharge_edit($id);
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"port_of_discharge_ec_name" => $this->input->post('port_of_discharge_ec_name'),
				"port_of_discharge_ec_details"        => $this->input->post('port_of_discharge_ec_details'),
				"port_of_discharge_ec_location" => $this->input->post('port_of_discharge_ec_location'),					
				"port_of_discharge_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);
			if($this->email_model->editPortOfDischarge($data,$id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Port Updated'

				);
				$this->log_model->insert_log($log_data);
				redirect('email/port_of_discharge_list');
			}
			else{
				$this->session->set_flashdata('fail', 'Port can not be Updated.');
				redirect('email/port_of_discharge_list');
			}
		}
	}

	public function editConsignee(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('consignee_ec_name', 'Consignee Name', 'trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->consignee_edit($id);
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');	
			$data = array(
				"consignee_ec_name" => $this->input->post('consignee_ec_name'),
				"consignee_ec_details"        => $this->input->post('consignee_ec_details'),
				"consignee_ec_address"        => $this->input->post('consignee_ec_address'),
				"consignee_ec_status" => $this->input->post('confirm'),								
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);
			if($this->email_model->editConsignee($data,$id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Consignee Updated'

				);
				$this->log_model->insert_log($log_data);
				redirect('email/consignee_list');
			}
			else{
				$this->session->set_flashdata('fail', 'Consignee can not be Updated.');
				redirect('email/consignee_list');
			}
		}
	}

	/* 
		Delete selected record 
	*/
	public function shipping_mode_delete($id){
		if($this->email_model->deleteShippingMode($id)){
			$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'shipping mode Deleted'
			);
			$this->log_model->insert_log($log_data);
			redirect('email/shipping_mode_list');
		}
		else{
			$this->session->set_flashdata('fail', 'shipping mode can not be Deleted.');
			redirect("email/shipping_mode_list",'refresh');
		}
	}

	public function commission_delete($id){
		if($this->email_model->deleteCommission($id)){
			$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'commission Deleted'
			);
			$this->log_model->insert_log($log_data);
			redirect('email/commission_list');
		}
		else{
			$this->session->set_flashdata('fail', 'Commission can not be Deleted.');
			redirect("email/commission_list",'refresh');
		}
	}

	public function port_delete($id){
		if($this->email_model->deletePort($id)){
			$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'Port Deleted'
			);
			$this->log_model->insert_log($log_data);
			redirect('email/port_list');
		}
		else{
			$this->session->set_flashdata('fail', 'Port can not be Deleted.');
			redirect("email/port_list",'refresh');
		}
	}

	public function payment_delete($id){
		if($this->email_model->deletePayment($id)){
			$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'Payment Deleted'
			);
			$this->log_model->insert_log($log_data);
			redirect('email/payment_list');
		}
		else{
			$this->session->set_flashdata('fail', 'Payment can not be Deleted.');
			redirect("email/payment_list",'refresh');
		}
	}

	public function bankers_delete($id){
		if($this->email_model->deleteBankers($id)){
			$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'Bankers Deleted'
			);
			$this->log_model->insert_log($log_data);
			redirect('email/bankers_list');
		}
		else{
			$this->session->set_flashdata('fail', 'Bankers can not be Deleted.');
			redirect("email/bankers_list",'refresh');
		}
	}

	public function port_of_discharge_delete($id){
		if($this->email_model->deletePortOfDischarge($id)){
			$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'Port Deleted'
			);
			$this->log_model->insert_log($log_data);
			redirect('email/port_of_discharge_list');
		}
		else{
			$this->session->set_flashdata('fail', 'Port can not be Deleted.');
			redirect("email/port_of_discharge_list",'refresh');
		}
	}

	public function Consignee_delete($id){
		if($this->email_model->deleteConsignee($id)){
			$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'Consignee Deleted'
			);
			$this->log_model->insert_log($log_data);
			redirect('email/consignee_list');
		}
		else{
			$this->session->set_flashdata('fail', 'Consignee can not be Deleted.');
			redirect("email/consignee_list",'refresh');
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

	function alpha_space_shipping_mode_ec_details($str) {
		if (! preg_match("/^([a-zA-Z ])+$/i", $str))
		{
			$this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha and spaces.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
?>