<?php
require('../classes/fpdf.php');

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
        $w = array(12, 25, 100, 20, 40, 25, 25, 25);
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
        include_once '../fnc/buscaTel.php';
        foreach($data as $row)
        {
            unset($tel);
            unset($cel);
            unset($com);
            unset($resi);
            $tel = buscaTel($row[0]);

            if($tel != false){
                foreach ($tel as $key => $value) {
                    if ($value[5] == 1) {
                        $cel = '('.$value[3].')'.$value[4];
                    } else {
                        if ($value[5] == 2) {
                            $resi = '('.$value[3].')'.$value[4];
                        } else {       
                            if ($value[5] == 1) {
                                $com = '('.$value[3].')'.$value[4];
                            }
                        }
                    }
                }
            }

            if(!isset($resi)){
                $resi = '';
            }
            if(!isset($cel)){
                $cel = '';
            }
            if(!isset($com)){
                $com = '';
            }

            $this->Cell($w[0], 6, $i++,'LR',0,'C',$fill);
            $this->Cell($w[1], 6,$row[1],'LR',0,'C',$fill);
            $this->Cell($w[2], 6,($row[3]),'LR',0,'L',$fill);
            $this->Cell($w[3], 6, $row[4],'LR',0,'C',$fill);
            $this->Cell($w[4], 6, utf8_decode($row[5]),'LR',0,'C',$fill);
            $this->Cell($w[5], 6, $resi,'LR',0,'C',$fill);
            $this->Cell($w[6], 6, $cel,'LR',0,'C',$fill);
            $this->Cell($w[7], 6, $com,'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
        }
    // Closing line
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
$pdf->Cell(0, 10, utf8_decode('Classificação - Lista de Intenção'),0,0,'C');
$pdf->Ln(12);

set_time_limit(300);

include_once '../fnc/buscaClassificacaoListaIntencaoFundamental.php';
include_once '../fnc/buscaEscola.php';
include_once '../fnc/buscaFases.php';


$fases = buscaFases(1);
$escola = buscaEscola($_GET['idEscola']);

$pdf->SetFont('Arial','',12);
$pdf->Cell(0, 10, utf8_decode($escola[1][1]),0,0,'C');
    $pdf->Ln(10);

$tipoClass = 'FUNDAMENTAL - 2013';

if($_GET['idEscola'] == 1422){
    $tipoClass = 'BATISTA PEREIRA';
}

$classificacao = buscaClassificacaoListaIntencaoFundamental($tipoClass, $_GET['idEscola'], 1);

if($classificacao != false){


    $header[0] = utf8_decode('Posição');
    $header[1] = utf8_decode('# Matrícula');
    $header[2] = utf8_decode('Nome');
    $header[3] = utf8_decode('Dt. Nasc.');
    $header[4] = utf8_decode('Bairro');
    $header[5] = utf8_decode('Tel. Residencial');
    $header[6] = utf8_decode('Tel. Celular');
    $header[7] = utf8_decode('Tel. Comercial');


    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0, 10, utf8_decode($fases[1][1]),0,0,'C');
    $pdf->Ln(12);

    $pdf->FancyTable($header, $classificacao);
    $pdf->Ln(6);

}

$classificacao = buscaClassificacaoListaIntencaoFundamental($tipoClass, $_GET['idEscola'], 2);

if($classificacao != false){


    $header[0] = utf8_decode('Posição');
    $header[1] = utf8_decode('# Matrícula');
    $header[2] = utf8_decode('Nome');
    $header[3] = utf8_decode('Dt. Nasc.');
    $header[4] = utf8_decode('Bairro');
    $header[5] = utf8_decode('Tel. Residencial');
    $header[6] = utf8_decode('Tel. Celular');
    $header[7] = utf8_decode('Tel. Comercial');

    $escola = buscaEscola($_GET['idEscola']);
    $fases = buscaFases(1);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0, 10, utf8_decode($fases[2][1]),0,0,'C');
    $pdf->Ln(12);

    $pdf->FancyTable($header, $classificacao);
    $pdf->Ln(6);

}

$classificacao = buscaClassificacaoListaIntencaoFundamental($tipoClass, $_GET['idEscola'], 3);

if($classificacao != false){


    $header[0] = utf8_decode('Posição');
    $header[1] = utf8_decode('# Matrícula');
    $header[2] = utf8_decode('Nome');
    $header[3] = utf8_decode('Dt. Nasc.');
    $header[4] = utf8_decode('Bairro');
    $header[5] = utf8_decode('Tel. Residencial');
    $header[6] = utf8_decode('Tel. Celular');
    $header[7] = utf8_decode('Tel. Comercial');

    $escola = buscaEscola($_GET['idEscola']);
    $fases = buscaFases(1);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0, 10, utf8_decode($fases[3][1]),0,0,'C');
    $pdf->Ln(12);

    $pdf->FancyTable($header, $classificacao);
    $pdf->Ln(6);

}

$classificacao = buscaClassificacaoListaIntencaoFundamental($tipoClass, $_GET['idEscola'], 4);

if($classificacao != false){


    $header[0] = utf8_decode('Posição');
    $header[1] = utf8_decode('# Matrícula');
    $header[2] = utf8_decode('Nome');
    $header[3] = utf8_decode('Dt. Nasc.');
    $header[4] = utf8_decode('Bairro');
    $header[5] = utf8_decode('Tel. Residencial');
    $header[6] = utf8_decode('Tel. Celular');
    $header[7] = utf8_decode('Tel. Comercial');

    $escola = buscaEscola($_GET['idEscola']);
    $fases = buscaFases(1);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0, 10, utf8_decode($fases[4][1]),0,0,'C');
    $pdf->Ln(12);

    $pdf->FancyTable($header, $classificacao);
    $pdf->Ln(6);

}

$classificacao = buscaClassificacaoListaIntencaoFundamental($tipoClass, $_GET['idEscola'], 5);

if($classificacao != false){


    $header[0] = utf8_decode('Posição');
    $header[1] = utf8_decode('# Matrícula');
    $header[2] = utf8_decode('Nome');
    $header[3] = utf8_decode('Dt. Nasc.');
    $header[4] = utf8_decode('Bairro');
    $header[5] = utf8_decode('Tel. Residencial');
    $header[6] = utf8_decode('Tel. Celular');
    $header[7] = utf8_decode('Tel. Comercial');

    $escola = buscaEscola($_GET['idEscola']);
    $fases = buscaFases(1);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0, 10, utf8_decode($fases[5][1]),0,0,'C');
    $pdf->Ln(12);

    $pdf->FancyTable($header, $classificacao);
    $pdf->Ln(6);

}

$classificacao = buscaClassificacaoListaIntencaoFundamental($tipoClass, $_GET['idEscola'], 6);

if($classificacao != false){


    $header[0] = utf8_decode('Posição');
    $header[1] = utf8_decode('# Matrícula');
    $header[2] = utf8_decode('Nome');
    $header[3] = utf8_decode('Dt. Nasc.');
    $header[4] = utf8_decode('Bairro');
    $header[5] = utf8_decode('Tel. Residencial');
    $header[6] = utf8_decode('Tel. Celular');
    $header[7] = utf8_decode('Tel. Comercial');

    $escola = buscaEscola($_GET['idEscola']);
    $fases = buscaFases(1);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0, 10, utf8_decode($fases[6][1]),0,0,'C');
    $pdf->Ln(12);

    $pdf->FancyTable($header, $classificacao);
    $pdf->Ln(6);

}

$classificacao = buscaClassificacaoListaIntencaoFundamental($tipoClass, $_GET['idEscola'], 7);

if($classificacao != false){


    $header[0] = utf8_decode('Posição');
    $header[1] = utf8_decode('# Matrícula');
    $header[2] = utf8_decode('Nome');
    $header[3] = utf8_decode('Dt. Nasc.');
    $header[4] = utf8_decode('Bairro');
    $header[5] = utf8_decode('Tel. Residencial');
    $header[6] = utf8_decode('Tel. Celular');
    $header[7] = utf8_decode('Tel. Comercial');

    $escola = buscaEscola($_GET['idEscola']);
    $fases = buscaFases(1);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell('Sétimo Ano');
    $pdf->Ln(6);
    $pdf->Cell(0, 10, utf8_decode($fases[7][1]),0,0,'C');
    $pdf->Ln(12);

    $pdf->FancyTable($header, $classificacao);
    $pdf->Ln(6);

}

$classificacao = buscaClassificacaoListaIntencaoFundamental($tipoClass, $_GET['idEscola'], 8);

if($classificacao != false){


    $header[0] = utf8_decode('Posição');
    $header[1] = utf8_decode('# Matrícula');
    $header[2] = utf8_decode('Nome');
    $header[3] = utf8_decode('Dt. Nasc.');
    $header[4] = utf8_decode('Bairro');
    $header[5] = utf8_decode('Tel. Residencial');
    $header[6] = utf8_decode('Tel. Celular');
    $header[7] = utf8_decode('Tel. Comercial');

    $escola = buscaEscola($_GET['idEscola']);
    $fases = buscaFases(1);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell('Oitavo Ano');
    $pdf->Ln(6);
    $pdf->Cell(0, 10, utf8_decode($fases[8][1]),0,0,'C');
    $pdf->Ln(12);

    $pdf->FancyTable($header, $classificacao);
    $pdf->Ln(6);

}

$classificacao = buscaClassificacaoListaIntencaoFundamental($tipoClass, $_GET['idEscola'], 9);

if($classificacao != false){


    $header[0] = utf8_decode('Posição');
    $header[1] = utf8_decode('# Matrícula');
    $header[2] = utf8_decode('Nome');
    $header[3] = utf8_decode('Dt. Nasc.');
    $header[4] = utf8_decode('Bairro');
    $header[5] = utf8_decode('Tel. Residencial');
    $header[6] = utf8_decode('Tel. Celular');
    $header[7] = utf8_decode('Tel. Comercial');

    $escola = buscaEscola($_GET['idEscola']);
    $fases = buscaFases(1);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell('Nono Ano');
    $pdf->Ln(6);
    $pdf->Cell(0, 10, utf8_decode($fases[9][1]),0,0,'C');
    $pdf->Ln(12);

    $pdf->FancyTable($header, $classificacao);
    $pdf->Ln(6);

}



$pdf->Output();
?>