<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ledger extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('ledger_model');
        //$this->load->model('company_setting_model');
    }
    public function index(){
        
        $data['data'] = $this->ledger_model->getLedger(); 
        //$data['branch'] = $this->ledger_model->getBranch();
        /*echo "<pre>";
        print_r($data);
        exit();*/
        $this->load->view('ledger/list',$data);
    } 
    
    public function getBranch(){
        //get Branch name and Id
        $data['data'] = $this->biller_model->getBranch(); 
        return $data;
    }
    /* 
        get Branch name and Id  
    */
    public function add(){
        $data['branch'] = $this->ledger_model->getBranch();
        $data['accountgroup'] = $this->ledger_model->getAccountGroup();
        $this->load->view('ledger/add',$data);
    }
    /* 
        Add New Biller in database 
    */
    function add_ledger()
    {
        //ledger form validation
        /* ==============VALIDATION FOR SELECTBOX branch ================ */
        $this->form_validation->set_rules('branch','Branch','required');
        /* --------------*/
        /* ==============VALIDATION FOR SELECTBOX type ================ */
        $this->form_validation->set_rules('type','Type','required');
        
        /* --------------*/
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        /* ==============VALIDATION FOR SELECTBOX group ================ */
        $this->form_validation->set_rules('accountgroup','Account Group','required');
        /* --------------*/
        
        $this->form_validation->set_rules('opening_balance', 'Opening Balance', 'trim|required');
        $this->form_validation->set_rules('closing_balance', 'Closing Balance', 'trim|required');
        
        if ($this->form_validation->run() == true)
        {
            $ledgerDetail = array(
                    'branch_id' =>  $this->input->post('branch'),
                    'type'        =>  $this->input->post('type'),
                    'title'   =>  strtoupper($this->input->post('title')),
                    'accountgroup_id'   =>  $this->input->post('accountgroup'),
                    'opening_balance'          =>  $this->input->post('opening_balance'),
                    'closing_balance'          =>  $this->input->post('closing_balance'),
                );
        }
        
        if ( ($this->form_validation->run() == true) && $this->ledger_model->addLedger($ledgerDetail))
        {  
            $this->session->set_flashdata('success', 'Ledger added successfully.');
            redirect("ledger",'refresh');
        }
        else
        {  
            /*$data['branch'] = $this->ledger_model->getBranch();
            $data['accountgroup'] = $this->ledger_model->getAccountGroup();
            
            $this->load->view('add', $data);*/

            redirect("ledger",'refresh');
        }   
    }
    /* 
        call view editr Biller 
    */
    public function edit($ledger_id)
    {
        $id = $ledger_id;
        
        if($post = $this->input->post())
        {
            //ledger form validation
            /* ==============VALIDATION FOR SELECTBOX branch ================ */
            $this->form_validation->set_rules('branch','Branch','required');
            /* --------------*/
            /* ==============VALIDATION FOR SELECTBOX type ================ */
            $this->form_validation->set_rules('type','Type','required');
            /* --------------*/
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            /* ==============VALIDATION FOR SELECTBOX group ================ */
            $this->form_validation->set_rules('accountgroup','Account Group','required');
            /* --------------*/
            
            $this->form_validation->set_rules('opening_balance', 'Opening Balance', 'trim');
            $this->form_validation->set_rules('closing_balance', 'Closing Balance', 'trim');
            
            if ($this->form_validation->run() == true)
            {
                $ledgerDetail = array(
                    'branch_id' =>  $this->input->post('branch'),
                    'type'        =>  $this->input->post('type'),
                    'title'   =>  strtoupper($this->input->post('title')),
                    'accountgroup_id'   =>  $this->input->post('accountgroup'),
                    'opening_balance'          =>  $this->input->post('opening_balance'),
                    'closing_balance'          =>  $this->input->post('closing_balance'),
                );
               // echo '<pre>';
               // print_r($ledgerDetail);exit;
            }
            if ( ($this->form_validation->run() == true) && $this->ledger_model->updateLedger($ledgerDetail,$id))
            {  
                $this->session->set_flashdata('success', 'Ledger edited successfully.');
                redirect("ledger",'refresh');
            }
            else
            {  
                $ledger_details = $this->ledger_model->getledgerById($ledger_id);
                $data['branch'] = $this->ledger_model->getBranch();
                $data['accountgroup'] = $this->ledger_model->getAccountGroup();
                /*echo '<pre>';
                print_r($ledger_details);exit;*/
                $data['id'] = $ledger_id;
                $data['ledger'] = $ledger_details;
                
                $this->load->view('ledger/edit', $data);
               
            }
        }
        else
        {
            $ledger_details = $this->ledger_model->getledgerById($ledger_id);
            $data['branch'] = $this->ledger_model->getBranch();
            $data['accountgroup'] = $this->ledger_model->getAccountGroup();
            /*echo '<pre>';
            print_r($ledger_details);exit;*/
            $data['id'] = $ledger_id;
            $data['ledger'] = $ledger_details;
            
            $this->load->view('ledger/edit', $data);
            
        }
    }
    
    /* 
        Delete Biller in Database 
    */
    public function delete($ledger_id)
    {
        $id = $ledger_id;
        if($this->ledger_model->deleteLedger($id))
        {
            $this->session->set_flashdata('success', 'Ledger deleted successfully.');
            redirect("ledger",'refresh');
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
    function fax($str) {
        if (! preg_match("/^[1-9][0-9]{6}$/", $str))
        {
            $this->form_validation->set_message('fax', 'The %s field may only contain Numeric and 7 digit (Ex.2199876)');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    function tel($str) {
        if (! preg_match("/^[1-9][0-9]{5}$/", $str))
        {
            $this->form_validation->set_message('tel', 'The %s field may only contain Numeric and 6 digit(Ex.294910)');
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