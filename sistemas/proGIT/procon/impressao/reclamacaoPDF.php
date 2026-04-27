<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('../../Biblioteca/FPDF/fpdf.php');
require_once("../../banco/gdb.php");

/*
  print "<pre>";
  print_r( $_GET );
  print_r( $_POST );
  print_r( $_FILES );
  print "</pre>";
  */
  
$db = new gdb( );
$pdf = new FPDF('P'); // relat�rio em orienta��o "portrait"

$pdf->Header("");
$pdf->Footer("");
$codigoPessoa   = $db->vargetpost('codigoPessoa');
$codigoReclamacao   = $db->vargetpost('codigoReclamacao');


$pdf->SetMargins(40,40);

PDFComprovante( $pdf, $db, $codigoReclamacao );

$pdf->Output('ComprovanteR'.$codigoReclamacao.'P'.$codigoPessoa.'.pdf', 'I');

function PDFComprovante( $pdf, $db, $codigoReclamacao ) {

     $pdf->SetMargins(40,40);	
     $pdf->AddPage();
  
     $db->open("SELECT r.*, p.*, pe.*, 
	                   DATE_FORMAT(r.lancamento,'%d/%m/%Y') AS data,
					   DATE_FORMAT(r.lancamento,'%Y') AS ano 		
				  FROM proconReclamacao r
				  JOIN pessoa p
					ON p.codigoPessoa = r.codigoPessoa
				  JOIN pessoaEndereco pe
					ON pe.codigoPessoa = p.codigoPessoa
				 WHERE r.codigoReclamacao  = '$codigoReclamacao'  ");
  
     $hoje = date("d/m/Y");
	 
	 $pedido  = $db->gs['PEDIDO'][0];
	 $relato  = $db->gs['RELATO'][0];
	 $assunto = $db->gs['ASSUNTO'][0];
	 
	 $pdf->Image('http://www.pmf.sc.gov.br/images/bannerprocon2.jpeg',20, 12, 80 ,25);// importa uma imagem  

	 /* */   
	 $y = 45;
	 $pdf->SetXY(20,$y);
	 $pdf->SetFont('Arial','BU',14);   
	 $pdf->Cell(180,1, " Comprovante de ".iconv('utf-8','iso-8859-1', 'Atendimento' ),0,0,'C');
	 $pdf->SetFont('Arial', '', 10);   
	 
	 $y +=15;
     $pdf->SetXY(20,$y);
	 $pdf->Cell(180,1, iconv('utf-8','iso-8859-1', 'CÓDIGO DO ATENDIMENTO ... : ' ).str_pad($codigoReclamacao, 6, "0", STR_PAD_LEFT) ."/".$db->gs['ANO'][0]."                        Data ...:  ".$db->gs['DATA'][0],0,0,'L');
	 
	 $y +=10;
	 $pdf->SetFont('Arial', 'U', 10);  	
     $pdf->SetXY(20,$y);
	 $pdf->Cell(180,1, "DADOS DO CONSUMIDOR",0,0,'L');
	 
	 $y +=7;
     $pdf->SetFont('Arial', '', 10);
     $pdf->SetXY(20,$y);

	 if( $db->gs['CPF'][0] !="" )$documento = 'CPF';
	 else $documento = "CNPJ";
	 
	 $pdf->Cell(180,1, "Documento :  ".$db->gs[$documento][0],0,0,'L');
     $y +=5;  
     $pdf->SetXY(20,$y);
	 $pdf->Cell(180,1, "Nome ........ :  ".iconv('utf-8','iso-8859-1//TRANSLIT', $db->gs['NOME'][0] ),0,0,'L');
	 $y +=5;  
     $pdf->SetXY(20,$y);
	 $pdf->Cell(180,1, "Endereco ...:  ".iconv('utf-8','iso-8859-1//TRANSLIT', $db->gs['LOGRADOURO'][0]." ".$db->gs['NUMERO'][0]." ".$db->gs['COMPLEMENTO'][0] ),0,0,'L');
	 $y +=5;  	
     $pdf->SetXY(20,$y);
	 $pdf->Cell(180,1, "Bairro ........:  ".iconv('utf-8','iso-8859-1//TRANSLIT', $db->gs['BAIRRO'][0] )."       Municipio .. .:  ".iconv('utf-8','iso-8859-1//TRANSLIT', $db->gs['MUNICIPIO'][0] ),0,0,'L');
     $y +=5;   
     $pdf->SetXY(20,$y);
	 $pdf->Cell(180,1,"Estado.... .. .:  ".iconv('utf-8','iso-8859-1', $db->gs['ESTADO'][0] )."     CEP.:  ".iconv('utf-8','iso-8859-1', $db->gs['CEP'][0] ) ,0,0,'L');
	 $y +=5;  
     $pdf->SetXY(20,$y);
	 $pdf->Cell(180,1,"Celular ........:  ".iconv('utf-8','iso-8859-1', $db->gs['CELULAR'][0] )."     Telefone ...:  ".iconv('utf-8','iso-8859-1', $db->gs['TELEFONE'][0] ) ,0,0,'L');	 
	 
	 
     $db->open(" SELECT * 
				  FROM proconReclamacaoFornecedor r 
				  JOIN pessoa p 
				    ON p.codigoPessoa = r.codigoPessoa 
			LEFT  JOIN pessoaEndereco pe 
				    ON pe.codigoPessoa = p.codigoPessoa 
				 WHERE r.codigoReclamacao  = '$codigoReclamacao'  ");
	
	if($db->linhas>0){ 	
		 $y +=10;
		 $pdf->SetFont('Arial', 'U', 10);  	
		 $pdf->SetXY(20,$y);
		 $pdf->Cell(180,1, "DADOS DO(S) FORNECEDOR(ES)",0,0,'L');
			 
		foreach($db->gs['CODIGORECLAMACAO'] as $key => $value ){
			 
			 $y +=7;
			 $pdf->SetFont('Arial', '', 10);
			 $pdf->SetXY(20,$y);

			 if( $db->gs['CPF'][$key] !="" )$documento = 'CPF';
			 else $documento = "CNPJ";
			 
			 $pdf->Cell(180,1, "Documento :  ".$db->gs[$documento][$key],0,0,'L');
			 $y +=5;  
			 $pdf->SetXY(20,$y);
			 $pdf->Cell(180,1, "Nome ........ :  ".iconv('utf-8','iso-8859-1//TRANSLIT', $db->gs['NOME'][$key] ),0,0,'L');
			 $y +=5;  
			 $pdf->SetXY(20,$y);
			 $pdf->Cell(180,1, "Endereco ...:  ".iconv('utf-8','iso-8859-1//TRANSLIT', $db->gs['LOGRADOURO'][$key]." ".$db->gs['NUMERO'][$key]." ".$db->gs['COMPLEMENTO'][$key] ),0,0,'L');
			 $y +=5;  	
			 $pdf->SetXY(20,$y);
			 $pdf->Cell(180,1, "Bairro ........:  ".iconv('utf-8','iso-8859-1//TRANSLIT', $db->gs['BAIRRO'][$key] )."       Municipio .. .:  ".iconv('utf-8','iso-8859-1', $db->gs['MUNICIPIO'][$key] ),0,0,'L');
			 $y +=5;   
			 $pdf->SetXY(20,$y);
			 $pdf->Cell(180,1,"Estado.... .. .:  ".iconv('utf-8','iso-8859-1', $db->gs['ESTADO'][$key] )."     CEP.:  ".iconv('utf-8','iso-8859-1', $db->gs['CEP'][$key] ) ,0,0,'L');
			 $y +=5;  
			 $pdf->SetXY(20,$y);
			 $pdf->Cell(180,1,"Celular ........:  ".iconv('utf-8','iso-8859-1', $db->gs['CELULAR'][$key] )."     Telefone ...:  ".iconv('utf-8','iso-8859-1', $db->gs['TELEFONE'][$key] ) ,0,0,'L');	 
			
		}		
	}
	
	$pdf->SetFont('Arial', 'U', 10); 
	$y +=15;
	$pdf->SetXY(20,$y);
	$pdf->Cell(180,1, "ASSUNTO ",0,0,'L');
	
	$pdf->SetFont('Arial', '', 10); 
	$y +=5;
	$pdf->SetXY(20,$y);
	$pdf->Cell(180,1, iconv('utf-8','iso-8859-1//TRANSLIT', $assunto ),0,0,'L');
	
	$pdf->SetFont('Arial', 'U', 10); 
	$y +=15;
	$pdf->SetXY(20,$y);
	$pdf->Cell(180,1, "Relato :  ",0,0,'L');
	
	$pdf->SetFont('Arial', '', 10); 
	$y +=5;
	$pdf->SetXY(20,$y);
	$pdf->MultiCell(180,4,iconv('utf-8','iso-8859-1//TRANSLIT', $relato ),0, 'J');

	$pdf->SetFont('Arial', 'U', 10); 
	
	$pdf->SetXY($pdf->GetX(), $pdf->GetY());
	$y = $pdf->GetY();
	
	$y += 10;
	$pdf->SetXY(20,$y);
	$pdf->Cell(180,1, "Pedido :  ",0,0,'L');
	
	$pdf->SetFont('Arial', '', 10); 
	$y +=5;
	$pdf->SetXY(20,$y);
	$pdf->MultiCell(180,4,iconv('utf-8','iso-8859-1//TRANSLIT', $pedido ),0, 'J');	
	
	$pdf->SetXY($pdf->GetX(), $pdf->GetY());
	$y = $pdf->GetY();
	
	$y +=10;
	$pdf->SetXY(20,$y);		 
	$pdf->Cell(180, 8, iconv('utf-8','iso-8859-1', "Florianópolis, " ) .$hoje.".",0,0,'R');
	 

}

?>