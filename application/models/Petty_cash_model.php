<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Petty_cash_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	/* 
		return last petty_cash id 
	*/
	public function createCode(){
		$query = $this->db->query("SELECT * FROM employee ORDER BY id DESC LIMIT 1");
		$result = $query->result();
		return $result;
	}
	/*
		return user category
	*/
	public function getUserCat(){
		return $this->db->get('category')->result();
	}
	/*
		return country
	*/
	public function getCountry(){
		return $this->db->get('countries')->result();
	}
	/*
		return state
	*/
	public function getState($id){	
		return $this->db->select('s.*')
		                 ->from('states s')
		                 ->join('countries c','c.id = s.country_id')
		                 ->where('s.country_id',$id)
		                 ->get()
		                 ->result();
	}
	/*
		return city 
	*/
	public function getCity($id){
		return $this->db->select('c.*')
		                 ->from('cities c')
		                 ->join('states s','s.id = c.state_id')
		                 ->where('c.state_id',$id)
		                 ->get()
		                 ->result();
	} 
	/* 
		return all client details to dispaly list 
	*/
	public function getPettyCash(){
		//$b_cat_id = "SELECT SUBSTRING(category_id, 1, 1) FROM client";
		$data = $this->db->select('*')
		                 ->from('petty_cash')
		                 ->get()
		                 ->result();
		return $data;
	}
	/* 
		return all client details to dispaly list 
	*/
	public function getPettyCashHistory(){
		//$b_cat_id = "SELECT SUBSTRING(category_id, 1, 1) FROM client";
		$data = $this->db->select('*')
		                 ->from('employee')
		                 ->get()
		                 ->result();
		return $data;
	}
	/* 
		return petty_cash details to promote 
	*/
	public function getPettyCashToPromote($id){
		//$b_cat_id = "SELECT SUBSTRING(category_id, 1, 1) FROM client";
		$data = $this->db->select('*')
		                 ->from('employee')
		                 ->where('id', $id)
		                 ->get()
		                 ->result();
		return $data;
	}
	/* 
		return all petty_cash details to dispaly list 
	*/
	public function getFilteredPettyCash($status){
		if(empty($status)){
			return $this->db->select('*')
			                ->from('employee')
			                ->get()
			                ->result();
		}
		else{
			return $this->db->select('*')
			                 ->from('employee')
			                 ->where('emp_status', $status)
			                 ->get()
			                 ->result();
		}
	}
	/*
		return client type
	*/
	public function getClientType(){
		return $this->db->get('client_type')->result();
	}
	/*
		return client category
	*/
	public function getClientCat(){
		return $this->db->get('category')->result();
	}
	/* 
		insert new client record in databse 
	*/
	public function addModel($petty_cash_data){
		$sql = "INSERT INTO petty_cash (cash_date,amount,remarks,status,user_id,datetime) VALUES(?,?,?,?,?,?)";
		if($this->db->query($sql,$petty_cash_data)){
			return $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* 
		insert client type record in databse 
	*/
	public function addTypeModel($data){
		$sql = "insert into client_type (name,status,user_id,datetime) values(?,?,?,?)";
		if($this->db->query($sql,$data)){
		/*if($this->db->insert('client',$data)){*/
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return specific client record  
	*/
	public function getRecord($id){
		$sql = "select * from petty_cash where petty_cash_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('client_id',$data);
		if($query = $this->db->get('client')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return specific kind attention record  
	*/
	public function getKindAtt($id){
		$sql = "select * from kind_attention where client_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('client_id',$data);
		if($query = $this->db->get('client')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return specific client type record  
	*/
	public function getTypeRecord($id){
		$sql = "select * from client_type where client_type_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('client_id',$data);
		if($query = $this->db->get('client')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		save edited client record in databse 
	*/
	public function editModel($petty_cash_data,$id){
		/*$sql = "update client set client_name = ?,company_name = ?,address = ?,city_id = ?,country_id = ?,state_id = ?,mobile = ?,email = ?,postal_code = ?,gstid=?,vat_no=?,pan_no=?,tan_no=?,cst_reg_no=?,excise_reg_no=?,lbt_reg_no,servicetax_reg_no=?,gst_registration_type=? where client_id = ?";*/
		//if($this->db->query($sql,$data)){
		$this->db->where('petty_cash_id', $id);
		if($this->db->update('petty_cash', $petty_cash_data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* 
		save edited client type record in databse 
	*/
	public function editTypeModel($data,$id){
		/*$sql = "update client set client_name = ?,company_name = ?,address = ?,city_id = ?,country_id = ?,state_id = ?,mobile = ?,email = ?,postal_code = ?,gstid=?,vat_no=?,pan_no=?,tan_no=?,cst_reg_no=?,excise_reg_no=?,lbt_reg_no,servicetax_reg_no=?,gst_registration_type=? where client_id = ?";*/
		//if($this->db->query($sql,$data)){
		$this->db->where('client_type_id',$id);
		if($this->db->update('client_type',$data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* 
		delete client record in databse 
	*/
	public function deleteModel($id){
		$sql = "delete from petty_cash where petty_cash_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('client_id',$id);
		if($this->db->delete('client')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* 
		delete client record in databse 
	*/
	public function deleteHistoryModel($id){
		$sql = "delete from petty_cash_assign_history where petty_cash_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('client_id',$id);
		if($this->db->delete('client')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* 
		delete client type record in databse 
	*/
	public function deleteTypeModel($id){
		$sql = "delete from client_type where client_type_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('client_id',$id);
		if($this->db->delete('client')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* 
		submit attendance
	*/
	public function submitAttendance($data){
		$emp_id = $data['ac_no'];
		$emp_name = $data['name'];
		$date = $data['date'];
		$status = $data['status'];

		if($status == 'insert'){
			$sql = "SELECT * FROM attendance WHERE ac_no = '$emp_id' AND date = '$date'";
			$result = $this->db->query($sql,array($emp_id, $date));

			if($result->num_rows() > 0){
				$sql = "UPDATE attendance SET leave_status = '', leave_remarks = '' WHERE (ac_no = '$emp_id' AND date = '$date')";

				$this->db->query($sql);
				return 'reload_page';
			}

			else{
				$sql = "INSERT INTO `attendance`(`ac_no`, `name`, `leave_status`, `leave_remarks`, `auto_assign`, `date`, `time_table`, `on_duty`, `off_duty`, `clock_in`, `clock_out`, `normal`, `real_time`, `late`, `early`, `absent`, `ot_time`, `work_time`, `exception`, `must_c_in`, `must_c_out`, `department`, `n_days`, `week_end`, `holiday`, `att_time`, `n_days_ot`, `week_end_ot`, `holiday_ot`) VALUES ('".$emp_id."','".$emp_name."','','','','".$date."','Daytime','','','','','1','','','','','','','','True','True','OUR COMPANY','','','','','','','')";

				$this->db->query($sql);
			}
		}

		else{
			$sql = "DELETE FROM attendance WHERE ac_no = ? AND date = ?";
			$this->db->query($sql,array($data['ac_no'], $data['date']));
		}
	}
	/* 
		add leave
	*/
	public function assignCash($data){
		if($this->db->insert('petty_cash_assign_history',$data)){
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/*		
		return purchase items details
	*/
	public function assignHistory($emp_id){
		return $this->db->select('*')
		->from('petty_cash_assign_history')
		->where('emp_id',$emp_id)
		->get()
		->result();
	}
	/* 
		get holiday data
	*/
	public function getHoliday(){
		$data = $this->db->select('*')
		                 ->from('holiday')
		                 ->get()
		                 ->result();
		return $data;
	}
	/* 
		add holiday
	*/
	public function addHoliday($data){
		$start_date = $data['start_date'];
		$start_date2 = str_replace('-', '/', $start_date);
		$end_date = $data['end_date'];
		$end_date2 = str_replace('-', '/', $end_date);
		$remarks = $data['remarks'];
		
	    $dates = array();
	    $current = strtotime($start_date2);
	    $last = strtotime($end_date2);

	    while($current <= $last ){
	        $dates[] = date('m-d-Y', $current);
	        $current = strtotime('+1 day', $current);
	    }

	    $result = $this->db->select('*')
			           ->from('holiday')
			           ->where_in('date', $dates)
			           ->get()
			           ->result();

		if($result){
			return FALSE;
		}

		else{
			for($i=0; $i<sizeof($dates); $i++){
				$sql = "INSERT INTO `holiday`(`date`, `remarks`) VALUES ('".$dates[$i]."','".$remarks."')";

				$this->db->query($sql);
			}

			if($i>0){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
	}
	/* 
		get salary data
	*/
	public function getSalary(){
		$data = $this->db->select('*')
		                 ->from('salary')
		                 ->get()
		                 ->result();
		return $data;
	}
	/* 
		insert new salary record in Database 
	*/
	public function finalizeSalary($data){
		if($this->db->insert('salary', $data)){
			return  TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>