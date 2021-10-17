<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_model extends CI_Model
{
	public function getPayment(){
		return $this->db->get_where('payment',array("status"=>null))->result();
	} 
	public function getFilteredPayment($start_date, $end_date){
		$this->db->select('*')
				 ->from('payment')
				 ->where('status', null)
				 ->where('date >=', $start_date)
				 ->where('date <=', $end_date);

		$data = $this->db->get();
		log_message('debug', print_r($data, true));
		return $data->result();
	}
	public function getDetails($id){
		return $this->db->get_where('payment',array("id"=>$id))->result();
	}
	public function editPayment($id,$data){
		$this->db->where('id',$id);
		if($this->db->update('payment',$data)){
			return true;
		}
		else{
			return false;
		}
	}
	public function delete($id){

		$this->db->where('id',$id);
		$sales_id = $this->db->get('payment')->row()->sales_id;
		$this->db->where('id',$id);
		if($this->db->update('payment',array('status'=>1))){
			$this->db->where('sales_id',$sales_id);
			if($this->db->update('invoice',array('paid_amount'=>0.00))){
				return true;
			}
		}
		else{
			return false;
		}
	}
}