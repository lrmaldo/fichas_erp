<?php
if (isset($_GET['term'])) {
	include("../../config/db.php");
	include("../../config/conexion.php");
	$return_arr = array();
	
	/* If connection to database, run sql statement. */
	if ($con) {
		$fetch = mysqli_query($con,"SELECT * FROM comunidades where nombre_comunidad like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 

		/* Retrieve and store in array the results of the query.*/
		while ($row = mysqli_fetch_array($fetch)) {
			$id_comunidad=$row['id_comunidad'];
			$row_array['value']=$row['nombre_comunidad'];
			$row_array['id_comunidad']=$id_comunidad;
			$row_array['nombre_comunidad']=$row['nombre_comunidad'];
			array_push($return_arr,$row_array);
		}
	}

	/* Free connection resources. */
	//mysqli_close($con);

	/* Toss back results as json encoded array. */
	echo json_encode($return_arr);

}
?>