<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sales_return extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('sales_return_model');
		$this->load->model('log_model');
	}
	public function index(){
		// get all sales to display list
		$data['data'] = $this->sales_return_model->getSales();
		$this->load->view('sales_return/list',$data);
	} 
	/* 
		call add view to add sales return record 
	*/
	public function add(){
		$data['warehouse'] = $this->sales_return_model->getWarehouse();
		$data['warehouse_products'] = $this->sales_return_model->getWarehouseProducts(); 
		$data['biller'] = $this->sales_return_model->getBiller();
		$data['client'] = $this->sales_return_model->getClient(); 
		$data['discount'] = $this->sales_return_model->getDiscount();
		$data['reference_no'] = $this->sales_return_model->createReferenceNo();
		$this->load->view('sales_return/add',$data);
	}
	/* 
		this function is used to get discount data when discount is change 
	*/
	public function getDiscountAjax($id){
		$data = $this->sales_return_model->getDiscount($id);
		echo json_encode($data);
		//print_r($data);
	}
	/* get all product warehouse wise */
	public function getProducts($warehouse_id){
		$data = $this->sales_return_model->getProducts($warehouse_id);
	    echo json_encode($data);
	}
	/* get single product */
	public function getProduct($product_id,$warehouse_id){
		$data = $this->sales_return_model->getProduct($product_id,$warehouse_id);
	    echo json_encode($data);
		//print_r($data);
	}
	/* 
		this function is used to search product name / code in auto complite 
	*/
	public function getAutoCodeName($code,$search_option,$warehouse){
          //$code = strtolower($code);
		  $p_code = $this->input->post('p_code');
		  $p_search_option = $this->input->post('p_search_option');
          $data = $this->sales_return_model->getProductCodeName($p_code,$p_search_option,$warehouse);
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
          
          echo $list;
          //echo json_encode($data);
          //print_r($data);
	}
	/* 
		this fucntion is used to add sales return record in database 
	*/
	public function addSalesReturn(){
		$this->form_validation->set_rules('date','Date','trim|required');
		$this->form_validation->set_rules('reference_no','Reference No','trim|required');
		//$this->form_validation->set_rules('supplier_id','Supplier ID','trim|required');
		//$this->form_validation->set_rules('warehouse_id','Warehouse ID','trim|required');
		//$this->form_validation->set_rules('discount_id','Discount ID','trim|required');
		//$this->form_validation->set_rules('biller_id','Biller ID','trim|required');
		if($this->form_validation->run()==false){

			$this->add();
		}
		else
		{
			$warehouse_id = $this->input->post('warehouse');
			$data = array(
						"date" 			=> $this->input->post('date'),
						"reference_no" 	=> $this->input->post('reference_no'),
						"warehouse_id" 	=> $this->input->post('warehouse'),
						"client_id" 	=> $this->input->post('client'),
						"discount_id" 	=> $this->input->post('discount'),
						"biller_id" 	=> $this->input->post('biller'),
						"total" 		=> $this->input->post('grand_total'),
						"discount_value"=> $this->input->post('total_discount'),
						"tax_value" 	=> $this->input->post('total_tax'),
						"note" 			=> $this->input->post('note'),
						"internal_note" => $this->input->post('internal_note'),
						"user"			=> $this->session->userdata('user_id')
					);

			if($sale_return_id = $this->sales_return_model->add($data)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $sale_return_id,
						'message'  => 'Sales Return Inserted'
					);
				$this->log_model->insert_log($log_data);
				$sales_item_data = $this->input->post('table_data');
				$js_data = json_decode($sales_item_data);
				foreach ($js_data as $key => $value) {
					if($value==null){
					}
					else{
						$product_id = $value->product_id;
						$quantity = $value->quantity;	
						$data = array(
							"product_id" => $value->product_id,
							"quantity" => $value->quantity,
							"price" => $value->price,
							"gross_total" => $value->total,
							"discount_id" => $value->discount_id,
							"discount_value" => $value->discount_value,
							"discount" => $value->discount,
							"tax_id" => $value->tax_id,
							"tax_value" => $value->tax_value,
							"tax" => $value->tax,
							"sale_return_id" => $sale_return_id
							);
						/*if($this->sales_return_model->checkProductInWarehouse($product_id,$quantity,$warehouse_id)){

						}
						else
						{*/
							if($this->sales_return_model->addSalesReturnItem($data,$product_id,$warehouse_id,$quantity))
							{
								
							}
							else{

							}
						/*}*/
					}
				}
				redirect('sales_return','refresh');
			}
			else{
			}
		}
	}
	/* 
		call edit view to edit sales return record 
	*/
	public function edit($data1){
		$data['warehouse'] = $this->sales_return_model->getWarehouse(); 
		$data['biller'] = $this->sales_return_model->getBiller();
		$data['client'] = $this->sales_return_model->getClient(); 
		$data['discount'] = $this->sales_return_model->getDiscount();
		$data['tax'] = $this->sales_return_model->getTax();
		$data['data'] = $this->sales_return_model->getRecord($data1);
		$data['product'] = $this->sales_return_model->getProducts($data['data'][0]->warehouse_id);
		$data['items'] = $this->sales_return_model->getSalesReturnItems($data['data'][0]->id,$data['data'][0]->warehouse_id);	
		$this->load->view('sales_return/edit',$data);
	}
	/*  
		this fucntion is to edit sales return record and save in database 
	*/
	public function editSalesReturn(){
		$id = $this->input->post('sale_return_id');
		$this->form_validation->set_rules('date','Date','trim|required');
		$this->form_validation->set_rules('reference_no','Reference No','trim|required');
		//$this->form_validation->set_rules('supplier_id','Supplier ID','trim|required');
		//$this->form_validation->set_rules('warehouse_id','Warehouse ID','trim|required');
		//$this->form_validation->set_rules('discount_id','Discount ID','trim|required');
		//$this->form_validation->set_rules('biller_id','Biller ID','trim|required');
		if($this->form_validation->run()==false){

			$this->edit($id);
		}
		else
		{
		$warehouse_id = $this->input->post('warehouse');
		$old_warehouse_id = $this->input->post('old_warehouse_id');
		$warehouse_change = $this->input->post('warehouse_change');
		$data = array(
					"date" 			=> $this->input->post('date'),
					"reference_no" 	=> $this->input->post('reference_no'),
					"warehouse_id" 	=> $this->input->post('warehouse'),
					"client_id" 	=> $this->input->post('client'),
					"discount_id" 	=> $this->input->post('discount'),
					"biller_id" 	=> $this->input->post('biller'),
					"total" 		=> $this->input->post('grand_total'),
					"discount_value"=>  $this->input->post('total_discount'),
					"tax_value" 	=>  $this->input->post('total_tax'),
					"note" 			=> $this->input->post('note'),
					"internal_note" => $this->input->post('internal_note'),
					"user"			=> $this->session->userdata('user_id'),
					"id"			=> $this->input->post('sale_return_id')
					);
			$this->input->post('table_data1');

			//$id = $this->input->post('sale_return_id');
			$js_data = json_decode($this->input->post('table_data1'));
			$php_data = json_decode($this->input->post('table_data'));
			if($this->sales_return_model->edit($id,$data)){	
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Sales Return Updated'
					);
				$this->log_model->insert_log($log_data);
				foreach ($js_data as $key => $value) {
					if($value=='delete'){
						//echo " delete".$key;
						$product_id =  $php_data[$key];
						if($this->sales_return_model->deleteSalesReturnItems($id,$product_id,$warehouse_id,$old_warehouse_id)){
							//echo " 1.Dsuccess";
						}
					}
					else if($value==null){
						if($warehouse_id != $old_warehouse_id AND $php_data[$key] !=null){
							$product_id =  $php_data[$key];
							if($this->sales_return_model->changeWarehouseDeleteSalesReturnItems($id,$product_id,$warehouse_id,$old_warehouse_id)){
								//echo " 1.Dsuccess";
							}
						}
						else if($warehouse_change == "yes"){
							$product_id =  $php_data[$key];
							if($this->sales_return_model->changeWarehouseDeleteSalesReturnItems($id,$product_id,$warehouse_id,$old_warehouse_id)){
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
								"price" => $value->price,
								"gross_total" => $value->total,
								"discount_id" => $value->discount_id,
								"discount_value" => $value->discount_value,
								"discount" => $value->discount,
								"tax_id" => $value->tax_id,
								"tax_value" => $value->tax_value,
								"tax" => $value->tax,
								"sale_return_id" => $id
							);
						if($old_quantity = $this->sales_return_model->checkProductInSalesReturn($id,$product_id)){
							$this->sales_return_model->updateQuantity($id,$product_id,$warehouse_id,$quantity,$old_quantity,$data);
						}
						else{
							if($this->sales_return_model->addSalesReturnItem($data,$product_id,$warehouse_id,$quantity)){
								//echo " 1 Asuccess add";
							}
							else{

							}
						}
					}
				}
				redirect('sales_return','refresh');
			}
		}
		/*echo "<pre>";
		print_r($js_data);
		print_r($php_data);*/
	}
	public function delete($id){
		if($this->sales_return_model->delete($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Sales Return Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('sales_return','refresh');
		}
		else{
			redirect('sales_return','refresh');
		}
	}
}
?>