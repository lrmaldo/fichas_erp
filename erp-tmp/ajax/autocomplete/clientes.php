<?php
if (isset($_GET['term'])){
include("../../config/db.php");
include("../../config/conexion.php");
$return_arr = array();
/* If connection to database, run sql statement. */
if ($con)
{
	//$fetch = mysqli_query($con,"SELECT * FROM clientes where nombre_cliente like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	$fetch = mysqli_query($con,"SELECT * FROM clientes where ( nombre_cliente like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' or ape_pat_cliente like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' ) LIMIT 0 ,50"  ); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_cliente=$row['id_cliente'];
		$row_array['value'] = $row['nombre_cliente'];
		$row_array['id_cliente']=$id_cliente;
		$row_array['tipo_cliente']=$row['tipo_cliente'];
		$row_array['nombre_cliente']=$row['nombre_cliente'];
		$row_array['ape_pat_cliente']=$row['ape_pat_cliente'];
		$row_array['ape_mat_cliente']=$row['ape_mat_cliente'];
		$row_array['telefono_cliente']=$row['telefono_cliente'];
		$row_array['email_cliente']=$row['email_cliente'];
		$row_array['tipo_prec_cliente']=$row['tipo_prec_cliente'];
		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
mysqli_close($con);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>