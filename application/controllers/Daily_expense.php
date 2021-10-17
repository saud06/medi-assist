<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Daily_expense extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('daily_expense_model');
		$this->load->model('log_model');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
	}
	public function index(){
		//get All Category  to display list
		$data['data'] = $this->daily_expense_model->getDailyExpense();
		$this->load->view('daily_expense/list',$data);
	}
	/* 
		filter daily_expense  
	*/
	public function filter_daily_expense(){
		$status = $this->input->post('status');
		if($status == '0') $status = '';

		$data['data'] = $this->daily_expense_model->getFilteredDailyExpense($status);
		
		echo json_encode($data);
	}
	/* 
		call Add view to add category  
	*/
	public function add(){
		$this->load->view('daily_expense/add');
	} 
	
	/* 
		This function used to store category record in database  
	*/
	public function addDailyExpense(){
        $this->form_validation->set_rules('expense_title', 'Expense Title', 'trim|required|min_length[3]|callback_alpha_dash_space');
        $this->form_validation->set_rules('expense_date', 'Expense Date', 'trim|required');
        $this->form_validation->set_rules('expense_amount', 'Expense Amount', 'trim|required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
        	date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
						"expense_title" => $this->input->post('expense_title'),
						"expense_date" => $this->input->post('expense_date'),
						"expense_amount" => $this->input->post('expense_amount'),
						"expense_status" => $this->input->post('confirm'),
						"description" => $this->input->post('description'),
						"user_id" => $this->session->userdata('user_id'),
						"expensed_by" => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
						"datetime" => $datetime
					);

			if($id = $this->daily_expense_model->addModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Daily Expense Inserted'
					);
				$this->log_model->insert_log($log_data);
				redirect('daily_expense','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Daily Expense can not be Inserted.');
				redirect("Daily Expense",'refresh');
			}
        }	
		
	}
	/* 
		call edit view to edit Category Record 
	*/
	public function edit($id){
		$data['data'] = $this->daily_expense_model->getRecord($id);
		$this->load->view('daily_expense/edit',$data);
	}
	/* 
		This function is used to edit category record in database 
	*/
	public function editDailyExpense(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('expense_title', 'Expense Title', 'trim|required|min_length[3]|callback_alpha_dash_space');
        $this->form_validation->set_rules('expense_date', 'Expense Date', 'trim|required');
        $this->form_validation->set_rules('expense_amount', 'Expense Amount', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {
        	date_default_timezone_set('Asia/Dhaka');
        	$datetime = date('Y-m-d H:i:s');
			$data = array(
						"expense_title" => $this->input->post('expense_title'),
						"expense_date" => $this->input->post('expense_date'),
						"expense_amount" => $this->input->post('expense_amount'),
						"expense_status" => $this->input->post('confirm'),
						"description" => $this->input->post('description'),
						"user_id" => $this->session->userdata('user_id'),
						"expensed_by" => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
						"datetime" => $datetime
					);
			
			if($this->daily_expense_model->editModel($data,$id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Daily Expense Updated'
					);
				$this->log_model->insert_log($log_data);
				redirect('daily_expense','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Daily Expense can not be Updated.');
				redirect("daily_expense",'refresh');
			}
		}
	}
	/* 
		Delete selected  Category Record 
	*/
	public function delete($id){
		if($this->daily_expense_model->deleteModel($id)){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $id,
					'message'  => 'Daily Expense Deleted'
				);
			$this->log_model->insert_log($log_data);
			redirect('daily_expense');
		}
		else{
			$this->session->set_flashdata('fail', 'Daily Expense can not be Deleted (status inactive).');
			redirect("daily_expense",'refresh');
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