<?php 
	function get_row($table,$row, $id, $equal){
	global $con;
	$query=mysqli_query($con,"select $row from $table where $id='$equal'");
	$rw=mysqli_fetch_array($query);
	$value=$rw[$row];
	return $value;
	}

	function get_val_null($param){
		if ($param=="" or empty($param))    {
			$param=0;
		}
		return $param;
	}

	function get_val_checkbox($param){
		if ($param=="on")    {
			$param=1;
		}else {
			$param=0;
			}
		return $param;
	}



?>