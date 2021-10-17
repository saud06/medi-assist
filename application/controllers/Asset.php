<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Asset extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('asset_model');
		$this->load->model('log_model');
	}

	public function index(){
		// get all asset record and display list
		$data['data'] = $this->asset_model->getAsset();
		$this->load->view('asset/list',$data);
	} 

	/*
		generate asset list pdf
	*/
	public function list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'asset_list';
		$data['data'] = $this->asset_model->getAsset();
		$html = $this->load->view('asset/list_pdf',$data,true);

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

	public function backup(){
		$this->load->view('asset/backup');
	} 

	public function filterAsset(){
		$date_range = $this->input->post('date_range');
		$start_date = NULL;
		$end_date = NULL;
		
		if($date_range){
			$explode = explode(' - ', $date_range);
			$start_date = $explode[0];
			$start_date = date("Y-m-d", strtotime($start_date));
			$end_date = $explode[1];
			$end_date = date("Y-m-d", strtotime($end_date));
		}

		// get all filtered asset record and display list
		$data['data'] = $this->asset_model->getFilteredAsset($start_date, $end_date);

		echo json_encode($data);
	} 

	/*
		filter asset pdf
	*/
	public function filterAssetPDF($start_date, $end_date){
		$start_date = date("Y-m-d", strtotime($start_date));
		$end_date = date("Y-m-d", strtotime($end_date));

		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered asset record and display list
		$data['data'] = $this->asset_model->getFilteredAsset($start_date, $end_date);

		$file_name = 'asset_list';
		$html = $this->load->view('asset/list_pdf',$data,true);

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

	public function update_status($asset_id){
		if($this->asset_model->updateStatus($asset_id)){
			echo json_encode(array("status" => TRUE));
		} else{
			echo json_encode(array("status" => FALSE));
		}
	}

	/*
		call add asset view to add asset
	*/
	public function add(){
		$this->load->view('asset/add');
	}
	/* 
		This function is used to add asset in database 
	*/
		public function addAsset(){
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
					"bill_description"	=>	$this->input->post('bill_description'),
					"finalization_status"	=>	'Saved',
					"status" 			=>	'active',
					"datetime" 			=> 	$datetime,
					"user_id" 			=> 	$this->session->userdata('user_id'),
					"username" 			=> 	$this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name')
				);

				if($asset_id = $this->asset_model->addModel($data)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $asset_id,
						'message'  => 'Asset Inserted'
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
								"asset_id" => $asset_id,
								"asset_name" => $value->asset_name,
								"asset_description" => $value->asset_description,
								"purpose" => $value->purpose,
								"warranty_period" => $value->warranty_period,
								"quantity" => $value->quantity,
								"amount" => $value->amount,
								"gross_total" => $value->total,
								"status" => 'active',
								"user_id" => $this->session->userdata('user_id'),
								"datetime" => $datetime
							);

							if($this->asset_model->addAssetCategory($data)){
							}
							else{
							}
						}
					}
					redirect('asset/add');
				}
				else{
					redirect('asset/add','refresh');
				}
			}
		}
	/* 
		This function is used to call view  edit asset 
	*/
		public function edit($id){
			$data['data'] = $this->asset_model->getRecord($id);
			foreach ($data['data'] as $key) {
				$asset_id = $key->asset_id;
				$data['categories'] = $this->asset_model->getAssetCategories($asset_id);
			}
			
			$this->load->view('asset/edit', $data);
		}
	/* 
		This function is used to delete discount record in databse 
	*/
		public function delete($id){
			if($this->asset_model->deleteModel($id)){
				$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Asset Deleted'
				);
				$this->log_model->insert_log($log_data);
				
				
				redirect('asset','refresh');
			}
			else{
				redirect('asset','refresh');
			}
		}
	/* 
		This function is to edit asset record in database 
	*/
		public function editAsset(){
			$id = $this->input->post('asset_id');
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
					$url = "/assets/images/asset/".uniqid(rand()).'.'.$type;

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
					"bill_description"	=>	$this->input->post('bill_description'),
					"status" 			=>	'active',
					"datetime" 			=> 	$datetime,
					"user_id" 			=> 	$this->session->userdata('user_id'),
					"username" 			=> 	$this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name')
				);

				$js_data = json_decode($this->input->post('table_data1'));
				if($this->asset_model->editModel($id,$data)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Asset Updated'
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
									"asset_id" => $this->input->post('asset_id'),
									"asset_name" => $value->asset_name,
									"asset_description" => $value->asset_description,
									"purpose" => $value->purpose,
									"warranty_period" => $value->warranty_period,
									"quantity" => $value->quantity,
									"amount" => $value->amount,
									"gross_total" => $value->total,
									"status" => 'active',
									"user_id" => $this->session->userdata('user_id'),
									"datetime" => $datetime
								);

								if($this->asset_model->addUpdateAssetCategory($id,$data)){
								}
								else{
								}
							}
						}
						redirect('asset');
					}
				}
				else{
					redirect('asset','refresh');
				}
			}
		}
	/*
		view asset items
	*/
		public function categories_view($id){
			$data['data'] = $this->asset_model->categoriesView($id);

			echo json_encode($data);
		}
	/*
		view asset details
	*/
		public function view($id){
			$data['data'] = $this->asset_model->getDetails($id);
			$data['items'] = $this->asset_model->getItems($id);
			//$data['company'] = $this->asset_model->getCompany();

			$this->load->view('asset/view',$data);
		}
	/*
		generate pdf 
	*/
		public function pdf($id){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Asset Bill Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$data['data'] = $this->asset_model->getDetails($id);
			$data['items'] = $this->asset_model->itemsView($id);
			$html = $this->load->view('asset/pdf',$data,true);

			include(APPPATH.'third_party/mpdf/vendor/autoload.php');
			$mpdf = new \Mpdf\Mpdf();
	        
	        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
	        $mpdf->allow_charset_conversion = true;
	        $mpdf->charset_in = 'UTF-8';
	        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
			$mpdf->showWatermarkImage = true;
	        $mpdf->WriteHTML($html);
	        $mpdf->Output('asset_bill.pdf','I');
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
			/*$data = $this->asset_model->getSupplierEmail($id);*/
			$company = $this->asset_model->getCompany();
			$email = $this->asset_model->getSmtpSetup();
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
			redirect('asset','refresh');
		}
	/*
		view payment
	*/
		public function payment($id){
			$data['data'] = $this->asset_model->getDetails($id);
			$data['items'] = $this->asset_model->getItems($id);
			$data['company'] = $this->asset_model->getCompany();
			$data['ledger'] = $this->asset_model->getLedger();
			$data['p_reference_no'] = $this->asset_model->generateReferenceNo();
			$this->load->view('asset/payment',$data);
		}
	/*
		add payment
	*/
		public function paymentAdd($id){
			$data['data'] = $this->asset_model->getDetails($id);
			$data['items'] = $this->asset_model->getItems($id);
			$data['company'] = $this->asset_model->getCompany();
			$data['p_reference_no'] = $this->asset_model->generateReferenceNo();
			$this->load->view('asset/payment/add',$data);
		}
	/*
		get Discount value for AJAX 
	*/
		public function getDiscountValue($id){
			$data = $this->asset_model->getDiscountValue($id);
			echo json_encode($data);
		}
	/*
		get Tax value for AJAX 
	*/
		public function getTaxValue($id){
			$data = $this->asset_model->getTaxValue($id);
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

				if($this->asset_model->addPayment($data)){
					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Purchase Payable'
					);
					$this->log_model->insert_log($log_data);
					redirect('asset','refresh');
				}
				else{
					redirect("asset",'refresh');
				}
			}
		}

		/*
			generate receipt
		*/
		public function receipt(){
			$data['data'] = $this->asset_model->receipt();
			$this->load->view('asset/receipt',$data);
		}
	}
	?>