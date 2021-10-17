<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class rack_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* return rack details to display list*/
	public function getRack(){
		$this->db->select('w.*,b.shelf_name,b.shelf_location,u.*')
				 ->from('rack w')
				 ->join('shelf b','w.shelf_id = b.shelf_id')
				 ->join('users u','u.id = w.user_id')
				 ->where('w.rack_status', 'active');
		$data = $this->db->get();
		return $data->result();
	}
	public function getFilteredRack($status){
		if(empty($status)){
			$this->db->select('w.*,b.shelf_name,b.shelf_location,u.*')
				 ->from('rack w')
				 ->join('shelf b','w.shelf_id = b.shelf_id')
				 ->join('users u','u.id = w.user_id');
			$data = $this->db->get();
			return $data->result();
		}
		else{
			$this->db->select('w.*,b.shelf_name,b.shelf_location,u.*')
				 ->from('rack w')
				 ->join('shelf b','w.shelf_id = b.shelf_id')
				 ->join('users u','u.id = w.user_id')
				 ->where('w.rack_status', $status);
			$data = $this->db->get();
			return $data->result();
		}
	}
	/* return shelf detalis */
	public function getShelf(){
		$this->db->select('*');
		$query = $this->db->get('shelf');
		return $query->result();
		
	}
	/* add new record in databse */
	public function addModel($data){
		$sql = "insert into rack (rack_name,shelf_id,rack_location,rack_status,user_id,datetime) values(?,?,?,?,?,?)";
		if($this->db->query($sql,$data)){
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* return record to edit record */
	public function getRecord($id){
		$sql = "select * from rack where rack_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('rack_id',$data);
		if($query = $this->db->get('rack')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* save edited record in database */
	public function editModel($data,$id){
		$sql = "update rack set rack_name = ?, shelf_id = ?, rack_location = ?, rack_status=?, user_id = ?, datetime=? where rack_id = ?";
		if($this->db->query($sql,array($data['rack_name'],$data['shelf_id'],$data['rack_location'],$data['rack_status'],$data['user_id'],$data['datetime'],$id))){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* delete record in database */
	public function deleteModel($id){
		$sql = "delete from rack where rack_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('rack_id',$id);
		if($this->db->delete('rack')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>