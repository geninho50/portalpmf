<?php
header("Content-Type: text/html; charset=utf8",true);
require('../classes/fpdf2.php');

include '../fnc/buscaEscola.php';
	
class PDF extends FPDF
{
	

    function Header()
    {
    // Logo 1
        $this->Image('../img/logosystem.jpg',10,6,60);
    // Logo 2
        $this->Image('../img/logo_sigeduca.jpg',145,6,50);
    // Line break
        $this->Ln(15);
    }

// Page footer
    function Footer()
    {
    // Position at 1.5 cm from bottom
        $this->SetY(-22);
    // Arial italic 8
        $this->SetFont('Arial','I',8);
    // Page number

        date_default_timezone_set('America/Sao_Paulo');
        $this->Cell(0,10, utf8_decode('Página '.$this->PageNo().'/{nb}'),0,0,'C');
        $this->Ln(6);
        $texto = ("Data: ").date('d/m/Y') . (" - Hora: ").date('H:i:s TO');
        $this->Cell(0, 10, utf8_decode($texto),0,0,'C');
        $this->Ln(6);
        $hash = hash('sha256', $_SERVER['REQUEST_TIME_FLOAT'], false); 
        $this->Cell(0, 10, utf8_decode($hash),0,0,'C');
    }

    function FancyTable($header, $data)
    {
    // Colors, line width and bold font
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B', 8);
    // Header
        $this->Cell(10);
        $w = array(70, 100,100);// tamanho coluna
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],8,$header[$i],1,0,'C',true);
        $this->Ln();
    // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
    // Data
        $fill = false;
        $i = 1;

        foreach($data as $row)
        {

            $this->Cell(10);
            $this->Cell($w[0],6,($row[0]),'LR',0,'C',$fill);
            $this->Cell($w[1],6,($row[1]),'LR',0,'C',$fill);
			$this->Cell($w[2],6,(utf8_decode($row[2])),'LR',0,'C',$fill);

			


            $this->Ln();
            $fill = !$fill;
        }
    // Closing line
        $this->Cell(10);
        $this->Cell(array_sum($w),0,'','T');
    }
}

// Instanciation of inherited class
$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0, 10, utf8_decode('Educação Infantil'),0,0,'C');
$pdf->Ln(6);
$pdf->Cell(0, 10, utf8_decode('Relatório - Crianças desistentes(intenção)'),0,0,'C');
$pdf->Ln(12);
$header = array(utf8_decode('Matrícula'),utf8_decode('Nome'),utf8_decode('Motivo'));

include('../connect.php');



$sql = sprintf("select b.id_inscricao, c.ds_nome,
 CASE 
WHEN a.id_motivo = 1  THEN 'Aluno já Matriculado na Rede.'
WHEN a.id_motivo = 2 THEN 'Após 2 tentativas não foi possível contatar o aluno ou a família.'
WHEN a.id_motivo = 3 THEN 'Aluno/Família requisitou a desistência na unidade.'
WHEN a.id_motivo = 4 THEN 'Erro de cadastro.'
WHEN a.id_motivo = 5 THEN 'Mudança de Endereço.'
WHEN a.id_motivo = 6 THEN 'Não compareceu por 5 dias consecutivos ou alternados durante o mês.'
 end
 from matricula.auditoria_intencao_infantil_remover a
inner join matricula.aluno b on a.id_aluno = b.Pessoa_Fisica_Pessoa_id_pessoa
inner join matricula.pessoa_fisica c on c.Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa;");

$resultado = mysql_query($sql);
$row = true; 

$i = 0;
while ($row != false) {
    $row = mysql_fetch_row($resultado);
    if ($row[0] != '') {
        $datas[$i] = $row;
    }
    $i++;
}

if(!isset($datas)){
    $pdf->SetFont('Arial','',16);
    $pdf->Cell(0, 10, utf8_decode('Não há histórico de crianças desistentes(intenção)'),0,0,'C');
} else{
    $data = $datas;
	
    $pdf->FancyTable($header, $data);
} 
$pdf->Output();
?>