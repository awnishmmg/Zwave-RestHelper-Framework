<?php

###############| Pagination Configuration File |################
#This File holds All the Configuration About pagination #################################################################

$paginate['home_url'] = base_url;

// page key name given In the URL
$paginate['keyname'] = 'page';

// min Record Keyname
$paginate['min_record_keyname'] = 'min_record';

// page given in URL parameter, default page is one
$paginate['default_row'] = 1;

// page given in URL parameter, default page is one
$paginate['default_record'] = 10;


// GET The page name from the URL 
$paginate['page'] = isset($_REQUEST[$paginate['keyname']])?
					$_REQUEST[$paginate['keyname']] : 
					$paginate['default_row'];

// Records Per Page
$paginate['records_per_page'] = isset($_REQUEST[$paginate['min_record_keyname']])?
					$_REQUEST[$paginate['min_record_keyname']] : 
					$paginate['default_record'];


// calculate for the query LIMIT clause
$paginate['from_record_num'] = ($paginate['records_per_page'] * $paginate['page']) - $paginate['records_per_page'];














































































































