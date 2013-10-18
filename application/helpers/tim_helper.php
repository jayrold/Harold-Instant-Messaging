<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//check if user is logged in
if(!function_exists('is_logged_in')) {
	function is_logged_in(){
		$CI =& get_instance();
		if(!$CI->session->userdata('username')){
			if(isset($_COOKIE["ttm_remember_me"])){
				$data = explode(',',$_COOKIE["ttm_remember_me"], 2);
				if($data[0] != ''){
					$user = $CI->db->select('username, key')->get_where('tim_chat_users',array('username' => $data[0], 'token' => $data[1]))->row();
					if($user){
						$CI->session->set_userdata(array('username' => $user->username));
						$CI->session->set_userdata(array('key' => $user->key));
						return TRUE;
					}
				}
			}
		} 
		
		else{
			return TRUE;
		}
		return FALSE;
	}
}