<?php


############# Get Request ################	
	function shop_prod_latlong_get($latitude='',$longitude='',$distance_km=''){
		global $con;
		$radius_km = $distance_km;
		$sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`tbl_shop`.`shop_latitude`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`tbl_shop`.`shop_latitude`*pi()/180)) * cos(((".$longitude."-`tbl_shop`.`shop_longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance ";
		$having = " HAVING (distance <= $radius_km) "; 
		$order_by = ' distance ASC ';
		$sql = "SELECT tbl_shop.*".$sql_distance." FROM tbl_shop $having ORDER BY $order_by";
		$res = mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0)
		{
			while($row = mysqli_fetch_assoc($res))
			{
				$data[] = $row;
			}
			
			foreach ($data as $index => $row) {

				$tmp['shops']=$row;
				$shop_id = $row['shop_id'];
				$megadata[]=getproducts($shop_id);	
					
			}

			json_bind($megadata,CONST_HTTP_STATUS_OK,'All Record',true);
		}
		else
		{
			json_bind([],CONST_HTTP_STATUS_OK,'Record Not Found',true);
		}
	}
############# Get Request ################
 function getproducts($shop_id)
 {
 	//pr($shop_id);
 	global $chain;
 	$chain = true;

 	$megadata=where(poly_join("tbl_product=product_name,product_old_price,product_current_price,product_qty,product_net_wt,product_gros_wt,product_featured_photo,product_description,product_short_description,product_feature,product_condition,product_return_policy,product_total_view|tbl_shop_to_product=shop_id as sid|tbl_shop=shop_name,shop_mobile,shop_address,shop_open,shop_close,shop_holiday,shop_website,shop_url,shop_banner,shop_display_name,shop_description,shop_unicode",['product_id','shop_id'],'inner'),[
 		'tbl_shop_to_product.shop_id'=>['=',$shop_id],
 		'tbl_product.status'=>['=','1'],
 		//'tbl_shop_to_product.product_id'=>['IS NOT NULL'],
 	]);


 	$megadata = fetch_records($megadata);
 	return $megadata;
 	
 }