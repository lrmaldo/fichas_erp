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
		 $sTable="users LEFT JOIN record_cards ON users.user_id = record_cards.record_card_user_id GROUP BY users.user_id,users.user_name";
		 
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
		$sql="SELECT users.user_id, users.user_name,
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
						$fullname=$row['firstname']." ".$row["lastname"];
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
						$ficha_2hra=$row['count2'];
						$ficha_3hra=$row['count3'];
						$ficha_4hra=$row['count4'];
						$ficha_5hra=$row['count5'];
						$ficha_6hra=$row['count6'];
						
						$user_email=$row['user_email'];
						$date_added= date('d/m/Y', strtotime($row['date_added']));
						
						$user_comunidad=$row['user_comunidad'];
						$user_hotspot=$row['user_hotspot'];
						$user_face=$row['user_face'];
						$user_whatsap=$row['user_whatsap'];
						$user_coment=$row['user_comentarios'];
						$user_porcent=$row['user_porcent'];

					?>
					
					<input type="hidden" value="<?php echo $row['firstname'];?>" id="nombres<?php echo $user_id;?>">
					<input type="hidden" value="<?php echo $row['lastname'];?>" id="apellidos<?php echo $user_id;?>">
					<input type="hidden" value="<?php echo $user_name;?>" id="usuario<?php echo $user_id;?>">
					<input type="hidden" value="<?php echo $user_email;?>" id="email<?php echo $user_id;?>">
				  
				    <input type="hidden" value="<?php echo $user_comunidad;?>" id="comunidad<?php echo $user_id;?>">
				  	<input type="hidden" value="<?php echo $user_hotspot;?>" id="hotspot<?php echo $user_id;?>">
				  	<input type="hidden" value="<?php echo $user_face;?>" id="face<?php echo $user_id;?>">
				  	<input type="hidden" value="<?php echo $user_whatsap;?>" id="whatsap<?php echo $user_id;?>">
				  	<input type="hidden" value="<?php echo $user_coment;?>" id="coment<?php echo $user_id;?>">
				  	<input type="hidden" value="<?php echo $user_porcent;?>" id="porcent<?php echo $user_id;?>">
				
					<tr>
						<td ><?php echo $user_name; ?></td>
						<td ><?php echo $ficha_1hra; ?></td>
						<td ><?php echo $ficha_2hra; ?></td>
						<td ><?php echo $ficha_3hra; ?></td>
						<td ><?php echo $ficha_4hra; ?></td>
						<td ><?php echo $ficha_5hra; ?></td>
						<td ><?php echo $ficha_6hra; ?></td>
						
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar usuario' onclick="obtener_datos('<?php echo $user_id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					<a href="#" class='btn btn-default' title='Cambiar contraseña' onclick="get_user_id('<?php echo $user_id;?>');" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class='btn btn-default' title='Borrar usuario' onclick="eliminar('<? echo $user_id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
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