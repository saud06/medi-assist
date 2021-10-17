<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Supplier_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
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
		return supplier details to display list 
	*/ 
	public function getSuppliers(){
		$data = $this->db->select('s.*,c.name as cname,ct.name as ctname')
		                 ->from('suppliers s')
		                 ->join('countries c','c.id = s.country_id')
		                 ->join('cities ct','ct.id = s.city_id')
		                 ->get()
		                 ->result();
		return $data;
	}
	/* 
		add new rwcord in database 
	*/
	public function addModel($data){
		$sql = "insert into suppliers (supplier_name,company_name,address,city_id,country_id,state_id,mobile,email,postal_code,gstid,vat_no,pan_no,tan_no,cst_reg_no,excise_reg_no,lbt_reg_no,servicetax_reg_no,gst_registration_type) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		if($this->db->query($sql,$data)){
		/*if($this->db->insert('suppliers',$data)){*/
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return record to edit record 
	*/
	public function getRecord($id){
		$sql = "select * from suppliers where supplier_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('supplier_id',$id);
		if($query = $this->db->get('suppliers')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 	
		save editd record in database 
	*/
	public function editModel($data,$id){
		/*$sql = "update suppliers set supplier_name = ?,company_name = ?,address = ?,city_id = ?,country_id = ?,state_id = ?,mobile = ?,email = ?,postal_code = ?,gstid=?,vat_no=?,pan_no=?,tan_no=?,cst_reg_no=?,excise_reg_no=?,lbt_reg_no,servicetax_reg_no=?,gst_registration_type=? where supplier_id = ?";*/
		//if($this->db->query($sql,$data)){
		$this->db->where('supplier_id',$id);
		if($this->db->update('suppliers',$data)){

			
			return TRUE;
		}
		else{
			return FALSE;
		}
		//exit();
	}
	/* 	
		delete record in database 
	*/
	public function deleteModel($id){
		$sql = "delete from suppliers where supplier_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('supplier_id',$id);
		if($this->db->delete('suppliers')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>