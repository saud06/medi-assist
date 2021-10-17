<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('purchase_model');
		$this->load->model('log_model');
	}

	public function index(){
		// get all purchase record and display list
		$data['data'] = $this->purchase_model->getPurchase();
		$this->load->view('purchase/list',$data);
	} 

	/*
		generate list pdf
	*/
	public function list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'purchase_list';
		$data['data'] = $this->purchase_model->getPurchase();
		$html = $this->load->view('purchase/list_pdf',$data,true);

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
		filter purchase list
	*/
	public function filterPurchase(){
		$date_range = $this->input->post('date_range');
		if($date_range){
			$explode = explode(' - ', $date_range);
			$start_date = $explode[0];
			$start_date = date("Y-m-d", strtotime($start_date));
			$end_date = $explode[1];
			$end_date = date("Y-m-d", strtotime($end_date));
		}

		// get all filtered purchase record and display list
		$data['data'] = $this->purchase_model->getFilteredPurchase($start_date, $end_date);

		foreach ($data['data'] as $key => $purchase){
			$ship_mode = $purchase->ship_mode;

	        if($ship_mode == 'Courier'){
	        	if($purchase->type){
		        	$type = $this->db->get_where('courier', array('courier_id' => $purchase->type))->row();
		        	$courier_name = $type->courier_name;
		        	$data['data'][$key]->courier_name = $courier_name;
		        }
		        else{
		        	$data['data'][$key]->courier_name = '';
		        }
	        }
		}

		echo json_encode($data);
	} 

	/*
		filter purchase pdf
	*/
	public function filterPurchasePDF($start_date, $end_date){
		$start_date = date("Y-m-d", strtotime($start_date));
		$end_date = date("Y-m-d", strtotime($end_date));

		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'purchase_list';

		// get all filtered purchase record and display list
		$data['data'] = $this->purchase_model->getFilteredPurchase($start_date, $end_date);

		foreach ($data['data'] as $key => $purchase){
			$ship_mode = $purchase->ship_mode;

	        if($ship_mode == 'Courier'){
	        	if($purchase->type){
		        	$type = $this->db->get_where('courier', array('courier_id' => $purchase->type))->row();
		        	$courier_name = $type->courier_name;
		        	$data['data'][$key]->courier_name = $courier_name;
		        }
		        else{
		        	$data['data'][$key]->courier_name = '';
		        }
	        }
		}

		$html = $this->load->view('purchase/list_pdf',$data,true);

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
		call add purchase view to add purchase
	*/
	public function add(){
		$data['client'] = $this->purchase_model->getClient();
		//$data['product'] = $this->purchase_model->getProduct();
		/*$data['warehouse'] = $this->purchase_model->getWarehouse(); 
		$data['supplier'] = $this->purchase_model->getSupplier();*/
		$data['reference_no'] = $this->purchase_model->createReferenceNo();
		$data['users'] = $this->purchase_model->getUsers();
		$data['couriers'] = $this->purchase_model->getCouriers();
		$data['currency'] = $this->purchase_model->getCurrency();
		$this->load->view('purchase/add',$data);
	}

	/* 
		this function is used to have clientwise product list in purchase record 
	*/
		public function getProductList($id){
			$data = $this->purchase_model->getProductList($id);
			echo json_encode($data);
			//print_r(json_encode($data));
		}
	
	/* 
		this function is used when product add in purchase table 
	*/
		public function getProductAjax($id){
			$data = $this->purchase_model->getProductAjax($id);
			$data['discount'] = $this->purchase_model->getDiscount();
			$data['tax'] = $this->purchase_model->getTax();
			$data['shelf'] = $this->purchase_model->getShelf();
			$data['rack'] = $this->purchase_model->getRack();
			echo json_encode($data);
			//print_r($data);
		}
	/*
		this function is used to get available quantity in inventory table 
	*/
		public function getAvailableQty($product_id, $shelf_and_rack_id){
			$shelf_id = substr($shelf_and_rack_id, 0, strpos($shelf_and_rack_id, '0.1'));
			$rack_id = substr($shelf_and_rack_id, strpos($shelf_and_rack_id, '0.1') + 3);

			$data['data'] = $this->purchase_model->getAvailableQty($product_id, $shelf_id, $rack_id);

			echo json_encode($data);
		}
	/* 
		This function is used to search product code / name in database 
	*/
		public function getAutoCodeName($code,$search_option){
          //$code = strtolower($code);
			$p_code = $this->input->post('p_code');
			$p_search_option = $this->input->post('p_search_option');
			$data = $this->purchase_model->getProductCodeName($p_code,$p_search_option);
			if($search_option=="Code"){
				$list = "<ul class='auto-product'>";
				foreach ($data as $val){
					$list .= "<li value=".$val->code.">".$val->code."</li>";
				}
				$list .= "</ul>";
			}
			else{
				$list = "<ul class='auto-product'>";
				foreach ($data as $val){
					$list .= "<li value=".$val->product_id.">".$val->name."</li>";
				}
				$list .= "</ul>";
			}

			echo $list;
          //echo json_encode($data);
          //print_r($list);
		}
	/* 
		This function is used to add purchase in database 
	*/
		public function addPurchase(){
			$this->form_validation->set_rules('date','Date','trim|required');
			/*$this->form_validation->set_rules('client','Client','trim|required');
			$this->form_validation->set_rules('employee','Employee','trim|required');*/
			$this->form_validation->set_rules('product','Product','trim|required');
			$this->form_validation->set_rules('currency','Currency','trim|required');
			//$this->form_validation->set_rules('supplier_id','Supplier ID','trim|required');
			//$this->form_validation->set_rules('warehouse_id','Warehouse ID','trim|required');
			/*$this->form_validation->set_rules('product_id','Product Name','trim|required');*/

			if($this->form_validation->run()==false){
				$this->add();
			}
			else
			{
				$ship_mode = $this->input->post('ship_mode');
				$type = $this->input->post('type');
				$freight_charge = $this->input->post('freight_charge');
				$custom_charge = $this->input->post('custom_charge');
				$method = $this->input->post('method');
				$voucher_no = $this->input->post('voucher_no');
				$bank_name = $this->input->post('bank_name');
				$receive_date = $this->input->post('receive_date');
				if($receive_date == ''){
					$receive_date = '0000-00-00';
				}
				$receipt_no = $this->input->post('receipt_no');

				$currency = explode("|", $this->input->post('currency'));
				$currency_id = $currency[0];

				$emp_id = $this->input->post('receiver_id');
				
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');
				$data = array(
					"reference_no"		=>	$this->input->post('reference_no'),
					"client_id"			=>	$this->input->post('client_id'),
					"date" 				=> 	$this->input->post('date'),
					"emp_id"			=>	$emp_id,
					"ship_mode" 		=> 	$ship_mode,
					"type"				=>	$type,
					"freight_charge"	=>	$freight_charge,
					"custom_charge"		=>	$custom_charge,
					"method"			=>	$method,
					"voucher_no"			=>	$voucher_no,
					"bank_name"			=>	$bank_name,
					"receive_date"		=>	$receive_date,
					"receipt_no"		=>	$receipt_no,
					"currency_id" 		=> 	$currency_id,
					"note" 				=> 	$this->input->post('note'),
					"total" 			=>	$this->input->post('total_value2'),
					"purchase_status" 	=>	'active',
					"datetime" 			=> 	$datetime,
					"user_id" 			=> 	$this->session->userdata('user_id')
				);

				$invoice = array(
					"invoice_no" => $this->purchase_model->generateInvoiceNo(),
					"receipt_amount" => $this->input->post('total_value2'),
					"currency_id" 		  =>  $currency_id,
					"receipt_voucher_date" => date('Y-m-d')
				);

				if($purchase_id = $this->purchase_model->addModel($data,$invoice)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $purchase_id,
						'message'  => 'Purchase Inserted and quantity add in inventory'
					);
					$this->log_model->insert_log($log_data);
					$purchase_item_data = $this->input->post('table_data');
					$js_data = json_decode($purchase_item_data);

					foreach ($js_data as $key => $value) {
						if($value==null){
						}
						else{
							date_default_timezone_set('Asia/Dhaka');
							$datetime = date('Y-m-d H:i:s');
							$product_id = $value->product_id;
							$batch_no = $value->batch_no;
							$quantity = $value->quantity;
							$shelf_and_rack_id = $value->shelf_and_rack_id;
							$shelf_id = substr($shelf_and_rack_id, 0, strpos($shelf_and_rack_id, '0.1'));
							$rack_id = substr($shelf_and_rack_id, strpos($shelf_and_rack_id, '0.1') + 3);
							$data = array(
								"purchase_id" => $purchase_id,
								"batch_no" => $batch_no,
								"product_id" => $value->product_id,
								"shelf_id" => $shelf_id,
								"rack_id" => $rack_id,
								"quantity" => $value->quantity,
								"gross_total" => $value->total,
								"purchase_items_status" => 'active',
								"user_id" => $this->session->userdata('user_id'),
								"datetime" => $datetime
							);

							$cost = $value->total / $value->quantity;
							$inventory_data = array(
								"purchase_id" => $purchase_id,
								"sales_id" => NULL,
								"shelf_id" => $shelf_id,
								"rack_id" => $rack_id,
								"product_id" => $value->product_id,
								"cost" => $cost,
								"quantity" => $value->quantity,
								"sales_qty" => 0,
								"ck_out_qty" => 0,
								"ck_in_qty" => 0,
								"inventory_status" => 'active',
								"user_id" => $this->session->userdata('user_id'),
								"datetime" => $datetime
							);
							
							$this->purchase_model->addUpdateInventory($inventory_data);
							if($this->purchase_model->addPurchaseItem($data)){
							}
							else{
							}
						}
					}
					redirect('purchase/view/'.$purchase_id);
				}
				else{
					redirect('purchase','refresh');
				}
			}
		}
	/* 
		This function is used to call view  edit purchase 
	*/
		public function edit($id){
			$data['data'] = $this->purchase_model->getRecord($id);
			$data['client'] = $this->purchase_model->getClient();
			$data['product'] = $this->purchase_model->getProduct();
			/*$data['warehouse'] = $this->purchase_model->getWarehouse(); */
			/*$data['supplier'] = $this->purchase_model->getSupplier();*/
			$data['couriers'] = $this->purchase_model->getCouriers();
			$data['currency'] = $this->purchase_model->getCurrency();
			/*$data['discount'] = $this->purchase_model->getDiscount();
			$data['tax'] = $this->purchase_model->getTax();*/
			$data['users'] = $this->purchase_model->getUsers();	
			foreach ($data['data'] as $key) {
				$purchase_id = $key->purchase_id;
				/*$warehouse_id = $key->warehouse_id;*/
				/*$data['items'] = $this->purchase_model->getPurchaseItems($purchase_id,$warehouse_id);*/	
				$data['items'] = $this->purchase_model->getPurchaseItems($purchase_id);
			}
			
			$this->load->view('purchase/edit',$data);
		}
	/* 
		This function is used to delete discount record in databse 
	*/
		public function delete($id){
			if($this->purchase_model->deleteModel($id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Purchase Deleted & quantity upadte from Inventory'
				);
				$this->log_model->insert_log($log_data);
				
				
				redirect('purchase','refresh');
			}
			else{
				redirect('purchase','refresh');
			}
		}
	/* 
		This function is to edit purchase record in database 
	*/
		public function editPurchase(){
			$id = $this->input->post('purchase_id');
			$this->form_validation->set_rules('date','Date','trim|required');
			/*$this->form_validation->set_rules('client','Client','trim|required');
			$this->form_validation->set_rules('employee','Employee','trim|required');*/
			//$this->form_validation->set_rules('product','Product','trim|required');
			$this->form_validation->set_rules('currency','Currency','trim|required');
			//$this->form_validation->set_rules('supplier_id','Supplier ID','trim|required');
			//$this->form_validation->set_rules('warehouse_id','Warehouse ID','trim|required');
			/*$this->form_validation->set_rules('product_id','Product Name','trim|required');*/

			if($this->form_validation->run()==false){
				$this->edit($id);
			}
			else
			{
				$ship_mode = $this->input->post('ship_mode');
				$type = $this->input->post('type');
				$freight_charge = $this->input->post('freight_charge');
				$custom_charge = $this->input->post('custom_charge');
				$method = $this->input->post('method');
				$voucher_no = $this->input->post('voucher_no');
				$bank_name = $this->input->post('bank_name');
				$receive_date = $this->input->post('receive_date');
				if($receive_date == ''){
					$receive_date = '0000-00-00';
				}
				$receipt_no = $this->input->post('receipt_no');

				$currency = explode("|", $this->input->post('currency'));
				$currency_id = $currency[0];

				$emp_id = $this->input->post('receiver_id');
				
				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');

				if($this->input->post('total_value2')!=''){
					$total = $this->input->post('total_value2');
				}
				else{
					$total = $this->input->post('totalValue');
				}

				$data = array(
					"reference_no"		=>	$this->input->post('reference_no'),
					"client_id"			=>	$this->input->post('client_id'),
					"date" 				=> 	$this->input->post('date'),
					"emp_id"			=>	$emp_id,
					"ship_mode" 		=> 	$ship_mode,
					"type"				=>	$type,
					"freight_charge"	=>	$freight_charge,
					"custom_charge"		=>	$custom_charge,
					"method"			=>	$method,
					"voucher_no"		=>	$voucher_no,
					"bank_name"			=>	$bank_name,
					"receive_date"		=>	$receive_date,
					"receipt_no"		=>	$receipt_no,
					"currency" 			=> 	$currency_id,
					"note" 				=> 	$this->input->post('note'),
					"total" 			=>	$total,
					"purchase_status" 	=>	'active',
					"datetime" 			=> 	$datetime,
					"user_id" 			=> 	$this->session->userdata('user_id')
				);

				$js_data = json_decode($this->input->post('table_data1'));
				$batch_data = json_decode($this->input->post('table_data0'));
				$product_data = json_decode($this->input->post('table_data'));
				if($this->purchase_model->editModel($id,$data)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Purchase and Inventory Updated'
					);
					$this->log_model->insert_log($log_data);

					if($js_data == null){
					}
					else{
						foreach ($js_data as $key => $value) {
							if($value=='delete'){
								$batch_no =  $batch_data[$key];
								$product_id =  $product_data[$key];
								if($this->purchase_model->updateInventoryQuantity($id,$batch_no,$product_id)){
									$this->purchase_model->deletePurchaseItems($id,$batch_no,$product_id);
								}
							}
							else if($value==null){
							}
							else{
								date_default_timezone_set('Asia/Dhaka');
								$datetime = date('Y-m-d H:i:s');
								$product_id = $value->product_id;
								$batch_no = $value->batch_no;
								$quantity = $value->quantity;
								$cost = $value->total / $quantity;

								if($cost == 0){
									$fop_status = 1;
								}
								else{
									$fop_status = 0;
								}

								$shelf_and_rack_id = $value->shelf_and_rack_id;
								$shelf_id = substr($shelf_and_rack_id, 0, strpos($shelf_and_rack_id, '0.1'));
								$rack_id = substr($shelf_and_rack_id, strpos($shelf_and_rack_id, '0.1') + 3);
								$data = array(
										"purchase_id" => $this->input->post('purchase_id'),
										"batch_no" => $batch_no,
										"product_id" => $value->product_id,
										"shelf_id" => $shelf_id,
										"rack_id" => $rack_id,
										"quantity" => $value->quantity,
										"fop_status" => $fop_status,
										"cost" => $cost,
										"gross_total" => $value->total,
										"purchase_items_status" => 'active',
										"user_id" => $this->session->userdata('user_id'),
										"datetime" => $datetime
									);
								
								$purchase_id = $this->input->post('purchase_id');
								$inventory_data = array(
									"purchase_id" => $purchase_id,
									"sales_id" => NULL,
									"shelf_id" => $shelf_id,
									"rack_id" => $rack_id,
									"product_id" => $value->product_id,
									"cost" => number_format($cost, 2, '.', ''),
									"quantity" => $value->quantity,
									"inventory_status" => 'active',
									"user_id" => $this->session->userdata('user_id'),
									"datetime" => $datetime
								);
								
								if($this->purchase_model->addUpdatePurchaseItem($id,$batch_no,$product_id,$data)){
									$this->purchase_model->updateInventory($inventory_data);
								}
								else{
								}
							}
						}
					}
					redirect('purchase');
				}
			}
		}
	/*
		view purchase items
	*/
		public function items_view($id){
			$data['data'] = $this->purchase_model->itemsView($id);

			echo json_encode($data);
		}
	/*
		view purchase details
	*/
		public function view($id){
			$data['data'] = $this->purchase_model->getDetails($id);
			$data['items'] = $this->purchase_model->getItems($id);
			//$data['company'] = $this->purchase_model->getCompany();

			$this->load->view('purchase/view',$data);
		}
	/*
		generate pdf 
	*/
		public function pdf($id){

			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$data['data'] = $this->purchase_model->getDetails($id);
			$data['items'] = $this->purchase_model->getItems($id);
			$data['company'] = $this->purchase_model->getCompany();
			$html = $this->load->view('purchase/pdf',$data,true);

			include(APPPATH.'third_party/mpdf/vendor/autoload.php');
			$mpdf = new \Mpdf\Mpdf();

			$mpdf->allow_charset_conversion = true;
			$mpdf->charset_in = 'UTF-8';
			$mpdf->WriteHTML($html);
			$mpdf->Output($data['data'][0]->reference_no.'pdf','I');
		}
	/*
		send email
	*/
		public function email($id){
			$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => 0,
				'message'  => 'Purchase Receipt Email Send'
			);
			$this->log_model->insert_log($log_data);
			/*$data = $this->purchase_model->getSupplierEmail($id);*/
			$company = $this->purchase_model->getCompany();
			$email = $this->purchase_model->getSmtpSetup();
			$this->load->view('class.phpmailer.php');

			$mail = new PHPMailer();

			$mail->IsSMTP();
			$mail->Host = $email->smtp_host;

			$mail->SMTPAuth = true;
		//$mail->SMTPSecure = "ssl";
			$mail->Port = $email->port;
			$mail->Username = $email->smtp_username;
			$mail->Password = $email->smtp_password;

			$mail->From = $email->from_address;
			$mail->FromName = $email->form_name;
			$mail->AddAddress($data[0]->email);
		//$mail->AddReplyTo("mail@mail.com");

			$mail->IsHTML(true);

			$mail->Subject = "Purchase order No : ".$data[0]->reference_no." From ".$company[0]->name;
			$mail->Body = "Date : ".$data[0]->date."<br>Total : ".$data[0]->total;
		//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

			if(!$mail->Send())
			{
				$message =  "Email could not be sent";
			}
			else{
				$message =  "Email has been sent";
			}
			$this->session->set_flashdata('message', $message);
			redirect('purchase','refresh');
		}
	/*
		view payment
	*/
		public function payment($id){
			$data['data'] = $this->purchase_model->getDetails($id);
			$data['items'] = $this->purchase_model->getItems($id);
			$data['company'] = $this->purchase_model->getCompany();
			$data['ledger'] = $this->purchase_model->getLedger();
			$data['p_reference_no'] = $this->purchase_model->generateReferenceNo();
			$this->load->view('purchase/payment',$data);
		}
	/*
		add payment
	*/
		public function paymentAdd($id){
			$data['data'] = $this->purchase_model->getDetails($id);
			$data['items'] = $this->purchase_model->getItems($id);
			$data['company'] = $this->purchase_model->getCompany();
			$data['p_reference_no'] = $this->purchase_model->generateReferenceNo();
			$this->load->view('purchase/payment/add',$data);
		}
	/*
		get Discount value for AJAX 
	*/
		public function getDiscountValue($id){
			$data = $this->purchase_model->getDiscountValue($id);
			echo json_encode($data);
		}
	/*
		get Tax value for AJAX 
	*/
		public function getTaxValue($id){
			$data = $this->purchase_model->getTaxValue($id);
			echo json_encode($data);
		}
	/*
		get payment details to view and send to model
	*/
		public function addPayment(){
			$id = $this->input->post('id');
			$paying_by = $this->input->post('paying_by');
			$this->form_validation->set_rules('date','Date','trim|required');
			$this->form_validation->set_rules('paying_by','Paying By','trim|required');
			if($paying_by == "Cheque"){
				$this->form_validation->set_rules('bank_name','Bank Name','trim|required');
				$this->form_validation->set_rules('cheque_no','Cheque No','trim|required|numeric');
			}
			if($this->form_validation->run()==false){
				$this->payment($id);
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
					"purchase_id"     => $id,
					"payment_voucher_date"         => $this->input->post('date'),
					"invoice_no" => $this->input->post('reference_no'),
					"payment_ledger" => $this->input->post('ledger'),
					"payment_amount"       => $this->input->post('amount'),
					"mode_of_payment"    => $this->input->post('paying_by'),
					"bank_name"    => $bank_name,
					"cheque_no"    => $cheque_no,
					"description"  => $this->input->post('note')
				);

				if($this->purchase_model->addPayment($data)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Purchase Payable'
					);
					$this->log_model->insert_log($log_data);
					redirect('purchase','refresh');
				}
				else{
					redirect("purchase",'refresh');
				}
			}
		}

		/*
			generate receipt
		*/
		public function receipt(){
			$data['data'] = $this->purchase_model->receipt();
			$this->load->view('purchase/receipt',$data);
		}
		/*
			generate receipt list pdf
		*/
		public function receipt_list_pdf(){
			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$file_name = 'receipt_list';
			$data['data'] = $this->purchase_model->receipt();
			$html = $this->load->view('sales/receipt_list_pdf',$data,true);

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
			filter receipt list
		*/
		public function filterReceipt(){
			$date_range = $this->input->post('date_range');
			if($date_range){
				$explode = explode(' - ', $date_range);
				$start_date = $explode[0];
				$start_date = date("Y-m-d", strtotime($start_date));
				$end_date = $explode[1];
				$end_date = date("Y-m-d", strtotime($end_date));
			}

			// get all filtered receipt record and display list
			$data['data'] = $this->purchase_model->getFilteredReceipt($start_date, $end_date);

			echo json_encode($data);
		} 
		/*
			filter invoice pdf
		*/
		public function filterReceiptPDF($start_date, $end_date){
			$start_date = date("Y-m-d", strtotime($start_date));
			$end_date = date("Y-m-d", strtotime($end_date));

			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$file_name = 'receipt_list';

			// get all filtered receipt record and display list
			$data['data'] = $this->purchase_model->getFilteredReceipt($start_date, $end_date);

			$html = $this->load->view('purchase/receipt_list_pdf',$data,true);

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
	}
	?>