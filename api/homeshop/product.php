<?php
############# Get Request ################	
	function product_get($mega_value='',$cat_value='',$subcat_value=''){
		$page_url=seek_url('shoppe_product');
		//prx($page_url);
		if($mega_value=='' and $cat_value=='' and $subcat_value=='')
		{
			json_bind([],CONST_HTTP_STATUS_OK,'Plaese pass megacat_id,cat_id and subcat_id',true);
		}
		
		if($mega_value){
			global $chain;
			$chain = true;
			$total_rows = total_rows(where_this(inner_join("view_left_category=mid as mega_cat_id,mname,cid,ctitle,sid,sname,stitle|tbl_vendor=vendor_id as vid|tbl_shop=shop_name as shp_name,shop_mobile as shp_mobile,shop_address as shp_address,shop_open as shp_open,shop_close as shp_close,shop_holiday as shp_holiday,shop_website as shp_website,shop_url as shp_url,shop_banner as shp_banner,shop_display_name as shp_display_name,shop_description as shp_description,shop_unicode as shp_unicode|tbl_shop_to_product=product_id as pid|tbl_product=product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy|tbl_rel_product_category_subcat=meta_id,meta_value,rel_pair",[
				'tbl_vendor'=>'view_left_category.mid=tbl_vendor.mega_cat_id',
				'tbl_shop'=>'tbl_vendor.vendor_id=tbl_shop.vendor_id',
				'tbl_shop_to_product'=>'tbl_shop.shop_id=tbl_shop_to_product.shop_id',
				'tbl_product'=>'tbl_shop_to_product.product_id=tbl_product.product_id',
				'tbl_rel_product_category_subcat'=>'tbl_product.product_id=tbl_rel_product_category_subcat.product_id',
			]),[
				'view_left_category.mid'=>"='$mega_value' AND ",
				 'view_left_category.cid'=>"='$cat_value' AND",
				 'tbl_rel_product_category_subcat.meta_id'=>"='$cat_value'",
				
			]));
			$data = fetch_records(limit(where_this(inner_join("view_left_category=mid as mega_cat_id,mname,cid,ctitle,sid,sname,stitle|tbl_vendor=vendor_id as vid|tbl_shop=shop_name as shp_name,shop_mobile as shp_mobile,shop_address as shp_address,shop_open as shp_open,shop_close as shp_close,shop_holiday as shp_holiday,shop_website as shp_website,shop_url as shp_url,shop_banner as shp_banner,shop_display_name as shp_display_name,shop_description as shp_description,shop_unicode as shp_unicode|tbl_shop_to_product=product_id as pid|tbl_product=product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy|tbl_rel_product_category_subcat=meta_id,meta_value,rel_pair",[
				'tbl_vendor'=>'view_left_category.mid=tbl_vendor.mega_cat_id',
				'tbl_shop'=>'tbl_vendor.vendor_id=tbl_shop.vendor_id',
				'tbl_shop_to_product'=>'tbl_shop.shop_id=tbl_shop_to_product.shop_id',
				'tbl_product'=>'tbl_shop_to_product.product_id=tbl_product.product_id',
				'tbl_rel_product_category_subcat'=>'tbl_product.product_id=tbl_rel_product_category_subcat.product_id',
			]),[
				'view_left_category.mid'=>"='$mega_value' AND ",
				 'view_left_category.cid'=>"='$cat_value' AND",
				 'tbl_rel_product_category_subcat.meta_id'=>"='$cat_value'",
				
			])));
			json_bind($data,CONST_HTTP_STATUS_OK,'All Product',true,$total_rows,$page_url);
		}
		
		
	}