<?php

###############Api for getting products at nearby location for all shops ########
function findproduct_fromshop_get(){

		// json_bind([],200,'UNKNOWN METHOD',false);

		global $con;

	// $latitude = parsejson()['shop_latitude'];
	// $longitude = parsejson()['shop_longitude'];
	// $distance_km = parsejson()['distance_km'];
	// $cat_id = parsejson()['cat_id'];
	// $radius_km = $distance_km;

// 	$sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) sin((`tbl_shop`.`shop_latitude`*pi()/180))+cos((".$latitude."*pi()/180)) cos((`tbl_shop`.`shop_latitude`*pi()/180)) * cos(((".$longitude."-`tbl_shop`.`shop_longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance ";
// $having = " HAVING (distance <= $radius_km) ";
// $order_by = ' distance ASC ';
// // $sql = "SELECT tbl_shop.*".$sql_distance." FROM tbl_shop $having ORDER BY $order_by";
		
	$sql = "SELECT Distinct tbl_product.*,
	tbl_rel_product_category_subcat.rel_pair,
	tbl_shop_category.rel_pair,
	tbl_shop_category.cat_id,
	tbl_category.title,
	tbl_category.cat_id,tbl_mega_category.name,
	tbl_vendor.username,tbl_shop.*
	from tbl_product 
	INNER JOIN tbl_rel_product_category_subcat on (tbl_product.rel_prod_cat_id = tbl_rel_product_category_subcat.rel_prod_cat_id)
	INNER JOIN tbl_shop_category on tbl_rel_product_category_subcat.meta_id = tbl_shop_category.cat_id
	INNER JOIN tbl_category on tbl_category.cat_id = tbl_shop_category.cat_id
	INNER JOIN tbl_mega_category on tbl_mega_category.mega_cat_id = tbl_category.mega_cat_id
	INNER JOIN tbl_vendor ON tbl_vendor.mega_cat_id = tbl_category.mega_cat_id
	INNER JOIN tbl_shop On tbl_vendor.vendor_id = tbl_shop.vendor_id
	WHERE tbl_rel_product_category_subcat.rel_pair='cat-prod'
	AND tbl_category.cat_id = '7'";

	// prx($sql);

	$res = mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0)
		{
			while($row = mysqli_fetch_assoc($res))
			{
				$data[] = $row;
			}
			json_bind($data,200,'Record Found',true);
		}
		else
		{
			json_bind([],CONST_HTTP_STATUS_OK,'Record Not Found',true);
		}

	}

function findproduct_fromshop_post(){
	global $con;

	$latitude = parsejson()['shop_latitude'];
	$longitude = parsejson()['shop_longitude'];
	$distance_km = parsejson()['distance_km'];
	$cat_id = parsejson()['cat_id'];
	$radius_km = $distance_km;

	$sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) sin((`tbl_shop`.`shop_latitude`*pi()/180))+cos((".$latitude."*pi()/180)) cos((`tbl_shop`.`shop_latitude`*pi()/180)) * cos(((".$longitude."-`tbl_shop`.`shop_longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance ";
$having = " HAVING (distance <= $radius_km) ";
$order_by = ' distance ASC ';
// $sql = "SELECT tbl_shop.*".$sql_distance." FROM tbl_shop $having ORDER BY $order_by";
		
	$sql = "SELECT tbl_product.*,
	tbl_rel_product_category_subcat.rel_pair,
	tbl_shop_category.rel_pair,
	tbl_shop_category.cat_id,
	tbl_category.title,
	tbl_category.cat_id,tbl_mega_category.name,
	tbl_vendor.username,tbl_shop.*".$sql_distance."
	from tbl_product 
	INNER JOIN tbl_rel_product_category_subcat on (tbl_product.rel_prod_cat_id = tbl_rel_product_category_subcat.rel_prod_cat_id)
	INNER JOIN tbl_shop_category on tbl_rel_product_category_subcat.meta_id = tbl_shop_category.cat_id
	INNER JOIN tbl_category on tbl_category.cat_id = tbl_shop_category.cat_id
	INNER JOIN tbl_mega_category on tbl_mega_category.mega_cat_id = tbl_category.mega_cat_id
	INNER JOIN tbl_vendor ON tbl_vendor.mega_cat_id = tbl_category.mega_cat_id
	INNER JOIN tbl_shop On tbl_vendor.vendor_id = tbl_shop.vendor_id
	WHERE tbl_rel_product_category_subcat.rel_pair='cat-prod'
	AND tbl_category.cat_id = '$cat_id' $having ORDER BY $order_by";

	prx($sql);

	$res = mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0)
		{
			while($row = mysqli_fetch_assoc($res))
			{
				$data[] = $row;
			}
			json_bind($data,200,'Record Found',true);
		}
		else
		{
			json_bind([],CONST_HTTP_STATUS_OK,'Record Not Found',true);
		}

}

