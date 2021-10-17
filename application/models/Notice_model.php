<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notice_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* 
		return all notice data 
	*/
	public function getNotice(){
		$data = $this->db->where('notice_status', 'active')->get('notice');
		return $data->result();
	}
	/* 
		return filtered notice data 
	*/
	public function getFilteredNotice($start_date = NULL, $end_date = NULL, $status){
		if(empty($start_date) && empty($end_date) && empty($status)){
			return $this->db->select('*')
						->from('notice')
						->get()
						->result();
		}
		else if(!empty($start_date) && !empty($end_date) && empty($status)){
			return $this->db->select('*')
						->from('notice')
						->where('notice_date >=', $start_date)
				 		->where('notice_date <=', $end_date)
						->get()
						->result();
		}
		else if(empty($start_date) && empty($end_date) && !empty($status)){
			return $this->db->select('*')
						->from('notice')
						->where('notice_status', $status)
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('notice')
						->where('notice_date >=', $start_date)
				 		->where('notice_date <=', $end_date)
						->where('notice_status', $status)
						->get()
						->result();
		}
	}
	/* 
		return max id from notice table 
	*/
	public function getMaxId(){
		$id =  $this->db->select_max('notice_id')->get('notice')->row()->notice_id;
		if($id==null){
            $notice_code = 'CAT-'.sprintf('%06d',intval(1));
        }
        else{
            $notice_code = 'CAT-'.sprintf('%06d',intval($id)+1); 
        }
        return $notice_code;
	}
	/* 
		insert new notice record in Database 
	*/
	public function addModel($data){
		/*$sql = "insert into notice (notice_code,notice_name) values(?,?)";
		if($this->db->query($sql,$data)){*/
		if($this->db->insert('notice',$data)){
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
		$sql = "select * from notice where notice_id = ?";
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
		$sql = "update notice set notice_title = ?, notice_date = ?, notice_desc = ?, notice_status = ?, user_id = ?, datetime = ? where notice_id = ?";
		if($this->db->query($sql,array($data['notice_title'],$data['notice_date'],$data['notice_desc'],$data['notice_status'],$data['user_id'],$data['datetime'],$id))){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* 
		this function delete notice from database  
	*/
	public function deleteModel($id){	
		$sql = "delete from notice where notice_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('notice_id',$id);
		if($this->db->delete('notice')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>