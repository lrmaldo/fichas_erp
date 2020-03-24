	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="NewThemImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nueva plantilla de imagen</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" enctype="multipart/form-data" method="post" id="Frm_theme_image" name="Frm_theme_image">
				<div id="resultados_ajax"></div>
				
					<div id="loader_table_imgs" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div>
					<div class="image_outer_div" ></div>
					 
					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label small">Titulo de la imagen:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control input-sm" id="tit_image" name="tit_image" maxlength="20" required>
						</div>
					</div>
					
					<div class="form-group">
						<label for="imagen" class="col-sm-3 control-label small">Imagen:</label>
						<div class="col-sm-8">
						  <input type="file" name="product_img" class="form-control input-sm" id="product_img" >
						</div>
					</div>
		  
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary" id="save_theme_image" >Guardar nueva imagen</button>
				 </div>
			 
		  </form>
		 
		 </div>
		 </div>
	  </div>
	</div>

	<?php
		}
	?>