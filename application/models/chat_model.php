<?php

class Chat_model extends CI_Model{
	
	public $new_flag = FALSE;
	public $offline_flag = FALSE;
	
	function set_chat(){
		$msg = $this->input->post('c_msg');
		$to = $this->input->post('to');
		$this->db->where('username', $to);
		$to_status = $this->db->get('tim_chat_users')->row();
		if($to_status->status == 0){
			$this->offline_flag = TRUE;
		}
		else{
			$unix_now  = time();
			$unix_user = mysql_to_unix($to_status->last_activity);
			$diff = $unix_now - $unix_user;
			if($diff > 5){
				$this->offline_flag = TRUE;
			}
		}
		
		$from = $this->input->post('from');
		$this->db->insert(
			'tim_chat',
			array(
				'from'			=> $from,
				'to'			=> $to,
				'message'		=> $msg
				//'time_added'	=> date('Y-m-d H:i:s', time()),
			)
			
		);
	}
	
	function get_chat($from, $to){
		$this->db->limit(30);
		$this->db->order_by('tim_chat.time_added','DESC');
		$this->db->where("(tim_chat.from = '".$from."' AND tim_chat.to = '".$to."') OR (tim_chat.from = '".$to."' AND tim_chat.to = '".$from."')");
		$res = $this->db->get('tim_chat')->result();
		asort($res);
		$this->db->limit(1);
		$this->db->where('to', $from);
		$this->db->where('from', $to);
		$this->db->where('new_flag', 1);
		if($this->db->get('tim_chat')->row()){
			$this->db->where('to', $from);
			$this->db->where('from', $to);
			$this->db->update('tim_chat', array('new_flag' => 0));
			$this->new_flag = TRUE;
		}
		
		$this->db->where('username', $to);
		$to_status = $this->db->get('tim_chat_users')->row();
		if($to_status->status == 0){
			$this->offline_flag = TRUE;
		}
		else{
			$unix_now  = time();
			$unix_user = mysql_to_unix($to_status->last_activity);
			$diff = $unix_now - $unix_user;
			if($diff > 5){
				$this->offline_flag = TRUE;
			}
			
		}
		
		
		return $res;
	}
	
	function set_status($username){
		$this->db->where('username', $username);
		$time  = date('Y-m-d H:i:s', time());
		if($this->db->get('tim_chat_users')->row()){
			$this->db->where('username', $username);
			$this->db->update('tim_chat_users', array('status' => 1, 'last_activity' => $time));
		}
		else{
			$this->db->insert(
				'tim_chat_users',
				array(
					'username'			=>	$username,
					'status'			=> 1,
					'last_activity' 	=> $time
				)
			);
		}
	}
	
	function set_logout($username){
		$this->db->where('username', $username);
		$time  = date('Y-m-d H:i:s', time());
		if($this->db->get('tim_chat_users')->row()){
			$this->db->where('username', $username);
			$this->db->update('tim_chat_users', array('status' => 0, 'last_activity' => $time));
		}
		else{
			$this->db->insert(
				'tim_chat_users',
				array(
					'username'			=>	$username,
					'status'			=> 0,
					'last_activity' 	=> $time
				)
			);
		}
	}
	
	function get_online(){
		$from = $this->session->userdata('username');
		
		$time  = date('Y-m-d H:i:s', time());
		if($from){
			$this->db->where('username', $from);
			$this->db->update('tim_chat_users', array('last_activity'	=> $time, 'status' => 1));
		}
		
	//	$this->db->where('status', 1);
		if($from){
			$this->db->where('username !=', $from);
			$this->db->order_by('name', 'asc');
			$users = $this->db->get('tim_chat_users')->result();
		}
		else{
			$users = null;
		}
		if(!$users) return FALSE;
		
		foreach($users as $key=>$value){
			$value->new_flag = FALSE;
			$this->db->where('to', $from);
			$this->db->where('from', $value->username);
			$this->db->where('new_flag', 1);
			if($this->db->get('tim_chat')->row()){
				$value->new_flag = TRUE;
			}
			
			
			
			$unix_now  = time();
			$unix_user = mysql_to_unix($value->last_activity);
			$diff = $unix_now - $unix_user;
			if($diff > 10){
				$this->db->where('username', $value->username);
				$this->db->update('tim_chat_users', array('status'	=> 0));
			//	unset($users[$key]);
			}
			else{
				$this->db->where('username', $value->username);
				$this->db->update('tim_chat_users', array('status'	=> 1));
			}
			
			$this->db->where('username', $value->username);
			$this->db->limit(1);
			$this->db->order_by('time', 'desc');
			$value->message  = '';
			$msg_obj = $this->db->get('tim_chat_status')->row();
			if($msg_obj){
				$value->message = $msg_obj->message;
			}
		} 
		
		return $users;
	}
	

}


