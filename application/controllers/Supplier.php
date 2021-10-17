<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Supplier extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('supplier_model');
		$this->load->model('log_model');
	}

	public function index(){
		// get all supplier to display list
		$data['data'] = $this->supplier_model->getSuppliers();
		$this->load->view('supplier/list',$data);
	} 

	/*
		get all state of country
	*/
	public function getState($id){
		$data = $this->supplier_model->getState($id);
		echo json_encode($data);
	}

	/*
		get all city of state
	*/
	public function getCity($id){
		$data = $this->supplier_model->getCity($id);
		echo json_encode($data);
	}

	/* 
		call add view to add supplier   
	*/
	public function add(){
		$data['country']  = $this->supplier_model->getCountry();
		$this->load->view('supplier/add',$data);
	}

	/* 
		This function id used to add supplier in darabase 
	*/
	public function addSupplier(){
		$this->form_validation->set_rules('supplier_name', 'Supplier Name', 'trim|required|min_length[3]|callback_alpha_dash_space1');
		$this->form_validation->set_rules('gstid', 'GSTID', 'trim|required');
		$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|min_length[10]|max_length[10]|callback_mobile');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('postal_code', 'Postal Code', 'trim|required|numeric|min_length[6]|max_length[6]|callback_postal_code');

		if ($this->form_validation->run() == FALSE)
        {    
                    $this->add();
         			//redirect('supplier');
        }
        else
        {
        	$digits = 4;
			$gstid = date('y').'-'.$this->generateRandomString(5). rand(pow(10, $digits-1), pow(10, $digits)-1).'-'.mt_rand(0, 9).'-'.$this->generateRandomString(1).'-'.mt_rand(0, 9);
			$data = array(
						"supplier_name"	=>	$this->input->post('supplier_name'),
						"company_name"	=>	$this->input->post('company_name'),
						"address"		=>	$this->input->post('address'),
						"city"			=>	$this->input->post('city'),
						"country"		=>	$this->input->post('country'),
						"state"			=>	$this->input->post('state'),
						"mobile"		=>	$this->input->post('mobile'),
						"email"			=>	$this->input->post('email'),
						"postal_code"	=>	$this->input->post('postal_code'),
						"gstid"			=>  $this->input->post('gstid'),
						"vat_no"    =>	$this->input->post('vatno'),
						"pan_no"    =>	$this->input->post('panno'),
						"tan_no"    =>	$this->input->post('tan'),
						"cst_reg_no"    =>	$this->input->post('cstregno'),
						"excise_reg_no"    =>	$this->input->post('exciseregno'),
						"lbt_reg_no"    =>	$this->input->post('lbtregno'),
						"servicetax_reg_no"    =>	$this->input->post('servicetaxno'),
						"gst_registration_type" =>	$this->input->post('gstregtype')
					);

			if($id = $this->supplier_model->addModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Supplier Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('supplier','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Supplier can not be Inserted.');
				redirect("supplier",'refresh');
			}
		}
	}
	
	/* 
		call edit view to edit supplier 
	*/ 
	public function edit($id){
		$data['data'] = $this->supplier_model->getRecord($id);
		$data['country']  = $this->supplier_model->getCountry();
		$data['state'] = $this->supplier_model->getState($data['data'][0]->country_id);
		$data['city'] = $this->supplier_model->getCity($data['data'][0]->state_id);
		$this->load->view('supplier/edit',$data);
	}

	/* 
		This function is used to save edited sullpier record  
	*/
	public function editSupplier(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('supplier_name', 'Supplier Name', 'trim|required|min_length[3]|callback_alpha_dash_space1');
		$this->form_validation->set_rules('gstid', 'GSTID', 'trim|required');
		$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|min_length[10]|max_length[10]|callback_mobile');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('postal_code', 'Postal Code', 'trim|required|numeric|min_length[6]|max_length[6]|callback_postal_code');

		if ($this->form_validation->run() == FALSE)
        {    
                    $this->edit($id);
         			//redirect('supplier');
        }
        else
        {
			$data = array(
						"supplier_name"	=>	$this->input->post('supplier_name'),
						"company_name"	=>	$this->input->post('company_name'),
						"address"		=>	$this->input->post('address'),
						"city_id"			=>	$this->input->post('city'),
						"country_id"		=>	$this->input->post('country'),
						"state_id"			=>	$this->input->post('state'),
						"mobile"		=>	$this->input->post('mobile'),
						"email"			=>	$this->input->post('email'),
						"postal_code"	=>	$this->input->post('postal_code'),
						"gstid"			=>	$this->input->post('gstid'),
						"vat_no"    =>	$this->input->post('vatno'),
						"pan_no"    =>	$this->input->post('panno'),
						"tan_no"    =>	$this->input->post('tan'),
						"cst_reg_no"    =>	$this->input->post('cstregno'),
						"excise_reg_no"    =>	$this->input->post('exciseregno'),
						"lbt_reg_no"    =>	$this->input->post('lbtregno'),
						"servicetax_reg_no"    =>	$this->input->post('servicetaxno'),
						"gst_registration_type" =>	$this->input->post('gstregtype'),
						"supplier_id" 	=>	$this->input->post('id')
						);
			
			if($this->supplier_model->editModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Supplier Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('supplier');
			}
			else{
				$this->session->set_flashdata('fail', 'Supplier can not be Updated.');
				redirect("supplier",'refresh');
			}
		}
	}
	/* 
		this function is used to delete supplier from database 
	*/
	public function delete($id){
		if($this->supplier_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Supplier Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('supplier');
		}
		else{
			$this->session->set_flashdata('fail', 'Supplier can not be Deleted.');
			redirect("supplier",'refresh');
		}
	}
	function alpha_dash_space($str) {
		if (! preg_match("/^([-a-zA-Z ])+$/i", $str))
	    {
	        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha, spaces and dashes.');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}

	function alpha_dash_space1($str) {
		if (! preg_match("/^([a-zA-Z ])+$/i", $str))
	    {
	        $this->form_validation->set_message('alpha_dash_space1', 'The %s field may only contain alpha and spaces.');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}

	function mobile($str) {
		if (! preg_match("/^[6-9][0-9]{9}$/", $str))
	    {
	        $this->form_validation->set_message('mobile', 'The %s field may only contain Numeric and 10 digit(Ex.9898767654)');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}

	function postal_code($str) {
		if (! preg_match("/^[1-9][0-9]{5}$/", $str))
	    {
	        $this->form_validation->set_message('postal_code', 'The %s field may only contain Numeric and 6 digit (Ex.382463)');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}

	function generateRandomString($length) {
	    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}
?>