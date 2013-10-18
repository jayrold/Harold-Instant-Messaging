<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tester extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->load->view("view_test");
	}
	
}

	