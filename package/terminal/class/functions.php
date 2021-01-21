<?php
$command=$argv[1];


function input($msg){
	echo "{$msg} :";
	$input=fgets(STDIN,1024);
	return trim($input);
}

