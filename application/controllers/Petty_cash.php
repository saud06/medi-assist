<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Petty_cash extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('petty_cash_model');
		$this->load->model('log_model');
	}
	public function index(){
		//get all petty_cash records to display list
		$data['data'] = $this->petty_cash_model->getPettyCash();
		$data['data2'] = $this->petty_cash_model->getPettyCashHistory();
		$this->load->view('petty_cash/list',$data);
	}
	/*
		generate petty cash list pdf
	*/
	public function petty_cash_list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'petty_cash_list';
		$data['data'] = $this->petty_cash_model->getPettyCash();
		$html = $this->load->view('petty_cash/petty_cash_list_pdf',$data,true);

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
		generate petty cash history pdf
	*/
	public function petty_cash_assign_history_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'petty_cash_assign_history';
		$data['data'] = $this->petty_cash_model->getPettyCashHistory();
		$html = $this->load->view('petty_cash/petty_cash_assign_history_pdf',$data,true);

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
		get filtered petty cash
	*/
	public function filter_petty_cash(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->petty_cash_model->getFilteredPettyCash($status);
		
		echo json_encode($data);
	}
	/*
		get all state of country
	*/
	public function getState($id){
		$data = $this->petty_cash_model->getState($id);
		echo json_encode($data);
	}
	/*
		get all city of state
	*/
	public function getCity($id){
		$data = $this->petty_cash_model->getCity($id);
		echo json_encode($data);
	}
	/* 
		Delete selected  Client Record 
	*/
	public function delete($id){
		if($this->petty_cash_model->deleteModel($id)){
			$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Petty Cash Deleted'
					);
				$this->log_model->insert_log($log_data);
			redirect('petty_cash','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Petty Cash can not be Deleted.');
			redirect("petty_cash",'refresh');
		}
	}
	/* 
		Delete selected  Client Record 
	*/
	public function delete_history($id){
		if($this->petty_cash_model->deleteHistoryModel($id)){
			$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Petty Cash History Deleted'
					);
				$this->log_model->insert_log($log_data);
			redirect('petty_cash','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Petty Cash History can not be Deleted.');
			redirect("petty_cash",'refresh');
		}
	}
	/* 
		Delete selected  Client Type Record 
	*/
	public function deleteType($id){
		if($this->petty_cash_model->deleteTypeModel($id)){
			$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Client Type Deleted'
					);
				$this->log_model->insert_log($log_data);
			redirect('petty_cash/type','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Client Type can not be Deleted.');
			redirect("petty_cash/type",'refresh');
		}
	}
	/* 
		call add view to add petty_cash record 
	*/
	public function add(){
		$data['code'] = $this->petty_cash_model->createCode();
		$this->load->view('petty_cash/add', $data);
	}
	/* 
		call add view to add petty_cash type record 
	*/
	public function addType(){
		$this->load->view('petty_cash/addType');
	}
	/* 
		call edit view to edit petty_cash record 
	*/
	public function edit($id){
		$data['data'] = $this->petty_cash_model->getRecord($id);
		$this->load->view('petty_cash/edit',$data);
	}
	/* 
		get all petty_cash type
	*/
	public function type(){
		$data['data'] = $this->petty_cash_model->getClientType();
		$this->load->view('petty_cash/type',$data);
	}
	/* 
		call edit view to edit petty_cash type record 
	*/
	public function editType($id){
		$data['data'] = $this->petty_cash_model->getTypeRecord($id);
		$this->load->view('petty_cash/editType',$data);
	}
	/* 
		This function used to add record in database 
	*/
	public function addPettyCash(){
		$this->load->helper('security');
		$this->form_validation->set_rules('date','Date','trim|required');
		$this->form_validation->set_rules('amount','Amount','trim|required');

		if($this->form_validation->run()==false){
			$this->add();
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');

			$petty_cash_data = array(
						"cash_date"		=>	$this->input->post('date'),
						"amount"		=>	$this->input->post('amount'),
						"remarks"		=>	$this->input->post('remarks'),
						"status" 		=>  $this->input->post('confirm'),
						"user_id" 		=>  $this->session->userdata('user_id'),
						"datetime" 		=>  $datetime
					);

			if($id = $this->petty_cash_model->addModel($petty_cash_data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Petty Cash Inserted'
					);
				$this->log_model->insert_log($log_data);
				
				redirect('petty_cash/add','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Petty Cash can not be Inserted.');
				redirect("petty_cash/add",'refresh');
			}
		}
	}
	/* 
		This function used to promote petty_cash as user 
	*/
	public function PromoteAsUser($id){
		$petty_cash_data = $this->petty_cash_model->getPettyCashToPromote($id);

		if($petty_cash_data){
			$data['data'] = array(
				"first_name"	=>	$petty_cash_data[0]->first_name,
				"last_name"		=>	$petty_cash_data[0]->last_name,
				"email"			=>	$petty_cash_data[0]->cemail,
				"phone"			=>	$petty_cash_data[0]->cphone,
				"address"		=>	$petty_cash_data[0]->pre_address,
				"emp_id"    	=>  $petty_cash_data[0]->petty_cash_id
			);

			$data['user_cat'] = $this->petty_cash_model->getUserCat();

			$this->load->view('auth/create_user', $data);		
		}

		else{
			redirect('petty_cash','refresh');
		}
	}
	/* 
		This function used to store petty_cash type record in database  
	*/
	public function addTypeDetails(){
        $this->form_validation->set_rules('type_name', 'Type Name', 'trim|required|min_length[3]|callback_alpha_dash_space1');
        if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
        	date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
						"name" => $this->input->post('type_name'),
						"status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);

			if($id = $this->petty_cash_model->addTypeModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Client Type Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('petty_cash/type','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Client Type can not be Inserted.');
				redirect("petty_cash/type",'refresh');
			}
        }	
		
	}
	/* 
		This function used to edit petty_cash record in database 
	*/
	public function editPettyCash(){
		$id = $this->input->post('id');
		$this->load->helper('security');
		$this->form_validation->set_rules('date','Date','trim|required');
		$this->form_validation->set_rules('amount','Amount','trim|required');

		if($this->form_validation->run()==false){
			$this->edit($id);
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			
			$petty_cash_data = array(
						"cash_date"		=>	$this->input->post('date'),
						"amount"		=>	$this->input->post('amount'),
						"remarks"		=>	$this->input->post('remarks'),
						"status" 		=>  $this->input->post('confirm'),
						"user_id" 		=>  $this->session->userdata('user_id'),
						"datetime" 		=>  $datetime
					);

			if($this->petty_cash_model->editModel($petty_cash_data, $id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Petty Cash Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('petty_cash','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Petty Cash can not be Updated.');
				redirect("petty_cash",'refresh');
			}
		}
	}
	/* 
		This function used to edit petty_cash type record in database 
	*/
	public function editTypeDetails(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('type_name','Type Name','trim|required|min_length[3]|callback_alpha_dash_space1');

		if($this->form_validation->run()==false){
			$this->edit($id);
		}
		else
		{
			date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
						"name"	=>	$this->input->post('type_name'),
						"status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime,
						"client_type_id"	=>	$this->input->post('id')
					);
			if($this->petty_cash_model->editTypeModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Client Type Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('petty_cash/type','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Client Type can not be Updated.');
				redirect("petty_cash/type",'refresh');
			}
		}
	}
	/*
		this function call CSV file view
	*/
	public function import(){
		$this->load->view('petty_cash/import');
	}
	/*
		this  function get csv file data
	*/
	public function import_csv(){
		$filename = $_FILES["csv"]["tmp_name"];      

		if($_FILES["csv"]["size"] > 0)
		{
			$file = fopen($filename, "r");

			for ($lines = 0; $data = fgetcsv($file,1000,",",'"'); $lines++) 
			{
				if($lines == 0) continue;

				$sql = "SELECT * FROM attendance WHERE ac_no = '$data[0]' AND date = '$data[3]'";
				$result = $this->db->query($sql,array($data[0], $data[3]));

				if($result->num_rows() > 0){
					$sql = "UPDATE attendance SET name = '$data[1]', auto_assign = '$data[2]', time_table = '$data[4]', on_duty = '$data[5]', off_duty = '$data[6]', clock_in = '$data[7]', clock_out = '$data[8]', normal = '$data[9]', real_time = '$data[10]', late = '$data[11]', early = '$data[12]', absent = '$data[13]', ot_time = '$data[14]', work_time = '$data[15]', exception = '$data[16]', must_c_in = '$data[17]', must_c_out = '$data[18]', department = '$data[19]', n_days = '$data[20]', week_end = '$data[21]', holiday = '$data[22]', att_time = '$data[23]', n_days_ot = '$data[24]', week_end_ot = '$data[25]', holiday_ot = '$data[26]' WHERE (ac_no = '$data[0]' AND date = '$data[3]')";

					$this->db->query($sql);
				}

				else{
					$sql = "INSERT INTO `attendance`(`ac_no`, `name`, `leave_status`, `leave_remarks`, `auto_assign`, `date`, `time_table`, `on_duty`, `off_duty`, `clock_in`, `clock_out`, `normal`, `real_time`, `late`, `early`, `absent`, `ot_time`, `work_time`, `exception`, `must_c_in`, `must_c_out`, `department`, `n_days`, `week_end`, `holiday`, `att_time`, `n_days_ot`, `week_end_ot`, `holiday_ot`) VALUES ('".$data[0]."','".$data[1]."','','','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."','".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."','".$data[14]."','".$data[15]."','".$data[16]."','".$data[17]."','".$data[18]."','".$data[19]."','".$data[20]."','".$data[21]."','".$data[22]."','".$data[23]."','".$data[24]."','".$data[25]."','".$data[26]."')";

					$this->db->query($sql);
				}
			}

			fclose($file); 
		}

		else{
			redirect("petty_cash/import",'refresh'); 
		}

		redirect('petty_cash/attendance','refresh');
	}

	/*
		get attendance record
	*/
	public function attendance(){
		$month = $this->input->post('month');
		$year = $this->input->post('year');

		$data['petty_cash'] = $this->petty_cash_model->getPettyCash();
		$data['holiday'] = $this->petty_cash_model->getHoliday();

		if($month){
			$data['required_month_number'] = $month;
		}
		if($year){
			$data['required_year_number'] = $year;
		}

		$this->load->view('petty_cash/attendance', $data);
	}

	/*
		submit attendance
	*/
	public function submit_attendance(){
		$emp_id = $this->input->post('emp_id');
		$emp_name = $this->input->post('emp_name');
		$date = $this->input->post('date');
		$status = $this->input->post('status');

		$data = array(
			"ac_no" => $this->input->post('emp_id'),
			"name" => $this->input->post('emp_name'),
			"date" => $date,
			"status" => $this->input->post('status')
		);

		$insert_delete = $this->petty_cash_model->submitAttendance($data);
		echo json_encode($insert_delete);
	}

	/*
		leave
	*/
	public function assign_cash(){
		date_default_timezone_set('Asia/Dhaka');
        $datetime = date('Y-m-d H:i:s');
		$data = array(
			"emp_id" => $this->input->post('emp_id'),
			"emp_name" => $this->input->post('emp_name'),
			"assign_date" => $this->input->post('date'),
			"amount" => $this->input->post('amount'),
			"status" => 'Active',
			"user_id" => $this->session->userdata('user_id'),
			"datetime" => $datetime
		);

		if($id = $this->petty_cash_model->assignCash($data)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Petty Cash Inserted'
				);
			$this->log_model->insert_log($log_data);

			echo json_encode(array("status" => TRUE));
		}
	}

	/*
		view asset items
	*/
	public function assign_history($emp_id){
		$data['data'] = $this->petty_cash_model->assignHistory($emp_id);

		echo json_encode($data);
	}

	/*
		holiday
	*/
	public function holiday(){
		$date_range = $this->input->post('date_range2');
		if($date_range){
			$explode = explode(' - ', $date_range);
			$start_date = $explode[0];
			$start_date = date("m-d-Y", strtotime($start_date));
			$end_date = $explode[1];
			$end_date = date("m-d-Y", strtotime($end_date));
		}

		$data = array(
			"start_date" => $start_date,
			"end_date" => $end_date,
			"remarks" => $this->input->post('remarks2')
		);

		$insert = $this->petty_cash_model->addHoliday($data);

		if($insert){
			echo json_encode(array("status" => TRUE));
		}
	}

	/* 
		view petty_cash salary record 
	*/
	public function salary_sheet(){
		$month = $this->input->post('month');
		$year = $this->input->post('year');

		$data['data'] = $this->petty_cash_model->getPettyCash();
		$data['salary'] = $this->petty_cash_model->getSalary();
		$data['holiday'] = $this->petty_cash_model->getHoliday();

		if($month){
			$data['required_month_number'] = $month;
		}
		if($year){
			$data['required_year_number'] = $year;
		}
		
		$this->load->view('petty_cash/salary_sheet', $data);
	}

	/* 
		finalize salary sheet
	*/
	public function finalize(){
		$month_and_year = $this->input->post('month_and_year');
		$salary_data = $this->input->post('salary_data');

		for($i=0; $i<sizeof($salary_data); $i++){
			$salary_array = array();

			for($j=0; $j<24; $j++){
				array_push($salary_array, $salary_data[$i][$j]);
			}

			date_default_timezone_set('Asia/Dhaka');
			$datetime = date('Y-m-d H:i:s');
			
			$data = array(
				"month_and_year" => $month_and_year,
				"emp_id" => $salary_array[0],
				"emp_name" => $salary_array[1],
				"emp_designation" => $salary_array[2],
				"emp_join_date" => $salary_array[3],
				"present" => $salary_array[4],
				"leave" => $salary_array[5],
				"absent" => $salary_array[6],
				"fine" => $salary_array[7],
				"grace" => $salary_array[8],
				"salary_mode" => $salary_array[9],
				"salary" => $salary_array[10],
				"basic" => $salary_array[11],
				"house_rent" => $salary_array[12],
				"medical" => $salary_array[13],
				"lfa" => $salary_array[14],
				"conveyance" => $salary_array[15],
				"special_allowance" => $salary_array[16],
				"gross_salary" => $salary_array[17],
				"per_day_salary" => $salary_array[18],
				"absent_deduction" => $salary_array[19],
				"tds" => $salary_array[20],
				"others" => $salary_array[21],
				"total_deduction" => $salary_array[22],
				"net_salary" => $salary_array[23],
				"salary_status" => 'Active',
				"user_id" => $this->session->userdata('user_id'),
				"datetime" => $datetime
			);

			if($this->petty_cash_model->finalizeSalary($data)){
			}
			else{
			}
		}

		$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => 0,
						'message'  => 'Salary Sheet Finalized'
					);
		$this->log_model->insert_log($log_data);

		echo json_encode(array("status" => TRUE));
	}

	function alpha_dash_space($str) {
		if (! preg_match("/^([-a-zA-Z])+$/i", $str))
	    {
	        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha, spaces and dashes.');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}
	function alpha_dash_space1($str) {
		if (! preg_match("/^[A-Za-z0-9]+$/", $str))
	    {
	        $this->form_validation->set_message('alpha_dash_space1', 'The %s field may only contain alpha, and numbers.');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}
	function alpha_dash_space2($str) {
		if (! preg_match("/^[a-z0-9\040\.\-\,\/]+$/i", $str))
	    {
	        $this->form_validation->set_message('alpha_dash_space2', 'The %s field may only contain alpha, dash, comma, slash number and spaces.');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}
	function generateRandomString($length) {
	    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	public function test(){
		$data = array(
				'client_name' => $this->input->post('client_name'),
				'address'	 =>	$this->input->post('address'),
				'city_id'	 =>	$this->input->post('city'),
				'country_id'	=>	$this->input->post('country'),
				'state_id'	 =>	$this->input->post('state'),
				'mobile'	 =>$this->input->post('mobile')
			);
		echo $this->db->insert('petty_cash',$data);
	}
}
?>