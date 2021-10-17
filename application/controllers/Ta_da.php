<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ta_da extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('ta_da_model');
		$this->load->model('log_model');
	}

	public function index(){
		// get all ta_da record and display list
		$data['data'] = $this->ta_da_model->getTaDa();
		$data['tada_user'] = $this->ta_da_model->getTaDaUser();
		$data['data2'] = $this->ta_da_model->getTaDa2();
		$data['tada_user2'] = $this->ta_da_model->getTaDaUser2();
		$this->load->view('ta_da/list',$data);
	} 

	/*
		generate ta da list pdf
	*/
	public function ta_da_list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'ta_da_list';
		$data['data'] = $this->ta_da_model->getTaDa();
		$html = $this->load->view('ta_da/ta_da_list_pdf',$data,true);

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
		generate tiffin list pdf
	*/
	public function tiffin_list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'tiffin_list';
		$data['data'] = $this->ta_da_model->getTaDa2();
		$html = $this->load->view('ta_da/tiffin_list_pdf',$data,true);

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

	public function filterTaDa(){
		$type = $this->input->post('type');
		$date_range = $this->input->post('date_range');
		$start_date = NULL;
		$end_date = NULL;
		$expensed_by = $this->input->post('expensed_by');
		if($expensed_by == '0') $expensed_by = '';

		if($date_range){
			$explode = explode(' - ', $date_range);
			$start_date = $explode[0];
			$start_date = date("Y-m-d", strtotime($start_date));
			$end_date = $explode[1];
			$end_date = date("Y-m-d", strtotime($end_date));
		}

		// get all filtered ta_da record and display list
		$data['data'] = $this->ta_da_model->getFilteredTaDa($type, $start_date, $end_date, $expensed_by);

		echo json_encode($data);
	} 

	/*
		filter ta da pdf
	*/
	public function filterTaDaPDF($type, $start_date, $end_date, $expensed_by){
		$start_date = date("Y-m-d", strtotime($start_date));
		$end_date = date("Y-m-d", strtotime($end_date));

		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered purchase record and display list
		$data['data'] = $this->ta_da_model->getFilteredTaDa($type, $start_date, $end_date, $expensed_by);

		if($type == 'ta_da'){
			$file_name = 'ta_da_list';
			$html = $this->load->view('ta_da/ta_da_list_pdf',$data,true);
		}
		else{
			$file_name = 'tiffin_list';
			$html = $this->load->view('ta_da/tiffin_list_pdf',$data,true);
		}

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

	public function update_status($ta_da_id){
		if($this->ta_da_model->updateStatus($ta_da_id)){
			echo json_encode(array("status" => TRUE));
		} else{
			echo json_encode(array("status" => FALSE));
		}
	}

	/*
		call add ta_da view to add ta_da
	*/
	public function add(){
		$this->load->view('ta_da/add');
	}
	/* 
		This function is used to add ta_da in database 
	*/
		public function addTaDa(){
			$this->form_validation->set_rules('date','Date','trim|required');
			$this->form_validation->set_rules('total_amount','Total Amount','trim|required|numeric');
			$this->form_validation->set_rules('title','Title','trim|required');

			if($this->form_validation->run()==false){
				$this->add();
			}
			else
			{
				if($_FILES["image"]["name"]){
					$type = explode('.',$_FILES["image"]["name"]);
					$type = $type[count($type)-1];
					$url = "assets/images/asset/".uniqid(rand()).'.'.$type;

					if(in_array($type,array("jpg","jpeg","gif","png"))){

						if(is_uploaded_file($_FILES["image"]["tmp_name"])){

							if(move_uploaded_file($_FILES["image"]["tmp_name"],$url)){

							}
						}	
					}
				}
				else{
					$url = "assets/images/asset/no_image.jpg";
				}

				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');
				$data = array(
					"date" 				=> 	$this->input->post('date'),
					"title" 			=> 	$this->input->post('title'),
					"total_amount"		=>	$this->input->post('total_amount'),
					"image"          	=>  base_url().''.$url,
					"description"		=>	$this->input->post('description'),
					"type"				=>	$this->input->post('type'),
					"finalization_status"	=>	'Saved',
					"status" 			=>	'active',
					"datetime" 			=> 	$datetime,
					"user_id" 			=> 	$this->session->userdata('user_id'),
					"expensed_by" 		=>  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name')
				);

				if($ta_da_id = $this->ta_da_model->addModel($data)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $ta_da_id,
						'message'  => 'TA/DA Inserted'
					);
					$this->log_model->insert_log($log_data);
					$category_data = $this->input->post('table_data');
					$js_data = json_decode($category_data);

					foreach ($js_data as $key => $value) {
						if($value==null){
						}
						else{
							date_default_timezone_set('Asia/Dhaka');
							$datetime = date('Y-m-d H:i:s');
							$data = array(
								"ta_da_id" => $ta_da_id,
								"category_name" => $value->category_name,
								"category_details" => $value->category_details,
								"amount" => $value->amount,
								"status" => 'active',
								"user_id" => $this->session->userdata('user_id'),
								"datetime" => $datetime
							);

							if($this->ta_da_model->addPurchaseItem($data)){
							}
							else{
							}
						}
					}
					redirect('ta_da/add');
				}
				else{
					redirect('ta_da/add','refresh');
				}
			}
		}
	/* 
		This function is used to call view  edit ta_da 
	*/
		public function edit($id){
			$data['data'] = $this->ta_da_model->getRecord($id);
			foreach ($data['data'] as $key) {
				$ta_da_id = $key->ta_da_id;
				$data['categories'] = $this->ta_da_model->getTaDaCategories($ta_da_id);
			}
			
			$this->load->view('ta_da/edit',$data);
		}
	/* 
		This function is used to delete discount record in databse 
	*/
		public function delete($id){
			if($this->ta_da_model->deleteModel($id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'TA/DA Deleted'
				);
				$this->log_model->insert_log($log_data);
				
				
				redirect('ta_da','refresh');
			}
			else{
				redirect('ta_da','refresh');
			}
		}
	/* 
		This function is to edit ta_da record in database 
	*/
		public function editTaDa(){
			$id = $this->input->post('ta_da_id');
			$this->form_validation->set_rules('date','Date','trim|required');
			$this->form_validation->set_rules('total_amount','Total Amount','trim|required|numeric');
			$this->form_validation->set_rules('title','Title','trim|required');

			if($this->form_validation->run()==false){
				$this->edit($id);
			}
			else
			{
				if($_FILES["image"]["name"] == null){
					$url = $this->input->post('hidden_image');
				}
				else{
					$type = explode('.',$_FILES["image"]["name"]);
					$type = $type[count($type)-1];
					$url = "./assets/images/asset/".uniqid(rand()).'.'.$type;

					if(in_array($type,array("jpg","jpeg","gif","png"))){

						if(is_uploaded_file($_FILES["image"]["tmp_name"])){

							if(move_uploaded_file($_FILES["image"]["tmp_name"],$url)){
								$url = base_url().''.$url;	
							}
						}	
					}
				}

				date_default_timezone_set('Asia/Dhaka');
				$datetime = date('Y-m-d H:i:s');
				$data = array(
					"date" 				=> 	$this->input->post('date'),
					"title" 			=> 	$this->input->post('title'),
					"total_amount"		=>	$this->input->post('total_amount'),
					"image"          	=>  $url,
					"description"		=>	$this->input->post('description'),
					"status" 			=>	'active',
					"datetime" 			=> 	$datetime,
					"user_id" 			=> 	$this->session->userdata('user_id'),
					"expensed_by" 		=>  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name')
				);

				$js_data = json_decode($this->input->post('table_data1'));
				if($this->ta_da_model->editModel($id,$data)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'TA/DA Updated'
					);
					$this->log_model->insert_log($log_data);

					if($js_data == null){
					}
					else{
						foreach ($js_data as $key => $value) {
							if($value==null){
							}
							else{
								date_default_timezone_set('Asia/Dhaka');
								$datetime = date('Y-m-d H:i:s');
								$data = array(
									"ta_da_id" => $this->input->post('ta_da_id'),
									"category_name" => $value->category_name,
									"category_details" => $value->category_details,
									"amount" => $value->amount,
									"status" => 'active',
									"user_id" => $this->session->userdata('user_id'),
									"datetime" => $datetime
								);

								if($this->ta_da_model->addUpdatePurchaseItem($id,$data)){
								}
								else{
								}
							}
						}
						redirect('ta_da');
					}
				}
				else{
					redirect('ta_da','refresh');
				}
			}
		}
	/*
		view ta_da items
	*/
		public function categories_view($id){
			$data['data'] = $this->ta_da_model->categoriesView($id);

			echo json_encode($data);
		}
	/*
		view ta_da details
	*/
		public function view($id){
			$data['data'] = $this->ta_da_model->getDetails($id);
			$data['items'] = $this->ta_da_model->getItems($id);
			//$data['company'] = $this->ta_da_model->getCompany();

			$this->load->view('ta_da/view',$data);
		}
	/*
		generate pdf 
	*/
		public function pdf($type, $id){
			if($type == 'ta_da') $message = 'Ta / DA';
			else $message = 'Tiffin';

			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => $message . ' Bill Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$data['data'] = $this->ta_da_model->getDetails($id);
			$data['items'] = $this->ta_da_model->itemsView($id);
			
			if($type == 'ta_da') $html = $this->load->view('ta_da/ta_da_bill_pdf',$data,true);
			else $html = $this->load->view('ta_da/tiffin_bill_pdf',$data,true);

			include(APPPATH.'third_party/mpdf/vendor/autoload.php');
			$mpdf = new \Mpdf\Mpdf();
			
	        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
	        $mpdf->allow_charset_conversion = true;
	        $mpdf->charset_in = 'UTF-8';
	        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
			$mpdf->showWatermarkImage = true;
	        $mpdf->WriteHTML($html);
	        $mpdf->Output($type.'_bill.pdf','I');
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
			/*$data = $this->ta_da_model->getSupplierEmail($id);*/
			$company = $this->ta_da_model->getCompany();
			$email = $this->ta_da_model->getSmtpSetup();
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
			redirect('ta_da','refresh');
		}
	/*
		view payment
	*/
		public function payment($id){
			$data['data'] = $this->ta_da_model->getDetails($id);
			$data['items'] = $this->ta_da_model->getItems($id);
			$data['company'] = $this->ta_da_model->getCompany();
			$data['ledger'] = $this->ta_da_model->getLedger();
			$data['p_reference_no'] = $this->ta_da_model->generateReferenceNo();
			$this->load->view('ta_da/payment',$data);
		}
	/*
		add payment
	*/
		public function paymentAdd($id){
			$data['data'] = $this->ta_da_model->getDetails($id);
			$data['items'] = $this->ta_da_model->getItems($id);
			$data['company'] = $this->ta_da_model->getCompany();
			$data['p_reference_no'] = $this->ta_da_model->generateReferenceNo();
			$this->load->view('ta_da/payment/add',$data);
		}
	/*
		get Discount value for AJAX 
	*/
		public function getDiscountValue($id){
			$data = $this->ta_da_model->getDiscountValue($id);
			echo json_encode($data);
		}
	/*
		get Tax value for AJAX 
	*/
		public function getTaxValue($id){
			$data = $this->ta_da_model->getTaxValue($id);
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

				if($this->ta_da_model->addPayment($data)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Purchase Payable'
					);
					$this->log_model->insert_log($log_data);
					redirect('ta_da','refresh');
				}
				else{
					redirect("ta_da",'refresh');
				}
			}
		}

		/*
			generate receipt
		*/
		public function receipt(){
			$data['data'] = $this->ta_da_model->receipt();
			$this->load->view('ta_da/receipt',$data);
		}
	}
	?>