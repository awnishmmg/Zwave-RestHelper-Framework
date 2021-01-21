<?php



function role_get($columns='',$param=''){

if($columns=='' or $param == ''):
json_bind(getall('tbl_role'),CONST_HTTP_STATUS_OK,'All Roles',true);
else:
$queryobj=runsql('Select * from tbl_role');
$columns_list=$queryobj['columns_list'];

if(in_columns($columns_list,$columns)){
json_bind(select('tbl_role','',[
$columns => ['=',$param],
]),CONST_HTTP_STATUS_OK,'All Roles',true);

}else{

json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

}

endif;


}

function role_post(){

		if(insertat('tbl_role',[

			'role'=>parsejson()['role'],
			'status'=>parsejson()['status'],

		])):
			json_bind(true,CONST_HTTP_STATUS_OK,'Record inserted',true);

		else:
			
			json_bind(false,CONST_HTTP_STATUS_OK,'Record inserted failed',false);

		endif;

	}

	function role_put(){

		if(update('tbl_role',[

			'role'=>parsejson()['role'],
			'status'=>parsejson()['status'],


		],['role_id'=>parsejson()['role_id']])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Updated !',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'error',false);

		endif;

	}

	

	function role_delete(){

		if(delete('tbl_role',[

			'role_id'=>parsejson()['role_id'],

		])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Deleted',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'Error !',false);

		endif;

	}


