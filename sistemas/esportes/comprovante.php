<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('../Biblioteca/FPDF/fpdf.php');
require_once("../banco/gdb.php");

$db = new gdb( );
$pdf = new FPDF('P'); // relatório em orientação "portrait"

$pdf->Header("");
$pdf->Footer("");
$codigo  = $_GET['codigo'];

$pdf->SetMargins(40,40);

PDFTermo( $pdf, $db, $codigo );

$pdf->Output('Inscricao'.$codigo.'.pdf', 'I');

function PDFTermo( $pdf, $db, $codigo ) {

     $pdf->SetMargins(40,40);	
     $pdf->AddPage();
  
     $db->open("select * 
	              from pessoa p,
                       pessoaAuxiliar i,			  
			           eventoProgramacao e 
			     where p.codigoPessoa = i.codigoPessoa			 				 
				   and i.codigoPessoaAux = '$codigo' ");
  
     $hoje = date("d/m/Y");
  
     $pdf->Image('http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/images/casacivil.png',20, 12, 85 ,25);// importa uma imagem  
	 // $pdf->Image('http://www.pmf.sc.gov.br/sistemas/backend/img/logo.png',20, 12, 85 ,25);// importa uma imagem  
	 $pdf->Image('http://www.pmf.sc.gov.br/sistemas/esportes/images/logo.png',155, 12, 85 ,25);// importa uma imagem   

	
	 $pdf->SetXY(20,45);
	 $pdf->SetFont('Arial','BU',16);   
	 $pdf->Cell(180,1, " C O M P R O V A N T E   D E   I N S C R I Ç Ã O  ",0,0,'C');
	 $pdf->SetFont('Arial', '', 12);   		  
		  
	 $texto ='Certificamos  que  o  Sr(a). '.iconv('utf-8','iso-8859-1', $db->gs['NOME'][0] ).' código n.'.
	              $codigo.' portador do CPF '.$db->gs['CPF'][0].', está inscrito(a) como participante do(a)  '.iconv('utf-8','iso-8859-1', $db->gs['INSTITUICAO'][0] ).' na 1ª Conferência Municipal do Esporte, que será  realizada  no Plenarinho da Assembléia Legislativa de Santa Catarina ás 08h30 do dia 16 de março de 2018.';
	 $pdf->SetXY(20,65);           
	 // $pdf->MultiCell(180,7,iconv('utf-8','iso-8859-1', $texto ),0, 'J');
     $pdf->MultiCell(180,7,$texto,0, 'J');

	 $pdf->SetXY(20,107);		 
	 // $pdf->Cell(180, 8, iconv('utf-8','iso-8859-1', 'Florianópolis' ).", ".$hoje,0,0,'L');
	 $pdf->Cell(180, 8,  "Florianópolis, ".$hoje.".",0,0,'L');
	 
	 $pdf->SetFont('Arial', 'B', 16); 	 
	 $pdf->SetXY(20,140);
	 $pdf->Cell(180, 1,'FUNDAÇÃO MUNICIPAL DE ESPORTES',0,0,'C');	 	 

}

?>