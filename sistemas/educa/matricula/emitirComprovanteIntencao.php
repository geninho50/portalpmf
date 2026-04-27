<?php

session_name('ma');
session_start();

require('classes/fpdf.php');

class PDF extends FPDF {

    function PDF($orientation = 'P', $unit = 'mm', $size = 'A4') {
        // Call parent constructor
        $this->FPDF($orientation, $unit, $size);
        // Initialization
        $this->B = 0;
        $this->I = 0;
        $this->U = 0;
        $this->HREF = '';
    }

// Load data
    function LoadData() {
// Read file lines
        $lines = ["Austria;Vienna;83859;8075",
            "Belgium;Brussels;30518;10192",
            "Denmark;Copenhagen;43094;5295",
            "Finland;Helsinki;304529;5147",
            "France;Paris;543965;58728",
            "Germany;Berlin;357022;82057",
            "Greece;Athens;131625;10511",
            "Ireland;Dublin;70723;3694",
            "Italy;Roma;301316;57563",
            "Luxembourg;Luxembourg;2586;424",
            "Netherlands;Amsterdam;41526;15654",
            "Portugal;Lisbon;91906;9957",
            "Spain;Madrid;504790;39348",
            "Sweden;Stockholm;410934;8839",
            "United Kingdom;London;243820;58862"];
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', trim($line));
        return $data;
    }

    function Header() {
// Logo
        $this->Image('img/logo.png', 10, 6, 30);
// Arial bold 15
        $this->SetFont('Arial', 'B', 15);
// Move to the right
        $this->Cell(80);
// Title
        $this->Cell(1, 0, iconv('utf-8', 'iso-8859-1', 'Prefeitura Municipal de Florianópolis'), 0, 0, 'C');
// Line break
        $this->Ln(5);
// Arial bold 15
        $this->SetFont('Arial', 'B', 13);
        $this->Cell(142, 0, iconv('utf-8', 'iso-8859-1', 'Secretaria Municipal de Educação'), 0, 0, 'C');
// Line break
        $this->Ln(5);
// Arial bold 15
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(133, 0, iconv('utf-8', 'iso-8859-1', 'Sistema de Gerenciamento Escolar'), 0, 0, 'C');
// Line break
        $this->Ln(10);
// Arial bold 15
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 0, iconv('utf-8', 'iso-8859-1', 'Comprovante de Matrícula'), 0, 0, 'C');
// Line break
        $this->Ln(5);
    }

// Page footer
    function Footer() {
// Position at 1.5 cm from bottom
        $this->SetY(-15);
// Arial italic 8
        $this->SetFont('Arial', 'I', 8);
// Page number
        $this->Cell(0, 10, iconv('utf-8', 'iso-8859-1', 'Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

// Colored table
    function FancyTable($header, $data) {
// Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
// Header
        $w = array(40, 35, 40, 45);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
// Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
// Data
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
// Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    function WriteHTML($html) {
// HTML parser
        $html = str_replace("\n", ' ', $html);
        $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($a as $i => $e) {
            if ($i % 2 == 0) {
// Text
                if ($this->HREF)
                    $this->PutLink($this->HREF, $e);
                else
                    $this->Write(5, $e);
            }
            else {
// Tag
                if ($e[0] == '/')
                    $this->CloseTag(strtoupper(substr($e, 1)));
                else {
// Extract attributes
                    $a2 = explode(' ', $e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach ($a2 as $v) {
                        if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag, $attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr) {
// Opening tag
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, true);
        if ($tag == 'A')
            $this->HREF = $attr['HREF'];
        if ($tag == 'BR')
            $this->Ln(5);
    }

    function CloseTag($tag) {
// Closing tag
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, false);
        if ($tag == 'A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable) {
// Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach (array('B', 'I', 'U') as $s) {
            if ($this->$s > 0)
                $style .= $s;
        }
        $this->SetFont('', $style);
    }

    function PutLink($URL, $txt) {
// Put a hyperlink
        $this->SetTextColor(0, 0, 255);
        $this->SetStyle('U', true);
        $this->Write(5, $txt, $URL);
        $this->SetStyle('U', false);
        $this->SetTextColor(0);
    }

    function DadosAluno($nome, $sexo, $dataNasc, $etnia) {
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Nome: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(170, 5, iconv('utf-8', 'iso-8859-1', $nome), 1, 'L');
        $this->Ln(1);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Data de Nasc.: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', $dataNasc), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Sexo:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', $sexo), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Etnia:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', $etnia), 1, 0, 'C');
    }

    function RgAluno($rg, $orgao, $uf, $data) {
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(23, 5, iconv('utf-8', 'iso-8859-1', 'Identidade: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(33, 5, iconv('utf-8', 'iso-8859-1', $rg), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(33, 5, iconv('utf-8', 'iso-8859-1', 'Órgão Emissor: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(28, 5, iconv('utf-8', 'iso-8859-1', $orgao), 1, 0, 'C');
        $this->Cell(8, 5, iconv('utf-8', 'iso-8859-1', $uf), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Data de Emissão:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', $data), 1, 0, 'C');
    }

}

$nome = $_SESSION['identificacao']['nome_aluno'];
$nome = 'Márcio Pereira dos Santos da Silva Sauro da Silva Sauro Silva Silva Sauro da Silva Sauro Silva Silva';
if ($_SESSION['dados_pessoais']['sexo'] == 'm') {
    $sexo = 'Masculino';
} else {
    $sexo = 'Feminino';
}
include 'fnc/buscaEtnia.php';
$etnia = (buscaEtnia($_SESSION['dados_pessoais']['etnia'])[1]);
$dataNasc = $_SESSION['identificacao']['data_nascimento'];
if ($_SESSION['dados_pessoais']['rg']['possui'] == 'sim') {
    $rg = $_SESSION['dados_pessoais']['rg']['numero'];
    $orgao = $_SESSION['dados_pessoais']['rg']['orgao_rg'];
    $uf_rg = $_SESSION['dados_pessoais']['rg']['uf_rg'];
    $dt_rg = $_SESSION['dados_pessoais']['rg']['data_rg'];
}
if ($_SESSION['dados_pessoais']['certidao']['tipo_certidao'] == 'antigo') {
    $termo = $_SESSION['dados_pessoais']['certidao']['termo'];
    $cartorio = $_SESSION['dados_pessoais']['certidao']['cartorio'];
    $livro = $_SESSION['dados_pessoais']['certidao']['livro'];
    $folha = $_SESSION['dados_pessoais']['certidao']['folha'];
}

$html = iconv('utf-8', 'iso-8859-1', '    Aqui ficará o texto que irá explicar o conteúdo deste documento. Abaixo deste texto ficarão as informações necessárias para comprovar este documento.');

$pdf = new PDF();
$pdf->AliasNbPages();
// Column headings
//$header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
// Data loading
//$data = $pdf->LoadData();
$pdf->SetFont('Arial', '', 14);
$pdf->AddPage();
$pdf->Ln(5);
$pdf->WriteHTML($html);
$pdf->Ln(10);
$pdf->DadosAluno($nome, $sexo, $dataNasc, $etnia);
if ($_SESSION['dados_pessoais']['rg']['possui'] == 'sim') {
    $pdf->Ln(5);
    $pdf->Ln(1);
    $pdf->RgAluno($rg, $orgao, $uf_rg, $dt_rg);
}
//$pdf->FancyTable($header, $data);
$pdf->Output();
?>