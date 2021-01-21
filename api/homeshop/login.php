<?php

	function login_get($columns='',$param=''){
		json_bind([],200,'UNKNOWN METHOD',false);
	}
	
	

########################### Get Request #####################

	function login_post(){

		$password = get_hash(parsejson()['password']);
		$email = parsejson()['email'];

		if(doexist('tbl_user',[
                'email'=>['=',$email],
                'password'=>['=',$password],
                'status'=> ['=','1']
		]
		)):

			$data=join2('tbl_user=user_id,name,email,mobile,status|tbl_user_auth=email_verified,otp_verified,auth_key,is_login,login_time','user_id');
			json_bind($data,200,'Login Success',true);

		else:

			json_bind([],200,'Login failed',false);

		endif;

	}
	


