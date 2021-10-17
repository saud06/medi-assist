<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* 
		return all category data 
	*/
	public function getCategory(){
		$data = $this->db->where('category_status', 'active')->get('category');
		return $data->result();
	}
	/* 
		return filtered category data 
	*/
	public function getFilteredCategory($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('category')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('category')
						->where('category_status', $status)
						->get()
						->result();
		}
	}
	/* 
		return max id from category table 
	*/
	public function getMaxId(){
		$id =  $this->db->select_max('category_id')->get('category')->row()->category_id;
		if($id==null){
            $category_code = 'CAT-'.sprintf('%06d',intval(1));
        }
        else{
            $category_code = 'CAT-'.sprintf('%06d',intval($id)+1); 
        }
        return $category_code;
	}
	/* 
		insert new category record in Database 
	*/
	public function addModel($data){
		/*$sql = "insert into category (category_code,category_name) values(?,?)";
		if($this->db->query($sql,$data)){*/
		if($this->db->insert('category',$data)){
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
		$sql = "select * from category where category_id = ?";
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
		$sql = "update category set category_name = ?, category_desc = ?, category_status= ?, user_id=?, datetime=? where category_id = ?";
		if($this->db->query($sql,array($data['category_name'],$data['category_desc'],$data['category_status'],$data['user_id'],$data['datetime'],$id))){
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
		$sql = "delete from category where category_id = ?";
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