<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('log_model');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
	}
	public function index(){
		//get All Category  to display list
		$data['data'] = $this->category_model->getCategory();
		$this->load->view('category/list', $data);
	}
	public function list_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$file_name = 'category_list';
		$data['data'] = $this->category_model->getCategory();
		$html = $this->load->view('category/list_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name.'.pdf','I');
	}
	public function list_view(){
		$this->load->view('category/list_view');
	}
	public function list_filtered_view($status){
		$this->load->view('category/list_filtered_view');
	}
	/* 
		filter category list 
	*/
	public function filter_category(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->category_model->getFilteredCategory($status);
		
		echo json_encode($data);
	}
	public function filterListPDF($status){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		// get all filtered unit record and display list
		$data['data'] = $this->category_model->getFilteredCategory($status);

		$file_name = 'category_list';
		$html = $this->load->view('category/list_pdf',$data,true);

		include(APPPATH.'third_party/mpdf/vendor/autoload.php');
		$mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('p','','','','',15,15,40,40,10,10);
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->SetWatermarkImage('assets/images/invoice/invoice2.jpg');
		$mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name.'.pdf','I');
	} 
	/* 
		call Add view to add category  
	*/
	public function add(){
		$this->load->view('category/add');
	} 
	/* 
		This function used to store category record in database  
	*/
	public function addCategory(){
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
        if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
        	$category_code = $this->category_model->getMaxId();
        	date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
						"category_code" => $category_code,
						"category_name" => $this->input->post('category_name'),
						"category_desc" => $this->input->post('category_desc'),
						"category_status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);

			if($id = $this->category_model->addModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Category Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('category/add','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Category can not be Inserted.');
				redirect("category/add",'refresh');
			}
        }	
		
	}
	/* 
		call edit view to edit Category Record 
	*/
	public function edit($id){
		$data['data'] = $this->category_model->getRecord($id);
		$this->load->view('category/edit',$data);
	}
	/* 
		This function is used to edit category record in database 
	*/
	public function editCategory(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {
        	$category_code = $this->category_model->getMaxId();
        	date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
						"category_name" => $this->input->post('category_name'),
						"category_desc" => $this->input->post('category_desc'),						
						"category_status" => $this->input->post('confirm'),
						"user_id" => $this->session->userdata('user_id'),
						"datetime" => $datetime
					);
			if($this->category_model->editModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Category Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('category','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Category can not be Updated.');
				redirect("category",'refresh');
			}
		}
	}
	/* 
		Delete selected  Category Record 
	*/
	public function delete($id){
		if($this->category_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Category Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('category');
		}
		else{
			$this->session->set_flashdata('fail', 'Category can not be Deleted.');
			redirect("category",'refresh');
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