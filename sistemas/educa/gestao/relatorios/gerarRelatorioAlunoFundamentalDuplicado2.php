<?php
require('../classes/fpdf.php');

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
        $this->SetY(-25);
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
        $w = array(40, 90 , 40, 90);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
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
            $this->Cell($w[0],6,($row[1]),'LR',0,'C',$fill);
            $this->Cell($w[1],6,($row[0]),'LR',0,'C',$fill);
            $this->Cell($w[2],6,($row[3]),'LR',0,'C',$fill);
            $this->Cell($w[3],6,($row[2]),'LR',0,'C',$fill);

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
$pdf->Cell(0, 10, utf8_decode('Educação Fundamental'),0,0,'C');
$pdf->Ln(6);
$pdf->Cell(0, 10, utf8_decode('Relatório - Homônimos com vaga e intenção'),0,0,'C');
$pdf->Ln(12);
$header = array(utf8_decode('Matrícula - Intenção'), utf8_decode('Nome - Intenção'), utf8_decode('Matrícula - Vaga'), utf8_decode('Nome - Vaga'));

include_once('../fnc/connect.php'); 
$sql = sprintf("select q.ds_nome as ds_nome_intencao, 
u.id_inscricao as id_inscricao_intencao,
i.ds_nome as ds_nome_vaga, 
y.id_inscricao as id_inscricao_vaga from
(select distinct a.ds_nome, b.id_aluno
       from matricula.pessoa_fisica a, matricula.lista_aluno b
               where a.Pessoa_id_pessoa = b.id_aluno and b.Lista_Fase_Periodo_Fase_id_ano_serie < 10) q,
(select p.ds_nome, o.Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga o, matricula.pessoa_fisica p
where o.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = p.Pessoa_id_pessoa
and o.Fase_Periodo_Fase_id_ano_serie < 10) i, matricula.aluno u, matricula.aluno y
where q.ds_nome = i.ds_nome
and q.id_aluno != i.Aluno_Pessoa_Fisica_Pessoa_id_pessoa
and q.id_aluno = u.Pessoa_Fisica_Pessoa_id_pessoa
and i.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = y.Pessoa_Fisica_Pessoa_id_pessoa
", mysql_real_escape_string('%d/%m/%Y'), mysql_real_escape_string('%d/%m/%Y'));

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
    $pdf->Cell(0, 10, utf8_decode('Não há alunos duplicados'),0,0,'C');
} else{
    $data = $datas;
    $pdf->FancyTable($header, $data);
} 
$pdf->Output();
?>