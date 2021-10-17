<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Accountgroup_model extends CI_Model{
    
    function __construct()
	{
		parent::__construct();
		
	}
    public function getAccount(){
        /*$this->db->select('*')
                 ->from('account_group');
                
        return $this->db->get()->result();*/

        return $this->db->select('a.*,b.branch_name')
                 ->from('account_group a')
                 ->join('branch b','b.branch_id = a.branch_id')              
                 ->get()
                 ->result();
    }
    public function addAccountGroup($accountgroupDetail=array())
    {
        // accountgroup data
        $accountgroupData = array(
            'branch_id'   =>  $accountgroupDetail['branch_id'],
            'group_title'        =>  $accountgroupDetail['group_title'],
            'category'   =>  $accountgroupDetail['category'],
            'opening_balance'          =>  $accountgroupDetail['opening_balance'],
        );
        
        // echo '<pre>';
        // print_r($accountgroupData);exit;
        
        if($this->db->insert('account_group', $accountgroupData)) {
			$accountgroup_id = $this->db->insert_id();
			return true;
		}
        return false;
    }
    
    public function getAccountGroupWithJoin($id)
    {
        $this->db->select('AG.*,b.branch_name');
        $this->db->from('account_group AS AG');// I use aliasing make joins easier
        $this->db->join('branch AS b', 'b.id = AG.branch_id', 'INNER');
        $this->db->where('AG.id',$id);
        $q = $this->db->get();
        if( $q->num_rows() > 0 )
        {
            return $q->row();
        } 
    
        return FALSE;
    }
    
    public function getAccountGroupById($id)
    {
        $q = $this->db->get_where('account_group', array('id' => $id), 1); 
        if( $q->num_rows() > 0 )
        {
            return $q->row();
        } 
    
        return FALSE;
    }
    
    public function updateAccountGroup($accountgroupDetail,$id)
    {
        //echo $id;exit;
        //accountgroup data
		$accountgroupData = array(
            'branch_id'   =>  $accountgroupDetail['branch_id'],
            'group_title'        =>  $accountgroupDetail['group_title'],
            'category'   =>  $accountgroupDetail['category'],
            'opening_balance'          =>  $accountgroupDetail['opening_balance'],
        );
        /*echo '<pre>';
        print_r($accountgroupData);exit;*/
		
		$this->db->where('id', $id);
		if($this->db->update('account_group', $accountgroupData)) {
				return true;
		}
		return false;
    }
    
    public function getBranch()
    {
        $this->db->select('branch_id,branch_name');
		$branch = $this->db->get('branch');
		return $array = $branch->result_array();
    }
    
    public function deleteAccountGroup($id)
    {
        if($this->db->delete('account_group', array('id' => $id))) {
			return true;
	    }
			
		return FALSE;
    }
}
?>