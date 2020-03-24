	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar usuario</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">
			<div id="resultados_ajax2"></div>
			<div class="form-group">
				<label for="firstname2" class="col-sm-3 control-label">Nombre:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="firstname2" name="firstname2" placeholder="Nombres" maxlength="20" required>
				  <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			  <div class="form-group">
				<label for="lastname2" class="col-sm-3 control-label">Apellidos:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="lastname2" name="lastname2" placeholder="Apellidos" maxlength="20" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_name2" class="col-sm-3 control-label">Usuario:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="user_name2" name="user_name2" placeholder="Usuario" pattern="[a-zA-Z0-9]{2,64}" title="Nombre de usuario ( sólo letras y números, 2-64 caracteres)" maxlength="64" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_email2" class="col-sm-3 control-label">Email:</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="user_email2" name="user_email2" placeholder="Correo electrónico" maxlength="64" required>
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="linea" class="col-sm-3 control-label">Comunidad:</label>
				<div class="col-sm-8">
				<select class='form-control input-sm' id="mod_user_comunidad" name="mod_user_comunidad" required >
				<?php
					$sql_comunidad=mysqli_query($con,"select id_comunidad, nombre_comunidad from comunidades");
					while ($rw=mysqli_fetch_array($sql_comunidad)){
						$id_comunidad=$rw["id_comunidad"];
						$nombre_comunidad=$rw["nombre_comunidad"];
				?>
				<option value="<?php echo $id_comunidad?>" <?php echo $selected;?>><?php echo $nombre_comunidad?></option>
				<?php
				}
				?>
				</select>
			  </div>  
				  
			  </div>
			
				<div class="form-group">
				<label for="user_hotspot" class="col-sm-3 control-label">Hotspot:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_user_hotspot" name="mod_user_hotspot" maxlength="50" required>
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="user_face" class="col-sm-3 control-label">Facebook:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_user_face" name="mod_user_face" maxlength="50">
				</div>
			  </div>	
				
			  <div class="form-group">
				<label for="user_whatsap" class="col-sm-3 control-label">Whatsapp:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_user_whatsap" name="mod_user_whatsap" maxlength="30" required>
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="user_coment" class="col-sm-3 control-label">Comentario:</label>
				<div class="col-sm-8">
				  <textarea class="form-control" id="mod_user_coment" name="mod_user_coment" maxlength="255" ></textarea>
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="user_porcent" class="col-sm-3 control-label">Porcentaje:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="mod_user_porcent" name="mod_user_porcent" min="1" step="1" >
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="pre1hra" class="col-sm-3 control-label">Precio Ficha 1 Hra:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="mod_prec_hra1" name="mod_prec_hra1" value="">
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="pre2hra" class="col-sm-3 control-label">Precio Ficha 2 Hras:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="mod_prec_hra2" name="mod_prec_hra2" value="">
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="pre3hra" class="col-sm-3 control-label">Precio Ficha 3 Hras:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="mod_prec_hra3" name="mod_prec_hra3" value="">
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="pre4hra" class="col-sm-3 control-label">Precio Ficha 4 Hras:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="mod_prec_hra4" name="mod_prec_hra4" value="">
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="pre5hra" class="col-sm-3 control-label">Precio Ficha 5 Hras:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="mod_prec_hra5" name="mod_prec_hra5" value="">
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="pre6hra" class="col-sm-3 control-label">Precio Ficha 6 Hras:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="mod_prec_hra6" name="mod_prec_hra6" value="">
				</div>
			  </div>
				
			  <div class="form-group">
				<label class="col-sm-3 form-check-label">Imprimir los precios de Horas ?:</label>
				<div class="col-sm-8">
					<input type="checkbox" class="form-check-input" name="mod_print_pf" id="mod_print_pf" >
				</div>
			  </div>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>