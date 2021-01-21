<?php

function json_bind($data,$responsecode=200,$comment='',$status='',$total_rows=1,$page_url='',$extra=[]){
    global $env_n;
    http_response_code($responsecode);
    header('Content-type: application/json');

    // This is Pagination Code

    $records_per_page = paginate['records_per_page'];
    $json_data['data']=$data;
    $json_data['paging']=getpaging($total_rows,$records_per_page,$page_url);
    
    // This is Pagination Code
    $data = [
        'response_code'=>$responsecode,
        'response_data'=>$json_data,
        'comments'=>$comment,
        'status'=> $status,
        'env'=>$env_n,
    ];

    foreach ($extra as $key => $value) {
        $data[$key] = $value;
    }

    echo json_encode($data,
    JSON_PRETTY_PRINT); 
    exit;

}

function getPaging($total_rows, $records_per_page, $page_url){
        // paging array
        $page = paginate['page'];
        $pagekeyname = paginate['keyname'];
        $paging_arr=array();
  
        // button for first page
        $paging_arr["first"] = $page>1 ? "{$page_url}{$pagekeyname}=1" : "";
  
        // count all products in the database to calculate total pages
        $total_pages = ceil($total_rows / $records_per_page);
       
        // range of links to show
        $range = 2;
  
        // display links to 'range of pages' around 'current page'
        $initial_num = $page - $range;
        $condition_limit_num = ($page + $range)  + 1;
  
        $paging_arr['pages']=array();
        $page_count=0;
          
        for($x=$initial_num; $x<$condition_limit_num; $x++){
            // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
        if(($x > 0) && ($x <= $total_pages)){
            $paging_arr['pages'][$page_count]["page"]=$x;
            $paging_arr['pages'][$page_count]["url"]="{$page_url}{$pagekeyname}={$x}";
            $paging_arr['pages'][$page_count]["current_page"] = $x==$page ? "yes" : "no";

            $page_count++;
        }
    }
  
        // button for last page
        $paging_arr["last"] = $page<$total_pages ? "{$page_url}{$pagekeyname}={$total_pages}" : "";
  
        // json format
        return $paging_arr;
}

function seek_url($keyname,...$arguments){
    
    $values = "";
    if(count($arguments)>0){
        foreach($arguments as $key => $params){
            $values = $values . "/".$params;
        }    
    }
    
return paginate['home_url'].page_routes[$keyname].$values."/?";

}

