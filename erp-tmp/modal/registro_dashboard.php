	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo Cliente</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente">
			<div id="resultados_ajax"></div>
				
				<div class="form-group">
					<label for="comunidad" class="col-sm-3 control-label">Comunidad:</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="comunidad" name="comunidad" required maxlength="50">
					</div>
				</div>
				
				<div class="form-group">
					<label for="hotspot" class="col-sm-3 control-label">Hotspot:</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="hotspot" name="hotspot" required maxlength="50">
					</div>
				</div>
				
				<div class="form-group">
					<label for="nombre" class="col-sm-3 control-label">Nombre:</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="50">
					</div>
				</div>
				
				<div class="form-group">
					<label for="facebook" class="col-sm-3 control-label">Facebook:</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="facebook" name="facebook" maxlength="50">
					</div>
				</div>
				
				<div class="form-group">
					<label for="mail" class="col-sm-3 control-label">Mail:</label>
					<div class="col-sm-8">
					  <input type="mail" class="form-control" id="mail" name="mail" required maxlength="50">
					</div>
				</div>
				<div class="form-group">
					<label for="whatsap" class="col-sm-3 control-label">whatsap:</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="whatsap" name="whatsap" required maxlength="30">
					</div>
				</div>
				
				<div class="form-group">
					<label for="comentarios" class="col-sm-3 control-label">Comentarios:</label>
					<div class="col-sm-8">
						<textarea class="form-control" id="comentarios" name="comentarios" placeholder="Describa comentarios" maxlength="255" ></textarea>
					</div>
				</div>
				
				<div class="form-group">
				<label for="porce" class="col-sm-3 control-label">% Porcentaje:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="porce" name="porce" pattern="\d{1,4}" maxlength="4" onkeyup="futili(1);" title="Ingresa sólo números" >
				</div>
				</div>
				
				<div class="form-group">
					<label for="activado" class="col-sm-3 control-label">Activado:</label>
					<div class="col-sm-8">
					 <select class="form-control" id="activado" name="activado" required>
						<option value="1" selected>Activo</option>
						<option value="0">Inactivo</option>
					  </select>
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
	
	<script>
		
	</script>

	<?php
		}
	?>