<?php

include 'config/autoloader.php';

$uri = $_SERVER['REQUEST_URI'];

$slugs=explode('/',$uri);
@$values = array();

@$module_name = $slugs[$config['module_name']];
@$method = $slugs[$config['method']];

for($i=$config['values'];$i<count($slugs);$i++){

			$values[]= $slugs[$i];
}

if($method==NULL){
	@$method = $config['default_page'];
}

$base = __DIR__.'/'.$config['resource'].'/';
$resource = $base.$module_name.'/'.$method.'.php';

if(file_exists($resource)):
	require_once $resource;
else:

json_bind(array('error'=>'unknown method'),201,'resource not found or donot exist',false);

endif;

switch ($_SERVER['REQUEST_METHOD']){

		case 'POST':
		$define_func=strtolower($method).'_'.strtolower($_SERVER['REQUEST_METHOD']);
		@call_user_func_array($define_func,$values);
		break;

		case 'DELETE':
		$define_func=strtolower($method).'_'.strtolower($_SERVER['REQUEST_METHOD']);
		@call_user_func_array($define_func,$values);
		break;

		case 'PUT':
		$define_func=strtolower($method).'_'.strtolower($_SERVER['REQUEST_METHOD']);
		@call_user_func_array($define_func,$values);
		break;

		default:
		$define_func=strtolower($method).'_'.strtolower($_SERVER['REQUEST_METHOD']);
		@call_user_func_array($define_func,$values);
		break;
}	



?>


