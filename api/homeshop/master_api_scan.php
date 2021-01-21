<?php

errors_log();

function master_api_scan_get(){

$not_allowed=[basename(__FILE__,'.php'),'index'];

		$api_path=__DIR__;
		$api_files=scandir($api_path);
		unset($api_files[0],$api_files[1]);
		   foreach($api_files as $i => $filename){
		    if(in_array(basename($filename,'.php'),$not_allowed)){
		        unset($api_files[$i]);
		    }
		 }

		foreach($api_files as $index => $values){

		    $base[] = basename($values,'.php');
		}
		json_bind($base,CONST_HTTP_STATUS_OK,'List of All Api`s',true,

		['no_pages'=>count($base)]);


}