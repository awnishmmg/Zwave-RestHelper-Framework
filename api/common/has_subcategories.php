<?php  

function has_subcategories_get()
{
	$page_url=seek_url('has_subcategory');
	
	global $chain;
	$chain = true;
	$total_rows = total_rows(where_this(left_join('tbl_category=cat_id as cid,title as cattitle|tbl_subcategory=cat_id as subid',[

			'tbl_subcategory'=>'tbl_category.cat_id=tbl_subcategory.cat_id'
		]),[
		'tbl_subcategory.cat_id'=>' is NULL',
	]));
	$data = fetch_records(limit(where_this(left_join('tbl_category=cat_id as cid,title as cattitle|tbl_subcategory=cat_id as subid',[

			'tbl_subcategory'=>'tbl_category.cat_id=tbl_subcategory.cat_id'
		]),[
		'tbl_subcategory.cat_id'=>' is NULL',
	])));
	
	json_bind($data,CONST_HTTP_STATUS_OK,'All Plans',true,$total_rows,$page_url);
}