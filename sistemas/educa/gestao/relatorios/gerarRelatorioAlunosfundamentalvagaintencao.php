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
        $w = array(25, 90 , 75, 33, 33);
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

            $value = $row[3];
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
                                        $ano = ('Sétimo Ano');
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

            $value = $row[4];
            if($value == 1){
                $anoI = 'Primeiro Ano';
            } else {
                if($value == 2){
                    $anoI = 'Segundo Ano';
                } else {
                    if($value == 3){
                        $anoI = 'Terceiro Ano';
                    } else {
                        if($value == 4){
                            $anoI = 'Quarto Ano';
                        } else {
                            if($value == 5){
                                $anoI = 'Quinto Ano';
                            } else {   
                                if($value == 6){
                                    $anoI = 'Sexto Ano';
                                } else {   
                                    if($value == 7){
                                        $anoI = ('Sétimo Ano');
                                    } else {   
                                        if($value == 8){
                                            $anoI = 'Oitavo Ano';
                                        } else {   
                                            if($value == 9){
                                                $anoI = 'Nono Ano';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }   
            }
            $this->Cell(10);
            $this->Cell($w[0],6,($row[0]),'LR',0,'C',$fill);
            $this->Cell($w[1],6,($row[1]),'LR',0,'L',$fill);
			$buscaEscola = buscaEscola($row[2]);
            $this->Cell($w[2],6, $buscaEscola[1][1],'LR',0,'C',$fill);
            $this->Cell($w[3],6, utf8_decode($ano),'LR',0,'C',$fill);
            $this->Cell($w[4],6, utf8_decode($anoI),'LR',0,'C',$fill);
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
$pdf->Cell(0, 10, utf8_decode('Relatório - Alunos com vaga e intenção na mesma unidade escolar'),0,0,'C');
$pdf->Ln(12);
$header = array(utf8_decode('Matrícula'), 'Nome', 'Escola', utf8_decode('Etapa (Vaga)'), utf8_decode('Etapa (Intenção)'));

include_once('../fnc/connect.php'); 
$sql = sprintf("select d.id_inscricao, c.ds_nome , a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Fase_Periodo_Fase_id_ano_serie, b.Lista_Fase_Periodo_Fase_id_ano_serie from matricula.vaga a, matricula.lista_aluno b, matricula.pessoa_fisica c, matricula.aluno d
    where a.Fase_Periodo_Fase_Curso_id_curso = 1
    and a.Fase_Periodo_Fase_Curso_id_curso = b.Lista_Fase_Periodo_Fase_Curso_id_curso
    and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.id_aluno
    and a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = b.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
    and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = c.Pessoa_id_pessoa
    and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = d.Pessoa_Fisica_Pessoa_id_pessoa
    order by ds_nome");

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
    $pdf->Cell(0, 10, utf8_decode('Não há alunos com vaga e intenção na mesma unidade escolar.'),0,0,'C');
} else{
    $data = $datas;
    $pdf->FancyTable($header, $data);
} 
$pdf->Output();
?>