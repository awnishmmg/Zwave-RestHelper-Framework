<?php


// Get Request
function supply_product_cat_get($columnname='',$key='',$id=''){

$view_left_category=tables['view_left_category'];

global $chain;
$chain=true;
 $page_url = seek_url('supply_supply_product_cat',$key,$id);

	$total_rows=total_rows(left_join("tbl_suppleir_product=`suppleir_product_id`, `supplier_id`, `suppleir_product_name`, `suppleir_product_old_price`, `suppleir_product_current_price`, `suppleir_product_qty`, `suppleir_product_net_wt`, `suppleir_product_gros_wt`, `suppleir_product_featured_photo`, `suppleir_product_description`, `suppleir_product_short_description`, `suppleir_product_feature`, `suppleir_product_condition`, `suppleir_product_return_policy`, `suppleir_product_total_view`, `suppleir_product_is_featured`, `suppleir_product_is_active`, `status`, `created_by`, `created_at`, `suppleir_product_filter_price`, `unit`|tbl_product_supply_cat=pro_sup_id, suppleir_product_id, cat_id, rel_pair|$view_left_category=ctitle",[

	'tbl_product_supply_cat'=>"tbl_suppleir_product.suppleir_product_id =tbl_product_supply_cat.suppleir_product_id",
	 $view_left_category=>"tbl_product_supply_cat.cat_id=view_left_category.cid",
]));


$data=limit(where_this(left_join("tbl_suppleir_product=`suppleir_product_id`, `supplier_id`, `suppleir_product_name`, `suppleir_product_old_price`, `suppleir_product_current_price`, `suppleir_product_qty`, `suppleir_product_net_wt`, `suppleir_product_gros_wt`, `suppleir_product_featured_photo`, `suppleir_product_description`, `suppleir_product_short_description`, `suppleir_product_feature`, `suppleir_product_condition`, `suppleir_product_return_policy`, `suppleir_product_total_view`, `suppleir_product_is_featured`, `suppleir_product_is_active`, `status`, `created_by`, `created_at`, `suppleir_product_filter_price`, `unit`|tbl_product_supply_cat=pro_sup_id, suppleir_product_id, cat_id, rel_pair|$view_left_category=ctitle",[

	'tbl_product_supply_cat'=>"tbl_suppleir_product.suppleir_product_id =tbl_product_supply_cat.suppleir_product_id",
	 $view_left_category=>"tbl_product_supply_cat.cat_id=view_left_category.cid",
]),[
"tbl_suppleir_product.{$columnname}" =>"='$key'"
]));



$data = fetch_records($data);

if($data>0)
{
json_bind($data,200,'category from data',true,$total_rows,$page_url);	
}
else
{
	json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,true,$total_rows,$page_url);
}


	
}

function supply_product_cat_post(){

	foreach (parsejson() as $key => $value) {
		if($value==""){
			json_bind([],200,"$key is Empty",false);
		}
	}

	if(insertat('tbl_suppleir_product_to_cat',[
   'supply_product_cat_id'=>parsejson()['supply_product_cat_id'],
		 'product_id'=>parsejson()['product_id'],
		  'cat_id'=>parsejson()['cat_id'],
		   'rel_pair'=>parsejson()['rel_pair'],
		   
	])){

	json_bind([

			'supply_product_cat_id'=>last_inserted_id('tbl_suppleir_product_to_cat'),

		],200,'Record Inserted',true);

	}else{

		json_bind([],200,'Error',false);
	}


}

	function supply_product_cat_put(){

		if(update('tbl_suppleir_product_to_cat',[

		'supply_product_cat_id'=>parsejson()['supply_product_cat_id'],
		 'product_id'=>parsejson()['product_id'],
		  'cat_id'=>parsejson()['cat_id'],
		   'rel_pair'=>parsejson()['rel_pair'],
		   
		],['cat_id'=>parsejson()['cat_id']])):

			json_bind(true,200,'Category Updated .',true);

		else:

			json_bind(false,200,'Category Update Failed!',false);

		endif;

	}


	function supply_product_cat_delete(){

		if(delete('tbl_suppleir_product_to_cat',[

			'supply_product_cat_id'=>parsejson()['supply_product_cat_id'],

		])):

			json_bind(true,200,'Category Deleted',true);

		else:

			json_bind(false,200,'Category Deleted failed !',false);

		endif;

	}


