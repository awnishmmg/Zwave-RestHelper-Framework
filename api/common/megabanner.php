<?php

function megabanner_get($columns='',$param=''){

if($columns=='' or $param == ''):
json_bind(getall('tbl_mega_data_banner'),CONST_HTTP_STATUS_OK,'All Roles',true);
else:
$queryobj=runsql('Select * from tbl_mega_data_banner');
$columns_list=$queryobj['columns_list'];

if(in_columns($columns_list,$columns)){
json_bind(select('tbl_mega_data_banner','',[
$columns => ['=',$param],
]),CONST_HTTP_STATUS_OK,'All Banner',true);

}else{

json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

}

endif;


}

function megabanner_post(){

		if(insertat('tbl_mega_data_banner',[

			'mega_cat_id'=>parsejson()['mega_cat_id'],
			'banner_title'=>parsejson()['banner_title'],
			'banner_slogan'=>parsejson()['banner_slogan'],
			'banner_resource'=>parsejson()['banner_resource'],
			'banner_redirect'=>parsejson()['banner_redirect']

		])):
			json_bind(true,CONST_HTTP_STATUS_OK,'Record inserted',true);

		else:
			
			json_bind(false,CONST_HTTP_STATUS_OK,'Record inserted failed',false);

		endif;

	}

	function megabanner_put(){

		if(update('tbl_mega_data_banner',[

			'mega_cat_id'=>parsejson()['mega_cat_id'],
			'banner_title'=>parsejson()['banner_title'],
			'banner_slogan'=>parsejson()['banner_slogan'],
			'banner_resource'=>parsejson()['banner_resource'],
			'banner_redirect'=>parsejson()['banner_redirect'],
			'status'=>parsejson()['status'],


		],['role_id'=>parsejson()['role_id']])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Updated !',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'error',false);

		endif;

	}

	

	function megabanner_delete(){

		if(delete('tbl_mega_data_banner',[

			'banner_id'=>parsejson()['banner_id'],

		])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Deleted',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'Error !',false);

		endif;

	}


