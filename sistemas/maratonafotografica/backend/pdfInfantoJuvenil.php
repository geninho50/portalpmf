<?php

include "db.php";
include "funcoes.php";
session_start();
$id = ($_SESSION['id']) ? $_SESSION['id'] : $_GET['id'];

if($id){
	$sql = $db->prepare("SELECT * FROM infantoJuvenil where id = $id");
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);	
	
	$data['nome']  = ( $data['nome'] );

	require_once('../../Biblioteca/FPDF/fpdf.php');

	$pdf = new FPDF();
	$pdf->SetMargins(40,40);
	
	$pdf->AddPage();
        
	$hoje = date("d/m/Y");

	$pdf->Image('http://www.pmf.sc.gov.br/sistemas/maratonafotografica/img/termodeinscricaoinfantil2025.jpg', 0, 0, 210, 300);// importa uma imagem
	
	$id = iconv('utf-8','iso-8859-1', $data['id'] );
	$pdf->SetXY(99,34);
	$pdf->SetFont('Arial','',11);   
	$pdf->Cell(180,1, $id,0,0,'C');

	$responsavelNome = iconv('utf-8','iso-8859-1', $data['responsavelNome'] );
	$pdf->SetXY(68,54);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $data['responsavelNome'],0,0,'L');
	
	$nome = iconv('utf-8','iso-8859-1', $data['nome'] );
	$pdf->SetXY(34,92);
	$pdf->SetFont('Arial','',8.5);   
	$pdf->Cell(180,1, $data['nome'],0,0,'L');

	$dataNasc = iconv('utf-8','iso-8859-1', date('d/m/Y', strtotime($data['dataNasc'])));
	$pdf->SetXY(106,92);
	$pdf->SetFont('Arial','',8);   
	$pdf->Cell(180,1, $dataNasc,0,0,'L');

	$CPF = iconv('utf-8','iso-8859-1', $data['CPF']);
	$pdf->SetXY(165,92);
	$pdf->SetFont('Arial','',8);   
	$pdf->Cell(180,1, $CPF,0,0,'c');
	
	$nacionalidade = iconv('utf-8','iso-8859-1', $data['nacionalidade'] );
	$pdf->SetXY(42,59);
	$pdf->SetFont('Arial','',8.5);   
	$pdf->Cell(180,1, $nacionalidade,0,0,'L');
	
	$responsavelProfissao = iconv('utf-8','iso-8859-1', $data['responsavelProfissao'] );
	$pdf->SetXY(81,59);
	$pdf->SetFont('Arial','',8.5);   
	$pdf->Cell(180,1, $data['responsavelProfissao'],0,0,'L');
	
	$endereco = iconv('utf-8','iso-8859-1', $data['endereco'] );
	$pdf->SetXY(32,63);
	$pdf->SetFont('Arial','',8.5);   
	$pdf->Cell(180,1, $data['endereco'],0,0,'L');
	
	$bairro = iconv('utf-8','iso-8859-1', $data['bairro'] );
	$pdf->SetXY(51,68);
	$pdf->SetFont('Arial','',8.5);   
	$pdf->Cell(180,1, $data['bairro'],0,0,'L');

	$cep = iconv('utf-8','iso-8859-1', $data['cep'] );
	$pdf->SetXY(32,68);
	$pdf->SetFont('Arial','',8.5);   
	$pdf->Cell(180,1, $cep,0,0,'C');
	
	$telefone = iconv('utf-8','iso-8859-1', $data['telefone'] );
	$pdf->SetXY(15,68);
	$pdf->SetFont('Arial','',8.5);   
	$pdf->Cell(180,1, $telefone,0,0,'R');
	
	$email = iconv('utf-8','iso-8859-1', $data['email'] );
	$pdf->SetXY(34,73);
	$pdf->SetFont('Arial','',8.8);   
	$pdf->Cell(180,1, $email,0,0,'L');
	
	$responsavelRG = iconv('utf-8','iso-8859-1', $data['responsavelRG'] );
	$pdf->SetXY(24,78);
	$pdf->SetFont('Arial','',8.5);   
	$pdf->Cell(180,1, $responsavelRG,0,0,'L');
	
	$responsavelCPF = iconv('utf-8','iso-8859-1', $data['responsavelCPF'] );
	$pdf->SetXY(95,78);
	$pdf->SetFont('Arial','',8.5);   
	$pdf->Cell(180,1, $responsavelCPF,0,0,'L');
	
	$parentesco = iconv('utf-8','iso-8859-1', $data['parentesco'] );
	$pdf->SetXY(45,87);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, $data['parentesco'],0,0,'L');
	
	$pdf->SetXY(91,258);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, date("d"),0,0,'L');	 
	
	$mes = Array("Janeiro","Fevereiro",iconv('utf-8','iso-8859-1',"Março"),"Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
	
	$pdf->SetXY(108,258);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(170,1, $mes[(date("m")-1)],0,0,'L');	

	$pdf->SetXY(132,258);
	$pdf->SetFont('Arial','',9);   
	$pdf->Cell(180,1, "2025",0,0,'L');

	$pdf->Output('termoResponsabilidade.pdf', 'I');

}else{
	header('Location: ../filmeEdigital.html');
}

die;




