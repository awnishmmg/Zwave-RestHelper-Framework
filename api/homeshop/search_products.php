<?php

function search_products_post()
{
	global $chain;
	$pname = parsejson()['search_key'];

if($pname!=''){

$condition=[
		
			'tbl_product.product_name'=>" like '%$pname%' or ",
			'tbl_product.product_description'=>" like '%$pname%' or ",
			'tbl_product.product_short_description'=>" like '%$pname%'",

		];

	$chain=true;

	$mega_data = where_this(inner_join("tbl_product=product_id,product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy|tbl_shop_to_product=shop_id as shp_id|tbl_shop=`shop_name`, `shop_mobile`, `shop_address`, `shop_latitude`, `shop_longitude`, `shop_open`, `shop_close`, `shop_holiday`, `shop_website`, `shop_url`, `shop_banner`, `shop_display_name`, `shop_description`, `shop_unicode`, `status`|tbl_vendor=mega_cat_id as m_id",
		[
			'tbl_shop_to_product'=>
			'tbl_product.product_id=tbl_shop_to_product.product_id',
			'tbl_shop'=>
			'tbl_shop_to_product.shop_id=tbl_shop.shop_id',
			'tbl_rel_product_category_subcat'=>
			'tbl_product.product_id=tbl_rel_product_category_subcat.product_id',
			'tbl_vendor'=>'tbl_vendor.vendor_id=tbl_shop.vendor_id',
	]),$condition);

json_bind(fetch_records($mega_data),CONST_HTTP_STATUS_OK,'All Search Record',true);

}
 
}



function search_products_get()
{
    json_bind([],CONST_HTTP_STATUS_OK,'UNKNOWN METHOD',true);
}