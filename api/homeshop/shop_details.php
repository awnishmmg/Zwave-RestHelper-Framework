<?php


function shop_details_get($shop_id='')
{
	if(empty($shop_id))
	{
		json_bind([],CONST_HTTP_STATUS_OK,'Please Pass Shop id',true);
	}
	if(isset($shop_id))
	{
		global $chain;
		$chain = true;
		$data = fetch_records(where_this(getall('tbl_shop'),[
			'tbl_shop.shop_id'=>"='$shop_id'",
		]));
		json_bind($data,CONST_HTTP_STATUS_OK,'Please Pass Shop id',true);
	}
}