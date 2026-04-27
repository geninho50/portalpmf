<?php

session_name('ga');
session_start();
if($_SESSION['usuario']['permissoes'][4][1] != 1){
    header("Location: ../index.php");
}
require('../classes/fpdf.php');

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
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', trim($line));
        return $data;
    }

    function Header() {
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
        $header[0] = 'Nome';
        $header[1] = 'Sit. Ocup.';
        $header[2] = 'Parentesco';
        $header[3] = 'Dt. Nasc.';
        $header[4] = 'Valor Mensal';
        $header[5] = iconv('utf-8', 'iso-8859-1', 'Comprovação');
// Colors, line width and bold font
        $this->SetFillColor(100, 100, 100);
        $this->SetTextColor(255);
        $this->SetDrawColor(20, 20, 20);
        $this->SetLineWidth(.3);
        $this->SetFont('', '');
// Header
        $w = array(60, 25, 25, 25, 25, 28);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
// Color and font restoration
        $this->SetFillColor(235, 235, 235);
        $this->SetTextColor(0);
        $this->SetFont('');
// Data
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, ($row[2]), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, $row[3], 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, $row[4], 'LR', 0, 'R', $fill);
            $this->Cell($w[5], 6, $row[4], 'LR', 0, 'R', $fill);
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
        $this->Cell(17, 5, iconv('utf-8', 'iso-8859-1', 'Nome*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(170, 5, iconv('utf-8', 'iso-8859-1', $nome), 1, 'L');
        $this->Ln(1);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(32, 5, iconv('utf-8', 'iso-8859-1', 'Data de Nasc.*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', $dataNasc), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Sexo*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', $sexo), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Etnia*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', $etnia), 1, 0, 'C');
    }

    function RgAluno($rg, $orgao, $uf, $data) {
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', 'Carteira de Identidade:'), 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Identidade: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(28, 5, iconv('utf-8', 'iso-8859-1', $rg), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(32, 5, iconv('utf-8', 'iso-8859-1', 'Órgão Emissor: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(28, 5, iconv('utf-8', 'iso-8859-1', $orgao), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(10, 5, iconv('utf-8', 'iso-8859-1', 'UF: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(8, 5, iconv('utf-8', 'iso-8859-1', $uf), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Data de Emissão:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(22, 5, iconv('utf-8', 'iso-8859-1', $data), 1, 0, 'C');
    }

    function CertidaoVelha($termo, $folha, $livro, $cartorio, $uf_cart) {
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(48, 5, iconv('utf-8', 'iso-8859-1', 'Certidão Nascimento:'), 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'BU', 10);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Modelo Antigo:'), 0, 0, 'C');
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Termo: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(20, 5, iconv('utf-8', 'iso-8859-1', $termo), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Folha: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', $folha), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Livro:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(13, 5, iconv('utf-8', 'iso-8859-1', $livro), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(20, 5, iconv('utf-8', 'iso-8859-1', 'Cartório:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(55, 5, iconv('utf-8', 'iso-8859-1', $cartorio), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(10, 5, iconv('utf-8', 'iso-8859-1', 'UF:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(8, 5, iconv('utf-8', 'iso-8859-1', $uf_cart), 1, 0, 'C');
    }

    function CertidaoNova($numero) {
        $this->SetFont('Arial', 'BU', 10);
        $this->Cell(28, 5, iconv('utf-8', 'iso-8859-1', 'Modelo Novo:'), 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(23, 5, iconv('utf-8', 'iso-8859-1', 'Número: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(100, 5, iconv('utf-8', 'iso-8859-1', $numero), 1, 0, 'C');
    }

    function NacionalidadeNaturalidade($pais, $estado, $cidade) {
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(31, 5, iconv('utf-8', 'iso-8859-1', 'Nacionalidade: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(55, 5, iconv('utf-8', 'iso-8859-1', $pais), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(28, 5, iconv('utf-8', 'iso-8859-1', 'Naturalidade: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(55, 5, iconv('utf-8', 'iso-8859-1', $cidade), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(10, 5, iconv('utf-8', 'iso-8859-1', 'UF:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(8, 5, iconv('utf-8', 'iso-8859-1', $estado), 1, 0, 'C');
    }

    function Telefones($residencial, $celular, $comercial) {
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(21, 5, iconv('utf-8', 'iso-8859-1', 'Telefones'), 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Residencial: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(36, 5, iconv('utf-8', 'iso-8859-1', $residencial), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(20, 5, iconv('utf-8', 'iso-8859-1', 'Celular: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(36, 5, iconv('utf-8', 'iso-8859-1', $celular), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(29, 5, iconv('utf-8', 'iso-8859-1', 'Comercial: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(36, 5, iconv('utf-8', 'iso-8859-1', $comercial), 1, 0, 'C');
    }

    function JaFrequenta() {
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(59, 5, iconv('utf-8', 'iso-8859-1', 'Ja frequenta a rede municipal: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Sim: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Não: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
    }

    function ComQuemMora($pai, $mae, $resp) {
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', 'Com quem o aluno mora: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(10, 5, iconv('utf-8', 'iso-8859-1', 'Pai: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $pai), 1, 0, 'C');
        $this->Cell(13, 5, iconv('utf-8', 'iso-8859-1', 'Mãe: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $mae), 1, 0, 'C');
        $this->Cell(27, 5, iconv('utf-8', 'iso-8859-1', 'Responsável: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $resp), 1, 0, 'C');
    }

    function QuemAcompanha($pai, $mae, $resp) {
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(109, 5, iconv('utf-8', 'iso-8859-1', 'Quem acompanha o aluno na vida escolar (somente um): '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Pai: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $pai), 1, 0, 'C');
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Mãe: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $mae), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Responsável: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $resp), 1, 0, 'C');
    }

    function Endereco($cep, $logradouro, $numero, $complemento, $bairro) {
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(23, 5, iconv('utf-8', 'iso-8859-1', 'Endereço:'), 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(18, 5, iconv('utf-8', 'iso-8859-1', 'CEP*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', $cep), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Logradouro*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(107, 5, iconv('utf-8', 'iso-8859-1', $logradouro), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(23, 5, iconv('utf-8', 'iso-8859-1', 'Número: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', $numero), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(31, 5, iconv('utf-8', 'iso-8859-1', 'Complemento: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(49, 5, iconv('utf-8', 'iso-8859-1', $complemento), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(17, 5, iconv('utf-8', 'iso-8859-1', 'Bairro*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', $bairro), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(21, 5, iconv('utf-8', 'iso-8859-1', 'Cidade: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', 'Florianópolis'), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(10, 5, iconv('utf-8', 'iso-8859-1', 'UF:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(8, 5, iconv('utf-8', 'iso-8859-1', 'SC'), 1, 0, 'C');
    }

    function EnderecoTrab($cep, $logradouro, $numero, $complemento, $bairro) {
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', 'Endereço de Trabalho:'), 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(18, 5, iconv('utf-8', 'iso-8859-1', 'CEP*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', $cep), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Logradouro*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(107, 5, iconv('utf-8', 'iso-8859-1', $logradouro), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(23, 5, iconv('utf-8', 'iso-8859-1', 'Número: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', $numero), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(31, 5, iconv('utf-8', 'iso-8859-1', 'Complemento: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(49, 5, iconv('utf-8', 'iso-8859-1', $complemento), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(17, 5, iconv('utf-8', 'iso-8859-1', 'Bairro*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', $bairro), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(21, 5, iconv('utf-8', 'iso-8859-1', 'Cidade: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(10, 5, iconv('utf-8', 'iso-8859-1', 'UF:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(8, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Turnos de Trabalho*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', 'Matutino (das 6h às 12h):'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(55, 5, iconv('utf-8', 'iso-8859-1', 'Vespertino (das 12h às 18h):'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(45);
        $this->Cell(49, 5, iconv('utf-8', 'iso-8859-1', 'Noturno (das 18h às 6h):'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
    }

    function outrosDados($urbana, $rural, $autorizaUso, $bolsaFamilia, $contraTurno, $possuiComputador, $localAcesso, $tempoResidencia) {

        $temp = '';
        $tempDois = '';
        $tempTres = '';
        $tempQuatro = '';
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(33, 5, iconv('utf-8', 'iso-8859-1', 'Outros Dados:'), 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(41, 5, iconv('utf-8', 'iso-8859-1', 'Zona de Moradia*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Urbana: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $urbana), 1, 0, 'C');
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Rural: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $rural), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(60, 5, iconv('utf-8', 'iso-8859-1', 'Autoriza Uso de Imagem*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if (isset($autorizaUso)) {
            if ($autorizaUso) {
                $temp = 'X';
                $tempDois = '';
            } else {
                $temp = '';
                $tempDois = 'X';
            }
        } else {
            $temp = '';
            $tempDois = '';
        }
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Sim: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Não: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(81, 5, iconv('utf-8', 'iso-8859-1', 'Local de Permanência no contra-turno*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($contraTurno == 'Casa') {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
        } else {
            if ($contraTurno == 'Escola') {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
            } else {
                if ($contraTurno == 'Outro') {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = '';
                }
            }
        }
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Casa: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(18, 5, iconv('utf-8', 'iso-8859-1', 'Escola: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Outro: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(46, 5, iconv('utf-8', 'iso-8859-1', 'Possui computador*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if (isset($possuiComputador)) {
            if ($possuiComputador) {
                $temp = 'X';
                $tempDois = '';
            } else {
                $temp = '';
                $tempDois = 'X';
            }
        } else {
            $temp = '';
            $tempDois = '';
        }
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Sim: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Não: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', 'Recebe Bolsa Família*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if (isset($bolsaFamilia)) {
            if ($bolsaFamilia) {
                $temp = 'X';
                $tempDois = '';
            } else {
                $temp = '';
                $tempDois = 'X';
            }
        }
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Sim: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Não: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(59, 5, iconv('utf-8', 'iso-8859-1', 'Local de Acesso à Internet*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if (isset($localAcesso)) {
            if ($localAcesso == 'Casa') {
                $temp = 'X';
                $tempDois = '';
                $tempTres = '';
                $tempQuatro = '';
            } else {
                if ($localAcesso == 'Trabalho') {
                    $temp = '';
                    $tempDois = 'X';
                    $tempTres = '';
                    $tempQuatro = '';
                } else {
                    if ($localAcesso == 'Escola') {
                        $temp = '';
                        $tempDois = '';
                        $tempTres = '';
                        $tempQuatro = '';
                    } else {
                        if ($localAcesso == 'Outro') {
                            $temp = '';
                            $tempDois = '';
                            $tempTres = '';
                            $tempQuatro = 'X';
                        }
                    }
                }
            }
        } else {
            $temp = '';
            $tempDois = '';
            $tempTres = '';
            $tempQuatro = '';
        }
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Casa: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(22, 5, iconv('utf-8', 'iso-8859-1', 'Trabalho: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(18, 5, iconv('utf-8', 'iso-8859-1', 'Escola: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Outro: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempQuatro), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(74, 5, iconv('utf-8', 'iso-8859-1', 'Tempo de Residência no Município*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($tempoResidencia) {
            $temp = 'X';
            $tempDois = '';
        } else {
            $temp = '';
            $tempDois = '';
        }
        $this->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Menos de 12 meses:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', 'Mais de 12 meses:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
    }

    function dadosSaude($anemia, $diabetes, $lactose, $gluten, $refluxo, $deficiencias, $recursos) {
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(38, 5, iconv('utf-8', 'iso-8859-1', 'Dados de Saúde:'), 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(48, 5, iconv('utf-8', 'iso-8859-1', 'Intolerância à Glúten*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($gluten == 'sim') {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
        } else {
            if ($gluten == 'nao') {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
            } else {
                if ($gluten == 'naoSei') {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = '';
                }
            }
        }
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', 'Sim: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', 'Não: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Não sei: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Anemia*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($anemia == 'sim') {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
        } else {
            if ($anemia == 'nao') {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
            } else {
                if ($anemia == 'naoSei') {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = '';
                }
            }
        }
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', 'Sim: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', 'Não: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Não sei: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', 'Intolerância à Lactose*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($lactose == 'sim') {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
        } else {
            if ($lactose == 'nao') {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
            } else {
                if ($lactose == 'naoSei') {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = '';
                }
            }
        }
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', 'Sim: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', 'Não: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(18, 5, iconv('utf-8', 'iso-8859-1', 'Não sei: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(24, 5, iconv('utf-8', 'iso-8859-1', 'Diabetes*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($diabetes == 'sim') {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
        } else {
            if ($diabetes == 'nao') {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
            } else {
                if ($diabetes == 'naoSei') {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = '';
                }
            }
        }
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', 'Sim: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', 'Não: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Não sei: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(22, 5, iconv('utf-8', 'iso-8859-1', 'Refluxo*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);

        $this->SetFont('Arial', '', 11);
        if ($refluxo == 'sim') {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
        } else {
            if ($refluxo == 'nao') {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
            } else {
                if ($refluxo == 'naoSei') {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = '';
                }
            }
        }
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', 'Sim: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', 'Não: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Não sei: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(139, 5, iconv('utf-8', 'iso-8859-1', 'Deficiência, transtorno global do desenvolvimento ou altas habilidades*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Ln(6);
        $this->SetFont('Arial', '', 11);
        if ($refluxo == 'sim') {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
        } else {
            if ($refluxo == 'nao') {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
            } else {
                if ($refluxo == 'naoSei') {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = '';
                }
            }
        }
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Sim:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(11, 5, iconv('utf-8', 'iso-8859-1', 'Não:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(17, 5, iconv('utf-8', 'iso-8859-1', 'Não sei:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(29, 5, iconv('utf-8', 'iso-8859-1', 'Deficiências:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', 'Deficiência Física:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(44, 5, iconv('utf-8', 'iso-8859-1', 'Deficiência Intelectual:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(44, 5, iconv('utf-8', 'iso-8859-1', 'Deficiência Múltipla:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(27, 5, iconv('utf-8', 'iso-8859-1', 'Cegueira:   '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'Baixa Visão:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(24, 5, iconv('utf-8', 'iso-8859-1', 'Surdez:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', 'Deficiência Auditiva:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Surdocegueira:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(79, 5, iconv('utf-8', 'iso-8859-1', 'Transtorno Global do Desenvolvimento:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Transtorno Desintegrativo da Infância:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', '', 11);
        $this->Cell(38, 5, iconv('utf-8', 'iso-8859-1', 'Autismo Infantil:   '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(55, 5, iconv('utf-8', 'iso-8859-1', 'Síndrome de Asperger:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(44, 5, iconv('utf-8', 'iso-8859-1', 'Síndrome de Rett:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(7);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(78, 5, iconv('utf-8', 'iso-8859-1', 'Altas habilidades ou superdotação:      '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(7);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(144, 5, iconv('utf-8', 'iso-8859-1', 'Recursos necessários para a participação do aluno em avaliações do Inep:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Leitura labial:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(7);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Auxílio ledor:    '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(36, 5, iconv('utf-8', 'iso-8859-1', 'Auxílio-transcrição:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Guia-Intérprete:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(38, 5, iconv('utf-8', 'iso-8859-1', 'Intérprete de libras:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(7);
        $this->Cell(37, 5, iconv('utf-8', 'iso-8859-1', 'Prova em braile: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(42, 5, iconv('utf-8', 'iso-8859-1', 'Prova ampliada (16):'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(42, 5, iconv('utf-8', 'iso-8859-1', 'Prova ampliada (20):'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(42, 5, iconv('utf-8', 'iso-8859-1', 'Prova ampliada (24):'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
    }

    function CarroMoradia($carro, $moradia) {
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(31, 5, iconv('utf-8', 'iso-8859-1', 'Possui Carro:'), 0, 0, 'C');
        if (isset($carro)) {
            if ($carro) {
                $temp = 'X';
                $tempDois = '';
            } else {
                $temp = '';
                $tempDois = 'X';
            }
            
            if($carro == ''){
                $temp = '';
                $tempDois = '';
            }
        } else {
            $temp = '';
            $tempDois = '';
        }
        $this->SetFont('Arial', '', 11);
        $this->Cell(11, 5, iconv('utf-8', 'iso-8859-1', 'Sim:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(11, 5, iconv('utf-8', 'iso-8859-1', 'Não:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(21, 5, iconv('utf-8', 'iso-8859-1', 'Moradia:'), 0, 0, 'C');
        if (isset($carro)) {
            if ($carro) {
                $temp = 'X';
                $tempDois = '';
            } else {
                $temp = '';
                $tempDois = 'X';
            }
        } else {
            $temp = '';
            $tempDois = '';
        }
        $this->SetFont('Arial', '', 11);
        $this->Cell(29, 5, iconv('utf-8', 'iso-8859-1', 'Casa Própria:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Alugada:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Outros:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
    }

    function DadosMae($nome, $sexo, $dataNasc, $etnia) {
        $this->Ln(5);
        $this->SetFont('Arial', 'BU', 14);
        $this->Cell(35, 0, iconv('utf-8', 'iso-8859-1', 'Dados da Mãe:'), 0, 0, 'C');
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Nome*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(165, 5, iconv('utf-8', 'iso-8859-1', $nome), 1, 'L');
        $this->Ln(1);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(33, 5, iconv('utf-8', 'iso-8859-1', 'Data de Nasc.*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', $dataNasc), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Sexo*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', $sexo), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Etnia*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(31, 5, iconv('utf-8', 'iso-8859-1', $etnia), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Estado Civil*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(18, 5, iconv('utf-8', 'iso-8859-1', 'Solteiro:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(20, 5, iconv('utf-8', 'iso-8859-1', 'Casado:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Divorciado:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(17, 5, iconv('utf-8', 'iso-8859-1', 'Viúvo:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(27, 5, iconv('utf-8', 'iso-8859-1', 'União Estável:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(32, 5, iconv('utf-8', 'iso-8859-1', 'Escolaridade*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Analfabeto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(36, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Fundamental:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(54, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Fundamental Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Médio:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Médio Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(48, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Superior Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Superior:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Pós-graduação:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(23, 5, iconv('utf-8', 'iso-8859-1', 'Religião*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'Profissão*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'CPF*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
    }

    function DadosPai($nome, $sexo, $dataNasc, $etnia) {
        $this->Ln(5);
        $this->SetFont('Arial', 'BU', 14);
        $this->Cell(35, 0, iconv('utf-8', 'iso-8859-1', 'Dados do Pai:'), 0, 0, 'C');
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Nome*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(165, 5, iconv('utf-8', 'iso-8859-1', $nome), 1, 'L');
        $this->Ln(1);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(33, 5, iconv('utf-8', 'iso-8859-1', 'Data de Nasc.*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', $dataNasc), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Sexo*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', $sexo), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Etnia*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(31, 5, iconv('utf-8', 'iso-8859-1', $etnia), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Estado Civil*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(18, 5, iconv('utf-8', 'iso-8859-1', 'Solteiro:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(20, 5, iconv('utf-8', 'iso-8859-1', 'Casado:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Divorciado:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(17, 5, iconv('utf-8', 'iso-8859-1', 'Viúvo:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(27, 5, iconv('utf-8', 'iso-8859-1', 'União Estável:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(32, 5, iconv('utf-8', 'iso-8859-1', 'Escolaridade*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Analfabeto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(36, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Fundamental:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(54, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Fundamental Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Médio:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Médio Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(48, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Superior Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Superior:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Pós-graduação:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(23, 5, iconv('utf-8', 'iso-8859-1', 'Religião*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'Profissão*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'CPF*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
    }

    function DadosResponsavel($nome, $sexo, $dataNasc, $etnia) {
        $this->Ln(8);
        $this->SetFont('Arial', 'BU', 14);
        $this->Cell(55, 0, iconv('utf-8', 'iso-8859-1', 'Dados do Responsável:'), 0, 0, 'C');
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Nome*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(96, 5, iconv('utf-8', 'iso-8859-1', $nome), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(29, 5, iconv('utf-8', 'iso-8859-1', 'Parentesco*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(40, 5, iconv('utf-8', 'iso-8859-1', $nome), 1, 'L');
        $this->Ln(1);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(33, 5, iconv('utf-8', 'iso-8859-1', 'Data de Nasc.*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', $dataNasc), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Sexo*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', $sexo), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Etnia*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(31, 5, iconv('utf-8', 'iso-8859-1', $etnia), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Estado Civil*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(18, 5, iconv('utf-8', 'iso-8859-1', 'Solteiro:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(20, 5, iconv('utf-8', 'iso-8859-1', 'Casado:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Divorciado:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(17, 5, iconv('utf-8', 'iso-8859-1', 'Viúvo:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(27, 5, iconv('utf-8', 'iso-8859-1', 'União Estável:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(32, 5, iconv('utf-8', 'iso-8859-1', 'Escolaridade*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Analfabeto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(36, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Fundamental:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(54, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Fundamental Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Médio:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Médio Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(48, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Superior Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Superior:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Pós-graduação:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(23, 5, iconv('utf-8', 'iso-8859-1', 'Religião*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'Profissão*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'CPF*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
    }

    function DadosEscola() {
        //       $this->Ln(5);
//        $this->SetFont('Arial', 'BU', 13);
//        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', 'Dados da Inscrição'), 0, 0, 'C');
//        $this->Ln(6);
        $temp = '';
        $this->SetFont('Arial', 'BU', 12);
        $this->Cell(48, 5, iconv('utf-8', 'iso-8859-1', 'Unidades de Interesse:'), 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', '1ª Opção:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(150, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', '2ª Opção:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(150, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Grupo:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(150, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Unidade Educativa na qual fez a inscrição:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(100, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(70, 5, iconv('utf-8', 'iso-8859-1', 'Nome do responsável pela inscrição:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(110, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', 'Data:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(9);
        $this->Cell(155, 5, iconv('utf-8', 'iso-8859-1', '_________________________________________'), 0, 0, 'R');
        $this->Ln(5);
        $this->Cell(220, 5, iconv('utf-8', 'iso-8859-1', 'Assinatura do responsável pela inscrição'), 0, 0, 'C');
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(155, 5, iconv('utf-8', 'iso-8859-1', '_________________________________________'), 0, 0, 'R');
        $this->Ln(5);
        $this->Cell(217, 5, iconv('utf-8', 'iso-8859-1', 'Assinatura do pai, mãe ou responsável'), 0, 0, 'C');
        $this->Ln(15);
    }

    function Comprovante() {
        $this->Ln(5);
        $temp = '';
        $this->SetFont('Arial', 'BU', 13);
        $this->MultiCell(185, 5, iconv('utf-8', 'iso-8859-1', 'Comprovante de Inscrição Para o Processo de Seleção de Vaga 2014'), 0, 'C', false);
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Nome da Criança:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(150, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Grupo:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(150, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(52, 5, iconv('utf-8', 'iso-8859-1', 'Unidades de Interesse:'), 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', '1ª Opção:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(150, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', '2ª Opção:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(150, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Unidade Educativa na qual fez a inscrição:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(100, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(70, 5, iconv('utf-8', 'iso-8859-1', 'Nome do responsável pela inscrição:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(110, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', 'Data:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(20);
    }

}

$nome = '';
$sexo = '';
$dataNasc = '';
$etnia = '';
$rg = '';
$orgao = '';
$uf_rg = '';
$dt_rg = '';
$termo = '';
$folha = '';
$livro = '';
$cartorio = '';
$uf_cart = '';
$numero = '';
$pais = '';
$estado = '';
$carro = '';
$header = '';
$cidade = '';
$residencial = '';
$comercial = '';
$celular = '';
$pai = '';
$mae = '';
$resp = '';
$cep = '';
$logradouro = '';
$numeroEnd = '';
$complemento = '';
$bairro = '';
$urbana = '';
$rural = '';
$autorizaUso = null;
$contraTurno = '';
$tempoResidencia = false;
$anemia = 'naoSei';
$diabetes = 'naoSei';
$lactose = 'naoSei';
$gluten = 'naoSei';
$refluxo = 'naoSei';
$deficiencias = null;
$recursos = null;
$moradia = 'propria';
$bolsaFamilia = null;
$possuiComputador = null;
$localAcesso = null;

$html = 'Os campos marcados com um asterisco (*) são de preenchimento obrigatório.';

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetFont('Arial', '', 12);
$pdf->AddPage();

// Logo
$pdf->Image('../img/logo.png', 10, 6, 30);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 13);
// Move to the right
$pdf->Cell(77);
// Title
$pdf->Cell(1, 0, iconv('utf-8', 'iso-8859-1', 'Prefeitura Municipal de Florianópolis'), 0, 0, 'C');
// Line break
$pdf->Ln(5);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(142, 0, iconv('utf-8', 'iso-8859-1', 'Secretaria Municipal de Educação'), 0, 0, 'C');
// Line break
$pdf->Ln(5);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(133, 0, iconv('utf-8', 'iso-8859-1', 'Sistema de Gerenciamento Escolar'), 0, 0, 'C');
// Line break
$pdf->Ln(10);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 0, iconv('utf-8', 'iso-8859-1', 'Formulário de Cadastro de Aluno - Educação Infantil (Intenção)'), 0, 0, 'C');
$pdf->Ln(10);
// Line break
$pdf->Cell(188, 0, iconv('utf-8', 'iso-8859-1', $html), 0, 0, 'C');
$pdf->Ln(6);
$pdf->SetFont('Arial', 'BU', 14);
$pdf->Cell(40, 0, iconv('utf-8', 'iso-8859-1', 'Dados do Aluno:'), 0, 0, 'C');
$pdf->Ln(6);
$pdf->DadosAluno($nome, $sexo, $dataNasc, $etnia);
$pdf->Ln(6);
$pdf->NacionalidadeNaturalidade($pais, $estado, $cidade);
$pdf->Ln(6);
$pdf->ComQuemMora($pai, $mae, $resp);
$pdf->Ln(6);
$pdf->QuemAcompanha($pai, '', $resp);
$pdf->Ln(6);
$pdf->JaFrequenta();
$pdf->Ln(6);
$pdf->RgAluno($rg, $orgao, $uf_rg, $dt_rg);
$pdf->Ln(6);
$pdf->CertidaoVelha($termo, $folha, $livro, $cartorio, $uf_cart);
$pdf->Ln(6);
$pdf->CertidaoNova($numero);
$pdf->Ln(6);
$pdf->Telefones($residencial, $celular, $comercial);
$pdf->Ln(6);
$pdf->Endereco($cep, $logradouro, $numeroEnd, $complemento, $bairro);
$pdf->Ln(6);
$pdf->outrosDados($urbana, $rural, $autorizaUso, $bolsaFamilia, $contraTurno, $possuiComputador, $localAcesso, $tempoResidencia);
$pdf->Ln(6);
$pdf->dadosSaude($anemia, $diabetes, $lactose, $gluten, $refluxo, $deficiencias, $recursos);
$pdf->Ln(6);
$pdf->CarroMoradia($carro, $moradia);
$pdf->Ln(6);
$pdf->DadosMae($nome, $sexo, $dataNasc, $etnia);
$pdf->Ln(6);
$pdf->Endereco($cep, $logradouro, $numeroEnd, $complemento, $bairro);
$pdf->Ln(6);
$pdf->EnderecoTrab($cep, $logradouro, $numeroEnd, $complemento, $bairro);
$pdf->Ln(6);
$pdf->Telefones($residencial, $celular, $comercial);
$pdf->Ln(6);
$pdf->DadosPai($nome, $sexo, $dataNasc, $etnia);
$pdf->Ln(6);
$pdf->Endereco($cep, $logradouro, $numeroEnd, $complemento, $bairro);
$pdf->Ln(6);
$pdf->EnderecoTrab($cep, $logradouro, $numeroEnd, $complemento, $bairro);
$pdf->Ln(6);
$pdf->Telefones($residencial, $celular, $comercial);
$pdf->Ln(12);
$pdf->DadosResponsavel($nome, $sexo, $dataNasc, $etnia);
$pdf->Ln(6);
$pdf->EnderecoTrab($cep, $logradouro, $numeroEnd, $complemento, $bairro);
$pdf->Ln(6);
$pdf->Telefones($residencial, $celular, $comercial);

$data[0] = ['', '', '', '', ''];
$data[1] = ['', '', '', '', ''];
$data[2] = ['', '', '', '', ''];
$data[3] = ['', '', '', '', ''];
$data[4] = ['', '', '', '', ''];
$data[5] = ['', '', '', '', ''];
$data[6] = ['', '', '', '', ''];
$data[7] = ['', '', '', '', ''];
$data[8] = ['', '', '', '', ''];

$pdf->Ln(6);

$pdf->SetFont('Arial', 'BU', 14);
$pdf->Cell(40, 5, iconv('utf-8', 'iso-8859-1', 'Dados de Renda:'), 0, 0, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(130, 5, '(Preencha aqui todas as pessoas que moram sob o mesmo teto junto ao aluno)', 0, 0, 'C');
$pdf->Ln(5);
$pdf->MultiCell(190, 5, iconv('utf-8', 'iso-8859-1', 'A Situação Ocupacional pode ser preenchido com os seguintes valores: 01-Carteira Assinada; 02-Autônomo; 
    03-Aposentado; 04-Mercado Informal; 05-Concursado Efetivo Estável; 06-Contrato Temporário; 07-Sem Rendimento.'), 0, 'C', false);
$pdf->MultiCell(185, 5, iconv('utf-8', 'iso-8859-1', 'A Comprovação de Rendimentos pode ser preenchido com os seguintes valores: 
    01-Contracheque; 02-Carteira Trabalho; 03-Declaração de Renda; 04-Não Existe.'), 0, 'C', false);
$pdf->Ln(2);

$pdf->FancyTable($header, $data);
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(43, 5, iconv('utf-8', 'iso-8859-1', 'Valor de Pensão*: '), 0, 0, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(45, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Valor Bolsa Família*: '), 0, 0, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(45, 5, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'C');

$pdf->Ln(6);
$pdf->DadosEscola();

$pdf->AddPage();

// Logo
$pdf->Image('../img/logo.png', 10, 6, 30);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 13);
// Move to the right
$pdf->Cell(77);
// Title
$pdf->Cell(1, 0, iconv('utf-8', 'iso-8859-1', 'Prefeitura Municipal de Florianópolis'), 0, 0, 'C');
// Line break
$pdf->Ln(5);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(142, 0, iconv('utf-8', 'iso-8859-1', 'Secretaria Municipal de Educação'), 0, 0, 'C');
// Line break
$pdf->Ln(5);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(133, 0, iconv('utf-8', 'iso-8859-1', 'Sistema de Gerenciamento Escolar'), 0, 0, 'C');
// Line break
$pdf->Ln(10);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 0, iconv('utf-8', 'iso-8859-1', 'Formulário de Cadastro de Aluno - Educação Infantil (Intenção)'), 0, 0, 'C');
$pdf->Ln(10);
// Line break
$pdf->Comprovante();

$pdf->Output();
?>