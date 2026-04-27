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
        $w = array(22, 70 , 17, 65, 15);
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

            $value = $row[4];
            if($value == 10){
                $ano = 'Grupo 1';
            } else {
                if($value == 11){
                    $ano = 'Grupo 2';
                } else {
                    if($value == 12){
                        $ano = 'Grupo 3';
                    } else {
                        if($value == 13){
                            $ano = 'Grupo 4';
                        } else {
                            if($value == 14){
                                $ano = 'Grupo 5';
                            } else {   
                                if($value == 15){
                                    $ano = 'Grupo 6';
                                }
                            }
                        }
                    }
                }   
            }

            $this->Cell($w[0],6,($row[0]),'LR',0,'C',$fill);
            $this->Cell($w[1],6,($row[1]),'LR',0,'L',$fill);
            $this->Cell($w[2],6,($row[2]),'LR',0,'C',$fill);
            $this->Cell($w[3],6, utf8_decode(buscaEscola($row[3])),'LR',0,'C',$fill);
            $this->Cell($w[4],6, utf8_decode($ano),'LR',0,'R',$fill);
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
$pdf->Cell(0, 10, utf8_decode('Relatório - Alunos com mais de uma matrícula'),0,0,'C');
$pdf->Ln(12);
$header = array(utf8_decode('Matrícula'), 'Nome', 'Dt. Nasc.', 'Escola', utf8_decode('Série'));
$link = mysql_connect('localhost', 'matriculapmf', 'sql&dgov#'); 
$sql = sprintf("select d.id_inscricao, x.ds_nome, x.dt_nascimento, q.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, q.Lista_Fase_Periodo_Fase_id_ano_serie from 
    (select count(*) as qtd, a.ds_nome, a.dt_nascimento from matricula.pessoa_fisica a, matricula.lista_aluno b
        where a.Pessoa_id_pessoa = b.id_aluno
        and b.Lista_Fase_Periodo_Fase_Curso_id_curso = 2
        and b.id_escolha = 1
        group by ds_nome, dt_nascimento
        having count(*) > 1) x, matricula.pessoa_fisica c, matricula.aluno d, matricula.lista_aluno q
        where c.ds_nome = x.ds_nome
        and c.dt_nascimento = x.dt_nascimento
        and c.Pessoa_id_pessoa = d.Pessoa_Fisica_Pessoa_id_pessoa
        and c.Pessoa_id_pessoa = q.id_aluno
        order by ds_nome, d.id_inscricao");
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
    $pdf->Cell(0, 10, utf8_decode('Não há alunos com matrícula duplicada'),0,0,'C');
} else{
    $data = $datas;
    $pdf->FancyTable($header, $data);
} 
$pdf->Output();
?>