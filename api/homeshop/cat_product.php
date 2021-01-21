<?php 

function cat_product_get($mega_cat_id='',$cat_id=''){
    global $chain;
    if($mega_cat_id=='')
    {
        json_bind([],CONST_HTTP_STATUS_OK,'Please Pass Megacategory_id',true);
    }
    if($cat_id=='')
    {
        json_bind([],CONST_HTTP_STATUS_OK,'Please Give Category id or Subcategory Id',true);
    }
    if($mega_cat_id and $cat_id)
    {
        $page_url = seek_url('homechef_catprod',$mega_cat_id,$cat_id);
        $chain = true;
        $total_rows = total_rows(where_this(inner_join('tbl_product=`product_id`,`product_name`, `product_old_price`, `product_current_price`, `product_qty`, `product_net_wt`, `product_gros_wt`, `product_featured_photo`, `product_description`, `product_short_description`, `product_feature`, `product_condition`, `product_return_policy`, `product_total_view`, `product_is_featured`,
        `product_is_active`, `status`, `created_by`, `created_at`|tbl_shop_to_product=shop_id
        |tbl_shop=`shop_id`, `vendor_id`, `shop_name`, `shop_mobile`, `shop_address`, `shop_latitude`, `shop_longitude`, `shop_open`, `shop_close`,
        `shop_holiday`, `shop_website`, `shop_url`, `shop_banner`, `shop_display_name`, `shop_description`, `shop_unicode`, `status`|tbl_vendor=mega_cat_id as vmega_cat_id|tbl_mega_category=title',[
            'tbl_shop_to_product'=>'tbl_product.product_id=tbl_shop_to_product.product_id',
            'tbl_shop'=>'tbl_shop_to_product.shop_id=tbl_shop.shop_id',
            'tbl_vendor'=>'tbl_shop.vendor_id=tbl_vendor.vendor_id',
            'tbl_mega_category'=>'tbl_vendor.mega_cat_id=tbl_mega_category.mega_cat_id',
            'tbl_product_to_cat'=>'tbl_product.product_id=tbl_product_to_cat.product_id',
        ]),[
			'tbl_mega_category.mega_cat_id'=>"='$mega_cat_id' AND",
			'tbl_product_to_cat.cat_id'=>"='$cat_id'",
		]));
		
        $data = fetch_records(limit(where_this(inner_join('tbl_product=`product_id`,`product_name`, `product_old_price`, `product_current_price`, `product_qty`, `product_net_wt`, `product_gros_wt`, `product_featured_photo`, `product_description`, `product_short_description`, `product_feature`, `product_condition`, `product_return_policy`, `product_total_view`, `product_is_featured`,
        `product_is_active`, `status`, `created_by`, `created_at`|tbl_shop_to_product=shop_id
        |tbl_shop=`shop_id`, `vendor_id`, `shop_name`, `shop_mobile`, `shop_address`, `shop_latitude`, `shop_longitude`, `shop_open`, `shop_close`,
        `shop_holiday`, `shop_website`, `shop_url`, `shop_banner`, `shop_display_name`, `shop_description`, `shop_unicode`, `status`|tbl_vendor=mega_cat_id as vmega_cat_id|tbl_mega_category=title',[
            'tbl_shop_to_product'=>'tbl_product.product_id=tbl_shop_to_product.product_id',
            'tbl_shop'=>'tbl_shop_to_product.shop_id=tbl_shop.shop_id',
            'tbl_vendor'=>'tbl_shop.vendor_id=tbl_vendor.vendor_id',
            'tbl_mega_category'=>'tbl_vendor.mega_cat_id=tbl_mega_category.mega_cat_id',
            'tbl_product_to_cat'=>'tbl_product.product_id=tbl_product_to_cat.product_id',
        ]),[
			'tbl_mega_category.mega_cat_id'=>"='$mega_cat_id' AND",
			'tbl_product_to_cat.cat_id'=>"='$cat_id'",
		])));
        // prx($data);
        // prx(fetch_records($data));
        json_bind($data,CONST_HTTP_STATUS_OK,'All Jobs',true,$total_rows,$page_url);
    }
}