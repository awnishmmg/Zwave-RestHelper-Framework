<?php
	function filter_get($mega_cat_id,$search_key='')
	{

		global $chain;
		if($mega_cat_id=='all' and $search_key)
		{
			$page_url =seek_url('filter',$mega_cat_id,$search_key);
			$pname = $search_key;
			if($pname!=''){
				
				$condition = [	
				'tbl_product.product_name'=>" like '%$pname%' or ",
				'tbl_product.product_description'=>" like '%$pname%' or ",
				'tbl_product.product_short_description'=>" like '%$pname%' or ",
				'tbl_shop.shop_name'=>" like '%$pname%' or ",
				'tbl_shop.shop_description'=>" like '%$pname%' or ",
				'tbl_shop.shop_address'=>" like '%$pname%' ",
				];
				$chain=true;
				$total_rows = total_rows(where_this(inner_join("tbl_product=product_id,product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy|tbl_shop_to_product=shop_id as shp_id|tbl_shop=`shop_name`, `shop_mobile`, `shop_address`, `shop_latitude`, `shop_longitude`, `shop_open`, `shop_close`, `shop_holiday`, `shop_website`, `shop_url`, `shop_banner`, `shop_display_name`, `shop_description`, `shop_unicode`, `status`|tbl_vendor=mega_cat_id as m_id|tbl_mega_category=title",
					[
						'tbl_shop_to_product'=>
						'tbl_product.product_id=tbl_shop_to_product.product_id',
						'tbl_shop'=>
						'tbl_shop_to_product.shop_id=tbl_shop.shop_id',
						'tbl_rel_product_category_subcat'=>
						'tbl_product.product_id=tbl_rel_product_category_subcat.product_id',
						'tbl_vendor'=>'tbl_vendor.vendor_id=tbl_shop.vendor_id',
						'tbl_mega_category'=>'tbl_mega_category.mega_cat_id=tbl_vendor.mega_cat_id',

					]),$condition));

				

				$data = fetch_records(limit(where_this(inner_join("tbl_product=product_id,product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy|tbl_shop_to_product=shop_id as shp_id|tbl_shop=`shop_name`, `shop_mobile`, `shop_address`, `shop_latitude`, `shop_longitude`, `shop_open`, `shop_close`, `shop_holiday`, `shop_website`, `shop_url`, `shop_banner`, `shop_display_name`, `shop_description`, `shop_unicode`, `status`|tbl_vendor=mega_cat_id as m_id|tbl_mega_category=title",
					[
						'tbl_shop_to_product'=>
						'tbl_product.product_id=tbl_shop_to_product.product_id',
						'tbl_shop'=>
						'tbl_shop_to_product.shop_id=tbl_shop.shop_id',
						'tbl_rel_product_category_subcat'=>
						'tbl_product.product_id=tbl_rel_product_category_subcat.product_id',
						'tbl_vendor'=>'tbl_vendor.vendor_id=tbl_shop.vendor_id',
						'tbl_mega_category'=>'tbl_mega_category.mega_cat_id=tbl_vendor.mega_cat_id',

					]),$condition)));
				json_bind($data,CONST_HTTP_STATUS_OK,'All Products',true,$total_rows,$page_url);

			}

		}
		else{


			#Select the Record Only if Filter is set
			if($mega_cat_id and $search_key)
			{
				$page_url = seek_url('filter2');
				//prx($page_url);
				$pname = $search_key;

				$keys = array_keys(parseobject());
				unset($keys[0]);
				$values = array_values(parseobject());
				unset($values[0]);

				$filter=array_combine($keys, $values);

				if(count($filter)>0){
					$filterkeys = ['sort_by','sort','price'];

				foreach ($filter as $f_keys => $f_value) {
					if(!in_array($f_keys, $filterkeys)){
						json_bind([],CONST_HTTP_STATUS_OK,'such Key does not exist',false);
					}
				}

				//prx($filter);

				$order_by['low-to-high'] = 'ASC';
				$order_by['high-to-low'] = 'DESC';
				$order_by_column = " tbl_product.product_{$filter['sort_by']} ";
				$order=$order_by[$filter['sort']];			
				$condition = [
					'tbl_mega_category.mega_cat_id'=>"='$mega_cat_id' and",	
					'tbl_product.product_name'=>" like '%$pname%' or ",
					'tbl_product.product_description'=>" like '%$pname%' or ",
					'tbl_product.product_short_description'=>" like '%$pname%' or ",
					'tbl_shop.shop_name'=>" like '%$pname%' or ",
					'tbl_shop.shop_description'=>" like '%$pname%' or ",
					'tbl_shop.shop_address'=>" like '%$pname%' ",
				];
				
				$chain = true;
				$total_rows = total_rows(order_by(where_this(inner_join("tbl_product=product_id,product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy|tbl_shop_to_product=shop_id as shp_id|tbl_shop=`shop_name`, `shop_mobile`, `shop_address`, `shop_latitude`, `shop_longitude`, `shop_open`, `shop_close`, `shop_holiday`, `shop_website`, `shop_url`, `shop_banner`, `shop_display_name`, `shop_description`, `shop_unicode`, `status`|tbl_vendor=mega_cat_id as m_id|tbl_mega_category=title as m_title",
				[
				'tbl_shop_to_product'=>
				'tbl_product.product_id=tbl_shop_to_product.product_id',
				'tbl_shop'=>
				'tbl_shop_to_product.shop_id=tbl_shop.shop_id',
				'tbl_rel_product_category_subcat'=>
				'tbl_product.product_id=tbl_rel_product_category_subcat.product_id',
				'tbl_vendor'=>'tbl_vendor.vendor_id=tbl_shop.vendor_id',
				'tbl_mega_category'=>'tbl_vendor.mega_cat_id=tbl_mega_category.mega_cat_id',

				]),$condition),$order_by_column,$order));

				$data = fetch_records(limit(order_by(where_this(inner_join("tbl_product=product_id,product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy|tbl_shop_to_product=shop_id as shp_id|tbl_shop=`shop_name`, `shop_mobile`, `shop_address`, `shop_latitude`, `shop_longitude`, `shop_open`, `shop_close`, `shop_holiday`, `shop_website`, `shop_url`, `shop_banner`, `shop_display_name`, `shop_description`, `shop_unicode`, `status`|tbl_vendor=mega_cat_id as m_id|tbl_mega_category=title as m_title",
				[
				'tbl_shop_to_product'=>
				'tbl_product.product_id=tbl_shop_to_product.product_id',
				'tbl_shop'=>
				'tbl_shop_to_product.shop_id=tbl_shop.shop_id',
				'tbl_rel_product_category_subcat'=>
				'tbl_product.product_id=tbl_rel_product_category_subcat.product_id',
				'tbl_vendor'=>'tbl_vendor.vendor_id=tbl_shop.vendor_id',
				'tbl_mega_category'=>'tbl_vendor.mega_cat_id=tbl_mega_category.mega_cat_id',

				]),$condition),$order_by_column,$order)));

				


				json_bind($data,CONST_HTTP_STATUS_OK,'All Shops',true,$total_rows,$page_url);
				

				}

			
			}
			$page_url = seek_url('search_filter',$mega_cat_id);
			//prx($page_url);
			$pname = $search_key;
				$condition = [	
				'tbl_mega_category.mega_cat_id'=>"='$mega_cat_id' AND",
				'tbl_product.product_name'=>" like '%$pname%' or ",
				'tbl_product.product_description'=>" like '%$pname%' or ",
				'tbl_product.product_short_description'=>" like '%$pname%' or ",
				'tbl_shop.shop_name'=>" like '%$pname%' or ",
				'tbl_shop.shop_description'=>" like '%$pname%' or ",
				'tbl_shop.shop_address'=>" like '%$pname%' ",
			];

			$chain=true;
				$total_rows = total_rows(where_this(inner_join("tbl_product=product_id,product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy|tbl_shop_to_product=shop_id as shp_id|tbl_shop=`shop_name`, `shop_mobile`, `shop_address`, `shop_latitude`, `shop_longitude`, `shop_open`, `shop_close`, `shop_holiday`, `shop_website`, `shop_url`, `shop_banner`, `shop_display_name`, `shop_description`, `shop_unicode`, `status`|tbl_vendor=mega_cat_id as m_id|tbl_mega_category=title",
					[
						'tbl_shop_to_product'=>
						'tbl_product.product_id=tbl_shop_to_product.product_id',
						'tbl_shop'=>
						'tbl_shop_to_product.shop_id=tbl_shop.shop_id',
						'tbl_rel_product_category_subcat'=>
						'tbl_product.product_id=tbl_rel_product_category_subcat.product_id',
						'tbl_vendor'=>'tbl_vendor.vendor_id=tbl_shop.vendor_id',
						'tbl_mega_category'=>'tbl_mega_category.mega_cat_id=tbl_vendor.mega_cat_id',

				]),$condition));

				$data = fetch_records(limit(where_this(inner_join("tbl_product=product_id,product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy|tbl_shop_to_product=shop_id as shp_id|tbl_shop=`shop_name`, `shop_mobile`, `shop_address`, `shop_latitude`, `shop_longitude`, `shop_open`, `shop_close`, `shop_holiday`, `shop_website`, `shop_url`, `shop_banner`, `shop_display_name`, `shop_description`, `shop_unicode`, `status`|tbl_vendor=mega_cat_id as m_id|tbl_mega_category=title",
					[
						'tbl_shop_to_product'=>
						'tbl_product.product_id=tbl_shop_to_product.product_id',
						'tbl_shop'=>
						'tbl_shop_to_product.shop_id=tbl_shop.shop_id',
						'tbl_rel_product_category_subcat'=>
						'tbl_product.product_id=tbl_rel_product_category_subcat.product_id',
						'tbl_vendor'=>'tbl_vendor.vendor_id=tbl_shop.vendor_id',
						'tbl_mega_category'=>'tbl_mega_category.mega_cat_id=tbl_vendor.mega_cat_id',

				]),$condition)));

				json_bind($data,CONST_HTTP_STATUS_OK,'All Shops',true,$total_rows,$page_url);

		}//END OF NOT ALL MEGACAT_ID

		
	}
	