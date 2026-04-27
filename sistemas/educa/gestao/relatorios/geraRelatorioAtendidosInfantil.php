<?php
session_name('ga');
session_start();

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
        $w = array(95, 13, 13, 13, 13, 13, 13, 13);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
    // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
    // Data
        $fill = false;
        $j = 0;

        foreach($data as $row)
        {
            $this->Cell($w[0],6,utf8_decode($row[0]),'LR',0,'C',$fill);
            $this->Cell($w[1],6,utf8_decode($row[1]),'LR',0,'C',$fill);
            $this->Cell($w[2],6,utf8_decode($row[2]),'LR',0,'C',$fill);
            $this->Cell($w[3],6,utf8_decode($row[3]),'LR',0,'C',$fill);
            $this->Cell($w[4],6,utf8_decode($row[4]),'LR',0,'C',$fill);
            $this->Cell($w[5],6,utf8_decode($row[5]),'LR',0,'C',$fill);
            $this->Cell($w[6],6,utf8_decode($row[6]),'LR',0,'C',$fill);
            $this->Cell($w[7],6,($row[7]),'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
            $j++;
        }
    // Closing line
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln(6);
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0, 10, utf8_decode('Educação Infantil'),0,0,'C');
$pdf->Ln(6);
$pdf->Cell(0, 10, utf8_decode('Relatório de Atendimentos - Quantitativo'),0,0,'C');
$pdf->Ln(12);
$header = array('Unidade Escolar', 'Grupo 1', 'Grupo 2', 'Grupo 3', 'Grupo 4', 'Grupo 5', 'Grupo 6', 'Total');

include('../connect.php');

include_once '../fnc/buscaEscolasComLista.php';
$escolas = buscaEscolasComListaInfantil();
$k = 0;

$total[1] = 0;
$total[2] = 0;
$total[3] = 0;
$total[4] = 0;
$total[5] = 0;
$total[6] = 0;
$total[7] = 0;

foreach ($escolas as $key => $value) {
    $k++;
    $sql = sprintf("select count(*), a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Fase_Periodo_Fase_id_ano_serie from matricula.vaga a, matricula.escola b
where a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = b.Pessoa_Juridica_Pessoa_id_pessoa
and a.Fase_Periodo_Fase_Curso_id_curso = 2
and a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
group by a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Fase_Periodo_Fase_id_ano_serie", mysql_real_escape_string($value[0]));
    $resultado = mysql_query($sql);
    $row = true;

    unset($datas);
    $i = 0;
    while ($row != false) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $datas[$i++] = $row;
        }
    }

    unset($temp);

    if(isset($datas)){
        foreach ($datas as $key2 => $value2) {
            if($value2[2] == 10){
                $temp[1] = $value2[0];
            }

            if($value2[2] == 11){
                $temp[2] = $value2[0];
            }

            if($value2[2] == 12){
                $temp[3] = $value2[0];
            }

            if($value2[2] == 13){
                $temp[4] = $value2[0];
            }

            if($value2[2] == 14){
                $temp[5] = $value2[0];
            }

            if($value2[2] == 15){
                $temp[6] = $value2[0];
            }
        }
    }

    if(!isset($temp[1])){
        $temp[1] = 0;
    }

    if(!isset($temp[2])){
        $temp[2] = 0;
    }

    if(!isset($temp[3])){
        $temp[3] = 0;
    }

    if(!isset($temp[4])){
        $temp[4] = 0;
    }

    if(!isset($temp[5])){
        $temp[5] = 0;
    }

    if(!isset($temp[6])){
        $temp[6] = 0;
    }


    $temp[7] = array_sum($temp);

    $total[1] = $total[1] + $temp[1];
    $total[2] = $total[2] + $temp[2];
    $total[3] = $total[3] + $temp[3];
    $total[4] = $total[4] + $temp[4];
    $total[5] = $total[5] + $temp[5];
    $total[6] = $total[6] + $temp[6];
    $total[7] = $total[7] + $temp[7];
	
	$buscaEscola = buscaEscola($value[0]);
    $temp[0] = $buscaEscola[1][1];

    $datak[$k] = $temp;
}

$total[0] = 'TOTAL';
$datak[$k+1] = $total;

if(!isset($datak)){
} else{
    $data = $datak;
    $pdf->FancyTable($header, $data);
} 
$pdf->Ln(10);



$pdf->Output();
?>