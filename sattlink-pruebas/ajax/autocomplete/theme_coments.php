<?php
	if (isset($_GET['id'])) {
		include("../../config/db.php");
		include("../../config/conexion.php");

		/* If connection to database, run sql statement. */
		if ($con) {
			$fetch = mysqli_query( $con,"SELECT * FROM themes_comments order by id" );

			/* Retrieve and store in array the results of the query.*/
			while ($row = mysqli_fetch_array($fetch)) {
				$output[] = array(
					'id' => $row['id'],
					'theme_name' => $row['theme_name']
				);
			}
		}

		/* Free connection resources. */
		//mysqli_close($con);
	}
	echo json_encode($output);
?>