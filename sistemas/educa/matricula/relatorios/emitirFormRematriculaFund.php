<?php
error_reporting(0);
session_name('re');
session_start();

if (!isset($_SESSION['id'])) {
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

        $this->Cell(0, 10, iconv('utf-8', 'iso-8859-1', 'Página ') . $this->PageNo() . '/{nb}' . ' - Data: ' . date('d/m/Y - ').(date('H') - 3). date(':i:s'), 0, 0, 'C');
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
        $w = array(60, 30, 18, 20, 20, 38);
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
            $this->Cell($w[2], 6, $row[2], 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, $row[3], 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, $row[4], 'LR', 0, 'R', $fill);
            $this->Cell($w[5], 6, $row[5], 'LR', 0, 'R', $fill);
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
        if ($uf > 1) {
            if ($uf < 28) {
                $uf = buscaNomeEstado($uf)[2];
            }
        }
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
        if ($uf_cart > 1) {
            if ($uf_cart < 28) {
                $uf_cart = buscaNomeEstado($uf_cart)[2];
            }
        }
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
        $this->Cell(55, 5, $pais, 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(28, 5, iconv('utf-8', 'iso-8859-1', 'Naturalidade: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(55, 5, $cidade, 1, 0, 'C');
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

    function JaFrequenta($frequenta) {
        if ($frequenta) {
            $tempUm = 'X';
            $tempDois = '';
        } else {
            $tempUm = '';
            $tempDois = 'X';
        }
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(59, 5, iconv('utf-8', 'iso-8859-1', 'Ja frequenta a rede municipal: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Sim: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempUm), 1, 0, 'C');
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', 'Não: '), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
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

    function Endereco($cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf) {
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
        $this->Cell(50, 5, utf8_decode($bairro), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(21, 5, iconv('utf-8', 'iso-8859-1', 'Cidade: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(50, 5, utf8_decode($cidade), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(10, 5, iconv('utf-8', 'iso-8859-1', 'UF:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(8, 5, iconv('utf-8', 'iso-8859-1', $uf), 1, 0, 'C');
    }

    function EnderecoTrab($cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf, $turnos) {
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
        $this->Cell(50, 5, utf8_decode($bairro), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(21, 5, iconv('utf-8', 'iso-8859-1', 'Cidade: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(50, 5, utf8_decode($cidade), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(10, 5, iconv('utf-8', 'iso-8859-1', 'UF:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(8, 5, iconv('utf-8', 'iso-8859-1', $uf), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Turnos de Trabalho*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if (isset($turnos)) {
            if (in_array('mat', $turnos)) {
                $mat = 'X';
            } else {
                $mat = '';
            }
        } else {
            $mat = '';
        }
        $this->Cell(20, 5, iconv('utf-8', 'iso-8859-1', 'Matutino:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $mat), 1, 0, 'C');
        if (isset($turnos)) {
            if (in_array('ves', $turnos)) {
                $ves = 'X';
            } else {
                $ves = '';
            }
        } else {
            $ves = '';
        }
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Vespertino:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $ves), 1, 0, 'C');
        if (isset($turnos)) {
            if (in_array('not', $turnos)) {
                $not = 'X';
            } else {
                $not = '';
            }
        } else {
            $not = '';
        }
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Noturno:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $not), 1, 0, 'C');
    }

    function outrosDados($urbana, $rural, $autorizaUso, $bolsaFamilia, $contraTurno, $possuiComputador, $localAcesso, $tempoResidencia) {
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
        if ($contraTurno == 'casa') {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
        } else {
            if ($contraTurno == 'ue') {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
            } else {
                if ($contraTurno == 'outro') {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = 'X';
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
        $temp = '';
        $tempDois = '';
        $tempTres = '';
        $tempQuatro = '';
        if (isset($localAcesso)) {
            if ($localAcesso == 'casa') {
                $temp = 'X';
                $tempDois = '';
                $tempTres = '';
                $tempQuatro = '';
            } else {
                if ($localAcesso == 'trabalho') {
                    $temp = '';
                    $tempDois = 'X';
                    $tempTres = '';
                    $tempQuatro = '';
                } else {
                    if ($localAcesso == 'escola') {
                        $temp = '';
                        $tempDois = '';
                        $tempTres = 'X';
                        $tempQuatro = '';
                    } else {
                        if ($localAcesso == 'outro') {
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
            $tempDois = 'X';
        }
        $this->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Menos de 12 meses:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', 'Mais de 12 meses:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
    }

    function dadosSaude($anemia, $diabetes, $lactose, $gluten, $refluxo, $deficiencias, $recursos, $possuiDeficiencia) {
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
                    $tempTres = 'X';
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
                    $tempTres = 'X';
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
                    $tempTres = 'X';
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
                    $tempTres = 'X';
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
                    $tempTres = 'X';
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
        if ($possuiDeficiencia == 'sim') {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
        } else {
            if ($possuiDeficiencia == 'nao') {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
            } else {
                if ($possuiDeficiencia == 'naoSei') {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = 'X';
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
        if (!isset($deficiencias)) {
            $temp = '';
        } else {
            if (in_array('deficienciaFisica', $deficiencias)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(44, 5, iconv('utf-8', 'iso-8859-1', 'Deficiência Intelectual:'), 0, 0, 'C');
        if (!isset($deficiencias)) {
            $temp = '';
        } else {
            if (in_array('deficienciaIntelectual', $deficiencias)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(44, 5, iconv('utf-8', 'iso-8859-1', 'Deficiência Múltipla:'), 0, 0, 'C');
        if (!isset($deficiencias)) {
            $temp = '';
        } else {
            if (in_array('deficienciaMultipla', $deficiencias)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(27, 5, iconv('utf-8', 'iso-8859-1', 'Cegueira:   '), 0, 0, 'C');
        if (!isset($deficiencias)) {
            $temp = '';
        } else {
            if (in_array('cegueira', $deficiencias)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'Baixa Visão:'), 0, 0, 'C');
        if (!isset($deficiencias)) {
            $temp = '';
        } else {
            if (in_array('baixaVisao', $deficiencias)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(24, 5, iconv('utf-8', 'iso-8859-1', 'Surdez:'), 0, 0, 'C');
        if (!isset($deficiencias)) {
            $temp = '';
        } else {
            if (in_array('surdez', $deficiencias)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', 'Deficiência Auditiva:'), 0, 0, 'C');
        if (!isset($deficiencias)) {
            $temp = '';
        } else {
            if (in_array('deficienciaAuditiva', $deficiencias)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Surdocegueira:'), 0, 0, 'C');
        if (!isset($deficiencias)) {
            $temp = '';
        } else {
            if (in_array('surdocegueira', $deficiencias)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(79, 5, iconv('utf-8', 'iso-8859-1', 'Transtorno Global do Desenvolvimento:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Transtorno Desintegrativo da Infância:'), 0, 0, 'C');
        if (!isset($deficiencias)) {
            $temp = '';
        } else {
            if (in_array('tdi', $deficiencias)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', '', 11);
        $this->Cell(38, 5, iconv('utf-8', 'iso-8859-1', 'Autismo Infantil:   '), 0, 0, 'C');
        if (!isset($deficiencias)) {
            $temp = '';
        } else {
            if (in_array('autismoInfantil', $deficiencias)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(55, 5, iconv('utf-8', 'iso-8859-1', 'Síndrome de Asperger:'), 0, 0, 'C');
        if (!isset($deficiencias)) {
            $temp = '';
        } else {
            if (in_array('asperger', $deficiencias)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(44, 5, iconv('utf-8', 'iso-8859-1', 'Síndrome de Rett:'), 0, 0, 'C');
        if (!isset($deficiencias)) {
            $temp = '';
        } else {
            if (in_array('rett', $deficiencias)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(7);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(78, 5, iconv('utf-8', 'iso-8859-1', 'Altas habilidades ou superdotação:      '), 0, 0, 'C');
        if (!isset($deficiencias)) {
            $temp = '';
        } else {
            if (in_array('superdotado', $deficiencias)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->SetFont('Arial', '', 11);
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(7);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(144, 5, iconv('utf-8', 'iso-8859-1', 'Recursos necessários para a participação do aluno em avaliações do Inep:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Leitura labial:'), 0, 0, 'C');
        if (!isset($recursos)) {
            $temp = '';
        } else {
            if (in_array('leituraLabial', $recursos)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(7);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Auxílio ledor:    '), 0, 0, 'C');
        if (!isset($recursos)) {
            $temp = '';
        } else {
            if (in_array('auxilioLedor', $recursos)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(36, 5, iconv('utf-8', 'iso-8859-1', 'Auxílio-transcrição:'), 0, 0, 'C');
        if (!isset($recursos)) {
            $temp = '';
        } else {
            if (in_array('auxilioTranscricao', $recursos)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Guia-Intérprete:'), 0, 0, 'C');
        if (!isset($recursos)) {
            $temp = '';
        } else {
            if (in_array('guiaInterprete', $recursos)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(38, 5, iconv('utf-8', 'iso-8859-1', 'Intérprete de libras:'), 0, 0, 'C');
        if (!isset($recursos)) {
            $temp = '';
        } else {
            if (in_array('interpreteLibras', $recursos)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Ln(7);
        $this->Cell(37, 5, iconv('utf-8', 'iso-8859-1', 'Prova em braile: '), 0, 0, 'C');
        if (!isset($recursos)) {
            $temp = '';
        } else {
            if (in_array('braile', $recursos)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(42, 5, iconv('utf-8', 'iso-8859-1', 'Prova ampliada (16):'), 0, 0, 'C');
        if (!isset($recursos)) {
            $temp = '';
        } else {
            if (in_array('ampliada16', $recursos)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(42, 5, iconv('utf-8', 'iso-8859-1', 'Prova ampliada (20):'), 0, 0, 'C');
        if (!isset($recursos)) {
            $temp = '';
        } else {
            if (in_array('ampliada20', $recursos)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(42, 5, iconv('utf-8', 'iso-8859-1', 'Prova ampliada (24):'), 0, 0, 'C');
        if (!isset($recursos)) {
            $temp = '';
        } else {
            if (in_array('ampliada24', $recursos)) {
                $temp = 'X';
            } else {
                $temp = '';
            }
        }
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
        if (isset($moradia)) {
            if ($moradia == 'propria') {
                $temp = 'X';
                $tempDois = '';
                $tempTres = '';
            } else {
                if ($moradia == 'alugada') {
                    $temp = '';
                    $tempDois = 'X';
                    $tempTres = '';
                } else {
                    if ($moradia == 'outro') {
                        $temp = '';
                        $tempDois = '';
                        $tempTres = 'X';
                    }
                }
            }
        } else {
            $temp = '';
            $tempDois = '';
        }
        $this->SetFont('Arial', '', 11);
        $this->Cell(29, 5, iconv('utf-8', 'iso-8859-1', 'Casa Própria:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Alugada:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Outros:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
    }

    function DadosMae($nome, $sexo, $dataNasc, $etnia, $estadoCivil, $escolaridade, $religiao, $profissao, $cpf) {
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
        if ($estadoCivil == 1) {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
            $tempQuatro = '';
            $tempCinco = '';
        } else {
            if ($estadoCivil == 2) {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
                $tempQuatro = '';
                $tempCinco = '';
            } else {
                if ($estadoCivil == 3) {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = 'X';
                    $tempQuatro = '';
                    $tempCinco = '';
                } else {
                    if ($estadoCivil == 4) {
                        $temp = '';
                        $tempDois = '';
                        $tempTres = '';
                        $tempQuatro = 'X';
                        $tempCinco = '';
                    } else {
                        if ($estadoCivil == 5) {
                            $temp = '';
                            $tempDois = '';
                            $tempTres = '';
                            $tempQuatro = '';
                            $tempCinco = 'X';
                        } else {
                            $temp = '';
                            $tempDois = '';
                            $tempTres = '';
                            $tempQuatro = '';
                            $tempCinco = '';
                        }
                    }
                }
            }
        }
        $this->Cell(18, 5, iconv('utf-8', 'iso-8859-1', 'Solteiro:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(20, 5, iconv('utf-8', 'iso-8859-1', 'Casado:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Viúvo:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->Cell(17, 5, iconv('utf-8', 'iso-8859-1', 'Divorciado:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempQuatro), 1, 0, 'C');
        $this->Cell(27, 5, iconv('utf-8', 'iso-8859-1', 'União Estável:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempCinco), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(32, 5, iconv('utf-8', 'iso-8859-1', 'Escolaridade*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($escolaridade == 1) {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
            $tempQuatro = '';
            $tempCinco = '';
            $tempSeis = '';
            $tempSete = '';
            $tempOito = '';
        } else {
            if ($escolaridade == 2) {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
                $tempQuatro = '';
                $tempCinco = '';
                $tempSeis = '';
                $tempSete = '';
                $tempOito = '';
            } else {
                if ($escolaridade == 3) {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = 'X';
                    $tempQuatro = '';
                    $tempCinco = '';
                    $tempSeis = '';
                    $tempSete = '';
                    $tempOito = '';
                } else {
                    if ($escolaridade == 4) {
                        $temp = '';
                        $tempDois = '';
                        $tempTres = '';
                        $tempQuatro = 'X';
                        $tempCinco = '';
                        $tempSeis = '';
                        $tempSete = '';
                        $tempOito = '';
                    } else {
                        if ($escolaridade == 5) {
                            $temp = '';
                            $tempDois = '';
                            $tempTres = '';
                            $tempQuatro = '';
                            $tempCinco = 'X';
                            $tempSeis = '';
                            $tempSete = '';
                            $tempOito = '';
                        } else {
                            if ($escolaridade == 6) {
                                $temp = '';
                                $tempDois = '';
                                $tempTres = '';
                                $tempQuatro = '';
                                $tempCinco = '';
                                $tempSeis = 'X';
                                $tempSete = '';
                                $tempOito = '';
                            } else {
                                if ($escolaridade == 7) {
                                    $temp = '';
                                    $tempDois = '';
                                    $tempTres = '';
                                    $tempQuatro = '';
                                    $tempCinco = '';
                                    $tempSeis = '';
                                    $tempSete = 'X';
                                    $tempOito = '';
                                } else {
                                    if ($escolaridade == 8) {
                                        $temp = '';
                                        $tempDois = '';
                                        $tempTres = '';
                                        $tempQuatro = '';
                                        $tempCinco = '';
                                        $tempSeis = '';
                                        $tempSete = '';
                                        $tempOito = 'X';
                                    } else {
                                        $temp = '';
                                        $tempDois = '';
                                        $tempTres = '';
                                        $tempQuatro = '';
                                        $tempCinco = '';
                                        $tempSeis = '';
                                        $tempSete = '';
                                        $tempOito = '';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $this->SetFont('Arial', '', 10);
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Analfabeto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(36, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Fundamental:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->Cell(54, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Fundamental Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Médio:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempCinco), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Médio Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempQuatro), 1, 0, 'C');
        $this->Cell(48, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Superior Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempSeis), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Superior:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempSete), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Pós-graduação:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempOito), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(23, 5, iconv('utf-8', 'iso-8859-1', 'Religião*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, utf8_decode($religiao), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'Profissão*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, utf8_decode($profissao), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'CPF*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', $cpf), 1, 0, 'C');
    }

    function DadosPai($nome, $sexo, $dataNasc, $etnia, $estadoCivil, $escolaridade, $religiao, $profissao, $cpf) {
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
        $this->Cell(31, 5, iconv('utf-8', 'iso-8859-1', ($etnia)), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Estado Civil*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($estadoCivil == 1) {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
            $tempQuatro = '';
            $tempCinco = '';
        } else {
            if ($estadoCivil == 2) {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
                $tempQuatro = '';
                $tempCinco = '';
            } else {
                if ($estadoCivil == 3) {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = 'X';
                    $tempQuatro = '';
                    $tempCinco = '';
                } else {
                    if ($estadoCivil == 4) {
                        $temp = '';
                        $tempDois = '';
                        $tempTres = '';
                        $tempQuatro = 'X';
                        $tempCinco = '';
                    } else {
                        if ($estadoCivil == 5) {
                            $temp = '';
                            $tempDois = '';
                            $tempTres = '';
                            $tempQuatro = '';
                            $tempCinco = 'X';
                        } else {
                            $temp = '';
                            $tempDois = '';
                            $tempTres = '';
                            $tempQuatro = '';
                            $tempCinco = '';
                        }
                    }
                }
            }
        }
        $this->Cell(18, 5, iconv('utf-8', 'iso-8859-1', 'Solteiro:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(20, 5, iconv('utf-8', 'iso-8859-1', 'Casado:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Divorciado:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->Cell(17, 5, iconv('utf-8', 'iso-8859-1', 'Viúvo:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempQuatro), 1, 0, 'C');
        $this->Cell(27, 5, iconv('utf-8', 'iso-8859-1', 'União Estável:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempCinco), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(32, 5, iconv('utf-8', 'iso-8859-1', 'Escolaridade*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($escolaridade == 1) {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
            $tempQuatro = '';
            $tempCinco = '';
            $tempSeis = '';
            $tempSete = '';
            $tempOito = '';
        } else {
            if ($escolaridade == 2) {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
                $tempQuatro = '';
                $tempCinco = '';
                $tempSeis = '';
                $tempSete = '';
                $tempOito = '';
            } else {
                if ($escolaridade == 3) {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = 'X';
                    $tempQuatro = '';
                    $tempCinco = '';
                    $tempSeis = '';
                    $tempSete = '';
                    $tempOito = '';
                } else {
                    if ($escolaridade == 4) {
                        $temp = '';
                        $tempDois = '';
                        $tempTres = '';
                        $tempQuatro = 'X';
                        $tempCinco = '';
                        $tempSeis = '';
                        $tempSete = '';
                        $tempOito = '';
                    } else {
                        if ($escolaridade == 5) {
                            $temp = '';
                            $tempDois = '';
                            $tempTres = '';
                            $tempQuatro = '';
                            $tempCinco = 'X';
                            $tempSeis = '';
                            $tempSete = '';
                            $tempOito = '';
                        } else {
                            if ($escolaridade == 6) {
                                $temp = '';
                                $tempDois = '';
                                $tempTres = '';
                                $tempQuatro = '';
                                $tempCinco = '';
                                $tempSeis = 'X';
                                $tempSete = '';
                                $tempOito = '';
                            } else {
                                if ($escolaridade == 7) {
                                    $temp = '';
                                    $tempDois = '';
                                    $tempTres = '';
                                    $tempQuatro = '';
                                    $tempCinco = '';
                                    $tempSeis = '';
                                    $tempSete = 'X';
                                    $tempOito = '';
                                } else {
                                    if ($escolaridade == 8) {
                                        $temp = '';
                                        $tempDois = '';
                                        $tempTres = '';
                                        $tempQuatro = '';
                                        $tempCinco = '';
                                        $tempSeis = '';
                                        $tempSete = '';
                                        $tempOito = 'X';
                                    } else {
                                        $temp = '';
                                        $tempDois = '';
                                        $tempTres = '';
                                        $tempQuatro = '';
                                        $tempCinco = '';
                                        $tempSeis = '';
                                        $tempSete = '';
                                        $tempOito = '';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $this->SetFont('Arial', '', 10);
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Analfabeto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(36, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Fundamental:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->Cell(54, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Fundamental Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Médio:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempCinco), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Médio Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempQuatro), 1, 0, 'C');
        $this->Cell(48, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Superior Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempSeis), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Superior:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempSete), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Pós-graduação:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempOito), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(23, 5, iconv('utf-8', 'iso-8859-1', 'Religião*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, utf8_decode($religiao), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'Profissão*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', utf8_decode($profissao)), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'CPF*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', $cpf), 1, 0, 'C');
    }

    function DadosResponsavel($nome, $sexo, $dataNasc, $etnia, $estadoCivil, $escolaridade, $religiao, $profissao, $cpf) {
        $this->Ln(5);
        $this->SetFont('Arial', 'BU', 14);
        $this->Cell(57, 0, iconv('utf-8', 'iso-8859-1', 'Dados do Responsável:'), 0, 0, 'C');
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
        $this->Cell(31, 5, iconv('utf-8', 'iso-8859-1', ($etnia)), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Estado Civil*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($estadoCivil == 1) {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
            $tempQuatro = '';
            $tempCinco = '';
        } else {
            if ($estadoCivil == 2) {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
                $tempQuatro = '';
                $tempCinco = '';
            } else {
                if ($estadoCivil == 3) {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = 'X';
                    $tempQuatro = '';
                    $tempCinco = '';
                } else {
                    if ($estadoCivil == 4) {
                        $temp = '';
                        $tempDois = '';
                        $tempTres = '';
                        $tempQuatro = 'X';
                        $tempCinco = '';
                    } else {
                        if ($estadoCivil == 5) {
                            $temp = '';
                            $tempDois = '';
                            $tempTres = '';
                            $tempQuatro = '';
                            $tempCinco = 'X';
                        } else {
                            $temp = '';
                            $tempDois = '';
                            $tempTres = '';
                            $tempQuatro = '';
                            $tempCinco = '';
                        }
                    }
                }
            }
        }
        $this->Cell(18, 5, iconv('utf-8', 'iso-8859-1', 'Solteiro:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(20, 5, iconv('utf-8', 'iso-8859-1', 'Casado:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Divorciado:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->Cell(17, 5, iconv('utf-8', 'iso-8859-1', 'Viúvo:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempQuatro), 1, 0, 'C');
        $this->Cell(27, 5, iconv('utf-8', 'iso-8859-1', 'União Estável:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempCinco), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(32, 5, iconv('utf-8', 'iso-8859-1', 'Escolaridade*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($escolaridade == 1) {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
            $tempQuatro = '';
            $tempCinco = '';
            $tempSeis = '';
            $tempSete = '';
            $tempOito = '';
        } else {
            if ($escolaridade == 2) {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
                $tempQuatro = '';
                $tempCinco = '';
                $tempSeis = '';
                $tempSete = '';
                $tempOito = '';
            } else {
                if ($escolaridade == 3) {
                    $temp = '';
                    $tempDois = '';
                    $tempTres = 'X';
                    $tempQuatro = '';
                    $tempCinco = '';
                    $tempSeis = '';
                    $tempSete = '';
                    $tempOito = '';
                } else {
                    if ($escolaridade == 4) {
                        $temp = '';
                        $tempDois = '';
                        $tempTres = '';
                        $tempQuatro = 'X';
                        $tempCinco = '';
                        $tempSeis = '';
                        $tempSete = '';
                        $tempOito = '';
                    } else {
                        if ($escolaridade == 5) {
                            $temp = '';
                            $tempDois = '';
                            $tempTres = '';
                            $tempQuatro = '';
                            $tempCinco = 'X';
                            $tempSeis = '';
                            $tempSete = '';
                            $tempOito = '';
                        } else {
                            if ($escolaridade == 6) {
                                $temp = '';
                                $tempDois = '';
                                $tempTres = '';
                                $tempQuatro = '';
                                $tempCinco = '';
                                $tempSeis = 'X';
                                $tempSete = '';
                                $tempOito = '';
                            } else {
                                if ($escolaridade == 7) {
                                    $temp = '';
                                    $tempDois = '';
                                    $tempTres = '';
                                    $tempQuatro = '';
                                    $tempCinco = '';
                                    $tempSeis = '';
                                    $tempSete = 'X';
                                    $tempOito = '';
                                } else {
                                    if ($escolaridade == 8) {
                                        $temp = '';
                                        $tempDois = '';
                                        $tempTres = '';
                                        $tempQuatro = '';
                                        $tempCinco = '';
                                        $tempSeis = '';
                                        $tempSete = '';
                                        $tempOito = 'X';
                                    } else {
                                        $temp = '';
                                        $tempDois = '';
                                        $tempTres = '';
                                        $tempQuatro = '';
                                        $tempCinco = '';
                                        $tempSeis = '';
                                        $tempSete = '';
                                        $tempOito = '';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $this->SetFont('Arial', '', 10);
        $this->Cell(19, 5, iconv('utf-8', 'iso-8859-1', 'Analfabeto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $temp), 1, 0, 'C');
        $this->Cell(36, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Fundamental:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempTres), 1, 0, 'C');
        $this->Cell(54, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Fundamental Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempDois), 1, 0, 'C');
        $this->Cell(25, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Médio:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempCinco), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Médio Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempQuatro), 1, 0, 'C');
        $this->Cell(48, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Superior Incompleto:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempSeis), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Ensino Superior:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempSete), 1, 0, 'C');
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Pós-graduação:'), 0, 0, 'C');
        $this->Cell(5, 5, iconv('utf-8', 'iso-8859-1', $tempOito), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(23, 5, iconv('utf-8', 'iso-8859-1', 'Religião*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, utf8_decode($religiao), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'Profissão*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, utf8_decode($profissao), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'CPF*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(30, 5, $cpf, 1, 0, 'C');
    }

    function DadosTransporte($utilizou, $precisara, $numero, $tipo) {
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(48, 5, iconv('utf-8', 'iso-8859-1', 'Dados de Transporte:'), 0, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(60, 5, iconv('utf-8', 'iso-8859-1', 'Utilizou Transporte em 2013:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($utilizou == 'sim') {
            $utilizou = 'Sim';
        } else {
            $utilizou = 'Não';
        }
        $this->Cell(10, 5, iconv('utf-8', 'iso-8859-1', $utilizou), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(70, 5, iconv('utf-8', 'iso-8859-1', 'Precisará de Transporte em 2014:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($precisara == 'sim') {
            $precisara = 'Sim';
        } else {
            $precisara = 'Não';
        }
        $this->Cell(10, 5, iconv('utf-8', 'iso-8859-1', $precisara), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(43, 5, iconv('utf-8', 'iso-8859-1', 'Tipo de Transporte:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if ($tipo == 1) {
            $tipo = 'Privado';
        } else {
            if ($tipo == 2) {
                $tipo = 'Municipal';
            } else {
                if ($tipo == 3) {
                    $tipo = 'Estadual';
                } else {
                    if ($tipo == 4) {
                        $tipo = 'Federal';
                    } else {
                        if ($tipo == 5) {
                            $tipo = 'Nenhum';
                        }
                    }
                }
            }
        }
        $this->Cell(40, 5, $tipo, 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', 'Número de Transporte:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(50, 5, $numero, 1, 0, 'C');
    }

    function DadosEscola($unidadeInscricao) {
        $this->SetFont('Arial', 'BU', 12);
        $this->Cell(48, 5, iconv('utf-8', 'iso-8859-1', 'Dados de Rematrícula:'), 0, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Unidade Educativa de Rematrícula:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(100, 5, utf8_decode($unidadeInscricao), 1, 0, 'C');
        $this->Ln(6);
        include '../fnc/buscaAnoRematricula.php';
        $ano = buscaAnoRematricula($_SESSION['id']);
if ($ano[0] == 1) {
            $ano = 'Primeiro Ano';
        } else {
            if ($ano[0] == 2) {
                $ano = 'Segundo Ano';
            } else {
                if ($ano[0] == 3) {
                    $ano = 'Terceiro Ano';
                } else {
                    if ($ano[0] == 4) {
                        $ano = 'Quarto Ano';
                    } else {
                        if ($ano[0] == 5) {
                            $ano = 'Quinto Ano';
                        } else {
                            if ($ano[0] == 6) {
                                $ano = 'Sexto Ano';
                            } else {
                                if ($ano[0] == 7) {
                                    $ano = 'Sétimo Ano';
                                } else {
                                    if ($ano[0] == 8) {
                                        $ano = 'Oitavo ano';
                                    } else {
                                        if ($ano[0] == 9) {
                                            $ano = 'Nono Ano';
                                        } else {
                                            
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Ano de Rematrícula:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
   
        $this->Cell(100, 5, $ano, 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Número de Matrícula:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(100, 5, $_SESSION['usuario'], 1, 0, 'C');
        $this->Ln(12);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', ''), 0, 0, 'C');
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', '__________________________________________________'), 0, 0, 'C');
        $this->Ln(6);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', ''), 0, 0, 'C');
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', '       Assinatura do Responsável pela Criança     '), 0, 0, 'C');
        $this->Ln(12);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', ''), 0, 0, 'C');
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', '__________________________________________________'), 0, 0, 'C');
        $this->Ln(6);
        $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', ''), 0, 0, 'C');
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', '  Assinatura do Responsável na Unidade Educativa    '), 0, 0, 'C');
    }

    function Comprovante($priOpcao, $segOpcao, $unidadeInscricao, $nomePessoa) {
        $this->Ln(5);
        $this->SetFont('Arial', 'BU', 13);
        $this->MultiCell(185, 5, iconv('utf-8', 'iso-8859-1', 'Comprovante de Inscrição Para o Processo de Seleção de Vaga 2014'), 0, 'C', false);
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Nome da Criança:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(150, 5, iconv('utf-8', 'iso-8859-1', $_SESSION['dados_pessoais']['nome']), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(12, 5, iconv('utf-8', 'iso-8859-1', 'Data:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, iconv('utf-8', 'iso-8859-1', ""), 1, 0, 'C');
        $this->Ln(20);
    }

}

$nome = $_SESSION['identificacao']['nome_aluno'];
if ($_SESSION['dados_pessoais']['sexo'] == 'm') {
    $sexo = 'Masculino';
} else {
    $sexo = 'Feminino';
}
$dataNasc = $_SESSION['identificacao']['data_nascimento'];
include '../fnc/buscaEtnia.php';
$etnia = buscaEtnia($_SESSION['dados_pessoais']['etnia'])[1];
$rg = '';
$orgao = '';
$uf_rg = '';
$dt_rg = '';
if ($_SESSION['dados_pessoais']['rg']['possui'] == 'sim') {
    $rg = $_SESSION['dados_pessoais']['rg']['numero'];
    $orgao = $_SESSION['dados_pessoais']['rg']['orgao_rg'];
    $uf_rg = $_SESSION['dados_pessoais']['rg']['uf_rg'];
    $dt_rg = $_SESSION['dados_pessoais']['rg']['data_rg'];
}
$termo = '';
$folha = '';
$livro = '';
$cartorio = '';
$uf_cart = '';
$numero = '';
if ($_SESSION['dados_pessoais']['certidao']['tipo_certidao'] == 'antigo') {
    $termo = $_SESSION['dados_pessoais']['certidao']['termo'];
    $folha = $_SESSION['dados_pessoais']['certidao']['folha'];
    $livro = $_SESSION['dados_pessoais']['certidao']['livro'];
    $cartorio = $_SESSION['dados_pessoais']['certidao']['cartorio'];
    $uf_cart = $_SESSION['dados_pessoais']['certidao']['uf_cart'];
} else {
    if ($_SESSION['dados_pessoais']['certidao']['tipo_certidao'] == 'novo') {
        $numero = $_SESSION['dados_pessoais']['certidao']['numero'];
    }
}

include '../fnc/buscaNacionalidade.php';
$pais = buscaNacionalidade($_SESSION['dados_pessoais']['nacionalidade'])[1][1];
include '../fnc/buscaMunicipio.php';
include '../fnc/buscaEstado.php';
if ($pais == 'Brasil') {
    $cidade = (buscaMunicipio($_SESSION['dados_pessoais']['naturalidade']['municipio'])[1][1]);
    $estado = buscaNomeEstado($_SESSION['dados_pessoais']['naturalidade']['uf'])[2];
}

if (in_array('mae', $_SESSION['dados_pessoais']['com_quem_mora'])) {
    $cqmMae = 'X';
} else {
    $cqmMae = '';
}
if (in_array('pai', $_SESSION['dados_pessoais']['com_quem_mora'])) {
    $cqmPai = 'X';
} else {
    $cqmPai = '';
}
if (in_array('outro', $_SESSION['dados_pessoais']['com_quem_mora'])) {
    $cqmResp = 'X';
} else {
    $cqmResp = '';
}

$frequenta = true;

if ($_SESSION['dados_pessoais']['quem_acompanha'] == 'mae') {
    $qaMae = 'X';
    $qaPai = '';
    $qaResp = '';
} else {
    if ($_SESSION['dados_pessoais']['quem_acompanha'] == 'mae') {
        $qaMae = '';
        $qaPai = 'X';
        $qaResp = '';
    } else {
        $qaMae = '';
        $qaPai = '';
        $qaResp = 'X';
    }
}
$residencialAluno = '';
$comercialAluno = '';
$celularAluno = '';
if (isset($_SESSION['dados_pessoais']['telefones']['residencial'])) {
    $residencialAluno = '(' .
            $_SESSION['dados_pessoais']['telefones']['ufResidencial'] . ')' .
            $_SESSION['dados_pessoais']['telefones']['residencial'];
            if(strlen($residencialAluno) <= 4){
                $residencialAluno = '' ;
            }
}
if (isset($_SESSION['dados_pessoais']['telefones']['comercial'])) {
    $comercialAluno = '(' .
            $_SESSION['dados_pessoais']['telefones']['ufComercial'] . ')' .
            $_SESSION['dados_pessoais']['telefones']['comercial'];
            if(strlen($comercialAluno) <= 4){
                $comercialAluno = '' ;
            }
}
if (isset($_SESSION['dados_pessoais']['telefones']['celular'])) {
    $celularAluno = '(' .
            $_SESSION['dados_pessoais']['telefones']['ufCelular'] . ')' .
            $_SESSION['dados_pessoais']['telefones']['celular'];
            if(strlen($celularAluno) <= 4){
                $celularAluno = '' ;
            }
}
$cep = $_SESSION['localizacao']['cep'];
$logradouro = $_SESSION['localizacao']['logradouro'];
$numeroEnd = $_SESSION['localizacao']['numero'];
$complemento = $_SESSION['localizacao']['complemento'];
include '../fnc/buscaBairro.php';
if ($_SESSION['localizacao']['bairro']) {
    if ($_SESSION['localizacao']['bairro'] != '') {
        $id = ($_SESSION['localizacao']['bairro']);
        $bairro = buscaBairro($_SESSION['localizacao']['bairro'])[$id][1];
    }
}
$urbana = '';
$rural = '';
if ($_SESSION['outrosDados']['zona_moradia'] == 'urbana') {
    $urbana = 'X';
    $rural = '';
} else {
    $urbana = '';
    $rural = 'X';
}
if ($_SESSION['outrosDados']['autoriza_uso'] == 'sim') {
    $autorizaUso = true;
} else {
    $autorizaUso = false;
}
if ($_SESSION['outrosDados']['tempo_residencia'] < 5) {
    $tempoResidencia = true;
} else {
    $tempoResidencia = false;
}
$contraTurno = $_SESSION['outrosDados']['local_permanencia'];
$anemia = $_SESSION['saude']['outros']['anemia'];
$diabetes = $_SESSION['saude']['outros']['diabetes'];
$lactose = $_SESSION['saude']['outros']['intoleranciaLactose'];
$gluten = $_SESSION['saude']['outros']['intoleranciaGluten'];
$refluxo = $_SESSION['saude']['outros']['refluxo'];
$deficiencias = $_SESSION['saude']['deficiencias'];
$possuiDeficiencia = $_SESSION['saude']['possuiDeficiencia'];
$recursos = $_SESSION['saude']['recursos'];
$moradia = 'propria';
if ($_SESSION['outrosDados']['bolsa_familia'] == 'sim') {
    $bolsaFamilia = true;
} else {
    $bolsaFamilia = false;
}
if ($_SESSION['outrosDados']['possui_computador'] == 'sim') {
    $possuiComputador = true;
} else {
    $possuiComputador = false;
}
if ($_SESSION['outrosDados']['carro'] == 'sim') {
    $carro = true;
} else {
    $carro = false;
}
$localAcesso = strtolower($_SESSION['outrosDados']['acesso_internet']);
include '../fnc/buscaEscola.php';
include '../fnc/buscaEscolaRematricula.php';

if (isset($_SESSION['escola']['id'])) {
    $unidadeInscricao = (buscaEscola($_SESSION['escola']['id'])[$_SESSION['escola']['id']][1]);
} else {
    $unidadeInscricao = (buscaEscolaRematricula($_SESSION['id']));
$unidadeInscricao = buscaEscola($unidadeInscricao[7])[$unidadeInscricao[7]][1];
}

include '../fnc/buscaReligiao.php';
include '../fnc/buscaProfissao.php';

if (isset($_SESSION['mae'])) {
    $nomeMae = $_SESSION['mae']['nome'];
    if (isset($_SESSION['mae']['data_nascimento'])) {
        $dataNascMae = $_SESSION['mae']['data_nascimento'];
        if ($_SESSION['mae']['sexo'] == 'm') {
            $sexoMae = 'Masculino';
        } else {
            $sexoMae = 'Feminino';
        }
        $etniaMae = buscaEtnia($_SESSION['mae']['etnia'])[1];
        $religiaoMae = buscaReligiao($_SESSION['mae']['religiao'])[1];
        $profissaoMae = buscaProfissao($_SESSION['mae']['profissao'])[1];
        $cpfMae = $_SESSION['mae']['cpf'];

        $estadoCivilMae = $_SESSION['mae']['estado_civil'];
        $escolaridadeMae = $_SESSION['mae']['escolaridade'];
        $cepMae = $_SESSION['mae']['cep'];
        $logradouroMae = $_SESSION['mae']['logradouro'];
        $numeroEndMae = $_SESSION['mae']['numero'];
        $complementoMae = $_SESSION['mae']['complemento'];
        $bairroMae = $_SESSION['mae']['bairro'];
        $cidadeMae = buscaMunicipio($_SESSION['mae']['municipio'])[1][1];
        $ufMae = buscaNomeEstado($_SESSION['mae']['estado'])[2];

        if ($_SESSION['mae']['cep_trabalho']) {
            if ($_SESSION['mae']['cep_trabalho'] != '') {
                $cepTrabalhoMae = $_SESSION['mae']['cep_trabalho'];
                $logradouroTrabalhoMae = $_SESSION['mae']['logradouro_trabalho'];
                $numeroEndTrabalhoMae = $_SESSION['mae']['numero_trabalho'];
                $complementoTrabalhoMae = $_SESSION['mae']['complemento_trabalho'];
                $bairroTrabalhoMae = $_SESSION['mae']['bairro_trabalho'];
                $cidadeTrabalhoMae = buscaMunicipio($_SESSION['mae']['municipio_trabalho'])[1][1];
                $ufTrabalhoMae = buscaNomeEstado($_SESSION['mae']['estado_trabalho'])[2];
            } else {
                $cepTrabalhoMae = '';
                $logradouroTrabalhoMae = '';
                $numeroEndTrabalhoMae = '';
                $complementoTrabalhoMae = '';
                $bairroTrabalhoMae = '';
                $cidadeTrabalhoMae = '';
                $ufTrabalhoMae = '';
            }
        } else {
            $cepTrabalhoMae = '';
            $logradouroTrabalhoMae = '';
            $numeroEndTrabalhoMae = '';
            $complementoTrabalhoMae = '';
            $bairroTrabalhoMae = '';
            $cidadeTrabalhoMae = '';
            $ufTrabalhoMae = '';
        }

        $residencialMae = '';
        $comercialMae = '';
        $celularMae = '';
        if (isset($_SESSION['mae']['telefone'])) {
            $residencialMae = '(' .
                    substr($_SESSION['mae']['telefone'], 0, 2) . ')' .
                    substr($_SESSION['mae']['telefone'], 2);
        } else {
            $residencialMae = '';
        }
        if (isset($_SESSION['mae']['comercial'])) {
            $comercialMae = '(' .
                    substr($_SESSION['mae']['comercial'], 0, 2) . ')' .
                    substr($_SESSION['mae']['comercial'], 2);
        } else {
            $comercialMae = '';
        }
        if (isset($_SESSION['mae']['celular'])) {
            $celularMae = '(' .
                    substr($_SESSION['mae']['celular'], 0, 2) . ')' .
                    substr($_SESSION['mae']['celular'], 2);
        } else {
            $celularMae = '';
        }
        $turnosMae = $_SESSION['mae']['turnos'];
    } else {
        $nomeMae = '';
        $dataNascMae = '';
        $sexoMae = '';
        $etniaMae = '';
        $religiaoMae = '';
        $profissaoMae = '';
        $cpfMae = '';
        $estadoCivilMae = '';
        $escolaridadeMae = '';
        $cepMae = '';
        $logradouroMae = '';
        $numeroEndMae = '';
        $complementoMae = '';
        $bairroMae = '';
        $cepTrabalhoMae = '';
        $logradouroTrabalhoMae = '';
        $numeroEndTrabalhoMae = '';
        $complementoTrabalhoMae = '';
        $bairroTrabalhoMae = '';
        $cidadeTrabalhoMae = '';
        $ufTrabalhoMae = '';
        $residencialMae = '';
        $comercialMae = '';
        $celularMae = '';
        $cidadeMae = '';
        $ufMae = '';
        $turnosMae = array();
    }
} else {
    $nomeMae = '';
    $dataNascMae = '';
    $sexoMae = '';
    $etniaMae = '';
    $religiaoMae = '';
    $profissaoMae = '';
    $cpfMae = '';
    $estadoCivilMae = '';
    $escolaridadeMae = '';
    $cepMae = '';
    $logradouroMae = '';
    $numeroEndMae = '';
    $complementoMae = '';
    $bairroMae = '';
    $cepTrabalhoMae = '';
    $logradouroTrabalhoMae = '';
    $numeroEndTrabalhoMae = '';
    $complementoTrabalhoMae = '';
    $bairroTrabalhoMae = '';
    $cidadeTrabalhoMae = '';
    $ufTrabalhoMae = '';
    $residencialMae = '';
    $comercialMae = '';
    $celularMae = '';
    $cidadeMae = '';
    $ufMae = '';
    $turnosMae = array();
}

if (isset($_SESSION['pai'])) {
    $nomePai = $_SESSION['pai']['nome'];
    if (isset($_SESSION['pai']['data_nascimento'])) {
        $dataNascPai = $_SESSION['pai']['data_nascimento'];
        if ($_SESSION['pai']['sexo'] == 'm') {
            $sexoPai = 'Masculino';
        } else {
            $sexoPai = 'Feminino';
        }
        $etniaPai = buscaEtnia($_SESSION['pai']['etnia'])[1];
        $religiaoPai = buscaReligiao($_SESSION['pai']['religiao'])[1];
        $profissaoPai = buscaProfissao($_SESSION['pai']['profissao'])[1];
        $cpfPai = $_SESSION['pai']['cpf'];

        $estadoCivilPai = $_SESSION['pai']['estado_civil'];
        $escolaridadePai = $_SESSION['pai']['escolaridade'];
        $cepPai = $_SESSION['pai']['cep'];
        $logradouroPai = $_SESSION['pai']['logradouro'];
        $numeroEndPai = $_SESSION['pai']['numero'];
        $complementoPai = $_SESSION['pai']['complemento'];
        $bairroPai = $_SESSION['pai']['bairro'];
        $cidadePai = buscaMunicipio($_SESSION['pai']['municipio'])[1][1];
        $ufPai = buscaNomeEstado($_SESSION['pai']['estado'])[2];

        if (isset($_SESSION['pai']['cep_trabalho'])) {
            if ($_SESSION['pai']['cep_trabalho'] != '') {
                $cepTrabalhoPai = $_SESSION['pai']['cep_trabalho'];
                $logradouroTrabalhoPai = $_SESSION['pai']['logradouro_trabalho'];
                $numeroEndTrabalhoPai = $_SESSION['pai']['numero_trabalho'];
                $complementoTrabalhoPai = $_SESSION['pai']['complemento_trabalho'];
                $bairroTrabalhoPai = $_SESSION['pai']['bairro_trabalho'];
                $cidadeTrabalhoPai = buscaMunicipio($_SESSION['pai']['municipio_trabalho'])[1][1];
                $ufTrabalhoPai = buscaNomeEstado($_SESSION['pai']['estado_trabalho'])[2];
            } else {
                $cepTrabalhoPai = '';
                $logradouroTrabalhoPai = '';
                $numeroEndTrabalhoPai = '';
                $complementoTrabalhoPai = '';
                $bairroTrabalhoPai = '';
                $cidadeTrabalhoPai = '';
                $ufTrabalhoPai = '';
            }
        } else {
            $cepTrabalhoPai = '';
            $logradouroTrabalhoPai = '';
            $numeroEndTrabalhoPai = '';
            $complementoTrabalhoPai = '';
            $bairroTrabalhoPai = '';
            $cidadeTrabalhoPai = '';
            $ufTrabalhoPai = '';
        }

        $residencialPai = '';
        $comercialPai = '';
        $celularPai = '';
        if (isset($_SESSION['pai']['telefone'])) {
            $residencialPai = '(' .
                    substr($_SESSION['pai']['telefone'], 0, 2) . ')' .
                    substr($_SESSION['pai']['telefone'], 2);
        } else {
            $residencialPai = '';
        }
        if (isset($_SESSION['pai']['comercial'])) {
            $comercialPai = '(' .
                    substr($_SESSION['pai']['comercial'], 0, 2) . ')' .
                    substr($_SESSION['pai']['comercial'], 2);
        } else {
            $comercialPai = '';
        }
        if (isset($_SESSION['pai']['celular'])) {
            $celularPai = '(' .
                    substr($_SESSION['pai']['celular'], 0, 2) . ')' .
                    substr($_SESSION['pai']['celular'], 2);
        } else {
            $celularPai = '';
        }
        $turnosPai = $_SESSION['pai']['turnos'];
    } else {
        $nomePai = '';
        $dataNascPai = '';
        $sexoPai = '';
        $etniaPai = '';
        $religiaoPai = '';
        $profissaoPai = '';
        $cpfPai = '';
        $estadoCivilPai = '';
        $escolaridadePai = '';
        $cepPai = '';
        $logradouroPai = '';
        $cidadePai = '';
        $ufPai = '';
        $numeroEndPai = '';
        $complementoPai = '';
        $bairroPai = '';
        $cepTrabalhoPai = '';
        $logradouroTrabalhoPai = '';
        $numeroEndTrabalhoPai = '';
        $complementoTrabalhoPai = '';
        $bairroTrabalhoPai = '';
        $ufTrabalhoPai = '';
        $cidadeTrabalhoPai = '';
        $celularPai = '';
        $comercialPai = '';
        $residencialPai = '';
        $turnosPai = array();
    }
} else {
    $nomePai = '';
    $dataNascPai = '';
    $sexoPai = '';
    $etniaPai = '';
    $religiaoPai = '';
    $profissaoPai = '';
    $cpfPai = '';
    $estadoCivilPai = '';
    $escolaridadePai = '';
    $cepPai = '';
    $logradouroPai = '';
    $cidadePai = '';
    $ufPai = '';
    $numeroEndPai = '';
    $complementoPai = '';
    $bairroPai = '';
    $cepTrabalhoPai = '';
    $logradouroTrabalhoPai = '';
    $numeroEndTrabalhoPai = '';
    $complementoTrabalhoPai = '';
    $bairroTrabalhoPai = '';
    $ufTrabalhoPai = '';
    $cidadeTrabalhoPai = '';
    $celularPai = '';
    $comercialPai = '';
    $residencialPai = '';
    $turnosPai = array();
}

if (isset($_SESSION['responsavel'])) {
    $nomeResp = $_SESSION['responsavel']['nome'];
    if (isset($_SESSION['responsavel']['data_nascimento'])) {
        $dataNascResp = $_SESSION['responsavel']['data_nascimento'];
        if ($_SESSION['responsavel']['sexo'] == 'm') {
            $sexoResp = 'Masculino';
        } else {
            $sexoResp = 'Feminino';
        }
        $etniaResp = buscaEtnia($_SESSION['responsavel']['etnia'])[1];
        $religiaoResp = buscaReligiao($_SESSION['responsavel']['religiao'])[1];
        $profissaoResp = buscaProfissao($_SESSION['responsavel']['profissao'])[1];
        $cpfResp = $_SESSION['responsavel']['cpf'];

        $estadoCivilResp = $_SESSION['responsavel']['estado_civil'];
        $escolaridadeResp = $_SESSION['responsavel']['escolaridade'];

        if (isset($_SESSION['responsavel']['cep_trabalho'])) {
            if ($_SESSION['responsavel']['cep_trabalho'] != '') {
                $cepTrabalhoResp = $_SESSION['responsavel']['cep_trabalho'];
                $logradouroTrabalhoResp = $_SESSION['responsavel']['logradouro_trabalho'];
                $numeroEndTrabalhoResp = $_SESSION['responsavel']['numero_trabalho'];
                $complementoTrabalhoResp = $_SESSION['responsavel']['complemento_trabalho'];
                $bairroTrabalhoResp = $_SESSION['responsavel']['bairro_trabalho'];
            } else {
                $cepTrabalhoResp = '';
                $logradouroTrabalhoResp = '';
                $numeroEndTrabalhoResp = '';
                $complementoTrabalhoResp = '';
                $bairroTrabalhoResp = '';
            }
        } else {
            $cepTrabalhoResp = '';
            $logradouroTrabalhoResp = '';
            $numeroEndTrabalhoResp = '';
            $complementoTrabalhoResp = '';
            $bairroTrabalhoResp = '';
        }

        $residencialResp = '';
        $comercialResp = '';
        $celularResp = '';
        if (isset($_SESSION['responsavel']['telefone'])) {
            $residencialResp = '(' .
                    substr($_SESSION['responsavel']['telefone'], 0, 2) . ')' .
                    substr($_SESSION['responsavel']['telefone'], 2);
        } else {
            $residencialResp = '';
        }
        if (isset($_SESSION['responsavel']['comercial'])) {
            $comercialResp = '(' .
                    substr($_SESSION['responsavel']['comercial'], 0, 2) . ')' .
                    substr($_SESSION['responsavel']['comercial'], 2);
        } else {
            $comercialResp = '';
        }
        if (isset($_SESSION['responsavel']['celular'])) {
            $celularResp = '(' .
                    substr($_SESSION['responsavel']['celular'], 0, 2) . ')' .
                    substr($_SESSION['responsavel']['celular'], 2);
        } else {
            $celularResp = '';
        }

        $cidadeTrabalhoResp = buscaMunicipio($_SESSION['responsavel']['municipio_trabalho'])[1][1];
        $ufTrabalhoResp = buscaNomeEstado($_SESSION['responsavel']['estado_trabalho'])[2];
        $turnosResp = $_SESSION['responsavel']['turnos'];
    } else {
        $nomeResp = '';
        $dataNascResp = '';
        $sexoResp = '';
        $etniaResp = '';
        $religiaoResp = '';
        $profissaoResp = '';
        $cpfResp = '';
        $estadoCivilResp = '';
        $escolaridadeResp = '';
        $cepTrabalhoResp = '';
        $logradouroTrabalhoResp = '';
        $numeroEndTrabalhoResp = '';
        $complementoTrabalhoResp = '';
        $bairroTrabalhoResp = '';
        $residencialResp = '';
        $comercialResp = '';
        $ufTrabalhoResp = '';
        $cidadeTrabalhoResp = '';
        $celularResp = '';
        $turnosResp = array();
    }
} else {
    $nomeResp = '';
    $dataNascResp = '';
    $sexoResp = '';
    $etniaResp = '';
    $religiaoResp = '';
    $profissaoResp = '';
    $cpfResp = '';
    $estadoCivilResp = '';
    $escolaridadeResp = '';
    $cepTrabalhoResp = '';
    $logradouroTrabalhoResp = '';
    $numeroEndTrabalhoResp = '';
    $complementoTrabalhoResp = '';
    $bairroTrabalhoResp = '';
    $residencialResp = '';
    $comercialResp = '';
    $ufTrabalhoResp = '';
    $cidadeTrabalhoResp = '';
    $celularResp = '';
    $turnosResp = array();
}

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
$pdf->Cell(0, 0, iconv('utf-8', 'iso-8859-1', 'Formulário de Rematrícula de Aluno - Educação Fundamental'), 0, 0, 'C');
$pdf->Ln(10);
// Line break
$pdf->Cell(188, 0, iconv('utf-8', 'iso-8859-1', $html), 0, 0, 'C');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'BU', 14);
$pdf->Cell(40, 0, iconv('utf-8', 'iso-8859-1', 'Dados do Aluno:'), 0, 0, 'C');
$pdf->Ln(6);
$pdf->DadosAluno($nome, $sexo, $dataNasc, $etnia);
$pdf->Ln(6);
if (!isset($estado)) {
    $estado = "";
}
if (!isset($cidade)) {
    $cidade = "";
}
$pdf->NacionalidadeNaturalidade($pais, $estado, $cidade);
$pdf->Ln(6);
$pdf->ComQuemMora($cqmPai, $cqmMae, $cqmResp);
$pdf->Ln(6);
$pdf->QuemAcompanha($qaPai, $qaMae, $qaResp);
$pdf->Ln(6);
$pdf->JaFrequenta($frequenta);
$pdf->Ln(6);
$pdf->RgAluno($rg, $orgao, $uf_rg, $dt_rg);
$pdf->Ln(6);
$pdf->CertidaoVelha($termo, $folha, $livro, $cartorio, $uf_cart);
$pdf->Ln(6);
$pdf->CertidaoNova($numero);
$pdf->Ln(6);
$pdf->Telefones($residencialAluno, $celularAluno, $comercialAluno);
$pdf->Ln(6);
$pdf->Endereco($cep, $logradouro, $numeroEnd, $complemento, $bairro, 'Florianópolis', "SC");
$pdf->Ln(6);
$pdf->outrosDados($urbana, $rural, $autorizaUso, $bolsaFamilia, $contraTurno, $possuiComputador, $localAcesso, $tempoResidencia);
$pdf->Ln(6);
if (isset($_SESSION['outrosDados']['utilizou_transporte'])) {
    $utilizou = $_SESSION['outrosDados']['utilizou_transporte'];
} else {
    $utilizou = 'nao';
}
if (isset($_SESSION['outrosDados']['precisara_transporte'])) {
    $precisara = $_SESSION['outrosDados']['precisara_transporte'];
} else {
    $precisara = 'nao';
}
if (isset($_SESSION['outrosDados']['numero_cartao_transporte'])) {
    $numeroTrans = $_SESSION['outrosDados']['numero_cartao_transporte'];
} else {
    $numeroTrans = '';
}
if (isset($_SESSION['outrosDados']['tipo_transporte'])) {
    $tipoRede = $_SESSION['outrosDados']['tipo_transporte'];
} else {
    $tipoRede = '';
}

$pdf->CarroMoradia($carro, $moradia);
$pdf->Ln(6);
$pdf->DadosTransporte($utilizou, $precisara, $numeroTrans, $tipoRede);
$pdf->Ln(6);
$pdf->dadosSaude($anemia, $diabetes, $lactose, $gluten, $refluxo, $deficiencias, $recursos, $possuiDeficiencia);
$pdf->Ln(6);
$pdf->DadosMae($nomeMae, $sexoMae, $dataNascMae, $etniaMae, $estadoCivilMae, $escolaridadeMae, $religiaoMae, $profissaoMae, $cpfMae);
$pdf->Ln(6);
$pdf->Telefones($residencialMae, $celularMae, $comercialMae);
$pdf->Ln(6);
if ($bairroMae != '') {
    $bairroMae = buscaBairro($bairroMae)[$bairroMae][1];
}
$pdf->Endereco($cepMae, $logradouroMae, $numeroEndMae, $complementoMae, $bairroMae, $cidadeMae, $ufMae);
$pdf->Ln(6);
if ($bairroTrabalhoMae != '') {
    $bairroTrabalhoMae = buscaBairro($bairroTrabalhoMae)[$bairroTrabalhoMae][1];
}
$pdf->EnderecoTrab($cepTrabalhoMae, $logradouroTrabalhoMae, $numeroEndTrabalhoMae, $complementoTrabalhoMae, $bairroTrabalhoMae, $cidadeTrabalhoMae, $ufTrabalhoMae, $turnosMae);
$pdf->Ln(6);
$pdf->DadosPai($nomePai, $sexoPai, $dataNascPai, $etniaPai, $estadoCivilPai, $escolaridadePai, $religiaoPai, $profissaoPai, $cpfPai);
$pdf->Ln(6);
$pdf->Telefones($residencialPai, $celularPai, $comercialPai);
$pdf->Ln(6);
if ($bairroPai != '') {
    $bairroPai = buscaBairro($bairroPai)[$bairroPai][1];
}
$pdf->Endereco($cepPai, $logradouroPai, $numeroEndPai, $complementoPai, $bairroPai, $cidadePai, $ufPai);
$pdf->Ln(6);
if (isset($bairroTrabalhoPai)) {
    if ($bairroTrabalhoPai != '') {
        $bairroTrabalhoPai = buscaBairro($bairroTrabalhoPai)[$bairroTrabalhoPai][1];
    }
}
$pdf->EnderecoTrab($cepTrabalhoPai, $logradouroTrabalhoPai, $numeroEndTrabalhoPai, $complementoTrabalhoPai, $bairroTrabalhoPai, $cidadeTrabalhoPai, $ufTrabalhoPai, $turnosPai);
$pdf->Ln(6);
$pdf->DadosResponsavel($nomeResp, $sexoResp, $dataNascResp, $etniaResp, $estadoCivilResp, $escolaridadeResp, $religiaoResp, $profissaoResp, $cpfResp);
$pdf->Ln(6);
$pdf->Telefones($residencialResp, $celularResp, $comercialResp);
$pdf->Ln(6);
if ($bairroTrabalhoResp != '') {
    $bairroTrabalhoResp = buscaBairro($bairroTrabalhoResp)[$bairroTrabalhoResp][1];
}
$pdf->EnderecoTrab($cepTrabalhoResp, $logradouroTrabalhoResp, $numeroEndTrabalhoResp, $complementoTrabalhoResp, $bairroTrabalhoResp, $cidadeTrabalhoResp, $ufTrabalhoResp, $turnosResp);

include '../fnc/buscaSituacaoOcupacional.php';
include '../fnc/buscaComprovacao.php';

foreach ($_SESSION['renda']['pessoas'] as $key => $value) {
    $data[$key] = [$value[0], buscaSituacaoOcupacional($value[1])[1], utf8_decode($value[4]), $value[3], $value[2], buscaComprovacao($value[5])[1]];
}

$pdf->Ln(6);

$pdf->SetFont('Arial', 'BU', 14);
$pdf->Cell(40, 5, iconv('utf-8', 'iso-8859-1', 'Dados de Renda:'), 0, 0, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(130, 5, '(Preencha aqui todas as pessoas que moram sob o mesmo teto junto ao aluno)', 0, 0, 'C');
$pdf->Ln(5);
$pdf->MultiCell(190, 5, iconv('utf-8', 'iso-8859-1', 'A Situação Ocupacional pode ser preenchido com: 01-Carteira Assinada; 02-Autônomo; 03-Aposentado; 04-Mercado Informal;
    05-Concursado Efetivo Estável; 06-Contrato Temporário; 07-Sem Rendimento; 08-Desempregado; 09-Pensionista.'), 0, 'C', false);
$pdf->MultiCell(185, 5, iconv('utf-8', 'iso-8859-1', 'A Comprovação de Rendimentos pode ser preenchido com os seguintes valores: 01-Contracheque; 
    02-Carteira Trabalho; 03-Declaração de Renda; 04-Não Existe; 05-Auxílio Doença; 06-Seguro Desemprego; 07-Doação.'), 0, 'C', false);
$pdf->Ln(2);
$header = '';
$pdf->FancyTable($header, $data);
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(43, 5, iconv('utf-8', 'iso-8859-1', 'Valor de Pensão*: '), 0, 0, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(45, 5, iconv('utf-8', 'iso-8859-1', $_SESSION['renda']['pensao']), 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Valor Bolsa Família*: '), 0, 0, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(45, 5, iconv('utf-8', 'iso-8859-1', $_SESSION['renda']['bolsa']), 1, 0, 'C');

$pdf->Ln(6);
$pdf->DadosEscola($unidadeInscricao);

$pdf->Output();
?>