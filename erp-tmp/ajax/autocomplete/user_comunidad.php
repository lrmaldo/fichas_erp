<?php
	if (isset($_GET['id_comunidad'])) {
		include("../../config/db.php");
		include("../../config/conexion.php");

		/* If connection to database, run sql statement. */
		if ($con) {
			$fetch = mysqli_query($con,"SELECT user_id, user_name FROM users where user_comunidad = " . $_GET['id_comunidad'] );

			/* Retrieve and store in array the results of the query.*/
			while ($row = mysqli_fetch_array($fetch)) {
				$output[] = array(
					'user_id' => $row['user_id'],
					'user_name' => $row['user_name']
				);
			}
		}

		/* Free connection resources. */
		//mysqli_close($con);
	}
	echo json_encode($output);
?>