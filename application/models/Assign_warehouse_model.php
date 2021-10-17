<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Assign_warehouse_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function getAssignWarehouse(){
		return $this->db->select('w.warehouse_name,m.id,u.first_name,u.last_name')
                   ->from('warehouse w')
                   ->join('warehouse_management m','m.warehouse_id = w.warehouse_id')
                   ->join('users u','u.id = m.user_id')
                   ->get()
                   ->result();
	}
	/* 
		return all data users table 
	*/
	public function getUser(){
		$where = "g.name = 'purchaser' OR g.name = 'sales_person'";
		$this->db->select('u.first_name,u.last_name,u.id')
				 ->from('users u')
				 ->join('users_groups ug','u.id = ug.user_id')
				 ->join('groups g','g.id = ug.group_id')
				 ->where($where); 
		return $this->db->get()->result();
	}
	/* 
		return all warehouse data  
	*/
	public function getWarehouse($id){
	$data = $this->db->query('
	                            SELECT * 
	                            FROM warehouse
	                            WHERE warehouse_id NOT IN
	                                                  (
	                                                    SELECT warehouse_id 
	                                                    FROM warehouse_management
	                                                    WHERE user_id = ?
	                                                  ) 
                            ',
                            	array($id)
                            )->result();
        return $data;
	}
	/* 
		insert record in warehouse_management table 
	*/
	public function assignWarehouse($data){
		$sql = "insert into warehouse_management (user_id,warehouse_id) values(?,?)";
		if($this->db->query($sql,$data)){
		/*if($this->db->insert('warehouse_management',$data)){*/
			return  $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	public function deleteModel($id){
		/*$sql = "delete from warehouse_management where id = ?";
		if($this->db->query($sql,array($id))){*/
		$this->db->where('id',$id);
		if($this->db->delete('warehouse_management')){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>