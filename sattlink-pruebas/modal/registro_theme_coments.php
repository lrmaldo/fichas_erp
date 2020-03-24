	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="NuevoThemComent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nueva plantilla de comentarios</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="Frm_theme_coment" name="Frm_theme_coment">
				<div id="resultados_ajax"></div>
				
				<div class="form-group">
					<label for="lblDescrip" class="col-sm-3 control-label">Descripción:</label>
					<div class="col-sm-12">
						<textarea class="form-control" id="th_coment" name="th_coment" required ></textarea>
					</div>
				</div>
		  
				<div class="modal-footer">
					<button type="button" class="btn btn-default" id="btnclosemodal" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary" id="save_theme_coment" >Guardar datos</button>
				 </div>
			 
			</form>
		  </div>
		 </div>
	  </div>
	</div>

	<?php
		}
	?>