<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include("../funciones.php");
	// escaping, additionally removing everything that could be (html/javascript-) code

	//Variables por GET Recepcion por array
	$adata = $_REQUEST["data"];
	$data = json_decode($adata, true);

	$id_user=intval($data['id_user']);
	$num_hra=intval($data['num_hra']);
	$card_user=$data['card_user'];
	$pasw_user=$data['pasw_user'];
	$date_added=date("Y-m-d H:i:s");
	$status="0";

	$sql_rec_card="INSERT INTO record_cards ( record_card_user_id, record_card_num_hora, record_card_user, record_card_pasw, 
	record_card_date, record_card_used ) VALUES ('$id_user', '$num_hra', '$card_user', '$pasw_user', '$date_added', '$status' )";
	$query_update = mysqli_query($con, $sql_rec_card);

	// Revision de los errores encontrados
	if ($query_update) {
		$retval[] = array('status' => 'success');
	} else {
		$retval[] = array('status' => 'error:' . mysqli_error($con));
	}

	echo json_encode($retval);

?>