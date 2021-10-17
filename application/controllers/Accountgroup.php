<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Accountgroup extends CI_Controller 
{
    
    function __construct()
	{
	
        parent::__construct();
        $this->load->library('session');
        $this->load->model('accountgroup_model');
        $this->load->library('form_validation');
        //$this->load->library('Datatables');
	}
    
    function index()
    {
        
        $data['data'] = $this->accountgroup_model->getAccount(); 
        $this->load->view('account_group/list',$data);
    }
    
    function accountgroup_details()
    {
        $this->datatables->select('account_group.id,branch.branch_name as branchName,group_title,category,opening_balance')
        //->unset_column('account_group.id')
        ->from('account_group')
        ->join('branch','branch.id = account_group.branch_id','INNER')
        ->add_column("Actions", "<a href='accountgroup/view/$1'><i class='fa fa-eye'></i></a> &nbsp; <a href='accountgroup/edit/$1'><i class='fa fa-pencil-square-o'></i></a> &nbsp; <a href='accountgroup/delete/$1' onclick=\"return confirm('Are you sure you want to delete?');\"><i class='fa fa-trash-o'></i></a>", "account_group.id");
		
        echo $this->datatables->generate();
    }
    
    function view($accountgroup_id)
    {
        $id = $accountgroup_id;
        $accountgroup_details = $this->accountgroup_model->getAccountGroupWithJoin($accountgroup_id);
        /*echo '<pre>';
        print_r($accountgroup_details);exit;*/
        $data['id'] = $accountgroup_id;
        $data['accountgroup'] = $accountgroup_details;
        $meta['page_title'] = 'VRS | View Account Group';
        $data['page_title'] = "View Account Group";
        $this->load->view('commons/header', $meta);
        $this->load->view('view', $data);
        $this->load->view('commons/footer');
        
    }
    
    function add()
    {
        //accountgroup form validation
        /* ==============VALIDATION FOR SELECTBOX branch ================ */
        $this->form_validation->set_rules('branch','Branch','required');
        /* --------------*/
        $this->form_validation->set_rules('group_title', 'Group Title', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim');
        $this->form_validation->set_rules('opening_balance', 'Opening Balance', 'trim');
        if ($this->form_validation->run() == true)
        {
            $accountgroupDetail = array(
                    'branch_id'	=>	$this->input->post('branch'),
                    'group_title'        =>  $this->input->post('group_title'),
                    'category'   =>  $this->input->post('category'),
                    'opening_balance'          =>  $this->input->post('opening_balance'),
                );
               // echo '<pre>';
               // print_r($accountgroupDetail);exit;
        }
        
        if ( ($this->form_validation->run() == true) && $this->accountgroup_model->addAccountGroup($accountgroupDetail))
		{  
			$this->session->set_flashdata('success', 'Account Group added successfully.');
			redirect("accountgroup",'refresh');
		}
		else
		{  
            $data['branch'] = $this->accountgroup_model->getBranch();
			
            $this->load->view('account_group/add', $data);
            
		
		}	
	}
    
    public function edit($accountgroup_id)
    {
        $id = $accountgroup_id;
        
        if($post = $this->input->post())
        {
            //accountgroup form validation
            /* ==============VALIDATION FOR SELECTBOX branch ================ */
            $this->form_validation->set_rules('branch','Branch','required');
            /* --------------*/
            $this->form_validation->set_rules('group_title', 'Group Title', 'trim|required');
            $this->form_validation->set_rules('category', 'Category', 'trim');
            $this->form_validation->set_rules('opening_balance', 'Opening Balance', 'trim');
            
            if ($this->form_validation->run() == true)
            {
                $accountgroupDetail = array(
                    'branch_id'	=>	$this->input->post('branch'),
                    'group_title'        =>  $this->input->post('group_title'),
                    'category'   =>  $this->input->post('category'),
                    'opening_balance'          =>  $this->input->post('opening_balance'),
                );
               // echo '<pre>';
               // print_r($accountgroupDetail);exit;
            }
            if ( ($this->form_validation->run() == true) && $this->accountgroup_model->updateAccountGroup($accountgroupDetail,$id))
            {  
                $this->session->set_flashdata('success', 'Account Group edited successfully.');
                redirect("accountgroup",'refresh');
            }
            else
            {  
                /*$data['property_type_name'] = array('name' => 'property_type_name',
                    'id' => 'property_type_name',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('property_type_name'),
                );*/
                //$accountgroup_details = $this->accountgroup_model->getaccountgroupById($accountgroup_id);
                //$data['branch'] = $this->accountgroup_model->getBranch();
                /*echo '<pre>';
                print_r($accountgroup_details);exit;*/
                /*$data['id'] = $accountgroup_id;
                $data['accountgroup'] = $accountgroup_details;
                $meta['page_title'] = 'VRS | Edit accountgroup';
                $data['page_title'] = "Edit accountgroup";
                $this->load->view('commons/header', $meta);
                $this->load->view('edit', $data);
                $this->load->view('commons/footer');*/
                redirect("accountgroup",'refresh');
            
            }
        }
        else
        {
            $accountgroup_details = $this->accountgroup_model->getAccountGroupById($accountgroup_id);
            $data['branch'] = $this->accountgroup_model->getBranch();
            // echo '<pre>';
            // print_r($accountgroup_details);exit;
            $data['id'] = $accountgroup_id;
            $data['accountgroup'] = $accountgroup_details;
            
            $this->load->view('account_group/edit', $data);
            //$this->load->view('commons/footer');
        }
    }
    
    public function delete($accountgroup_id)
    {
        $id = $accountgroup_id;
        if($this->accountgroup_model->deleteAccountGroup($id))
        {
            $this->session->set_flashdata('success', 'Account Group deleted successfully.');
            redirect("accountgroup",'refresh');
        }
    }
    
    function check_default($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
}
?>