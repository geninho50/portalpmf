<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../banco/gdb.php");
$gdb = new gdb();

$id_pessoa = $gdb->vargetpost('idPessoa');

$gdb->open("SELECT m.id_troca, 
				   m.id_pessoa, 
				   m.data_troca, 
				   m.quantidade_troca 
				 from minhocario m 
				 where m.id_pessoa = '$id_pessoa' order by m.data_troca desc");

$id_troca = $gdb->gs["ID_TROCA"][0];
$data_troca = $gdb->gs["DATA_TROCA"];
$quantidade_troca = empty($gdb->gs["DATA_TROCA"][0]) ? 0 : count($gdb->gs["DATA_TROCA"]);

$desviado = 15.9;
$total = $quantidade_troca * $desviado;

$gdb->open("SELECT p.cpf, p.nome, p.email, p.telefone, p.celular
				FROM pessoa p
			WHERE p.id_pessoa = '$id_pessoa'");

$cpf = $gdb->gs["CPF"][0];
$nome = $gdb->gs["NOME"][0];
$email = $gdb->gs["EMAIL"][0];
$telefone = $gdb->gs["TELEFONE"][0];
$celular = $gdb->gs["CELULAR"][0];



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
							 ->setTitle("Lista de Trocas de Caixa")
							 ->setSubject("Lista de Trocas de Caixa")
							 ->setDescription("Lista de Trocas de Caixa")
							 ->setKeywords("office 2007 openxml php")
                             ->setCategory("Lista de Trocas de Caixa");

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nome:')
            ->setCellValue('B1', 'CPF:')
            ->setCellValue('C1', 'E-mail:')
            ->setCellValue('D1', 'Telefone:')
            ->setCellValue('E1', 'Celular:');


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', $nome)
            ->setCellValue('B2', $cpf)
            ->setCellValue('C2', $email)
            ->setCellValue('D2', $telefone)
            ->setCellValue('E2', $celular);
			
//Definindo alinhamento das Celulas para direita
$objPHPExcel->getActiveSheet()
			->getStyle('A1:E1')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//Definindo alinhamento das Celulas no Centro (Vertical)
$objPHPExcel->getActiveSheet()
			->getStyle('A1:E1')
			->getAlignment()
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


// Miscellaneous glyphs, UTF-8
for ($i = 0; $i < count($data_troca); $i++){
	$objPHPExcel->setActiveSheetIndex(0)
	            ->setCellValue('A'.($i+3), date('d/m/Y', strtotime($data_troca[$i])));


	//Definindo alinhamento das Celulas para direita
	$objPHPExcel->getActiveSheet()
    			->getStyle('A'.($i+3).':E'.($i+3))
    			->getAlignment()
    			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    //Definindo alinhamento das Celulas no Centro (Vertical)
    $objPHPExcel->getActiveSheet()
    			->getStyle('A'.($i+3).':E'.($i+3))
    			->getAlignment()
    			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
}

//Definindo Celulas A1:F1 como Negrito
$objPHPExcel->getActiveSheet()
			->getStyle("A1:E1")
			->getFont()
			->setBold( true );

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Trocas de Caixa');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="trocasExcel.xls"');
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