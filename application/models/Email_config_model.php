<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email_config_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	} 
	/* 
		return all shipping_mode_ec data  
	*/
		public function getshipping_mode_list(){
			$data = $this->db->get('shipping_mode_ec');
			return $data->result();
		}

		public function getCommission_list(){
			$data = $this->db->get('commission_ec');
			return $data->result();
		}

		public function getPort_list(){
			$data = $this->db->get('port_ec');
			return $data->result();
		}

		public function getPayment_list(){
			$data = $this->db->get('payment_ec');
			return $data->result();
		}

		public function getBankers_list(){
			$data = $this->db->get('bankers_ec');
			return $data->result();
		}

		public function getPort_of_discharge_list(){
			$data = $this->db->get('port_of_discharge_ec');
			return $data->result();
		}

		public function getConsignee_list(){
			$data = $this->db->get('consignee_ec');
			return $data->result();
		}
	/* 
		add new shipping_mode_ec record in database 
	*/
		public function addShippingMode($data){
			$sql = "insert into shipping_mode_ec (shipping_mode_ec_name,shipping_mode_ec_details,shipping_mode_ec_status, user_id,datetime) values(?,?,?,?,?)";
			if($this->db->query($sql,$data)){
				/*if($this->db->insert('shipping_mode_ec',$data)){*/
					return  $this->db->insert_id();
				}
				else{
					return FALSE;
				}
			}

			public function addCommission($data){
				$sql = "insert into commission_ec (commission_ec_name,commission_ec_value, commission_ec_details, commission_ec_status, user_id,datetime) values(?,?,?,?,?,?)";
				if($this->db->query($sql,$data)){
					return  $this->db->insert_id();
				}
				else{
					return FALSE;
				}
			}

			public function addPort($data){
				$sql = "insert into port_ec (port_ec_name, port_ec_details, port_ec_location, port_ec_status, user_id,datetime) values(?,?,?,?,?,?)";
				if($this->db->query($sql,$data)){
					return  $this->db->insert_id();
				}
				else{
					return FALSE;
				}
			}

			public function addPayment($data){
				$sql = "insert into payment_ec (payment_ec_name, payment_ec_details, payment_ec_status, user_id,datetime) values(?,?,?,?,?)";
				if($this->db->query($sql,$data)){
					return  $this->db->insert_id();
				}
				else{
					return FALSE;
				}
			}

			public function addBankers($data){
				$sql = "insert into bankers_ec (bankers_ec_name, bankers_ec_details, bankers_ec_address, bankers_ec_status, user_id,datetime) values(?,?,?,?,?,?)";
				if($this->db->query($sql,$data)){
					return  $this->db->insert_id();
				}
				else{
					return FALSE;
				}
			}

			public function addPortOfDischarge($data){
				$sql = "insert into port_of_discharge_ec (port_of_discharge_ec_name, port_of_discharge_ec_details, port_of_discharge_ec_location, port_of_discharge_ec_status, user_id,datetime) values(?,?,?,?,?,?)";
				if($this->db->query($sql,$data)){
					return  $this->db->insert_id();
				}
				else{
					return FALSE;
				}
			}

			public function addConsignee_($data){
				$sql = "insert into consignee_ec (consignee_ec_name, consignee_ec_details, consignee_ec_address, consignee_ec_status, user_id,datetime) values(?,?,?,?,?,?)";
				if($this->db->query($sql,$data)){
					return  $this->db->insert_id();
				}
				else{
					return FALSE;
				}
			}
	/* 
		return shipping_mode_ec record specified id 
	*/
		public function getShippingModeRecord($id){
			$sql = "select * from shipping_mode_ec where shipping_mode_ec_id = ?";
			if($query = $this->db->query($sql,array($id))){
				return $query->result();
			}
			else{
				return FALSE;
			}
		}

		public function getCommissionRecord($id){
			$sql = "select * from commission_ec where commission_ec_id = ?";
			if($query = $this->db->query($sql,array($id))){
				return $query->result();
			}
			else{
				return FALSE;
			}
		}

		public function getPortRecord($id){
			$sql = "select * from port_ec where port_ec_id = ?";
			if($query = $this->db->query($sql,array($id))){
				return $query->result();
			}
			else{
				return FALSE;
			}
		}

		public function getPaymentRecord($id){
			$sql = "select * from payment_ec where payment_ec_id = ?";
			if($query = $this->db->query($sql,array($id))){
				return $query->result();
			}
			else{
				return FALSE;
			}
		}

		public function getBankersRecord($id){
			$sql = "select * from bankers_ec where bankers_ec_id = ?";
			if($query = $this->db->query($sql,array($id))){
				return $query->result();
			}
			else{
				return FALSE;
			}
		}

		public function getPortOfDischargeRecord($id){
			$sql = "select * from port_of_discharge_ec where port_of_discharge_ec_id = ?";
			if($query = $this->db->query($sql,array($id))){
				return $query->result();
			}
			else{
				return FALSE;
			}
		}

		public function getConsigneeRecord($id){
			$sql = "select * from consignee_ec where consignee_ec_id = ?";
			if($query = $this->db->query($sql,array($id))){
				return $query->result();
			}
			else{
				return FALSE;
			}
		}
	/* 
		edit shipping_mode_ec specified id 
	*/
		public function editShippingMode($data,$id){
			$sql = "update shipping_mode_ec set shipping_mode_ec_name = ?,shipping_mode_ec_details = ?,shipping_mode_ec_status = ?, user_id=?, datetime=? where shipping_mode_ec_id = ?";
			if($this->db->query($sql,array($data['shipping_mode_ec_name'],$data['shipping_mode_ec_details'],$data['shipping_mode_ec_status'],$data['user_id'],$data['datetime'],$id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}

		public function editCommission($data,$id){
			$sql = "update commission_ec set commission_ec_name = ?, commission_ec_value = ?, commission_ec_details = ?,commission_ec_status = ?, user_id=?, datetime=? where commission_ec_id = ?";
			if($this->db->query($sql,array($data['commission_ec_name'],$data['commission_ec_value'],$data['commission_ec_details'],$data['commission_ec_status'],$data['user_id'],$data['datetime'],$id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}

		public function editPort($data,$id){
			$sql = "update port_ec set port_ec_name = ?,  port_ec_details = ?,port_ec_location = ?, port_ec_status = ?, user_id=?, datetime=? where port_ec_id = ?";
			if($this->db->query($sql,array($data['port_ec_name'],$data['port_ec_details'],$data['port_ec_location'],$data['port_ec_status'],$data['user_id'],$data['datetime'],$id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}

		public function editPayment($data,$id){
			$sql = "update payment_ec set payment_ec_name = ?,  payment_ec_details = ?, payment_ec_status = ?, user_id=?, datetime=? where payment_ec_id = ?";
			if($this->db->query($sql,array($data['payment_ec_name'],$data['payment_ec_details'],$data['payment_ec_status'],$data['user_id'],$data['datetime'],$id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}

		public function editBankers($data,$id){
			$sql = "update bankers_ec set bankers_ec_name = ?,  bankers_ec_details = ?, bankers_ec_address =?, bankers_ec_status = ?, user_id=?, datetime=? where bankers_ec_id = ?";
			if($this->db->query($sql,array($data['bankers_ec_name'],$data['bankers_ec_details'],$data['bankers_ec_address'],$data['bankers_ec_status'],$data['user_id'],$data['datetime'],$id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}

		public function editPortOfDischarge($data,$id){
			$sql = "update port_of_discharge_ec set port_of_discharge_ec_name = ?,  port_of_discharge_ec_details = ?,port_of_discharge_ec_location = ?, port_of_discharge_ec_status = ?, user_id=?, datetime=? where port_of_discharge_ec_id = ?";
			if($this->db->query($sql,array($data['port_of_discharge_ec_name'],$data['port_of_discharge_ec_details'],$data['port_of_discharge_ec_location'],$data['port_of_discharge_ec_status'],$data['user_id'],$data['datetime'],$id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}

		public function editConsignee($data,$id){
			$sql = "update consignee_ec set consignee_ec_name = ?,  consignee_ec_details = ?, consignee_ec_address=?, consignee_ec_status = ?, user_id=?, datetime=? where consignee_ec_id = ?";
			if($this->db->query($sql,array($data['consignee_ec_name'],$data['consignee_ec_details'],$data['consignee_ec_address'] , $data['consignee_ec_status'],$data['user_id'],$data['datetime'],$id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
	/*
		delete shipping_mode_ec specified id 
	*/
		public function deleteShippingMode($id){
			$sql = "delete from shipping_mode_ec where shipping_mode_ec_id = ?";
			if($this->db->query($sql,array($id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}

		public function deleteCommission($id){
			$sql = "delete from commission_ec where commission_ec_id = ?";
			if($this->db->query($sql,array($id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}

		public function deletePort($id){
			$sql = "delete from port_ec where port_ec_id = ?";
			if($this->db->query($sql,array($id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}

		public function deleteBankers($id){
			$sql = "delete from bankers_ec where bankers_ec_id = ?";
			if($this->db->query($sql,array($id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}

		public function deletePayment($id){
			$sql = "delete from payment_ec where payment_ec_id = ?";
			if($this->db->query($sql,array($id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}

		public function deletePortOfDischarge($id){
			$sql = "delete from port_of_discharge_ec where port_of_discharge_ec_id = ?";
			if($this->db->query($sql,array($id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}

		public function deleteConsignee($id){
			$sql = "delete from consignee_ec where consignee_ec_id = ?";
			if($this->db->query($sql,array($id))){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
	}

	?>