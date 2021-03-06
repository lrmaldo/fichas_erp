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
//Archivo de funciones PHP
include("../funciones.php");

$id_factura= $_SESSION['id_factura'];
$numero_factura= $_SESSION['numero_factura'];

if (isset( $_POST['info'] )) {
	$data =json_decode($_POST['info'], true);
	$id=$data['id'];
	$cantidad = $data['cantidad'];
	$precio_venta = $data['precio_venta'];
	$dato_adicional = $data['dato_adicional'];
	$prod_iva = $data['prod_iva'];
	$id_client = $data['id_client'];
} else {
	$id=0;
	$cantidad = 0;
	$precio_venta = 0;
	$dato_adicional = '';
	$prod_iva = 0;
	$id_client = 0;
}

$info_udp = (isset( $_GET['info_udp'] ))?json_decode($_GET['info_udp'], true):'';
if (isset( $info_udp['id_client'] )) {
	$id_client=$info_udp['id_client'];
}
//echo "id_client: " . $id_client;

//Add 29Nov2019 get porcent% customer
$desc_porcent=get_row('clientes','desc_porcent', 'id_cliente', $id_client);
$desc_porcent = (isset($desc_porcent) && $desc_porcent != NULL)?$desc_porcent:0;

if (!empty($id) and !empty($cantidad) and !empty($precio_venta)) {
	$insert_tmp=mysqli_query($con, "INSERT INTO detalle_factura (id_detalle, numero_factura, id_producto, cantidad, precio_venta, dato_adicional, tax_iva, desc_porcent) VALUES 
	(default, '$numero_factura', '$id', '$cantidad', '$precio_venta','$dato_adicional','$prod_iva', '$desc_porcent' )");
}

if (isset($info_udp['modo'])){
	$modo=$info_udp['modo'];
} else {
	$modo=0;
}

//codigo elimina un elemento del array
if ( isset($info_udp['id']) && $modo==0 ) {
	$id_tmp=intval($info_udp['id']);
	$delete=mysqli_query($con, "DELETE FROM detalle_factura WHERE id_detalle='".$id_tmp."'");
}

//update elemento detalle documento del array
if (isset($info_udp['id']) && $modo==1 ) {
	$id_detalle=intval($info_udp['id']);
	$d_a=$info_udp['d_a'];
	$n_c=$info_udp['n_c'];
	$n_p=$info_udp['n_p'];
	$tax_ova=$info_udp['prod_iva'];
	$update=mysqli_query($con, "update detalle_factura set dato_adicional = '$d_a', cantidad = '$n_c', precio_venta = '$n_p', tax_iva = '$tax_ova' WHERE id_detalle='".$id_detalle."'");
}

$simbolo_moneda=get_row('perfil','moneda', 'id_perfil', 1);
?>
<div class="table-responsive">
<table class="table table-bordered table-hover scroll table-striped input-sm">
<tr class="warning">
	<th class='text-center'>CODIGO</th>
	<th class='text-center'>CANT.</th>
	<th>DESCRIPCION</th>
	<th>DATO ADICIONAL</th>
	<th class='text-right'>PRECIO UNIT.</th>
	<th class='text-left'>IVA</th>
	<th class='text-right'>PRECIO TOTAL</th>
	<th></th>
</tr>
<?php
	
	$impuesto=get_row('perfil','impuesto', 'id_perfil', 1);
	
	$sumador_total=0;
	
	//Add 29Nov2019 porcent%
	$acum_desc_porc_ope=0;
	$subtotde=0;$subtotal=0;$acum_iva=0;
	
	$sql=mysqli_query($con, "select * from products, facturas, detalle_factura where facturas.numero_factura=detalle_factura.numero_factura and  facturas.id_factura='$id_factura' and products.id_producto=detalle_factura.id_producto");
	while ($row=mysqli_fetch_array($sql)) {
	$id_detalle=$row["id_detalle"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad'];
	$nombre_producto=$row['nombre_producto'];
	$dato_adicional=trim($row['dato_adicional']);
	$precio_venta=$row['precio_venta'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$integra_iva=$row['tax_iva'];
	$cerrada=$row['cerrada'];
	$invet=$row['prod_invent'];
	$aoq=$row['allow_ope_quantity'];
	
	//Add 29Nov2019 get porcent% customer
	$desc_porc_ope = floatval( $row['desc_porcent'] );

	//Checa el item si es (1)inventariable o (0)servicio, si es servicio no multiplicara la cantidades por el precio.
	if ($invet==1) {
		$precio_total=$precio_venta_r*$cantidad;
	} else {
		if ($aoq==1) { //Allow opera for quantity
			$precio_total=$precio_venta_r*$cantidad;
		} else {
			$precio_total=$precio_venta_r;
		}
	}
	
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
		
	//$sumador_total+=$precio_total_r;//Sumador
	$sum_part=$precio_total_r;//Sumador por partida
	
	//Add 29Nov2019 get porcent% customer
	$desc_appli_ope=(($desc_porc_ope*$precio_total_r)/100);
	$acum_desc_porc_ope+=$desc_appli_ope;
	$sum_part=($sum_part - $desc_appli_ope);
	$subtotde+=$sum_part;
	
	//$subtotal+=number_format($sum_part,2,'.','');	//Original
	$subtotal+=number_format($precio_total_r,2,'.','');
	
	if ($integra_iva==1) {
		$total_iva=($sum_part * $impuesto )/100;
		$total_iva=number_format($total_iva,2,'.','');
	} else {
	  $total_iva=0;
	}
	$acum_iva+=$total_iva;
	
		?>
		<tr>
			<td class='text-center'><?php echo $codigo_producto;?></td>
			
			<td class='col-xs-1'>
				<div class="pull-right">
				<input type="number" class="form-control input-sm numbers" style="text-align:right" id="cantidad_update_<?php echo $id_detalle; ?>" min="1" step="1" value="<?php echo $cantidad;?>" required pattern="\d{1,4}"
					<?php if ($cerrada==1){echo "disabled";}?> >
				</div></td>
			
			<td><?php echo $nombre_producto;?></td>
			
			<td class='col-xs-3' ><div class="pull-left">
				<textarea <?php if ($cerrada==1){echo "disabled";}?> class="form-control" id="dato_adic_update_<?php echo $id_detalle; ?>" cols="60" rows="2"  ><?php echo $dato_adicional;?>
				</textarea>
			</div></td>
			
			<td class='col-xs-2'>
				<div class="pull-right">
				<input type="text" class="form-control input-sm numbers" style="text-align:right" id="precio_update_<?php echo $id_detalle; ?>" value="<?php echo $precio_venta_f;?>" required pattern="^[0-9]+(\.[0-9]{1,2})?$" 
					<?php if ($cerrada==1){echo "disabled";}?> required >
			</div></td>
			
			<td class='col-xs-0'>
				<div class="pull-left">
					<input type="checkbox" class="form-check-input input-sm" id="prod_iva_update_<?php echo $id_detalle; ?>" <?php if($integra_iva==1){?> checked <?php } ;?>  >
			</div></td>
			
			<td class='text-right'><?php echo $precio_total_f;?></td>
			<td class='text-center'><a href="#" onclick="eliminar('<?php echo $id_detalle; ?>', '<?php echo $cerrada; ?>' )" ><i class="glyphicon glyphicon-trash" ></i></a></td>
			<td class='text-right'><a href="#" onclick="update_detalle_doc('<?php echo $id_detalle ?>', '<?php echo $cerrada; ?>')"><i class="glyphicon glyphicon-edit"></i></a></td>
		</tr>		
		<?php
	} // End while
	
	//$total_factura=$subtotal+$acum_iva; //Original
	$total_factura=$subtotde+$acum_iva;
	
	$update=mysqli_query($con,"update facturas set total_venta='$total_factura' where id_factura='$id_factura'");
	
?>
<tr>
	<td class='text-right' style='font-weight:bold' colspan=4>SUBTOTAL:<?php echo $simbolo_moneda;?></td>
	<td class='text-right'><?php echo number_format($subtotal,2);?></td>
	<td></td>
</tr>

<?php if ( $desc_porc_ope>0 ) { ?>

	<tr>
		<td class='text-right' style='font-weight:bold' colspan=4>DESCUENTO ( <?php echo $desc_porcent; ?>)% <?php echo $simbolo_moneda;?></td>
		<td class='text-right'><?php echo number_format($acum_desc_porc_ope,2);?></td>
		<td></td>
	</tr>

	<tr>
		<td class='text-right' style='font-weight:bold' colspan=4>SUBTOTAL<?php echo $simbolo_moneda;?></td>
		<td class='text-right'><?php echo number_format($subtotde,2);?></td>
		<td></td>
	</tr>
<?php } ?>

<tr>
	<td class='text-right' style='font-weight:bold' colspan=4>IVA (<?php echo $impuesto;?>)% <?php echo $simbolo_moneda;?></td>
	<td class='text-right'><?php echo number_format($acum_iva,2);?></td>
	<td></td>
</tr>
<tr>
	<td class='text-right' style='font-weight:bold' colspan=4>TOTAL <?php echo $simbolo_moneda;?></td>
	<td class='text-right'><?php echo number_format($total_factura,2);?></td>
	<td></td>
</tr>

</table>
</div>

<script>
	
	$(document).ready(function(){
		$("input.numbers").keypress(function(event) {
			if (String.fromCharCode(event.keyCode).match(/^[0-9.,]+$/)) {
				return true;
			} else {
				return false;
			}
		});
		
	});
	
</script>
