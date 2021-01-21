<?php



function product_enquiry_get($columns='',$param=''){

if($columns=='' or $param == ''):
json_bind(getall('tbl_product_enquiry'),CONST_HTTP_STATUS_OK,'All Enquiry For Admin',true);
else:
$queryobj=runsql('Select * from tbl_product_enquiry');
$columns_list=$queryobj['columns_list'];

if(in_columns($columns_list,$columns)){
json_bind(select('tbl_product_enquiry','',[
$columns => ['=',$param],
]),CONST_HTTP_STATUS_OK,'Enquiry',true);

}else{

json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

}

endif;


}

function product_enquiry_post(){
date_default_timezone_set("Asia/Kolkata");
$date = date("y-m-d");
$time = date("h:i:s:a");

if(insertat('tbl_product_enquiry',[


'shop_id'=>parsejson()['shop_id'],
'product_id'=>parsejson()['product_id'],
'user_id'=>parsejson()['user_id'],
'enq_set_id'=>'',
'full_name'=>parsejson()['full_name'],
'email'=>parsejson()['email'],
'phone'=>parsejson()['phone'],
'enquiry'=>parsejson()['enquiry'],
'enq_date'=>$date,
'enq_time'=>$time,

])):
json_bind(true,CONST_HTTP_STATUS_OK,'Enquiry Submitted',true);

else:

json_bind([],200,'Failed',false);

endif;

}

function product_enquiry_put(){

json_bind([],CONST_HTTP_STATUS_OK,'UNKNOWN METHOD',false);

}



function product_enquiry_delete(){

if(delete('tbl_product_enquiry',[

'prod_enq_id'=>parsejson()['prod_enq_id'],

])):

json_bind(true,CONST_HTTP_STATUS_OK,'Record Deleted',true);

else:

json_bind([],CONST_HTTP_STATUS_OK,'Error !',false);

endif;

}

