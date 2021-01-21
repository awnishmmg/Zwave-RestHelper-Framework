<?php


############# Get Request #################

   function supply_product_get($suppleir_id='')
{
	global $chain;
	$chain = true;


	if($suppleir_id==''):
		$page_url = seek_url('supply_product');
		$total_rows = total_rows(getall('tbl_suppleir_product'));
		$data = fetch_records(limit(getall('tbl_suppleir_product')));

		json_bind($data,CONST_HTTP_STATUS_OK,'All Products',true,$total_rows,$page_url);
	else:


		$page_url = seek_url('supply_product',$suppleir_id);
		$total_rows = total_rows(inner_join("tbl_supplier=supplier_id, `vendor_id`, `supplier_name`, `supplier_mobile`, `supplier_address`, `supplier_latitude`, `supplier_longitude`, `supplier_open`, `supplier_close`, `supplier_holiday`, `supplier_website`, `supplier_url`, `supplier_banner`, `supplier_display_name`, `supplier_description`, `supplier_unicode`|tbl_suppleir_product= `suppleir_product_id`, `supplier_id`, `suppleir_product_name`, `suppleir_product_old_price`, `suppleir_product_current_price`, `suppleir_product_qty`, `suppleir_product_net_wt`, `suppleir_product_gros_wt`, `suppleir_product_featured_photo`, `suppleir_product_description`, `suppleir_product_short_description`, `suppleir_product_feature`, `suppleir_product_condition`, `suppleir_product_return_policy`, `suppleir_product_total_view`, `suppleir_product_is_featured`, `suppleir_product_is_active`, `status`, `created_by`, `created_at`, `suppleir_product_filter_price`, `unit`",['supplier_id'],'left',['tbl_supplier.suppleir_id'=>['=',$suppleir_id]]));

		$data = fetch_records(limit(inner_join("tbl_supplier=supplier_id, `vendor_id`, `supplier_name`, `supplier_mobile`, `supplier_address`, `supplier_latitude`, `supplier_longitude`, `supplier_open`, `supplier_close`, `supplier_holiday`, `supplier_website`, `supplier_url`, `supplier_banner`, `supplier_display_name`, `supplier_description`, `supplier_unicode`|tbl_suppleir_product= `suppleir_product_id`, `supplier_id`, `suppleir_product_name`, `suppleir_product_old_price`, `suppleir_product_current_price`, `suppleir_product_qty`, `suppleir_product_net_wt`, `suppleir_product_gros_wt`, `suppleir_product_featured_photo`, `suppleir_product_description`, `suppleir_product_short_description`, `suppleir_product_feature`, `suppleir_product_condition`, `suppleir_product_return_policy`, `suppleir_product_total_view`, `suppleir_product_is_featured`, `suppleir_product_is_active`, `status`, `created_by`, `created_at`, `suppleir_product_filter_price`, `unit`",
			[ 'tbl_suppleir_product'=>'tbl_supplier.supplier_id=tbl_suppleir_product.supplier_id']

	)));
		json_bind($data,CONST_HTTP_STATUS_OK,'All Products',true,$total_rows,$page_url);
	endif;
}

############# Get Request #################
############# Post Request ################

function supply_product_post(){

		if(insertat('tbl_plans',[

			'mega_cat_id'=>parsejson()['mega_cat_id'],
			'name'=>parsejson()['name'],
			'title'=>parsejson()['title'],
			'description'=>parsejson()['description'],
			'banner'=>parsejson()['banner'],
			'status'=>parsejson()['status']

		])):

			json_bind(true,200,'Plans inserted',true);

		else:

			json_bind(false,200,'Plans failed',false);

		endif;

	}
############# Post Request ################

############# Put Request #################

function supply_product_put(){

		if(update('tbl_plans',[

			'name'=>parsejson()['name'],
			'title'=>parsejson()['title'],
			'description'=>parsejson()['description'],
			'banner'=>parsejson()['banner'],
			'status'=>parsejson()['status'],
			'created_by'=>parsejson()['created_by']

		],['plans_id'=>parsejson()['plans_id']])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Updated !',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'error',false);

		endif;

	}

############# Put Request ################
############# Delete Request ################
	function supply_product_delete(){

		if(delete('tbl_plans',[

			'plans_id'=>parsejson()['plans_id'],

		])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Deleted',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'Error !',false);

		endif;

	}
############# Delete Request ################

