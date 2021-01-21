<?php


function section_product_get($meta_category='',$key='')
{
    
	global $chain;
	if($key=='')
	{
		$chain = true;
		$data = where_this(inner_join('tbl_megacategory_to_meta_key=`metakey_name`,`description`, `key_badge`, `key_heading`, `created_by`, `status`, `created_at`, `sort_order`|tbl_rel_mega_keys=`rel_mega_keys_id`, `mega_cat_id`, `meta_value`|tbl_mega_category=mega_cat_id as mega_id,title as mega_title',[
			'tbl_rel_mega_keys'=>'tbl_megacategory_to_meta_key.is_metakey_id=tbl_rel_mega_keys.is_metakey_id','tbl_mega_category'=>'tbl_mega_category.mega_cat_id=tbl_rel_mega_keys.mega_cat_id',
		]),[
			'tbl_rel_mega_keys.mega_cat_id'=>"='$meta_category'",
		]);
		json_bind(fetch_records($data),CONST_HTTP_STATUS_OK,'All Record',true);
	}
	if($key and $meta_category)
	{
	    $page_url = seek_url('homechef_section',$meta_category,$key);
		$chain = true;
		$total_rows = total_rows(where_this(inner_join('tbl_megacategory_to_meta_key=`metakey_name`,`description`, `key_badge`, `key_heading`, `created_by`, `status`, `created_at`, `sort_order`|tbl_rel_mega_keys=`rel_mega_keys_id`, `mega_cat_id`, `meta_value`|tbl_mega_category=mega_cat_id as mega_id,title as mega_title|tbl_product_mega_meta_data=product_id as pid|tbl_product=product_name,product_old_price,product_current_price,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy|tbl_shop_to_product=shop_id|tbl_shop=vendor_id as vid,shop_name,shop_mobile,shop_address,shop_open,shop_close,shop_holiday,shop_website,shop_banner,shop_display_name,shop_description,shop_unicode',[
			'tbl_rel_mega_keys'=>'tbl_megacategory_to_meta_key.is_metakey_id=tbl_rel_mega_keys.is_metakey_id','tbl_mega_category'=>'tbl_mega_category.mega_cat_id=tbl_rel_mega_keys.mega_cat_id',
			'tbl_product_mega_meta_data'=>'tbl_product_mega_meta_data.rel_mega_keys_id=tbl_rel_mega_keys.rel_mega_keys_id','tbl_product'=>'tbl_product_mega_meta_data.product_id=tbl_product.product_id',
			'tbl_shop_to_product'=>'tbl_product.product_id=tbl_shop_to_product.product_id',
			'tbl_shop'=>'tbl_shop_to_product.shop_id=tbl_shop.shop_id',
		]),[
		
			'tbl_rel_mega_keys.mega_cat_id'=>"='$meta_category' AND ",
			'tbl_megacategory_to_meta_key.metakey_name'=>"='$key'",

		]));
		$data = fetch_records(limit(where_this(inner_join('tbl_megacategory_to_meta_key=`metakey_name`,`description`, `key_badge`, `key_heading`, `created_by`, `status`, `created_at`, `sort_order`|tbl_rel_mega_keys=`rel_mega_keys_id`, `mega_cat_id`, `meta_value`|tbl_mega_category=mega_cat_id as mega_id,title as mega_title|tbl_product_mega_meta_data=product_id as pid|tbl_product=product_name,product_old_price,product_current_price,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy|tbl_shop_to_product=shop_id|tbl_shop=vendor_id as vid,shop_name,shop_mobile,shop_address,shop_open,shop_close,shop_holiday,shop_website,shop_banner,shop_display_name,shop_description,shop_unicode',[
			'tbl_rel_mega_keys'=>'tbl_megacategory_to_meta_key.is_metakey_id=tbl_rel_mega_keys.is_metakey_id','tbl_mega_category'=>'tbl_mega_category.mega_cat_id=tbl_rel_mega_keys.mega_cat_id',
			'tbl_product_mega_meta_data'=>'tbl_product_mega_meta_data.rel_mega_keys_id=tbl_rel_mega_keys.rel_mega_keys_id','tbl_product'=>'tbl_product_mega_meta_data.product_id=tbl_product.product_id',
			'tbl_shop_to_product'=>'tbl_product.product_id=tbl_shop_to_product.product_id',
			'tbl_shop'=>'tbl_shop_to_product.shop_id=tbl_shop.shop_id',
		]),[
		
			'tbl_rel_mega_keys.mega_cat_id'=>"='$meta_category' AND ",
			'tbl_megacategory_to_meta_key.metakey_name'=>"='$key'",

		])));
		json_bind($data,CONST_HTTP_STATUS_OK,'All Products',true,$total_rows,$page_url);

		
		
	}
	
}	