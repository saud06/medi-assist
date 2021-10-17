<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Daily_expense_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* 
		return all expense data 
	*/
	public function getDailyExpense(){
		$data = $this->db->get('daily_expense');
		return $data->result();
	}
	/* 
		return filtered daily expense data 
	*/
	public function getFilteredDailyExpense($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('daily_expense')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('daily_expense')
						->where('expense_status', $status)
						->get()
						->result();
		}
	}
	/* 
		insert new expense record in Database 
	*/
	public function addModel($data){
		$sql = "insert into daily_expense (expense_title,expense_date,expense_amount,expense_status,description,user_id,expensed_by,datetime) values(?,?,?,?,?,?,?,?)";		
		
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
		$sql = "select * from daily_expense where daily_expense_id = ?";
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
		$sql = "update daily_expense set expense_title = ?, expense_date = ?, expense_amount =?, expense_status= ?, description= ?,  user_id=?, expensed_by= ?, datetime=? where daily_expense_id = ?";
		if($this->db->query($sql,array($data['expense_title'],$data['expense_date'],$data['expense_amount'],$data['expense_status'],$data['description'],$data['user_id'],$data['expensed_by'],$data['datetime'],$id))){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/* 
		this function delete expense from database  
	*/
	public function deleteModel($id){	
		$sql = "DELETE FROM daily_expense WHERE daily_expense_id = ?";
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