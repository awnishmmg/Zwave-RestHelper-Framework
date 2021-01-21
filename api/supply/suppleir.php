<?php


############# Get Request #################

function suppleir_get($columns='',$param=''){
if($columns and $param)
{
	$page_url=seek_url('supplier',$columns,$param);
}
else
{
	$page_url=seek_url('supplier');
}
global $chain;
$chain = true;

if($columns=='' or $param == ''):
$total_rows = total_rows(getall('tbl_supplier'));
$data = fetch_records(limit(getall('tbl_supplier')));
json_bind($data,CONST_HTTP_STATUS_OK,'All suppleir',true,$total_rows,$page_url);
else:
$queryobj=runsql('Select * from tbl_supplier');
$columns_list=$queryobj['columns_list'];

if(in_columns($columns_list,$columns)){
$total_rows = total_rows(select('tbl_supplier','',[
$columns => ['=',$param],
]));
$data = fetch_records(limit(select('tbl_supplier','',[
$columns => ['=',$param],
])));
//prx($data);
json_bind($data,CONST_HTTP_STATUS_OK,'All Shop',true,$total_rows,$page_url);
}else{

json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

}
endif;


}

############# Get Request #################
############# Post Request ################

function suppleir_post(){

		if(insertat('tbl_supplier',[
          'vendor_id'=>parsejson()['vendor_id'],
		   'supplier_name'=>parsejson()['supplier_name'],
		   'supplier_mobile'=>parsejson()['supplier_mobile'],
		  'supplier_address'=>parsejson()['supplier_address'],
		  'supplier_latitude'=>parsejson()['supplier_latitude'],
		  'supplier_longitude'=>parsejson()['supplier_longitude'],
		  'supplier_open'=>parsejson()['supplier_open'],
		  'supplier_close'=>parsejson()['supplier_close'],
		  'supplier_holiday'=>parsejson()['supplier_holiday'],
		  'supplier_website'=>parsejson()['supplier_websit'],
		  'supplier_url'=>parsejson()['supplier_url'],
		  'supplier_banner'=>parsejson()['supplier_banner'],
		  'supplier_display_name'=>parsejson()['supplier_display_name'],
		  'supplier_description'=>parsejson()['supplier_description'],
		  'supplier_unicode'=>parsejson()['supplier_unicode'],

		])):
			

			json_bind(true,200,'Record inserted',true);

		else:

			json_bind(false,200,'Error !',false);

		endif;

	}
############# Post Request ################

############# Put Request #################

function suppleir_put(){

		if(update('tbl_supplier',[

			
		  'vendor_id'=>parsejson()['vendor_id'],
		   'supplier_name'=>parsejson()['supplier_name'],
		   'supplier_mobile'=>parsejson()['supplier_mobile'],
		  'supplier_address'=>parsejson()['supplier_address'],
		  'supplier_latitude'=>parsejson()['supplier_latitude'],
		  'supplier_longitude'=>parsejson()['supplier_longitude'],
		  'supplier_open'=>parsejson()['supplier_open'],
		  'supplier_close'=>parsejson()['supplier_close'],
		  'supplier_holiday'=>parsejson()['supplier_holiday'],
		  'supplier_website'=>parsejson()['supplier_websit'],
		  'supplier_url'=>parsejson()['supplier_url'],
		  'supplier_banner'=>parsejson()['supplier_banner'],
		  'supplier_display_name'=>parsejson()['supplier_display_name'],
		  'supplier_description'=>parsejson()['supplier_description'],
		  'supplier_unicode'=>parsejson()['supplier_unicode'],

		],['suppleir_id'=>parsejson()['suppleir_id']])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Updated !',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'Error !',false);

		endif;

	}

############# Put Request ################
############# Delete Request ################
	function suppleir_delete(){

		if(delete('tbl_supplier',[

			'suppleir_id'=>parsejson()['suppleir_id'],

		])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Deleted',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'Error !',false);

		endif;

	}
############# Put Request ################

