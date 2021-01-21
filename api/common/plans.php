<?php



############# Get Request #################

function plans_get($columns='',$param=''){

if($columns and $param)
{
	$page_url=seek_url('plans',$columns,$param);
}
else
{
	$page_url=seek_url('plans');
}
//prx($page_url);
global $chain;
$chain = true;



if($columns=='' or $param == ''):
$total_rows = total_rows(getall('tbl_plans'));
$data = fetch_records(limit(getall('tbl_plans')));
json_bind($data,CONST_HTTP_STATUS_OK,'All Plans',true,$total_rows,$page_url);
else:
$queryobj=runsql('Select * from tbl_plans');
$columns_list=$queryobj['columns_list'];

if(in_columns($columns_list,$columns)){
$total_rows = total_rows(select('tbl_category','',[
$columns => ['=',$param],
]));
//prx($total_rows);
$data = fetch_records(limit(select('tbl_plans','',[
$columns => ['=',$param],
])));
json_bind($data,CONST_HTTP_STATUS_OK,'All Plans',true,$total_rows,$page_url);


}else{

json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

}
endif;


}

############# Get Request #################
############# Post Request ################

function plans_post(){
        $mega_cat_id = parsejson()['mega_cat_id'];
        //prx($mega_cat_id);
		if(insertat('tbl_plans',[

			'mega_cat_id'=>$mega_cat_id,
			'name'=>parsejson()['name'],
			'title'=>parsejson()['title'],
			'description'=>parsejson()['description'],
			'banner'=>parsejson()['banner'],
			'status'=>parsejson()['status']

		])):

			json_bind(true,200,'Plans inserted',true);

		else:

			json_bind(false,200,'Plans failed',false);

		endif;

	}
############# Post Request ################

############# Put Request #################

function plans_put(){

		if(update('tbl_plans',[

			'name'=>parsejson()['name'],
			'title'=>parsejson()['title'],
			'description'=>parsejson()['description'],
			'banner'=>parsejson()['banner'],
			'status'=>parsejson()['status'],
			'created_by'=>parsejson()['created_by']

		],['plans_id'=>parsejson()['plans_id']])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Updated !',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'error',false);

		endif;

	}

############# Put Request ################
############# Delete Request ################
	function plans_delete(){

		if(delete('tbl_plans',[

			'plans_id'=>parsejson()['plans_id'],

		])):

			json_bind(true,CONST_HTTP_STATUS_OK,'Record Deleted',true);

		else:

			json_bind(false,CONST_HTTP_STATUS_OK,'Error !',false);

		endif;

	}
############# Delete Request ################



