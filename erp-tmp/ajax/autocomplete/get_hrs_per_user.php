<?php
	if (isset($_GET['idusercom'])) {
		include("../../config/db.php");
		include("../../config/conexion.php");

		/* If connection to database, run sql statement. */
		if ($con) {
			
			$idusercom=$_GET['idusercom'];
			
			$cSql="SELECT 
    		COUNT(CASE WHEN record_card_user_id = '$idusercom' AND record_card_num_hora = 1 THEN 1 END) AS count1,
			COUNT(CASE WHEN record_card_user_id = '$idusercom' AND record_card_num_hora = 2 THEN 1 END) AS count2,
			COUNT(CASE WHEN record_card_user_id = '$idusercom' AND record_card_num_hora = 3 THEN 1 END) AS count3,
			COUNT(CASE WHEN record_card_user_id = '$idusercom' AND record_card_num_hora = 4 THEN 1 END) AS count4,
			COUNT(CASE WHEN record_card_user_id = '$idusercom' AND record_card_num_hora = 5 THEN 1 END) AS count5,
			COUNT(CASE WHEN record_card_user_id = '$idusercom' AND record_card_num_hora = 6 THEN 1 END) AS count6 
			FROM record_cards"; 
			
			$fetch = mysqli_query($con,$cSql);

			/* Retrieve and store in array the results of the query.*/
			while ($row = mysqli_fetch_array($fetch)) {
				$output[] = array(
				'gethrs1' => $row['count1'],
				'gethrs2' => $row['count2'],
				'gethrs3' => $row['count3'],
				'gethrs4' => $row['count4'],
				'gethrs5' => $row['count5'],
				'gethrs6' => $row['count6']
			  );

			}
		}

		/* Free connection resources. */
		//mysqli_close($con);

		/* Toss back results as json encoded array. */
		echo json_encode($output);
	}
?>