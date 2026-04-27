<?php
error_reporting(0);
session_name('ma');
session_start();


/*if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
}*/

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

        date_default_timezone_set('America/Sao_Paulo');
        $this->Cell(0, 10, iconv('utf-8', 'iso-8859-1', 'Página ') . $this->PageNo() . '/{nb}' . ' - Data: ' . date('d/m/Y - ').(date('H')). date(':i:s'), 0, 0, 'C');
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
	
	function EscolaAnterior($ano, $escola, $uf, $municipio, $rede) {
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Escola Anterior:'), 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(18, 5, iconv('utf-8', 'iso-8859-1', 'Ano*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', $ano), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', 'Escola*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(107, 5, iconv('utf-8', 'iso-8859-1', $escola), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(14, 5, iconv('utf-8', 'iso-8859-1', 'UF: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', $uf), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(31, 5, iconv('utf-8', 'iso-8859-1', 'Município: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(49, 5, iconv('utf-8', 'iso-8859-1', $municipio), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
		$this->Ln(6);
        $this->Cell(39, 5, iconv('utf-8', 'iso-8859-1', 'Rede da Escola*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(50, 5, utf8_decode($rede), 1, 0, 'C');
    }
	
	function NovaEscola($escolaNova, $anoNova, $possuiIrmaos, $motivo) {
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(28, 5, iconv('utf-8', 'iso-8859-1', 'Nova Escola:'), 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(23, 5, iconv('utf-8', 'iso-8859-1', 'Escola*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(90, 5, iconv('utf-8', 'iso-8859-1', $escolaNova), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(20, 5, iconv('utf-8', 'iso-8859-1', 'Ano*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', $anoNova), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Possui Irmãos: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(15, 5, iconv('utf-8', 'iso-8859-1', $possuiIrmaos), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(46, 5, iconv('utf-8', 'iso-8859-1', 'Motivo da Escolha: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(55, 5, iconv('utf-8', 'iso-8859-1', $motivo), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Número de Matrícula:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        include_once '../fnc/buscaInscricao.php';
        $this->Cell(100, 5, buscaInscricao($_SESSION['aluno']['id'])[0], 1, 0, 'C');
               
    }

    function DadosEscola($unidadeInscricao) {
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
    if ($_SESSION['dados_pessoais']['quem_acompanha'] == 'pai') {
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
include '../fnc/listaDeAnosAnterior.php';
$ano = $_SESSION['escola']['escolaAnterior']['ano'];

['Nenhuma', 'Educação Infantil', '1&ordm; Ano', '2&ordm; Ano', '3&ordm; Ano', '4&ordm; Ano', '5&ordm; Ano',
            '6&ordm; Ano', '7&ordm; Ano', '8&ordm; Ano', '9&ordm; Ano'];
			
if ($ano == 0) {
            $ano = 'Nenhuma';
        } else {
            if ($ano == 1) {
                $ano = 'Educação Infantil';
            } else {
                if ($ano == 2) {
                    $ano = '1º Ano';
                } else {
                    if ($ano == 3) {
                        $ano = '2º Ano';
                    } else {
                        if ($ano == 4) {
                            $ano = '3º Ano';
                        } else {
                            if ($ano == 5) {
                                $ano = '4º Ano';
                            } else {
                                if ($ano == 6) {
                                    $ano = '5º Ano';
                                } else {
                                    if ($ano == 7) {
                                        $ano = '6º Ano';
                                    } else {
                                        if ($ano == 8) {
                                            $ano = '7º Ano';
										} else {
											if ($ano == 9) {
												$ano = '8º Ano';
											} else {
												$ano = '9º Ano';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
	}

if($ano != 'Nenhuma'){
$escola = $_SESSION['escola']['escolaAnterior']['nome'];

$municipio = buscaMunicipio($_SESSION['escola']['escolaAnterior']['municipio'])[1][1];

$uf = buscaNomeEstado($_SESSION['escola']['escolaAnterior']['uf'])[2];

include '../fnc/buscaRede.php';
$rede = buscaRede($_SESSION['escola']['escolaAnterior']['rede'])[1];
} else {
    $escola = '';
    $municipio = '';
    $uf = '';
    $rede = '';
}
include '../fnc/buscaEscola.php';
$escolaNova = buscaEscola($_SESSION['escola']['novaEscola']['id_escola'])[$_SESSION['escola']['novaEscola']['id_escola']][1];

include '../fnc/buscaAno.php';
$anoNova = buscaAno($_SESSION['escola']['novaEscola']['ano'], $_SESSION['curso'], $_SESSION['escola']['novaEscola']['id_escola'], $_SESSION['id_periodo'], $_SESSION['periodo_ano'])[1];

if($_SESSION['escola']['novaEscola']['possui_irmaos'] == 'sim'){
$possuiIrmaos = 'Sim';
}

include '../fnc/buscaMotivo.php';
$motivo = buscaMotivo($_SESSION['escola']['novaEscola']['motivo'])[1];


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
$pdf->Cell(0, 0, iconv('utf-8', 'iso-8859-1', 'Formulário de Intenção de Matrícula - Educação Fundamental'), 0, 0, 'C');
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
$pdf->EscolaAnterior($ano, $escola, $uf, $municipio, $rede);
$pdf->Ln(6);
$pdf->NovaEscola($escolaNova, $anoNova, $possuiIrmaos, $motivo);
$pdf->Ln(6);


$pdf->Ln(6);
$pdf->DadosEscola($unidadeInscricao);

$pdf->Output();
?>