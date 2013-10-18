<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tim extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('chat_model');
		
	}

	public function index(){
		$group_html = $this->ajax_group_chat();
		$group_html =str_replace(array("\r\n", "\r", "\n", "\t"), '', $group_html);
		echo $group_html;
	}	
	
	function user($user_key = ''){
		$this->db->where('key', $user_key);
		$user_info = $this->db->get('tim_chat_users')->row();
		if(!$user_info){
			echo 'ERROR: <b>User not found. Please contact Harold. Thank you!</b>';
			exit;			
		}
		$this->db->where('username', $user_info->username);
		$this->db->limit(1);
		$this->db->order_by('time', 'desc');
		$user_info->message  = '';
		$msg_obj = $this->db->get('tim_chat_status')->row();
		if($msg_obj){
			$user_info->message = $msg_obj->message;
		}
				
		$this->session->set_userdata('username', $user_info->username);
		$this->session->set_userdata('to_username', "");
		$this->session->set_userdata('gc_to', "");
		$data['onlines'] = $this->chat_model->get_online();
		$data['user_info'] = $user_info;
		$data['users'] = $this->chat_model->get_online();
		$this->load->view('view_tim', $data);
		
	}
	
	function ajax_add_status(){
		$s_message = $this->input->post('c_msg');
		$this->db->insert(
			'tim_chat_status',
			array(
				'username'	=> $this->session->userdata('username'),
				'message'	=> $s_message,
				'time'		=> date('Y-m-d H:i:s', time())
			)
		);
	}
	
	function ajax_jchat(){
		$msg = $this->input->post('c_msg');
		$to = $this->input->post('to');
		$from = $this->input->post('from');
		$this->chat_model->set_chat();
		
		$chat_his = $this->chat_model->get_chat($from, $to);
		$msg = '';
		foreach($chat_his as $c){
			
			$string = $c->message;
			
			preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);		
			$url_arrs = array();
			$url_arrs['harold_key1'] = "";
			$url_arrs['harold_key2'] = "";
			$url_arrs['harold_key3'] = "";
			//first url
			if($matches){
				$string = str_replace($matches[0], "[harold_key1]",$string);
				$url_arrs['harold_key1'] = $matches[0];
				preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);

				//second url
				if($matches){
					$string = str_replace($matches[0], "[harold_key2]",$string);
					$url_arrs['harold_key2'] = $matches[0];
					preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);

					//third url
					if($matches){
						$string = str_replace($matches[0], "[harold_key3]",$string);
						$url_arrs['harold_key3'] = $matches[0];
						//preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);
					}
				}

			}

			if(!empty($url_arrs['harold_key1'])){
				$string = str_replace('[harold_key1]', '<a href="'.$url_arrs['harold_key1'].'" target="_blank">'.$url_arrs['harold_key1'].'</a>', $string);
			}
			if(!empty($url_arrs['harold_key2'])){
				$string = str_replace('[harold_key2]', '<a href="'.$url_arrs['harold_key2'].'" target="_blank">'.$url_arrs['harold_key2'].'</a>', $string);
			}
			if(!empty($url_arrs['harold_key3'])){
				$string = str_replace('[harold_key3]', '<a href="'.$url_arrs['harold_key3'].'" target="_blank">'.$url_arrs['harold_key3'].'</a>', $string);
			}
			
			$c->message = $string;
			
			$msg .='<li>
				<em>'.$c->from.' says:</em><br>
				'.$c->message.'<br>
				<span>'.date('d M Y h:i:s a', mysql_to_unix($c->time_added)).'</span>
			</li>';
			
		}
		
		if($this->chat_model->offline_flag){
	
			$msg .= '<li>
					<em style="color:RED">'.$to.' is offline</em><br>
				Your message(s) will be kept to her/his inbox.
				</li>';
		}
		
		echo $msg;
	}
	
	function ajax_jchat_update_set_user(){
		$to = $this->input->post('to');
		$from = $this->input->post('from');

		$this->session->set_userdata('to_username', $to);

		$data = $this->ajax_jchat_update($to, $from);
		echo json_encode($data);
	}
	
	function ajax_chat_close_user(){
		$this->session->set_userdata("to_username", "");
	}
	
	function ajax_jchat_update($to = "", $from = ""){
		/*
		$to = $this->input->post('to');
		$from = $this->input->post('from');
		*/
		$chat_his = $this->chat_model->get_chat($from, $to);
		$data['msg'] = '';
		foreach($chat_his as $c){
			$string = $c->message;
			
			preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);		
			$url_arrs = array();
			$url_arrs['harold_key1'] = "";
			$url_arrs['harold_key2'] = "";
			$url_arrs['harold_key3'] = "";
			//first url
			if($matches){
				$string = str_replace($matches[0], "[harold_key1]",$string);
				$url_arrs['harold_key1'] = $matches[0];
				preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);

				//second url
				if($matches){
					$string = str_replace($matches[0], "[harold_key2]",$string);
					$url_arrs['harold_key2'] = $matches[0];
					preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);

					//third url
					if($matches){
						$string = str_replace($matches[0], "[harold_key3]",$string);
						$url_arrs['harold_key3'] = $matches[0];
						//preg_match('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', $string, $matches);
					}
				}

			}

			if(!empty($url_arrs['harold_key1'])){
				$string = str_replace('[harold_key1]', '<a href="'.$url_arrs['harold_key1'].'" target="_blank">'.$url_arrs['harold_key1'].'</a>', $string);
			}
			if(!empty($url_arrs['harold_key2'])){
				$string = str_replace('[harold_key2]', '<a href="'.$url_arrs['harold_key2'].'" target="_blank">'.$url_arrs['harold_key2'].'</a>', $string);
			}
			if(!empty($url_arrs['harold_key3'])){
				$string = str_replace('[harold_key3]', '<a href="'.$url_arrs['harold_key3'].'" target="_blank">'.$url_arrs['harold_key3'].'</a>', $string);
			}
			
			$c->message = $string;
			
			
			$data['msg'] .='<li>
				<em>'.$c->from.' says:</em><br>
				'.$c->message.'<br>
				<span>'.date('d M Y h:i:s a', mysql_to_unix($c->time_added)).'</span>
			</li>';
		}
		
		if($this->chat_model->offline_flag){
	
			$data['msg'] .= '<li>
					<em style=\"color:RED\">'.$to.' is offline</em><br>
				Your message(s) will be kept to her/his inbox.
				</li>';
		}
		
		$new_flag = 'no';
		if($this->chat_model->new_flag){
			$new_flag = 'yes';
		}
		$data['new_flag'] = $new_flag;
		//echo json_encode($data);
		//print_r($data);
		return $data;
	}
	
	function ajax_jchat_get_online(){

		$msg = '';
		$ajax_data['users']	= $this->chat_model->get_online();
		$ajax_data['c_username'] = $this->input->post('c_username');
		//print_r($ajax_data['users']);
		$msg = $this->load->view('ajax_online', $ajax_data, TRUE);
		$msg =str_replace(array("\r\n", "\r", "\n", "\t"), '', $msg);
		
		$group_html = $this->ajax_group_chat();
		$group_html =str_replace(array("\r\n", "\r", "\n", "\t"), '', $group_html);
		//$group_html = "wee";
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');

		$time = date('r');

		echo "retry: 2000".PHP_EOL;
		echo 'data: {"msg":"Listening..."}'.PHP_EOL;
		echo PHP_EOL;
		
		echo "event: update".PHP_EOL;
		echo 'data: '.$msg.PHP_EOL;		
		echo PHP_EOL;
		
		
		echo "event: updateGroup".PHP_EOL;
		echo 'data: '.$group_html.PHP_EOL;		
		echo PHP_EOL;
		
		$to_username = $this->session->userdata("to_username");
		if(!empty($to_username)){
			$chat_array = $this->ajax_jchat_update($to_username, $this->session->userdata('username'));
			$chat_array['msg'] =str_replace(array("\r\n", "\r", "\n", "\t"), '', $chat_array['msg']);
		//	$chat_array['msg'] = strip_tags($chat_array['msg']);
		//	$chat_array['msg'] = "Myfriend";
			echo "event: updateChat".PHP_EOL;
			echo 'data: {"msg":"'.$chat_array['msg'].'", "new_flag" : "'.$chat_array['new_flag'].'"}'.PHP_EOL;		
			echo PHP_EOL;
		}
		
		$gc_to = $this->session->userdata("gc_to");
		if(!empty($gc_to)){
			$chat_array = $this->ajax_get_gc($gc_to);
			$chat_array['msg'] =str_replace(array("\r\n", "\r", "\n", "\t"), '', $chat_array['msg']);


			echo "event: updateGroupChat".PHP_EOL;
			echo 'data: {"msg":"'.$chat_array['msg'].'", "gc_users" : "'.$chat_array['gc_users'].'", "gc_title" : "'.$chat_array['gc_title'].'", "creator" : "'.$chat_array['creator'].'", "time_created" : "'.$chat_array['time_created'].'"}'.PHP_EOL;		
			echo PHP_EOL;
		}	
		
		
		ob_flush();
		flush();
		
	}
	
	function ajax_set_group_chat(){
		$from = $this->input->post('from');
		$g_msg = $this->input->post('g_msg');
		$g_title = $this->input->post('g_title');
		$g_option = $this->input->post('g_option');
		$g_tos = $this->input->post('g_tos');
		
		
		$this->db->insert(
			'tim_group_chat',
			array(
				'username'		=> $from,
				'title'			=> $g_title,
				'message'		=> $g_msg,
				'time'			=> date('Y-m-d H:i:s', time()),
				'last_updated'  => date('Y-m-d H:i:s', time()),
				'status'		=> 1
			)
		);
		$gc_id = $this->db->insert_id();
		if($g_option == 'some'){
			$g_tos = substr($g_tos,0,-1);
			$tos_arr = explode(",", $g_tos);
			$this->db->insert(
				'tim_group_chat_members',
				array(
					'gc_id'		=> $gc_id,
					'username'	=> $from
				)
			);
			foreach($tos_arr as $to){
				$this->db->insert(
					'tim_group_chat_members',
					array(
						'gc_id'		=> $gc_id,
						'username'	=> $to
					)
				);
			}
		}
		else{
			$all_users = $this->db->get('tim_chat_users')->result();
			if($all_users){
				foreach($all_users as $to){
					$this->db->insert(
						'tim_group_chat_members',
						array(
							'gc_id'		=> $gc_id,
							'username'	=> $to->username
						)
					);
				}
				
			}
		}
	}
	
	
	function ajax_group_chat(){
		
		$this->db->limit(6);
		$this->db->where('tim_group_chat.status', 1);
		$this->db->select('tim_group_chat.*');
		$this->db->where('tim_group_chat_members.username', $this->session->userdata('username'));
		$this->db->order_by('tim_group_chat.last_updated', 'desc');
		$this->db->from('tim_group_chat_members');
		$this->db->join('tim_group_chat', 'tim_group_chat_members.gc_id = tim_group_chat.id');
		$res = $this->db->get()->result();
		
		if($res){
			foreach($res as $r){
				$r->last_name = '';
				$r->last_date = '';
				$r->new_flag = false;
				$this->db->where('gc_id', $r->id);
				$this->db->limit(1);
				$this->db->order_by('time', 'desc');
				$row = $this->db->get('tim_group_chat_messages')->row();
				if($row){
					$r->last_name = $row->username;
					$r->last_date = $row->time;
				}
				else{
					
				}
				
				
				
				
				//$this->db->where('gc_id', $r->id);
				//$this->db->order_by('time', 'desc');
				$r->total_replies = "";//$this->db->get('tim_group_chat_messages')->num_rows;
				
				$this->db->limit(1);
				$this->db->where('gc_id', $r->id);
				$this->db->order_by('time', 'desc');
				$last_message = $this->db->get('tim_group_chat_messages')->row();
				
				$this->db->where('gc_id', $r->id);
				$this->db->where('username', $this->session->userdata('username'));
				$r_user = $this->db->get('tim_group_chat_members')->row();
				if($r_user){
					if($last_message){
						if($r_user->last_read != $last_message->id){
							if($last_message->username == $this->session->userdata('username')){
								$r->total_replies = "";
							}
							else{
								$r->total_replies = "NEW";
							}
							
						}
					}
					else{
						if($r_user->last_read != "first"){
							if($r->username == $this->session->userdata('username')){
								$r->total_replies = "";
							}
							else{
								$r->total_replies = "NEW";
							}
							
						}
					}
				}
				
			}
		}
		
		$ajax_data['res'] = $res;
		$msg = $this->load->view('ajax_group_chat', $ajax_data, TRUE);
		
		
		return $msg;
		

		
	}
	
	function ajax_set_gc_id(){
		$gc_id = $this->input->post('gc_id');
		$this->session->set_userdata('gc_to', $gc_id);
		$data = $this->ajax_get_gc($gc_id);
		echo json_encode($data);
	}
	
	function ajax_gc_close(){
		$this->session->set_userdata('gc_to', "");
	}
	
	
	function ajax_get_gc($gc_id = null){
		//$gc_id = $this->input->post('gc_id');
		$this->db->where('id', $gc_id);
		$ajax_data['first_message'] = $this->db->get('tim_group_chat')->row();

		$this->db->where('gc_id', $gc_id);
		$this->db->order_by('time', 'asc');
		$ajax_data['all_message'] = $this->db->get('tim_group_chat_messages')->result();
		
		
		$this->db->select('tim_chat_users.*');
		$this->db->where('tim_group_chat_members.gc_id', $gc_id);
		$this->db->from('tim_group_chat_members');
		$this->db->join('tim_chat_users', 'tim_group_chat_members.username = tim_chat_users.username');
		$gc_users = $this->db->get()->result();
		
		$data['gc_users'] = "";
		
		if($gc_users){
			$last_gc = count($gc_users);
			$b = 1;
			foreach($gc_users as $gc_u){
				if($gc_u->status == 1){
					$data['gc_users'] .= '<span style=\"color: GREEN\">'.$gc_u->username.'</span>';
				}
				else{
					$data['gc_users'] .= $gc_u->username;
				}
				
				if($b++ >= $last_gc){
					
				}
				else{
					$data['gc_users'] .= ', ';
				}
			}
		}
		
		
		$this->db->where('gc_id', $gc_id);
		$this->db->where('username', $this->session->userdata('username'));
		$r_user = $this->db->get('tim_group_chat_members')->row();
		
		if($r_user){
			
			if(empty($r_user->last_read)){
				if($ajax_data['all_message']){
					$last_index = count($ajax_data['all_message']);
					$last_msg_id = $ajax_data['all_message'][$last_index - 1]->id;
				}
				else{
					$last_msg_id = 'first';
				}
				
				$this->db->where('gc_id', $gc_id);
				$this->db->where('username', $this->session->userdata('username'));
				$this->db->update('tim_group_chat_members', array('last_read' => $last_msg_id));
			}
			else{
				if($ajax_data['all_message']){
					$last_index = count($ajax_data['all_message']);
					$last_msg_id = $ajax_data['all_message'][$last_index - 1]->id;
				}
				else{
					$last_msg_id = 'first';
				}
				
				if($r_user->last_read != $last_msg_id){
					$this->db->where('gc_id', $gc_id);
					$this->db->where('username', $this->session->userdata('username'));
					$this->db->update('tim_group_chat_members', array('last_read' => $last_msg_id));
				}
			}
		}

		

		$data['msg'] = $this->load->view('ajax_gc_message', $ajax_data, TRUE);
		$data['gc_title'] = $ajax_data['first_message']->title;
		$data['creator'] = $ajax_data['first_message']->username;
		$data['time_created'] = date('d M Y h:i a', mysql_to_unix($ajax_data['first_message']->time));
		return $data;
		
		//echo json_encode($data);
		
	}
		
	function ajax_set_gc_individual(){
		$gc_to = $this->input->post('gc_to');
		$gc_msg = $this->input->post('gc_msg');
		if(!empty($gc_to) && !empty($gc_msg)){
			$this->db->insert(
				'tim_group_chat_messages',
				array(
					'gc_id'			=> $gc_to,
					'username'		=> $this->session->userdata('username'),
					'message'		=> $gc_msg,
					'time'			=> date('Y-m-d H:i:s', time())
				)
				
			);
			
			$this->db->where('id', $gc_to);
			$this->db->update(
				'tim_group_chat',
				array(
					'last_updated'	=> date('Y-m-d H:i:s', time())
				)
			);
		}
		
	}
}
