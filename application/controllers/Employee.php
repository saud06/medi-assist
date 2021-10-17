<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('employee_model');
		$this->load->model('log_model');
	}
	public function index(){
		//get all employee records to display list
		$data['data'] = $this->employee_model->getEmployee();
		$this->load->view('employee/list',$data);
	}
	/*
		generate employee list pdf
	*/
	public function list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'employee_list';
		$data['data'] = $this->employee_model->getEmployee();
		$html = $this->load->view('employee/list_pdf',$data,true);

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
		get filtered employees
	*/
	public function filter_employee(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->employee_model->getFilteredEmployee($status);
		
		echo json_encode($data);
	}
	/*
		filter employee pdf
	*/
	public function filterEmployeePDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered employee record and display list
		$data['data'] = $this->employee_model->getFilteredEmployee($status);

		$file_name = 'employee_list';
		$html = $this->load->view('employee/list_pdf',$data,true);

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
		get all state of country
	*/
	public function getState($id){
		$data = $this->employee_model->getState($id);
		echo json_encode($data);
	}
	/*
		get all city of state
	*/
	public function getCity($id){
		$data = $this->employee_model->getCity($id);
		echo json_encode($data);
	}
	/* 
		Delete selected  Client Record 
	*/
	public function delete($id){
		if($this->employee_model->deleteModel($id)){
			$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Emloyee Deleted'
					);
				$this->log_model->insert_log($log_data);
			redirect('employee','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Employee can not be Deleted.');
			redirect("employee",'refresh');
		}
	}
	/* 
		Delete selected  Client Type Record 
	*/
	public function deleteType($id){
		if($this->employee_model->deleteTypeModel($id)){
			$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Client Type Deleted'
					);
				$this->log_model->insert_log($log_data);
			redirect('employee/type','refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'Client Type can not be Deleted.');
			redirect("employee/type",'refresh');
		}
	}
	/* 
		call add view to add employee record 
	*/
	public function add(){
		$data['code'] = $this->employee_model->createCode();
		$this->load->view('employee/add', $data);
	}
	/* 
		call add view to add employee type record 
	*/
	public function addType(){
		$this->load->view('employee/addType');
	}
	/* 
		call edit view to edit employee record 
	*/
	public function edit($id){
		$data['data'] = $this->employee_model->getRecord($id);
		$this->load->view('employee/edit',$data);
	}
	/* 
		get all employee type
	*/
	public function type(){
		$data['data'] = $this->employee_model->getClientType();
		$this->load->view('employee/type',$data);
	}
	/* 
		call edit view to edit employee type record 
	*/
	public function editType($id){
		$data['data'] = $this->employee_model->getTypeRecord($id);
		$this->load->view('employee/editType',$data);
	}
	/* 
		This function used to add record in database 
	*/
	public function addEmployee(){
		$this->load->helper('security');
		$this->form_validation->set_rules('nid_number','NID Number','trim|required|min_length[10]|callback_alpha_dash_space1');
		$this->form_validation->set_rules('first_name','First Name','trim|required|min_length[3]|callback_alpha_dash_space2');
		$this->form_validation->set_rules('last_name','Last Name','trim|required|min_length[3]|callback_alpha_dash_space2');
		$this->form_validation->set_rules('fname','Father Name','trim|required|min_length[3]|callback_alpha_dash_space2');
		$this->form_validation->set_rules('religion', 'Religion', 'trim|required');
		$this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('pre_address', 'Present Address', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('join_desg','Joining Designation','trim|required|min_length[3]|callback_alpha_dash_space2');
		$this->form_validation->set_rules('join_date','Joining Date','trim|required');
		$this->form_validation->set_rules('start_time','Starting Time','trim|required');
		$this->form_validation->set_rules('end_time','End Time','trim|required');
		$this->form_validation->set_rules('starting_salary','Starting Salary','trim|required');
		$this->form_validation->set_rules('wk_holiday','Weekly Holiday','trim|required');
		$this->form_validation->set_rules('emp_status','Employee Status','trim|required');

		if($this->form_validation->run()==false){
			$this->add();
		}
		else
		{
			if($_FILES["emp_photo"]["name"]){
				$type = explode('.',$_FILES["emp_photo"]["name"]);
				$type = $type[count($type)-1];
				$url = "assets/images/employee/".uniqid(rand()).'.'.$type;

				if(in_array($type,array("jpg","jpeg","gif","png"))){

					if(is_uploaded_file($_FILES["emp_photo"]["tmp_name"])){

						if(move_uploaded_file($_FILES["emp_photo"]["tmp_name"],$url)){

						}
					}	
				}
			}
			else{
				$url = "assets/images/employee/no_image.jpg";
			}

			if($_FILES["emp_resume"]["name"]){
				$type2 = explode('.',$_FILES["emp_resume"]["name"]);
				$type2 = $type2[count($type2)-1];
				$url2 = "assets/images/employee/".uniqid(rand()).'.'.$type2;

				if(in_array($type2,array("jpg","jpeg","gif","png"))){

					if(is_uploaded_file($_FILES["emp_resume"]["tmp_name"])){

						if(move_uploaded_file($_FILES["emp_resume"]["tmp_name"],$url2)){

						}
					}	
				}
			}
			else{
				$url2 = "assets/images/employee/no_image.jpg";
			}

			date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
        	$dob = $this->input->post('dob');
        	if($dob == ''){
        		$dob = '0000-00-00';
        	}

			$employee_data = array(
						"employee_id"	=>	$this->input->post('emp_id'),
						"nid_number"	=>	$this->input->post('nid_number'),
						"dob"			=>	$dob,
						"first_name"	=>	$this->input->post('first_name'),
						"last_name"		=>	$this->input->post('last_name'),
						"nick_name"		=>	$this->input->post('nick_name'),
						"fname"			=>	$this->input->post('fname'),
						"mname"			=>	$this->input->post('mname'),
						"religion"		=>	$this->input->post('religion'),
						"marital_status"=>	$this->input->post('marital_status'),
						"passport_no"	=>	$this->input->post('passport_no'),
						"gender"		=>	$this->input->post('gender'),
						"blood_group"	=>	$this->input->post('blood_group'),
						"nationality"	=>	$this->input->post('nationality'),
						"cphone"		=>	$this->input->post('cphone'),
						"cemail"		=>	$this->input->post('cemail'),
						"pre_address"	=>	$this->input->post('pre_address'),
						"per_address"	=>	$this->input->post('per_address'),
						"emp_photo"     =>  base_url().''.$url,
						"emp_resume"    =>  base_url().''.$url2,
						"join_desg"		=>	$this->input->post('join_desg'),
						"join_date" 	=>  $this->input->post('join_date'),
						"start_time"	=>	$this->input->post('start_time'),
						"end_time" 		=>  $this->input->post('end_time'),
						"starting_salary" 	=>  $this->input->post('starting_salary'),
						"wk_holiday"	=>	$this->input->post('wk_holiday'),
						"emp_status" 		=>  $this->input->post('emp_status'),
						"user_id" 		=>  $this->session->userdata('user_id'),
						"datetime" 		=>  $datetime
					);

			if($id = $this->employee_model->addModel($employee_data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Employee Inserted'
					);
				$this->log_model->insert_log($log_data);

				$promote = $this->input->post('promote');
				if($promote == 1){
					$data['data'] = array(
						"first_name"	=>	$this->input->post('first_name'),
						"last_name"		=>	$this->input->post('last_name'),
						"email"			=>	$this->input->post('cemail'),
						"phone"			=>	$this->input->post('cphone'),
						"address"		=>	$this->input->post('pre_address'),
						"join_desg"		=>	$this->input->post('join_desg'),
						"emp_id"    	=>  $this->input->post('emp_id')
					);

					$data['user_cat'] = $this->employee_model->getUserCat();

					$this->load->view('auth/create_user', $data);
				}
				else{
					redirect('employee/add','refresh');
				}
			}
			else{
				$this->session->set_flashdata('fail', 'Employee can not be Inserted.');
				redirect("employee/add",'refresh');
			}
		}
	}
	/* 
		This function used to promote employee as user 
	*/
	public function PromoteAsUser($id){
		$employee_data = $this->employee_model->getEmployeeToPromote($id);

		if($employee_data){
			$data['data'] = array(
				"first_name"	=>	$employee_data[0]->first_name,
				"last_name"		=>	$employee_data[0]->last_name,
				"email"			=>	$employee_data[0]->cemail,
				"phone"			=>	$employee_data[0]->cphone,
				"address"		=>	$employee_data[0]->pre_address,
				"join_desg"		=>	$employee_data[0]->join_desg,
				"emp_id"    	=>  $employee_data[0]->employee_id
			);

			$data['user_cat'] = $this->employee_model->getUserCat();

			$this->load->view('auth/create_user', $data);		
		}

		else{
			redirect('employee/add','refresh');
		}
	}
	/* 
		This function used to store employee type record in database  
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

			if($id = $this->employee_model->addTypeModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Client Type Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('employee/type','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Client Type can not be Inserted.');
				redirect("employee/type",'refresh');
			}
        }	
		
	}
	/* 
		This function used to edit employee record in database 
	*/
	public function editEmployee(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('nid_number','NID Number','trim|required|min_length[10]|callback_alpha_dash_space1');
		$this->form_validation->set_rules('first_name','First Name','trim|required|min_length[3]|callback_alpha_dash_space2');
		$this->form_validation->set_rules('last_name','Last Name','trim|required|min_length[3]|callback_alpha_dash_space2');
		$this->form_validation->set_rules('fname','Father Name','trim|required|min_length[3]|callback_alpha_dash_space2');
		$this->form_validation->set_rules('religion', 'Religion', 'trim|required');
		$this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('pre_address', 'Present Address', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('join_desg','Joining Designation','trim|required|min_length[3]|callback_alpha_dash_space2');
		$this->form_validation->set_rules('join_date','Joining Date','trim|required');
		$this->form_validation->set_rules('start_time','Starting Time','trim|required');
		$this->form_validation->set_rules('end_time','End Time','trim|required');
		$this->form_validation->set_rules('starting_salary','Starting Salary','trim|required');
		$this->form_validation->set_rules('wk_holiday','Weekly Holiday','trim|required');
		$this->form_validation->set_rules('emp_status','Employee Status','trim|required');

		if($this->form_validation->run()==false){
			$this->edit($id);
		}
		else
		{
			if($_FILES["emp_photo"]["name"] == null){
				$url = $this->input->post('hidden_emp_photo');
			}
			else{
				$type = explode('.',$_FILES["emp_photo"]["name"]);
				$type = $type[count($type)-1];
				$url = "/assets/images/employee/".uniqid(rand()).'.'.$type;

				if(in_array($type,array("jpg","jpeg","gif","png"))){

					if(is_uploaded_file($_FILES["emp_photo"]["tmp_name"])){

						if(move_uploaded_file($_FILES["emp_photo"]["tmp_name"],$url)){

						}
					}	
				}
			}

			if($_FILES["emp_resume"]["name"] == null){
				$url2 = $this->input->post('hidden_emp_resume');
			}
			else{
				$type2 = explode('.',$_FILES["emp_resume"]["name"]);
				$type2 = $type2[count($type2)-1];
				$url2 = "/assets/images/employee/".uniqid(rand()).'.'.$type2;

				if(in_array($type2,array("jpg","jpeg","gif","png"))){

					if(is_uploaded_file($_FILES["emp_resume"]["tmp_name"])){

						if(move_uploaded_file($_FILES["emp_resume"]["tmp_name"],$url2)){

						}
					}	
				}
			}

			date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
        	$dob = $this->input->post('dob');
        	if($dob == ''){
        		$dob = '0000-00-00';
        	}
			
			$employee_data = array(
						"employee_id"	=>	$this->input->post('emp_id'),
						"nid_number"	=>	$this->input->post('nid_number'),
						"dob"			=>	$dob,
						"first_name"	=>	$this->input->post('first_name'),
						"last_name"		=>	$this->input->post('last_name'),
						"nick_name"		=>	$this->input->post('nick_name'),
						"fname"			=>	$this->input->post('fname'),
						"mname"			=>	$this->input->post('mname'),
						"religion"		=>	$this->input->post('religion'),
						"marital_status"=>	$this->input->post('marital_status'),
						"passport_no"	=>	$this->input->post('passport_no'),
						"gender"		=>	$this->input->post('gender'),
						"blood_group"	=>	$this->input->post('blood_group'),
						"nationality"	=>	$this->input->post('nationality'),
						"cphone"		=>	$this->input->post('cphone'),
						"cemail"		=>	$this->input->post('cemail'),
						"pre_address"	=>	$this->input->post('pre_address'),
						"per_address"	=>	$this->input->post('per_address'),
						"emp_photo"     =>  $url,
						"emp_resume"    =>  $url2,
						"join_desg"		=>	$this->input->post('join_desg'),
						"join_date" 	=>  $this->input->post('join_date'),
						"start_time"	=>	$this->input->post('start_time'),
						"end_time" 		=>  $this->input->post('end_time'),
						"starting_salary" 	=>  $this->input->post('starting_salary'),
						"wk_holiday"	=>	$this->input->post('wk_holiday'),
						"emp_status" 		=>  $this->input->post('emp_status'),
						"user_id" 		=>  $this->session->userdata('user_id'),
						"datetime" 		=>  $datetime
					);

			if($this->employee_model->editModel($employee_data, $id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Employee Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('employee','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Employee can not be Updated.');
				redirect("employee",'refresh');
			}
		}
	}
	/* 
		This function used to edit employee type record in database 
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
			if($this->employee_model->editTypeModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Client Type Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('employee/type','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Client Type can not be Updated.');
				redirect("employee/type",'refresh');
			}
		}
	}
	/*
		this function call CSV file view
	*/
	public function import(){
		$this->load->view('employee/import');
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
			redirect("employee/import",'refresh'); 
		}

		redirect('employee/attendance','refresh');
	}

	/*
		get attendance record
	*/
	public function attendance(){
		$month = $this->input->post('month');
		$year = $this->input->post('year');

		$data['employee'] = $this->employee_model->getEmployee();
		$data['holiday'] = $this->employee_model->getHoliday();

		if($month){
			$data['required_month_number'] = $month;
		}
		if($year){
			$data['required_year_number'] = $year;
		}

		$this->load->view('employee/attendance', $data);
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

		$insert_delete = $this->employee_model->submitAttendance($data);
		echo json_encode($insert_delete);
	}

	/*
		leave
	*/
	public function leave(){
		$date_range = $this->input->post('date_range');
		if($date_range){
			$explode = explode(' - ', $date_range);
			$start_date = $explode[0];
			$start_date = date("m-d-Y", strtotime($start_date));
			$end_date = $explode[1];
			$end_date = date("m-d-Y", strtotime($end_date));
		}

		$data = array(
			"ac_no" => $this->input->post('emp_id'),
			"name" => $this->input->post('emp_name'),
			"start_date" => $start_date,
			"end_date" => $end_date,
			"leave_status" => 'y',
			"leave_remarks" => $this->input->post('remarks')
		);

		$insert = $this->employee_model->addLeave($data);

		if($insert){
			echo json_encode(array("status" => TRUE));
		}
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

		$insert = $this->employee_model->addHoliday($data);

		if($insert){
			echo json_encode(array("status" => TRUE));
		}
	}

	/* 
		view employee salary record 
	*/
	public function salary_sheet(){
		$month = $this->input->post('month');
		$year = $this->input->post('year');

		$data['data'] = $this->employee_model->getEmployee();
		$data['salary'] = $this->employee_model->getSalary();
		$data['holiday'] = $this->employee_model->getHoliday();

		if($month){
			$data['required_month_number'] = $month;
		}
		if($year){
			$data['required_year_number'] = $year;
		}
		
		$this->load->view('employee/salary_sheet', $data);
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

			if($this->employee_model->finalizeSalary($data)){
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
		echo $this->db->insert('employee',$data);
	}
}
?>