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
        $this->Cell(19);
    // Colors, line width and bold font
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B', 8);
    // Header
        $w = array(20, 32, 32, 32, 32);
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
        $totalNovo = 0;
        $totalRematricula = 0;
        $totalReserva = 0;
        $totalTotal = 0;
        foreach($data as $row)
        {
            if($row[3] == 1){
                $novoAluno[$row[2]] = $row[0];
            }
            if($row[3] == 2){
                $rematricula[$row[2]] = $row[0];
            }
            if($row[3] == 3){
                $reserva[$row[2]] = $row[0];
            }
            if($row[3] == 4){
                $total[$row[2]] = $row[0];
            }
        }

        $anos = array(1,2,3,4,5,6,7,8,9);

        foreach($anos as $key => $value)
        {


            if($value == 1){
                $ano = 'Primeiro Ano';
            } else {
                if($value == 2){
                    $ano = 'Segundo Ano';
                } else {
                    if($value == 3){
                        $ano = 'Terceiro Ano';
                    } else {
                        if($value == 4){
                            $ano = 'Quarto Ano';
                        } else {
                            if($value == 5){
                                $ano = 'Quinto Ano';
                            } else {
                                if($value == 6){
                                    $ano = 'Sexto Ano';
                                } else {
                                    if($value == 7){
                                        $ano = utf8_decode('Sétimo Ano');
                                    } else {
                                        if($value == 8){
                                            $ano = 'Oitavo Ano';
                                        } else {
                                            if($value == 9){
                                                $ano = 'Nono Ano';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }   
            }

            if(!isset($novoAluno[$value])){
                $novoAluno[$value] = 0;
            }
            if(!isset($rematricula[$value])){
                $rematricula[$value] = 0;
            }
            if(!isset($reserva[$value])){
                $reserva[$value] = 0;
            }
            if(!isset($total[$value])){
                $total[$value] = 0;
            }
            $this->Cell(19);
            $this->Cell($w[0],6, $ano,'LR',0,'C',$fill);
            $this->Cell($w[1],6,$novoAluno[$value],'LR',0,'C',$fill);
            $this->Cell($w[2],6,$rematricula[$value],'LR',0,'C',$fill);
            $this->Cell($w[2],6,$reserva[$value],'LR',0,'C',$fill);
            $this->Cell($w[3],6,$total[$value],'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
            $totalNovo = $totalNovo + $novoAluno[$value];
            $totalRematricula = $totalRematricula + $rematricula[$value];
            $totalReserva = $totalReserva + $reserva[$value];
            $totalTotal = $totalTotal + $total[$value];
        }

        $this->Cell(19);
        $this->Cell($w[0],6, 'TOTAL','LR',0,'C',$fill);
        $this->Cell($w[1],6,$totalNovo.' ('.((int)($totalNovo/$totalTotal*100)).'%)','LR',0,'C',$fill);
        $this->Cell($w[2],6,$totalRematricula.' ('.((int)($totalRematricula/$totalTotal*100)).'%)','LR',0,'C',$fill);
        $this->Cell($w[2],6,$totalReserva.' ('.((int)($totalReserva/$totalTotal*100)).'%)','LR',0,'C',$fill);
        $this->Cell($w[3],6,$totalTotal,'LR',0,'C',$fill);
        $this->Ln();
        $fill = !$fill;

    // Closing line
        $this->Cell(19);
        $this->Cell(array_sum($w),0,'','T');
    }

    function FancyTable2($header, $data)
    {
        $this->Cell(19);
    // Colors, line width and bold font
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B', 8);
    // Header
        $w = array(20, 32, 32, 32, 32);
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
        $totalNovo = 0;
        $totalRematricula = 0;
        $totalReserva = 0;
        $totalTotal = 0;
        foreach($data as $row)
        {
            if($row[2] == 1){
                $novoAluno[$row[1]] = $row[0];
            }
            if($row[2] == 2){
                $rematricula[$row[1]] = $row[0];
            }
            if($row[2] == 3){
                $reserva[$row[1]] = $row[0];
            }
            if($row[2] == 4){
                $total[$row[1]] = $row[0];
            }
        }

        $anos = array(1,2,3,4,5,6,7,8,9);

        foreach($anos as $key => $value)
        {


            if($value == 1){
                $ano = 'Primeiro Ano';
            } else {
                if($value == 2){
                    $ano = 'Segundo Ano';
                } else {
                    if($value == 3){
                        $ano = 'Terceiro Ano';
                    } else {
                        if($value == 4){
                            $ano = 'Quarto Ano';
                        } else {
                            if($value == 5){
                                $ano = 'Quinto Ano';
                            } else {
                                if($value == 6){
                                    $ano = 'Sexto Ano';
                                } else {
                                    if($value == 7){
                                        $ano = utf8_decode('Sétimo Ano');
                                    } else {
                                        if($value == 8){
                                            $ano = 'Oitavo Ano';
                                        } else {
                                            if($value == 9){
                                                $ano = 'Nono Ano';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }   
            }

            if(!isset($novoAluno[$value])){
                $novoAluno[$value] = 0;
            }
            if(!isset($rematricula[$value])){
                $rematricula[$value] = 0;
            }
            if(!isset($reserva[$value])){
                $reserva[$value] = 0;
            }
            if(!isset($total[$value])){
                $total[$value] = 0;
            }
            $this->Cell(19);
            $this->Cell($w[0],6, $ano,'LR',0,'C',$fill);
            if($total[$value]){
                $this->Cell($w[1],6,$novoAluno[$value].' ('.((int)($novoAluno[$value]/$total[$value]*100)).'%)','LR',0,'C',$fill);
            } else {
                $this->Cell($w[1],6,$novoAluno[$value],'LR',0,'C',$fill);
            }
            if($total[$value]){
                $this->Cell($w[2],6,$rematricula[$value].' ('.((int)($rematricula[$value]/$total[$value]*100)).'%)','LR',0,'C',$fill);
            } else {
                $this->Cell($w[1],6,$rematricula[$value],'LR',0,'C',$fill);
            }
            if($total[$value]){
                $this->Cell($w[2],6,$reserva[$value].' ('.((int)($reserva[$value]/$total[$value]*100)).'%)','LR',0,'C',$fill);
            } else {
                $this->Cell($w[1],6,$reserva[$value],'LR',0,'C',$fill);
            }
            $this->Cell($w[3],6,$total[$value],'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
            $totalNovo = $totalNovo + $novoAluno[$value];
            $totalRematricula = $totalRematricula + $rematricula[$value];
            $totalReserva = $totalReserva + $totalReserva[$value];
            $totalTotal = $totalTotal + $total[$value];
        }

        $this->Cell(19);
        $this->Cell($w[0],6, 'TOTAL','LR',0,'C',$fill);
        $this->Cell($w[1],6,$totalNovo.' ('.((int)($totalNovo/$totalTotal*100)).'%)','LR',0,'C',$fill);
        $this->Cell($w[2],6,$totalRematricula.' ('.((int)($totalRematricula/$totalTotal*100)).'%)','LR',0,'C',$fill);
        $this->Cell($w[2],6,$totalReserva.' ('.((int)($totalReserva/$totalTotal*100)).'%)','LR',0,'C',$fill);
        $this->Cell($w[3],6,$totalTotal,'LR',0,'C',$fill);
        $this->Ln();
        $fill = !$fill;
        
    // Closing line
        $this->Cell(19);
        $this->Cell(array_sum($w),0,'','T');
    }
}


session_name('ga');
session_start();

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$pdf->Cell(0, 10, utf8_decode('Educação Fundamental'),0,0,'C');
$pdf->Ln(6);
$pdf->Cell(0, 10, utf8_decode('Quadro de Vagas'),0,0,'C');
$pdf->Ln(12);

include_once '../fnc/buscaVagasEscolaFundamental.php';
include_once '../fnc/buscaEscola.php';

$header[0] = utf8_decode('Etapa');
$header[1] = utf8_decode('Vagas de Novo Aluno');
$header[2] = utf8_decode('Vagas de Rematricula');
$header[3] = utf8_decode('Vagas de Reserva');
$header[4] = utf8_decode('Total de Vagas');

include_once '../fnc/buscaEscolasNoQuadro.php';
$escolas = buscaEscolasNoQuadro(1);

$qwe = 1;

foreach ($escolas as $key => $value) {
    $qtVagas = buscaVagasEscolaFundamental($value[0]);

    $escola = buscaEscola($value[0]);

    if(($_SESSION['usuario']['id_escola'] == $value[0]) or ($_SESSION['usuario']['id_escola'] == null)){
        if($qtVagas != false){

            $pdf->SetFont('Arial','',12);
            $pdf->Cell(190, 6, iconv('utf-8','iso-8859-1',$escola[1][1]), 0,0,'C', false);
            $pdf->Ln(8);

            $pdf->FancyTable($header, $qtVagas);
            $pdf->Ln(6);

        }

        $qwe++;
    }
}

if(($_SESSION['usuario']['id_escola'] == $value[0]) or ($_SESSION['usuario']['id_escola'] == null)){
    $qtVagas = buscaVagasEscolaFundamentalTudo($value[0]);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(190, 6, iconv('utf-8','iso-8859-1',"Total"), 0,0,'C', false);
    $pdf->Ln(8);

    $pdf->FancyTable2($header, $qtVagas);
    $pdf->Ln(6);
}

$pdf->Output();
?>