<?php

function job_search_get($search_key='')
{
	if($search_key=='')
	{
		json_bind([],CONST_HTTP_STATUS_OK,'Please pass search key',true);
	}
	if($search_key)
	{
	    $page_url = seek_url('jobsearch',$search_key);
	    
		global $chain;
		$chain = true;
		
		$condition = [
			'tbl_jobs.job_title'=>" like '%$search_key%' or ",
			'tbl_jobs.preferred_location'=>" like '%$search_key%' or ",
			'tbl_jobs.job_description'=>" like '%$search_key%' or ",
			'tbl_jobs.keyskills'=>" like '%$search_key%' ",
		];
		$total_rows = total_rows(where_this(inner_join('tbl_jobs=`jobs_id`,`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`,`no_of_vacancy` ,`requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`
		    |tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`',[
		        
			'tbl_company'=>'tbl_jobs.company_id=tbl_company.company_id',
		]),$condition));
		$data = fetch_records(limit(where_this(inner_join('tbl_jobs=`jobs_id`,`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`,`no_of_vacancy` ,`requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`
		    |tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`',[
		        
			'tbl_company'=>'tbl_jobs.company_id=tbl_company.company_id',
		]),$condition)));
		//prx($data);
		json_bind($data,CONST_HTTP_STATUS_OK,'All Jobs',true,$total_rows,$page_url);
	}
}

