<?php
	if (isset($_GET['idusercom'])) {
		include("../../config/db.php");
		include("../../config/conexion.php");

		/* If connection to database, run sql statement. */
		if ($con) {
			$fetch = mysqli_query($con,"SELECT * from users where user_id =" . $_GET['idusercom'] ); 

			/* Retrieve and store in array the results of the query.*/
			while ($row = mysqli_fetch_array($fetch)) {
				$output[] = array(
				'firstname' => $row['firstname'],
				'lastname' => $row['lastname'],
				'user_email' => $row['user_email'],
				'user_whatsap' => $row['user_whatsap'],
				'user_facebook' => $row['user_facebook']
			  );

			}
		}

		/* Free connection resources. */
		//mysqli_close($con);

		/* Toss back results as json encoded array. */
		echo json_encode($output);

	}
?>