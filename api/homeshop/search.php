<?php

function search_get()
{
	global $chain;
	

	$data = poly_join("tbl_mega_category=name as mega_name,mega_cat_id as mega_id|tbl_category=title as cat_title,cat_id as categoryid|tbl_subcategory=subcategory,subcat_id as subcategory_id",['mega_cat_id','cat_id'],'left');

	$mega_data['categories'] = $data;

	$chain = false;
	$shop = select_from('tbl_shop','shop_id,shop_name,shop_banner');
	//prx($shop);
	$mega_data['shops']= $shop;

	$products = poly_join("tbl_product=product_id,product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy|tbl_shop_to_product=shop_id as shp_id|tbl_shop=`shop_name`, `shop_mobile`, `shop_address`, `shop_latitude`, `shop_longitude`, `shop_open`, `shop_close`, `shop_holiday`, `shop_website`, `shop_url`, `shop_banner`, `shop_display_name`, `shop_description`, `shop_unicode`, `status`",['product_id','shop_id'],'left');
	
	$mega_data['products']= $products;
	json_bind($mega_data,CONST_HTTP_STATUS_OK,'All Search Record',true);
}