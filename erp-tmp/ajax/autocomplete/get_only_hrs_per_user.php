<?php
	if (isset($_GET['idusercom'])) {
		include("../../config/db.php");
		include("../../config/conexion.php");

		/* If connection to database, run sql statement. */
		if ($con) {
			
			$idusercom=$_GET['idusercom'];
			$nnidopt=$_GET['nnidopt'];
			
			echo "=" . $nnidopt;
			
			$cSql="SELECT COUNT(*) AS count1 FROM record_cards WHERE record_card_user_id = '$idusercom' AND record_card_num_hora = '$nnidopt'";
			$fetch = mysqli_query($con, $cSql);

			/* Retrieve and store in array the results of the query.*/
			while ($row = mysqli_fetch_array($fetch)) {
				$output[] = array( 'gethrsel' => $row['count1']  );

		}

		/* Free connection resources. */
		//mysqli_close($con);

		/* Toss back results as json encoded array. */
		echo json_encode($output);

	}
?>