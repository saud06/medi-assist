<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sales extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('sales_model');
		$this->load->model('client_model');
		$this->load->model('purchase_model');
		$this->load->model('log_model');
	}
	public function index(){
		// get all sales to display list
		$data['data'] = $this->sales_model->getSales();
		$this->load->view('sales/list',$data);
	} 
	/*
		generate list pdf
	*/
	public function list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'sales_list';
		$data['data'] = $this->sales_model->getSales();
		$html = $this->load->view('sales/list_pdf',$data,true);

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
		filter sales list
	*/
	public function filterSales(){
		$date_range = $this->input->post('date_range');
		if($date_range){
			$explode = explode(' - ', $date_range);
			$start_date = $explode[0];
			$start_date = date("Y-m-d", strtotime($start_date));
			$end_date = $explode[1];
			$end_date = date("Y-m-d", strtotime($end_date));
		}

		// get all filtered sales record and display list
		$data['data'] = $this->sales_model->getFilteredSales($start_date, $end_date);

		echo json_encode($data);
	} 
	/*
		filter sales pdf
	*/
	public function filterSalesPDF($start_date, $end_date){
		$start_date = date("Y-m-d", strtotime($start_date));
		$end_date = date("Y-m-d", strtotime($end_date));

		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'sales_list';

		// get all filtered sales record and display list
		$data['data'] = $this->sales_model->getFilteredSales($start_date, $end_date);

		$html = $this->load->view('sales/list_pdf',$data,true);

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
		call add view to add sales record 
	*/
	public function add(){
		$data['client'] = $this->sales_model->getClient();
		//$data['product'] = $this->sales_model->getProduct();
		/*$data['warehouse'] = $this->sales_model->getWarehouse(); 
		$data['supplier'] = $this->sales_model->getSupplier();*/
		$data['reference_no'] = $this->sales_model->createReferenceNo();
		$data['couriers'] = $this->sales_model->getCouriers();
		$data['currency'] = $this->sales_model->getCurrency();
		$data['users'] = $this->sales_model->getUsers();	
		$this->load->view('sales/add',$data);
	}
	/* 
		this function is used to get discount data when discount is change 
	*/
	public function getDiscountAjax($id){
		$data = $this->sales_model->getDiscountAjax($id);
		echo json_encode($data);
	}
	/* get all product warehouse wise */
	public function getProducts($warehouse_id){
		$data = $this->sales_model->getProducts($warehouse_id);
	    echo json_encode($data);
	}
	/* get single product */
	public function getProduct($product_id,$warehouse_id){
		$data = $this->sales_model->getProduct($product_id,$warehouse_id);
		$data['discount'] = $this->sales_model->getDiscount();
		$data['tax'] = $this->sales_model->getTax();
	    echo json_encode($data);
		//print_r($data);
	}
	/* this function is used to have clientwise product list in purchase record */
	public function getProductList($id){
		$data = $this->sales_model->getProductList($id);
		echo json_encode($data);
		//print_r(json_encode($data));
	}
	/* this function is used when product add in sales table */
	public function getProductAjax($id){
		$data = $this->sales_model->getProductAjax($id);
		$data['discount'] = $this->sales_model->getDiscount();
		$data['tax'] = $this->sales_model->getTax();
		$data['shelf'] = $this->sales_model->getShelf();
		$data['rack'] = $this->sales_model->getRack();
		echo json_encode($data);
		//print_r($data);
	}
	/*
		this function is used to get available quantity in inventory table 
	*/
	public function getAvailableQty($product_id, $shelf_and_rack_id){
		$shelf_id = substr($shelf_and_rack_id, 0, strpos($shelf_and_rack_id, '0.1'));
		$rack_id = substr($shelf_and_rack_id, strpos($shelf_and_rack_id, '0.1') + 3);

		$data['data'] = $this->sales_model->getAvailableQty($product_id, $shelf_id, $rack_id);

		echo json_encode($data);
	}
	/* 
		this function is used to search product name / code in auto complite 
	*/
	public function getAutoCodeName($code,$search_option,$warehouse){
          //$code = strtolower($code);
		  $p_code = $this->input->post('p_code');
		  $p_search_option = $this->input->post('p_search_option');
          $data = $this->sales_model->getProductCodeName($p_code,$p_search_option,$warehouse);
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
          //print_r($data);
	}
	/* 
		this fucntion is used to add sales record in database 
	*/
	public function addSales(){
		$this->form_validation->set_rules('date','Date','trim|required');
		/*$this->form_validation->set_rules('client','Client','trim|required');
		$this->form_validation->set_rules('employee','Employee','trim|required');*/
		// $this->form_validation->set_rules('product','Product','trim|required');
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
			$courier_type = $this->input->post('courier_type');
			if($ship_mode == 'Courier'){
				$courier_id = substr($courier_type, 0, strpos($courier_type, ','));
				$courier_payment = substr($courier_type, strpos($courier_type, ',') + 1);
			}
			else{
				$courier_id = NULL;
				$courier_payment = NULL;
			}
			$currency = explode("|", $this->input->post('currency'));
			$currency_id = $currency[0];

			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');
			$data = array(
						"date" 				  =>  $this->input->post('date'),
						"reference_no" 		  =>  $this->input->post('reference_no'),
						"warehouse_id" 	      =>  1,
						"client_id" 		  =>  $this->input->post('client_id'),
						"biller_id" 		  =>  1,
						"total" 			  =>  $this->input->post('total_value2'),
						"discount_value"	  =>  0.00,
						"tax_value" 		  =>  0.00,
						"emp_id"			  =>  $this->input->post('emp_id'),
						"ship_mode" 		  =>  $ship_mode,
						"courier_id"		  =>  $courier_id,
						"courier_payment"	  =>  $courier_payment,
						"currency_id" 		  =>  $currency_id,
						"note" 				  =>  $this->input->post('note'),
						"shipping_city_id"    =>  1,
						"shipping_state_id"   =>  1,
						"shipping_country_id" =>  1,
						"shipping_address"    =>  '',
						"shipping_charge"     =>  0.00,
						"internal_note"       =>  '',
						"mode_of_transport"   =>  '',
						"transporter_name"    =>  '',
						"transporter_code"    =>  '',
						"vehicle_regn_no"     =>  '',
						"sales_status" 		  =>  'active',
						"datetime" 			  =>  $datetime,
						"user_id"			  =>  $this->session->userdata('user_id')
				);

			$invoice = array(
				"invoice_no" => $this->sales_model->generateInvoiceNo(),
				"sales_amount" => $this->input->post('total_value2'),
				"currency_id" 		  =>  $currency_id,
				"invoice_date" => date('Y-m-d')
			);

			if($sales_id = $this->sales_model->addModel($data,$invoice)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $sales_id,
						'message'  => 'Sales Inserted'
					);
				$this->log_model->insert_log($log_data);
				$sales_item_data = $this->input->post('table_data');
				$js_data = json_decode($sales_item_data);

				foreach ($js_data as $key => $value) {
					if($value==null){
					}
					else{
						date_default_timezone_set('Asia/Dhaka');
						$datetime = date('Y-m-d H:i:s');
						$product_id = $value->product_id;
						$quantity = $value->quantity;
						$shelf_and_rack_id = $value->shelf_and_rack_id;
						$shelf_id = substr($shelf_and_rack_id, 0, strpos($shelf_and_rack_id, '0.1'));
						$rack_id = substr($shelf_and_rack_id, strpos($shelf_and_rack_id, '0.1') + 3);
						if(isset($value->sales_type)){
							$sales_qty = $value->quantity;
							$ck_out_qty = -($value->quantity);
						}
						else{
							$sales_qty = 0;
							$ck_out_qty = 0;
						}

						$data = array(
							"sales_id" => $sales_id,
							"product_id" => $value->product_id,
							"shelf_id" => $shelf_id,
							"rack_id" => $rack_id,
							"quantity" => $value->quantity,
							"gross_total" => $value->total,
							"sales_items_status" => 'active',
							"user_id" => $this->session->userdata('user_id'),
							"datetime" => $datetime
						);

						$cost = $value->total / $value->quantity;
						$inventory_data = array(
							"purchase_id" => NULL,
							"sales_id" => $sales_id,
							"shelf_id" => $shelf_id,
							"rack_id" => $rack_id,
							"product_id" => $value->product_id,
							"cost" => $cost,
							"quantity" => -($value->quantity),
							"sales_qty" => $sales_qty,
							"ck_out_qty" => $ck_out_qty,
							"ck_in_qty" => 0,
							"inventory_status" => 'active',
							"user_id" => $this->session->userdata('user_id'),
							"datetime" => $datetime
						);

						$this->sales_model->addUpdateInventory($inventory_data);
						if($this->sales_model->addSalesItem($data)){
						}
						else{
						}
					}
				}
				redirect('sales/view/'.$sales_id);
			}
			else{
				redirect('sales','refresh');
			}
		}
	}
	/* 
		call edit view to edit sales record 
	*/
	public function edit($id){
		$data['data'] = $this->sales_model->getRecord($id);
		$data['client'] = $this->sales_model->getClient();
		$data['product'] = $this->sales_model->getProduct();
		$data['couriers'] = $this->sales_model->getCouriers();
		$data['currency'] = $this->sales_model->getCurrency();
		/*$data['discount'] = $this->sales_model->getDiscount();
		$data['tax'] = $this->sales_model->getTax();*/
		$data['users'] = $this->sales_model->getUsers();	
		foreach ($data['data'] as $key) {
			$sales_id = $key->sales_id;
			$data['items'] = $this->sales_model->getSalesItems($sales_id);
		}

		$this->load->view('sales/edit',$data);
	}
	/*  
		this fucntion is to edit sales record and save in database 
	*/
	public function editSales(){
		$id = $this->input->post('sales_id');
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
			$courier_type = $this->input->post('courier_type');
			if($ship_mode == 'Courier'){
				$courier_id = substr($courier_type, 0, strpos($courier_type, ','));
				$courier_payment = substr($courier_type, strpos($courier_type, ',') + 1);
			}
			else{
				$courier_id = NULL;
				$courier_payment = NULL;
			}
			$currency = explode("|", $this->input->post('currency'));
			$currency_id = $currency[0];
			
			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');

			if($this->input->post('total_value2')!=''){
				$total = $this->input->post('total_value2');
			}
			else{
				$total = $this->input->post('totalValue');
			}

			$data = array(
						"date" 				  =>  $this->input->post('date'),
						"reference_no" 		  =>  $this->input->post('reference_no'),
						"warehouse_id" 	      =>  1,
						"client_id" 		  =>  $this->input->post('client_id'),
						"biller_id" 		  =>  1,
						"total" 			  =>  $total,
						"discount_value"	  =>  0.00,
						"tax_value" 		  =>  0.00,
						"emp_id"			  =>  $this->input->post('emp_id'),
						"ship_mode" 		  =>  $ship_mode,
						"courier_id"		  =>  $courier_id,
						"courier_payment"	  =>  $courier_payment,
						"currency_id" 		  =>  $currency_id,
						"note" 				  =>  $this->input->post('note'),
						"shipping_city_id"    =>  1,
						"shipping_state_id"   =>  1,
						"shipping_country_id" =>  1,
						"shipping_address"    =>  '',
						"shipping_charge"     =>  0.00,
						"internal_note"       =>  '',
						"mode_of_transport"   =>  '',
						"transporter_name"    =>  '',
						"transporter_code"    =>  '',
						"vehicle_regn_no"     =>  '',
						"sales_status" 		  =>  'active',
						"datetime" 			  =>  $datetime,
						"user_id"			  =>  $this->session->userdata('user_id'),
						"sales_id"		      =>  $this->input->post('sales_id')
					);
			
			$js_data = json_decode($this->input->post('table_data1'));
			$product_data = json_decode($this->input->post('table_data'));

			if($this->sales_model->editModel($id,$data)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Sales Updated'
					);
				$this->log_model->insert_log($log_data);

				if($js_data == null){
				}
				else{
					foreach ($js_data as $key => $value) {
						if($value=='delete'){
							$product_id =  $product_data[$key];

							if($this->sales_model->updateInventoryQuantity($id,$product_id)){
								$this->sales_model->deleteSalesItems($id,$product_id);
							}
						}
						else if($value==null){
						}
						else{
							date_default_timezone_set('Asia/Dhaka');
							$datetime = date('Y-m-d H:i:s');
							$product_id = $value->product_id;
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
									"sales_id" => $this->input->post('sales_id'),
									"product_id" => $value->product_id,
									"shelf_id" => $shelf_id,
									"rack_id" => $rack_id,
									"quantity" => $value->quantity,
									"fop_status" => $fop_status,
									"cost" => $cost,
									"gross_total" => $value->total,
									"sales_items_status" => 'active',
									"user_id" => $this->session->userdata('user_id'),
									"datetime" => $datetime
								);

							$sales_id = $this->input->post('sales_id');
							$inventory_data = array(
								"purchase_id" => NULL,
								"sales_id" => $sales_id,
								"shelf_id" => $shelf_id,
								"rack_id" => $rack_id,
								"product_id" => $value->product_id,
								"cost" => number_format($cost, 2, '.', ''),
								"quantity" => -($value->quantity),
								"inventory_status" => 'active',
								"user_id" => $this->session->userdata('user_id'),
								"datetime" => $datetime
							);

							if($this->sales_model->addUpdateSalesItem($id,$product_id,$data)){
								$this->sales_model->updateInventory($inventory_data);
							}
							else{
							}
						}
					}
				}
				redirect('sales');
			}
		}
	}
	/* 
		this function is used to delete sales record from database 
	*/
	public function delete($id){
		if($this->sales_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Sales Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('sales','refresh');
		}
		else{
			redirect('sales','refresh');
		}
	}
	/*
		display data in dashboard calendar
	*/
	public function calendar(){
		log_message('debug', print_r($this->db->get('category')->result(), true));
		$data = $this->sales_model->getCalendarData();
		$total = 0;
		foreach ($data as $value) {
			$date = Date('Y-m-d');
			if($date == $value->date){
				$total += $value->total;
			}
			$temp = array(
					"title" => $total,
					"start" => "2017-04-05T00:01:00+05:30"
				);
		}
		 echo json_encode($temp);
	}
	/*
		view Sales details
	*/
	public function view($id){
		$data['data'] = $this->sales_model->getDetails($id);
		$data['items'] = $this->sales_model->getItems($id);
		//$data['company'] = $this->purchase_model->getCompany();
		$this->load->view('sales/view',$data);
	}
	/*
		view sales items
	*/
	public function items_view($id){
		$data['data'] = $this->sales_model->itemsView($id);

		echo json_encode($data);
	}
	/*
		generate pdf
	*/
	public function pdf($id){
		$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'Invoice Generated'
			);
		$this->log_model->insert_log($log_data);
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['data'] = $this->sales_model->getDetails($id);
		$data['items'] = $this->sales_model->itemsView($id);
		$html = $this->load->view('sales/pdf',$data,true);

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

		$data['data'] = $this->sales_model->getDetails($id);
		$data['items'] = $this->sales_model->itemsView($id);
		$html = $this->load->view('sales/ch_pdf',$data,true);

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
	public function print1($id){
		$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'Invoice Printed'
			);
		$this->log_model->insert_log($log_data);
		$data['data'] = $this->sales_model->getDetails($id);
		$data['items'] = $this->sales_model->getItems($id);
		$data['company'] = $this->purchase_model->getCompany();
		$this->load->view('sales/pdf',$data);
	}
	/*
		send email
	*/
	public function email($id){
		$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => 0,
				'message'  => 'Invoice Email Send'
			);
		$this->log_model->insert_log($log_data);
		$email = $this->sales_model->getSmtpSetup();

		$data = $this->sales_model->getClientEmail($id);
		$company = $this->purchase_model->getCompany();
		$this->load->view('class.phpmailer.php');

		$mail = new PHPMailer();

		$mail->IsSMTP();
		$mail->Host = $email->smtp_host;

		$mail->SMTPAuth = true;
		//$mail->SMTPSecure = "ssl";
		$mail->Port = $email->smtp_port;
		$mail->Username = $email->smtp_username;
		$mail->Password = $email->smtp_password;

		$mail->From = $email->from_address;
		$mail->FromName = $email->from_name;
		$mail->AddAddress($data[0]->email);
		//$mail->AddReplyTo("mail@mail.com");

		/*$mail->IsHTML(true);

		$mail->Subject = "Purchase order No : ".$data[0]->reference_no." From ".$company[0]->name;
		$mail->Body = "Date : ".$data[0]->date."<br>Total : ".$data[0]->total;
		//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

		if(!$mail->Send())
		{
			$message =  "Email could not be sent";
		}
		else{
			$message =  "Email has been sent";
		}*/
		$total = $data[0]->total+$data[0]->shipping_charge;
         $this->load->library('email'); 
   
         $this->email->from($email->from_address ,$email->from_name); 
         $this->email->to($data[0]->email);
         $this->email->subject("Sales order No : ".$data[0]->reference_no." From ".$company[0]->name); 
         $this->email->message("Date : ".$data[0]->date."   \nTotal : ".$total." \n\n\nComapany Name : ".$company[0]->name."\nAddress : ".$company[0]->street." ".$company[0]->country_name."\nMobile No :".$company[0]->phone); 
         //Send mail 
         if($this->email->send()) 
         $message = "Email sent successfully.";
         else 
         $message = "Error in sending Email."; 

		$this->session->set_flashdata('message', $message);
		redirect('sales','refresh');
	}
	/*
		payment	 view
	*/
	public function payment($id){
		$data['data'] = $this->sales_model->getDetailsPayment($id);
		$data['p_reference_no'] = $this->sales_model->generateReferenceNo();

		$this->load->view('sales/payment',$data);
	}
	/*
		get payment details to view and send to model
	*/
	public function addPayment(){
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
					"sales_id"     => $id,
					"date"         => $this->input->post('date'),
					"reference_no" => $this->input->post('reference_no'),
					"amount"       => $this->input->post('amount'),
					"currency_id"  => $this->input->post('currency_id'),
					"paying_by"    => $this->input->post('paying_by'),
					"bank_name"    => $bank_name,
					"cheque_no"    => $cheque_no,
					"name"    	   => $this->input->post('name'),
					"contact"	   => $this->input->post('contact'),
					"designation"  => $this->input->post('designation'),
					"description"  => $this->input->post('note'),
				);

			if($this->sales_model->addPayment($data)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Sales Payable'
					);
				$this->log_model->insert_log($log_data);
				redirect('sales','refresh');
			}
			else{
				redirect("sales",'refresh');
			}
		}
	}
	/*
		generate invoice
	*/
	public function invoice(){
		$data['data'] = $this->sales_model->invoice();
		$this->load->view('sales/invoice',$data);
	}
	/*
		generate invoice list pdf
	*/
	public function invoice_list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'invoice_list';
		$data['data'] = $this->sales_model->invoice();
		$html = $this->load->view('sales/invoice_list_pdf',$data,true);

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
		filter invoice list
	*/
	public function filterInvoice(){
		$date_range = $this->input->post('date_range');
		if($date_range){
			$explode = explode(' - ', $date_range);
			$start_date = $explode[0];
			$start_date = date("Y-m-d", strtotime($start_date));
			$end_date = $explode[1];
			$end_date = date("Y-m-d", strtotime($end_date));
		}

		// get all filtered sales record and display list
		$data['data'] = $this->sales_model->getFilteredInvoice($start_date, $end_date);

		echo json_encode($data);
	} 
	/*
		filter invoice pdf
	*/
	public function filterInvoicePDF($start_date, $end_date){
		$start_date = date("Y-m-d", strtotime($start_date));
		$end_date = date("Y-m-d", strtotime($end_date));

		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'invoice_list';

		// get all filtered invoice record and display list
		$data['data'] = $this->sales_model->getFilteredInvoice($start_date, $end_date);

		$html = $this->load->view('sales/invoice_list_pdf',$data,true);

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

	*/
	public function getClientData($id){
		$data['data'] = $this->client_model->getRecord($id);
		$data['country']  = $this->client_model->getCountry();
		$data['state'] = $this->client_model->getState($data['data'][0]->country_id);
		$data['city'] = $this->client_model->getCity($data['data'][0]->state_id);
		echo json_encode($data);
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
	}
}
?>