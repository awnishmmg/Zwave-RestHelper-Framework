<?php


############# Get Request #################

function vendor_get($columns='',$param=''){

if($columns=='' or $param == ''):
json_bind(getall('tbl_vendor'),CONST_HTTP_STATUS_OK,'All Vendor',true);
else:
$queryobj=runsql('Select * from tbl_vendor');
$columns_list=$queryobj['columns_list'];

if(in_columns($columns_list,$columns)){
json_bind(select('tbl_vendor','',[
$columns => ['=',$param],
]),CONST_HTTP_STATUS_OK,'All Vendor',true);

}else{

json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

}
endif;


}

############# Get Request #################
############# Post Request ################

function vendor_post(){
		$password = parsejson()['password'];
		$email = parsejson()['email'];
		$hash_pass = get_hash($password);

		if(doexist('tbl_vendor',[
		'email'=>['=',$email],
		])){
			json_bind([false],CONST_HTTP_STATUS_OK,'Email Already exist',false);
		}
		
		if(insertat('tbl_vendor',[
			'role_id'=>parsejson()['role_id'],
			'mega_cat_id'=>parsejson()['mega_cat_id'],
			'plans_id'=>parsejson()['plans_id'],
			'username'=>parsejson()['username'],
			'mobile'=>parsejson()['mobile'],
			'email'=>$email,
			'password' => $hash_pass,
			'meta_value'=>parsejson()['meta_value']

		])):

			if(insertat('tbl_vendor_auth',[
			'vendor_id'=>last_inserted_id('tbl_vendor'),
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

function vendor_put(){

		if(update('tbl_vendor',[

			'username'=>parsejson()['username'],
			'mobile'=>parsejson()['mobile'],
			'email'=>parsejson()['email']

		],['vendor_id'=>parsejson()['vendor_id']])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Updated !',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'error',false);

		endif;

	}

############# Put Request ################
############# Delete Request ################
	function vendor_delete(){

		if(delete('tbl_vendor',[

			'vendor_id'=>parsejson()['vendor_id'],

		])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Deleted',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'Error !',false);

		endif;

	}
############# Put Request ################

