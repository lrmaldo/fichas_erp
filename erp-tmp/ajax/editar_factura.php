<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	$id_factura= $_SESSION['id_factura'];
	/*Inicia validacion del lado del servidor*/

		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		include("../funciones.php");
		// escaping, additionally removing everything that could be (html/javascript-) code
		
		$cpr=0;
		foreach ($_POST as $param_name => $param_val) {
			//echo "Param: $param_name; Value: $param_val<br />\n";
			$cpr++;
		}

		$id_cliente=intval($_POST['id_cliente']);
		$nombre_cliente=$_POST['nombre_cliente'];
		$tel1=$_POST['tel1'];
		$mail=$_POST['mail'];
		$id_vendedor=intval($_POST['id_vendedor']);
		$condiciones=intval($_POST['condiciones']);
		$estado_factura=intval($_POST['estado_factura']);

		if($id_cliente==0) {
			$id_cliente=get_row('perfil','numeracion_cliente_foraneo', 'id_perfil', 1);
		} else {
			$nombre_cliente="";
			$tel1="";
			$mail="";
		}

		if($cpr > 2) {
			if($id_cliente==0) {
				$id_cliente=get_row('perfil','numeracion_cliente_foraneo', 'id_perfil', 1);
			}
			$sql="UPDATE facturas SET id_cliente='".$id_cliente."', id_vendedor='".$id_vendedor."', 
			condiciones='".$condiciones."', estado_factura='".$estado_factura."',cliente_foraneo='".$nombre_cliente.
			"',tel_cliente_foraneo='".$tel1."', email_cliente_foraneo='".$mail."' WHERE id_factura='".$id_factura."'";		
		
		} else if($cpr = 2) {
			$sql="UPDATE facturas SET estado_factura='".$estado_factura."' WHERE id_factura='".$id_factura."'";		
		}
		
		$query_update = mysqli_query($con,$sql);
		if ($query_update){
			$messages[] = "Documento ha sido actualizado satisfactoriamente.";
		} else{
			$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
		}
		
		if (isset($errors)) {
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
							echo $error;
						}
						?>
			</div>
			<?php
		}
		if (isset($messages)){
			?>
			<div class="alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>¡Bien hecho!</strong>
					<?php
						foreach ($messages as $message) {
							echo $message;
						}
					?>
				</div>
			<?php
			}
			

?>