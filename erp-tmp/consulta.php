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
	
	$active_compras="active";
	$title="Consulta | Maxim Card";

?>
<!DOCTYPE html>
<html lang="es" xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">
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
				<a  href="nueva_consulta.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nueva Consulta</a>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Consulta</h4>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_consulta">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Proveedor o factura de Compra:</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Teclee el nombre del proveedor o el # factura de compra" onkeyup='load(1);'>
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
		
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/consulta.js"></script>
	<script type="text/javascript" src="js/cssrefresh.js"></script>
  </body>
</html>