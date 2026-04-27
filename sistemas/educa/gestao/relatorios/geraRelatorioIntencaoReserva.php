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
        $this->Ln();
        $texto = ("Data: ").date('d/m/Y') . (" - Hora: ").date('H:i:s TO');
        $this->Cell(0, 10, utf8_decode($texto),0,0,'C');
        $this->Ln();
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
        $this->SetFont('','B', 6);
        $header2[0] = '';
        $header2[1] = '1 Ano';
        $header2[2] = '2 Ano';
        $header2[3] = '3 Ano';
        $header2[4] = '4 Ano';
        $header2[5] = '5 Ano';
        $header2[6] = '6 Ano';
        $header2[7] = '7 Ano';
        $header2[8] = '8 Ano';
        $header2[9] = '9 Ano';
        $header2[10] = 'Total';
    // Header
        $w = array(50, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7);
        for($i=0;$i<count($header2);$i++){
            if($i == 0){
                $this->Cell($w[$i],7,$header2[$i],1,0,'C',true);
            } else {
                $this->Cell(2*$w[$i],7,$header2[$i],1,0,'C',true);
            }
        }
        $this->Ln();
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

        foreach($data[0] as $key => $row)
        {
            $this->Cell($w[0],6,utf8_decode($row[0]),'LR',0,'C',$fill);
            $this->Cell($w[1],6,utf8_decode($row[1]),'LR',0,'C',$fill);
            $this->Cell($w[1],6,utf8_decode($data[1][$key][1]),'LR',0,'C',$fill);
            $this->Cell($w[2],6,utf8_decode($row[2]),'LR',0,'C',$fill);
            $this->Cell($w[2],6,utf8_decode($data[1][$key][2]),'LR',0,'C',$fill);
            $this->Cell($w[3],6,utf8_decode($row[3]),'LR',0,'C',$fill);
            $this->Cell($w[3],6,utf8_decode($data[1][$key][3]),'LR',0,'C',$fill);
            $this->Cell($w[4],6,utf8_decode($row[4]),'LR',0,'C',$fill);
            $this->Cell($w[4],6,utf8_decode($data[1][$key][4]),'LR',0,'C',$fill);
            $this->Cell($w[5],6,utf8_decode($row[5]),'LR',0,'C',$fill);
            $this->Cell($w[5],6,utf8_decode($data[1][$key][5]),'LR',0,'C',$fill);
            $this->Cell($w[6],6,utf8_decode($row[6]),'LR',0,'C',$fill);
            $this->Cell($w[6],6,utf8_decode($data[1][$key][6]),'LR',0,'C',$fill);
            $this->Cell($w[7],6,utf8_decode($row[7]),'LR',0,'C',$fill);
            $this->Cell($w[7],6,utf8_decode($data[1][$key][7]),'LR',0,'C',$fill);
            $this->Cell($w[8],6,utf8_decode($row[8]),'LR',0,'C',$fill);
            $this->Cell($w[8],6,utf8_decode($data[1][$key][8]),'LR',0,'C',$fill);
            $this->Cell($w[9],6,utf8_decode($row[9]),'LR',0,'C',$fill);
            $this->Cell($w[9],6,utf8_decode($data[1][$key][9]),'LR',0,'C',$fill);
            $this->Cell($w[10],6,($row[10]),'LR',0,'C',$fill);
            $this->Cell($w[10],6,($data[1][$key][10]),'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
            $j++;
        }
    // Closing line
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln();
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0, 10, utf8_decode('Educação Fundamental'),0,0,'C');
$pdf->Ln(6);
$pdf->Cell(0, 10, utf8_decode('Relatório de Intenções - Quantitativo '),0,0,'C');
$pdf->Ln(8);
$header = array('Unidade Escolar', 'I', 'R', 'I', 'R', 'I', 'R', 'I', 'R', 'I', 'R', 'I', 'R', 'I', 'R', 'I', 'R', 'I', 'R', 'I', 'R',);
include_once('../fnc/connect.php'); 

include_once '../fnc/buscaEscolas.php';
$escolas = buscaEscolasFundamental();
$k = 0;

$total[1] = 0;
$total[2] = 0;
$total[3] = 0;
$total[4] = 0;
$total[5] = 0;
$total[6] = 0;
$total[7] = 0;
$total[8] = 0;
$total[9] = 0;
$total[10] = 0;
$total2[1] = 0;
$total2[2] = 0;
$total2[3] = 0;
$total2[4] = 0;
$total2[5] = 0;
$total2[6] = 0;
$total2[7] = 0;
$total2[8] = 0;
$total2[9] = 0;
$total2[10] = 0;

foreach ($escolas as $key => $value) {
    $k++;
    $sql = sprintf("select count(*), Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Lista_Fase_Periodo_Fase_id_ano_serie from matricula.lista_aluno a, matricula.escola b
        where a.Lista_Fase_Periodo_Fase_Curso_id_curso = 1
        and a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = b.Pessoa_Juridica_Pessoa_id_pessoa
        and a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
        group by Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Lista_Fase_Periodo_Fase_id_ano_serie
        order by b.ds_nome, Lista_Fase_Periodo_Fase_id_ano_serie", mysql_real_escape_string($value[0]));
    $resultado = mysql_query($sql);
    $row = true;

    $sql2 = sprintf("select count(*), a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Fase_Periodo_Fase_id_ano_serie from matricula.vaga a, matricula.escola b
        where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa is null
        and a.Fase_Periodo_Fase_Curso_id_curso = 1
        and a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
        and a.Tipo_Vaga_id_tipo_vaga = 3
        and a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = b.Pessoa_Juridica_Pessoa_id_pessoa
        group by a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Fase_Periodo_Fase_id_ano_serie
        order by b.ds_nome, a.Fase_Periodo_Fase_id_ano_serie", mysql_real_escape_string($value[0]));
    $resultado2 = mysql_query($sql2);

    unset($datas);
    $i = 0;
    while ($row != false) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $datas[$i++] = $row;
        }
    }

    $row = true;
    unset($datar);
    $i = 0;
    while ($row != false) {
        $row = mysql_fetch_row($resultado2);
        if ($row[0] != '') {
            $datar[$i++] = $row;
        }
    }

    unset($temp);

    if(isset($datas)){
        foreach ($datas as $key2 => $value2) {
            if($value2[2] == 1){
                $temp[1] = $value2[0];
            }

            if($value2[2] == 2){
                $temp[2] = $value2[0];
            }

            if($value2[2] == 3){
                $temp[3] = $value2[0];
            }

            if($value2[2] == 4){
                $temp[4] = $value2[0];
            }

            if($value2[2] == 5){
                $temp[5] = $value2[0];
            }

            if($value2[2] == 6){
                $temp[6] = $value2[0];
            }

            if($value2[2] == 7){
                $temp[7] = $value2[0];
            }

            if($value2[2] == 8){
                $temp[8] = $value2[0];
            }

            if($value2[2] == 9){
                $temp[9] = $value2[0];
            }
        }
    }

    unset($temp2);

    if(isset($datar)){
        foreach ($datar as $key2 => $value3) {
            if($value3[2] == 1){
                $temp2[1] = $value3[0];
            }

            if($value3[2] == 2){
                $temp2[2] = $value3[0];
            }

            if($value3[2] == 3){
                $temp2[3] = $value3[0];
            }

            if($value3[2] == 4){
                $temp2[4] = $value3[0];
            }

            if($value3[2] == 5){
                $temp2[5] = $value3[0];
            }

            if($value3[2] == 6){
                $temp2[6] = $value3[0];
            }

            if($value3[2] == 7){
                $temp2[7] = $value3[0];
            }

            if($value3[2] == 8){
                $temp2[8] = $value3[0];
            }

            if($value3[2] == 9){
                $temp2[9] = $value3[0];
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

    if(!isset($temp[7])){
        $temp[7] = 0;
    }

    if(!isset($temp[8])){
        $temp[8] = 0;
    }

    if(!isset($temp[9])){
        $temp[9] = 0;
    }


    if(!isset($temp2[1])){
        $temp2[1] = 0;
    }

    if(!isset($temp2[2])){
        $temp2[2] = 0;
    }

    if(!isset($temp2[3])){
        $temp2[3] = 0;
    }

    if(!isset($temp2[4])){
        $temp2[4] = 0;
    }

    if(!isset($temp2[5])){
        $temp2[5] = 0;
    }

    if(!isset($temp2[6])){
        $temp2[6] = 0;
    }

    if(!isset($temp2[7])){
        $temp2[7] = 0;
    }

    if(!isset($temp2[8])){
        $temp2[8] = 0;
    }

    if(!isset($temp2[9])){
        $temp2[9] = 0;
    }

    $temp[10] = array_sum($temp);

    $temp2[10] = array_sum($temp2);

    $total[1] = $total[1] + $temp[1];
    $total[2] = $total[2] + $temp[2];
    $total[3] = $total[3] + $temp[3];
    $total[4] = $total[4] + $temp[4];
    $total[5] = $total[5] + $temp[5];
    $total[6] = $total[6] + $temp[6];
    $total[7] = $total[7] + $temp[7];
    $total[8] = $total[8] + $temp[8];
    $total[9] = $total[9] + $temp[9];
    $total[10] = $total[10] + $temp[10];
	
	$buscaEscola = buscaEscola($value[0]);
	
    $temp[0] = $buscaEscola[1][1];

    $total2[1] = $total2[1] + $temp2[1];
    $total2[2] = $total2[2] + $temp2[2];
    $total2[3] = $total2[3] + $temp2[3];
    $total2[4] = $total2[4] + $temp2[4];
    $total2[5] = $total2[5] + $temp2[5];
    $total2[6] = $total2[6] + $temp2[6];
    $total2[7] = $total2[7] + $temp2[7];
    $total2[8] = $total2[8] + $temp2[8];
    $total2[9] = $total2[9] + $temp2[9];
    $total2[10] = $total2[10] + $temp2[10];

	$buscaEscola = buscaEscola($value[0]);	
    $temp2[0] = $buscaEscola[1][1];

    $datak[$k] = $temp;

    $datak2[$k] = $temp2;
}

$total[0] = 'TOTAL';
$total2[0] = 'TOTAL';
$datak[$k+1] = $total;
$datak2[$k+1] = $total2;

if(!isset($datas)){
} else{
    $data[0] = $datak;
    $data[1] = $datak2;
    $pdf->FancyTable($header, $data);
} 
$pdf->Ln(10);



$pdf->Output();
?>