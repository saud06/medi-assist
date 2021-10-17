<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class courier_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* 
		return all category data 
	*/
	public function getcourier(){
		$data = $this->db->where('courier_status', 'active')->get('courier');
		return $data->result();
	}
	/* 
		return filtered courier data 
	*/
	public function getFilteredCourier($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('courier')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('courier')
						->where('courier_status', $status)
						->get()
						->result();
		}
	}	
	public function addModel($data){
		$sql = "insert into courier (courier_name,courier_details, courier_status, user_id, datetime) values(?,?,?,?,?)";		
		
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
		$sql = "select * from courier where courier_id = ?";
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
		$sql = "update courier set courier_name = ?, courier_details = ?, courier_status= ?, user_id=?, datetime=? where courier_id = ?";
		if($this->db->query($sql,array($data['courier_name'],$data['courier_details'],$data['courier_status'],$data['user_id'],$data['datetime'],$id))){
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
		$sql = "update courier set courier_status='inactive' where courier_id = ?";
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