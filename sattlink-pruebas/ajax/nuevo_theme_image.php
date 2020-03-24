<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['tit_image'])) {
           $errors[] = "Título de la imagen vacio!";
        } else if (!empty($_POST['tit_image'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		include_once ("../classes/class.upload.php");
		include ("../classes/options.php");
		include('../funciones.php');
		
		// escaping, additionally removing everything that could be (html/javascript-) code
		$tit_image=mysqli_real_escape_string($con,(strip_tags($_POST["tit_image"],ENT_QUOTES)));
		
		$product_img=$_POST['product_img'];
		
		$img_stat=0;
		if(isset($_FILES['product_img']) && !empty( $_FILES["product_img"]["name"] )) {
			$img_stat=1;
			$handle = new Upload($_FILES["product_img"]);
			if($handle->uploaded) {
				  $handle->Process("../img_uploads/");
				  //$handle->Process("../uploads/");
				  if($handle->processed){
					  $product_img = $handle->file_dst_name;
				  }
				} else {
					//print "Image not upload: " . $handle->error;
					$errors[] = "Aviso imagen del producto: " . $handle->error;
				}
				$handle->clean();
		}
		
		$query = "INSERT INTO themes_images ( theme_image_name, theme_image_titulo ) VALUES ( '$product_img', '$tit_image' )";
		
		$query_new_insert = mysqli_query( $con, $query );
		
		if ($query_new_insert){
			$messages[] = "Plantilla imagen ha sido ingresado satisfactoriamente.";
		} else {
			$errors[]= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
		}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)) {
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
			<div class="alert alert-success" id="alert2" role="alert">
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
