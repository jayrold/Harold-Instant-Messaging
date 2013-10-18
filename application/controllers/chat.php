<?php

class Chat extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('chat_model');
		//$this->session->set_userdata('username', 'BOGZ');
	}
	
	function index(){
		$data['page_content'] = 'view_clients';
		$data['page_title'] = 'Chat by Jayson';
		$data['onlines']	= $this->chat_model->get_online();
		$this->load->view('includes/template', $data);
	}
	

	function ajax_jchat(){
		$msg = $this->input->post('c_msg');
		$to = $this->input->post('to');
		$from = $this->input->post('from');
		$this->chat_model->set_chat();
		
		$chat_his = $this->chat_model->get_chat($from, $to);
		$msg = '';
		foreach($chat_his as $c){
			$msg .= '<span class="tchat">
					<em>'.$c->from.' says:</em><br>
				'.$c->message.'
				</span>';
		}
		if($this->chat_model->offline_flag){
			$msg .= '<span class="tchat">
					<em style="color:RED">'.$to.' is offline</em><br>
				Message not sent!
				</span>';
		}
		
		echo $msg;
	}
	
	function ajax_jchat_update(){
		$to = $this->input->post('to');
		$from = $this->input->post('from');
		$chat_his = $this->chat_model->get_chat($from, $to);
		$data['msg'] = '';
		foreach($chat_his as $c){
			$data['msg'] .= '<span class="tchat">
					<em>'.$c->from.' says:</em><br>
				'.$c->message.'
				</span>';
		}
		$new_flag = 'no';
		if($this->chat_model->new_flag){
			$new_flag = 'yes';
		}
		$data['new_flag'] = $new_flag;
		echo json_encode($data);
	}
	
	function ajax_jchat_get_online(){
		$data['msg'] = '';
		$onlines	= $this->chat_model->get_online();
	
		if(!$onlines){
			$data['msg'] = '<span class="jhead">Chat<em class="total_online">(0)</em></span>';
			$data['total_online'] = 0;
		}
		else{
			$data['msg']  .='<span class="jhead">Chat<em class="total_online">('.count($onlines).')</em></span>';
			 foreach($onlines as $o) {
				$data['msg'] .= '<span class="juser" id="'.$o->id.'" title="'.$o->username.'">'.$o->username.'</span>';
			}
			$data['msg'] .= '<script type="text/javascript" src="assets/js/chat/user_select.js"></script>';
			$data['total_online'] = count($onlines);
		}
		echo json_encode($data);
	}
	
	
}