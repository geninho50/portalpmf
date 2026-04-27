<?php

include_once("../banco/gdb.php");
$gdb = new gdb();

$id_evento = $gdb->vargetpost('idEvento');

$gdb->open("SELECT p.id_pessoa,
                   p.cpf, 
				   p.nome, 
				   p.email, 
				   p.telefone, 
				   p.celular, 
				   p.complemento,
				   d.doc_residencia,
			       e.id_evento, 
				   e.nome_evento, 
				   e.carga_horaria, 
				   e.vagas, 
				   e.data, 
				   e.hora, 
				   ei.status_inscricao,
				   ed.cep,
				   ed.bairro,
				   ed.logradouro
				   FROM pessoa p
			LEFT JOIN endereco ed        ON ed.id_endereco = p.id_endereco
			LEFT JOIN documentoPessoa d  ON p.id_pessoa = d.id_pessoa
			LEFT JOIN eventoInscricao ei ON ei.id_pessoa = p.id_pessoa
			LEFT JOIN evento e           ON e.id_evento = ei.id_evento
			WHERE ei.status_inscricao = 1
			AND e.id_evento = '$id_evento'");
$dados = $gdb->gs;        

if(empty($dados["DOC_RESIDENCIA"][$i]) || $dados["DOC_RESIDENCIA"][$i] == 0 ) {
	$doc = 'Não há documento';
} else {
	$doc = $status_inscricao;
}

date_default_timezone_set('Europe/London');
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
/** Include PHPExcel */
require 'PHPExcel-1.8/Classes/PHPExcel.php';
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


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Data:')
            ->setCellValue('B1', date('d/m/Y', strtotime($dados["DATA"][0])))
            ->setCellValue('C1', 'Hora:')
            ->setCellValue('D1', $dados["HORA"][0])
            ->setCellValue('E1', 'Número de Vagas:')
            ->setCellValue('F1', $dados["VAGAS"][0]);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A3', 'Nome')
            ->setCellValue('B3', 'CPF')
            ->setCellValue('C3', 'Email')
			->setCellValue('D3', 'Cep')
			->setCellValue('E3', 'Logradouro')
			->setCellValue('F3', 'Complemento')
			->setCellValue('G3', 'Bairro')
            ->setCellValue('H3', 'Telefone')
            ->setCellValue('I3', 'Celular')
            ->setCellValue('J3', 'Assinatura')
            ->setCellValue('K3', 'Termo de Compromisso')
			->setCellValue('L3', 'Comprovante de Residencia');
			
			
//Definindo alinhamento das Celulas para direita
$objPHPExcel->getActiveSheet()
			->getStyle('A1:L1')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//Definindo alinhamento das Celulas no Centro (Vertical)
$objPHPExcel->getActiveSheet()
			->getStyle('A1:L1')
			->getAlignment()
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


// Miscellaneous glyphs, UTF-8
for ($i = 0; $i < count($dados["NOME"]); $i++){
	$objPHPExcel->setActiveSheetIndex(0)
	            ->setCellValue('A'.($i+4), $dados["NOME"][$i])
	            ->setCellValue('B'.($i+4), $dados["CPF"][$i])
	            ->setCellValue('C'.($i+4), $dados["EMAIL"][$i])
				->setCellValue('D'.($i+4), $dados["CEP"][$i])
				->setCellValue('E'.($i+4), $dados["LOGRADOURO"][$i])
				->setCellValue('F'.($i+4), $dados["COMPLEMENTO"][$i])
				->setCellValue('G'.($i+4), $dados["BAIRRO"][$i])
	            ->setCellValue('H'.($i+4), $dados["TELEFONE"][$i])
	            ->setCellValue('I'.($i+4), $dados["CELULAR"][$i])
				->setCellValue('J'.($i+4), '')
				->setCellValue('K'.($i+4), 'X')
	            ->setCellValue('L'.($i+4), $doc);


	//Definindo alinhamento das Celulas para direita
	$objPHPExcel->getActiveSheet()
    			->getStyle('A'.($i+4).':L'.($i+4))
    			->getAlignment()
    			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    //Definindo alinhamento das Celulas no Centro (Vertical)
    $objPHPExcel->getActiveSheet()
    			->getStyle('A'.($i+4).':L'.($i+4))
    			->getAlignment()
    			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
}

//Definindo Celulas A1:F1 como Negrito
$objPHPExcel->getActiveSheet()
			->getStyle("A3:L3")
			->getFont()
			->setBold( true );
			

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Participantes Cursos');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="cursosExcel.xls"');
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