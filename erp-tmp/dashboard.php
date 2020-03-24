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
	$active_dashboard="active";
	$active_comunidad="";
	$title="DashBoard | Maxim Card";

	//echo "User: " . $_SESSION['user_name'];

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
    <div class="container-fluid">
		<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" ></span> Nuevo Usuario</button>
			</div>
			<div class="btn-group pull-right">
				<a  href="nueva_consulta.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nueva Consulta</a>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Usuarios</h4>
		</div>
			<div class="panel-body">
			<?php
			include("modal/registro_usuarios.php");
			include("modal/editar_usuarios.php");
			include("modal/cambiar_password.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Nombre:</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre" onkeyup='load(1);'>
							</div>
							
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
						</div>
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			</div>
		</div>
		
		<div id="dialog-confirm" hidden >
			<textarea disabled class='form-control' id='nombrel' name='nombrel' placeholder='' cols="60" rows="20" maxlength='255'>
				    De acuerdo a la politica establecida se hace del  conocimiento que una vez descargada la información el usuario	se hace responsable no existiendo cambios ni ajustes a los mismos, es importante  subrayar  que  si  se  tiene  el PDF en linea deba descargar o imprimir inmediatamente la información, en el caso de la  descarga  como  libro de Excel solo debe de estar al pendiente y observar el estatus de la misma.
			</textarea>
		</div>

	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/dashboard.js"></script>
	<link rel="stylesheet" href="js/jquery-ui.css">
	<script src="js/jquery-ui.js"></script>

  </body>
</html>

<script>
	
$( "#guardar_usuario" ).submit(function( event ) {
 $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_usuario.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_usuario" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_usuario.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos2').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_password" ).submit(function( event ) {
  $('#actualizar_datos3').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_password.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax3").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax3").html(datos);
			$('#actualizar_datos3').attr("disabled", false);
			load(1);
		  }
		});
	  event.preventDefault();
	})

	function get_user_id(id){
		$("#user_id_mod").val(id);
	}

	function obtener_datos(id) {
			
			$('#myModal2').find('form').trigger('reset');
		
			var nombres = $("#nombres"+id).val();
			var apellidos = $("#apellidos"+id).val();
			var usuario = $("#usuario"+id).val();
			var email = $("#email"+id).val();
			var id_comunidad = $("#id_comunidad"+id).val();
			var hotspot = $("#hotspot"+id).val();
			var face = $("#face"+id).val();
			var whatsap = $("#whatsap"+id).val();
			var coment = $("#coment"+id).val();
			var porcent = $("#porcent"+id).val();
		    //III Etapa
		    var prec_hra1 = $("#prec_hra1"+id).val();
			var prec_hra2 = $("#prec_hra2"+id).val();
			var prec_hra3 = $("#prec_hra3"+id).val();
			var prec_hra4 = $("#prec_hra4"+id).val();
			var prec_hra5 = $("#prec_hra5"+id).val();
			var prec_hra6 = $("#prec_hra6"+id).val();
			var print_pf = $("#print_pf"+id).val();
			
			$("#mod_id").val(id);
			$("#firstname2").val(nombres);
			$("#lastname2").val(apellidos);
			$("#user_name2").val(usuario);
			$("#user_email2").val(email);
		
			$("#mod_user_comunidad").val(id_comunidad);
			$("#mod_user_hotspot").val(hotspot);
			$("#mod_user_face").val(face);
			$("#mod_user_whatsap").val(whatsap);
			$("#mod_user_coment").val(coment);
			$("#mod_user_porcent").val(porcent);
		
			$("#mod_prec_hra1").val(prec_hra1);
			$("#mod_prec_hra2").val(prec_hra2);
			$("#mod_prec_hra3").val(prec_hra3);
			$("#mod_prec_hra4").val(prec_hra4);
			$("#mod_prec_hra5").val(prec_hra5);
			$("#mod_prec_hra6").val(prec_hra6);
			$("#mod_print_pf").attr('checked',print_pf==1 ? true : false);
		}

</script>