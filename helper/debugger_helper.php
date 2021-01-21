<?php

function prx($arg){

	echo '<pre style="background-color:yellow;font-size:1.5rem;color:red;font-weight:bold;white-space: pre-wrap;width:100%;">';
	if(is_array($arg)){

		print_r($arg);

	}else if(is_object($arg) or is_bool($arg) or is_null($arg)){

		var_dump($arg);

	}else{
		echo $arg;
	}
	echo '</pre>';
	exit;

}


function pr($arg){

	echo '<pre style="background-color:yellow;font-size:1.5rem;color:red;font-weight:bold;white-space: pre-wrap;width:100%;">';
	if(is_array($arg)){

		print_r($arg);

	}else if(is_object($arg) or is_bool($arg) or is_null($arg)){

		var_dump($arg);

	}else{
		echo $arg;
	}
	echo '</pre>';
	

}


function fpx(){


	echo '<pre style="background-color:yellow;font-size:1.5rem;color:red;font-weight:bold">';
	print_r(func_get_args());
	echo '</pre>';
	exit;



}


?>