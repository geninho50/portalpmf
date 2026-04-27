<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$dados = $_POST["dados"];

foreach ($dados as $key => $value) {
	$dados[$key] = explode(',', $value);
}

date_default_timezone_set('Europe/London');
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
/** Include PHPExcel */
require_once 'PHPExcel-1.8/Classes/PHPExcel.php';
PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Prefeitura Municipal de Florianopolis")
							 ->setLastModifiedBy("Prefeitura Municipal de Florianopolis")
							 ->setTitle("Lista de participantes do curso Minhoca na Cabeca")
							 ->setSubject("Lista de participantes do curso Minhoca na Cabeca")
							 ->setDescription("Lista de participantes do curso Minhoca na Cabeca.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Lista de participantes");
// Add some data
$data = substr($dados[0][0],8,2)."/".substr($dados[0][0],5,2)."/".substr($dados[0][0],0,4);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Data:')
            ->setCellValue('B1', $data)
            ->setCellValue('C1', 'Hora:')
            ->setCellValue('D1', $dados[0][1])
            ->setCellValue('E1', 'Número de Vagas:')
            ->setCellValue('F1', $dados[0][2]);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'N')
            ->setCellValue('B2', 'Nome')
            ->setCellValue('C2', 'CPF')
            ->setCellValue('D2', 'Email')
            ->setCellValue('E2', 'Telefone')
            ->setCellValue('F2', 'Celular')
            ->setCellValue('G2', 'Assinatura')
            ->setCellValue('H2', 'Termo de Compromisso')
            ->setCellValue('I2', 'Comprovante de Residencia');
//Definindo alinhamento das Celulas para direita
$objPHPExcel->getActiveSheet()
			->getStyle('A1:I1')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
//Definindo alinhamento das Celulas no Centro (Vertical)
$objPHPExcel->getActiveSheet()
			->getStyle('A1:I1')
			->getAlignment()
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


// Miscellaneous glyphs, UTF-8
for ($i = 1; $i < count($dados); $i++){
	$objPHPExcel->setActiveSheetIndex(0)
	            ->setCellValue('A'.($i+2), $i)
	            ->setCellValue('B'.($i+2), $dados[$i][0])
	            ->setCellValue('C'.($i+2), $dados[$i][1])
	            ->setCellValue('D'.($i+2), $dados[$i][2])
	            ->setCellValue('E'.($i+2), $dados[$i][3])
	            ->setCellValue('F'.($i+2), $dados[$i][4]);

	//Definindo alinhamento das Celulas para direita
	$objPHPExcel->getActiveSheet()
    			->getStyle('A'.($i+2).':F'.($i+2))
    			->getAlignment()
    			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    //Definindo alinhamento das Celulas no Centro (Vertical)
    $objPHPExcel->getActiveSheet()
    			->getStyle('A'.($i+2).':F'.($i+2))
    			->getAlignment()
    			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
}

//Definindo Celulas A1:F1 como Negrito
$objPHPExcel->getActiveSheet()
			->getStyle("A2:I2")
			->getFont()
			->setBold( true );

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Participantes Cursos');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="participantesCursos.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;