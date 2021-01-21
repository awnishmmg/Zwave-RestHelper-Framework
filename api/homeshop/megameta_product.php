<?php


function megameta_product_get($meta_category='',$key='')
{
	global $chain;
	if($key=='' or $meta_category=='')
	{
		$chain = true;
		$data = fetch_records(distinct(poly_join("tbl_product_meta_data=prod_meta_id,product_id as product_meta_product_id,in_offer_id as product_meta_offer_id,is_metakey_id as product_meta_metakey_id,rel_pair as product_meta_rel_pair|tbl_product_to_meta_key=metakey_name as url_keys,description as meta_descrption,status as meta_satus,key_badge,key_heading,sort_order",['is_metakey_id'],'left'),'tbl_product_to_meta_key.metakey_name'));
		//prx($data);
		json_bind($data,CONST_HTTP_STATUS_OK,'All Record',true);
	}
	else if($key and $meta_category)
	{
		
		//$chain = true;
		$data = poly_join("tbl_product_meta_data=prod_meta_id,product_id as product_meta_product_id,in_offer_id as product_meta_offer_id,is_metakey_id as product_meta_metakey_id,rel_pair as product_meta_rel_pair|tbl_product=product_id as pid,product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy,product_total_view|tbl_product_to_meta_key=metakey_name,description as meta_description,status as meta_satus,sort_order|tbl_shop_to_product=shop_id|tbl_shop=vendor_id as vid,shop_name,shop_mobile,shop_address,shop_open,shop_close,shop_holiday,shop_website,shop_banner,shop_display_name,shop_description,shop_unicode|tbl_vendor=username,mega_cat_id|tbl_mega_category=name",['product_id','is_metakey_id','product_id','shop_id','vendor_id','mega_cat_id'],'inner',['tbl_product_to_meta_key.metakey_name'=>['=',$key],'tbl_mega_category.name'=>['=',$meta_category]]);
	//prx($data);
		json_bind($data,CONST_HTTP_STATUS_OK,'All Record ',true);
	}
	
	
}