<?php
$package = include('loader.php');

foreach ($package as $folder => $file){
		include("{$folder}/$file");
}
