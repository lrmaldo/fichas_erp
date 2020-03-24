<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['th_coment'])) {
           $errors[] = "Es obligatorio la descripción de la plantilla comentario o mensajes!";
        } else if (!empty($_POST['th_coment'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		include('../funciones.php');
		// escaping, additionally removing everything that could be (html/javascript-) code
		$th_coment=mysqli_real_escape_string($con,(strip_tags($_POST["th_coment"],ENT_QUOTES)));
		
		$sql="INSERT INTO themes_comments (theme_name) VALUES ('$th_coment')";
		
		$query_new_insert = mysqli_query( $con, $sql );
		
		if ($query_new_insert){
			$messages[] = "Descripción de la plantilla comentarios o mensajes ha sido ingresado satisfactoriamente.";
		} else{
			$errors[]= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
		}
		
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div style="position: relative; height: 200px; border: 3px solid #8AC007;" class="alert alert-danger" id="alert1" role="alert">
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
			if (isset($messages)) {
				?>
				<div style="position: relative; height: 200px; border: 3px solid #8AC007;" class="alert alert-success" id="alert2" role="alert">
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