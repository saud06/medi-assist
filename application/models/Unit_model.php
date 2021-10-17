<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Unit_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* 
		return all category data 
	*/
	public function getUnit(){
		$data = $this->db->where('unit_status', 'active')->get('unit');
		return $data->result();
	}
	/* 
		return filtered unit data 
	*/
	public function getFilteredunit($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('unit')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('unit')
						->where('unit_status', $status)
						->get()
						->result();
		}
	}
	/* 
		insert new categoty record in Database 
	*/
	public function addModel($data){
		$sql = "insert into unit (unit_name,unit_symbol,unit_size, unit_status, user_id, datetime) values(?,?,?,?,?,?)";		
		
		if($this->db->query($sql,$data)){
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return selected id record use in edit page 
	*/
	public function getRecord($id){
		$sql = "select * from unit where unit_id = ?";
		if($query = $this->db->query($sql,array($id))){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		this function is used to save edited record in database 
	*/
	public function editModel($data,$id){
		$sql = "update unit set unit_name = ?, unit_symbol = ?, unit_size =?, unit_status= ?, user_id=?, datetime=? where unit_id = ?";
		if($this->db->query($sql,array($data['unit_name'],$data['unit_symbol'],$data['unit_size'],$data['unit_status'],$data['user_id'],$data['datetime'],$id))){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* 
		this function delete category from database  
	*/
	public function deleteModel($id){	
		$sql = "update unit set unit_status='inactive' where unit_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('category_id',$id);
		if($this->db->delete('category')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>