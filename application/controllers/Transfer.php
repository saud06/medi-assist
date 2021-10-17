<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transfer extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('transfer_model');
		$this->load->model('log_model');
	}
	/*
		get all record transfer and load list view
	*/
	public function index(){
		$data['data'] = $this->transfer_model->get();
		$this->load->view('transfer/list',$data);
	}
	/*
		load add view of trnasfer module
	*/
	public function add(){
		$data['warehouse'] = $this->transfer_model->getWarehouse();
		$this->load->view('transfer/add',$data);
	}
	/* get all product warehouse wise */
	public function getProducts($warehouse_id){
		$data = $this->transfer_model->getProducts($warehouse_id);
	    echo json_encode($data);
	}
	/* get single product */
	public function getProduct($product_id,$warehouse_id){
		$data = $this->transfer_model->getProduct($product_id,$warehouse_id);
	    echo json_encode($data);
	}
	/* 
		This function is used to search product code / name in database 
	*/
	public function getAutoCodeName($code,$search_option,$warehouse){
        //$code = strtolower($code);
        $data = $this->transfer_model->getProductCodeName($code,$search_option,$warehouse);
      	if($data != Null){
	        if($search_option=="Code"){
	          	$list = "<ul class='auto-product'>";
	          	foreach ($data as $val){
	          		$list .= "<li value=".$val->code.">".$val->code."</li>";
	          	}
	          	$list .= "</ul>";
	        }
	        else{
	          	$list = "<ul class='auto-product'>";
	          	foreach ($data as $val){
	          		$list .= "<li value=".$val->product_id.">".$val->name."</li>";
	          	}
	          	$list .= "</ul>";
	        }
      	  }
      	  else{
      	  	$list = "<ul class='auto-product'>";
      	  	$list .= "<li>No results found</li>";
      	  	$list .= "</ul>";
      	  }
      	  echo $list;
          //echo json_encode($data);
          //print_r($list);
	}
	/* 
		this fucntion is used to add transfer record in database 
	*/
	public function addTransfer(){
		$this->form_validation->set_rules('date','Date','trim|required');
		$this->form_validation->set_rules('to_warehouse','To Warehouse','trim|required');
		$this->form_validation->set_rules('from_warehouse','From Warehouse','trim|required');
		if($this->form_validation->run()==false){

			$this->add();
		}
		else
		{
			$from_warehouse = $this->input->post('from_warehouse');
			$to_warehouse = $this->input->post('to_warehouse');
			$data = array(
						"date" 			=>  $this->input->post('date'),
						"to_warehouse" 	=>  $to_warehouse,
						"from_warehouse"=>  $from_warehouse,
						"total" 		=>  $this->input->post('grand_total'),
						"note" 			=>  $this->input->post('note'),
						"user"			=>  $this->session->userdata('user_id')
					);

			if($id = $this->transfer_model->add($data)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Transfer Inserted'
					);
				$this->log_model->insert_log($log_data);
				$transfer_item_data = $this->input->post('table_data');
				$js_data = json_decode($transfer_item_data);
				foreach ($js_data as $key => $value) {
					if($value==null){
						//echo " Null".$key;
					}
					else{
						//echo " array";
						$product_id = $value->product_id;
						$quantity = $value->quantity;	
						$data = array(
							"product_id" => $value->product_id,
							"quantity" => $value->quantity,
							"gross_total" => $value->total,
							"transfer_id" => $id
							);
						//$this->sales_model->checkProductInWarehouse($product_id,$quantity,$warehouse_id);
						if($this->transfer_model->addAransferItem($data,$product_id,$from_warehouse,$to_warehouse,$quantity)){
							//echo " 1 Asuccess add";
						}
						else{

						}
					}
				}
				redirect('transfer','refresh');
			}
			else{
				redirect('transfer','refresh');
			}
		}
	}
	/*
		edit transfer 
	*/
	public function edit($id){
		$data['data'] = $this->transfer_model->getRecord($id);
		$data['items'] = $this->transfer_model->getTransferItems($id,$data['data'][0]->from_warehouse);
		$data['warehouse'] = $this->transfer_model->getWarehouse();
		$data['product'] = $this->transfer_model->getProducts($data['data'][0]->from_warehouse);
		$this->load->view('transfer/edit',$data);
	}
	/*
		save edited transfer
	*/
	public function editTransfer(){
		$id = $this->input->post('transfer_id');
		$this->form_validation->set_rules('date','Date','trim|required');
		$this->form_validation->set_rules('to_warehouse','To Warehouse','trim|required');
		$this->form_validation->set_rules('from_warehouse','From Warehouse','trim|required');
		if($this->form_validation->run()==false){
			$this->edit($id);
		}
		else
		{
			$to_warehouse = $this->input->post('to_warehouse');
			$from_warehouse = $this->input->post('from_warehouse');
			$old_warehouse_id = $this->input->post('old_warehouse_id');
			$warehouse_change = $this->input->post('warehouse_change');
			$data = array(
						"date" 			=>  $this->input->post('date'),
						"to_warehouse" 	=>  $to_warehouse,
						"total" 		=>  $this->input->post('grand_total'),
						"note" 			=>  $this->input->post('note'),
						"user"			=>  $this->session->userdata('user_id')
					);
			$js_data = json_decode($this->input->post('table_data1'));
			$php_data = json_decode($this->input->post('table_data'));
			if($this->transfer_model->edit($id,$data)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Transfer Updated'
					);
				$this->log_model->insert_log($log_data);
				if($js_data!=null){
					foreach ($js_data as $key => $value) {
						if($value=='delete'){
							//echo " delete".$key;
							$product_id =  $php_data[$key];
							if($this->transfer_model->delete_transfer_items($id,$product_id,$to_warehouse,$from_warehouse)){
								//echo " 1.Dsuccess";
							}
						}
						else if($value==null){
							if($to_warehouse != $old_warehouse_id AND $php_data[$key] !=null){
								$product_id =  $php_data[$key];
								if($this->transfer_model->change_warehouse_delete_transfer_items($id,$product_id,$old_warehouse_id,$from_warehouse)){
									//echo " 1.Dsuccess";
								}
							}
							else if($warehouse_change == "yes"){
								$product_id =  $php_data[$key];
								if($this->transfer_model->change_warehouse_delete_transfer_items($id,$product_id,$old_warehouse_id,$from_warehouse)){
									//echo " 1.Dsuccess";
								}
							}
						}
						else{
							$product_id = $value->product_id;
							$quantity = $value->quantity;
							$data = array(
									"product_id" => $value->product_id,
									"quantity" => $value->quantity,
									"gross_total" => $value->total,
									"transfer_id" => $id
								);
							if($old_quantity = $this->transfer_model->checkProductInTransfer($id,$product_id)){
								$this->transfer_model->updateQuantity($id,$product_id,$to_warehouse,$from_warehouse,$quantity,$old_quantity);
							}
							else{
								if($this->transfer_model->addAransferItem($data,$product_id,$from_warehouse,$to_warehouse,$quantity)){
									//echo " 1 Asuccess add";
								}
								else{

								}
							}
						}
					}
				}
				redirect('transfer','refresh');
			}
		}
	}
	/* 
		this function is used to delete transfer record from database 
	*/
	public function delete($id){
		if($this->transfer_model->delete($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Transfer Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('transfer','refresh');
		}
		else{
			redirect('transfer','refresh');
		}
	}

}
?>