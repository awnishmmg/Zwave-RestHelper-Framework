<?php
	function mega_category_get($columns='',$param=''){

		if($columns=='' or $param == ''):
		json_bind(getall('tbl_mega_category'),CONST_HTTP_STATUS_OK,'All Mega Categories List',true);
		else:
		$queryobj=runsql('Select * from tbl_mega_category');
		$columns_list=$queryobj['columns_list'];

		if(in_columns($columns_list,$columns)){
		json_bind(select('tbl_mega_category','',[
		$columns => ['=',$param],
		]),CONST_HTTP_STATUS_OK,'All Mega Categories List',true);

		}else{
		json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

		}
		endif;


		}

	function mega_category_post(){

		if(insertat('tbl_mega_category',[

			'name'=>parsejson()['name'],
			'status'=>parsejson()['status'],
			'title'=>parsejson()['title'],
			'description'=>parsejson()['description'],
			'image_path'=>parsejson()['image_path'],
			'unicode'=>parsejson()['unicode'],
			'height'=>parsejson()['height'],
			'width'=>parsejson()['width']

		])):

			json_bind(true,200,'Mega Category inserted',true);

		else:

			json_bind(false,200,'Mega Category failed',false);

		endif;

	}


	function mega_category_put(){

		if(update('tbl_mega_category',[

			'name'=>parsejson()['name'],
			'status'=>parsejson()['status'],
			'title'=>parsejson()['title'],
			'description'=>parsejson()['description'],
			'image_path'=>parsejson()['image_path'],
			'unicode'=>parsejson()['unicode'],
			'height'=>parsejson()['height'],
			'width'=>parsejson()['width']


		],['mega_cat_id'=>parsejson()['mega_cat_id']])):

			json_bind(true,200,'Mega Category Updated .',true);

		else:

			json_bind(false,200,'Mega Category Update Failed!',false);

		endif;

	}
	function mega_category_delete(){

		if(delete('tbl_mega_category',[

			'mega_cat_id'=>parsejson()['mega_cat_id'],

		])):

			json_bind(true,200,'Mega Category Deleted',true);

		else:

			json_bind(false,200,'Mega Category Deleted failed !',false);

		endif;

	}