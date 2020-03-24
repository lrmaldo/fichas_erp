<?php
	/*-------------------------
	Autor: Elio Mojica
	Web: maximcode.com
	Mail: admin@maximcode.com
	---------------------------*/
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado

	$cUsername=$_SESSION['user_name'];

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])) {
		$user_id=intval($_GET['id']);
		$query=mysqli_query($con, "select * from users where user_id='".$user_id."'");
		$rw_user=mysqli_fetch_array($query);
		$count=$rw_user['user_id'];
		if ($user_id!=1){
			if ($delete1=mysqli_query($con,"DELETE FROM users WHERE user_id='".$user_id."'")) {
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puede borrar el usuario administrador. 
			</div>
			<?php
		}
		
	}
	if($action == 'ajax') {
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('firstname', 'lastname');//Columnas de busqueda
		 
		 //$sTable = " users INNER JOIN fichas_horas ON users.user_id=fichas_horas.fichas_user_id ";
		
		 if ($cUsername=='admin') {
			 $sTable="users LEFT JOIN record_cards ON users.user_id = record_cards.record_card_user_id GROUP BY users.user_id,users.user_name";
		 } else {
			 $sTable="users LEFT JOIN record_cards ON users.user_id = record_cards.record_card_user_id WHERE user_name='$cUsername' GROUP BY users.user_id,users.user_name";
		 }
		 
		 $sWhere = "";
		 
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by user_id desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './usuarios.php';
		
		//main query to fetch the data
		//$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$sql="SELECT users.*,
		COUNT(CASE WHEN record_card_user_id = user_id AND record_card_num_hora = 1 THEN 1 END) AS count1,
			COUNT(CASE WHEN record_card_user_id = user_id AND record_card_num_hora = 2 THEN 1 END) AS count2,
			COUNT(CASE WHEN record_card_user_id = user_id AND record_card_num_hora = 3 THEN 1 END) AS count3,
			COUNT(CASE WHEN record_card_user_id = user_id AND record_card_num_hora = 4 THEN 1 END) AS count4,
			COUNT(CASE WHEN record_card_user_id = user_id AND record_card_num_hora = 5 THEN 1 END) AS count5,
			COUNT(CASE WHEN record_card_user_id = user_id AND record_card_num_hora = 6 THEN 1 END) AS count6 FROM $sTable $sWhere LIMIT  $offset,$per_page";
		
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>USUARIO</th>
					<th>1 HORA</th>
					<th>2 HORA</th>
					<th>3 HORA</th>
					<th>4 HORA</th>
					<th>5 HORA</th>
					<th>6 HORA</th>
					<th><span class="pull-right">Acciones</span></th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$user_id=$row['user_id'];
						//$fullname=$row['firstname']." ".$row["lastname"];
						$firstname=$row['firstname'];
						$lastname=$row["lastname"];
						$user_name=$row['user_name'];
						/*
						$ficha_1hra=$row['fichas_1_hra'];
						$ficha_2hra=$row['fichas_2_hra'];
						$ficha_3hra=$row['fichas_3_hra'];
						$ficha_4hra=$row['fichas_4_hra'];
						$ficha_5hra=$row['fichas_5_hra'];
						$ficha_6hra=$row['fichas_6_hra'];
						*/
						$ficha_1hra=$row['count1'];
						if ($ficha_1hra==0){$button_color1="btn-danger";$ficha_1hra="00";}
						else{$button_color1="btn-success";}
					
						$ficha_2hra=$row['count2'];
						if ($ficha_2hra==0){$button_color2="btn-danger";$ficha_2hra="00";}
						else{$button_color2="btn-success";}
					
						$ficha_3hra=$row['count3'];
						if ($ficha_3hra==0){$button_color3="btn-danger";$ficha_3hra="00";}
						else{$button_color3="btn-success";}
					
						$ficha_4hra=$row['count4'];
						if ($ficha_4hra==0){$button_color4="btn-danger";$ficha_4hra="00";}
						else{$button_color4="btn-success";}
					
						$ficha_5hra=$row['count5'];
						if ($ficha_5hra==0){$button_color5="btn-danger";$ficha_5hra="00";}
						else{$button_color5="btn-success";}
					
						$ficha_6hra=$row['count6'];
						if ($ficha_6hra==0){$button_color6="btn-danger";$ficha_6hra="00";}
						else{$button_color6="btn-success";}
						
						//$ficha_3hra=$row['count3'];
						//$ficha_4hra=$row['count4'];
						//$ficha_5hra=$row['count5'];
						//$ficha_6hra=$row['count6'];
						$user_email=$row['user_email'];
						$date_added= date('d/m/Y', strtotime($row['date_added']));
						
						//II Etapa
						$user_comunidad=$row['user_comunidad'];
						$user_hotspot=$row['user_hotspot'];
						$user_face=$row['user_face'];
						$user_whatsap=$row['user_whatsap'];
						$user_coment=$row['user_comentarios'];
						$user_porcent=$row['user_porcent'];
					
						//III Etapa
						$prec_hra1=$row['prec_hra1'];
						$prec_hra2=$row['prec_hra2'];
						$prec_hra3=$row['prec_hra3'];
						$prec_hra4=$row['prec_hra4'];
						$prec_hra5=$row['prec_hra5'];
						$prec_hra6=$row['prec_hra6'];
						$print_pf=$row['print_prec_fichas'];
					?>
					
					<input type="hidden" value="<?php echo $firstname;?>" id="nombres<?php echo $user_id;?>">
					<input type="hidden" value="<?php echo $lastname;?>" id="apellidos<?php echo $user_id;?>">
					<input type="hidden" value="<?php echo $user_name;?>" id="usuario<?php echo $user_id;?>">
					<input type="hidden" value="<?php echo $user_email;?>" id="email<?php echo $user_id;?>">
				    <input type="hidden" value="<?php echo $user_comunidad;?>" id="id_comunidad<?php echo $user_id;?>">
				  	<input type="hidden" value="<?php echo $user_hotspot;?>" id="hotspot<?php echo $user_id;?>">
				  	<input type="hidden" value="<?php echo $user_face;?>" id="face<?php echo $user_id;?>">
				  	<input type="hidden" value="<?php echo $user_whatsap;?>" id="whatsap<?php echo $user_id;?>">
				  	<input type="hidden" value="<?php echo $user_coment;?>" id="coment<?php echo $user_id;?>">
				  	<input type="hidden" value="<?php echo $user_porcent;?>" id="porcent<?php echo $user_id;?>">
				    <input type="hidden" value="<?php echo $prec_hra1;?>" id="prec_hra1<?php echo $user_id;?>">
				    <input type="hidden" value="<?php echo $prec_hra2;?>" id="prec_hra2<?php echo $user_id;?>">
				    <input type="hidden" value="<?php echo $prec_hra3;?>" id="prec_hra3<?php echo $user_id;?>">
				    <input type="hidden" value="<?php echo $prec_hra4;?>" id="prec_hra4<?php echo $user_id;?>">
				    <input type="hidden" value="<?php echo $prec_hra5;?>" id="prec_hra5<?php echo $user_id;?>">
				    <input type="hidden" value="<?php echo $prec_hra6;?>" id="prec_hra6<?php echo $user_id;?>">
				    <input type="hidden" value="<?php echo $print_pf;?>" id="print_pf<?php echo $user_id;?>">
				
					<tr>
						<td ><?php echo $user_name; ?></td>
						<td >
							<div class="dropdown clearfix">
								<button class="btn <?php echo $button_color1;?> dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">(<?php echo $ficha_1hra; ?>) Imprimir
							  	<span class="caret"></span></button>
							  	<ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu" >
									<li><a class="btn btn-defult" onclick="print_cards('<?php echo $user_id; ?>',1, <?php echo $ficha_1hra; ?> , 1)"> 48xH </a></li>
									<li><a class="btn btn-defult" href="#" onclick="print_cards('<?php echo $user_id; ?>',1, <?php echo $ficha_1hra; ?> , 2)"> 20xH </a></li> 
								</ul>
							</div>
						<td >
							<div class="dropdown clearfix">
								<button class="btn <?php echo $button_color2?> dropdown-toggle" type="button" id="menu2" data-toggle="dropdown">(<?php echo $ficha_2hra; ?>) Imprimir
							  	<span class="caret"></span></button>
							  	<ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu" >
									<li><a class="btn btn-defult" href="#" onclick="print_cards('<?php echo $user_id; ?>',2, <?php echo $ficha_2hra; ?> , 1)"> 48xH </a></li>
									<li><a class="btn btn-defult" href="#" onclick="print_cards('<?php echo $user_id; ?>',2, <?php echo $ficha_2hra; ?> , 2)"> 20xH </a></li> 
								</ul>
							</div>
						<td >
							<div class="dropdown clearfix">
								<button class="btn <?php echo $button_color3;?> dropdown-toggle" type="button" id="menu3" data-toggle="dropdown">(<?php echo $ficha_3hra; ?>) Imprimir
							  	<span class="caret"></span></button>
							  	<ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu" >
									<li><a class="btn btn-defult" onclick="print_cards('<?php echo $user_id; ?>',3, <?php echo $ficha_3hra; ?> , 1)"> 48xH </a></li>
									<li><a class="btn btn-defult" onclick="print_cards('<?php echo $user_id; ?>',3, <?php echo $ficha_3hra; ?> , 2)"> 20xH </a></li> 
								</ul>
							</div>
						<td >
							<div class="dropdown clearfix">
								<button class="btn <?php echo $button_color4;?> dropdown-toggle" type="button" id="menu4" data-toggle="dropdown">(<?php echo $ficha_4hra; ?>) Imprimir
							  	<span class="caret"></span></button>
							  	<ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu" >
									<li><a class="btn btn-defult" onclick="print_cards('<?php echo $user_id; ?>',4, <?php echo $ficha_4hra; ?> , 1)"> 48xH </a></li>
									<li><a class="btn btn-defult" onclick="print_cards('<?php echo $user_id; ?>',4, <?php echo $ficha_4hra; ?> , 2)"> 20xH </a></li> 
								</ul>
							</div>
						<td >
							<div class="dropdown clearfix">
								<button class="btn <?php echo $button_color5;?> dropdown-toggle" type="button" id="menu5" data-toggle="dropdown">(<?php echo $ficha_5hra; ?>) Imprimir
							  	<span class="caret"></span></button>
							  	<ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu" >
									<li><a class="btn btn-defult" onclick="print_cards('<?php echo $user_id; ?>',5, <?php echo $ficha_5hra; ?> , 1)"> 48xH </a></li>
									<li><a class="btn btn-defult" onclick="print_cards('<?php echo $user_id; ?>',5, <?php echo $ficha_5hra; ?> , 2)"> 20xH </a></li> 
								</ul>
							</div>
						<td >
							<div class="dropdown clearfix">
								<button class="btn <?php echo $button_color6;?> dropdown-toggle" type="button" id="menu6" data-toggle="dropdown">(<?php echo $ficha_6hra; ?>) Imprimir
							  	<span class="caret"></span></button>
							  	<ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu" >
									<li><a class="btn btn-defult" onclick="print_cards('<?php echo $user_id; ?>',6, <?php echo $ficha_6hra; ?> , 1)"> 48xH </a></li>
									<li><a class="btn btn-defult" onclick="print_cards('<?php echo $user_id; ?>',6, <?php echo $ficha_6hra; ?> , 2)"> 20xH </a></li> 
								</ul>
							</div>
						</td>
					
						<td ><span class="pull-right">
							 <div class="dropdown clearfix">
							  <button class="btn btn-danger dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">OPCIONES
							  <span class="caret"></span></button>
							  <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu" >
									
								  <?php
								  	if ($cUsername=='admin') {
										?>						
										<li><a href="#" onclick="obtener_datos('<?php echo $user_id;?>');" data-toggle="modal" data-target="#myModal2"> Editar usuario <span class="glyphicon glyphicon-edit pull-right"></span></a></li>
										<li><a href="#" onclick="get_user_id('<?php echo $user_id;?>');" data-toggle="modal" data-target="#myModal3"> Cambiar contraseña <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
										<li><a href="#" onclick="eliminar('<? echo $user_id; ?>')"> Borrar usuario <span class="glyphicon glyphicon-trash pull-right"></span></a></li>
										<!-- <li><a href="#" onclick="print_cards('<?php echo $user_id; ?>',1)"> ver fichas <span class="glyphicon glyphicon-envelope pull-right"></span></a></li> -->
								  <?php
									} else {
								  ?>
								  		<!-- <li><a href="#" onclick="print_cards('<?php echo $user_id; ?>',1)"> ver fichas <span class="glyphicon glyphicon-envelope pull-right"></span></a></li>  -->
								  <?php
									}
								  ?>
							  </ul>
							</div>
						</span></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=9><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>