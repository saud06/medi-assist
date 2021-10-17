<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Quotation extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('quotation_model');
		$this->load->model('client_model');
		$this->load->model('purchase_model');
		$this->load->model('sales_model');
		$this->load->model('log_model');
	}
	public function index(){
		// get all sales to display list
		$data['data'] = $this->quotation_model->getQuotation();
		$this->load->view('quotation/list',$data);
	} 
	/* 
		call add view to add sales record 
	*/
	public function add(){
		$data['warehouse'] = $this->quotation_model->getWarehouse();
		$data['warehouse_products'] = $this->quotation_model->getWarehouseProducts(); 
		$data['biller'] = $this->quotation_model->getBiller();
		$data['client'] = $this->quotation_model->getClient(); 
		$data['reference_no'] = $this->quotation_model->createReferenceNo();
		//$data['warehouse_products'] = $this->quotation_model->getWarehouseProducts();
		/*echo "<pre>";
		print_r($data); 
		exit();*/
		$this->load->view('quotation/add',$data);
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
	public function addQuotation(){
		
		$this->form_validation->set_rules('date','Date','trim|required');
		$this->form_validation->set_rules('reference_no','Reference No','trim|required');
		//$this->form_validation->set_rules('supplier_id','Supplier ID','trim|required');
		//$this->form_validation->set_rules('warehouse_id','Warehouse ID','trim|required');
		//$this->form_validation->set_rules('discount_id','Discount ID','trim|required');
		//$this->form_validation->set_rules('biller_id','Biller ID','trim|required');
		if($this->form_validation->run()==false){

			$this->add();
		}
		else
		{
			$warehouse_id = $this->input->post('warehouse');
			$data = array(
						"date" 				  =>  $this->input->post('date'),
						"reference_no" 		  =>  $this->input->post('reference_no'),
						"warehouse_id" 		  =>  $this->input->post('warehouse'),
						"client_id" 		  =>  $this->input->post('client'),
						"biller_id" 		  =>  $this->input->post('biller'),
						"total" 			  =>  $this->input->post('grand_total'),
						"discount_value"	  =>  $this->input->post('total_discount'),
						"tax_value" 		  =>  $this->input->post('total_tax'),
						"note" 				  =>  $this->input->post('note'),
						"shipping_city_id"    =>  $this->input->post('city'),
						"shipping_state_id"   =>  $this->input->post('state'),
						"shipping_country_id" =>  $this->input->post('country'),
						"shipping_address"    =>  $this->input->post('address'),
						"shipping_charge"     =>  $this->input->post('shipping_charge'),
						"internal_note"       =>  $this->input->post('internal_note'),
						"mode_of_transport"   =>  $this->input->post('mode_of_transport'),
						"transporter_name"    =>  $this->input->post('transporter_name'),
						"transporter_code"    =>  $this->input->post('transporter_code'),
						"vehicle_regn_no"     =>  $this->input->post('vehicle_regn_no'),
						"user"			      =>  $this->session->userdata('user_id')
					);

			if($quotation_id = $this->quotation_model->addModel($data)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $quotation_id,
						'message'  => 'Quotation Inserted'
					);
				$this->log_model->insert_log($log_data);
				$sales_item_data = $this->input->post('table_data');
				$js_data = json_decode($sales_item_data);
				foreach ($js_data as $key => $value) {
					if($value==null){
					}
					else{
						$product_id = $value->product_id;
						$quantity = $value->quantity;	
						$data = array(
							"product_id" => $value->product_id,
							"quantity" => $value->quantity,
							"price" => $value->price,
							"gross_total" => $value->total,
							"discount_id" => $value->discount_id,
							"discount_value" => $value->discount_value,
							"discount" => $value->discount,
							"tax_id" => $value->tax_id,
							"tax_value" => $value->tax_value,
							"tax" => $value->tax,
							"quotation_id" => $quotation_id
							);
						//$this->sales_model->checkProductInWarehouse($product_id,$quantity,$warehouse_id);
						if($this->quotation_model->addQuotationItem($data,$product_id,$warehouse_id,$quantity)){
							
						}
						else{

						}
					}
				}
				redirect('quotation/view/'.$quotation_id);
			}
			else{
				redirect('quotation','refresh');
			}
		}
	}
	/* 
		call edit view to edit sales record 
	*/
	public function edit($id){
		$data['warehouse'] = $this->quotation_model->getWarehouse(); 
		$data['biller'] = $this->quotation_model->getBiller();
		$data['client'] = $this->quotation_model->getClient();
		$data['tax'] = $this->quotation_model->getTax();
		$data['discount'] = $this->quotation_model->getDiscount();
		$data['data'] = $this->quotation_model->getRecord($id);
		$data['country']  = $this->client_model->getCountry();
		$data['state'] = $this->client_model->getState($data['data'][0]->shipping_country_id);
		$data['city'] = $this->client_model->getCity($data['data'][0]->shipping_state_id);
		$data['product'] = $this->quotation_model->getProducts($data['data'][0]->warehouse_id);
		$data['items'] = $this->quotation_model->getQuotationItems($data['data'][0]->quotation_id,$data['data'][0]->warehouse_id);
		$this->load->view('quotation/edit',$data);
	}
	/*  
		this fucntion is to edit sales record and save in database 
	*/
	public function editQuotation(){
		$id = $this->input->post('quotation_id');
		$this->form_validation->set_rules('date','Date','trim|required');
		$this->form_validation->set_rules('reference_no','Reference No','trim|required');
		//$this->form_validation->set_rules('supplier_id','Supplier ID','trim|required');
		//$this->form_validation->set_rules('warehouse_id','Warehouse ID','trim|required');
		//$this->form_validation->set_rules('discount_id','Discount ID','trim|required');
		//$this->form_validation->set_rules('biller_id','Biller ID','trim|required');
		if($this->form_validation->run()==false){

			$this->edit($id);
		}
		else
		{
			$warehouse_id = $this->input->post('warehouse');
			$old_warehouse_id = $this->input->post('old_warehouse_id');
			$warehouse_change = $this->input->post('warehouse_change');
			$data = array(
						"date" 			      =>  $this->input->post('date'),
						"reference_no" 	      =>  $this->input->post('reference_no'),
						"warehouse_id"	      =>  $this->input->post('warehouse'),
						"client_id" 	      =>  $this->input->post('client'),
						"biller_id" 	      =>  $this->input->post('biller'),
						"total" 		      =>  $this->input->post('grand_total'),
						"discount_value"      =>  $this->input->post('total_discount'),
						"tax_value" 	      =>  $this->input->post('total_tax'),
						"note" 			      =>  $this->input->post('note'),
						"shipping_city_id"    =>  $this->input->post('city'),
						"shipping_state_id"   =>  $this->input->post('state'),
						"shipping_country_id" =>  $this->input->post('country'),
						"shipping_address"    =>  $this->input->post('address'),
						"shipping_charge"     =>  $this->input->post('shipping_charge'),
						"internal_note"       =>  $this->input->post('internal_note'),
						"mode_of_transport"   =>  $this->input->post('mode_of_transport'),
						"transporter_name"    =>  $this->input->post('transporter_name'),
						"transporter_code"    =>  $this->input->post('transporter_code'),
						"vehicle_regn_no"     =>  $this->input->post('vehicle_regn_no'),
						"user"			      =>  $this->session->userdata('user_id'),
						"quotation_id"		  =>  $this->input->post('quotation_id')
					);
			
			$js_data = json_decode($this->input->post('table_data1'));
			$php_data = json_decode($this->input->post('table_data'));
			if($this->quotation_model->editModel($id,$data)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Quotation Updated'
					);
				$this->log_model->insert_log($log_data);
				if($js_data!=""){
					foreach ($js_data as $key => $value) {
						if($value=='delete'){
							//echo " delete".$key;
							$product_id =  $php_data[$key];
							if($this->quotation_model->deleteQuotationItems($id,$product_id,$warehouse_id,$old_warehouse_id)){
								//echo " 1.Dsuccess";
							}
						}
						else if($value==null){
							if($warehouse_id != $old_warehouse_id AND $php_data[$key] !=null){
								$product_id =  $php_data[$key];
								if($this->quotation_model->changeWarehouseDeleteQuotationItems($id,$product_id,$warehouse_id,$old_warehouse_id)){
									//echo " 1.Dsuccess";
								}
							}
							else if($warehouse_change == "yes"){
								$product_id =  $php_data[$key];
								if($this->quotation_model->changeWarehouseDeleteQuotationItems($id,$product_id,$warehouse_id,$old_warehouse_id)){
									//echo " 1.Dsuccess";
								}
							}
						}
						else{
							$product_id = $value->product_id;
							$quantity = $value->quantity;
							$data = array(
									"product_id" => $value->product_id,
									"quantity" => $value->quantity,
									"price" => $value->price,
									"gross_total" => $value->total,
									"discount_id" => $value->discount_id,
									"discount_value" => $value->discount_value,
									"discount" => $value->discount,
									"tax_id" => $value->tax_id,
									"tax_value" => $value->tax_value,
									"tax" => $value->tax,
									"quotation_id" => $id
								);
							if($old_quantity = $this->quotation_model->checkProductInQuotation($id,$product_id)){
								$this->quotation_model->updateQuantity($id,$product_id,$warehouse_id,$quantity,$old_quantity,$data);
							}
							else{
								if($this->quotation_model->addQuotationItem($data,$product_id,$warehouse_id,$quantity)){
									//echo " 1 Asuccess add";
								}
								else{

								}
							}
						}
					}
				}
				redirect('quotation','refresh');
			}
		}
	}
	/* 
		this function is used to delete sales record from database 
	*/
	public function delete($id){
		if($this->quotation_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Quotation Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('quotation','refresh');
		}
		else{
			redirect('quotation','refresh');
		}
	}
	/*
		display data in dashboard calendar
	*/
	public function calendar(){
		log_message('debug', print_r($this->db->get('category')->result(), true));
		$data = $this->quotation_model->getCalendarData();
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
		$data['data'] = $this->quotation_model->getDetails($id);
		$data['check_invoice'] = $this->quotation_model->checkInvoice($id);
		$data['items'] = $this->quotation_model->getItems($id);
		$data['company'] = $this->purchase_model->getCompany();
		$this->load->view('quotation/view',$data);
	}
	/*
		generate pdf
	*/
	public function pdf($id){
		$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'Quotation PDF Generated'
			);
		$this->log_model->insert_log($log_data);
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['data'] = $this->quotation_model->getDetails($id);
		$data['items'] = $this->quotation_model->getItems($id);
		$data['company'] = $this->purchase_model->getCompany();
		$html = $this->load->view('quotation/pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output($data['data'][0]->reference_no,'I');
	}
	public function print1($id){
		$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $id,
				'message'  => 'Invoice Printed'
			);
		$this->log_model->insert_log($log_data);
		$data['data'] = $this->quotation_model->getDetails($id);
		$data['items'] = $this->quotation_model->getItems($id);
		$data['company'] = $this->purchase_model->getCompany();
		$this->load->view('quotation/pdf',$data);
	}
	/*
		send email
	*/
	public function email($id){
		$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => 0,
				'message'  => 'Quotation Email Send'
			);
		$this->log_model->insert_log($log_data);
		$email = $this->quotation_model->getSmtpSetup();

		$data = $this->quotation_model->getClientEmail($id);
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

		$mail->IsHTML(true);

		$mail->Subject = "Quotation order No : ".$data[0]->reference_no." From ".$company[0]->name;
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
		redirect('quotation','refresh');
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
	public function generate_invoice($id){
		$data = $this->quotation_model->getRecord($id);
		$items = $this->quotation_model->getItems($id);
		$reference_no =  $this->sales_model->createReferenceNo();
		if($reference_no==null){
            $no = sprintf('%06d',intval(1));
        }
        else{
          foreach ($reference_no as $value) {
            $no = sprintf('%06d',intval($value->sales_id)+1); 
          }
        }
		$sales_data = array(
						"date" 				  =>  date('Y-m-d'),
						"reference_no" 		  =>  'SO-'.$no,
						"warehouse_id" 		  =>  $data[0]->warehouse_id,
						"client_id" 		  =>  $data[0]->client_id,
						"biller_id" 		  =>  $data[0]->biller_id,
						"total" 			  =>  $data[0]->total,
						"discount_value"	  =>  $data[0]->discount_value,
						"tax_value" 		  =>  $data[0]->tax_value,
						"note" 				  =>  $data[0]->note,
						"shipping_city_id"    =>  $data[0]->shipping_city_id,
						"shipping_state_id"   =>  $data[0]->shipping_state_id,
						"shipping_country_id" =>  $data[0]->shipping_country_id,
						"shipping_address"    =>  $data[0]->shipping_address,
						"shipping_charge"     =>  $data[0]->shipping_charge,
						"internal_note"       =>  $data[0]->internal_note,
						"mode_of_transport"   =>  $data[0]->mode_of_transport,
						"transporter_name"    =>  $data[0]->transporter_name,
						"transporter_code"    =>  $data[0]->transporter_code,
						"vehicle_regn_no"     =>  $data[0]->vehicle_regn_no,
						"user"			      =>  $this->session->userdata('user_id')
					);
		$invoice = array(
				"invoice_no" => $this->sales_model->generateInvoiceNo(),
				"sales_amount" => $data[0]->total,
				"quotation_id" => $data[0]->quotation_id,
				"invoice_date" => date('Y-m-d')
			);
			if($sales_id = $this->sales_model->addModel($sales_data,$invoice)){
				$query = 'UPDATE quotation SET sales_id = '.$sales_id.' WHERE quotation_id = '.$data[0]->quotation_id;
				$this->db->query($query);
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $sales_id,
						'message'  => 'Sales Inserted'
					);
				$this->log_model->insert_log($log_data);
				foreach ($items as $key => $value) {
					if($value==null){
					}
					else{
						$product_id = $value->product_id;
						$quantity = $value->quantity;	
						$data = array(
							"product_id" => $value->product_id,
							"quantity" => $value->quantity,
							"price" => $value->price,
							"gross_total" => $value->total,
							"discount_id" => $value->discount_id,
							"discount_value" => $value->discount_value,
							"discount" => $value->discount,
							"tax_id" => $value->tax_id,
							"tax_value" => $value->tax_value,
							"tax" => $value->tax,
							"sales_id" => $sales_id
							);
						$this->sales_model->addSalesItem($data,$product_id,$warehouse_id,$quantity);
					}
				}
				redirect('sales/view/'.$sales_id);
			}
			else{
				redirect('sales','refresh');
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
	}
}
?>