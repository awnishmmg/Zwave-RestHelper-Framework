<?php
	
	function list_get($columns='',$param=''){
	    $page_url = seek_url('companylist');
	    if($columns and $param)
		{
			$page_url=seek_url('companylist',$columns,$param);
		}
		else
		{
			$page_url=seek_url('companylist');
		}
		global $chain;
	    //prx($page_url);
		global $chain;
		$chain = true;
		if($columns=='' or $param == ''):
		$total_rows = total_rows(where(getall('tbl_company'),[
	 		'tbl_company.status'=>['=','1']
 		]));
		$data = fetch_records(limit(where(getall('tbl_company'),[
	 		'tbl_company.status'=>['=','1']
 		])));
		//prx($data);
		json_bind($data,CONST_HTTP_STATUS_OK,'All Companies List',true,$total_rows,$page_url);
		else:
		
		$queryobj=runsql('Select * from tbl_company');
		$columns_list=$queryobj['columns_list'];

		if(in_columns($columns_list,$columns)){
		$total_rows = total_rows(select('tbl_company','',[
		$columns => ['=',$param],
		]));
		//prx($total_rows);
		$data = fetch_records(limit(select('tbl_company','',[
		$columns => ['=',$param],
		])));
		json_bind($data,CONST_HTTP_STATUS_OK,'All Categories List',true,$total_rows,$page_url);
		

		}else{
		json_bind(array('error'=>'argument_error'),CONST_HTTP_STATUS_OK,'No columns matched to the Table',false);

		}
		endif;
	}
	function list_post(){
        
		if(insertat('tbl_company',[
            
			'vendor_id'=>parsejson()['vendor_id'],
			'description'=>parsejson()['description'],
			'latitude'=>parsejson()['latitude'],
			'longitude'=>parsejson()['longitude'],
			'landmark'=>parsejson()['landmark'],
			'address'=>parsejson()['address'],
			'zip_code'=>parsejson()['zip_code'],
			'name'=>parsejson()['name'],
			'email'=>parsejson()['email'],
			'logo'=>parsejson()['logo'],
			'cover'=>parsejson()['cover'],
			'urls'=>parsejson()['urls'],
			'contact'=>parsejson()['contact'],
			'working_days'=>parsejson()['working_days'],
			'shift'=>parsejson()['shift'],
			'perks'=>parsejson()['perks']

		])):

			json_bind(true,200,'Company Details inserted',true);

		else:

			json_bind(false,200,'Failed',false);

		endif;

	}


	function list_put(){

		if(update('tbl_company',[

			'vendor_id'=>parsejson()['vendor_id'],
			'name'=>parsejson()['name'],
			'email'=>parsejson()['email'],
			'logo'=>parsejson()['logo'],
			'cover'=>parsejson()['cover'],
			'urls'=>parsejson()['urls'],
			'contact'=>parsejson()['contact'],
			'working_days'=>parsejson()['working_days'],
			'shift'=>parsejson()['shift'],
			'perks'=>parsejson()['perks'],
			'status'=>parsejson()['status'],


		],['company_id'=>parsejson()['company_id']])):

			json_bind(true,200,'Details Updated .',true);

		else:

			json_bind(false,200,'Failed!',false);

		endif;

	}


	function list_delete(){

		if(delete('tbl_company',[

			'company_id'=>parsejson()['company_id'],

		])):

			json_bind(true,200,'Company Deleted',true);

		else:

			json_bind(false,200,'Failed !',false);

		endif;

	}