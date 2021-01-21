<?php

$config['api_dir']='web';

$config['module_name'] = geturicount();
$config['method'] = geturicount(1);
$config['values'] = geturicount(2);

$config['default_page'] = 'index';
$config['resource'] = 'api';


function geturicount($n=0){

	global $config;
	$uri_temp=explode('/',$_SERVER['REQUEST_URI']);
	$i=0;
	foreach($uri_temp as $index => $value){
		if($value == $config['api_dir']){
			$index = $i;
			break;
		}
		$i++;
	}
	return ($index+1)+$n;
}