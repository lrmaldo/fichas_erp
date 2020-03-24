<?php
	if (isset($_GET['nombre_comuni'])) {
		include("../../config/db.php");
		include("../../config/conexion.php");

		/* If connection to database, run sql statement. */
		if ($con) {
			$fetch = mysqli_query($con,"SELECT user_id,user_name FROM users where user_comunidad like '%" . mysqli_real_escape_string($con,($_GET['nombre_comuni'])) . "%' LIMIT 0 ,50"); 
			//$fetch = mysqli_query($con,"SELECT user_id,user_name FROM users where user_comunidad like '%Comunidad%' LIMIT 0 ,50"); 

			/* Retrieve and store in array the results of the query.*/
			while ($row = mysqli_fetch_array($fetch)) {
				$output[] = array(
				'id' => $row['user_id'],
				'user_name' => $row['user_name'] // Don't you want the name?
			  );

			}
		}

		/* Free connection resources. */
		//mysqli_close($con);

		/* Toss back results as json encoded array. */
		echo json_encode($output);

	}
?>