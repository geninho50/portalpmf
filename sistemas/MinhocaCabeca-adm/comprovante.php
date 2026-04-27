<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('../Biblioteca/FPDF/fpdf.php');
require_once("../banco/gdb.php");

$db = new gdb( );
$pdf = new FPDF('P'); // relat�rio em orienta��o "portrait"

$pdf->Header("");
$pdf->Footer("");
$codigoPessoa = $_GET['codigoPessoa'];
$codigoTurma  = $_GET['codigoTurma'];

$pdf->SetMargins(40,40);

PDFTermo( $pdf, $db, $codigoPessoa, $codigoTurma );

$pdf->Output('termo'.$codigoPessoa.$codigoTurma.'.pdf', 'I');

function PDFTermo( $pdf, $db, $codigoPessoa, $codigoTurma ) {

     $pdf->SetMargins(40,40);	
     $pdf->AddPage();
  
     $db->open("select * 
	              from pessoa p,
                       pessoaEndereco d	,			  
                       eventoInscricao i,			  
			           eventoProgramacao e 
			     where p.codigoPessoa = i.codigoPessoa
				   and d.codigoPessoa = p.codigoPessoa
				   and d.codigoProjeto = '1'
                   and e.codigoTurma = i.codigoTurma				 
				   and i.codigoTurma = $codigoTurma 
				   and i.codigoPessoa = $codigoPessoa ");
  
     $hoje = date("d/m/Y");
  
	 $pdf->Image('http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca-adm/images/casacivil.png',20, 12, 85 ,25);// importa uma imagem  
	 $pdf->Image('http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca-adm/images/Comcap.PNG',105, 12, 85 ,25);// importa uma imagem   

	 /* */   
	 $pdf->SetXY(20,45);
	 $pdf->SetFont('Arial','BU',14);   
	 $pdf->Cell(180,1, " T E R M O   D E   C O M P R O M I S S O ",0,0,'C');
	 $pdf->SetFont('Arial', '', 10);   
		  
	 $texto ='Eu '.iconv('utf-8','iso-8859-1', $db->gs['NOME'][0] ).', inscrito com o código MNC'.
	              $codigoPessoa.' portador do CPF '.
	              $db->gs['CPF'][0].', identidade '.
				  $db->gs['IDENTIDADE'][0].' residente n(a) '.
				  iconv('utf-8','iso-8859-1', $db->gs['LOGRADOURO'][0] ).' nr. '.
				  $db->gs['NUMERO'][0].' - bairro '.
				  iconv('utf-8','iso-8859-1', $db->gs['BAIRRO'][0] ).' - municipio '.
				  iconv('utf-8','iso-8859-1', $db->gs['MUNICIPIO'][0] ).' - CEP '.$db->gs['CEP'][0].'. Me comprometo a :     

	[X] Participar da oficina de capacitação no dia '.$db->formato($db->gs['DATA'][0],'DD/MM/YYYY').' às '.substr($db->gs['HORA'][0],0,5).'hs ( Turma '.$codigoTurma.' ) .
	[X] Informar com antecedência de dois dias ( 48 horas) caso não possa participar da oficina de capacitação, no campo indicado no site do projeto Minhoca na Cabeça.
	[X] Utilizar o kit (caixas e minhocas) recebidos no dia da oficina de capacitação exclusivamente para o seu objetivo que é o tratamento domiciliar dos resíduos orgânicos.
	[X] Assinar termo de recebimento do kit (caixas e minhocas) ao final da oficina de capacitação.
	[X] Participar do sistema de monitoramento do projeto Minhoca na Cabeça com informações relativas às quantidades tratadas, por meio de campo indicado no site do projeto Minhoca na Cabeça.
	[X] Devolver o kit ao projeto Minhoca na Cabeça caso não se adapte ao tratamento domiciliar dos resíduos orgânicos ou por algum outro motivo, A devolução deverá ser solicitada no campo indicado no site do projeto Minhoca na Cabeça, para que a Prefeitura de Florianópolis possa providenciar sua retirada.';
	 $pdf->SetXY(20,65);           
	 // $pdf->MultiCell(180,7,iconv('utf-8','iso-8859-1', $texto ),0, 'J');
     $pdf->MultiCell(180,7,$texto,0, 'J');

	 $pdf->SetXY(20,177);		 
	 // $pdf->Cell(180, 8, iconv('utf-8','iso-8859-1', 'Florian�polis' ).", ".$hoje,0,0,'L');
	 $pdf->Cell(180, 8,  "Florianópolis, ".$hoje.".",0,0,'L');
	 
	 $pdf->SetFont('Arial', '', 10); 	 
	 $pdf->SetXY(20,210);
	 $pdf->Cell(180, 1,'Ass.: _________________________________________________________',0,0,'C');	 
	 $pdf->SetXY(20,220);
	 $pdf->Cell(180, 1,iconv('utf-8','iso-8859-1', $db->gs['NOME'][0] ),0,0,'C');
}

?>