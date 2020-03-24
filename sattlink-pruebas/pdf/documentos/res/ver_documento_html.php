<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.only-line{
	background:#2c3e50;
	padding: 1px 1px 1px;
	color:white;
	font-size:1px;
}

.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.color-leyenda{
	background:orange;
	padding: 4px 4px 4px;
	color:black;
	font-weight:bold;
	font-size:12px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}

.myTableLeye { 
  width: 100%;
  text-align: left;
  background-color: lemonchiffon;
  border-collapse: collapse; 
  font-size:12px;
	
  border-radius: 5px;
  margin: auto;
  float: none;
  }
.myTableLeye th { 
  text-align: center;
  background-color: goldenrod;
  color: white; 
  }
.myTableLeye td,
.myTableLeye th { 
  padding: 3px;
  border: 1px solid goldenrod; 
 }

-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>
        		<td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    <?php echo get_row('perfil','email', 'id_perfil', 1); ?>
                </td>
            </tr>
        </table>
    </page_footer>
	<?php include("encabezado_factura.php");?>
    <br>
    
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:100%;" class='midnight-blue'> <?php echo $leyenda_doc; ?> </td>
        </tr>
		<tr>
           <td style="width:100%;" >
			<?php 
			   
			   $id_cli_foraneo=get_row('perfil','numeracion_cliente_foraneo', 'id_perfil', 1);
			   $vendedor=get_two_row('users', 'firstname', 'lastname', 'user_id', $id_vendedor);
				
			   $longmax=73;$linebreak='';$strindata='';
			   
			   if ($id_cli_foraneo <> $id_cliente) {
					$sql_cliente=mysqli_query($con,"select * from clientes where id_cliente='$id_cliente'");
					$rw_cliente=mysqli_fetch_array($sql_cliente);
				   
				    $tipo_cliente=$rw_cliente['tipo_cliente'];
				    $nombre_gral=$rw_cliente['nombre_cliente'];
				   
				    if($tipo_cliente==1) {
						$nombre_gral=$nombre_gral.' '.$rw_cliente['ape_pat_cliente'].' '.$rw_cliente['ape_mat_cliente'];
					}
				   
				    echo $nombre_gral;
					echo "<br>";
					$txtlong = $rw_cliente['direccion_cliente'];
					$longmax = 73; // numero maximo de caracteres antes de hacer un salto de linea
					$linebreak = '<br />';
				    echo wordwrap($txtlong, $longmax, $linebreak, true) . "<br>";
				    $strindata=" " . $rw_cliente['col_cliente'] . " ". $rw_cliente['ciudad_cliente']. " " . $rw_cliente['rfc_cliente'];
				    $txtlong = $rw_cliente['direccion_cliente'];
				    echo wordwrap($strindata, $longmax, $linebreak, true);
				   
				   	if ( !empty($rw_cliente['telefono_cliente']) ) {
				    	echo "<br>".$rw_cliente['telefono_cliente'];
					}
				    if (!empty($rw_cliente['email_cliente']) ) {
						$mail_customer=$rw_cliente['email_cliente'];	//Need for send mail
				    	echo "<br>".$rw_cliente['email_cliente'];
					}
				   
				} else {
				   	echo $datoc1;
					if ( !empty(trim($datoc2)) ) {
				    	echo "<br>".$datoc2;
					}
				    if ( !empty(trim($datoc3)) ) {
						$mail_customer=$datoc3;	//Need for send mail
				    	echo "<br>".$datoc3;
					}
				   
				    echo "<br>";
				    //New address for foraneo customer, col, city and rfc
				    if ( !empty(trim($datoc4)) ) {
						$txtlong = $datoc4;
						$longmax = 73; // numero maximo de caracteres antes de hacer un salto de linea
						$linebreak = '<br />';
						echo wordwrap($txtlong, $longmax, $linebreak, true) . "<br>";
					
				   
				    $datoc5 = trim($datoc5);
				    $datoc6 = trim($datoc6);
				    $datoc7 = trim($datoc7);
						
					$strindata=$datoc5 . " ". $datoc6. " " . $datoc7;
				   	
					$txtlong = $strindata;
					echo wordwrap($txtlong, $longmax, $linebreak, true);
					}
				}
			?>
			
		   </td>
        </tr>
   
    </table>
    
       <br>
		<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:35%;" class='midnight-blue'>ATENDIO</td>
		  <td style="width:25%;" class='midnight-blue'>FECHA</td>
		   <td style="width:40%;" class='midnight-blue'>FORMA DE PAGO</td>
        </tr>
		<tr>
           <td style="width:35%;">
			<?php 
				$sql_user=mysqli_query($con,"select * from users where user_id='$id_vendedor'");
				$rw_user=mysqli_fetch_array($sql_user);
				echo $rw_user['firstname']." ".$rw_user['lastname'];
			?>
		   </td>
		  <td style="width:25%;"><?php echo date("d/m/Y", strtotime($fecha_factura));?></td>
		   <td style="width:40%;" >
				<?php 
				if($tipo_doc==1) {
						if ($condiciones==1){echo "Efectivo";}
						elseif ($condiciones==2){echo "Cheque";}
						elseif ($condiciones==3){echo "Transferencia bancaria";}
						elseif ($condiciones==4){echo "Crédito";}
					} else if($tipo_doc==2) {
						echo "Sin aplicar";
					}
				?>
		   </td>
        </tr>
    </table>
	<br>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;table-layout:fixed">
        <tr>
			<th style="width: 03%;text-align:center" class='midnight-blue'>UND</th>
			<th style="width: 08%;text-align:center" class='midnight-blue'>CANT.</th>
            <th style="width: 57%" class='midnight-blue'>DESCRIPCION</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO UNIT.</th>
            <th style="width: 17%;text-align: right" class='midnight-blue'>IMPORTE</th>
        </tr>

<?php
$nums=1;
$sumador_total=0;
//Add new for desc
$acum_desc_porc_ope=0;$subtotde=0;$subtotal=0;$acum_iva=0;

$sql=mysqli_query($con, "select * from products, detalle_factura, facturas, unidades 
where products.id_producto=detalle_factura.id_producto and detalle_factura.numero_factura=facturas.numero_factura and products.id_unidad=unidades.id_unidad and facturas.id_factura='".$id_factura."'");

$impuesto=get_row('perfil','impuesto', 'id_perfil', 1);
		
while ($row=mysqli_fetch_array($sql)) {
	$id_producto=$row["id_producto"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad'];
	
	$nombre_producto=$row['nombre_producto'];
	if( isset( $row['nombre_producto_l'] )) {
		$nombre_producto.="<br>".$row['nombre_producto_l'];
	}
	$nombre_unidad=$row['nombre_unidad'];
	$precio_venta=$row['precio_venta'];
	$prod_invent=$row['prod_invent'];
	$aoq=$row['allow_ope_quantity'];
	
	$precio_venta_f=number_format( $precio_venta, 2);//Formateo variables
	$precio_venta_r=str_replace(",", "", $precio_venta_f);//Reemplazo las comas
	
	if ($prod_invent==1) {
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
	$integra_iva=$row['tax_iva'];
	
	//Add new for desc
	//$desc_porcent = $row['desc_porcent'];
	$desc_porc_ope = floatval( $row['desc_porcent'] );
			
	$sum_part=$precio_total_r;//Sumador por partida
	
	//Add new for desc
	$desc_appli_ope=(($desc_porc_ope*$precio_total_r)/100);
	$acum_desc_porc_ope+=$desc_appli_ope;
	$sum_part=($sum_part - $desc_appli_ope);
	$subtotde+=$sum_part;
		
	$subtotal+=$precio_total_r;
	
	if ($integra_iva==1) {
		$total_iva=($sum_part * $impuesto )/100;
		$total_iva=number_format($total_iva,2,'.','');
	} else {
	  $total_iva=0;
	}
	
	$acum_iva+=$total_iva;
		
	if ($nums%2==0){
		$clase="clouds";
	} else {
		$clase="silver";
	}
	
	$textoLargo = $row['dato_adicional'];
	$largoMax = 58; // numero maximo de caracteres antes de hacer un salto de linea
	$rompeLineas = '<br />';
	$romper_palabras_largas = true; // rompe la cadena
	
	$varblack=0;
	$dect_word=substr($textoLargo, 0,1);
	
	if ($dect_word=='*') {	//Si se detecta * se activa bold en la impresion
		$varblack=1;
		$textoLargo = substr($textoLargo, 1, -1);	//Una vez detectado * se elimina de la impresion
	}
		
	//New October for print membresias selections
	$membresias_selections=$row['membresias_selections'];
	$string_array = explode(",",$membresias_selections);
	
	?>
        <tr>
			<td class='<?php echo $clase;?>' style="width: 03%; text-align: center"><?php echo $nombre_unidad; ?></td>
            <td class='<?php echo $clase;?>' style="width: 08%; text-align: center"><?php echo $cantidad; ?></td>
            <td class='<?php echo $clase;?>' style="width: 57%; text-align: left"><?php echo $nombre_producto;?></td>
			
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_venta_f;?></td>
            <td class='<?php echo $clase;?>' style="width: 17%; text-align: right"><?php echo $precio_total_f;?></td>
        </tr>
		<tr>
			<td class='<?php echo $clase;?>' style="width: 08%; text-align: left"></td>
			<?php
				if ($varblack==1) {
					?>
            			<td colspan="3" style="width: 58%;text-align: left;font-weight: bold;"> <?php echo wordwrap($textoLargo,$largoMax,$rompeLineas,$romper_palabras_largas);?> </td>
				<?php	
					} else {
				?>
						<td colspan="3" style="width: 58%;text-align: left;"> <?php echo wordwrap($textoLargo,$largoMax,$rompeLineas,$romper_palabras_largas);?> </td>						
				<?php
				}
			?>
        </tr>

	<?php 

	
	$nums++;
	
	}	//End while

	//$total_factura=$subtotal+$acum_iva; //Original
	
	//Add new for desc
	$total_factura=$subtotde+$acum_iva;

?>
        <tr>
            <td colspan="4" style="widtd: 15%; text-align: right;font-weight:bold">SUBTOTAL<?php echo $simbolo_moneda;?> </td>
            <td style="widtd: 17%; text-align: right;font-weight:bold"> <?php echo number_format($subtotal,2);?></td>
		</tr>
		
		<?php if ( $desc_porc_ope>0 ) { ?>
		<tr>
			<td colspan="4" style="widtd: 15%; text-align: right;font-weight:bold">DESCUENTO ( <?php echo $desc_porc_ope; ?>)% <?php echo $simbolo_moneda;?></td>
			<td style="widtd: 17%; text-align: right;font-weight:bold"><?php echo number_format($acum_desc_porc_ope,2);?></td>
		</tr>
		<tr>
			<td colspan="4" style="widtd: 15%; text-align: right;font-weight:bold">SUBTOTAL<?php echo $simbolo_moneda;?></td>
			<td style="widtd: 17%; text-align: right;font-weight:bold"><?php echo number_format($subtotde,2);?></td>
		</tr>
		<?php } ?>
		
		<tr>
            <td colspan="4" style="widtd: 15%; text-align: right;font-weight:bold">IVA(<?php echo $impuesto;?>)% <?php echo $simbolo_moneda;?> </td>
            <td style="widtd: 17%; text-align: right;font-weight:bold"> <?php echo number_format($acum_iva,2);?></td>
        </tr><tr>
            <td colspan="4" style="widtd: 15%; text-align: right;font-weight:bold">TOTAL<?php echo $simbolo_moneda;?> </td>
            <td style="widtd: 17%; text-align: right;font-weight:bold"> <?php echo number_format($total_factura,2);?></td>
        </tr>
    </table>
	
	<table cellspacing="0">
        <tr>
            <th style="width: 105%;text-align:left" class="only-line" ></th>
        </tr>
	</table>
	
	<?php 
		include("NumeroALetras.php");
		
		if ($numero_factura==1573) {
			$letras = "Expresados en Dólares Americanos (500.61 USD)";
		} else {
			$letras = "(" . NumeroALetras::convertir(number_format($total_factura,2), 'pesos','',false) . ")";
		}
	?>
	
		<div style="font-size:09pt;text-align:left;font-weight:bold"> <?php echo $letras;?> </div>

	<?php 
		if($tipo_doc==2) {
			if (!empty($membresias_selections)) {
	?>
		
	
		<br>
		<div style="font-size:11pt;text-align:center;font-weight:bold">*MAS LA MEMBRESIA ELEGIDA*</div>
		<table class="myTableLeye">
			<tr>
				<th>C O N C E P T O</th>
		  		<th>P R E C I O</th>
			</tr>
				<?php 
				//for($i = 0; $i < sizeof($string_array); $i++) {
					//$sql_prod=mysqli_query($con, "select * from products where id_producto='".$string_array[$i]."'");
					//$sql_prod=mysqli_query($con, "select nombre_producto, precio_producto from products where id_producto='".$string_array[$i]."' ORDER By convert(`precio_producto`, DECIMAL) ASC;");
					$vtmp = rtrim(implode(',', $string_array),",");
					$tmpsql="select nombre_producto, precio_producto, iva from products where id_producto IN($vtmp) ORDER By precio_producto";
					$sql_prod=mysqli_query($con, $tmpsql);
					while ($row_prod_memb=mysqli_fetch_array($sql_prod)) {
						if ($row_prod_memb['iva']==1) {
							$precio_prod_more_iva=$row_prod_memb['precio_producto'] * 1.16;
						} else {
							$precio_prod_more_iva=$row_prod_memb['precio_producto'];
						}
						echo "<tr>";
						echo "<td>".$row_prod_memb['nombre_producto']."</td>";
						echo "<td style='widtd: 15%; text-align: right'; >".number_format($precio_prod_more_iva,2)."</td>";
						echo "</tr>";	
					}
				//}
				?>
		</table>
	<?php 
		}
	?>
	
	<br>
	
	
	<div style="font-size:08pt;text-align:center;font-weight:bold">*Requisitos de contratación: 1 Copia credencial Elector, 
		1 copia comprobante de domicilio(Luz, Telefono, Predial; Edos de Cta) no mayor a 3 meses.<br>
	<br>
		*Pago por adelantado del servicio solicitado y equipo.
	<br>
		*Precios sujetos a cambio sin previo aviso.
		Entrega del servicio previo pago y firma de contrato: 11 días hábiles a partir de recibir el depósito.
	
	<br><br>
	
	
	<?php 
	//$opt_empresaslc=$rw_factura['empresaslc'];	//Empresa selector 25Jul2019
	
	if ($opt_empresaslc==1) {
		echo 'Beneficiario: ' . get_row('perfil','nombre_empresa', 'id_perfil', 1);
	} else {?>
		Beneficiario: SARAHI YULIANA GARCIA USCANGA
	<?php }?>
	
	</div>
	<br>
	<table class="myTableLeye">
		<?php 
		
		if ($opt_empresaslc==1) {
		?>
		<tr>
          	<th>BANCO</th>
		  	<th>CUENTA</th>
		  	<th>CLABE</th>
        </tr>
		<tr>
          	<td>BBVA BANCOMER</td>
		  	<td>0111454404</td>
		  	<td>012628001114544041</td>
        </tr>
		<?php } else {?>
		<tr>
          	<th>BANCO</th>
		  	<th>CUENTA</th>
		  	<th>CLABE</th>
        </tr>
		<tr>
          	<td>BBVA BANCOMER</td>
		  	<td>0191359606</td>
		  	<td>012628001913596067</td>
        </tr>
		<?php } ?>
	</table>
	
	<?php
	if($tipo_doc==2) { ?>
		<table table cellspacing="0" style="width: 100%; text-align: center; font-size: 08pt; border: 0px solid #dddddd; padding: 0px">
			<tr>
				<td style='width: 100%; font-family: Arial; font-size: 08pt; text-align: center;' align='center' > *Vigencia de la cotización de 10 días a partir de la fecha de emisión* </td>
			</tr>
		</table>
		<br>
	<?php }
	
		if($theme_comment_id > 0) {
			$largoMax = 118; // numero maximo de caracteres antes de hacer un salto de linea
			$rompeLineas = '<br/>';
			$break_long_lines = true; // string broken
			$theme_name_comment = wordwrap( $theme_name_comment, $largoMax, $rompeLineas, $break_long_lines );
		?>
			<table cellspacing="1" style="width: 100%; text-align: left; font-size: 08pt; border: 1px solid #dddddd; padding: 1px">
			<?php 
				echo "<tr>";
				echo "<td style='width: 100%; font-family: Arial; font-size: 08pt; text-align: left;'>" . $theme_name_comment . "</td>";
				echo "</tr>";
			?>
			</table>
	<?php } ?>
	
	<br>
	
	<?php 
		if($theme_image_id>0) {
		?>
		<table cellspacing="1" style="width: 100%; text-align: center; font-size: 10pt; border: 1px solid #dddddd; padding: 1px">
		<tr>
			<td style="width: 100%; text-align: center; color: #444444;">
			   <img width="662" height="262" src="../../<?php echo 'img_uploads/'.$theme_name_image;?>" alt="Logo"><br>
			</td>
		</tr>
		
		</table>
	
		<?php }
	}
	?>

</page>
