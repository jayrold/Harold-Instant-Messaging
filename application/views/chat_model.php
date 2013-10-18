<?php

class Chat_model extends CI_Model{
	
	public $new_flag = FALSE;
	public $offline_flag = FALSE;
	
	function set_chat(){
		$msg = $this->input->post('c_msg');
		$to = $this->input->post('to');
		$this->db->where('username', $to);
		$to_status = $this->db->get('nbs_chat_users')->row();
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
			'nbs_chat',
			array(
				'from'			=> $from,
				'to'			=> $to,
				'message'		=> $msg
				//'time_added'	=> date('Y-m-d H:i:s', time()),
			)
			
		);
	}
	
	function get_chat($from, $to){
		$this->db->limit(10);
		$this->db->order_by('nbs_chat.time_added','DESC');
		$this->db->where("(nbs_chat.from = '".$from."' AND nbs_chat.to = '".$to."') OR (nbs_chat.from = '".$to."' AND nbs_chat.to = '".$from."')");
		$res = $this->db->get('nbs_chat')->result();
		asort($res);
		$this->db->limit(1);
		$this->db->where('to', $from);
		$this->db->where('from', $to);
		$this->db->where('new_flag', 1);
		if($this->db->get('nbs_chat')->row()){
			$this->db->where('to', $from);
			$this->db->where('from', $to);
			$this->db->update('nbs_chat', array('new_flag' => 0));
			$this->new_flag = TRUE;
		}
		
		return $res;
	}
	
	function set_status($username){
		$this->db->where('username', $username);
		$time  = date('Y-m-d H:i:s', time());
		if($this->db->get('nbs_chat_users')->row()){
			$this->db->where('username', $username);
			$this->db->update('nbs_chat_users', array('status' => 1, 'last_activity' => $time));
		}
		else{
			$this->db->insert(
				'nbs_chat_users',
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
		if($this->db->get('nbs_chat_users')->row()){
			$this->db->where('username', $username);
			$this->db->update('nbs_chat_users', array('status' => 0, 'last_activity' => $time));
		}
		else{
			$this->db->insert(
				'nbs_chat_users',
				array(
					'username'			=>	$username,
					'status'			=> 0,
					'last_activity' 	=> $time
				)
			);
		}
	}
	
	function get_online(){
		$time  = date('Y-m-d H:i:s', time());
		$this->db->where('username', $this->session->userdata('username'));
		$this->db->update('nbs_chat_users', array('last_activity'	=> $time));
		
		
		$this->db->where('status', 1);
		$this->db->where('username !=', $this->session->userdata('username'));
		$users = $this->db->get('nbs_chat_users')->result();
		
		if(!$users) return FALSE;
		
		foreach($users as $key=>$value){
			$unix_now  = time();
			$unix_user = mysql_to_unix($value->last_activity);
			$diff = $unix_now - $unix_user;
			if($diff > 5){
				//$this->db->where('username', $value->username);
				//$this->db->update('nbs_chat_users', array('status'	=> 0));
				unset($users[$key]);
			}
		} 
		
		return $users;
	}
	

}


