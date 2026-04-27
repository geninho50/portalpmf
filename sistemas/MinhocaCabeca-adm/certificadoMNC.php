<?php
require_once('../Biblioteca/FPDF/fpdf.php');
require_once("../banco/gdb.php");

$db = new gdb( );
$pdf = new FPDF('L'); // relat�rio em orienta��o "portrait"

$pdf->Header("");
$pdf->Footer("");
$codigoPessoa = $_GET['codigoPessoa'];

$pdf->SetMargins(40,40);

PDFTermo( $pdf, $db, $codigoPessoa );

$pdf->Output('certificadoMNC'.$codigoPessoa.'.pdf', 'I');

function PDFTermo( $pdf, $db, $codigoPessoa ) {

     $pdf->SetMargins(40,40);	
  
     $db->open(" select p.nome, DATE_FORMAT( pe.data,'%d/%m/%Y' ) as data 
				  from pessoa p, 
					   eventoInscricao i, 
					   eventoProgramacao pe, 
					   evento e 
				where p.codigoPessoa = i.codigoPessoa 
				  and pe.codigoTurma = i.codigoTurma 
				  and pe.codigoEvento = e.codigoEvento 
				  and codigoprojeto = 'MNC' 
				  and i.tipo = 'P'
				  and i.codigoPessoa = $codigoPessoa ");
	
     $pdf->AddPage();
	
     $hoje = date("d/m/Y");
  
	 $pdf->Image('http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca-adm/images/certificadoFrente.png',02, 02, 290 ,205);// importa uma imagem  
	 
	 
	 $nome = iconv('utf-8','iso-8859-1', $db->gs['NOME'][0] );
	 $pdf->SetXY(50,110);
	 $pdf->SetFont('Arial','',32);   
	 $pdf->Cell(180,1, $nome,0,0,'C');
	 
	 $pdf->SetXY(49,153);
	 $pdf->SetFont('Arial','',11);   
	 $pdf->Cell(180,1, date("d"),0,0,'C');	 
	 
	 $mes = Array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
	 
	 $pdf->SetXY(75,153);
	 $pdf->SetFont('Arial','',11);   
	 $pdf->Cell(180,1, $mes[(date("m")-1)],0,0,'C');	 	 
	 /* */
     $pdf->AddPage();
	 
	 $pdf->Image('http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca-adm/images/certificadoVerso.png',02, 02, 290 ,205);// importa uma imagem  

	 $pdf->SetXY(83,99);
	 $pdf->SetFont('Arial','',11);   
	 $pdf->Cell(180,1,$db->gs['DATA'][0],0,0,'L');	 	 
	 /*
	 $pdf->SetXY(58,106);
	 $pdf->SetFont('Arial','',11);   
	 $pdf->Cell(180,1,'20 de Janeiro a 27 de Mar�o de 2018',0,0,'L');	 	 
	 */
	 
}

?>