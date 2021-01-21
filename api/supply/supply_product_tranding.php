<?php


function supply_product_tranding_get($meta_category='',$key='')
{
	$tbl_megacategory_to_meta_key=tables['tbl_megacategory_to_meta_key'];
	$tbl_mega_category=tables['tbl_mega_category'];
	$tbl_rel_mega_keys=tables['tbl_rel_mega_keys'];

	global $chain;
	$chain = true;
	
	if($key=='')
	{

	   $chain = true;
		
		$data = where_this(inner_join("$tbl_megacategory_to_meta_key=`metakey_name`,`description`, `key_badge`, `key_heading`, `created_by`, `status`, `created_at`, `sort_order`|$tbl_rel_mega_keys=`rel_mega_keys_id`, `mega_cat_id`, `meta_value`|$tbl_mega_category=mega_cat_id as mega_id,title as mega_title",
			[
			"$tbl_rel_mega_keys"=>"$tbl_megacategory_to_meta_key.is_metakey_id=$tbl_rel_mega_keys.is_metakey_id",
			"$tbl_mega_category"=>"$tbl_mega_category.mega_cat_id=$tbl_rel_mega_keys.mega_cat_id",
			]),[
		
			"$tbl_rel_mega_keys.mega_cat_id"=>"='$meta_category'",

		]);

	
		json_bind(fetch_records($data),CONST_HTTP_STATUS_OK,'All Keys',true);
	}
	if($key and $meta_category)
	{
	    $page_url =seek_url('supply_supply_tranding',$meta_category,$key);

	    
	  
		$chain = true;
		$total_rows = total_rows(where_this(inner_join("$tbl_megacategory_to_meta_key=`metakey_name`,`description`, `key_badge`, `key_heading`, `created_by`, `status`, `created_at`, `sort_order`|$tbl_rel_mega_keys=`rel_mega_keys_id`, `mega_cat_id`, `meta_value`|$tbl_mega_category=mega_cat_id as mega_id,title as mega_title|tbl_supply_to_meta_data=`sup_mega_id`, `suppleir_product_id`, `rel_mega_keys_id`, `meta_value`|
		    tbl_suppleir_product=`suppleir_product_id`, `supplier_id`, `suppleir_product_name`, `suppleir_product_old_price`, `suppleir_product_current_price`, `suppleir_product_qty`, `suppleir_product_net_wt`, `suppleir_product_gros_wt`, `suppleir_product_featured_photo`, `suppleir_product_description`, `suppleir_product_short_description`, `suppleir_product_feature`, `suppleir_product_condition`, `suppleir_product_return_policy`, `suppleir_product_total_view`, `suppleir_product_is_featured`, `suppleir_product_is_active`, `status`, `created_by`, `created_at`, `suppleir_product_filter_price`, `unit`
		    |tbl_supplier=`supplier_id`, `vendor_id`, `supplier_name`, `supplier_mobile`, `supplier_address`, `supplier_latitude`, `supplier_longitude`, `supplier_open`, `supplier_close`, `supplier_holiday`, `supplier_website`, `supplier_url`, `supplier_banner`, `supplier_display_name`, `supplier_description`, `supplier_unicode`, `status`, `created_by`, `created_at`",[
			'$tbl_rel_mega_keys'=>'$tbl_megacategory_to_meta_key.is_metakey_id=$tbl_rel_mega_keys.is_metakey_id','$tbl_mega_category'=>'$tbl_mega_category.mega_cat_id=$tbl_rel_mega_keys.mega_cat_id',
			'tbl_supply_to_meta_data'=>'tbl_supply_to_meta_data.rel_mega_keys_id=$tbl_rel_mega_keys.rel_mega_keys_id','tbl_suppleir_product'=>'tbl_supply_to_meta_data.suppleir_product_id=tbl_suppleir_product.suppleir_product_id',
			'tbl_supplier'=>'tbl_suppleir_product.supplier_id=tbl_supplier.supplier_id',
		]),[
		
			"$tbl_rel_mega_keys.mega_cat_id"=>"='$meta_category' AND ",
			"$tbl_megacategory_to_meta_key.metakey_name"=>"='$key'",

		])); 
		
		$data = limit(where_this(inner_join("$tbl_megacategory_to_meta_key=`metakey_name`,`description`, `key_badge`, `key_heading`, `created_by`, `status`, `created_at`, `sort_order`|$tbl_rel_mega_keys=`rel_mega_keys_id`, `mega_cat_id`, `meta_value`|$tbl_mega_category=mega_cat_id as mega_id,title as mega_title|tbl_supply_to_meta_data=`sup_mega_id`, `suppleir_product_id`, `rel_mega_keys_id`, `meta_value`|
		    tbl_suppleir_product=`suppleir_product_id`, `supplier_id`, `suppleir_product_name`, `suppleir_product_old_price`, `suppleir_product_current_price`, `suppleir_product_qty`, `suppleir_product_net_wt`, `suppleir_product_gros_wt`, `suppleir_product_featured_photo`, `suppleir_product_description`, `suppleir_product_short_description`, `suppleir_product_feature`, `suppleir_product_condition`, `suppleir_product_return_policy`, `suppleir_product_total_view`, `suppleir_product_is_featured`, `suppleir_product_is_active`, `status`, `created_by`, `created_at`, `suppleir_product_filter_price`, `unit`
		    |tbl_supplier=`supplier_id`, `vendor_id`, `supplier_name`, `supplier_mobile`, `supplier_address`, `supplier_latitude`, `supplier_longitude`, `supplier_open`, `supplier_close`, `supplier_holiday`, `supplier_website`, `supplier_url`, `supplier_banner`, `supplier_display_name`, `supplier_description`, `supplier_unicode`, `status`, `created_by`, `created_at`",[
		"$tbl_rel_mega_keys"=>"$tbl_megacategory_to_meta_key.is_metakey_id=$tbl_rel_mega_keys.is_metakey_id",
		"$tbl_mega_category"=>"$tbl_mega_category.mega_cat_id=$tbl_rel_mega_keys.mega_cat_id",
			'tbl_supply_to_meta_data'=>"tbl_supply_to_meta_data.rel_mega_keys_id=$tbl_rel_mega_keys.rel_mega_keys_id",'tbl_suppleir_product'=>'tbl_supply_to_meta_data.suppleir_product_id=tbl_suppleir_product.suppleir_product_id',
			'tbl_supplier'=>'tbl_suppleir_product.supplier_id=tbl_supplier.supplier_id',
		]),[
		
			"$tbl_rel_mega_keys.mega_cat_id"=>"='$meta_category' AND ",
			"$tbl_megacategory_to_meta_key.metakey_name"=>"='$key'",

		]));
	   	
		json_bind(fetch_records($data),CONST_HTTP_STATUS_OK,'All Suppleir',true,$total_rows,$page_url);

		
		
	}
	
}