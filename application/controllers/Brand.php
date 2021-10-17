<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Brand extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('brand_model');
		$this->load->model('log_model');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
	}
	public function index(){
		//get All Category  to display list
		$data['data'] = $this->brand_model->getBrand();
		$this->load->view('brand/list',$data);
	} 
	/* 
		call Add view to add category  
	*/
	public function add(){
		$this->load->view('brand/add');
	} 
	/* 
		This function used to store category record in database  
	*/
	public function add_brand(){
        $this->form_validation->set_rules('brand_name', 'Brand Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
        if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
			//$category_code = $this->brand_model->getMaxId();
			$data = array(
						
						"brand_name"=>$this->input->post('brand_name')
					);

			if($id = $this->brand_model->addModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Brand Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('brand','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Brand can not be Inserted.');
				redirect("brand",'refresh');
			}
        }	
		
	}
	/* 
		call edit view to edit Category Record 
	*/
	public function edit($id){
		$data['data'] = $this->brand_model->getRecord($id);
		$this->load->view('brand/edit',$data);
	}
	/* 
		This function is used to edit category record in database 
	*/
	public function edit_brand(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('brand_name', 'Brand Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {
			$data = array(
						"brand_name"=>$this->input->post('brand_name')
						);
			if($this->brand_model->editModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Category Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('brand','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Brand can not be Updated.');
				redirect("brand",'refresh');
			}
		}
	}
	/* 
		Delete selected  Category Record 
	*/
	public function delete($id){
		if($this->brand_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Brand Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('brand');
		}
		else{
			$this->session->set_flashdata('fail', 'Brand can not be Deleted.');
			redirect("brand",'refresh');
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
}
?>