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
        $w = array(25, 90 , 17, 75, 20, 30);
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

            $value = $row[2];
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
            $this->Cell(10);
            $this->Cell($w[0],6,($row[0]),'LR',0,'C',$fill);
            $this->Cell($w[1],6,($row[5]),'LR',0,'L',$fill);
            $this->Cell($w[2],6,($row[6]),'LR',0,'L',$fill);
			$buscaEscola = buscaEscola($row[3]);
            $this->Cell($w[3],6, $buscaEscola[1][1],'LR',0,'C',$fill);
            $this->Cell($w[4],6, utf8_decode($ano),'LR',0,'R',$fill);
            $this->Cell($w[5],6,utf8_decode($row[4]),'LR',0,'L',$fill);
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
$pdf->Cell(0, 10, utf8_decode('Relatório - Homônimos'),0,0,'C');
$pdf->Ln(12);
$header = array(utf8_decode('Matrícula'), 'Nome', 'Dt. Nasc.', 'Escola', utf8_decode('Etapa'), 'Tipo');

include_once('../fnc/connect.php'); 
$sql = sprintf("select h.id_inscricao, u.* from
    (select t.*, y.ds_nome, date_format(y.dt_nascimento, '%s') as dt_nascimento from
        ((select a.Pessoa_id_pessoa, b.Lista_Fase_Periodo_Fase_id_ano_serie, b.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, 'Intenção' from matricula.pessoa_fisica a, matricula.lista_aluno b
            where a.Pessoa_id_pessoa = b.id_aluno and b.Lista_Fase_Periodo_Fase_id_ano_serie < 10)
union
(select d.Pessoa_id_pessoa, c.Fase_Periodo_Fase_id_ano_serie, c.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, if(c.Tipo_Vaga_id_tipo_vaga = 1, 'Vaga - Novo Aluno', 'Vaga - Rematricula') from matricula.pessoa_fisica d, matricula.vaga c
    where d.Pessoa_id_pessoa = c.Aluno_Pessoa_Fisica_Pessoa_id_pessoa and c.Fase_Periodo_Fase_id_ano_serie < 10)) t, matricula.pessoa_fisica y
where t.Pessoa_id_pessoa = y.Pessoa_id_pessoa) u, (select ds_nome, dt_nascimento from matricula.pessoa_fisica w
where (w.Pessoa_id_pessoa in (select id_aluno from matricula.lista_aluno k) or w.Pessoa_id_pessoa in (select Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga l))
group by ds_nome, dt_nascimento
having count(*) > 1) i, matricula.aluno h
where u.ds_nome = i.ds_nome
and u.Pessoa_id_pessoa = h.Pessoa_Fisica_Pessoa_id_pessoa
and u.dt_nascimento = date_format(i.dt_nascimento, '%s')
and Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa != 702099
order by u.ds_nome, u.dt_nascimento, h.id_inscricao
", mysql_real_escape_string('%d/%m/%Y'), mysql_real_escape_string('%d/%m/%Y'));

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
    $pdf->Cell(0, 10, utf8_decode('Não há alunos duplicados'),0,0,'C');
} else{
    $data = $datas;
    $pdf->FancyTable($header, $data);
} 
$pdf->Output();
?>