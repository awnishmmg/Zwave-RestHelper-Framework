<?php

$hostname = $db_config['hostname'];
$username = $db_config['username'];
$password = $db_config['password'];

$dbname= DBEnv();

$con=mysqli_connect($hostname,$username,$password,$dbname);
if(!$con){

		echo 'Connection Error'.mysqli_error($con);
		exit;

}else{
	#echo 'Connection created'.mysqli_error($con);
}


 ?>