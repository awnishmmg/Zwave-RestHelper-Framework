<?php

function company_joblist_get($company_id='',$jobs_id='')
{
     
    global $chain;
    
    if($company_id=='')
    {
        json_bind([],CONST_HTTP_STATUS_OK,'Please pass company id',true);
    }
   
    if($company_id and $jobs_id)
    {
        
        $page_url = seek_url('company_joblist',$company_id,$jobs_id);  
        $chain = true;
        $total_rows = total_rows(where_this(inner_join('tbl_jobs=`jobs_id`,`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`,`no_of_vacancy` ,`requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`
		    |tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`|tbl_jobs_to_cat=job_cat_id|tbl_vendor=mega_cat_id v_mega_cat_id|tbl_mega_category=title',[
		        
			'tbl_company'=>'tbl_jobs.company_id=tbl_company.company_id',
			'tbl_jobs_to_cat'=>'tbl_jobs.jobs_id=tbl_jobs_to_cat.jobs_id',
			'tbl_vendor'=>'tbl_company.vendor_id=tbl_vendor.vendor_id',
			'tbl_mega_category'=>'tbl_vendor.mega_cat_id=tbl_mega_category.mega_cat_id',
		]),[
			'tbl_company.company_id'=>"='$company_id' and ",
			'tbl_jobs.jobs_id'=>" not in ('$jobs_id')",
		]));
		$data = fetch_records(limit(where_this(inner_join('tbl_jobs=`jobs_id`,`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`,`no_of_vacancy` ,`requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`
		    |tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`|tbl_jobs_to_cat=job_cat_id|tbl_vendor=mega_cat_id v_mega_cat_id|tbl_mega_category=title',[
		        
			'tbl_company'=>'tbl_jobs.company_id=tbl_company.company_id',
			'tbl_jobs_to_cat'=>'tbl_jobs.jobs_id=tbl_jobs_to_cat.jobs_id',
			'tbl_vendor'=>'tbl_company.vendor_id=tbl_vendor.vendor_id',
			'tbl_mega_category'=>'tbl_vendor.mega_cat_id=tbl_mega_category.mega_cat_id',
		]),[
			'tbl_company.company_id'=>"='$company_id' and ",
			'tbl_jobs.jobs_id'=>" not in ('$jobs_id')",
		])));
		//prx($data);
		json_bind($data,CONST_HTTP_STATUS_OK,'All Record',true,$total_rows,$page_url);
    }
}