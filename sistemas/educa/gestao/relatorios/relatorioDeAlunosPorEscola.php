<?php
session_name('ga');
session_start();

if($_SESSION['usuario']['id_escola'] == null){
    header("Location: ../opcoes.php");
}

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
        $w = array(10, 27, 122 , 30);
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
            $this->Cell($w[0],6,($j+1),'LR',0,'C',$fill);
            $this->Cell($w[1],6, utf8_decode($row[0]),'LR',0,'C',$fill);
            $this->Cell($w[2],6,($row[1]),'LR',0,'L',$fill);
            $this->Cell($w[3],6,($row[2]),'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
            $j++;
        }
    // Closing line
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln(6);
        $this->SetFont('Arial','',16);
        $this->Cell(150,0,'');
        $this->Cell(30,0,'Total: '.$j);
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0, 10, utf8_decode('Educação Fundamental'),0,0,'C');
$pdf->Ln(6);
$pdf->Cell(0, 10, utf8_decode('Relatório - Lista de Alunos'),0,0,'C');
$pdf->Ln(12);
$header = array('#', utf8_decode('Matrícula'), 'Nome', 'Data de Nascimento');
include_once('../fnc/connect.php'); 
$anos = array(1,2,3,4,5,6,7,8,9);

foreach ($anos as $key => $value) {
    if($value == 1){
        $temp = 'Primeiro Ano';
    } else {
        if($value == 2){
            $temp = 'Segundo Ano';
        } else {
            if($value == 3){
                $temp = 'Terceiro Ano';
            } else {
                if($value == 4){
                    $temp = 'Quarto Ano';
                } else {
                    if($value == 5){
                        $temp = 'Quinto Ano';
                    } else {
                        if($value == 6){
                            $temp = 'Sexto Ano';
                        } else {
                            if($value == 7){
                                $temp = 'Sétimo Ano';
                            } else {
                                if($value == 8){
                                    $temp = 'Oitavo Ano';
                                } else {
                                    if($value == 9){
                                        $temp = 'Nono Ano';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0, 10, utf8_decode($temp),0,0,'C');
    $pdf->Ln(10);
    $sql = sprintf("SELECT b.id_inscricao, c.ds_nome,  c.dt_nascimento FROM matricula.vaga a, matricula.aluno b, matricula.pessoa_fisica c
        where a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
        and a.Fase_Periodo_Fase_id_ano_serie = %s
        and a.Fase_Periodo_Fase_Curso_id_curso = 1
        and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa
        and c.Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa
        order by c.ds_nome", mysql_real_escape_string($_SESSION['usuario']['id_escola'])
        , mysql_real_escape_string($value));
    $resultado = mysql_query($sql);
    $row = true;
    
unset($datas);
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
        $pdf->Cell(0, 10, utf8_decode('Não há alunos neste ano para esta escola.'),0,0,'C');
    } else{
        $data = $datas;
        $pdf->FancyTable($header, $data);
    } 
    $pdf->Ln(10);
}


$pdf->Output();
?>