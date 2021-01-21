<?php


if(!function_exists('upload_raw')){

	function upload_raw($raw_source,$path='uploads',$ext=''){	

	//while Uploading the data from url 

    $decode_file = base64_decode($raw_source);

    $directory = dirname(__DIR__).'/'.$path;
    $filename = date('y-m-d').date('h-i-s-a').'-'.rand(11111,99999);

    if($ext==''):

		$f = finfo_open();
		$mime_type = finfo_buffer($f, $decode_file, FILEINFO_MIME_TYPE);
		$ext_arr =explode('/',$mime_type);
		$ext = '.'.end($ext_arr);

    endif;

    $file  = $directory.'/'.$filename.$ext;

    if(file_put_contents($file, $decode_file)){

    	return $filename.$ext;

    }else{

    	return false;
    }



}

}
