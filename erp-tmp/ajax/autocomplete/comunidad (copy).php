<?php
if (isset($_GET['term'])) {
	include("../../config/db.php");
	include("../../config/conexion.php");
	$return_arr = array();
	
	/* If connection to database, run sql statement. */
	if ($con) {
		$fetch = mysqli_query($con,"SELECT * FROM users where user_comunidad like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 

		/* Retrieve and store in array the results of the query.*/
		while ($row = mysqli_fetch_array($fetch)) {
			$user_id=$row['user_id'];
			$row_array['value']=$row['user_comunidad'];
			$row_array['user_id']=$user_id;
			$row_array['user_comunidad']=$row['user_comunidad'];
			array_push($return_arr,$row_array);
		}
	}

	/* Free connection resources. */
	mysqli_close($con);

	/* Toss back results as json encoded array. */
	echo json_encode($return_arr);

}
?>