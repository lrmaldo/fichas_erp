<style>
	.my-custom-scrollbar {
	position: relative;
	height: 180px;
	overflow: auto;
	}
	.table-wrapper-scroll-y {
	display: block;
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
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('theme_image_titulo');//Columnas de busqueda
		 $sTable = "themes_images";
		 $sWhere = "";
		
		$id_theme_img=$_GET['id_theme_img'];
		
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
		$sWhere.=" order by id";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 3; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		//main query to fetch the data
		$sql="SELECT * FROM $sTable $sWhere LIMIT $offset, $per_page";
		//echo "=".$sql;
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			?>
			<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
			  <table class="table table-bordered table-hover table-striped mb-0">
				<?php
				while ($row=mysqli_fetch_array($query)){
					$id_theme=$row['id'];
					$theme_image_name=$row['theme_image_name'];
					if (empty($theme_image_name)) {
						$theme_image_name="img-noavailable.png";
					}
					$theme_image_titulo=$row['theme_image_titulo'];
					?>
				    <tr>
						<td width="1%" ><img class="img-round" id="imgrow" src='./img_uploads/<?php echo $theme_image_name;?>' style='height:30px; width:30px;' /></td>
						<td style="font-size: 09pt; font-family: arial" class='col-xs-3' ><?php echo $theme_image_titulo; ?><div class="pull-right"></div></td>
						
						<?php
						if($id_theme_img==$id_theme) {
						?>
						<td width="1%" ><a class='btn btn-info' href="#" onclick="image_select('<?php echo $id_theme ?>')" disabled ><i class="glyphicon glyphicon-plus"></i></a></td>
						<?php
						} else {
						?>
						<td width="1%" ><a class='btn btn-info' href="#" onclick="image_select('<?php echo $id_theme ?>')" ><i class="glyphicon glyphicon-plus"></i></a></td>
						<?php
						}
						?>
					
					</tr>
					
					<?php
				}
				?>
				
			  </table>
			</div>
			<?php
		}
	}
?>
	<script>
	</script>