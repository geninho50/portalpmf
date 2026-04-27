<?php
header("charset=utf-8");
include_once("pdf.class.php");
$pdf = new docmpdf();

$dados = $_POST["dados"];

foreach ($dados as $key => $value) {
	$dados[$key] = explode(',', $value);
}

$pdf->docmpdf("L");
$pdf->departamento = "";
$pdf->pageno = true;
$pdf->headerline = true;
$pdf->header1 = true;

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 12);	
$pdf->Cell(0, 15, utf8_decode("HISTÓRICO DO CONTRIBUINTE IMOBILIÁRIO"), 0, 1, 'C', false);
$pdf->SetFont('Arial', '', 8);

$header = array('Data de Alteração', 'Usuário', 'Campo Alterado', 'Valor Antigo', 'Valor Novo', 'Processo');

$dimension = array(25, 15, 42, 34, 34, 30);
foreach($header as $key => $col){
	$pdf->Cell($dimension[$key],7,utf8_decode($col),1);
}
$pdf->Ln();
foreach($dados as $row){
	foreach($row as $key => $col){
		$pdf->Cell($dimension[$key],6,utf8_decode($col),1);
	}
	$pdf->Ln();
}

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$pdf->SetY(276);
$pdf->Cell(0, 0, "Florian\363polis, ".strftime('%d de %B de %Y', strtotime('today')), 0, 0, 'C');

$pdf->Output("historico.pdf","D");
$pdf->getOutputFile("historico");
?>