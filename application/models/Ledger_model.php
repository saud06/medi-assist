<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ledger_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        
    }
    public function index(){
        
    } 
    /* 
        return all discount details to display list  
    */
    public function getLedger(){
        /*$this->db->select('*')
                 ->from('ledger');
                 ->join('branch','ledger.branch_id=branch.branch_id')
                 ->join('account_group','account_group.id=ledger.accountgroup_id');
                
        return $this->db->get()->result();*/

        return $this->db->select('l.*,b.branch_name,a.group_title')
                 ->from('ledger l')
                 ->join('branch b','b.branch_id = l.branch_id')
                 ->join('account_group a','a.id=l.accountgroup_id')
                 ->get()
                 ->result();
    }

    public function getBranch()
    {
        $this->db->select('branch_id,branch_name');
        $branch = $this->db->get('branch');
        return $array = $branch->result_array();
    }
    
    public function getAccountGroup()
    {
        $this->db->select('id,group_title');
        $acc_group = $this->db->get('account_group');
        return $array = $acc_group->result_array();
    }
    /* 
        insert new  discount record in database 
    */
    public function addModel($data){
        $sql = "insert into discount (discount_name,discount_value,user_id) values(?,?,?)";
        if($this->db->query($sql,$data)){
        /*if($this->db->insert('discount',$data)){*/
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    /* 
        return specific discount record to edit 
    */
    public function getRecord($id){
        $sql = "select * from discount where discount_id = ?";
        if($query = $this->db->query($sql,array($id))){
        /*$this->db->where('discount_id',$data);
        if($query = $this->db->get('discount')){*/
            return $query->result();
        }
        else{
            return FALSE;
        }
    }
    /* 
        save edited discount record in databse 
    */
    public function editModel($data,$id){
        $sql = "update discount set discount_name = ?,discount_value = ? where discount_id = ?";
        if($this->db->query($sql,array($data['discount_name'],$data['discount_value'],$id))){
        /*$this->db->where('discount_id',$id);
        if($this->db->update('discount',$data)){*/
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    /* 
        delete discount record from databse 
    */
    public function deleteModel($id){
        $sql = "delete from discount where discount_id = ?";
        if($this->db->query($sql,array($id))){
        /*$this->db->where('discount_id',$id);
        if($this->db->delete('discount')){*/
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function addLedger($ledgerDetail=array())
    {
        // ledger data
        $ledgerData = array(
            'branch_id'   =>  $ledgerDetail['branch_id'],
            'type'        =>  $ledgerDetail['type'],
            'title'   =>  $ledgerDetail['title'],
            'accountgroup_id'   =>  $ledgerDetail['accountgroup_id'],
            'opening_balance'          =>  $ledgerDetail['opening_balance'],
            'closing_balance'          =>  $ledgerDetail['closing_balance'],
        );
        
        /* echo '<pre>';
         print_r($ledgerDetail);exit;*/
        
        if($this->db->insert('ledger', $ledgerDetail)) {
            $ledger_id = $this->db->insert_id();
            return true;
        }
        return false;
    }
    
    public function getledgerWithJoin($id)
    {
        $this->db->select('L.*,B.branch_name,A.group_title');
        $this->db->from('ledger AS L');// I use aliasing make joins easier
        $this->db->join('branch AS B', 'B.id = L.branch_id', 'INNER');
        $this->db->join('account_group AS A', 'A.id = L.accountgroup_id', 'INNER');
        $this->db->where('L.id',$id);
        $q = $this->db->get();
        if( $q->num_rows() > 0 )
        {
            return $q->row();
        } 
    
        return FALSE;
    }
    
    public function getledgerById($id)
    {
        $q = $this->db->get_where('ledger', array('id' => $id), 1); 
        if( $q->num_rows() > 0 )
        {
            return $q->row();
        } 
    
        return FALSE;
    }
    
    public function updateLedger($ledgerDetail,$id)
    {
        // echo $id;exit;
        //ledger data
        $ledgerData = array(
            'branch_id'   =>  $ledgerDetail['branch_id'],
            'type'        =>  $ledgerDetail['type'],
            'title'   =>  $ledgerDetail['title'],
            'accountgroup_id'   =>  $ledgerDetail['accountgroup_id'],
            'opening_balance'          =>  $ledgerDetail['opening_balance'],
            'closing_balance'          =>  $ledgerDetail['closing_balance'],
        );
        // echo '<pre>';
        // print_r($ledgerData);exit;
        
        $this->db->where('id', $id);
        if($this->db->update('ledger', $ledgerData)) {
                return true;
        }
        return false;
    }

    public function deleteLedger($id)
    {
        if($this->db->delete('ledger', array('id' => $id))) {
            return true;
        }
            
        return FALSE;
    }
}
?>