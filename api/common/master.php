<?php

	function master_get(){
		json_bind(getall('tbl_frontend_master'),200,'All Master Front End.',true);
	}

