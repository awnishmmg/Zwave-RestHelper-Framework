<?php
	function subcategory_get($columns='',$param=''){
		if($columns and $param)
		{
			$page_url=seek_url('subcatlist',$columns,$param);
		}
		else
		{
			$page_url=seek_url('subcatlist');
		}
		global $chain;
		$chain = true;


		if($columns=='' or $param == ''):
		$total_rows = total_rows(getall('tbl_subcategory'));
		$data = fetch_records(limit(getall('tbl_subcategory')));
		json_bind($data,CONST_HTTP_STATUS_OK,'All Categories List',true,$total_rows,$page_url);
		else:
		$queryobj=runsql('Select * from tbl_subcategory');
		$columns_list=$queryobj['columns_list'];

		if(in_columns($columns_list,$columns)){
		$total_rows = total_rows(select('tbl_subcategory','',[
		$columns => ['=',$param],
		]));
		
		$data = fetch_records(limit(select('tbl_subcategory','',[
		$columns => ['=',$param],
		])));
		//prx($data);
		json_bind($data,CONST_HTTP_STATUS_OK,'All Categories List',true,$total_rows,$page_url);
		

		}else{
		json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

		}
		endif;


		}
		
	function subcategory_post(){

		if(insertat('tbl_subcategory',[

			'cat_id'=>parsejson()['cat_id'],
			'subcategory'=>parsejson()['subcategory'],
			'title'=>parsejson()['title'],
			'description'=>parsejson()['description'],
			'image_path'=>parsejson()['image_path'],
			'unicode'=>parsejson()['unicode'],
			'height'=>parsejson()['height'],
			'width'=>parsejson()['width']
		])):

			json_bind(true,200,'Sub Category inserted',true);

		else:

			json_bind(false,200,'Sub Category failed',false);

		endif;

	}


	function subcategory_put(){

		if(update('tbl_subcategory',[

			'cat_id'=>parsejson()['cat_id'],
			'subcategory'=>parsejson()['subcategory'],
			'status'=>parsejson()['status'],
			'title'=>parsejson()['title'],
			'description'=>parsejson()['description'],
			'image_path'=>parsejson()['image_path'],
			'unicode'=>parsejson()['unicode'],
			'height'=>parsejson()['height'],
			'width'=>parsejson()['width']

		],['subcat_id'=>parsejson()['subcat_id']])):

			json_bind(true,200,'Sub Category Updated .',true);

		else:

			json_bind(false,200,'Sub Category Update Failed!',false);

		endif;

	}


	function subcategory_delete(){

		if(delete('tbl_subcategory',[

			'subcat_id '=>parsejson()['subcat_id '],

		])):

			json_bind(true,200,'Category Deleted',true);

		else:

			json_bind(false,200,'Category Deleted failed !',false);

		endif;

	}