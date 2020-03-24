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
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Editar Factura | Simple Invoice";
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	include("funciones.php");
	
	if (isset($_GET['id_factura']))
	{
		$id_factura=intval($_GET['id_factura']);
		$campos="clientes.id_cliente, tipo_cliente, clientes.nombre_cliente, ape_pat_cliente, ape_mat_cliente,clientes.telefono_cliente, clientes.email_cliente, 
		facturas.id_vendedor, facturas.fecha_factura, facturas.condiciones, facturas.estado_factura, facturas.numero_factura, 
		tipo_doc, tipo_prec_cliente, cliente_foraneo, tel_cliente_foraneo, email_cliente_foraneo";
		$sql_factura=mysqli_query($con,"select $campos from facturas, clientes where facturas.id_cliente=clientes.id_cliente and id_factura='".$id_factura."'");
		$count=mysqli_num_rows($sql_factura);
		if ($count==1)
		{
				$rw_factura=mysqli_fetch_array($sql_factura);
				$id_cliente=$rw_factura['id_cliente'];
				$tipo_doc=$rw_factura['tipo_doc'];
				
				$id_cli_foraneo=get_row('perfil','numeracion_cliente_foraneo', 'id_perfil', 1);
				if ($id_cli_foraneo <> $id_cliente) {
					$tipo_cliente=$rw_factura['tipo_cliente'];
				    $nombre_gral=$rw_factura['nombre_cliente'];
				    if($tipo_cliente==1) {
						$nombre_gral=$nombre_gral.' '.$rw_factura['ape_pat_cliente'].' '.$rw_factura['ape_mat_cliente'];
					}
					
					$nombre_cliente=$nombre_gral;
					$telefono_cliente=$rw_factura['telefono_cliente'];
					$email_cliente=$rw_factura['email_cliente'];
				} else {
					$nombre_cliente=$rw_factura['cliente_foraneo'];
					$telefono_cliente=$rw_factura['tel_cliente_foraneo'];
					$email_cliente=$rw_factura['email_cliente_foraneo'];
				}
			
				$id_vendedor_db=$rw_factura['id_vendedor'];
				$fecha_factura=date("d/m/Y", strtotime($rw_factura['fecha_factura']));
				$condiciones=$rw_factura['condiciones'];
				$estado_factura=$rw_factura['estado_factura'];
				$numero_factura=$rw_factura['numero_factura'];
				$tipo_prec_cliente=$rw_factura['tipo_prec_cliente'];
				$_SESSION['id_factura']=$id_factura;
				$_SESSION['numero_factura']=$numero_factura;
			
				if($tipo_doc==1) {
					$Titulo_doc = "VENTA Nº " . $numero_factura;
				} else if($tipo_doc==2) {
					$Titulo_doc = "COTIZACION Nº " . $numero_factura;
				}
		}	
		else
		{
			header("location: facturas.php");
			exit;	
		}
	} 
	else 
	{
		header("location: facturas.php");
		exit;
	}
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
	<div class="panel panel-info">
		<div class="panel-heading">
			<h4 id="titHead" ><i class='glyphicon glyphicon-edit' ></i> Editar Documento <?php echo $Titulo_doc;?> </h4>
		</div>
		<div class="panel-body">
		<?php 
			include("modal/buscar_productos.php");
			include("modal/registro_clientes.php");
			include("modal/registro_productos.php");
		?>
			<form class="form-horizontal" role="form" id="datos_factura">
				
				<div class="form-group row">
				<label for="tipodoc" class="col-md-1 control-label">TIPO:</label>
					<div class="col-md-3">
						<select class='form-control input-sm' id="tipo_doc" disabled >
							<option value="1" <?php if ($tipo_doc==1){echo "selected";}?>>VENTA</option>
							<option value="2" <?php if ($tipo_doc==2){echo "selected";}?>>COTIZACION</option>
					</select>
					</div>
					
					<?php
						if($tipo_doc==2) { ?>
							<button type="button" class="btn btn-success pull-right" id="cotiz_venta" onclick="change_cotiz_venta('<?php echo $numero_factura;?>');">
								  <span class="glyphicon glyphicon-refresh"></span> Convertir a Venta
							</button>
						<?php }
					?>
					
				</div>
				
				<div class="form-group row">
				  <label for="nombre_cliente" class="col-md-1 control-label">Cliente:</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="nombre_cliente" name="nombre_cliente" placeholder="Selecciona un cliente" value="<?php echo $nombre_cliente;?>" required disabled>
					  <input id="id_cliente" name="id_cliente" type='hidden' value="<?php echo $id_cliente;?>">	
					  <input id="tipo_prec_cliente" type='hidden' value="<?php echo $tipo_prec_cliente;?>">
				  </div>
				  <label for="tel1" class="col-md-1 control-label">Teléfono:</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="tel1" name="tel1" placeholder="Teléfono" value="<?php echo $telefono_cliente;?>" >
							</div>
					<label for="mail" class="col-md-1 control-label">Email:</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" id="mail" name="mail" placeholder="Email" value="<?php echo $email_cliente;?>" >
							</div>
				 </div>
						<div class="form-group row">
							<label for="empresa" class="col-md-1 control-label">Vendedor:</label>
							<div class="col-md-3">
								<select class="form-control input-sm" id="id_vendedor" name="id_vendedor" required>
									<?php
										$sql_vendedor=mysqli_query($con,"select * from users order by lastname");
										while ($rw=mysqli_fetch_array($sql_vendedor)){
											$id_vendedor=$rw["user_id"];
											$nombre_vendedor=$rw["firstname"]." ".$rw["lastname"];
											if ($id_vendedor==$id_vendedor_db){
												$selected="selected";
											} else {
												$selected="";
											}
											?>
											<option value="<?php echo $id_vendedor?>" <?php echo $selected;?>><?php echo $nombre_vendedor?></option>
											<?php
										}
									?>
								</select>
							</div>
							<label for="tel2" class="col-md-1 control-label">Fecha:</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="fecha" value="<?php echo $fecha_factura;?>" required>
							</div>
							<label for="email" class="col-md-1 control-label">Pago:</label>
							<div class="col-md-2">
								<select class='form-control input-sm' id="condiciones" name="condiciones" required >
									<option value="1" <?php if ($condiciones==1){echo "selected";}?>>Efectivo</option>
									<option value="2" <?php if ($condiciones==2){echo "selected";}?>>Cheque</option>
									<option value="3" <?php if ($condiciones==3){echo "selected";}?>>Transferencia bancaria</option>
									<option value="4" <?php if ($condiciones==4){echo "selected";}?>>Crédito</option>
								</select>
							</div>
							<div class="col-md-2">
								<select class='form-control input-sm ' id="estado_factura" name="estado_factura" required>
									<option value="1" <?php if ($estado_factura==1){echo "selected";}?>>Pagado</option>
									<option value="2" <?php if ($estado_factura==2){echo "selected";}?>>Pendiente</option>
								</select>
							</div>
						</div>
				
				<div class="col-md-12">
					<div class="pull-right">
						<button type="submit" class="btn btn-primary" id="button1" >
						  <span class="glyphicon glyphicon-refresh"></span> Actualizar datos
						</button>
						<button type="button" class="btn btn-primary" id="button2" data-toggle="modal" data-target="#nuevoProducto">
						 <span class="glyphicon glyphicon-plus"></span> Nuevo producto
						</button>
						<button type="button" class="btn btn-primary" id="button3" data-toggle="modal" data-target="#nuevoCliente">
						 <span class="glyphicon glyphicon-user"></span> Nuevo cliente
						</button>
						<button type="button" class="btn btn-primary" id="button4" data-toggle="modal" data-target="#myModal" onclick="p_agregar_prod();">
						 <span class="glyphicon glyphicon-search"></span> Agregar productos
						</button>
						<button type="button" class="btn btn-primary" id="button5" onclick="imprimir_factura('<?php echo $id_factura;?>')">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					</div>	
				</div>
			
			</form>	
			<div class="clearfix"></div>
				<div class="editar_factura" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->	
			
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->			
			
		</div>
	</div>		
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/editar_factura.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
	<script>
		
		$(document).ready(function() {
			var tipo_doc=<?php echo $tipo_doc;?>;
			var i;
			
			$('#nombre_cliente').attr('disabled', tipo_doc == 1 ? true : false);
			$('#tel1').attr('disabled', tipo_doc == 1 ? true : false);
			$('#mail').attr('disabled', tipo_doc == 1 ? true : false);
			$('#id_vendedor').attr('disabled', tipo_doc == 1 ? true : false);
			$('#fecha').attr('disabled', tipo_doc == 1 ? true : false);
			
			$('#condiciones').attr('disabled', tipo_doc == 1 ? true : false);
			//$('#estado_factura').attr('disabled', tipo_doc == 1 ? true : true);
			
			for(i=2; i<=5; i++) {
				$('#button'+i).attr('disabled', tipo_doc == 1 ? true : false);
			}
			//$( "#resultados" ).load( "ajax/editar_facturacion.php" );
		});
		
		$(function() {
					$("#nombre_cliente").autocomplete({
						source: "./ajax/autocomplete/clientes.php",
						minLength: 2,
						select: function(event, ui) {
							event.preventDefault();
							$('#id_cliente').val(ui.item.id_cliente);
							$('#nombre_cliente').val(ui.item.nombre_cliente);
							$('#tel1').val(ui.item.telefono_cliente);
							$('#mail').val(ui.item.email_cliente);
						 }
					});
		});

		$("#nombre_cliente" ).on( "keydown", function( event ) {
					if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE ) {
						$("#id_cliente" ).val("");
						$("#tel1" ).val("");
						$("#mail" ).val("");
					}
					if (event.keyCode==$.ui.keyCode.DELETE){
						$("#nombre_cliente" ).val("");
						$("#id_cliente" ).val("");
						$("#tel1" ).val("");
						$("#mail" ).val("");
					}
		});

		function p_agregar_prod() {
				var page=1;
				var q= $("#q").val();
				var tipoprecclie = $('#tipo_prec_cliente').val();
				$("#loader").fadeIn('slow');
				$.ajax({
					url:'ajax/productos_factura.php?action=ajax&page='+page+'&q='+q+'&tipoprecclie='+tipoprecclie,
					 beforeSend: function(objeto){
					 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
				},
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					}
				})
		}

			// Convertir cotizacion a venta para afectar los productos
		function change_cotiz_venta( _nf ) {

				if (id_cliente==""){
					  alert("Debes seleccionar un cliente !");
					  $("#nombre_cliente").focus();
					  return false;
				  }

				var numero_docum = _nf;

				 $.ajax({
						type: "POST",
						url: 'ajax/cotiza-venta.php',
						data: "numero_docum="+numero_docum,
						beforeSend: function(objeto){
							$(".editar_factura").html("Mensaje: Cargando...");
					  },
					success: function(datos) {
						$(".editar_factura").html(datos);
						
						var newtit_doc = "VENTA Nº " + <?php echo $numero_factura;?>;
						
						//titHead.innerText = "public offers";
						//$("#titHead h4").text("New header");
						$("#titHead").text(newtit_doc);
						
						$("#nombre_cliente").prop("disabled", true);
						$("#id_vendedor").prop("disabled", true);
						
						//Refrescar detalles
						$( "#resultados" ).load( "ajax/editar_facturacion.php" );
						
						//Deshabilitar botones, el de actualizar encabezado no se deshabilita
						$("#cotiz_venta").prop("disabled", true);
						var i;
						for(i=2; i<=5; i++) {
							$('#button'+i).attr('disabled', true);
						}
						
					}
				});
		}	
		
	</script>

  </body>
</html>