<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email_model extends CI_Model
{
	public function getEmailSetup(){
		return $this->db->get('email_setup')->result();
	}
	public function getEmailSent(){
		return array('sample_draft_query' => $this->db->where('type', 'send')->get('sample_draft')->result(), 'quotation_query' => $this->db->where('type', 'send')->get('quotation')->result(), 'indent_query' => $this->db->where('type', 'send')->get('indent')->result(), 'inquiry_query' => $this->db->where('type', 'send')->get('inquiry')->result());
	}
	public function getEmailSaved(){
		return array('sample_draft_query' => $this->db->where('type', 'save')->get('sample_draft')->result(), 'quotation_query' => $this->db->where('type', 'save')->get('quotation')->result(), 'indent_query' => $this->db->where('type', 'save')->get('indent')->result(), 'inquiry_query' => $this->db->where('type', 'save')->get('inquiry')->result());
	}
	public function getEmailStatus(){
		return $this->db->get('email_status')->result();
	}
	public function getFilteredEmail($email_id, $email_address){
		if(empty($email_id) && !empty($email_address)){
			return array('sample_draft_query' => $this->db->where('type', 'save')->where('customer_name', $email_address)->get('sample_draft')->result(), 'quotation_query' => $this->db->where('type', 'save')->where('customer_name', $email_address)->get('quotation')->result(), 'indent_query' => $this->db->where('type', 'save')->where('customer_name', $email_address)->get('indent')->result(), 'inquiry_query' => $this->db->where('type', 'save')->where('customer_name', $email_address)->get('inquiry')->result());
		}
		elseif(!empty($email_id) && empty($email_address)){
			return array('sample_draft_query' => $this->db->where('type', 'save')->where('ref_no', $email_id)->get('sample_draft')->result(), 'quotation_query' => $this->db->where('type', 'save')->where('ref_no', $email_id)->get('quotation')->result(), 'indent_query' => $this->db->where('type', 'save')->where('ref_no', $email_id)->get('indent')->result(), 'inquiry_query' => $this->db->where('type', 'save')->where('ref_no', $email_id)->get('inquiry')->result());
		}
		else{
			return array('sample_draft_query' => $this->db->where('type', 'save')->where('ref_no', $email_id)->where('customer_name', $email_address)->get('sample_draft')->result(), 'quotation_query' => $this->db->where('type', 'save')->where('ref_no', $email_id)->where('customer_name', $email_address)->get('quotation')->result(), 'indent_query' => $this->db->where('type', 'save')->where('ref_no', $email_id)->where('customer_name', $email_address)->get('indent')->result(), 'inquiry_query' => $this->db->where('type', 'save')->where('ref_no', $email_id)->where('customer_name', $email_address)->get('inquiry')->result());
		}
	}
	public function getBillChallan(){
		$this->db->select('s.*,c.client_id,c.company_name,i.*')
		         ->from('sales s')
		         ->join('client c','s.client_id = c.client_id')
		         ->join('invoice i ','s.sales_id = i.sales_id');
		return $this->db->get()->result();
	}
	public function getSalesDetails($id){
		return  $this->db->select('s.*,i.invoice_no,i.invoice_date,i.paid_amount,c.company_name,c.house_no,c.road_no,c.country_id,c.state_id,c.city_id,c.zip_code,c.company_phone,c.email,u.first_name,u.last_name')
						 ->from('sales s')
						 ->join('invoice i','s.sales_id = i.sales_id')
						 ->join('client c','s.client_id = c.client_id')
						 ->join('users u','s.user_id = u.id')
						 ->where('s.sales_id',$id)
						 ->get()
						 ->result();
	}
	public function salesItemsView($id){
		return $this->db->select('si.*, pr.name as product_name')
		->from('sales_items si')
		->join('products pr','si.product_id = pr.product_id')
		->where('si.sales_id',$id)
		->get()
		->result();
	}
	public function getRecord($type, $id){
		$this->db->select('*')
		->from($type)
		->where('id', $id);
		$query = $this->db->get();
		if($query){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	public function getPrevRecord($type, $id){
		$this->db->select('*')
		->from($type)
		->where('id',$id);
		$query = $this->db->get();
		if($query){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	public function getNxtRecord($type, $id){
		$this->db->select('*')
		->from($type)
		->where('id',$id);
		$query = $this->db->get();
		if($query){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	public function add($data){
		$d = $this->db->get('email_setup')->result();
		if($d != null){
			return $this->db->update('email_setup',$data);
		}
		else{
			return $this->db->insert('email_setup',$data);	
		}
	}
	public function addModel($data, $mail_type, $type){
		$data['type'] = $type;
		
		if($mail_type == 'raw'){
		    return true;
		}
		
		if($this->db->insert($mail_type, $data)){
			return true;
		}
		else{
			return false;
		}
	}
	public function getRemittanceHistory(){
		return $this->db->get('remittance_history')->result();
	}
	public function getRemittanceHistory2($remittance_history_id){
		return $this->db->where('remittance_history_id', $remittance_history_id)->get('remittance_history')->result();
	}
	public function getRemittanceHistoryItem($remittance_history_id){
		$this->db->select('*')
				 ->from('remittance_history_item')
				 ->where('remittance_history_id', $remittance_history_id);
		if($query = $this->db->get()){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
	public function getCustomerData(){
		return $this->db->where('client_type_id', 1)
						->get('client')
						->result();
	}
	public function getManufacturerData(){
		return $this->db->where('client_type_id', 2)
						->or_where('client_type_id', 3)
						->or_where('client_type_id', 4)
						->get('client')
						->result();
	}
	public function addRemittanceHistory($data){
		if($this->db->insert('remittance_history',$data)){
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
		else{
			return false;
		}
	}
	public function addRemittanceHistoryItem($data){
		if($this->db->insert('remittance_history_item', $data)){
			return true;
		}
		else{
			return false;
		}
	}
	public function editRemittancehistory($data){
		$id = $data['remittance_history_id'];
		$this->db->where('remittance_history_id', $id);
		if($this->db->update('remittance_history',$data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	public function deleteRemittanceHistory($id){	
		$sql = "delete from remittance_history where remittance_history_id = ?";
		if($this->db->query($sql,array($id))){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	public function getFilteredRemittanceHistory($start_date, $end_date){
		$this->db->select('*')
				 ->from('remittance_history')
				 ->where('email_date >=', $start_date)
				 ->where('email_date <=', $end_date);
		$data = $this->db->get();
		log_message('debug', print_r($data, true));
		return $data->result();
	}
	public function createReferenceNo(){
		$query = $this->db->query("SELECT * FROM email_status ORDER BY email_status_id DESC LIMIT 1");
		$result = $query->result();
		return $result;
	}
	public function createSampleDraftNo(){
		$query = $this->db->query("SELECT * FROM sample_draft ORDER BY id DESC LIMIT 1");
		$result = $query->result();
		return $result;
	}
	public function createQuotationNo(){
		$query = $this->db->query("SELECT * FROM quotation ORDER BY id DESC LIMIT 1");
		$result = $query->result();
		return $result;
	}
	public function createProformaInvoiceNo(){
		$query = $this->db->query("SELECT * FROM indent ORDER BY id DESC LIMIT 1");
		$result = $query->result();
		return $result;
	}
	public function createInquiryNo(){
		$query = $this->db->query("SELECT * FROM inquiry ORDER BY id DESC LIMIT 1");
		$result = $query->result();
		return $result;
	}
	public function addMailStatus($email_status, $mail_type){
		$ref_no = $email_status['ref_no'];

		if($mail_type == 'sample_draft'){
			$email_status['sample_draft_status'] = 'YES';
		}
		if($mail_type == 'quotation'){
			$email_status['price_quotation_status'] = 'YES';
		}
		if($mail_type == 'inquiry'){
			$email_status['inquiry_status'] = 'YES';
		}
		if($mail_type == 'indent'){
			$email_status['indent_status'] = 'YES';
		}
			
		$result = $this->db->get_where('email_status', array('ref_no' => $ref_no));
		if($result->num_rows() > 0){
			if($mail_type == 'sample_draft'){
				$sql = "UPDATE email_status SET sample_draft_status = 'YES' where ref_no = '$ref_no'";
			}
			elseif($mail_type == 'quotation'){
				$sql = "UPDATE email_status SET price_quotation_status = 'YES' where ref_no = '$ref_no'";
			}
			elseif($mail_type == 'inquiry'){
				$sql = "UPDATE email_status SET inquiry_status = 'YES' where ref_no = '$ref_no'";
			}
			elseif($mail_type == 'indent'){
				$sql = "UPDATE email_status SET indent_status = 'YES' where ref_no = '$ref_no'";
			}

			if($mail_type == 'raw'){
			    return TRUE;
			}
			
			else{
    			if($this->db->query($sql,array($email_status['sample_draft_status'], $ref_no))){
    				return TRUE;
    			}
    			else{
    				return FALSE;
    			}
			}
		}
		else{
		    if($mail_type == 'raw'){
		        return TRUE;
		    }
		    
		    else{
    			if($this->db->insert('email_status', $email_status)){
    				return TRUE;
    			}
    			else{
    				return FALSE;
    			}
		    }
		}
	}
	public function editMailRemark($id, $remarks){
		$this->db->where('email_status_id',$id);
		if($this->db->update('email_status', $remarks)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	public function editMailStatus($id, $value){
		$this->db->where('email_status_id',$id);
		if($this->db->update('email_status', $value)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	public function deleteModel($type, $id){
		$sql = "DELETE FROM `$type` WHERE id = ?";
		if($this->db->query($sql,array($id))){
				return TRUE;
			}
		else{
			return FALSE;
		}
	}
	public function deleteMul($type, $selected_id){
		if (count($selected_id) > 0 ){
			if($type == ''){
				$selected_id_sd = [];
				$selected_id_qt = [];
				$selected_id_it = [];
				$selected_id_iq = [];
				
				foreach ($selected_id as $key => $value) {
					if(substr($value, 0, 2) == 'sd'){
						array_push($selected_id_sd, (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT));
					}
					elseif(substr($value, 0, 2) == 'qt'){
						array_push($selected_id_qt, (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT));
					}
					elseif(substr($value, 0, 2) == 'it'){
						array_push($selected_id_it, (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT));
					}
					elseif(substr($value, 0, 2) == 'iq'){
						array_push($selected_id_iq, (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT));
					}
				}

				if(count($selected_id_sd > 0)){
					$all_sd = implode(",", $selected_id_sd);

					$sample_draft_sql = "DELETE FROM sample_draft WHERE 1 AND id IN($all_sd)";
					$this->db->query($sample_draft_sql,array($all_sd));
				}
				if(count($selected_id_qt > 0)){
					$all_qt = implode(",", $selected_id_qt);

					$quotation_sql = "DELETE FROM quotation WHERE 1 AND id IN($all_qt)";
					$this->db->query($quotation_sql,array($all_qt));
				}
				if(count($selected_id_it > 0)){
					$all_it = implode(",", $selected_id_it);

					$indent_sql = "DELETE FROM indent WHERE 1 AND id IN($all_it)";
					$this->db->query($indent_sql,array($all_it));
				}
				if(count($selected_id_iq > 0)){
					$all_iq = implode(",", $selected_id_iq);

					$inquiry_sql = "DELETE FROM inquiry WHERE 1 AND id IN($all_iq)";
					$this->db->query($inquiry_sql,array($all_iq));
				}

				return TRUE;
			}

			else{
				$all = implode(",", $selected_id);
				$sql = "DELETE FROM `$type` WHERE 1 AND id IN($all)";
				if($this->db->query($sql,array($all))){
					return TRUE;
				}
				else {
					return FALSE;
				}
			}
		}
	}
	public function emailsView($type, $ref_no){
		return $this->db->select('*')
		->from($type)
		->where('ref_no', $ref_no)
		->get()
		->result();
	}

	/* 
		Compose
	*/
	/* 
		return client detail use dynamic table
	*/
	public function getClient(){
		return $this->db->select('*')
		->from('client')
		->where('client_type_id',1)
		->get()
		->result();
	}
	/* 
		return manufacturer detail use dynamic table
	*/
	public function getManufacturer(){
		return $this->db->select('*')
		->from('client')
		->where('client_type_id',2)
		->get()
		->result();
	}
	/* 
		return supplier detail use dynamic table
	*/
	public function getSupplier(){
		return $this->db->select('*')
		->from('client')
		->where('client_type_id',3)
		->get()
		->result();
	}
	/* 
		return manufacturer and supplier detail use dynamic table
	*/
	public function getManufacturerAndSupplier(){
		return $this->db->select('*')
		->from('client')
		->where('client_type_id',4)
		->get()
		->result();
	}
	/*
		return state name
	*/
	public function getState($id){
		return $this->db->select('name')
             	->from('states')
             	->where('id',$id)
             	->get()
             	->result();
	}
	/*
		return city name
	*/
	public function getCity($id){
		return $this->db->select('name')
             	->from('cities')
             	->where('id',$id)
             	->get()
             	->result();
	}
	/*
		return country name
	*/
	public function getCountry($id){
		return $this->db->select('name')
             	->from('countries')
             	->where('id',$id)
             	->get()
             	->result();
	}
	/*
		return kind attention
	*/
	public function getKindAttention($id){
		return $this->db->select('name, designation')
             	->from('kind_attention')
             	->where('client_id',$id)
             	->get()
             	->result();
	}
	/*
		return products
	*/
	public function getProduct(){
		return $this->db->select('*')
                 ->from('products')
                 ->get()
                 ->result();
	}
	/*
		return selected product
	*/
	public function getProduct2($product_id){
		return $this->db->select('*')
                 ->from('products')
                 ->where('product_id', $product_id)
                 ->get()
                 ->result();
	}
	/*
		return products details
	*/
	public function getProductList($id){
		return $this->db->select('client_id, name')
                 ->from('products')
                 ->like('client_id', $id)
                 ->get()
                 ->result();
	}
	/*
		return products details
	*/
	public function getProductList2($client1, $client2){
		return $this->db->select('*')
                 ->from('products')
                 ->like('client_id', $client1)
                 ->like('client_id', $client2)
                 ->get()
                 ->result();
	}
	/*
		return products category
	*/
	public function getProductCategory($id){
		return $this->db->select('c.*')
			->from('category c')
			->join('products p', 'c.category_id = p.category_id')
			->where('p.product_id', $id)->get()->result();
	}
	/* 
		return shipping mode details
	*/
	public function getShippingMode(){
		return $this->db->select('*')
		->from('shipping_mode_ec')
		->get()
		->result();
	}
	/* 
		return payment mode details
	*/
	public function getPaymentMode(){
		return $this->db->select('*')
		->from('payment_ec')
		->get()
		->result();
	}
	/* 
		return currency details
	*/
	public function getCurrency(){
		return $this->db->select('*')
		->from('currency')
		->get()
		->result();
	}
	/* 
		return unit details
	*/
	public function getUnit(){
		return $this->db->select('*')
		->from('unit')
		->get()
		->result();
	}
	/*
		return client2 details
	*/
	public function getClient2($id){
		$client_id = explode('%7C', $id);

		return $this->db->select('company_name')
        ->from('client')
        ->where('client_type_id',1)
        ->where_in('client_id', $client_id)
        ->get()
        ->result();
	}
	/*
		return client3 details
	*/
	public function getClient3($client_id){
		return $this->db->select('*')
        ->from('client')
        ->where('client_id', $client_id)
        ->get()
        ->result();
	}
	/* 
		return commission details
	*/
	public function getCommission(){
		return $this->db->select('*')
		->from('commission_ec')
		->get()
		->result();
	}
	/* 
		return consignee details
	*/
	public function getConsignee(){
		return $this->db->select('*')
		->from('consignee_ec')
		->get()
		->result();
	}
	/* 
		return country of goods details
	*/
	public function getCountryOfGoods(){
		return $this->db->select('*')
		->from('countries')
		->get()
		->result();
	}
	/* 
		return port of loading details
	*/
	public function getPortOfLoading(){
		return $this->db->select('*')
		->from('port_ec')
		->get()
		->result();
	}
	/* 
		return port of discharge details
	*/
	public function getPortOfDischarge(){
		return $this->db->select('*')
		->from('port_of_discharge_ec')
		->get()
		->result();
	}
	/* 
		return banker details
	*/
	public function getBanker(){
		return $this->db->select('*')
		->from('bankers_ec')
		->get()
		->result();
	}
	

	/* 
		Configuration
	*/
	public function getshipping_mode_list(){
		$data = $this->db->where('shipping_mode_ec_status', 'active')->get('shipping_mode_ec');
		return $data->result();
	}

	public function getFilteredShippingMode($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('shipping_mode_ec')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('shipping_mode_ec')
						->where('shipping_mode_ec_status', $status)
						->get()
						->result();
		}
	}

	public function getCommission_list(){
		$data = $this->db->where('commission_ec_status', 'active')->get('commission_ec');
		return $data->result();
	}

	public function getFilteredCommission($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('commission_ec')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('commission_ec')
						->where('commission_ec_status', $status)
						->get()
						->result();
		}
	}

	public function getPort_list(){
		$data = $this->db->where('port_ec_status', 'active')->get('port_ec');
		return $data->result();
	}

	public function getFilteredPortOfLoading($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('port_ec')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('port_ec')
						->where('port_ec_status', $status)
						->get()
						->result();
		}
	}

	public function getPayment_list(){
		$data = $this->db->where('payment_ec_status', 'active')->get('payment_ec');
		return $data->result();
	}

	public function getFilteredPayment($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('payment_ec')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('payment_ec')
						->where('payment_ec_status', $status)
						->get()
						->result();
		}
	}

	public function getBankers_list(){
		$data = $this->db->where('bankers_ec_status', 'active')->get('bankers_ec');
		return $data->result();
	}

	public function getFilteredBanker($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('bankers_ec')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('bankers_ec')
						->where('bankers_ec_status', $status)
						->get()
						->result();
		}
	}

	public function getPort_of_discharge_list(){
		$data = $this->db->where('port_of_discharge_ec_status', 'active')->get('port_of_discharge_ec');
		return $data->result();
	}

	public function getFilteredPortOfDischarge($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('port_of_discharge_ec')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('port_of_discharge_ec')
						->where('port_of_discharge_ec_status', $status)
						->get()
						->result();
		}
	}

	public function getConsignee_list(){
		$data = $this->db->where('consignee_ec_status', 'active')->get('consignee_ec');
		return $data->result();
	}

	public function getFilteredConsignee($status){
		if(empty($status)){
			return $this->db->select('*')
						->from('consignee_ec')
						->get()
						->result();
		}
		else{
			return $this->db->select('*')
						->from('consignee_ec')
						->where('consignee_ec_status', $status)
						->get()
						->result();
		}
	}

	public function addShippingMode($data){
		$sql = "insert into shipping_mode_ec (shipping_mode_ec_name,shipping_mode_ec_details,shipping_mode_ec_status, user_id,datetime) values(?,?,?,?,?)";
		if($this->db->query($sql,$data)){
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
		$sql = "insert into bankers_ec (bankers_ec_name, bankers_ec_details, bankers_ec_address, bankers_ec_status, user_id, datetime) values(?,?,?,?,?,?)";
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