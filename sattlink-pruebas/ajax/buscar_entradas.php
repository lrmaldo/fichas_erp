<?php

	/*-------------------------
	Autor: Elio Mojica
	Web: maximcode.com
	Mail: admin@maximcode.com
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database */
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	/*Archivo de funciones PHP*/
	include("../funciones.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
	if (isset($_GET['id'])){
		$id_entrada=intval($_GET['id']);
		if ($entrada>0){
			if ($delete1=mysqli_query($con,"DELETE FROM entradas WHERE id_entrada='".$id_entrada."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
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
			  <strong>Error!</strong> No se pudo eliminar esta lineas!
			</div>
			<?php
		}
	}
	if($action == 'ajax'){
		/* Escaping, additionally removing everything that could be (html/javascript-) code */
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 
		 $aColumns = array('nombre_entrada');	//Columnas de busqueda Here changes
		 $sTable = "entradas";					//Table Here changes
		 
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
		$sWhere.=" order by id_linea desc";	//Here changes
		
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
		$reload = './lineas.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		/*loop through fetched data */
		if ($numrows>0){
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>CODIGO</th>
					<th>L I N E A</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_linea=$row['id_linea'];
						$nombre_linea=$row['nombre_linea'];
					?>
					
					<input type="hidden" value="<?php echo $id_linea;?>" id="id_linea<?php echo $id_linea;?>">
					<input type="hidden" value="<?php echo $nombre_linea;?>" id="nombre_linea<?php echo $id_linea;?>">
					<tr>
						<td><?php echo $id_linea; ?></td>
						<td ><?php echo $nombre_linea; ?></td>
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar linea' onclick="obtener_datos('<?php echo $id_linea;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					<a href="#" class='btn btn-default' title='Borrar linea' onclick="eliminar('<?php echo $id_linea; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=6><span class="pull-right">
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