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
        $this->SetFont('Arial','I',8);
    // Header
        $w = array(30, 70, 60, 30);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
    // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('Arial','I',8);
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

if(!isset($_GET['idEscola'])){

    header("Location: ../relatorioCriancasEscolha.php");

}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0, 10, utf8_decode('Educação Infantil'),0,0,'C');
$pdf->Ln(6);
$pdf->Cell(0, 10, utf8_decode('Relatório Nominal - Crianças Atendidas com Tipo de Atendimento'),0,0,'C');
$header = array(utf8_decode('Matrícula'), 'Nome', utf8_decode("Tipo Atendimento"), 'Data');
include_once('../fnc/connect.php'); 

{

$pdf->Ln(12);
$buscaEscola = buscaEscola($_GET['idEscola']);
$pdf->Cell(0, 10, utf8_decode($buscaEscola[1][1]),0,0,'C');

//GRUPO 1
    $sql = sprintf("select c.id_inscricao, b.ds_nome, a.id_opcao, a.dt_alteracao
                    from matricula.auditoria_intencao_infantil_atender a, matricula.pessoa_fisica b, matricula.aluno c
                    where a.dt_alteracao > '2014-03-18'
                    and a.id_aluno = b.Pessoa_id_pessoa
                        and c.Pessoa_Fisica_Pessoa_id_pessoa = a.id_aluno
                        and a.id_grupo = 10
                    and a.id_escola = %s
                    order by b.ds_nome", mysql_real_escape_string($_GET['idEscola']));
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

if(isset($datas)){

$pdf->Ln();
$pdf->Cell(0, 10, utf8_decode('Grupo 1'),0,0,'C');

        // Colors, line width and bold font
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B', 7);
    // Header
    $w = array(30, 70, 60, 30);
    $pdf->Ln();
    $pdf->Cell(1);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');
    // Data
    $fill = false;



    foreach ($datas as $key => $value) {

        if($value[2]==1){
            $atendimento = 'Atendimento Integral';
        }
        else{
            $atendimento = 'Atendimento Parcial';
        }
        
        $data2 = explode("-", $value[3]);
        $data3 = explode(":", $data2[2]);
        $data4 = explode(" ", $data3[0]);

        $data_atendimento = ($data4[0]) . '/' . ($data2[1]) . '/' . ($data2[0]);

        $pdf->Cell(1);
        $pdf->Cell($w[0],6,($value[0]), 1,0,'C',$fill);
        $pdf->Cell($w[1],6,($value[1]), 1,0,'C',$fill);
        $pdf->Cell($w[2],6,($atendimento), 1,0,'C',$fill);
        $pdf->Cell($w[3],6,($data_atendimento), 1,0,'C',$fill);
        $pdf->Ln();
        $fill = !$fill;
    }

    unset($datas);

    // Closing line
    $pdf->Cell(1);
    $pdf->Cell(array_sum($w),0,'','T');

}

//GRUPO 1
    $sql = sprintf("select c.id_inscricao, b.ds_nome, a.id_opcao, a.dt_alteracao
                    from matricula.auditoria_intencao_infantil_atender a, matricula.pessoa_fisica b, matricula.aluno c
                    where a.dt_alteracao > '2014-03-18'
                    and a.id_aluno = b.Pessoa_id_pessoa
                        and c.Pessoa_Fisica_Pessoa_id_pessoa = a.id_aluno
                        and a.id_grupo = 10
                    and a.id_escola = %s
                    order by b.ds_nome", mysql_real_escape_string($_GET['idEscola']));
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

if(isset($datas)){

$pdf->SetFont('Arial','',12);
$pdf->Ln();
$pdf->Cell(0, 10, utf8_decode('Grupo 2'),0,0,'C');

        // Colors, line width and bold font
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B', 7);
    // Header
    $w = array(30, 70, 60, 30);
    $pdf->Ln();
    $pdf->Cell(1);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');
    // Data
    $fill = false;

    foreach ($datas as $key => $value) {
        if($value[2]==1){
            $atendimento = 'Atendimento Integral';
        }
        else{
            $atendimento = 'Atendimento Parcial';
        }
        
        $data2 = explode("-", $value[3]);
        $data3 = explode(":", $data2[2]);
        $data4 = explode(" ", $data3[0]);

        $data_atendimento = ($data4[0]) . '/' . ($data2[1]) . '/' . ($data2[0]);

        $pdf->Cell(1);
        $pdf->Cell($w[0],6,($value[0]), 1,0,'C',$fill);
        $pdf->Cell($w[1],6,($value[1]), 1,0,'C',$fill);
        $pdf->Cell($w[2],6,($atendimento), 1,0,'C',$fill);
        $pdf->Cell($w[3],6,($data_atendimento), 1,0,'C',$fill);
        $pdf->Ln();
        $fill = !$fill;
    }

    unset($datas);

    // Closing line
    $pdf->Cell(1);
    $pdf->Cell(array_sum($w),0,'','T');

}

//GRUPO 1
    $sql = sprintf("select c.id_inscricao, b.ds_nome, a.id_opcao, a.dt_alteracao
                    from matricula.auditoria_intencao_infantil_atender a, matricula.pessoa_fisica b, matricula.aluno c
                    where a.dt_alteracao > '2014-03-18'
                    and a.id_aluno = b.Pessoa_id_pessoa
                        and c.Pessoa_Fisica_Pessoa_id_pessoa = a.id_aluno
                        and a.id_grupo = 11
                    and a.id_escola = %s
                    order by b.ds_nome", mysql_real_escape_string($_GET['idEscola']));
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

if(isset($datas)){

$pdf->SetFont('Arial','',12);
$pdf->Ln();
$pdf->Cell(0, 10, utf8_decode('Grupo 3'),0,0,'C');

        // Colors, line width and bold font
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B', 7);
    // Header
    $w = array(30, 70, 60, 30);
    $pdf->Ln();
    $pdf->Cell(1);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');
    // Data
    $fill = false;

    foreach ($datas as $key => $value) {
       if($value[2]==1){
            $atendimento = 'Atendimento Integral';
        }
        else{
            $atendimento = 'Atendimento Parcial';
        }
        
        $data2 = explode("-", $value[3]);
        $data3 = explode(":", $data2[2]);
        $data4 = explode(" ", $data3[0]);

        $data_atendimento = ($data4[0]) . '/' . ($data2[1]) . '/' . ($data2[0]);

        $pdf->Cell(1);
        $pdf->Cell($w[0],6,($value[0]), 1,0,'C',$fill);
        $pdf->Cell($w[1],6,($value[1]), 1,0,'C',$fill);
        $pdf->Cell($w[2],6,($atendimento), 1,0,'C',$fill);
        $pdf->Cell($w[3],6,($data_atendimento), 1,0,'C',$fill);
        $pdf->Ln();
        $fill = !$fill;
    }

    unset($datas);

    // Closing line
    $pdf->Cell(1);
    $pdf->Cell(array_sum($w),0,'','T');

}

//GRUPO 1
    $sql = sprintf("select c.id_inscricao, b.ds_nome, a.id_opcao, a.dt_alteracao
                    from matricula.auditoria_intencao_infantil_atender a, matricula.pessoa_fisica b, matricula.aluno c
                    where a.dt_alteracao > '2014-03-18'
                    and a.id_aluno = b.Pessoa_id_pessoa
                        and c.Pessoa_Fisica_Pessoa_id_pessoa = a.id_aluno
                        and a.id_grupo = 12
                    and a.id_escola = %s
                    order by b.ds_nome", mysql_real_escape_string($_GET['idEscola']));
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

if(isset($datas)){

$pdf->SetFont('Arial','',12);
$pdf->Ln();
$pdf->Cell(0, 10, utf8_decode('Grupo 4'),0,0,'C');

        // Colors, line width and bold font
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B', 7);
    // Header
    $w = array(30, 70, 60, 30);
    $pdf->Ln();
    $pdf->Cell(1);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');
    // Data
    $fill = false;

    foreach ($datas as $key => $value) {
       if($value[2]==1){
            $atendimento = 'Atendimento Integral';
        }
        else{
            $atendimento = 'Atendimento Parcial';
        }
        
        $data2 = explode("-", $value[3]);
        $data3 = explode(":", $data2[2]);
        $data4 = explode(" ", $data3[0]);

        $data_atendimento = ($data4[0]) . '/' . ($data2[1]) . '/' . ($data2[0]);

        $pdf->Cell(1);
        $pdf->Cell($w[0],6,($value[0]), 1,0,'C',$fill);
        $pdf->Cell($w[1],6,($value[1]), 1,0,'C',$fill);
        $pdf->Cell($w[2],6,($atendimento), 1,0,'C',$fill);
        $pdf->Cell($w[3],6,($data_atendimento), 1,0,'C',$fill);
        $pdf->Ln();
        $fill = !$fill;
    }

    unset($datas);

    // Closing line
    $pdf->Cell(1);
    $pdf->Cell(array_sum($w),0,'','T');

}

//GRUPO 1
    $sql = sprintf("select c.id_inscricao, b.ds_nome, a.id_opcao, a.dt_alteracao
                    from matricula.auditoria_intencao_infantil_atender a, matricula.pessoa_fisica b, matricula.aluno c
                    where a.dt_alteracao > '2014-03-18'
                    and a.id_aluno = b.Pessoa_id_pessoa
                        and c.Pessoa_Fisica_Pessoa_id_pessoa = a.id_aluno
                        and a.id_grupo = 13
                    and a.id_escola = %s
                    order by b.ds_nome", mysql_real_escape_string($_GET['idEscola']));
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

if(isset($datas)){

$pdf->SetFont('Arial','',12);
$pdf->Ln();
$pdf->Cell(0, 10, utf8_decode('Grupo 5'),0,0,'C');

        // Colors, line width and bold font
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B', 7);
    // Header
    $w = array(30, 70, 60, 30);
    $pdf->Ln();
    $pdf->Cell(1);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');
    // Data
    $fill = false;

    foreach ($datas as $key => $value) {
       if($value[2]==1){
            $atendimento = 'Atendimento Integral';
        }
        else{
            $atendimento = 'Atendimento Parcial';
        }
        
        $data2 = explode("-", $value[3]);
        $data3 = explode(":", $data2[2]);
        $data4 = explode(" ", $data3[0]);

        $data_atendimento = ($data4[0]) . '/' . ($data2[1]) . '/' . ($data2[0]);

        $pdf->Cell(1);
        $pdf->Cell($w[0],6,($value[0]), 1,0,'C',$fill);
        $pdf->Cell($w[1],6,($value[1]), 1,0,'C',$fill);
        $pdf->Cell($w[2],6,($atendimento), 1,0,'C',$fill);
        $pdf->Cell($w[3],6,($data_atendimento), 1,0,'C',$fill);
        $pdf->Ln();
        $fill = !$fill;
    }

    unset($datas);

    // Closing line
    $pdf->Cell(1);
    $pdf->Cell(array_sum($w),0,'','T');

}

//GRUPO 1
    $sql = sprintf("select c.id_inscricao, b.ds_nome, a.id_opcao, a.dt_alteracao
                    from matricula.auditoria_intencao_infantil_atender a, matricula.pessoa_fisica b, matricula.aluno c
                    where a.dt_alteracao > '2014-03-18'
                    and a.id_aluno = b.Pessoa_id_pessoa
                        and c.Pessoa_Fisica_Pessoa_id_pessoa = a.id_aluno
                        and a.id_grupo = 14
                    and a.id_escola = %s
                    order by b.ds_nome", mysql_real_escape_string($_GET['idEscola']));
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

if(isset($datas)){

$pdf->SetFont('Arial','',12);
$pdf->Ln();
$pdf->Cell(0, 10, utf8_decode('Grupo 6'),0,0,'C');

        // Colors, line width and bold font
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B', 7);
    // Header
    $w = array(30, 70, 60, 30);
    $pdf->Ln();
    $pdf->Cell(1);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');
    // Data
    $fill = false;

    foreach ($datas as $key => $value) {
        if($value[2]==1){
            $atendimento = 'Atendimento Integral';
        }
        else{
            $atendimento = 'Atendimento Parcial';
        }
        
        $data2 = explode("-", $value[3]);
        $data3 = explode(":", $data2[2]);
        $data4 = explode(" ", $data3[0]);

        $data_atendimento = ($data4[0]) . '/' . ($data2[1]) . '/' . ($data2[0]);

        $pdf->Cell(1);
        $pdf->Cell($w[0],6,($value[0]), 1,0,'C',$fill);
        $pdf->Cell($w[1],6,($value[1]), 1,0,'C',$fill);
        $pdf->Cell($w[2],6,($atendimento), 1,0,'C',$fill);
        $pdf->Cell($w[3],6,($data_atendimento), 1,0,'C',$fill);
        $pdf->Ln();
        $fill = !$fill;
    }

    unset($datas);

    // Closing line
    $pdf->Cell(1);
    $pdf->Cell(array_sum($w),0,'','T');

}

//GRUPO 1
    $sql = sprintf("select c.id_inscricao, b.ds_nome, a.id_opcao, a.dt_alteracao
                    from matricula.auditoria_intencao_infantil_atender a, matricula.pessoa_fisica b, matricula.aluno c
                    where a.dt_alteracao > '2014-03-18'
                    and a.id_aluno = b.Pessoa_id_pessoa
                        and c.Pessoa_Fisica_Pessoa_id_pessoa = a.id_aluno
                        and a.id_grupo = 15
                    and a.id_escola = %s
                    order by b.ds_nome", mysql_real_escape_string($_GET['idEscola']));
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

if(isset($datas)){

$pdf->Ln();
$pdf->Cell(0, 10, utf8_decode('Grupo 1'),0,0,'C');

        // Colors, line width and bold font
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B', 7);
    // Header
    $w = array(30, 70, 60, 30);
    $pdf->Ln();
    $pdf->Cell(1);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');
    // Data
    $fill = false;

    foreach ($datas as $key => $value) {
        if($value[2]==1){
            $atendimento = 'Atendimento Integral';
        }
        else{
            $atendimento = 'Atendimento Parcial';
        }
        
        $data2 = explode("-", $value[3]);
        $data3 = explode(":", $data2[2]);
        $data4 = explode(" ", $data3[0]);

        $data_atendimento = ($data4[0]) . '/' . ($data2[1]) . '/' . ($data2[0]);

        $pdf->Cell(1);
        $pdf->Cell($w[0],6,($value[0]), 1,0,'C',$fill);
        $pdf->Cell($w[1],6,($value[1]), 1,0,'C',$fill);
        $pdf->Cell($w[2],6,($atendimento), 1,0,'C',$fill);
        $pdf->Cell($w[3],6,($data_atendimento), 1,0,'C',$fill);
        $pdf->Ln();
        $fill = !$fill;
    }

    unset($datas);

    // Closing line
    $pdf->Cell(1);
    $pdf->Cell(array_sum($w),0,'','T');

}

} 
$pdf->Output();
?>