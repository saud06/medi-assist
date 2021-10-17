<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Discount_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* 
		return all discount details to display list  
	*/
	public function getDiscount(){
		$this->db->select('d.*,u.*')
				 ->from('discount d')
				 ->join('users u','u.id = d.user_id');
		return $this->db->get()->result();
	}
	/* 
		insert new  discount record in database 
	*/
	public function addModel($data){
		$sql = "insert into discount (discount_name,discount_value,user_id) values(?,?,?)";
		if($this->db->query($sql,$data)){
		/*if($this->db->insert('discount',$data)){*/
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return specific discount record to edit 
	*/
	public function getRecord($id){
		$sql = "select * from discount where discount_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('discount_id',$data);
		if($query = $this->db->get('discount')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		save edited discount record in databse 
	*/
	public function editModel($data,$id){
		$sql = "update discount set discount_name = ?,discount_value = ? where discount_id = ?";
		if($this->db->query($sql,array($data['discount_name'],$data['discount_value'],$id))){
		/*$this->db->where('discount_id',$id);
		if($this->db->update('discount',$data)){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* 
		delete discount record from databse 
	*/
	public function deleteModel($id){
		$sql = "delete from discount where discount_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('discount_id',$id);
		if($this->db->delete('discount')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>