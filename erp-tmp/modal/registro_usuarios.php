		<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo usuario</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
			<div id="resultados_ajax"></div>
			  <div class="form-group">
				<label for="firstname" class="col-sm-3 control-label">Nombre:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Nombre de la persona" maxlength="20" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="lastname" class="col-sm-3 control-label">Apellidos</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellidos" maxlength="20" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_name" class="col-sm-3 control-label">Usuario:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Usuario" pattern="[a-zA-Z0-9]{2,64}" title="Nombre de usuario ( sólo letras y números, 2-64 caracteres)" maxlength="64" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_email" class="col-sm-3 control-label">Email:</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Correo electrónico" maxlength="64" required>
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="linea" class="col-sm-3 control-label">Comunidad:</label>
					<div class="col-sm-8">
					<select class='form-control input-sm' name="user_comunidad" required >
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
				  <input type="text" class="form-control" id="user_hotspot" name="user_hotspot" maxlength="50" required>
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="user_face" class="col-sm-3 control-label">Facebook:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="user_face" name="user_face" maxlength="50">
				</div>
			  </div>	
				
			  <div class="form-group">
				<label for="user_whatsap" class="col-sm-3 control-label">Whatsapp:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="user_whatsap" name="user_whatsap" maxlength="30" required>
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="user_coment" class="col-sm-3 control-label">Comentario:</label>
				<div class="col-sm-8">
				  <textarea class="form-control" id="user_coment" name="user_coment" maxlength="255" ></textarea>
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="user_porcent" class="col-sm-3 control-label">Porcentaje:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="user_porcent" name="user_porcent" min="1" step="1" value="1">
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="pre1hra" class="col-sm-3 control-label">Precio Ficha 1 Hra:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="prec_1hra" name="prec_1hra" value="">
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="pre2hra" class="col-sm-3 control-label">Precio Ficha 2 Hras:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="prec_2hra" name="prec_2hra" value="">
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="pre3hra" class="col-sm-3 control-label">Precio Ficha 3 Hras:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="prec_3hra" name="prec_3hra" value="">
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="pre4hra" class="col-sm-3 control-label">Precio Ficha 4 Hras:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="prec_4hra" name="prec_4hra" value="">
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="pre5hra" class="col-sm-3 control-label">Precio Ficha 5 Hras:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="prec_5hra" name="prec_5hra" value="">
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="pre6hra" class="col-sm-3 control-label">Precio Ficha 6 Hras:</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="prec_6hra" name="prec_6hra" value="">
				</div>
			  </div>
				
			  <div class="form-group">
				<label class="col-sm-3 form-check-label">Imprimir los precios de Horas ?:</label>
				<div class="col-sm-8">
					<input type="checkbox" class="form-check-input" name="print_prec_fichas" id="print_prec_fichas" >
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="user_password_new" class="col-sm-3 control-label">Contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="user_password_new" name="user_password_new" placeholder="Contraseña" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_password_repeat" class="col-sm-3 control-label">Repite contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="user_password_repeat" name="user_password_repeat" placeholder="Repite contraseña" pattern=".{6,}" required>
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