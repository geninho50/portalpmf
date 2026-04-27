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
        $this->SetFont('','B', 7);
    // Header
        $w = array(20, 70, 17, 65, 20);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
    // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
    // Data
        $fill = false;
        $i = 0;

        foreach($data as $row)
        {

            if($row[4] == 1){
                $ano = 'Primeiro Ano';
            } else {
                if($row[4] == 2){
                    $ano = 'Segundo Ano';
                } else {
                    if($row[4] == 3){
                        $ano = 'Terceiro Ano';
                    } else {
                        if($row[4] == 4){
                            $ano = 'Quarto Ano';
                        } else {
                            if($row[4] == 5){
                                $ano = 'Quinto Ano';
                            } else {
                                if($row[4] == 6){
                                    $ano = 'Sexto Ano';
                                } else {
                                    if($row[4] == 7){
                                        $ano = utf8_decode('Sétimo Ano');
                                    } else {
                                        if($row[4] == 8){
                                            $ano = 'Oitavo Ano';
                                        } else {
                                            if($row[4] == 9){
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
            unset($data);
            $data = explode('-', $row[2]);
            $data = $data[2].'/'.$data[1].'/'.$data[0];

            $this->Cell($w[0],5,($row[0]),'LR',0,'C',$fill);
            $this->Cell($w[1],5, strtoupper($row[1]),'LR',0,'L',$fill);
            $this->Cell($w[2],5,($data),'LR',0,'C',$fill);
			$buscaEscola = buscaEscola($row[3]);
            $this->Cell($w[3],5, $buscaEscola[1][1],'LR',0,'C',$fill);
            $this->Cell($w[4],5, utf8_decode($ano),'LR',0,'R',$fill);
            $this->Ln();
            $fill = !$fill;
            $i++;
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
$pdf->Cell(0, 10, utf8_decode('Educação Fundamental'),0,0,'C');
$pdf->Ln(6);
$pdf->Cell(0, 10, utf8_decode('Relatório - Alunos sem rematrícula realizada'),0,0,'C');
$pdf->Ln(6);
$pdf->Cell(0, 10, utf8_decode('Etapas: Primeiro Ano, Quinto Ano e Sexto Ano'),0,0,'C');
$pdf->Ln(12);
$header = array(utf8_decode('Matrícula'), 'Nome', 'Dt. Nasc.', 'Escola', utf8_decode('Série'));
include_once('../fnc/connect.php'); 
$sql = sprintf("select b.id_inscricao, 
    c.ds_nome, 
    c.dt_nascimento, 
    a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, 
    a.Fase_Periodo_Fase_id_ano_serie 
    from matricula.vaga a, matricula.aluno b, matricula.pessoa_fisica c
    where a.Fase_Periodo_Fase_id_ano_serie in (1, 5, 6)
    and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa
    and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = c.Pessoa_id_pessoa
    and a.id_rematricula_realizada = 0
    order by c.ds_nome
    limit 103000");
$resultado = mysql_query($sql);
$row = true; 

$i = 0;
while ($row != false) {
    $row = mysql_fetch_row($resultado);
    if ($row[0] != '') {
        $datas[$i] = $row;
    $i++;
    }
}

if(!isset($datas)){
    $pdf->SetFont('Arial','',16);
    $pdf->Cell(0, 10, utf8_decode('Não há alunos não rematriculados'),0,0,'C');
} else{
    $data = $datas;
    $pdf->FancyTable($header, $data);
    $pdf->Ln(6);
    $pdf->SetFont('Arial','',16);
    $pdf->Cell(0, 10, utf8_decode('Total: '.$i),0,0,'C');
} 
$pdf->Output();
?>