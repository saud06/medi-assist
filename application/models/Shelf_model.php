<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class shelf_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* 
		return all shelf data  
	*/
	public function getshelf(){
		$data = $this->db->where('shelf_status', 'active')->get('shelf');
		return $data->result();
	}
	/* 
		return filtered shelf data  
	*/
	public function getFilteredShelf($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('shelf')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('shelf')
						->where('shelf_status', $status)
						->get()
						->result();
		}
	}
	/* 
		add new shelf record in database 
	*/
	public function addModel($data){
		$sql = "insert into shelf (shelf_name,shelf_location,shelf_status, user_id,datetime) values(?,?,?,?,?)";
		if($this->db->query($sql,$data)){
		/*if($this->db->insert('shelf',$data)){*/
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return shelf record specified id 
	*/
	public function getRecord($id){
		$sql = "select * from shelf where shelf_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('shelf_id',$id);
		if($query = $this->db->get('shelf')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		edit shelf specified id 
	*/
	public function editModel($data,$id){
		$sql = "update shelf set shelf_name = ?,shelf_location = ?,shelf_status = ?, user_id=?, datetime=? where shelf_id = ?";
		if($this->db->query($sql,array($data['shelf_name'],$data['shelf_location'],$data['shelf_status'],$data['user_id'],$data['datetime'],$id))){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/*
		delete shelf specified id 
	*/
	public function deleteModel($id){
		$sql = "delete from shelf where shelf_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('shelf_id',$id);
		if($this->db->delete('shelf')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>