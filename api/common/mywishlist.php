<?php 


function mywishlist_get($columns='',$param=''){

		if($columns=='' or $param == ''):

		json_bind([],CONST_HTTP_STATUS_OK,'Please Pass User Id like mywishlist/user_id/?',true);
		else:

		$data = getwishlistcolumns($columns,$param);
	
		$columns_list=array_keys($data[0]);

		if(in_array($columns,$columns_list)){

		$data = join2("tbl_wishlist=`wishlist_id`, `product_id`, `user_id`|
		tbl_product=`product_id`, `product_name`, `product_old_price`, `product_current_price`, `product_qty`, `product_net_wt`, `product_gros_wt`, `product_featured_photo`, `product_description`, `product_short_description`, `product_feature`, `product_condition`, `product_return_policy`, `product_total_view`, `product_is_featured`, `product_is_active`",'product_id',[
			$columns=>['=',$param],
		]);

		json_bind($data,CONST_HTTP_STATUS_OK,'All Product',true);

		}else{

    	json_bind([],CONST_HTTP_STATUS_OK,'All Product',true);
		}
		endif;


}

function getwishlistcolumns($columns,$param)
{
	$data =  join2("tbl_wishlist=`wishlist_id`, `product_id`, `user_id`|
		tbl_product=`product_id`,  `product_name`, `product_old_price`, `product_current_price`, `product_qty`, `product_net_wt`, `product_gros_wt`, `product_featured_photo`, `product_description`, `product_short_description`, `product_feature`, `product_condition`, `product_return_policy`, `product_total_view`, `product_is_featured`, `product_is_active`",'product_id',[
			$columns=>['=',$param],
		]
		);
	return $data;
}