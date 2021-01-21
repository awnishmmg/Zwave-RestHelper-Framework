<?php

if(php_sapi_name()==="cli"){
	echo "Running from CLI"; 
  	include __DIR__.'/commands.php';
}
else 
  echo(" ▬▬ Web Terminal ▬▬ \n\n");

function create_table(){

echo "create table running";

}