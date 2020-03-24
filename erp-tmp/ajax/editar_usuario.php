<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
}		
		if (empty($_POST['firstname2'])){
			$errors[] = "Nombres vacíos";
		} elseif (empty($_POST['lastname2'])){
			$errors[] = "Apellidos vacíos";
		}  elseif (empty($_POST['user_name2'])) {
            $errors[] = "Nombre de usuario vacío";
        }  elseif (strlen($_POST['user_name2']) > 64 || strlen($_POST['user_name2']) < 2) {
            $errors[] = "Nombre de usuario no puede ser inferior a 2 o más de 64 caracteres";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name2'])) {
            $errors[] = "Nombre de usuario no encaja en el esquema de nombre: Sólo aZ y los números están permitidos , de 2 a 64 caracteres";
        } elseif (empty($_POST['user_email2'])) {
            $errors[] = "El correo electrónico no puede estar vacío";
        } elseif (strlen($_POST['user_email2']) > 64) {
            $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
        } elseif (!filter_var($_POST['user_email2'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
        } elseif (
			!empty($_POST['user_name2'])
			&& !empty($_POST['firstname2'])
			&& !empty($_POST['lastname2'])
            && strlen($_POST['user_name2']) <= 64
            && strlen($_POST['user_name2']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name2'])
            && !empty($_POST['user_email2'])
            && strlen($_POST['user_email2']) <= 64
            && filter_var($_POST['user_email2'], FILTER_VALIDATE_EMAIL)
          )
         {
            	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
				require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
			 	include('../funciones.php');
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $firstname = mysqli_real_escape_string($con,(strip_tags($_POST["firstname2"],ENT_QUOTES)));
				$lastname = mysqli_real_escape_string($con,(strip_tags($_POST["lastname2"],ENT_QUOTES)));
				$user_name = mysqli_real_escape_string($con,(strip_tags($_POST["user_name2"],ENT_QUOTES)));
                $user_email = mysqli_real_escape_string($con,(strip_tags($_POST["user_email2"],ENT_QUOTES)));
				
				$user_id=intval($_POST['mod_id']);
			 
				//II parte
				$mod_user_comunidad=$_POST['mod_user_comunidad'];
				$mod_user_hotspot=$_POST['mod_user_hotspot'];
				$mod_user_face=$_POST['mod_user_face'];
				$mod_user_whatsap=$_POST['mod_user_whatsap'];
				$mod_user_coment=$_POST['mod_user_coment'];
				$mod_user_porcent=$_POST['mod_user_porcent'];
			 
			 	//III parte
				$prec_hra1=intval($_POST['mod_prec_hra1']);
				$prec_hra2=intval($_POST['mod_prec_hra2']);
				$prec_hra3=intval($_POST['mod_prec_hra3']);
				$prec_hra4=intval($_POST['mod_prec_hra4']);
				$prec_hra5=intval($_POST['mod_prec_hra5']);
				$prec_hra6=intval($_POST['mod_prec_hra6']);
			 	$print_pf=get_val_checkbox( $_POST['mod_print_pf'] );
			 
			 	//echo "print_pf: " . $print_pf;
               
				// write new user's data into database
                //$sql = "UPDATE users SET firstname='".$firstname."', lastname='".$lastname."', user_name='".$user_name."', user_email='".$user_email."'
                //       WHERE user_id='".$user_id."';";
                $sql = "UPDATE users SET firstname='".$firstname."', lastname='".$lastname."', user_name='".$user_name."', user_email='".$user_email.
                       "', user_comunidad='".$mod_user_comunidad."', user_hotspot='".$mod_user_hotspot."', user_facebook='".$mod_user_face.
					   "', user_whatsap='".$mod_user_whatsap."', user_comentarios='".$mod_user_coment."', user_porcent='".$mod_user_porcent.
					   "', prec_hra1='" . $prec_hra1 . "', prec_hra2='" . $prec_hra2 . "', prec_hra3='" . $prec_hra3 . "', prec_hra4='" . $prec_hra4 . 
					   "', prec_hra5='" . $prec_hra5 . "', prec_hra6='" . $prec_hra6 . "', print_prec_fichas='" . $print_pf . "' WHERE user_id='".$user_id."';";

                $query_update = mysqli_query($con,$sql);

                // if user has been added successfully
                if ($query_update) {
                    $messages[] = "La cuenta ha sido modificada con éxito.";
                } else {
                    $errors[] = "Lo sentimos , la actualizacion falló. Por favor, regrese y vuelva a intentarlo.";
                }
                
            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
        }
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" id="alert1" role="alert">
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