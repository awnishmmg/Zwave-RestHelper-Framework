<?php

// config for password salt

$config['password_salt'] = 'easybuk#_^2020';

// default encryption type

####################################

#$config['default_enc_pass'] = md5 
#$config['default_enc_pass'] = sha1 



####################################

$config['default_enc_pass'] = 'md5';


$config['default_controller']= 'home';

######################################################

#session keys

######################################################

$config['session_keys'] = array(
	'admin_controller'=> 'admin@123',
	'user_controller'  => 'user@123',
	'home_controller'  => 'user@123',

################################### user ###############################

	'home-shoppe_controller'=>'user@123',
	'home-chefs_controller'=>'user@123',
	'shops_controller'=>'user@123',
	'job_controller'=>'user@123',
	'cab_controller'=>'user@123',
	'service_controller'=>'user@123',
	'restaurants_controller'=>'user@123',
################################### user ##############################
);


######################################################

#redirect urls

######################################################
$config['session_redirect_urls'] = array(

	'admin_controller'=> 'admin/login',
	'user_controller'  => 'user/login',
);
