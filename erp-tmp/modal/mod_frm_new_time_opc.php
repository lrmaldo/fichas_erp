	<?php
		if (isset($con))
		{
	?>

	<!-- Modal -->
	<div class="modal fade" id="nuevoTime" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nueva Comunidad</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_time_opc" name="guardar_time_opc">
			<div id="resultados_ajax_comunidades"></div>
			  
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Tiempo:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="nombre_time" name="nombre_time" placeholder="Formato: 00:00:00" pattern="(?=.*[A-Z]).{8,8}" title="8 caracteres tiempo hora" required >
				</div>
			  </div>
			  <div class="form-group">
				<label for="lblprecio" class="col-sm-3 control-label">Precio:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="precio" name="precio" pattern="^[0-9]+(\.[0-9]{1,2})?$" title="8 caracteres tiempo hora" required >
				</div>
			  </div>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>