<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model
{
	/*
		enter log data
	*/
	public function insert_log($data){
		$this->db->insert('log',$data);
	}
	/*
		list all log data
	*/
	public function getLogs(){
		return $this->db->query('
									SELECT l.*,u.first_name,u.last_name
									FROM log l
									INNER JOIN users u ON u.id = l.user_id
									ORDER BY l.id desc
								')->result();
	}
}
?>