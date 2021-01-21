<?php


############# Get Request #################

function shops_get($columns='',$param=''){
if($columns and $param)
{
	$page_url=seek_url('all_shops',$columns,$param);
}
else
{
	$page_url=seek_url('all_shops');
}
global $chain;
$chain = true;

if($columns=='' or $param == ''):
$total_rows = total_rows(getall('tbl_shop'));
$data = fetch_records(limit(getall('tbl_shop')));
json_bind($data,CONST_HTTP_STATUS_OK,'All Shops',true,$total_rows,$page_url);
else:
$queryobj=runsql('Select * from tbl_shop');
$columns_list=$queryobj['columns_list'];

if(in_columns($columns_list,$columns)){
$total_rows = total_rows(select('tbl_shop','',[
$columns => ['=',$param],
]));
$data = fetch_records(limit(select('tbl_shop','',[
$columns => ['=',$param],
])));
//prx($data);
json_bind($data,CONST_HTTP_STATUS_OK,'All Categories List',true,$total_rows,$page_url);
}else{

json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

}
endif;


}

############# Get Request #################
############# Post Request ################

function shops_post(){

		if(insertat('tbl_shop',[

			'vendor_id'=>parsejson()['vendor_id'],
			'shop_name'=>parsejson()['shop_name'],
			'shop_mobile'=>parsejson()['shop_mobile'],
			'shop_address'=>parsejson()['shop_address'],
			'shop_latitude'=>parsejson()['shop_latitude'],
			'shop_longitude'=>parsejson()['shop_longitude'],
			'shop_open'=>parsejson()['shop_open'],
			'shop_close'=>parsejson()['shop_close'],
			'shop_holiday'=>parsejson()['shop_holiday'],
			'shop_website'=>parsejson()['shop_website'],
			'shop_url'=>parsejson()['shop_url'],
			'shop_banner'=>parsejson()['shop_banner'],
			'shop_display_name'=>parsejson()['shop_display_name'],
			'shop_description'=>parsejson()['shop_description'],
			'shop_unicode'=>parsejson()['shop_unicode']

		])):

			json_bind(true,200,'Record inserted',true);

		else:

			json_bind(false,200,'Error !',false);

		endif;

	}
############# Post Request ################

############# Put Request #################

function shops_put(){

		if(update('tbl_shop',[

			'shop_name'=>parsejson()['shop_name'],
			'shop_mobile'=>parsejson()['shop_mobile'],
			'shop_address'=>parsejson()['shop_address'],
			'shop_latitude'=>parsejson()['shop_latitude'],
			'shop_longitude'=>parsejson()['shop_longitude'],
			'shop_open'=>parsejson()['shop_open'],
			'shop_close'=>parsejson()['shop_close'],
			'shop_holiday'=>parsejson()['shop_holiday'],
			'shop_website'=>parsejson()['shop_website'],
			'shop_url'=>parsejson()['shop_url'],
			'shop_banner'=>parsejson()['shop_banner'],
			'shop_display_name'=>parsejson()['shop_display_name'],
			'shop_description'=>parsejson()['shop_description'],
			'shop_unicode'=>parsejson()['shop_unicode']

		],['shop_id'=>parsejson()['shop_id']])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Updated !',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'Error !',false);

		endif;

	}

############# Put Request ################
############# Delete Request ################
	function shops_delete(){

		if(delete('tbl_shop',[

			'shop_id'=>parsejson()['shop_id'],

		])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Deleted',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'Error !',false);

		endif;

	}
############# Put Request ################

