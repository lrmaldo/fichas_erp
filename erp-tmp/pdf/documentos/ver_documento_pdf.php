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
	/* Connect To Database */
	include("../../config/db.php");
	include("../../config/conexion.php");
	//Archivo de funciones PHP
	include("../../funciones.php");
	
	$id_user = intval($_GET['id_user']);
	$nTypeHra= intval($_GET['nhra']);
	$nMedida = intval($_GET['nMedida']);
	$nPrecFicha = intval($_GET['nPrecPr']);
	$nPrintP = intval($_GET['nPrintP']);

	$v_id_user = $_GET['id_user'];
	$v_nHra= $_GET['nhra'];

	
	/*
	$sql="select record_card_user, record_card_pasw from record_cards WHERE record_card_user_id='$id_user' and record_card_num_hora=1 order by record_card_user";
	$querysql=mysqli_query($con, $sql);
	$count=mysqli_num_rows($querysql);
	if ($count==0) {
		echo "<script>alert('No existen registros de este usuario')</script>";
		echo "<script>window.close();</script>";
        echo "0";
        exit;
	}
	*/
	
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
    
	//Get the HTML
    ob_start();

	if ($nMedida==1) { 
		include(dirname('__FILE__').'/res/ver_documento_48xh_html.php');
	} else { 
		include(dirname('__FILE__').'/res/ver_documento_20xh_html.php');
	}
    
	$content = ob_get_clean();

    try
    {
        // init HTML2PDF 'P'-Vertical,'L'-Horizontal, 'Letter,Legal,A4'
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
		ob_end_clean();
		$html2pdf->Output("prueba.pdf");
		
		//UPDATE record_cards SET record_card_used=0 where record_card_user_id=13 and record_card_num_hora=1
		$editqry="UPDATE record_cards SET record_card_used=1 where record_card_user_id='$v_id_user' and record_card_num_hora='$v_nHra'";
		if(mysqli_query($con, $editqry)){
			echo "Records were updated successfully.";
		} else {
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
		}
		
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

	
