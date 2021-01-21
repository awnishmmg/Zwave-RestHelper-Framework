<?php

	function category_get($columns='',$param=''){
		if($columns and $param)
		{
			$page_url=seek_url('categorylist',$columns,$param);
		}
		else
		{
			$page_url=seek_url('categorylist');
		}
		global $chain;
		$chain = true;
		
		if($columns=='' or $param == ''):
		$total_rows = total_rows(getall('tbl_category'));
		$data = fetch_records(limit(getall('tbl_category')));
		json_bind($data,CONST_HTTP_STATUS_OK,'All Categories List',true,$total_rows,$page_url);
		else:
		$queryobj=runsql('Select * from tbl_category');
		$columns_list=$queryobj['columns_list'];

		if(in_columns($columns_list,$columns)){
		$total_rows = total_rows(select('tbl_category','',[
		$columns => ['=',$param],
		]));
		//prx($total_rows);
		$data = fetch_records(limit(select('tbl_category','',[
		$columns => ['=',$param],
		])));
		json_bind($data,CONST_HTTP_STATUS_OK,'All Categories List',true,$total_rows,$page_url);

		}else{
		json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

		}
		endif;


		}

	function category_post(){

		if(insertat('tbl_category',[

			'mega_cat_id'=>parsejson()['mega_cat_id'],
			'category'=>parsejson()['category'],
			'title'=>parsejson()['title'],
			'description'=>parsejson()['description'],
			'image_path'=>parsejson()['image_path'],
			'unicode'=>parsejson()['unicode'],
			'height'=>parsejson()['height'],
			'width'=>parsejson()['width']

		])):

			json_bind(true,200,'Category inserted',true);

		else:

			json_bind(false,200,'Category failed',false);

		endif;

	}


	function category_put(){

		if(update('tbl_category',[

			'mega_cat_id'=>parsejson()['mega_cat_id'],
			'category'=>parsejson()['category'],
			'status'=>parsejson()['status'],
			'title'=>parsejson()['title'],
			'description'=>parsejson()['description'],
			'image_path'=>parsejson()['image_path'],
			'unicode'=>parsejson()['unicode'],
			'height'=>parsejson()['height'],
			'width'=>parsejson()['width']


		],['cat_id'=>parsejson()['cat_id']])):

			json_bind(true,200,'Category Updated .',true);

		else:

			json_bind(false,200,'Category Update Failed!',false);

		endif;

	}


	function category_delete(){

		if(delete('tbl_category',[

			'cat_id'=>parsejson()['cat_id'],

		])):

			json_bind(true,200,'Category Deleted',true);

		else:

			json_bind(false,200,'Category Deleted failed !',false);

		endif;

	}