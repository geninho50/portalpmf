<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('../Biblioteca/FPDF/fpdf.php');
require_once("banco/gdb.php");

$db = new gdb( );
$pdf = new FPDF('L'); // relatório em orientação "portrait"

$pdf->Header("");
$pdf->Footer("");
$codigoPessoa = $_GET['codigoUsuario'];

$pdf->SetMargins(40,40);

PDFTermo( $pdf, $db, $codigoPessoa );

$pdf->Output('certificado'.$codigoPessoa.'.pdf', 'I');

function PDFTermo( $pdf, $db, $codigoPessoa ) {

     $pdf->SetMargins(40,40);	
  
     $db->open(" select l.nome as nome, 
                      c.tipo as tipo,
                      c.assunto as assunto,
                      c.ministrante as ministrante,
                      DATE_FORMAT(a.data,'%d/%m/%Y') as data, 
                      l.carga as carga
		  from lista l, capacitacao c, agenda a
		  where l.idCapacitacao = c.id 
		  and a.idCapacitacao = c.id
		  and l.cpf = '$codigoPessoa' ");
	
     $pdf->AddPage();
	
  
	 $pdf->Image('http://www.pmf.sc.gov.br/sistemas/rastreabilidade/imagens/certificado.jpg',02, 02, 290 ,205);// importa uma imagem  
	 $nome = iconv('utf-8','iso-8859-1', 'Certificamos que ' );
	 $pdf->SetXY(25,80);
	 $pdf->SetFont('Arial','',15);   
	 $pdf->Cell(100,1, $nome,0,0,'C');


	 $nome = iconv('utf-8','iso-8859-1', $db->gs['NOME'][0] );
	 $pdf->SetXY(70,80);
	 $pdf->SetFont('Arial','B',15);   
	 $pdf->Cell(150,1, $nome,0,0,'C');

	 $nome = iconv('utf-8','iso-8859-1', ' participou do evento ' );
	 $pdf->SetXY(85,80);
	 $pdf->SetFont('Arial','',15);   
	 $pdf->Cell(300,1, $nome,0,0,'C');

	 $nome = iconv('utf-8','iso-8859-1', $db->gs['TIPO'][0] );
	 $pdf->SetXY(05,90);
	 $pdf->SetFont('Arial','B',15);   
	 $pdf->Cell(100,1, $nome,0,0,'C');

	 $nome = iconv('utf-8','iso-8859-1', '-' );
	 $pdf->SetXY(05,90);
	 $pdf->SetFont('Arial','',15);   
	 $pdf->Cell(150,1, $nome,0,0,'C');

	 $nome = iconv('utf-8','iso-8859-1', $db->gs['ASSUNTO'][0] );
	 $pdf->SetXY(65,90);
	 $pdf->SetFont('Arial','B',15);   
	 $pdf->Cell(130,1, $nome,0,0,'C');


	 $nome = iconv('utf-8','iso-8859-1', ' realizado no dia ' );
	 $pdf->SetXY(105,90);
	 $pdf->SetFont('Arial','',15);   
	 $pdf->Cell(200,1, $nome,0,0,'C');


	 $nome = iconv('utf-8','iso-8859-1', $db->gs['DATA'][0] );
	 $pdf->SetXY(18,90);
	 $pdf->SetFont('Arial','B',15);   
	 $pdf->Cell(450,1, $nome,0,0,'C');


	 $nome = iconv('utf-8','iso-8859-1', ' com carga horaria total de ' );
	 $pdf->SetXY(45,100);
	 $pdf->SetFont('Arial','',15);   
	 $pdf->Cell(50,1, $nome,0,0,'C');


	 $nome = iconv('utf-8','iso-8859-1', $db->gs['CARGA'][0]);
	 $pdf->SetXY(85,100);
	 $pdf->SetFont('Arial','B',15);   
	 $pdf->Cell(50,1, $nome,0,0,'C');


	 $nome = iconv('utf-8','iso-8859-1', ' horas.');
	 $pdf->SetXY(100,100);
	 $pdf->SetFont('Arial','',15);   
	 $pdf->Cell(50,1, $nome,0,0,'C');


	 $nome = iconv('utf-8','iso-8859-1', 'Florianopolis,' );
	 $pdf->SetXY(52,113);
	 $pdf->SetFont('Arial','',13);   
	 $pdf->Cell(150,1, $nome,0,0,'C');

	 
	 $pdf->SetXY(55,113);
	 $pdf->SetFont('Arial','',13);   
	 $pdf->Cell(180,1, date("d"),0,0,'C');	 

	 $nome = iconv('utf-8','iso-8859-1', ' de ' );
	 $pdf->SetXY(77,113);
	 $pdf->SetFont('Arial','',13);   
	 $pdf->Cell(150,1, $nome,0,0,'C');
	 
	 $mes = Array("janeiro","fevereiro","março","abril","maio","junho","julho","agosto","setembro","outubro","novembro","dezembro");
	 
	 $pdf->SetXY(77,113);
	 $pdf->SetFont('Arial','',13);   
	 $pdf->Cell(180,1, $mes[(date("m")-1)],0,0,'C');	 

	 $nome = iconv('utf-8','iso-8859-1', ' de ' );
	 $pdf->SetXY(107,113);
	 $pdf->SetFont('Arial','',13);   
	 $pdf->Cell(150,1, $nome,0,0,'C');

	 $pdf->SetXY(107,113);
	 $pdf->SetFont('Arial','',13);   
	 $pdf->Cell(170,1, date("Y"),0,0,'C');	


  
	 /* */
    //  $pdf->AddPage();
	 
	 // $pdf->Image('http://www.pmf.sc.gov.br/sistemas/rastreabilidade/images/certificado_verso.png',02, 02, 290 ,205);// importa uma imagem  


	 
	 /*
	 $pdf->SetXY(58,106);
	 $pdf->SetFont('Arial','',11);   
	 $pdf->Cell(180,1,'20 de Janeiro a 27 de Março de 2018',0,0,'L');	 	 
	 */
	 
}

?>

