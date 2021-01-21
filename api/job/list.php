<?php
    //errors_log();
	function list_get(){
		global $chain;
		$chain = true;
		$page_url = seek_url('joblist');
		//prx($page_url);
		$total_rows = total_rows(where_this(inner_join("tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`|tbl_jobs=`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`, `requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`",[
		    	'tbl_jobs'=>'tbl_company.company_id=tbl_jobs.company_id',
			]),[
			'tbl_jobs.status'=>"= '1'",

		]));
		$data = fetch_records(limit(where_this(inner_join("tbl_company=`company_id`,`vendor_id` as vid, `name`, `description`, `email`, `logo`, `cover`, `urls`, `contact`, `working_days`, `shift`, `perks`, `status`, `zip_code`, `landmark`, `state`, `city`, `country`, `address`, `latitude`, `longitude`, `created_by`, `created_at`|tbl_jobs=`job_title`, `job_description`, `job_type`, `job_salary`, `job_email`, `contact_name`, `contact_person_designation`, `preferred_location`, `requirements`, `contact_no`, `apply_url`, `website_url`, `attachment`, `keyskills`, `status`",[
		    	'tbl_jobs'=>'tbl_company.company_id=tbl_jobs.company_id',
			]),[
			'tbl_jobs.status'=>"= '1'",

		])));
		json_bind($data,CONST_HTTP_STATUS_OK,'All Product',true,$total_rows,$page_url);
	}
	function list_post(){

		if(insertat('tbl_jobs',[

			'company_id'=>parsejson()['company_id'],
			'job_title'=>parsejson()['job_title'],
			'job_description'=>parsejson()['job_description'],
			'job_type'=>parsejson()['job_type'],
			'job_salary'=>parsejson()['job_salary'],
			'job_email'=>parsejson()['job_email'],
			'contact_name'=>parsejson()['contact_name'],
			'contact_no'=>parsejson()['contact_no'],
			'apply_url'=>parsejson()['apply_url'],
			'website_url'=>parsejson()['website_url'],
			'attachment'=>parsejson()['attachment'],
			'keyskills'=>parsejson()['keyskills']

		])):

			json_bind(true,200,'Company Details inserted',true);

		else:

			json_bind(false,200,'Failed',false);

		endif;

	}


	function list_put(){

		if(update('tbl_jobs',[

			'company_id'=>parsejson()['company_id'],
			'job_title'=>parsejson()['job_title'],
			'job_description'=>parsejson()['job_description'],
			'job_type'=>parsejson()['job_type'],
			'job_salary'=>parsejson()['job_salary'],
			'job_email'=>parsejson()['job_email'],
			'contact_name'=>parsejson()['contact_name'],
			'contact_no'=>parsejson()['contact_no'],
			'apply_url'=>parsejson()['apply_url'],
			'website_url'=>parsejson()['website_url'],
			'attachment'=>parsejson()['attachment'],
			'keyskills'=>parsejson()['keyskills'],
			'status'=>parsejson()['status'],


		],['jobs_id'=>parsejson()['jobs_id']])):

			json_bind(true,200,'Details Updated .',true);

		else:

			json_bind(false,200,'Failed!',false);

		endif;

	}


	function list_delete(){

		if(delete('tbl_jobs',[

			'jobs_id'=>parsejson()['jobs_id'],

		])):

			json_bind(true,200,'Job Deleted',true);

		else:

			json_bind(false,200,'Failed !',false);

		endif;

	}