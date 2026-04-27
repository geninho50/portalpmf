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
        $w = array(30, 30);
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
            $this->Cell($w[0],6,($row[0]), 1,0,'C',$fill);
            $this->Cell($w[0],6,($row[0]), 1,0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
        }
    // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0, 10, utf8_decode('Educação Infantil'),0,0,'C');
$pdf->Ln(6);
$pdf->Cell(0, 10, utf8_decode('Relatório - Crianças em intenção'),0,0,'C');
$pdf->Ln(12);
$header = array('Grupo', 'Quantidade');
include_once('../fnc/connect.php'); 

{

        // Colors, line width and bold font
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B', 8);
    // Header
    $w = array(30, 30);
    $pdf->Cell(65);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');
    // Data
    $fill = false;

//GRUPO 1
    $sql = sprintf("select count(distinct(a.id_aluno)) from matricula.lista_aluno a
        where a.Lista_Fase_Periodo_Fase_Curso_id_curso = 2
        and a.Lista_Fase_Periodo_Fase_id_ano_serie = 10");
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

    $pdf->Cell(65);
    $pdf->Cell($w[0],6,'Grupo 1', 1,0,'C',$fill);
    $pdf->Cell($w[0],6,($datas[0][0]), 1,0,'C',$fill);
    $pdf->Ln();
    $fill = !$fill;
    unset($datas);

    //GRUPO 2
    $sql = sprintf("select count(distinct(a.id_aluno)) from matricula.lista_aluno a
        where a.Lista_Fase_Periodo_Fase_Curso_id_curso = 2
        and a.Lista_Fase_Periodo_Fase_id_ano_serie = 11");
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

    $pdf->Cell(65);
    $pdf->Cell($w[0],6,'Grupo 2', 1,0,'C',$fill);
    $pdf->Cell($w[0],6,($datas[0][0]), 1,0,'C',$fill);
    $pdf->Ln();
    $fill = !$fill;
    unset($datas);

    //GRUPO 3
    $sql = sprintf("select count(distinct(a.id_aluno)) from matricula.lista_aluno a
        where a.Lista_Fase_Periodo_Fase_Curso_id_curso = 2
        and a.Lista_Fase_Periodo_Fase_id_ano_serie = 12");
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

    $pdf->Cell(65);
    $pdf->Cell($w[0],6,'Grupo 3', 1,0,'C',$fill);
    $pdf->Cell($w[0],6,($datas[0][0]), 1,0,'C',$fill);
    $pdf->Ln();
    $fill = !$fill;
    unset($datas);

    //GRUPO 4
    $sql = sprintf("select count(distinct(a.id_aluno)) from matricula.lista_aluno a
        where a.Lista_Fase_Periodo_Fase_Curso_id_curso = 2
        and a.Lista_Fase_Periodo_Fase_id_ano_serie = 13");
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

    $pdf->Cell(65);
    $pdf->Cell($w[0],6,'Grupo 4', 1,0,'C',$fill);
    $pdf->Cell($w[0],6,($datas[0][0]), 1,0,'C',$fill);
    $pdf->Ln();
    $fill = !$fill;
    unset($datas);

    //GRUPO 5
    $sql = sprintf("select count(distinct(a.id_aluno)) from matricula.lista_aluno a
        where a.Lista_Fase_Periodo_Fase_Curso_id_curso = 2
        and a.Lista_Fase_Periodo_Fase_id_ano_serie = 14");
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

    $pdf->Cell(65);
    $pdf->Cell($w[0],6,'Grupo 5', 1,0,'C',$fill);
    $pdf->Cell($w[0],6,($datas[0][0]), 1,0,'C',$fill);
    $pdf->Ln();
    $fill = !$fill;
    unset($datas);

    //GRUPO 6
    $sql = sprintf("select count(distinct(a.id_aluno)) from matricula.lista_aluno a
        where a.Lista_Fase_Periodo_Fase_Curso_id_curso = 2
        and a.Lista_Fase_Periodo_Fase_id_ano_serie = 15");
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

    $pdf->Cell(65);
    $pdf->Cell($w[0],6,'Grupo 6', 1,0,'C',$fill);
    $pdf->Cell($w[0],6,($datas[0][0]), 1,0,'C',$fill);
    $pdf->Ln();
    $fill = !$fill;
    unset($datas);

    $sql = sprintf("select count(distinct(a.id_aluno)) from matricula.lista_aluno a
        where a.Lista_Fase_Periodo_Fase_Curso_id_curso = 2;");
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

    $pdf->Cell(65);
    $pdf->Cell($w[0],6,'Total', 1,0,'C',$fill);
    $pdf->Cell($w[0],6,($datas[0][0]), 1,0,'C',$fill);
    $pdf->Ln();
    $fill = !$fill;
    unset($datas);

    // Closing line
    $pdf->Cell(65);
    $pdf->Cell(array_sum($w),0,'','T');

} 
$pdf->Output();
?>