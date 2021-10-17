<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tax_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* 
		return all tax details to display list 
	*/
	public function getTax(){
		$data = $this->db->get_where('tax',array('delete_status'=>0));
		return $data->result();
	}
	/* 
		add new record in databse 
	*/
	public function addModel($data){
		$sql = "insert into tax (tax_name,start_from,registration_number,filling_frequency,calculate_on,tax_value,purchase_tax_value,description) values(?,?,?,?,?,?,?,?)";
		if($this->db->query($sql,$data)){
		/*if($this->db->insert('tax',$data)){*/
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
		$sql = "select * from tax where tax_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('tax_id',$data);
		if($query = $this->db->get('tax')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		save edited record in database 
	*/
	public function editModel($data,$id){
		//$sql = "update tax set tax_name = ?,tax_value = ? where tax_id = ?";
		//if($this->db->query($sql,array($data['tax_name'],$data['tax_value'],$id))){
		$this->db->where('tax_id',$id);
		if($this->db->update('tax',$data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* 
		delete record in database 
	*/
	public function deleteModel($id){
		/*$sql = "delete from tax where tax_id = ?";
		if($this->db->query($sql,array($id))){*/
		$this->db->where('tax_id',$id);
		if($this->db->update('tax',array('delete_status'=>1,'delete_date'=>date('Y-m-d')))){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/*
		in active tax
	*/
	public function in_active($id,$date){
		$this->db->where('tax_id',$id);
		return $this->db->update('tax',array('active'=>0,'inactive_date'=>$date));
	}
	/*
		active tax
	*/
	public function active($id){
		$this->db->where('tax_id',$id);
		return $this->db->update('tax',array('active'=>1));
	}
}
?>