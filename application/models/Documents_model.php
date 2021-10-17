<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Documents_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* 
		return all document data 
	*/
	public function getDocument(){
		$data = $this->db->where('document_status', 'active')->get('document');
		return $data->result();
	}
	/* 
		return filtered document data 
	*/
	public function getFilteredDocument($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('document')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('document')
						->where('document_status', $status)
						->get()
						->result();
		}
	}
	/* 
		return max id from document table 
	*/
	public function getMaxId(){
		$id =  $this->db->select_max('document_id')->get('document')->row()->document_id;
		if($id==null){
            $document_code = 'CAT-'.sprintf('%06d',intval(1));
        }
        else{
            $document_code = 'CAT-'.sprintf('%06d',intval($id)+1); 
        }
        return $document_code;
	}
	/* 
		insert new document record in Database 
	*/
	public function addModel($data){
		/*$sql = "insert into document (document_code,document_name) values(?,?)";
		if($this->db->query($sql,$data)){*/
		if($this->db->insert('document',$data)){
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
		$sql = "select * from document where document_id = ?";
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
		$sql = "UPDATE document SET document_name = ?, document_status = ?, user_id = ?, datetime = ? where document_id = ?";
		if($this->db->query($sql,array($data['document_name'],$data['document_status'],$data['user_id'],$data['datetime'],$id))){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* 
		this function delete document from database  
	*/
	public function deleteModel($id){	
		$sql = "DELETE FROM document WHERE document_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('document_id',$id);
		if($this->db->delete('document')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>