<?php
define("TERMINAL_ROOT",dirname(__FILE__));

spl_autoload_register(function($class){
	if(file_exists(TERMINAL_ROOT."/class/{$class}.php")){
		include TERMINAL_ROOT."/class/{$class}.php";
	}else{
		
		die("* $class Invalid Class");
	}
		
});