<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tim_chat extends CI_Controller {
	
	
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('view_reverse_ajax');
	}
	
	
	function event_source(){
		
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');

		$time = date('r');
		echo "data: The server time is: {$time}\n\n";
		flush();
	}
	
	
}
