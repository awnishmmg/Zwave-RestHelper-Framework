<?php 

$chain=false;

function insert_batch($tablename,$extra=[]){
	global $con;
	global $chain;


	$tmp_data=[];

	$tmp_data[]='NULL';

	foreach($_REQUEST as $names => $value){

		if(strtolower($names)=='submit'){
			continue;
		}else{
			// echo $names.'='.$value.'<br/>';
			$tmp_data[]=$value;
		}
	
	}//end for

	if(count($extra)>0){

		foreach($extra as $index => $extra_value){
			$tmp_data[] = $extra_value;
		}
		
	}

	// echo '<pre>';
	// 	print_r($tmp_data);

	$col_values=implode("','",$tmp_data);
	$sql = "INSERT INTO $tablename VALUES('$col_values');";

	//echo $sql;

	if($chain==true):
		return $sql;
	endif;

	if(mysqli_query($con,$sql)){

	$count = mysqli_affected_rows($con);
	if($count>0){
		return true;
	}else{

		return false;
	}

	}else
	{
		echo 'Insert Error'.mysqli_error($con);
		exit;
	}
}

function insertat($tablename,$formdata){
global $con;
global $chain;


// print_r($formdata);
// exit;

$columns=array_keys($formdata);
$values = array_values($formdata);

#print_r($columns);
#print_r($values);

#exit();

$columns=implode(",",$columns);

$values=implode("','",$values);



$sql = "INSERT INTO $tablename($columns) VALUES('$values');";

// echo $sql;


if(mysqli_query($con,$sql)){

	$count = mysqli_affected_rows($con);
	if($count>0){

		return true;
	}else{

		return false;
	}
}else
{
	echo 'Insert Error'.mysqli_error($con);
	exit;
}

}

function select_from(string $tablename,$columnsname=''){

	global $con;
	global $chain;



	if($tablename==''){
			die('Table-name cannot be null');
	}

	if($columnsname==''){
		$columns='*';
	}

	$columns = $columnsname;

	$sql = "SELECT $columns FROM $tablename";

	//echo $sql;

	$result_set=mysqli_query($con,$sql);
	@$count = @mysqli_num_rows(@$result_set);

	// echo $count;
	// exit;

	if($chain==true):
		return $sql;
	endif;

	if($count>0){

		while ($row=mysqli_fetch_assoc($result_set)) {
			
			$data[]=$row;
		}

		return $data;

	}else{

		// /echo 'No Record Found';
		return [];
	}

} #select specific from table_name


function getall(string $tablename){

	global $con;
	global $chain;


	if($tablename==''){
			die('Table-name cannot be null');
	}

	$sql = "SELECT * FROM $tablename";

	//echo $sql;

	$result_set=mysqli_query($con,$sql);
	@$count = @mysqli_num_rows(@$result_set);

	// echo $count;
	// exit;

	if($chain==true):
		return $sql;
	endif;

	if($count>0){

		while ($row=mysqli_fetch_assoc($result_set)) {
			
			$data[]=$row;
		}

		return $data;

	}else{

		// /echo 'No Record Found';
		return [];
	}

} #select * from table_name




function select(string $tablename,$columns='',$condition=[],$sep='AND'){

	global $con;
	global $chain;


	if($columns==''){
		$columns_names='*';

	}else{
		$columns_names = implode(',',$columns);
	}
	if(count($condition)<=0){
		$condition='';
	}

	//print_r($cond_columns);

	$query='';
	foreach($condition as $columns => $values_operator){

		$query=$query.$columns;

		foreach($values_operator as $index => $values){

			
			if($index==0){
				$query=$query.$values;
			}else{
				$query=$query."'".$values."'";
			}

		}
		$query=$query." $sep ";



	}

	#echo $query;

	if($sep=='AND'){
		$newquery=substr($query,0,-4);
		$newquery=trim($newquery).'';
	}else{
		$newquery=substr($query,0,-3);
		$newquery=trim($newquery).'';
	}
	
	//echo $newquery;
	//exit();
	$sql = "SELECT $columns_names FROM ";
	$sql=$sql.$tablename." where ".$newquery;
	//echo $sql;
	//exit;

	if($chain==true):
		return $sql;
	endif;


	$result_set=mysqli_query($con,$sql);
	@$count=@mysqli_num_rows(@$result_set);
	if($count>0){

		while($row=mysqli_fetch_assoc($result_set)){

			$data[]=$row;

		}
		return $data;

	}else{
		//echo 'No Record Found';
		return [];
	}

}

function delete($tablename,$columns_id=[]){
	global $con;
	global $chain;

	if(count($columns_id)<=0){
		echo 'id cannot be Blank';
		exit();
	}
	$where='';
	$sql = "DELETE FROM $tablename where ";
	foreach ($columns_id as $columns => $value) {
		$where=$where.$columns."='".$value."' AND ";
	}
	$new_where = substr($where,0,-4);
	$sql = $sql.$new_where;

	$sql=trim($sql).';';

	if($chain==true):
		return $sql;
	endif;

	if(mysqli_query($con,$sql)){

			$count = mysqli_affected_rows($con);
			if($count>0){
				return true;
			}else{

				return false;
			}

	}else{

	echo 'delete Error'.mysqli_error($con);
	exit;
}

}


function update($tablename,$sets=[],$match_columns=[]){

	global $con;
	global $chain;


	if(count($sets)<=0 or count($match_columns)<=0){

		echo 'set the columns name and unique columns';
		exit;
	}

	$setstr = '';

	$sql = "UPDATE $tablename SET ";
	foreach($sets as $columns =>$value){

		$setstr=$setstr.$columns."='".$value."',";

	}

	$newsetstr = substr($setstr,0,-1);

	$where ='';

	$sql = "UPDATE $tablename SET ";
	foreach($match_columns as $columns =>$value){

		$where=$where.$columns."='".$value."' AND ";

	}

	$new_where = substr($where,0,-4);
	//$newwhere = substr($where,0,-1);
	$sql=$sql.$newsetstr.' WHERE '.trim($new_where).';';
	//echo $sql;

	if($chain==true):
		return $sql;
	endif;

	if(mysqli_query($con,$sql)){

			$count = mysqli_affected_rows($con);
			if($count>0){
				return true;
			}else{

				return false;
			}

	}else{

	echo 'update Error'.mysqli_error($con);
	exit;
}


}

function getone(string $tablename,$id_columns=[]){

	global $con;
	global $chain;


	if($tablename==''){

		echo 'table name cannot be blank';

	}

	if(count($id_columns)<=0){

		echo 'invalid id supplied';
	}

	$sql = "SELECT * FROM $tablename WHERE ";

	#echo $sql;

	$where='';
	foreach ($id_columns as $columns => $value) {
		$where = $where . $columns ."='".$value."' AND ";	
	}

	$new_where = substr($where,0,-4);

	$sql=$sql.trim($new_where).';';
	//echo $sql;

	if($chain==true):
		return $sql;
	endif;

	$result_set=mysqli_query($con,$sql);
	@$count=@mysqli_num_rows(@$result_set);
	if($count>0){

		while($row=mysqli_fetch_assoc($result_set)){

			$data[]=$row;

		}
		return $data[0];

	}else{
		//echo 'No record Found';
		return [];
	}


	
} #select * from table_name


function delete_batch($tablename,$id_column,$ids_arr=[]){
	global $con;
	global $chain;

	if(count($ids_arr)<=0){
		echo 'id cannot be Blank';
		exit();
	}

	$ids = implode("','",$ids_arr);

	$sql = "DELETE FROM $tablename where $id_column IN ('".$ids."');";
	//echo $sql;

	if($chain==true):
		return $sql;
	endif;


	if(mysqli_query($con,$sql)){

			$count = mysqli_affected_rows($con);
			if($count>0){
				return true;
			}else{

				return false;
			}

	}else{

	echo 'delete Error'.mysqli_error($con);
	exit;
}

}

function doexist($tablename,$cols_values){
		$columns=array_keys($cols_values);

		$data=select($tablename,$columns,$cols_values);
		$check = isset($data) ? $data : [];
		if($check[0]==false){
			return false;
		}else{
			return true;
		}
}

# Below is the Query for Joins
# This Query Builder Pattern will Only work if the Condition both have same column
# name schema

function join2($joins_params,$on_columns,$where=[]){
	global $con;
	global $chain;


	$sqlwhere = '';
	if(count($where)>0){

		$sqlwhere = " WHERE";
		foreach ($where as $column => $condition_arr) {
			$sqlwhere =$sqlwhere." ".$column;

			foreach ($condition_arr as $index => $value) {
				$sqlwhere = $sqlwhere.$value."'";
			}
			$sqlwhere = $sqlwhere ." AND ";

		}
		$sqlwhere = substr($sqlwhere,0,-4);

	}


	$tables_arr=explode('|',$joins_params);
	//print_r($tables_arr);

	$first_table = $tables_arr[0];
	$second_table = end($tables_arr);

	$first_arr=explode('=',$first_table);
	$second_arr=explode('=',$second_table);

	$tabel_1 = $first_arr[0];
	$tabel_2 = $second_arr[0];

	// $columns = $first_arr[1].','.$second_arr[1];

	$col1=explode(',',$first_arr[1]);
	$col2=explode(',',$second_arr[1]);

	$field_1 ='';
	foreach($col1 as $index => $value){
		$field_1=$field_1.$tabel_1.'.'."$value,";
	}
	//echo $field_1;


	$field_2 ='';
	foreach($col2 as $index => $value){
		$field_2=$field_2.$tabel_2.'.'."$value,";
	}
	$select_columns=$field_1.$field_2;

	$select_columns=substr($select_columns,0,-1);
	//echo $select_columns;
	$sql = "SELECT $select_columns FROM $tabel_1 INNER JOIN $tabel_2 USING ($on_columns)".$sqlwhere;

	// echo $sql;
	// exit;

	$result_set=mysqli_query($con,$sql);
	@$count = @mysqli_num_rows(@$result_set);

	// echo $count;
	// exit;
	if($chain==true):
		return $sql;
	endif;

	if($count>0){

		while ($row=mysqli_fetch_assoc($result_set)) {
			
			$data[]=$row;
		}

		return $data;

	}else{

		//echo 'No Record Found';
		return [];
	}


}

function runsql($query=""){

global $con;
global $chain;

$command = explode(" ", $query);
$tablename = end($command);
if(preg_match("/SELECT/",strtoupper($command[0]))):

$object['query'] = mysqli_query($con,$query);
$object['writable'] = 'false';
$object['rows_count'] =mysqli_num_rows($object['query']);
$object['columns_list'] = get_columns($tablename);
$object['error'] = mysqli_error($con);

return $object;
else:

$object['query'] = mysqli_query($con,$query);
$object['writable'] = 'true';
$object['affected'] = mysqli_affected_rows($con);
$object['error'] = mysqli_error($con);

return $object;

endif;


}


function get_columns($tablename){
global $con;
global $chain;

$result_set=mysqli_query($con, "SHOW COLUMNS from {$tablename}");
while($row=mysqli_fetch_assoc($result_set)){
$data[]= $row['Field'];

}
return $data;

}

function in_columns($stack,$value){

if(in_array($value, array_values($stack))){
return true;
}else{
return false;
}
}

function last_inserted_id($tablename=''){
	
	global $con;
	global $chain;


	if($tablename==''){
		die('No tablename ');
	}
	$sql = "SELECT * from {$tablename}";
	$queryobj=runSQL($sql);
	$id_field=get_columns($tablename)[0];
	$sql = "SELECT $id_field from {$tablename} order by $id_field DESC LIMIT 1";
		$result_set = mysqli_query($con,$sql);
		if(mysqli_num_rows($result_set)>0){
			if($row=mysqli_fetch_assoc($result_set)){
				return $row[$id_field];
			}
			else{
				return [];
			}
		}else{
			
			echo 'Fetch Error'.mysqli_error($con);
			exit;
		}
}



function poly_join($joins_params,$on_columns,$jointype='INNER',$where=[]){
	global $con;
	global $chain;

	$sqlwhere = '';
	if(count($where)>0){

		$sqlwhere = " WHERE";
		foreach ($where as $column => $condition_arr) {
			$sqlwhere =$sqlwhere." ".$column;

			foreach ($condition_arr as $index => $value) {
				$sqlwhere = $sqlwhere.$value."'";
			}
			$sqlwhere = $sqlwhere ." AND ";

		}
		$sqlwhere = substr($sqlwhere,0,-4);
	}

	$tables_arr=explode('|',$joins_params);
	$pre_table = $tables_arr[0];

	for ($i=1; $i <count($tables_arr); $i++) { 
		$other_table[] = $tables_arr[$i];
	}

	$first_columns=explode('=',$pre_table);
		
	$final[$first_columns[0]]=$first_columns[1];//Main Work

	foreach($other_table as $index => $key){
		$other_columns[]=explode('=',$key);
	}

	foreach ($other_columns as $index => $k){
				$final[$k[0]] = $k[1];
	}

	$tables=array_keys($final);
	$column=array_values($final);


	foreach ($column as $i => $each_column){

		$newcolumn[]=explode(',', $each_column);	
	}


	$select_columns='';
	foreach ($newcolumn as $p => $vvv) {
		
		foreach ($vvv as $i2 => $vvv2) {
			$select_columns = $select_columns."{$tables[$p]}.{$vvv2},";	
		}
	}	

	$select_columns =substr($select_columns, 0,-1);
	$before_from = $tables[0];

	$sql = "SELECT $select_columns FROM $before_from";
	$joins ='';

	for($w=0; $w<count($on_columns);$w++) {
		$joins = $joins." $jointype JOIN {$tables[$w+1]} $tabel_2 USING ({$on_columns[$w]})";
	}

	$sql=$sql.$joins.$sqlwhere;
	$result_set=mysqli_query($con,$sql);
	@$count = @mysqli_num_rows(@$result_set);

	// echo $count;
	// exit;
	
	if($chain==true):
		return $sql;
	endif;

	if($count>0){

		while ($row=mysqli_fetch_assoc($result_set)) {
			
			$data[]=$row;
		}

		return $data;

	}else{

		//echo 'No Record Found';
		return [];
	}


}

function like($request_fn='',$keyname=[],$case='both',$sep='or'){
	
	if($request_fn == ''){
		die('* Not chaining function found ');
	}


	if(count($keyname)>0){

		$sql = ' WHERE';

		foreach ($keyname as $column => $param) {

			if(strtolower($case)=='after'):

				$pattern = "{$param}%";

			elseif(strtolower($case)=='before'):

				$pattern = "%{$param}";

			else:
				$pattern = "%{$param}%";

			endif;

			$sql = $sql." ".$column." ".strtoupper(__FUNCTION__)." '{$pattern}' ".$sep;
		}
			$sql = substr($sql,0,-strlen($sep));
			

		if($chain==true){
			return $request_fn.$sql;
		}
		

	}


}


function order_by($request_fn='',$column_name='',$order='DESC'){

	global $con;
	global $chain;

	// check for the Empty table name

	if($request_fn == ''){
		die('* Not chaining function found');
	}

	if($chain==true){
		return $request_fn." ORDER BY {$column_name} ".strtoupper($order)."";

	}

}



function fetch_records($sql=''){

	global $con;
	global $chain;

	$result_set=mysqli_query($con,$sql);
	@$count=@mysqli_num_rows(@$result_set);
	if($count>0){

		while($row=mysqli_fetch_assoc($result_set)){

			$data[]=$row;

		}
		return $data;

	}else{
		//echo 'No record Found';
		return [];
	}


}

//chain function to get words

function where($request_fn='',$where=[]){
global $con;
global $chain;

if($request_fn == ''){
		die('* Not chaining function found ');
}

$sqlwhere = '';
if(count($where)>0){

$sqlwhere = " WHERE";
foreach ($where as $column => $condition_arr) {
$sqlwhere =$sqlwhere." ".$column;

foreach ($condition_arr as $index => $value) {
$sqlwhere = $sqlwhere.$value."'";
}
$sqlwhere = $sqlwhere ." AND ";

}
$sqlwhere = substr($sqlwhere,0,-4);

if($chain==true){
return $request_fn.$sqlwhere;
}

}

}



function create_view($request_fn='',$viewname=''){

	global $con;
	global $chain;

	if($request_fn == ''){
		die('* Not chaining function found ');
	}elseif($viewname == ''){

	}

	if($chain==true){
	return "CREATE VIEW {$viewname} AS ".$request_fn;
}


}


/* 

Function Name : Commit 
Action : Fires Writable Query Given

*/

function commit($query=''){

global $con;
global $chain;

if($query==''):
	die('* No Query Supplied.');
endif;

if(mysqli_query($con,$query)):

	$object['writable'] = 'true';
	$object['affected'] = mysqli_affected_rows($con);
	$object['error'] = mysqli_error($con);
	$object['success']='true';

else:

	$object['writable'] = 'true';
	$object['affected'] = mysqli_affected_rows($con);
	$object['error'] = mysqli_error($con);
	$object['success']='false';

endif;
return $object;

}


function distinct($request_fn='',$column_name=''){
global $con;
global $chain;

if($request_fn == ''){
		die('* Not chaining function found ');
}

if($column_name == ''){
		die('* Not chaining column-name found ');
}

if($chain==true){

	return $request_fn." GROUP BY ".$column_name;
}

}

function having($request_fn='',$column=[]){



}


function rawsql($query=""){

global $con;
global $chain;

$command = explode(" ", $query);

if(preg_match("/SELECT/",strtoupper($command[0]))):

$object['query'] = mysqli_query($con,$query);
$object['writable'] = 'false';
$object['rows_count'] =mysqli_num_rows($object['query']);
$object['error'] = mysqli_error($con);
return $object;

else:

$object['query'] = mysqli_query($con,$query);
$object['writable'] = 'true';
$object['affected'] = mysqli_affected_rows($con);
$object['error'] = mysqli_error($con);

return $object;
endif;

}


function inner_join($joins_params,$on_columns,$where=[]){

	global $con;
	global $chain;

	$jointype='INNER';
	$sqlwhere = '';

	if(count($where)>0){

		$sqlwhere = " WHERE";
		foreach ($where as $column => $condition_arr) {
			$sqlwhere =$sqlwhere." ".$column;

			foreach ($condition_arr as $index => $value) {
				$sqlwhere = $sqlwhere.$value."'";
			}
			$sqlwhere = $sqlwhere ." AND ";

		}
		$sqlwhere = substr($sqlwhere,0,-4);

	}


	$tables_arr=explode('|',$joins_params);
	$pre_table = $tables_arr[0];

	for ($i=1; $i <count($tables_arr); $i++) { 
		$other_table[] = $tables_arr[$i];
	}

	$first_columns=explode('=',$pre_table);
		
	$final[$first_columns[0]]=$first_columns[1];//Main Work

	foreach($other_table as $index => $key){
		$other_columns[]=explode('=',$key);
	}

	foreach ($other_columns as $index => $k){
				$final[$k[0]] = $k[1];
	}

	$tables=array_keys($final);
	$column=array_values($final);


	foreach ($column as $i => $each_column){

		$newcolumn[]=explode(',', $each_column);	
	}


	$select_columns='';
	foreach ($newcolumn as $p => $vvv) {
		
		foreach ($vvv as $i2 => $vvv2) {
			$select_columns = $select_columns."{$tables[$p]}.{$vvv2},";	
		}
	}	

	$select_columns =substr($select_columns, 0,-1);
	$before_from = $tables[0];

	$sql = "SELECT $select_columns FROM $before_from";
	$joins ='';

	foreach ($on_columns as $tb => $common_field) {
		$joins = $joins." $jointype JOIN {$tb} ON (".$common_field.")";

	}
	

	$sql=$sql.$joins.$sqlwhere;
	$result_set=mysqli_query($con,$sql);
	@$count = @mysqli_num_rows(@$result_set);

	// echo $count;
	// exit;
	
	if($chain==true):
		return $sql;
	endif;

	if($count>0){

		while ($row=mysqli_fetch_assoc($result_set)) {
			
			$data[]=$row;
		}

		return $data;

	}else{

		//echo 'No Record Found';
		return [];
	}


}

function left_join($joins_params,$on_columns,$where=[]){
	
	global $con;
	global $chain;

	$jointype='LEFT';
	$sqlwhere = '';

	if(count($where)>0){

		$sqlwhere = " WHERE";
		foreach ($where as $column => $condition_arr) {
			$sqlwhere =$sqlwhere." ".$column;

			foreach ($condition_arr as $index => $value) {
				$sqlwhere = $sqlwhere.$value."'";
			}
			$sqlwhere = $sqlwhere ." AND ";

		}
		$sqlwhere = substr($sqlwhere,0,-4);

	}


	$tables_arr=explode('|',$joins_params);
	$pre_table = $tables_arr[0];

	for ($i=1; $i <count($tables_arr); $i++) { 
		$other_table[] = $tables_arr[$i];
	}

	$first_columns=explode('=',$pre_table);
		
	$final[$first_columns[0]]=$first_columns[1];//Main Work

	foreach($other_table as $index => $key){
		$other_columns[]=explode('=',$key);
	}

	foreach ($other_columns as $index => $k){
				$final[$k[0]] = $k[1];
	}

	$tables=array_keys($final);
	$column=array_values($final);


	foreach ($column as $i => $each_column){

		$newcolumn[]=explode(',', $each_column);	
	}


	$select_columns='';
	foreach ($newcolumn as $p => $vvv) {
		
		foreach ($vvv as $i2 => $vvv2) {
			$select_columns = $select_columns."{$tables[$p]}.{$vvv2},";	
		}
	}	

	$select_columns =substr($select_columns, 0,-1);
	$before_from = $tables[0];

	$sql = "SELECT $select_columns FROM $before_from";
	$joins ='';

	foreach ($on_columns as $tb => $common_field) {
		$joins = $joins." $jointype JOIN {$tb} ON (".$common_field.")";

	}
	

	$sql=$sql.$joins.$sqlwhere;
	$result_set=mysqli_query($con,$sql);
	@$count = @mysqli_num_rows(@$result_set);

	// echo $count;
	// exit;
	
	if($chain==true):
		return $sql;
	endif;

	if($count>0){

		while ($row=mysqli_fetch_assoc($result_set)) {
			
			$data[]=$row;
		}

		return $data;

	}else{

		//echo 'No Record Found';
		return [];
	}


}

function right_join($joins_params,$on_columns,$where=[]){
	
	global $con;
	global $chain;

	$jointype='RIGHT';
	$sqlwhere = '';

	if(count($where)>0){

		$sqlwhere = " WHERE";
		foreach ($where as $column => $condition_arr) {
			$sqlwhere =$sqlwhere." ".$column;

			foreach ($condition_arr as $index => $value) {
				$sqlwhere = $sqlwhere.$value."'";
			}
			$sqlwhere = $sqlwhere ." AND ";

		}
		$sqlwhere = substr($sqlwhere,0,-4);

	}


	$tables_arr=explode('|',$joins_params);
	$pre_table = $tables_arr[0];

	for ($i=1; $i <count($tables_arr); $i++) { 
		$other_table[] = $tables_arr[$i];
	}

	$first_columns=explode('=',$pre_table);
		
	$final[$first_columns[0]]=$first_columns[1];//Main Work

	foreach($other_table as $index => $key){
		$other_columns[]=explode('=',$key);
	}

	foreach ($other_columns as $index => $k){
				$final[$k[0]] = $k[1];
	}

	$tables=array_keys($final);
	$column=array_values($final);


	foreach ($column as $i => $each_column){

		$newcolumn[]=explode(',', $each_column);	
	}


	$select_columns='';
	foreach ($newcolumn as $p => $vvv) {
		
		foreach ($vvv as $i2 => $vvv2) {
			$select_columns = $select_columns."{$tables[$p]}.{$vvv2},";	
		}
	}	

	$select_columns =substr($select_columns, 0,-1);
	$before_from = $tables[0];

	$sql = "SELECT $select_columns FROM $before_from";
	$joins ='';

	foreach ($on_columns as $tb => $common_field) {
		$joins = $joins." $jointype JOIN {$tb} ON (".$common_field.")";

	}
	

	$sql=$sql.$joins.$sqlwhere;
	$result_set=mysqli_query($con,$sql);
	@$count = @mysqli_num_rows(@$result_set);

	// echo $count;
	// exit;
	
	if($chain==true):
		return $sql;
	endif;

	if($count>0){

		while ($row=mysqli_fetch_assoc($result_set)) {
			
			$data[]=$row;
		}

		return $data;

	}else{

		//echo 'No Record Found';
		return [];
	}


}


function where_this($request_fn='',$where=[]){
global $con;
global $chain;

if($request_fn == ''){
		die('* Not chaining function found ');
}


$sqlwhere = '';
if(count($where)>0){

$sqlwhere = " WHERE";
foreach ($where as $column => $condition_arr) {
	$sqlwhere =$sqlwhere." ".$column.$condition_arr;
}

if($chain==true){
	return $request_fn.$sqlwhere;
}

}

}

//To get the Limited Records

function limit($request_fn='',$start='',$offset=''){
global $con;
global $chain;

if($request_fn == ''){
		die('* Not chaining function found ');
}

if($start == ''){
	$start = paginate['from_record_num'];
	
}

if($offset == ''){
	$offset=paginate['records_per_page'];
}

if($chain==true){
	return $request_fn." LIMIT {$start},{$offset} ";
}

}

// get the total Rows count 
function total_rows($sql=''){
	global $con;

if($sql == ''){
		die('* Not chaining function found ');
}

	$result_set=mysqli_query($con,$sql);
	@$count = @mysqli_num_rows(@$result_set);
	return is_null($count)?0:$count;
}


?>