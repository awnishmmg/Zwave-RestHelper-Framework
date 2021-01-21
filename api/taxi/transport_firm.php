<?php

function transport_firm_get(){
	extract(tables);
	global $chain;
	$chain=true;

	$joins="tbl_transport_company=`transport_company_id`, `vendor_id` as transvendor_id, `sector_id`, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`,`status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at` |{$taxi_vendor}=vendor_id,role_id,mega_cat_id,plans_id,username,mobile,email,password,status,is_verified,is_starter,is_premium";

	$on = [
			$taxi_vendor =>
		    "{$taxi_vendor}.vendor_id=tbl_transport_company.vendor_id"
	     ];

	$data = inner_join($joins,$on);
	$page_url = seek_url('transport_firm');
	$total_rows = total_rows($data);

	$data=fetch_records($data);
	if(count($data)>0){ //start of if
		json_bind($data,CONST_HTTP_STATUS_OK,'All Taxi List',true,$total_rows,$page_url);

	}else{

		json_bind([],CONST_HTTP_STATUS_OK,'No Record Found',false,$total_rows,$page_url);

	}//end of else
	

}

?>