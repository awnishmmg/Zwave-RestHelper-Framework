<?php



############# Get Request #################

function wishlist_get($columns='',$param=''){

if($columns and $param)
{
	$page_url=seek_url('wishlist',$columns,$param);
}
else
{
	$page_url=seek_url('wishlist');
}
global $chain;
$chain = true;

if($columns=='' or $param == ''):
$total_rows = total_rows(getall('tbl_wishlist'));
$data = fetch_records(limit(getall('tbl_wishlist')));
json_bind($data,CONST_HTTP_STATUS_OK,'All wishlisted Item',true,$total_rows,$page_url);
else:
$queryobj=runsql('Select * from tbl_wishlist');
$columns_list=$queryobj['columns_list'];

if(in_columns($columns_list,$columns)){
$total_rows = total_rows(select('tbl_wishlist','',[
$columns => ['=',$param],
]));
//prx($total_rows);
$data = fetch_records(limit(select('tbl_wishlist','',[
$columns => ['=',$param],
])));
json_bind($data,CONST_HTTP_STATUS_OK,'All wishlisted Item',true,$total_rows,$page_url);
}else{

json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

}
endif;


}

############# Get Request #################
############# Post Request ################

function wishlist_post(){
		$product_id = parsejson()['product_id'];
		$user_id = parsejson()['user_id'];
		
		if(doexist('tbl_wishlist',[
			'product_id'=>['=',$product_id],
			'user_id'=>['=',$user_id],
		]
		)):
			json_bind([],200,'Product Already In wishlist',true);

		else:

			insertat('tbl_wishlist',[

			'user_id'=>parsejson()['user_id'],
			'product_id'=>parsejson()['product_id']
			]);

			json_bind(true,200,'Product Added To Wishlist',true);

		endif;

	}
############# Post Request ################

############# Put Request #################

function wishlist_put(){

			json_bind(false,CONST_HTTP_STATUS_OK,'UNKNOWN METHOD',false);


	}

############# Put Request ################
############# Delete Request ################
	function wishlist_delete(){
		$user_id = parsejson()['user_id'];
		$product_id = parsejson()['product_id'];
		if(doexist('tbl_wishlist',[
			'product_id'=>['=',$product_id],
			'user_id'=>['=',$user_id],
		]
		))
		{
			
			$wishlist_id= select('tbl_wishlist',['wishlist_id'],[
			'product_id'=>['=',$product_id],
			'user_id'=>['=',$user_id],
			]);
			$pk = $wishlist_id[0]['wishlist_id'];
			if(delete('tbl_wishlist',[

			'wishlist_id'=>$pk,

		])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Deleted',true);

		else:

			json_bind([],CONST_HTTP_STATUS_OK,'Error !',false);

		endif;
		}
		else
		{
			json_bind([],CONST_HTTP_STATUS_OK,'Error !',false);	
		}

		

	}
############# Delete Request ################

