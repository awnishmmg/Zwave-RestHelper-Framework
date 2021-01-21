<?php



function apidoc_get($columns='',$param=''){

if($columns=='' or $param == ''):

$data=join2('tbl_apidoc_headers=header_id,base,title,description,status|tbl_apidoc=apidoc_id,http,method,routes,label,keyname,response_type,description','header_id');

json_bind($data,CONST_HTTP_STATUS_OK,'All Roles',true);

else:

$data=join2('tbl_apidoc_headers=header_id,base,title,description,status|tbl_apidoc=apidoc_id,http,method,routes,label,keyname,response_type,description','header_id');

$columns_list = array_keys($data[0]);

if(in_columns($columns_list,$columns)){
	$data=join2('tbl_apidoc_headers=header_id,base,title,description,status|tbl_apidoc=apidoc_id,http,method,routes,label,keyname,response_type,description','header_id',[
$columns => ['=',$param],
]);

json_bind($data,CONST_HTTP_STATUS_OK,'All Roles',true);

 }else{

json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);
}

endif;


}

function apidoc_post(){

		if(insertat('tbl_apidoc_headers',[

			'base'=>parsejson()['base'],
			'title'=>parsejson()['title'],
			'description'=>parsejson()['description'],
			'created_by'=>parsejson()['created_by'],

		])):
			if(insertat('tbl_apidoc',[
			'header_id'=>last_inserted_id('tbl_apidoc_headers'),
			'http'=>parsejson()['http'],
			'method'=>parsejson()['method'],
			'routes'=>parsejson()['routes'],
			'label'=>parsejson()['label'],
			'keyname'=>parsejson()['keyname'],
			'response_type'=>parsejson()['response_type'],
			'description'=>parsejson()['description'],
		])):
				json_bind(true,CONST_HTTP_STATUS_OK,'Record inserted',true);

		else:
				json_bind(false,CONST_HTTP_STATUS_OK,'Record Not Inserted',false);

		endif;

		else:
			
			json_bind(false,CONST_HTTP_STATUS_OK,'Record Not Inserted',false);

		endif;

	}

	function apidoc_put(){

		if(update('tbl_role',[

			'role'=>parsejson()['role'],
			'status'=>parsejson()['status'],


		],['role_id'=>parsejson()['role_id']])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Updated !',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'error',false);

		endif;

	}

	

	function apidoc_delete(){

		if(delete('tbl_role',[

			'role_id'=>parsejson()['role_id'],

		])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Deleted',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'Error !',false);

		endif;

	}

######Remaining PUT and Delete
