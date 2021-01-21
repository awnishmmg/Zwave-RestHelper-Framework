<?php

function sectors_post(){
	//Extract All Parent Tables From Root
	extract(tables);
	// Enable Chain
	global $chain;
	$chain=true;
	// Get All the Tables using simple Query or Joins

	$data = getall('tbl_sector');
	$page_url = seek_url('transport_sectors');
	$total_rows = total_rows($data);
	$data=fetch_records($data);
	if(count($data)>0){ //start of if

		json_bind($data,CONST_HTTP_STATUS_OK,'All Sectors',true,$total_rows,$page_url);

	}else{

		json_bind([],CONST_HTTP_STATUS_CREATED,'No Record Found',false,$total_rows,$page_url);

	}//end of else
	

}

function sectors_get(){


prx(get_included_files());
	
}



?>