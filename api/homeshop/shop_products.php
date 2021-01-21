<?php

function shop_products_get($shop_id='')
{
	global $chain;
	$chain = true;


	if($shop_id==''):
		$page_url = seek_url('shop_product');
		$total_rows = total_rows(getall('tbl_product'));
		$data = fetch_records(limit(getall('tbl_product')));
		json_bind($data,CONST_HTTP_STATUS_OK,'All Products',true,$total_rows,$page_url);
	else:
		$page_url = seek_url('shop_product',$shop_id);
		$total_rows = total_rows(poly_join("tbl_shop_to_product=product_id|tbl_product=product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy,product_total_view",['product_id'],'left',['tbl_shop_to_product.shop_id'=>['=',$shop_id]]));

		$data = fetch_records(limit(poly_join("tbl_shop_to_product=product_id|tbl_product=product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy,product_total_view",['product_id'],'left',['tbl_shop_to_product.shop_id'=>['=',$shop_id]])));
		json_bind($data,CONST_HTTP_STATUS_OK,'All Products',true,$total_rows,$page_url);
	endif;
}