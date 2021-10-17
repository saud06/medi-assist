<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subcategory_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* 
		return subcategory details to display list 
	*/
	public function getSubcategory(){
		return $this->db->select('s.*,c.category_name')
				 ->from('sub_category s')
				 ->where('s.sub_category_status', 'active')
				 ->join('category c','c.category_id = s.category_id')
				 ->get()
				 ->result();
	}
	/* 
		return filtered subcategory details to display list 
	*/
	public function getFilteredSubcategory($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('sub_category s')
						->join('category c','c.category_id = s.category_id')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('sub_category s')
						->join('category c','c.category_id = s.category_id')
						->where('s.sub_category_status', $status)
						->get()
						->result();
		}
	}
	/* 
		return max Id  
	*/
	public function getMaxId(){
		$id =  $this->db->select_max('sub_category_id')->get('sub_category')->row()->sub_category_id;
		if($id==null){
           $subcategory_code = 'SUBCAT-'.sprintf('%06d',intval(1));
        }
        else{
           $subcategory_code = 'SUBCAT-'.sprintf('%06d',intval($id)+1); 
        }
        return $subcategory_code;
	}
	/* 
		return category details  
	*/
	public function getCategory(){
		$this->db->select('category_id,category_name');
		$query = $this->db->get('category');
		return $query->result();
	}
	/* 
		return category details  
	*/
	public function getCategory1(){
		return $this->db->get('category')->result();
	}
	/* 
		add new record in databse 
	*/
	public function addModel($data){
		$sql = "insert into sub_category (category_id,sub_category_code,sub_category_name, sub_category_desc, sub_category_status, user_id, datetime) values(?,?,?,?,?,?,?)";
		if($this->db->query($sql,$data)){
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return record to edit 
	*/
	public function getRecord($id){
		$sql = "select s.*,c.category_name from sub_category s inner join category c on s.category_id = c.category_id where sub_category_id = ?";
		if($query = $this->db->query($sql,array($id))){
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
		$sql = "update sub_category set category_id = ?,sub_category_name = ?, sub_category_desc = ?, sub_category_status= ?, user_id=?, datetime=? where sub_category_id = ?";
		if($this->db->query($sql,array($data['category_id'],$data['sub_category_name'],$data['sub_category_desc'],$data['sub_category_status'],$data['user_id'],$data['datetime'],$id))){
		/*$this->db->where('sub_category_id',$id);
		if($this->db->update('sub_category',$data)){*/
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
		$sql = "delete from sub_category where sub_category_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('sub_category_id',$id);
		if($this->db->delete('sub_category')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>