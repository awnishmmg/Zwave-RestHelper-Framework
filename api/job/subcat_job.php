<?php

function subcat_job_get($mega_cat_id='',$cat_id='',$subcat_id='')
{
    global $chain;
    if($mega_cat_id=='')
    {
        json_bind([],CONST_HTTP_STATUS_OK,'Please Pass Megacategory_id',true);
    }
    if($cat_id=='')
    {
        json_bind([],CONST_HTTP_STATUS_OK,'Please Give Category id or Subcategory Id',true);
    }
    if($mega_cat_id and $cat_id and $subcat_id)
    {
        //prx($subcat_id);
        $page_url = seek_url('subcat_job',$mega_cat_id,$cat_id,$subcat_id);
        //prx($page_url);
        $chain = true;
        $total_rows = total_rows(where_this(inner_join('tbl_jobs=`jobs_id`,`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`,`no_of_vacancy` ,`requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`
		    |tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`|tbl_jobs_to_cat=job_cat_id|tbl_job_to_subcat=subcat_id as job_subcat_id|tbl_vendor=mega_cat_id v_mega_cat_id|tbl_mega_category=title',[
		        
			'tbl_company'=>'tbl_jobs.company_id=tbl_company.company_id',
			'tbl_jobs_to_cat'=>'tbl_jobs.jobs_id=tbl_jobs_to_cat.jobs_id',
			'tbl_job_to_subcat'=>'tbl_jobs_to_cat.job_cat_id=tbl_job_to_subcat.job_cat_id',
			'tbl_vendor'=>'tbl_company.vendor_id=tbl_vendor.vendor_id',
			'tbl_mega_category'=>'tbl_vendor.mega_cat_id=tbl_mega_category.mega_cat_id',
		]),[
			'tbl_jobs_to_cat.cat_id'=>"='$cat_id' AND",
			'tbl_job_to_subcat.subcat_id'=>"='$subcat_id'",
		]));
		$data = fetch_records(limit(where_this(inner_join('tbl_jobs=`jobs_id`,`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`,`no_of_vacancy` ,`requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`
		    |tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`|tbl_jobs_to_cat=job_cat_id|tbl_job_to_subcat=subcat_id as job_subcat_id|tbl_vendor=mega_cat_id v_mega_cat_id|tbl_mega_category=title',[
		        
			'tbl_company'=>'tbl_jobs.company_id=tbl_company.company_id',
			'tbl_jobs_to_cat'=>'tbl_jobs.jobs_id=tbl_jobs_to_cat.jobs_id',
			'tbl_job_to_subcat'=>'tbl_jobs_to_cat.job_cat_id=tbl_job_to_subcat.job_cat_id',
			'tbl_vendor'=>'tbl_company.vendor_id=tbl_vendor.vendor_id',
			'tbl_mega_category'=>'tbl_vendor.mega_cat_id=tbl_mega_category.mega_cat_id',
		]),[
			'tbl_jobs_to_cat.cat_id'=>"='$cat_id' AND",
			'tbl_job_to_subcat.subcat_id'=>"='$subcat_id'",
		])));
		//prx($data);
		json_bind($data,CONST_HTTP_STATUS_OK,'All Jobs',true,$total_rows,$page_url);
    }
    
    
}