<?php

include "db.php";
include "funcoes.php";
session_start();
$id = ($_SESSION['id']) ? $_SESSION['id'] : $_GET['id'];

if($id){
	$sql = $db->prepare("SELECT * FROM filmeEdigital where id = $id");
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);	
	
	$data['nome']  = ( $data['nome'] );

	require_once('../../Biblioteca/FPDF/fpdf.php');

	$pdf = new FPDF();
	$pdf->SetMargins(40,40);
	
	$pdf->AddPage();
        
	$hoje = date("d/m/Y");

	$pdf->Image('http://www.pmf.sc.gov.br/sistemas/maratonafotografica/img/termodeinscricaoadulto2025.jpg', 0, 0, 210, 297);// importa uma imagem
	
	$id = iconv('utf-8','iso-8859-1', $data['id'] );
	$pdf->SetXY(97,36);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $id,0,0,'C');

	$nome = iconv('utf-8','iso-8859-1', $data['nome'] );
	$pdf->SetXY(40,59);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $data['nome'],0,0,'L');
	
	$nacionalidade = iconv('utf-8','iso-8859-1', $data['nacionalidade'] );
	$pdf->SetXY(42,65);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $data['nacionalidade'],0,0,'L');
	
	$profissao = iconv('utf-8','iso-8859-1', $data['profissao'] );
	$pdf->SetXY(82,65);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $data['profissao'],0,0,'L');
	
	$endereco = iconv('utf-8','iso-8859-1', $data['endereco'] );
	$pdf->SetXY(40,71);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $data['endereco'],0,0,'L');
	
	$bairro = iconv('utf-8','iso-8859-1', $data['bairro'] );
	$pdf->SetXY(6,71);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $data['bairro'],0,0,'R');

	$cep = iconv('utf-8','iso-8859-1', $data['cep'] );
	$pdf->SetXY(27,77);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $cep,0,0,'L');
	
	$telefone = iconv('utf-8','iso-8859-1', $data['telefone'] );
	$pdf->SetXY(67,77);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $telefone,0,0,'L');
	
	$email = iconv('utf-8','iso-8859-1', $data['email'] );
	$pdf->SetXY(110,77);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $email,0,0,'L');
	
	$rg = iconv('utf-8','iso-8859-1', $data['rg'] );
	$pdf->SetXY(55,83);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $rg,0,0,'L');
	
	$cpf = iconv('utf-8','iso-8859-1', $data['cpf'] );
	$pdf->SetXY(125,83);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $cpf,0,0,'L');
	
	$pdf->SetXY(40,236);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, date("d"),0,0,'L');	 
	
	$mes = Array("Janeiro","Fevereiro",iconv('utf-8','iso-8859-1',"Março"),"Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
	
	$pdf->SetXY(55,236);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $mes[(date("m")-1)],0,0,'L');	

	$pdf->SetXY(82,236);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, "2024",0,0,'L');
	

	$pdf->Output('termoResponsabilidade.pdf', 'I');


}else{
	header('Location: ../filmeEdigital.html');
}

die;




