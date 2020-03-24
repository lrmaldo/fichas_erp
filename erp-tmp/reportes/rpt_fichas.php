<?php

session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
	exit;
}

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Mexico_City');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/* Connect To Database*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
include("../funciones.php");

/*
if ($_SESSION['B_RPT01']=='') {
	$filter="Sin filtro";
} else {
	$filter='Filtrado por: ' . $_SESSION['B_RPT01'];
}
$sqry = $_SESSION['S_RPT01'];
$qry_prod=mysqli_query( $con, $sqry );
*/

$dTDate=date('d/m/Y h:i:s a', time());

$id_user = intval($_GET['id_user']);
$nTypeHra= intval($_GET['nhra']);
$nPrecFicha = $_GET['nPrecPr'];
$nsaldo = $_GET['nsaldo'];
$print_pf = intval($_GET['print_pf']);

$HeadTitulo="Reporte de liberacion de Fichas para el usuario:".$_SESSION['user_name']." fecha:".$dTDate;
if($print_pf==1) {
	$filter="Liberacion de Fichas, cantidad usuarios:".$nsaldo.", precio:".$nPrecFicha;
} else {
	$filter="Liberacion de Fichas, cantidad usuarios:".$nsaldo.", sin asignar precio.";
}

$sql="select record_card_user, record_card_pasw from record_cards where record_card_user_id='$id_user' and record_card_num_hora='$nTypeHra' and record_card_used=0 order by record_card_user";
$qry_rpt=mysqli_query($con, $sql);

/** Include PHPExcel */
require_once '../classes/PHPExcel.php';
//require_once '../classes/PHPExcel/IOFactory.php';

// Create new PHPExcel object
//echo date('H:i:s') , " Create new PHPExcel object" , EOL;
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maxim-Card")
							 ->setLastModifiedBy("Maxim-Card-26Dic2017")
							 ->setTitle("Maxim-Card")
							 ->setSubject("Maxim-Card Reporte fichas libres")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("");

$sheet=$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('B1', $HeadTitulo)
			->setCellValue('C1', $filter )
            ->setCellValue('A3', 'USUARIO')
            ->setCellValue('B3', 'CONTRASEÑA');

// Set Orientation, size and scaling
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
//$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);


// Set alignments
$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

// Set fills Head
//$objPHPExcel->getActiveSheet()->getStyle('B1:F1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//$objPHPExcel->getActiveSheet()->getStyle('B1:F1')->getFill()->getStartColor()->setARGB('FF808080');

// Logo
/*
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$objDrawing->setPath('../'.get_row('perfil','logo_url', 'id_perfil', 1));
$objDrawing->setHeight(36);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
*/
$start= 4;
while ($rw=mysqli_fetch_array($qry_rpt)) {
	$sheet->setCellValue('A'.$start, $rw['record_card_user'])
	->setCellValue('B'.$start, $rw['record_card_pasw']);
	$start++;
}

// Save Excel 2007 file
//echo date('H:i:s') , " Write to Excel2007 format" , EOL;
//$callStartTime = microtime(true);

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
//$callEndTime = microtime(true);
//$callTime = $callEndTime - $callStartTime;

// Redirect output to a client’s web browser (OpenDocument)
//header('Content-Type: application/vnd.oasis.opendocument.spreadsheet');
//header('Content-Disposition: attachment;filename="Productos-'.$dDate.'.xlsx"');
//header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
//header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

try {
	//save the file to the server (Excel2007)
	$fileName="fichas-".date('m-d-Y')."cantidad(".$nsaldo.")usuario(".$_SESSION['user_name'].")";
	//$fileName="fichas-".date('m-d-Y')."cantidad(".$nsaldo.")";
	//dirname(__FILE__)
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save($fileName . '.xlsx');
	//$objWriter->save($_SERVER['DOCUMENT_ROOT'] .'/reportes/filename.xlsx');
	$fileName.=".xlsx";
	/*
	$opResult = array( 'status' => 0,
					  'url' => 'http://'.$_SERVER['SERVER_NAME'].':81/erp-tmp/reportes/'.$fileName,
					  'sam' => $_SERVER['SERVER_NAME']
					 );
					*/
	$opResult = array( 'status' => 0,
					  'url' => 'http://'.$_SERVER['SERVER_NAME'].'/controlfichas/reportes/'.$fileName,
					  'sam' => $_SERVER['SERVER_NAME']
					 );
	//UPDATE record_cards SET record_card_used=0 where record_card_user_id=13 and record_card_num_hora=1
	$editqry="UPDATE record_cards SET record_card_used=1 where record_card_user_id='$id_user' and record_card_num_hora='$nTypeHra'";
	if(mysqli_query($con, $editqry)){
		//echo "Records were updated successfully.";
	} else {
		//echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
	}
}
	catch (Exception $e) {
		/*
		$opResult = array( 'status' => 1,
						'url' => 'http://'.$_SERVER['SERVER_NAME'].':81/erp-tmp/reportes/'.$fileName,
						'sam' => $_SERVER['SERVER_NAME']
					);
					*/
		$opResult = array( 'status' => 1,
						'url' => 'http://'.$_SERVER['SERVER_NAME'].'/controlfichas/reportes/'.$fileName,
						'sam' => $_SERVER['SERVER_NAME']
					);
	}
echo json_encode($opResult);
