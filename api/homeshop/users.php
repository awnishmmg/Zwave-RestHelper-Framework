<?php


############# Get Request #################

function users_get($columns='',$param=''){

if($columns=='' or $param == ''):
json_bind(getall('tbl_user'),CONST_HTTP_STATUS_OK,'All Users',true);
else:
$queryobj=runsql('Select * from tbl_user');
$columns_list=$queryobj['columns_list'];

if(in_columns($columns_list,$columns)){
json_bind(select('tbl_user','',[
$columns => ['=',$param],
]),CONST_HTTP_STATUS_OK,'All Users',true);

}else{

json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

}
endif;


}

############# Get Request #################
############# Post Request ################

function users_post(){
		$password = parsejson()['password'];
		$email = parsejson()['email'];
		$hash_pass = get_hash($password);

		if(doexist('tbl_user',[
		'email'=>['=',$email],
		])){
			json_bind([false],CONST_HTTP_STATUS_OK,'Email Already exist',false);
		}
		
		if(insertat('tbl_user',[
			'role_id'=>parsejson()['role_id'],
			'name'=>parsejson()['name'],
			'email'=>$email,
			'mobile'=>parsejson()['mobile'],
			'password' => $hash_pass,
			'status'=>'1',
		])):

			if(insertat('tbl_user_auth',[
			'user_id'=>last_inserted_id('tbl_user'),
		])):
				json_bind(true,CONST_HTTP_STATUS_OK,'Record inserted',true);

		else:
				json_bind(false,CONST_HTTP_STATUS_OK,'Record Not Inserted',false);

		endif;

		else:
			
			json_bind(false,CONST_HTTP_STATUS_OK,'Record Not Inserted',false);

		endif;

	}
############# Post Request ################

############# Put Request #################

function users_put(){

		if(update('tbl_user',[

			'name'=>parsejson()['name'],
			'mobile'=>parsejson()['mobile'],

		],['user_id'=>parsejson()['user_id']])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Updated !',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'error',false);

		endif;

	}

############# Put Request ################
############# Delete Request ################
	function users_delete(){

		if(delete('tbl_user',[

			'user_id'=>parsejson()['user_id'],

		])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Deleted',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'Error !',false);

		endif;

	}
############# Put Request ################

