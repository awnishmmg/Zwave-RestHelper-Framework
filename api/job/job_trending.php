<?php


function job_trending_get($meta_category='',$key='')
{
	global $chain;
	if($key=='is_latest')
	{
	    $page_url =seek_url('jobtrending',$key);
	    $chain = true;
	    
	    $total_rows = total_rows(order_by(inner_join('tbl_jobs=`jobs_id`,`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`,`no_of_vacancy` ,`requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`
		    |tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`',[
		        
			'tbl_company'=>'tbl_jobs.company_id=tbl_company.company_id',
		]),'tbl_jobs.created_at','desc limit 10'));
		
		$data = fetch_records(limit(inner_join('tbl_jobs=`jobs_id`,`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`,`no_of_vacancy` ,`requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`
		    |tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`',[
		        
			'tbl_company'=>'tbl_jobs.company_id=tbl_company.company_id',
		])));
		json_bind($data,CONST_HTTP_STATUS_OK,'All Jobs',true,$total_rows,$page_url);
	}
	if($key=='all_jobs')
	{
	    $page_url =seek_url('jobtrending','all_jobs');
	    //prx($page_url);
	    $chain = true;
	    
	    $total_rows = total_rows(order_by(inner_join('tbl_jobs=`jobs_id`,`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`,`no_of_vacancy` ,`requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`
		    |tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`',[
		        
			'tbl_company'=>'tbl_jobs.company_id=tbl_company.company_id',
		]),'tbl_jobs.created_at','asc'));
		$data = fetch_records(limit(order_by(inner_join('tbl_jobs=`jobs_id`,`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`,`no_of_vacancy` ,`requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`
		    |tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`',[
		        
			'tbl_company'=>'tbl_jobs.company_id=tbl_company.company_id',
		]),'tbl_jobs.created_at','asc')));
		//prx($data);
		json_bind($data,CONST_HTTP_STATUS_OK,'All Jobs',true,$total_rows,$page_url);
	}
	if($key=='')
	{
	    
		$chain = true;
		
		$data = where_this(inner_join('tbl_megacategory_to_meta_key=`metakey_name`,`description`, `key_badge`, `key_heading`, `created_by`, `status`, `created_at`, `sort_order`|tbl_rel_mega_keys=`rel_mega_keys_id`, `mega_cat_id`, `meta_value`|tbl_mega_category=mega_cat_id as mega_id,title as mega_title',[
			'tbl_rel_mega_keys'=>'tbl_megacategory_to_meta_key.is_metakey_id=tbl_rel_mega_keys.is_metakey_id','tbl_mega_category'=>'tbl_mega_category.mega_cat_id=tbl_rel_mega_keys.mega_cat_id',
		]),[
		
			'tbl_rel_mega_keys.mega_cat_id'=>"='$meta_category'",

		]);
		json_bind(fetch_records($data),CONST_HTTP_STATUS_OK,'All Keys',true);
	}
	if($key and $meta_category)
	{
	    $page_url =seek_url('jobtrending',$meta_category,$key);
	    
		$chain = true;
		$total_rows = total_rows(where_this(inner_join('tbl_megacategory_to_meta_key=`metakey_name`,`description`, `key_badge`, `key_heading`, `created_by`, `status`, `created_at`, `sort_order`|tbl_rel_mega_keys=`rel_mega_keys_id`, `mega_cat_id`, `meta_value`|tbl_mega_category=mega_cat_id as mega_id,title as mega_title|tbl_job_to_meta_data=jobs_id as jid|
		    tbl_jobs=`jobs_id`,`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`, `requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`
		    |tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`',[
			'tbl_rel_mega_keys'=>'tbl_megacategory_to_meta_key.is_metakey_id=tbl_rel_mega_keys.is_metakey_id','tbl_mega_category'=>'tbl_mega_category.mega_cat_id=tbl_rel_mega_keys.mega_cat_id',
			'tbl_job_to_meta_data'=>'tbl_job_to_meta_data.rel_mega_keys_id=tbl_rel_mega_keys.rel_mega_keys_id','tbl_jobs'=>'tbl_job_to_meta_data.jobs_id=tbl_jobs.jobs_id',
			'tbl_company'=>'tbl_jobs.company_id=tbl_company.company_id',
		]),[
		
			'tbl_rel_mega_keys.mega_cat_id'=>"='$meta_category' AND ",
			'tbl_megacategory_to_meta_key.metakey_name'=>"='$key'",

		])); 
		
		$data = fetch_records(limit(where_this(inner_join('tbl_megacategory_to_meta_key=`metakey_name`,`description`, `key_badge`, `key_heading`, `created_by`, `status`, `created_at`, `sort_order`|tbl_rel_mega_keys=`rel_mega_keys_id`, `mega_cat_id`, `meta_value`|tbl_mega_category=mega_cat_id as mega_id,title as mega_title|tbl_job_to_meta_data=jobs_id as jid|
		    tbl_jobs=`jobs_id`,`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`, `requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`
		    |tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`',[
			'tbl_rel_mega_keys'=>'tbl_megacategory_to_meta_key.is_metakey_id=tbl_rel_mega_keys.is_metakey_id','tbl_mega_category'=>'tbl_mega_category.mega_cat_id=tbl_rel_mega_keys.mega_cat_id',
			'tbl_job_to_meta_data'=>'tbl_job_to_meta_data.rel_mega_keys_id=tbl_rel_mega_keys.rel_mega_keys_id','tbl_jobs'=>'tbl_job_to_meta_data.jobs_id=tbl_jobs.jobs_id',
			'tbl_company'=>'tbl_jobs.company_id=tbl_company.company_id',
		]),[
		
			'tbl_rel_mega_keys.mega_cat_id'=>"='$meta_category' AND ",
			'tbl_megacategory_to_meta_key.metakey_name'=>"='$key'",

		])));
	   //prx($data);
		json_bind($data,CONST_HTTP_STATUS_OK,'All Jobs',true,$total_rows,$page_url);

		
		
	}
	
}	