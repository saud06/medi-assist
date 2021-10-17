<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Warehouse_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* return warehouse details to display list*/
	public function getWarehouse(){
		//$data = $this->db->query('select w.warehouse_name,b.branch_name,w.user_id from warehouse w ,branch b where w.branch_id = b.branch_id ');
		$this->db->select('w.warehouse_id,w.warehouse_name,b.branch_name,u.*')
				 ->from('warehouse w')
				 ->join('branch b ','w.branch_id = b.branch_id')
				 ->join('users u','u.id = w.user_id');
		$data = $this->db->get();
		return $data->result();
	}
	/* return branch detalis */
	public function getBranch(){
		$this->db->select('*');
		$query = $this->db->get('branch');
		return $query->result();
		
	}
	/* add new record in databse */
	public function addModel($data){
		$sql = "insert into warehouse (warehouse_name,branch_id,user_id) values(?,?,?)";
		if($this->db->query($sql,$data)){
		/*if($this->db->insert('warehouse',$data)){*/
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* return record to edit record */
	public function getRecord($id){
		$sql = "select * from warehouse where warehouse_id = ?";
		if($query = $this->db->query($sql,array($id))){
		/*$this->db->where('warehouse_id',$data);
		if($query = $this->db->get('warehouse')){*/
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	/* save edited record in database */
	public function editModel($data,$id){
		$sql = "update warehouse set branch_id = ?,warehouse_name = ?,user_id = ? where warehouse_id = ?";
		if($this->db->query($sql,array($data['branch_id'],$data['warehouse_name'],$data['user_id'],$id))){
		/*$this->db->where('warehouse_id',$id);
		if($this->db->update('warehouse',$data)){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* delete record in database */
	public function deleteModel($id){
		$sql = "delete from warehouse where warehouse_id = ?";
		if($this->db->query($sql,array($id))){
		/*$this->db->where('warehouse_id',$id);
		if($this->db->delete('warehouse')){*/
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>