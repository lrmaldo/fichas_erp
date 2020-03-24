<style type="text/css">
	.client_foraneos{
	padding: 4px 4px 4px;
	color:red;
	font-weight:bold;
	font-size:12px;
}
	
</style>

<?php

	/*-------------------------
	Autor: Elio Mojica
	Web: maximcode.com
	Mail: admin@maximcode.com
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include("../funciones.php");
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])) {
		$numero_factura=intval($_GET['id']);
		$del1="delete from facturas where numero_factura='".$numero_factura."'";
		$del2="delete from deta_compras where numero_factura='".$numero_factura."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		//$sTable = "compras, clientes, users";
		$sTable = "compras";
		$sWhere = "";
		//$sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id";
		if ( $_GET['q'] != "" )
		{
			//$sWhere.= " and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%' or cliente_foraneo like '%$q%' ) ";
		}
		$sWhere.=" order by compras.id_compra desc";
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
		$reload = './compras.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table table-striped">
				<tr  class="info">
					<th>#CONSE.</th>
					<th>#FACTURA</th>
					<th>FECHA</th>
					<th>PROVEEDOR</th>
					<th>ALMACEN</th>
					<th>ESTADO</th>
					<th class='text-right'>TOTAL</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)) {
						$id_factura=$row['id_compra'];
						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y", strtotime($row['fecha_factura']));
						$id_prove=$row['id_prove'];
						$id_almacen=$row['id_almacen'];
						$estado_compra="Not field";
						$total_compra=$row['pie_total'];
					?>
					<tr>
						<td><?php echo $id_factura; ?></td>
						<td><?php echo $numero_factura; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><?php echo $id_prove; ?></td>
						<td><?php echo $id_almacen; ?></td>
						<td><?php echo $estado_compra; ?></td>
						<td class='text-right'><?php echo number_format ($total_compra,2); ?></td>					
					
					<td class="text-right">
						<a href="editar_factura.php?id_factura=<?php echo $id_factura;?>" class='btn btn-default' title='Editar compra' ><i class="glyphicon glyphicon-edit"></i></a> 
						<a href="#" class='btn btn-default' title='Descargar compra' onclick="imprimir_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download"></i></a> 
						<a href="#" class='btn btn-default' title='Borrar compra' onclick="eliminar('<?php echo $numero_factura; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>