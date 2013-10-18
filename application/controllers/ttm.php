<?php

class Ttm extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('chat_model');
		//$this->session->set_userdata('username', 'BOGZ');
	}
	
	function index(){
		$data['username'] = "Harold";
		$this->load->view('view_ttm', $data);
	}
	
	function user($user_key = ''){
		$this->db->where('key', $user_key);
		$user_info = $this->db->get('tim_chat_users')->row();
		if(!$user_info){
			echo 'ERROR: <b>User not found.</b>';
			exit;			
		}
		$this->session->set_userdata('username', $user_info->username);
		$this->db->where("username", $user_info->username);
		$data['task_info'] = $this->db->get("ttm_html")->row();
		$data['username'] = $user_info->username;
		$this->load->view('view_ttm', $data);
	}
	
	
	function escape_query($str) {
	    return strtr($str, array(
	        "\0" => "",
	        "'"  => "&#39;",
	        "\"" => "&#34;",
	        "\\" => "&#92;",
	        // more secure
	        "<"  => "&lt;",
	        ">"  => "&gt;",
	    ));
	}
	
	function ajax_save_tasks(){
		$task_html = $this->input->post("task_html");
		$username = $this->session->userdata("username");
		$this->db->where("username", $username);
		$row = $this->db->get("ttm_html")->row();
		$time = date("Y-m-d H:i:s", time());
		if($row){
			$this->db->where("username", $username);
			$this->db->update(
				'ttm_html',
				array(
					'task_html'		=> $task_html,
					'last_update'	=> $time
				)
			);
		}
		else{
			$this->db->insert(
				'ttm_html',
				array(
					'username'		=> $username,
					'task_html'		=> $task_html,
					'last_update'	=> $time
				)
			);
		}
		echo 'SAVED '.$time;
	}


}