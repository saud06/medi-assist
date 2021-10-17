<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Branch_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* 
		return all branch data  
	*/
	public function getBranch(){
		$data = $this->db->get('branch');
		return $data->result();
	}
	/* 
		add new branch record in database 
	*/
	public function addModel($data){
		$sql = "insert into branch (branch_name,city,address) values(?,?,?)";
		if($this->db->query($sql,$data)){
		/*if($this->db->insert('branch',$data)){*/
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return branch record specified id 
	*/
	public function getRecord($id){
		$sql = "select * from branch where branch_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('branch_id',$id);
		if($query = $this->db->get('branch')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		edit branch specified id 
	*/
	public function editModel($data,$id){
		$sql = "update branch set branch_name = ?,city = ?,address = ? where branch_id = ?";
		if($this->db->query($sql,array($data['branch_name'],$data['city'],$data['address'],$id))){
		/*$this->db->where('branch_id',$id);
		if($this->db->update('branch',$data)){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/*
		delete branch specified id 
	*/
	public function deleteModel($id){
		$sql = "delete from branch where branch_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('branch_id',$id);
		if($this->db->delete('branch')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>