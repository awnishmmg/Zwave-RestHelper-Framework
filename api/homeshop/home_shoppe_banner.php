<?php


############# Get Request #################

function home_shoppe_banner_get($columns='',$param=''){

if($columns=='' or $param == ''):
json_bind(getall('tbl_dummy_banner'),CONST_HTTP_STATUS_OK,'All Banner',true);
else:
$queryobj=runsql('Select * from tbl_dummy_banner');
$columns_list=$queryobj['columns_list'];

if(in_columns($columns_list,$columns)){
json_bind(select('tbl_dummy_banner','',[
$columns => ['=',$param],
]),CONST_HTTP_STATUS_OK,'All Banner',true);

}else{

json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

}
endif;


}

############# Get Request #################
