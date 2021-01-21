<?php


// Get Request
function supply_product_subcat_get($columnname='',$key='',$id=''){

$view_left_category=tables['view_left_category'];

global $chain;
$chain=true;
 $page_url = seek_url('supply_supply_product_subcat',$key,$id);

	$total_rows=total_rows(left_join("tbl_suppleir_product=`suppleir_product_id`, `supplier_id`, `suppleir_product_name`, `suppleir_product_old_price`, `suppleir_product_current_price`, `suppleir_product_qty`, `suppleir_product_net_wt`, `suppleir_product_gros_wt`, `suppleir_product_featured_photo`, `suppleir_product_description`, `suppleir_product_short_description`, `suppleir_product_feature`, `suppleir_product_condition`, `suppleir_product_return_policy`, `suppleir_product_total_view`, `suppleir_product_is_featured`, `suppleir_product_is_active`, `status`, `created_by`, `created_at`, `tbl_suppleir_product_filter_price`,`unit`|tbl_supply_product_subcat=pro_sup_subcat_id`, `suppleir_product_id`, `subcat_id`, `rel_pair`|$view_left_category=`sid`, `sname`, `sstatus`, `stitle`, `sdecription`, `simage_path`, `sunicode`, `sheight`, `swidth`",[

	'tbl_supply_product_subcat'=>"tbl_suppleir_product.suppleir_product_id =tbl_supply_product_subcat.suppleir_product_id",
	 $view_left_category=>"tbl_supply_product_subcat.subcat_id=view_left_category.sid",
]));

$data=fetch_records(limit(where_this(left_join("tbl_suppleir_product=`suppleir_product_id`, `supplier_id`, `suppleir_product_name`, `suppleir_product_old_price`, `suppleir_product_current_price`, `suppleir_product_qty`, `suppleir_product_net_wt`, `suppleir_product_gros_wt`, `suppleir_product_featured_photo`, `suppleir_product_description`, `suppleir_product_short_description`, `suppleir_product_feature`, `suppleir_product_condition`, `suppleir_product_return_policy`, `suppleir_product_total_view`, `suppleir_product_is_featured`, `suppleir_product_is_active`, `status`, `created_by`, `created_at`, `tbl_suppleir_product_filter_price`, `unit`|tbl_supply_product_subcat=pro_sup_subcat_id`, `suppleir_product_id`, `subcat_id`, `rel_pair`|$view_left_category=`sid`, `sname`, `sstatus`, `stitle`, `sdecription`, `simage_path`, `sunicode`, `sheight`, `swidth`",[

	'tbl_supply_product_subcat'=>"tbl_suppleir_product.suppleir_product_id =tbl_supply_product_subcat.suppleir_product_id",
	 $view_left_category=>"tbl_supply_product_subcat.subcat_id=view_left_category.sid",
]),[
"tbl_suppleir_product.{$columnname}" =>"='$key'"
])
));

if($data>0)
{
json_bind($data,200,'category from data',true,$total_rows,$page_url);	
}
else
{
	json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,true,$total_rows,$page_url);
}


	
}

function tbl_supply_product_subcat_post(){

	foreach (parsejson() as $key => $value) {
		if($value==""){
			json_bind([],200,"$key is Empty",false);
		}
	}

	if(insertat('product_supply_subcat',[

  

       'pro_sup_subcat_id'=>parsejson()['pro_sup_subcat_id'],
		 'pro_sup_id'=>parsejson()['pro_sup_id'],
		  'subcat_id'=>parsejson()['subcat_id'],
		   'rel_pair'=>parsejson()['rel_pair'],
		   
	])){

	json_bind([

			'pro_sup_subcat_id'=>last_inserted_id('product_supply_subcat'),

		],200,'Record Inserted',true);

	}else{

		json_bind([],200,'Error',false);
	}


}

	function tbl_supply_product_subcat_put(){

		if(update('product_supply_subcat',[

		'pro_sup_subcat_id'=>parsejson()['pro_sup_subcat_id'],
		 'pro_sup_id'=>parsejson()['pro_sup_id'],
		  'subcat_id'=>parsejson()['subcat_id'],
		   'rel_pair'=>parsejson()['rel_pair'],
		   
		],['subcat_id'=>parsejson()['subcat_id']])):

			json_bind(true,200,'Category Updated .',true);

		else:

			json_bind(false,200,'Category Update Failed!',false);

		endif;

	}


	function tbl_supply_product_subcat_delete(){

		if(delete('product_supply_subcat',[

			'pro_sup_subcat_id'=>parsejson()['pro_sup_subcat_id'],

		])):

			json_bind(true,200,'Category Deleted',true);

		else:

			json_bind(false,200,'Category Deleted failed !',false);

		endif;

	}


