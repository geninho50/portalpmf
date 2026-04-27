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
        $w = array(22, 70 , 72, 10, 20);
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
            if($row[1] == 1){
                $tipoVaga = 'Infantil';
            } else if($row[1] == 2) {
                $tipoVaga = 'Fundamental';
            } else {
                $tipoVaga = 'EJA';
            }

            $this->Cell($w[0],6,($row[6]),'LR',0,'C',$fill);
            $this->Cell($w[1],6,($row[5]),'LR',0,'L',$fill);
			$buscaEscola = buscaEscola($row[4]);
            $this->Cell($w[2],6, $buscaEscola[1][1],'LR',0,'C',$fill);
            $this->Cell($w[3],6,($row[2]),'LR',0,'C',$fill);
            $this->Cell($w[4],6,utf8_decode($tipoVaga),'LR',0,'R',$fill);
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
$pdf->Cell(0, 10, utf8_decode('Educação Fundamental'),0,0,'C');
$pdf->Ln(6);
$pdf->Cell(0, 10, utf8_decode('Relatório - Alunos com mais de uma matrícula'),0,0,'C');
$pdf->Ln(12);
$header = array(utf8_decode('Matrícula'), 'Nome', 'Escola', utf8_decode('Série'), 'Tipo da vaga');

include_once '../fnc/buscaEscolas.php';
$escolas = buscaEscolasFundamental();

include_once('connect.php');

foreach ($escolas as $key => $value) {

    $es = buscaEscola($value[0]);
    
unset($datas);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(190, 6, iconv('utf-8','iso-8859-1',$es[1][1]), 0,0,'C', false);
    $pdf->Ln(8);


    $sql = sprintf("select s.*, d.ds_nome, f.id_inscricao from 
        (select x.id_pessoa, Tipo_Vaga_id_tipo_vaga, Fase_Periodo_Fase_id_ano_serie, Fase_Periodo_Fase_Curso_id_curso, Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa from
            (select id_pessoa from
                (select count(*), a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa as id_pessoa from matricula.vaga a
                    group by a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa
                    having count(*) > 1) z) x, matricula.vaga c
    where x.id_pessoa = c.Aluno_Pessoa_Fisica_Pessoa_id_pessoa
    order by id_pessoa) s, matricula.pessoa_fisica d, matricula.aluno f
    where s.id_pessoa = d.Pessoa_id_pessoa
    and Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
    and s.id_pessoa = f.Pessoa_Fisica_Pessoa_id_pessoa;", mysql_real_escape_string($value[0]));
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
        $pdf->Cell(0, 10, utf8_decode('Não há alunos com matrícula duplicada para esta escola.'),0,0,'C');
        $pdf->Ln(10);
    } else{
        $data = $datas;
        $pdf->FancyTable($header, $data);

        $pdf->Ln(10);
    } 

}

$pdf->Output();
?>