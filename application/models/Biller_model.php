<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Biller_model extends CI_Model
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
		return all data of biller 
	*/
	public function getBillers(){
		$data = $this->db->select('b.*,c.name as cname,ct.name as ctname')
		                 ->from('biller b')
		                 ->join('countries c','c.id = b.country_id')
		                 ->join('cities ct','ct.id = b.city_id')
		                 ->get()
		                 ->result();
		return $data;
	}
	/* 
		return branch id and name  
	*/
	public function getBranch(){
		$this->db->select('branch_id,branch_name');
		$query = $this->db->get('branch');
		$data = $query->result();
		return $data;
	}
	/* 
		add new biller record in databse
	*/
	public function addModel($data){
		/*$sql = "insert into biller (branch_id,biller_name,company_name,address,city_id,state_id,country_id,fax,mobile,email,telephone,gstid) values(?,?,?,?,?,?,?,?,?,?,?,?)";*/
		//if($this->db->query($sql,$data)){
		if($this->db->insert('biller',$data)){
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return specified record 
	*/
	public function getRecord($id){
		$sql = "select * from biller where biller_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('biller_id',$data);
		if($query = $this->db->get('biller')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/*  
		edit record specified id 
	*/
	public function editModel($data,$id){
		/*$sql = "update biller set  branch_id= ?,biller_name = ?,company_name = ?,address = ?,city_id = ?,state_id = ?,country_id = ?,fax = ?,mobile = ?,email = ?,telephone = ?, gstid=? where biller_id = ?";
		if($this->db->query($sql,$data)){*/
		$this->db->where('biller_id',$id);
		if($this->db->update('biller',$data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/*
    	delete biller from databse 
    */
	public function deleteModel($id){
		$sql = "delete from biller where biller_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('biller_id',$id);
		if($this->db->delete('biller')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/*
		return state code
	*/
	public function getStateCode($id){
		$this->db->where('state_id',$id);
		return $this->db->get('state_code')->row()->tin_number;
	}
}
?>