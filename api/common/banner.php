<?php


############# Get Request #################

function banner_get($columns='',$param=''){

if($columns=='' or $param == ''):
json_bind(getall('tbl_banner_slider'),CONST_HTTP_STATUS_OK,'All Banner',true);
else:
$queryobj=runsql('Select * from tbl_banner_slider');
$columns_list=$queryobj['columns_list'];

if(in_columns($columns_list,$columns)){
json_bind(select('tbl_banner_slider','',[
$columns => ['=',$param],
]),CONST_HTTP_STATUS_OK,'All Banner',true);

}else{

json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

}
endif;


}

############# Get Request #################
############# Post Request ################

function banner_post(){

		if(insertat('tbl_banner_slider',[

			'frontend_master_id'=>parsejson()['frontend_master_id'],
			'banner_title'=>parsejson()['banner_title'],
			'banner_slogan'=>parsejson()['banner_slogan'],
			'banner_resource'=>parsejson()['banner_resource'],
			'banner_redirect'=>parsejson()['banner_redirect'],
			'created_by'=>parsejson()['created_by']

		])):

			json_bind(true,200,'Sub Category inserted',true);

		else:

			json_bind(false,200,'Sub Category failed',false);

		endif;

	}
############# Post Request ################

############# Put Request #################

function banner_put(){

		if(update('tbl_banner_slider',[

			'banner_title'=>parsejson()['banner_title'],
			'banner_slogan'=>parsejson()['banner_slogan'],
			'banner_resource'=>parsejson()['banner_resource'],
			'banner_redirect'=>parsejson()['banner_redirect'],
			'status'=>parsejson()['status'],
			'created_by'=>parsejson()['created_by']

		],['banner_slider_id'=>parsejson()['banner_slider_id']])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Updated !',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'error',false);

		endif;

	}

############# Put Request ################
############# Delete Request ################
	function banner_delete(){

		if(delete('tbl_banner_slider',[

			'banner_slider_id'=>parsejson()['banner_slider_id'],

		])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Deleted',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'Error !',false);

		endif;

	}
############# Put Request ################

