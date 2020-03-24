<?php
	/*-------------------------
	Autor: Elio Mojica
	Web: maximcode.com
	Mail: admin@maximcode.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
		exit;
    }
	
	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");
	//Archivo de funciones PHP
	include("../../funciones.php");
	$session_id= session_id();
	$sql_count=mysqli_query($con,"select * from tmp where session_id='".$session_id."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('No hay productos agregados al documento')</script>";
	echo "<script>window.close();</script>";
	exit;
	}

	require_once(dirname(__FILE__).'/../html2pdf.class.php');
		
	//Variables por GET
	$tipo_doc=intval($_GET['tipo_doc']);
	$id_cliente=intval($_GET['id_cliente']);
	$id_vendedor=intval($_GET['id_vendedor']);
	$datoc1=$_GET['datoc1'];
	$datoc2=$_GET['datoc2'];
	$datoc3=$_GET['datoc3'];

	$condiciones=mysqli_real_escape_string($con,(strip_tags($_REQUEST['condiciones'], ENT_QUOTES)));
	//Fin de variables por GET
	
	$sql=mysqli_query($con, "select count(*) as ncount from facturas");
	$rw=mysqli_fetch_array($sql);
	$ncount=intval($rw['ncount']);
	
	if($ncount==0) {
		$numero_factura=1302;
	} else {
		$sql=mysqli_query($con, "select LAST_INSERT_ID(id_factura) as last from facturas order by id_factura desc limit 0,1 ");
		$rw=mysqli_fetch_array($sql);
		//Se recupera el numero de factura insertado
		$numero_factura=$rw['last']+1;	// Mientras se desactiva para poder empezar con los documentos en 1032
	}
	
	if($tipo_doc==1) {
		$Titulo_doc = "VENTA Nº " . $numero_factura;
		$leyenda_doc="VENTA EN ATENCION A: ";
		$name_file_pdf="venta-" . $id_cliente . "-" . $numero_factura . ".pdf";
		$cerrada=1;
	} else if($tipo_doc==2) {
		$Titulo_doc = "COTIZACION Nº " . $numero_factura;
		$leyenda_doc="COTIZACION EN ATENCION A:";
		$name_file_pdf="cotizacion-" . $id_cliente . "-" . $numero_factura . "-" . date('dmY') . ".pdf";
		$cerrada=0;
	}
	
	$simbolo_moneda=get_row('perfil','moneda', 'id_perfil', 1);
    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/factura_html.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        //$html2pdf->Output('Factura.pdf');
		ob_end_clean();
		$html2pdf->Output($name_file_pdf);
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
