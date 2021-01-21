<?php


if(!function_exists('get_hash')){

	function get_hash($userarg){
     global $config;

    $hash=$config['password_salt'];
    $enc_func_name = $config['default_enc_pass'];

    $mysalt=call_user_func_array($enc_func_name,array($hash));
    $defaultsalt=call_user_func_array($enc_func_name,array($userarg));

    $new_salt = $defaultsalt.$mysalt;
    return $new_salt;

	}

	
}
if(!function_exists('set_hash')){

	function set_hash($hash){

	    $ci=&get_instance();
	    $ci->config->load('custom/auth');
	    $ci->config->set_item('password_salt',$hash);
	}
}



?>