<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('log_model');
	}
	public function index(){
		$data['data'] = $this->log_model->getLogs();
		$this->load->view('log/list',$data);
	}
}
?>