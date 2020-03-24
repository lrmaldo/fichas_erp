<?php
	/*-------------------------
	Autor: Elio Mojica
	Web: maximcode.com
	Mail: admin@maximcode.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

	require_once ("menus.php");
	$active_perfil="active";
	$title="Nueva compra | Maxim Inventory";
	
	$query_empresa=mysqli_query($con,"select * from perfil where id_perfil=1");
	$row=mysqli_fetch_array($query_empresa);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
	<?php include("head.php");?>
  </head>
  <body>
 	<?php
	include("navbar.php");
	?> 
	<div class="container">
      <div class="row">
      <form method="post" id="perfil">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><i class='glyphicon glyphicon-cog'></i> Configuración</h3>
            </div>
            <div class="panel-body">
              <div class="row">
				  
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#home">EMPRESA</a></li>
					<li><a data-toggle="tab" href="#clientes">CLIENTES</a></li>
					<li><a data-toggle="tab" href="#smtp">CORREO SMTP</a></li>
			  	</ul>  
				
				<div class="tab-content"> <!-- tab-content -->
					
						<div id="home" class="tab-pane fade in active">
							<br>
							<div class="col-md-3 col-lg-3 " align="center"> 
							<div id="load_img">
								<img class="img-responsive" src="<?php echo $row['logo_url'];?>" alt="Logo">

							</div>
							<br>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<input class='filestyle' data-buttonText="Logo" type="file" name="imagefile" id="imagefile" onchange="upload_image();">
										</div>
									</div>

								</div>
							</div>
							<div class=" col-md-9 col-lg-9 "> 
							  <table class="table table-condensed">
								<tbody>
								  <tr>
									<td class='col-md-3'>Nombre de la empresa:</td>
									<td><input type="text" class="form-control input-sm" name="nombre_empresa" value="<?php echo $row['nombre_empresa']?>" required></td>
								  </tr>
								  <tr>
									<td>Teléfono:</td>
									<td><input type="text" class="form-control input-sm" name="telefono" value="<?php echo $row['telefono']?>" required></td>
								  </tr>
								  <tr>
									<td>Correo electrónico:</td>
									<td><input type="email" class="form-control input-sm" name="email" value="<?php echo $row['email']?>" ></td>
								  </tr>
								  <tr>
									<td>IVA (%):</td>
									<td><input type="text" class="form-control input-sm" required name="impuesto" value="<?php echo $row['impuesto']?>"></td>
								  </tr>
								  <tr>
									<td>Simbolo de moneda:</td>
									<td>
										<select class='form-control input-sm' name="moneda" required>
													<?php 
														//$sql="select name, symbol from  currencies group by symbol order by name ";
														$sql="select name, symbol from currencies order by name";
														$query=mysqli_query($con, $sql);
														while($rw=mysqli_fetch_array($query)){
															$simbolo=$rw['symbol'];
															$moneda=$rw['name'];
															if ($row['moneda']==$simbolo){
																$selected="selected";
															} else {
																$selected="";
															}
															?>
															<option value="<?php echo $simbolo;?>" <?php echo $selected;?>><?php echo ($simbolo);?></option>
															<?php
														}
													?>
										</select>
									</td>
								  </tr>
								  <tr>
									<td>Dirección:</td>
									<td><input type="text" class="form-control input-sm" name="direccion" value="<?php echo $row["direccion"];?>" required></td>
								  </tr>
								  <tr>
									<td>Ciudad:</td>
									<td><input type="text" class="form-control input-sm" name="ciudad" value="<?php echo $row["ciudad"];?>" required></td>
								  </tr>
								  <tr>
									<td>Región/Provincia:</td>
									<td><input type="text" class="form-control input-sm" name="estado" value="<?php echo $row["estado"];?>"></td>
								  </tr>
								  <tr>
									<td>Código postal:</td>
									<td><input type="text" class="form-control input-sm" name="codigo_postal" value="<?php echo $row["codigo_postal"];?>"></td>
								  </tr>
								</tbody>
							  </table>
						</div>
				
					 </div> <!-- Close #home -->
								
						
					<div id="clientes" class="tab-pane fade">
						<p>Una vez utilizado no debe cambiarse salvo cree otro registro.</p>
						<div class=" col-md-9 col-lg-9 "> 
							  <table class="table table-condensed">
								<tbody>
								  <tr>
									<td>Número para cliente foraneo:</td>
									<td><input type="number" class="form-control input-sm" name="num_cli_foran" value="<?php echo $row["numeracion_cliente_foraneo"];?>" min="0" step="1" value="0" ></td>
								  </tr>
								</tbody>
							  </table>
						</div>
					</div> <!-- Close #clientes -->
					
					<div id="smtp" class="tab-pane fade">
						<div class=" col-md-9 col-lg-9 ">
							  <table class="table table-condensed">
								<tbody>
								  <tr>
									<td>Utilizar SMTP:</td>
									<td class='col-xs-4' ><div class="pull-left">
										<select class='form-control input-sm' id="activate_smtp" name="activate_smtp" >
											<option value="1">Activado</option>
											<option value="0">Desactivado</option>
										</select>
									</div></td>
								  </tr>
								  <tr>
									<td>Tipo de Encriptación:</td>
									<td class='col-xs-3' ><div class="pull-left">
										<select class='form-control input-sm' id="type_encript" name="type_encript" >
											<option value="1">SSL</option>
											<option value="0">TLS</option>
										</select>
									</div></td>
								  </tr>
								  <tr>
									<td>Nombre del servidor host:</td>
										<td><input type="text" class="form-control input-sm" name="host_mail" value="<?php echo $row["host_mail"];?>" ></td>
								  </tr>
								  <tr>
									<td>Numero de puerto:</td>
									<td><input type="number" class="form-control input-sm" name="host_port" value="<?php echo $row["host_port"];?>" min="0" step="1" value="0" ></td>
								  </tr>
									
								  <tr>
									<td>Asunto del mensaje:</td>
									<td><input type="text" class="form-control input-sm" name="subject" value="<?php echo $row["subject"];?>" required maxlength="100" ></td>
								  </tr>
									
								  <tr>
									<td>Cuerpo del mensaje:</td>
									<td><textarea class="form-control input-sm" name="body" rows="6" cols="12" required maxlength="255" ><?php echo $row["body"];?></textarea></td>
								  </tr>
									
								</tbody>
							  </table>
						</div>
					</div> <!-- Close #smtp -->
							
					   
		  </div> <!-- Close tab-content -->
				  
				  </div>
				<div class='col-md-12' id="resultados_ajax"></div><!-- Carga los datos ajax -->
              </div>
            </div>
                 <div class="panel-footer text-center">
                            <button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-refresh"></i> Actualizar datos</button>
                    </div>
            
          </div>
        </div>
		</form>
      </div>

	
	<?php
	include("footer.php");
	?>
  </body>
</html>
<script type="text/javascript" src="js/bootstrap-filestyle.js"> </script>


<script>
		
		$(document).ready(function() {
			$('#activate_smtp').val(<?php echo $row["activate_smtp"];?>);
			$('#type_encript').val(<?php echo $row["type_encript"];?>);
			
		});
	
	
		$( "#perfil" ).submit(function( event ) {
		  $('.guardar_datos').attr("disabled", true);

		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/editar_perfil.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax").html(datos);
					$('.guardar_datos').attr("disabled", false);

				  }
			});
		  event.preventDefault();
		})

		function upload_image(){
				
				var inputFileImage = document.getElementById("imagefile");
				var file = inputFileImage.files[0];
				if( (typeof file === "object") && (file !== null) )
				{
					$("#load_img").text('Cargando...');	
					var data = new FormData();
					data.append('imagefile',file);
					
					
					$.ajax({
						url: "ajax/imagen_ajax.php",        // Url to which the request is send
						type: "POST",             // Type of request to be send, called as method
						data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						success: function(data)   // A function to be called if request succeeds
						{
							$("#load_img").html(data);
							
						}
					});	
				}
				
				
			}
    </script>

