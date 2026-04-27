<?php
error_reporting(0);
session_name('ga');
session_start();

//EXPIRA A SESSAO SE NAO HOUVE ATIVIDADE NOS ULTIMOS 30 MINUTOS
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();


if(!isset($_GET['idAluno'])){
    header('Location: ../opcoes.php');
}

unset($dados);

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
            $this->SetFont('Arial','', 7);
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->SetFont('Arial','', 9);
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
            	$buscaNomeEstado = buscaNomeEstado($uf);
                $uf = $buscaNomeEstado[2];
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
            	$buscaNomeEstado = buscaNomeEstado($uf_cart);
                $uf_cart = $buscaNomeEstado[2];
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
        $this->Cell(55, 5, utf8_decode($cidade), 1, 0, 'C');
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
        $this->SetFont('Arial', '', 9);
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
        $this->SetFont('Arial', '', 9);
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

    function outrosDados($urbana, $rural, $autorizaUso, $bolsaFamilia, $contraTurno, $possuiComputador, $localAcesso, $tempoResidencia, $transporte, $numTransporte) {
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
            if ($autorizaUso == true) {
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
        
        $this->Cell(60, 5, iconv('utf-8', 'iso-8859-1', 'Número do Cartão Transporte:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(60, 5, iconv('utf-8', 'iso-8859-1', $numTransporte), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(60, 5, iconv('utf-8', 'iso-8859-1', 'Precisará de transporte em 2014?*:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        if (isset($transporte)) {
            if ($transporte == true) {
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
        $temp = '';
        $tempDois = '';
        $tempTres = '';
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

    function dadosSaude($anemia, $diabetes, $lactose, $gluten, $refluxo, $deficiencias, $recursos, $possuiDeficiencia, $alergia, $desAlergia, $encaminha) {

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
        $this->SetFont('Arial', 'B', 10);
        $this->Ln(6);
        $this->Cell(175, 5, iconv('utf-8', 'iso-8859-1', 'Em caso de acidente/emergência, autorizo a Unidade Educativa encaminhar a criança/adolescente'), 0, 0, 'C');
        $this->Ln(6);
        $this->Cell(130, 5, iconv('utf-8', 'iso-8859-1', 'para receber o devido atendimento fora do estabelecimento de ensino.*:'), 0, 0, 'C');
        $this->Cell(10, 5, iconv('utf-8', 'iso-8859-1', $encaminha), 1, 0, 'C');
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
        $this->Cell(22, 5, iconv('utf-8', 'iso-8859-1', 'Alergia*:'), 0, 0, 'C');

        $this->SetFont('Arial', '', 11);
        if ($alergia == 'sim') {
            $temp = 'X';
            $tempDois = '';
            $tempTres = '';
        } else {
            if ($alergia == 'nao') {
                $temp = '';
                $tempDois = 'X';
                $tempTres = '';
            } else {
                if ($alergia == 'naoSei') {
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
        $this->Cell(28, 5, iconv('utf-8', 'iso-8859-1', 'Qual alergia:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(150, 5, iconv('utf-8', 'iso-8859-1', $desAlergia), 1, 0, 'C');
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
        $this->Cell(52, 5, utf8_decode($religiao), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'Profissão*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, utf8_decode($profissao), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(16, 5, iconv('utf-8', 'iso-8859-1', 'CPF*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(27, 5, iconv('utf-8', 'iso-8859-1', $cpf), 1, 0, 'C');
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
        $this->Cell(52, 5, utf8_decode($religiao), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'Profissão*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, utf8_decode($profissao), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(16, 5, iconv('utf-8', 'iso-8859-1', 'CPF*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(27, 5, iconv('utf-8', 'iso-8859-1', $cpf), 1, 0, 'C');
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
        $this->Cell(52, 5, utf8_decode($religiao), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(26, 5, iconv('utf-8', 'iso-8859-1', 'Profissão*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(40, 5, utf8_decode($profissao), 1, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(16, 5, iconv('utf-8', 'iso-8859-1', 'CPF*: '), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(27, 5, iconv('utf-8', 'iso-8859-1', $cpf), 1, 0, 'C');
    }

    function DadosEscola($unidadeInscricao) {
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(43, 5, iconv('utf-8', 'iso-8859-1', 'Dados de Matrícula:'), 0, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Unidade Educativa de Matrícula:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(100, 5, utf8_decode($unidadeInscricao), 1, 0, 'C');
        $this->Ln(6);
        include_once '../fnc/buscaAnoRematricula.php';
        $ano = buscaAnoRematricula($_GET['idAluno']);
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
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Ano de Matrícula:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);

        $this->Cell(100, 5, utf8_decode($ano), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Número de Matrícula:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        include_once '../fnc/buscaInscricao.php';
		$buscaInscricao = buscaInscricao($_GET['idAluno']);
        $this->Cell(100, 5, $buscaInscricao[0], 1, 0, 'C');
        $this->Ln(6);
        // $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', ''), 0, 0, 'C');
        // $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', '__________________________________________________'), 0, 0, 'C');
        // $this->Ln(6);
        // $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', ''), 0, 0, 'C');
        // $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', '       Assinatura do Responsável pela Criança     '), 0, 0, 'C');
        // $this->Ln(12);
        // $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', ''), 0, 0, 'C');
        // $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', '__________________________________________________'), 0, 0, 'C');
        // $this->Ln(6);
        // $this->Cell(50, 5, iconv('utf-8', 'iso-8859-1', ''), 0, 0, 'C');
        // $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', '  Assinatura do Responsável na Unidade Educativa    '), 0, 0, 'C');
    }

    function DadosIntencao($unidadeInscricao, $ano) {
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(43, 5, iconv('utf-8', 'iso-8859-1', 'Dados de Intenção:'), 0, 0, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(6);
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Unidade Educativa de Intenção:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(100, 5, utf8_decode($unidadeInscricao), 1, 0, 'C');
        $this->Ln(6);

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
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Ano de Matrícula:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);

        $this->Cell(100, 5, utf8_decode($ano), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Número de Matrícula:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        include_once '../fnc/buscaInscricao.php';
		$buscaInscricao = buscaInscricao($_GET['idAluno']);
        $this->Cell(100, 5, $buscaInscricao[0], 1, 0, 'C');
        $this->Ln(6);
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


    function Comprovante($priOpcao, $segOpcao, $unidadeInscricao, $nomePessoa, $grupo, $nomeAluno) {
        $this->Ln(5);
        $this->SetFont('Arial', 'BU', 13);
        $this->MultiCell(185, 5, iconv('utf-8', 'iso-8859-1', 'Comprovante de Inscrição Para o Processo de Seleção de Vaga 2014'), 0, 'C', false);
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Nome da Criança:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(150, 5, iconv('utf-8', 'iso-8859-1', $nomeAluno), 1, 0, 'C');
        $this->Ln(6);
        $this->Cell(35, 5, iconv('utf-8', 'iso-8859-1', 'Grupo:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(150, 5, iconv('utf-8', 'iso-8859-1', $grupo), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'BU', 13);
        $this->Cell(52, 5, iconv('utf-8', 'iso-8859-1', 'Unidades de Interesse:'), 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', '1ª Opção:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(150, 5, utf8_decode($priOpcao), 1, 0, 'C');
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 11);
        if (isset($segOpcao)) {
            $this->Cell(30, 5, iconv('utf-8', 'iso-8859-1', '2ª Opção:'), 0, 0, 'C');
            $this->SetFont('Arial', '', 11);
            $this->Cell(150, 5, iconv('utf-8', 'iso-8859-1', $segOpcao), 1, 0, 'C');
            $this->Ln(6);
        }
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(70, 5, iconv('utf-8', 'iso-8859-1', 'Nome do responsável pela inscrição:'), 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(110, 5, utf8_decode($nomePessoa[0]), 1, 0, 'C');
        $this->Ln(20);
    }

}


include_once '../fnc/buscaAluno.php';
$aluno = buscaAluno($_GET['idAluno']);

include_once '../fnc/buscaInfoAluno.php';
$infoAluno = buscaInfoAluno($_GET['idAluno']);

$dados['dados_pessoais']['nome'] = $aluno[0];
$data = explode('-', $aluno[1]);
$dados['dados_pessoais']['data_nascimento'] = $data[2].'/'.$data[1].'/'.$data[0];

$dados['dados_pessoais']['sexo'] = $infoAluno[0];
$dados['dados_pessoais']['etnia'] = $infoAluno[1];

$nome = $dados['dados_pessoais']['nome'];
if (strtolower($dados['dados_pessoais']['sexo']) == 'm') {
    $sexo = 'Masculino';
} else {
    if (strtolower($dados['dados_pessoais']['sexo']) == 'f') {
        $sexo = 'Feminino';
    } else { 
        $sexo = '';
    }
}

$dataNasc = $dados['dados_pessoais']['data_nascimento'];
include '../fnc/buscaEtnia.php';
$buscaEtnia = buscaEtnia($dados['dados_pessoais']['etnia']);
$etnia = $buscaEtnia[1];

include_once '../fnc/buscaDocumento.php';
$rgAluno = buscaDocumento($_GET['idAluno'], 1);
if($rgAluno != false){
    $dados['dados_pessoais']['rg']['possui'] = 'sim';
    $dados['dados_pessoais']['rg']['numero'] = $rgAluno[3];
    $temp32 = explode('/', $rgAluno[4]);
    $dados['dados_pessoais']['rg']['orgao_rg'] = $temp32[0];
    $dados['dados_pessoais']['rg']['uf_rg'] = $temp32[1];
    $temp32 = explode('-', $rgAluno[5]);
    $dados['dados_pessoais']['rg']['data_rg'] = $data[2].'/'.$data[1].'/'.$data[0];
} else {
    $dados['dados_pessoais']['rg']['possui'] = 'nao';
}

$rg = '';
$orgao = '';
$uf_rg = '';
$dt_rg = '';
if ($dados['dados_pessoais']['rg']['possui'] == 'sim') {
    $rg = $dados['dados_pessoais']['rg']['numero'];
    $orgao = $dados['dados_pessoais']['rg']['orgao_rg'];
    $uf_rg = $dados['dados_pessoais']['rg']['uf_rg'];
    $dt_rg = $dados['dados_pessoais']['rg']['data_rg'];
}


$certAluno = buscaDocumento($_GET['idAluno'], 2);

if($certAluno != false){
    $dados['dados_pessoais']['certidao']['tipo_certidao'] = 'novo';
    $dados['dados_pessoais']['certidao']['numero'] = $certAluno[3];
}

$certAluno = buscaDocumento($_GET['idAluno'], 4);
if($certAluno != false){
    $dados['dados_pessoais']['certidao']['tipo_certidao'] = 'antigo';
    $dados['dados_pessoais']['certidao']['termo'] = $certAluno[3];
    $folha = $dados['dados_pessoais']['certidao']['folha'] = $certAluno[6];
    $livro = $dados['dados_pessoais']['certidao']['livro'] = $certAluno[7];
    $cartorio = $dados['dados_pessoais']['certidao']['cartorio'] = $certAluno[8];
    $uf_cart = $dados['dados_pessoais']['certidao']['uf_cart'] = $certAluno[9];
}

$termo = '';
$folha = '';
$livro = '';
$cartorio = '';
$uf_cart = '';
$numero = '';
if ($dados['dados_pessoais']['certidao']['tipo_certidao'] == 'antigo') {
    $termo = $dados['dados_pessoais']['certidao']['termo'];
    $folha = $dados['dados_pessoais']['certidao']['folha'];
    $livro = $dados['dados_pessoais']['certidao']['livro'];
    $cartorio = $dados['dados_pessoais']['certidao']['cartorio'];
    $uf_cart = $dados['dados_pessoais']['certidao']['uf_cart'];
} else {
    if ($dados['dados_pessoais']['certidao']['tipo_certidao'] == 'novo') {
        $numero = $dados['dados_pessoais']['certidao']['numero'];
    }
}
include '../fnc/buscaNacionalidade.php';
$dados['dados_pessoais']['nacionalidade'] = $infoAluno[2];
$buscaNacionalidade = buscaNacionalidade($dados['dados_pessoais']['nacionalidade']);
$pais = $buscaNacionalidade[1][1];
include '../fnc/buscaMunicipio.php';
include '../fnc/buscaEstado.php';
if ($pais == 'Brasil') {
    $dados['dados_pessoais']['naturalidade']['municipio'] = $infoAluno[3];
    $dados['dados_pessoais']['naturalidade']['uf'] = $infoAluno[4];
	
	$buscaMunicipio = buscaMunicipio($dados['dados_pessoais']['naturalidade']['municipio']);
	$buscaNomeEstado = buscaNomeEstado($dados['dados_pessoais']['naturalidade']['uf']);
    $cidade = $buscaMunicipio[1][1];
    $estado = $buscaNomeEstado[2];
}

include_once '../fnc/buscaComQuemMora.php';
$cqm = buscaComQuemMora($_GET['idAluno']);

$dados['dados_pessoais']['com_quem_mora'] = array();

if($cqm != false){
    foreach ($cqm as $key => $value) {
        if($value[3] == 1){
            if($value[2] == 1){
                array_push($dados['dados_pessoais']['com_quem_mora'], 'mae');
            }
            if($value[2] == 2){
                array_push($dados['dados_pessoais']['com_quem_mora'], 'pai');
            }
            if($value[2] == 3){
                array_push($dados['dados_pessoais']['com_quem_mora'], 'outro');
            }
        }
    }
}

if (in_array('mae', $dados['dados_pessoais']['com_quem_mora'])) {
    $cqmMae = 'X';
} else {
    $cqmMae = '';
}
if (in_array('pai', $dados['dados_pessoais']['com_quem_mora'])) {
    $cqmPai = 'X';
} else {
    $cqmPai = '';
}
if (in_array('outro', $dados['dados_pessoais']['com_quem_mora'])) {
    $cqmResp = 'X';
} else {
    $cqmResp = '';
}

include_once '../fnc/buscaQuemAcompanha.php';
$qa = buscaQuemAcompanha($_GET['idAluno']);

if($qa != false){
    if($qa[0][2] == 1){
        $dados['dados_pessoais']['quem_acompanha'] = 'mae';
    }
    if($qa[0][2] == 2){
        $dados['dados_pessoais']['quem_acompanha'] = 'pai';
    }
    if($qa[0][2] == 3){
        $dados['dados_pessoais']['quem_acompanha'] = 'outro';
    }
} else {
    $dados['dados_pessoais']['quem_acompanha'] = 'Nenhum';
}

if ($dados['dados_pessoais']['quem_acompanha'] == 'mae') {
    $qaMae = 'X';
    $qaPai = '';
    $qaResp = '';
} else {
    if ($dados['dados_pessoais']['quem_acompanha'] == 'pai') {
        $qaMae = '';
        $qaPai = 'X';
        $qaResp = '';
    } else {
        if ($dados['dados_pessoais']['quem_acompanha'] == 'outro') {
            $qaMae = '';
            $qaPai = '';
            $qaResp = 'X';
        } else {
            $qaMae = '';
            $qaPai = '';
            $qaResp = '';
        }
    }
}

$residencialAluno = '';
$comercialAluno = '';
$celularAluno = '';


include_once '../fnc/buscaTel.php';
$telefones2 = buscaTel($_GET['idAluno']);
if (isset($telefones2[1])) {
    $dados['dados_pessoais']['telefones']['celular'] = $telefones2[1][3] . $telefones2[1][4];
}
if (isset($telefones2[2])) {
    $dados['dados_pessoais']['telefones']['comercial'] = $telefones2[2][3] . $telefones2[2][4];
}
if (isset($telefones2[3])) {
    $dados['dados_pessoais']['telefones']['residencial'] = $telefones2[3][3] . $telefones2[3][4];
}

if (isset($dados['dados_pessoais']['telefones']['residencial'])) {
    $residencialAluno = '(' .
        substr($dados['dados_pessoais']['telefones']['residencial'], 0, 2) . ')' .
substr($dados['dados_pessoais']['telefones']['residencial'], 2);
}
if (isset($dados['dados_pessoais']['telefones']['comercial'])) {
    $comercialAluno = '(' .
        substr($dados['dados_pessoais']['telefones']['comercial'], 0, 2) . ')' .
substr($dados['dados_pessoais']['telefones']['comercial'], 2);
}
if (isset($dados['dados_pessoais']['telefones']['celular'])) {
    $celularAluno = '(' .
        substr($dados['dados_pessoais']['telefones']['celular'], 0, 2) . ')' .
substr($dados['dados_pessoais']['telefones']['celular'], 2);
}

include_once '../fnc/buscaAlunoEndereco.php';
$endAluno = buscaAlunoEndereco($_GET['idAluno']);

$dados['localizacao']['cep'] = $endAluno[11];
$dados['localizacao']['logradouro'] = $endAluno[6];
$dados['localizacao']['numero'] = $endAluno[7];
$dados['localizacao']['complemento'] = $endAluno[8];
$dados['localizacao']['bairro'] = $endAluno[3];

$cep = $dados['localizacao']['cep'];
$logradouro = $dados['localizacao']['logradouro'];
$numeroEnd = $dados['localizacao']['numero'];
$complemento = $dados['localizacao']['complemento'];
include '../fnc/buscaBairro.php';
if ($dados['localizacao']['bairro']) {
    if ($dados['localizacao']['bairro'] != '') {
        $id = ($dados['localizacao']['bairro']);
		$buscaBairro = buscaBairro($dados['localizacao']['bairro']);
        $bairro = $buscaBairro[$id][1];
    }
}

include_once '../fnc/buscaOutrosDados.php';
$odAluno = buscaOutrosDados($_GET['idAluno']);

$dados['outrosDados']['zona_moradia'] = strtolower($odAluno[2]);
$dados['outrosDados']['autoriza_uso'] = ($odAluno[3]);
$dados['outrosDados']['tempo_residencia'] = ($odAluno[8]);
$dados['outrosDados']['local_permanencia'] = ($odAluno[5]);
$dados['outrosDados']['local_acesso'] = ($odAluno[5]);
$dados['outrosDados']['numTransporte'] = ($odAluno[0]);
$dados['outrosDados']['transporte'] = ($odAluno[1]);

$numTransporte = $dados['outrosDados']['numTransporte'];

$urbana = '';
$rural = '';
if ($dados['outrosDados']['zona_moradia'] == 'urbana') {
    $urbana = 'X';
    $rural = '';
} else {
    if ($dados['outrosDados']['zona_moradia'] == 'rural'){
        $urbana = '';
        $rural = 'X';
    }
}
if ($dados['outrosDados']['transporte'] == 1) {
    $transporte = true;
} else {
    $transporte = false;
}

if ($dados['outrosDados']['autoriza_uso'] == 1) {
    $autorizaUso = true;
} else {
    $autorizaUso = false;
}

if ($dados['outrosDados']['tempo_residencia'] < 5) {
    $tempoResidencia = true;
} else {
    $tempoResidencia = false;
}
$contraTurno = strtolower($dados['outrosDados']['local_permanencia']);

include_once '../fnc/buscaDadosSaude.php';
$dsAluno = buscaDadosSaude($_GET['idAluno']); 

$dados['saude']['outros']['anemia'] = $dsAluno[2];
$dados['saude']['outros']['diabetes'] = $dsAluno[3];
$dados['saude']['outros']['intoleranciaLactose'] = $dsAluno[4];
$dados['saude']['outros']['intoleranciaGluten'] = $dsAluno[5];
$dados['saude']['outros']['refluxo'] = $dsAluno[6];
$dados['saude']['outros']['alergia'] = $dsAluno[29];
$dados['saude']['outros']['encaminha'] = $dsAluno[30];

if(isset($dsAluno[31])){
    $desAlergia = $dsAluno[31];
} else {
    $desAlergia = '';
}

//var_dump($dados['saude']);
if($dados['saude']['outros']['anemia'] == 0){
    $anemia = 'nao';
} else {
    if($dados['saude']['outros']['anemia'] == 1){
        $anemia = 'sim';
    }
}
if($dados['saude']['outros']['diabetes'] == 0){
    $diabetes = 'nao';
} else {
    if($dados['saude']['outros']['diabetes'] == 1){
        $diabetes = 'sim';
    }
}
if($dados['saude']['outros']['intoleranciaLactose'] == 0){
    $lactose = 'nao';
} else {
    if($dados['saude']['outros']['intoleranciaLactose'] == 1){
        $lactose = 'sim';
    }
}
if($dados['saude']['outros']['intoleranciaGluten'] == 0){
    $gluten = 'nao';
} else {
    if($dados['saude']['outros']['intoleranciaGluten'] == 1){
        $gluten = 'sim';
    }
}
if($dados['saude']['outros']['refluxo'] == 0){
    $refluxo = 'nao';
} else {
    if($dados['saude']['outros']['refluxo'] == 1){
        $refluxo = 'sim';
    }
}
if($dados['saude']['outros']['alergia'] == 0){
    $alergia = 'nao';
} else {
    if($dados['saude']['outros']['alergia'] == 1){
        $alergia = 'sim';
    }
}
if($dados['saude']['outros']['encaminha'] == 0){
    $encaminha = 'Não';
} else {
    if($dados['saude']['outros']['encaminha'] == 1){
        $encaminha = 'Sim';
    }
}

$dados['saude']['deficiencias'] = array();

if($dsAluno[7] == 1){
    array_push($dados['saude']['deficiencias'], 'cegueira');
}
if($dsAluno[8] == 1){
    array_push($dados['saude']['deficiencias'], 'baixaVisao');
}
if($dsAluno[9] == 1){
    array_push($dados['saude']['deficiencias'], 'surdez');
}
if($dsAluno[10] == 1){
    array_push($dados['saude']['deficiencias'], 'deficienciaAuditiva');
}
if($dsAluno[11] == 1){
    array_push($dados['saude']['deficiencias'], 'deficienciaFisica');
}
if($dsAluno[12] == 1){
    array_push($dados['saude']['deficiencias'], 'deficienciaIntelectual');
}
if($dsAluno[13] == 1){
    array_push($dados['saude']['deficiencias'], 'deficienciaMultipla');
}
if($dsAluno[14] == 1){
    array_push($dados['saude']['deficiencias'], 'autismoInfantil');
}
if($dsAluno[15] == 1){
    array_push($dados['saude']['deficiencias'], 'asperger');
}
if($dsAluno[16] == 1){
    array_push($dados['saude']['deficiencias'], 'rett');
}
if($dsAluno[17] == 1){
    array_push($dados['saude']['deficiencias'], 'tdi');
}
if($dsAluno[18] == 1){
    array_push($dados['saude']['deficiencias'], 'superdotado');
}

$dados['saude']['recursos'] = array();

if($dsAluno[7] == 1){
    array_push($dados['saude']['recursos'], 'auxilioLedor');
}
if($dsAluno[8] == 1){
    array_push($dados['saude']['recursos'], 'auxilioTranscricao');
}
if($dsAluno[9] == 1){
    array_push($dados['saude']['recursos'], 'guiaInterprete');
}
if($dsAluno[10] == 1){
    array_push($dados['saude']['recursos'], 'interpreteLibras');
}
if($dsAluno[11] == 1){
    array_push($dados['saude']['recursos'], 'leituraLabial');
}
if($dsAluno[12] == 1){
    array_push($dados['saude']['recursos'], 'braile');
}
if($dsAluno[13] == 1){
    array_push($dados['saude']['recursos'], 'ampliada16');
}
if($dsAluno[14] == 1){
    array_push($dados['saude']['recursos'], 'ampliada20');
}
if($dsAluno[15] == 1){
    array_push($dados['saude']['recursos'], 'ampliada1624');
}
if($dsAluno[16] == 1){
    array_push($dados['saude']['recursos'], 'rett');
}
if($dsAluno[17] == 1){
    array_push($dados['saude']['recursos'], 'tdi');
}
if($dsAluno[18] == 1){
    array_push($dados['saude']['recursos'], 'superdotado');
}

$deficiencias = $dados['saude']['deficiencias'];
$recursos = $dados['saude']['recursos'];

if($odAluno[10] == 'Alugada'){
    $moradia = 'alugada';
} else{
    if($odAluno[10] == 'Outro'){
        $moradia = 'outro';
    } else {
        $moradia = 'propria';
    }
}

if($dsAluno[4] == 1){
    $dados['outrosDados']['bolsa_familia'] = 'sim';
} else {
    $dados['outrosDados']['bolsa_familia'] = 'nao';
}

if ($dados['outrosDados']['bolsa_familia'] == 'sim') {
    $bolsaFamilia = true;
} else {
    $bolsaFamilia = false;
}


if($odAluno[6] == 1){
    $dados['outrosDados']['possui_computador'] = 'sim';
} else {
    $dados['outrosDados']['possui_computador'] = 'nao';
}

if ($dados['outrosDados']['possui_computador'] == 'sim') {
    $possuiComputador = true;
} else {
    $possuiComputador = false;
}



if($odAluno[9] == 1){
    $dados['outrosDados']['carro'] = 'sim';
} else {
    $dados['outrosDados']['carro'] = 'nao';
}


if ($dados['outrosDados']['carro'] == 'sim') {
    $carro = true;
} else {
    $carro = false;
}

$dados['outrosDados']['acesso_internet'] = $odAluno[7];
$localAcesso = strtolower($dados['outrosDados']['acesso_internet']);

include '../fnc/buscaEscola.php';
include_once '../fnc/buscaEscolhas.php';
$escolhas = buscaEscolhas($_GET['idAluno']);

if($escolhas != false){
    if(isset($escolhas[0][0])){
     $dados['escola']['primeira_opcao'] = $escolhas[0][0];
 }
 if(isset($escolhas[1][0])){
     $dados['escola']['segunda_opcao'] = $escolhas[1][0];
 }
}

$priOpcao = buscaEscola($dados['escola']['primeira_opcao']);
$priOpcao = $priOpcao[1][1];
if (isset($dados['escola']['segunda_opcao'])) {
    $segOpcao = buscaEscola($dados['escola']['segunda_opcao']);
    $segOpcao = $segOpcao[1][1];
} else {
    $segOpcao = '';
}

if (isset($_SESSION['usuario']['id_escola'])) {
    $unidadeInscricao = buscaEscola($_SESSION['usuario']['id_escola']);
} else {
    $unidadeInscricao[1][1] = 'Nenhuma';
}

include '../fnc/buscaPessoaFisica.php';
$nomePessoa = buscaPessoaFisica($_SESSION['usuario']['id']);

include '../fnc/buscaReligiao.php';
include '../fnc/buscaProfissao.php';

include_once '../fnc/buscaDadosMae.php';

$dadosMae = buscaDadosMae($_GET['idAluno']);

if($dadosMae != false){
    $dados['mae']['nome'] = $dadosMae[9];
    $dataN = explode('-', $dadosMae[10]);
    $dados['mae']['data_nascimento'] = $dataN[2].'/'.$dataN[1].'/'.$dataN[0];
    $dados['mae']['sexo'] = strtolower($dadosMae[8]);
    $dados['mae']['etnia'] = ($dadosMae[1]);
    $dados['mae']['religiao'] = ($dadosMae[2]);
    $dados['mae']['profissao'] = ($dadosMae[3]);
    $dados['mae']['cpf'] = ($dadosMae[11]);
    $dados['mae']['estado_civil'] = ($dadosMae[4]);
    $dados['mae']['escolaridade'] = ($dadosMae[7]);

    $endMae = buscaAlunoEndereco($dadosMae[0]);

    $dados['mae']['cep'] = $endMae[11];
    $dados['mae']['logradouro'] = $endMae[6];
    $dados['mae']['numero'] = $endMae[7];
    $dados['mae']['complemento'] = $endMae[8];
    $dados['mae']['bairro'] = $endMae[3];
    $dados['mae']['municipio'] = $endMae[4];
    $dados['mae']['estado'] = $endMae[5];

    $end = buscaTrabalhoEndereco($dadosMae[0]);
    if ($end != false) {
        $dados['mae']['cep_trabalho'] = substr($end[11], 0, 2) . '.' . substr($end[11], 2, 3) . '-' . substr($end[11], 5, 3);
        $dados['mae']['logradouro_trabalho'] = $end[6];
        $dados['mae']['numero_trabalho'] = $end[7];
        $dados['mae']['complemento_trabalho'] = $end[8];
        $dados['mae']['bairro_trabalho'] = $end[3];
        $dados['mae']['estado_trabalho'] = $end[5];
        $dados['mae']['municipio_trabalho'] = $end[4];
    }

    include_once '../fnc/buscaTel.php';
    $telefones = buscaTel($dadosMae[0]);
    if (isset($telefones[1])) {
        $dados['mae']['celular'] = $telefones[1][3] . $telefones[1][4];
    }
    if (isset($telefones[2])) {
        $dados['mae']['telefone'] = $telefones[2][3] . $telefones[2][4];
    }
    if (isset($telefones[3])) {
        $dados['mae']['comercial'] = $telefones[3][3] . $telefones[3][4];
    }

    include_once '../fnc/buscaTurnos.php';
    $temp = (buscaTurnos($dadosMae[0]));
    $dados['mae']['turnos'] = array();
    if ($temp[0] == 1) {
        array_push($dados['mae']['turnos'], 'mat');
    }
    if ($temp[1] == 1) {
        array_push($dados['mae']['turnos'], 'ves');
    }
    if ($temp[2] == 1) {
        array_push($dados['mae']['turnos'], 'not');
    }


}

if (isset($dados['mae'])) {
    $nomeMae = $dados['mae']['nome'];
    $dataNascMae = $dados['mae']['data_nascimento'];
    if ($dados['mae']['sexo'] == 'm') {
        $sexoMae = 'Masculino';
    } else {
        $sexoMae = 'Feminino';
    }
	
	$buscaEtnia = buscaEtnia($dados['mae']['etnia']);
	$buscaReligiao = buscaReligiao($dados['mae']['religiao']);
    $buscaProfissao = buscaProfissao($dados['mae']['profissao']);
	
    $etniaMae = $buscaEtnia[1];
    $religiaoMae = $buscaReligiao[1];
    $profissaoMae = $buscaProfissao[1];
    $cpfMae = $dados['mae']['cpf'];

    $estadoCivilMae = $dados['mae']['estado_civil'];
    $escolaridadeMae = $dados['mae']['escolaridade'];
    $cepMae = $dados['mae']['cep'];
    $logradouroMae = $dados['mae']['logradouro'];
    $numeroEndMae = $dados['mae']['numero'];
    $complementoMae = $dados['mae']['complemento'];
    $bairroMae = $dados['mae']['bairro'];
	
	$buscaMunicipio = buscaMunicipio($dados['mae']['municipio']);
	$buscaNomeEstado = buscaNomeEstado($dados['mae']['estado']);
	
    $cidadeMae = $buscaMunicipio[1][1];
    $ufMae = $buscaNomeEstado[2];

    if (isset($dados['mae']['cep_trabalho'])) {
        $cepTrabalhoMae = $dados['mae']['cep_trabalho'];
        $logradouroTrabalhoMae = $dados['mae']['logradouro_trabalho'];
        $numeroEndTrabalhoMae = $dados['mae']['numero_trabalho'];
        $complementoTrabalhoMae = $dados['mae']['complemento_trabalho'];
        $bairroTrabalhoMae = $dados['mae']['bairro_trabalho'];
        
        $buscaMunicipio = buscaMunicipio($dados['mae']['municipio_trabalho']);
        $buscaNomeEstado = buscaNomeEstado($dados['mae']['estado_trabalho']);
		
        $cidadeTrabalhoMae = $buscaMunicipio[1][1];
        $ufTrabalhoMae = $buscaNomeEstado[2];
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
    if (isset($dados['mae']['telefone'])) {
        $residencialMae = '(' .
            substr($dados['mae']['telefone'], 0, 2) . ')' .
substr($dados['mae']['telefone'], 2);
} else {
    $residencialMae = '';
}
if (isset($dados['mae']['comercial'])) {
    $comercialMae = '(' .
        substr($dados['mae']['comercial'], 0, 2) . ')' .
substr($dados['mae']['comercial'], 2);
} else {
    $comercialMae = '';
}
if (isset($dados['mae']['celular'])) {
    $celularMae = '(' .
        substr($dados['mae']['celular'], 0, 2) . ')' .
substr($dados['mae']['celular'], 2);
} else {
    $celularMae = '';
}
$turnosMae = $dados['mae']['turnos'];
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


include_once '../fnc/buscaDadosPai.php';

$dadosPai = buscaDadosPai($_GET['idAluno']);

if($dadosPai != false){
    $dados['pai']['nome'] = $dadosPai[9];
    $dataN = explode('-', $dadosPai[10]);
    $dados['pai']['data_nascimento'] = $dataN[2].'/'.$dataN[1].'/'.$dataN[0];
    $dados['pai']['sexo'] = strtolower($dadosPai[8]);
    $dados['pai']['etnia'] = ($dadosPai[1]);
    $dados['pai']['religiao'] = ($dadosPai[2]);
    $dados['pai']['profissao'] = ($dadosPai[3]);
    $dados['pai']['cpf'] = ($dadosPai[11]);
    $dados['pai']['estado_civil'] = ($dadosPai[4]);
    $dados['pai']['escolaridade'] = ($dadosPai[7]);

    $endPai = buscaAlunoEndereco($dadosPai[0]);

    $dados['pai']['cep'] = $endPai[11];
    $dados['pai']['logradouro'] = $endPai[6];
    $dados['pai']['numero'] = $endPai[7];
    $dados['pai']['complemento'] = $endPai[8];
    $dados['pai']['bairro'] = $endPai[3];
    $dados['pai']['municipio'] = $endPai[4];
    $dados['pai']['estado'] = $endPai[5];

    $end = buscaTrabalhoEndereco($dadosPai[0]);
    if ($end != false) {
        $dados['pai']['cep_trabalho'] = substr($end[11], 0, 2) . '.' . substr($end[11], 2, 3) . '-' . substr($end[11], 5, 3);
        $dados['pai']['logradouro_trabalho'] = $end[6];
        $dados['pai']['numero_trabalho'] = $end[7];
        $dados['pai']['complemento_trabalho'] = $end[8];
        $dados['pai']['bairro_trabalho'] = $end[3];
        $dados['pai']['estado_trabalho'] = $end[5];
        $dados['pai']['municipio_trabalho'] = $end[4];
    }

    include_once '../fnc/buscaTel.php';
    $telefones = buscaTel($dadosPai[0]);
    if (isset($telefones[1])) {
        $dados['pai']['celular'] = $telefones[1][3] . $telefones[1][4];
    }
    if (isset($telefones[2])) {
        $dados['pai']['telefone'] = $telefones[2][3] . $telefones[2][4];
    }
    if (isset($telefones[3])) {
        $dados['pai']['comercial'] = $telefones[3][3] . $telefones[3][4];
    }

    include_once '../fnc/buscaTurnos.php';
    $temp = (buscaTurnos($dadosPai[0]));
    $dados['pai']['turnos'] = array();
    if ($temp[0] == 1) {
        array_push($dados['pai']['turnos'], 'mat');
    }
    if ($temp[1] == 1) {
        array_push($dados['pai']['turnos'], 'ves');
    }
    if ($temp[2] == 1) {
        array_push($dados['pai']['turnos'], 'not');
    }


}

if (isset($dados['pai'])) {
    $nomePai = $dados['pai']['nome'];
    $dataNascPai = $dados['pai']['data_nascimento'];
    if ($dados['pai']['sexo'] == 'm') {
        $sexoPai = 'Masculino';
    } else {
        $sexoPai = 'Feminino';
    }
	
	$buscaEtnia = buscaEtnia($dados['pai']['etnia']);
	$buscaReligiao = buscaReligiao($dados['pai']['religiao']);
	$buscaProfissao = buscaProfissao($dados['pai']['profissao']);
	
    $etniaPai = $buscaEtnia[1];
    $religiaoPai = $buscaReligiao[1];
    $profissaoPai = $buscaProfissao[1];
    $cpfPai = $dados['pai']['cpf'];

    $estadoCivilPai = $dados['pai']['estado_civil'];
    $escolaridadePai = $dados['pai']['escolaridade'];
    $cepPai = $dados['pai']['cep'];
    $logradouroPai = $dados['pai']['logradouro'];
    $numeroEndPai = $dados['pai']['numero'];
    $complementoPai = $dados['pai']['complemento'];
    $bairroPai = $dados['pai']['bairro'];
   
    $buscaMunicipio = buscaMunicipio($dados['pai']['municipio']);
  	$buscaNomeEstado = buscaNomeEstado($dados['pai']['estado']); 
   
   
    $cidadePai = $buscaMunicipio[1][1];
    $ufPai = $buscaNomeEstado[2];

    if (isset($dados['pai']['cep_trabalho'])) {
        if($dados['pai']['cep_trabalho'] != ''){
            $cepTrabalhoPai = $dados['pai']['cep_trabalho'];
            $logradouroTrabalhoPai = $dados['pai']['logradouro_trabalho'];
            $numeroEndTrabalhoPai = $dados['pai']['numero_trabalho'];
            $complementoTrabalhoPai = $dados['pai']['complemento_trabalho'];
            $bairroTrabalhoPai = $dados['pai']['bairro_trabalho'];
            $buscaMunicipio = buscaMunicipio($dados['pai']['municipio_trabalho']);
            $buscaNomeEstado = buscaNomeEstado($dados['pai']['estado_trabalho']);
            
            $cidadeTrabalhoPai = $buscaMunicipio[1][1];
            $ufTrabalhoPai = $buscaNomeEstado[2];
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
    if (isset($dados['pai']['telefone'])) {
        $residencialPai = '(' .
            substr($dados['pai']['telefone'], 0, 2) . ')' .
substr($dados['pai']['telefone'], 2);
} else {
    $residencialPai = '';
}
if (isset($dados['pai']['comercial'])) {
    $comercialPai = '(' .
        substr($dados['pai']['comercial'], 0, 2) . ')' .
substr($dados['pai']['comercial'], 2);
} else {
    $comercialPai = '';
}
if (isset($dados['pai']['celular'])) {
    $celularPai = '(' .
        substr($dados['pai']['celular'], 0, 2) . ')' .
substr($dados['pai']['celular'], 2);
} else {
    $celularPai = '';
}
$turnosPai = $dados['pai']['turnos'];
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


include_once '../fnc/buscaDadosResponsavel.php';

$dadosResp = buscaDadosResponsavel($_GET['idAluno']);

if($dadosResp != false){
    $dados['responsavel']['nome'] = $dadosResp[9];
    $dataN = explode('-', $dadosResp[10]);
    $dados['responsavel']['data_nascimento'] = $dataN[2].'/'.$dataN[1].'/'.$dataN[0];
    $dados['responsavel']['sexo'] = strtolower($dadosResp[8]);
    $dados['responsavel']['etnia'] = ($dadosResp[1]);
    $dados['responsavel']['religiao'] = ($dadosResp[2]);
    $dados['responsavel']['profissao'] = ($dadosResp[3]);
    $dados['responsavel']['cpf'] = ($dadosResp[11]);
    $dados['responsavel']['estado_civil'] = ($dadosResp[4]);
    $dados['responsavel']['escolaridade'] = ($dadosResp[7]);

    $endresp = buscaAlunoEndereco($dadosResp[0]);

    $dados['responsavel']['cep'] = $endresp[11];
    $dados['responsavel']['logradouro'] = $endresp[6];
    $dados['responsavel']['numero'] = $endresp[7];
    $dados['responsavel']['complemento'] = $endresp[8];
    $dados['responsavel']['bairro'] = $endresp[3];
    $dados['responsavel']['municipio'] = $endresp[4];
    $dados['responsavel']['estado'] = $endresp[5];

    $end = buscaTrabalhoEndereco($dadosResp[0]);
    if ($end != false) {
        $dados['responsavel']['cep_trabalho'] = substr($end[11], 0, 2) . '.' . substr($end[11], 2, 3) . '-' . substr($end[11], 5, 3);
        $dados['responsavel']['logradouro_trabalho'] = $end[6];
        $dados['responsavel']['numero_trabalho'] = $end[7];
        $dados['responsavel']['complemento_trabalho'] = $end[8];
        $dados['responsavel']['bairro_trabalho'] = $end[3];
        $dados['responsavel']['estado_trabalho'] = $end[5];
        $dados['responsavel']['municipio_trabalho'] = $end[4];
    }

    include_once '../fnc/buscaTel.php';
    $telefones = buscaTel($dadosResp[0]);
    if (isset($telefones[1])) {
        $dados['responsavel']['celular'] = $telefones[1][3] . $telefones[1][4];
    }
    if (isset($telefones[2])) {
        $dados['responsavel']['telefone'] = $telefones[2][3] . $telefones[2][4];
    }
    if (isset($telefones[3])) {
        $dados['responsavel']['comercial'] = $telefones[3][3] . $telefones[3][4];
    }

    include_once '../fnc/buscaTurnos.php';
    $temp = (buscaTurnos($dadosResp[0]));
    $dados['responsavel']['turnos'] = array();
    if ($temp[0] == 1) {
        array_push($dados['responsavel']['turnos'], 'mat');
    }
    if ($temp[1] == 1) {
        array_push($dados['responsavel']['turnos'], 'ves');
    }
    if ($temp[2] == 1) {
        array_push($dados['responsavel']['turnos'], 'not');
    }


}

if (isset($dados['responsavel'])) {
    $nomeResp = $dados['responsavel']['nome'];
    $dataNascResp = $dados['responsavel']['data_nascimento'];
    if ($dados['responsavel']['sexo'] == 'm') {
        $sexoResp = 'Masculino';
    } else {
        $sexoResp = 'Feminino';
    }
	
	$buscaEtnia = buscaEtnia($dados['responsavel']['etnia']);
	$buscaReligiao = buscaReligiao($dados['responsavel']['religiao']);
	$buscaProfissao = buscaProfissao($dados['responsavel']['profissao']);
	
	
    $etniaResp = $buscaEtnia[1];
    $religiaoResp = $buscaReligiao[1];
    $profissaoResp = $buscaProfissao[1];
    $cpfResp = $dados['responsavel']['cpf'];

    $estadoCivilResp = $dados['responsavel']['estado_civil'];
    $escolaridadeResp = $dados['responsavel']['escolaridade'];

    if (isset($dados['responsavel']['cep_trabalho'])) {
        $cepTrabalhoResp = $dados['responsavel']['cep_trabalho'];
        $logradouroTrabalhoResp = $dados['responsavel']['logradouro_trabalho'];
        $numeroEndTrabalhoResp = $dados['responsavel']['numero_trabalho'];
        $complementoTrabalhoResp = $dados['responsavel']['complemento_trabalho'];
        $bairroTrabalhoResp = $dados['responsavel']['bairro_trabalho'];
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
    if (isset($dados['responsavel']['telefone'])) {
        $residencialResp = '(' .
            substr($dados['responsavel']['telefone'], 0, 2) . ')' .
substr($dados['responsavel']['telefone'], 2);
} else {
    $residencialResp = '';
}
if (isset($dados['responsavel']['comercial'])) {
    $comercialResp = '(' .
        substr($dados['responsavel']['comercial'], 0, 2) . ')' .
substr($dados['responsavel']['comercial'], 2);
} else {
    $comercialResp = '';
}
if (isset($dados['responsavel']['celular'])) {
    $celularResp = '(' .
        substr($dados['responsavel']['celular'], 0, 2) . ')' .
substr($dados['responsavel']['celular'], 2);
} else {
    $celularResp = '';
}


$buscaMunicipio = buscaMunicipio($dados['responsavel']['municipio_trabalho']);
$buscaNomeEstado = buscaNomeEstado($dados['responsavel']['estado_trabalho']);


$cidadeTrabalhoResp = $buscaMunicipio[1][1];
$ufTrabalhoResp = $buscaNomeEstado[2];
$turnosResp = $dados['responsavel']['turnos'];
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
$pdf->Cell(0, 0, iconv('utf-8', 'iso-8859-1', 'Formulário de Cadastro de Aluno '.date('Y').' - Ensino Fundamental'), 0, 0, 'C');
$pdf->Ln(10);
// Line break
$pdf->Cell(188, 0, iconv('utf-8', 'iso-8859-1', $html), 0, 0, 'C');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'BU', 14);
$pdf->Cell(40, 0, iconv('utf-8', 'iso-8859-1', 'Dados do Aluno:'), 0, 0, 'C');
$pdf->Ln(6);
$pdf->Cell(80, 5, iconv('utf-8', 'iso-8859-1', 'Número de Matrícula:'), 0, 0, 'C');
$pdf->SetFont('Arial', '', 11);
include_once '../fnc/buscaInscricao.php';
$buscaInscricao = buscaInscricao($_GET['idAluno']);

$pdf->Cell(100, 5, $buscaInscricao[0], 1, 0, 'C');
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
$pdf->outrosDados($urbana, $rural, $autorizaUso, $bolsaFamilia, $contraTurno, $possuiComputador, $localAcesso, $tempoResidencia, $transporte, $numTransporte);
$pdf->Ln(6);
$pdf->CarroMoradia($carro, $moradia);
$pdf->Ln(6);
if(count($deficiencias > 0) or count($recursos > 0)){
    $possuiDeficiencia = 'sim';
} else {
    $possuiDeficiencia = 'nao';
}
$pdf->dadosSaude($anemia, $diabetes, $lactose, $gluten, $refluxo, $deficiencias, $recursos, $possuiDeficiencia, $alergia, $desAlergia, $encaminha);
$pdf->Ln(6);
$pdf->DadosMae($nomeMae, $sexoMae, $dataNascMae, $etniaMae, $estadoCivilMae, $escolaridadeMae, $religiaoMae, $profissaoMae, $cpfMae);
$pdf->Ln(6);
$pdf->Telefones($residencialMae, $celularMae, $comercialMae);
$pdf->Ln(6);
if ($bairroMae != '') {
	$buscaBairro = buscaBairro($bairroMae);
    $bairroMae = $buscaBairro[$bairroMae][1];
}
$pdf->Endereco($cepMae, $logradouroMae, $numeroEndMae, $complementoMae, $bairroMae, $cidadeMae, $ufMae);
$pdf->Ln(6);
if ($bairroTrabalhoMae != '') {
	$buscaBairro = buscaBairro($bairroTrabalhoMae);
    $bairroTrabalhoMae = $buscaBairro[$bairroTrabalhoMae][1];
}
$pdf->EnderecoTrab($cepTrabalhoMae, $logradouroTrabalhoMae, $numeroEndTrabalhoMae, $complementoTrabalhoMae, $bairroTrabalhoMae, $cidadeTrabalhoMae, $ufTrabalhoMae, $turnosMae);
$pdf->Ln(6);
$pdf->DadosPai($nomePai, $sexoPai, $dataNascPai, $etniaPai, $estadoCivilPai, $escolaridadePai, $religiaoPai, $profissaoPai, $cpfPai);
$pdf->Ln(6);
$pdf->Telefones($residencialPai, $celularPai, $comercialPai);
$pdf->Ln(6);
if ($bairroPai != '') {
	$buscaBairro = buscaBairro($bairroPai);
    $bairroPai = $buscaBairro[$bairroPai][1];
}
$pdf->Endereco($cepPai, $logradouroPai, $numeroEndPai, $complementoPai, $bairroPai, $cidadePai, $ufPai);
$pdf->Ln(6);
if ($bairroTrabalhoPai != '') {
	
	$buscaBairro = buscaBairro($bairroTrabalhoPai);
    $bairroTrabalhoPai = $buscaBairro[$bairroTrabalhoPai][1];
}
$pdf->EnderecoTrab($cepTrabalhoPai, $logradouroTrabalhoPai, $numeroEndTrabalhoPai, $complementoTrabalhoPai, $bairroTrabalhoPai, $cidadeTrabalhoPai, $ufTrabalhoPai, $turnosPai);
$pdf->Ln(6);
$pdf->DadosResponsavel($nomeResp, $sexoResp, $dataNascResp, $etniaResp, $estadoCivilResp, $escolaridadeResp, $religiaoResp, $profissaoResp, $cpfResp);
$pdf->Ln(6);
$pdf->Telefones($residencialResp, $celularResp, $comercialResp);
$pdf->Ln(6);
if ($bairroTrabalhoResp != '') {
    $buscaBairro = buscaBairro($bairroTrabalhoResp);
    $bairroTrabalhoResp = $buscaBairro[$bairroTrabalhoResp][1];
}
$pdf->EnderecoTrab($cepTrabalhoResp, $logradouroTrabalhoResp, $numeroEndTrabalhoResp, $complementoTrabalhoResp, $bairroTrabalhoResp, $cidadeTrabalhoResp, $ufTrabalhoResp, $turnosResp);

include '../fnc/buscaSituacaoOcupacional.php';
include '../fnc/buscaComprovacao.php';

include '../fnc/buscaIndividuoRenda.php';
$inds = buscaIndividuoRenda($_GET['idAluno']);
$dados['temp'] = 1;

if (isset($inds)) {
    if ($inds != false) {
        foreach ($inds as $key => $value) {
            $data = explode('-', $value[5]);
            $temp = $data[2] . '/' . $data[1] . '/' . $data[0];
            $pessoa = array( $value[7], $value[4], $value[6], $temp, $value[8], $value[3]) ;

            if (!isset($dados['renda']['pessoas'])) {
                $dados['renda']['pessoas'] = array();
            }
            array_push($dados['renda']['pessoas'], $pessoa);
            $temp = '';
        }
    }
}



include '../fnc/buscaOutrasRendas.php';
$outras = buscaOutrasRendas($_GET['idAluno']);

$dados['renda']['pensao'] = $outras[0][6];
$dados['renda']['bolsa'] = $outras[1][6];

$totalRenda = 0;

unset($data);
if(isset($dados['renda']['pessoas'])){
    foreach ($dados['renda']['pessoas'] as $key => $value) {
        
		
		$buscaSituacaoOcupacional = buscaSituacaoOcupacional($value[1]);
		$buscaComprovacao = buscaComprovacao($value[5]);
        $data[$key] = array($value[0], utf8_decode($buscaSituacaoOcupacional[1]), utf8_decode($value[4]), $value[3], $value[2], utf8_decode($buscaComprovacao[1]));
        $totalRenda = $totalRenda + $value[2];
    }
}

$pdf->Ln(6);

$pdf->SetFont('Arial', 'BU', 14);
$pdf->Cell(40, 5, iconv('utf-8', 'iso-8859-1', 'Dados de Renda:'), 0, 0, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(6);
$header = '';

if(isset($data)){
    $pdf->FancyTable($header, $data);
    $pdf->Ln(1);
}

if(!isset($dados['renda']['pensao'])){
    $dados['renda']['pensao'] = 0;
}

if(!isset($dados['renda']['bolsa'])){
    $dados['renda']['bolsa'] = 0;
}

$totalRenda = $totalRenda + $dados['renda']['pensao'] + $dados['renda']['bolsa'];
$pessoas = count($data) + 1;

$percapita = $totalRenda / $pessoas;

$percapita = number_format($percapita, 4, '.', '');

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(37, 5, iconv('utf-8', 'iso-8859-1', 'Valor de Pensão*: '), 0, 0, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20, 5, iconv('utf-8', 'iso-8859-1', $dados['renda']['pensao']), 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(45, 5, iconv('utf-8', 'iso-8859-1', 'Valor Bolsa Família*: '), 0, 0, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20, 5, iconv('utf-8', 'iso-8859-1', $dados['renda']['bolsa']), 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(40, 5, iconv('utf-8', 'iso-8859-1', 'Renda Per Capita: '), 0, 0, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(25, 5, iconv('utf-8', 'iso-8859-1', $percapita), 1, 0, 'C');


$data = explode('-', $aluno[1]);
$data = $data[2] . '-' . $data[1] . '-' . $data[0];

$birthday = new DateTime($data);
$diff = $birthday->diff(new DateTime("2014-03-31"));
$months = $diff->format('%m') + 12 * $diff->format('%y');
$years = floor($months / 12);
$resto = $months % 12;

if ($years == 0) {
    if ($resto < 4) {
        $grupo = 0;
        $textoGrupo = 'Idade Mínina não atingida.';
    } else {
        $dados['escola']['grupo'] = 10;
        $textoGrupo = 'Grupo: 1';
    }
} else {
    if ($years >= 1 && $years < 2) {
        $dados['escola']['grupo'] = 11;
        $textoGrupo = 'Grupo: 2';
    } else {
        if ($years >= 2 && $years < 3) {
            $dados['escola']['grupo'] = 12;
            $textoGrupo = 'Grupo: 3';
        } else {
            if ($years >= 3 && $years < 4) {
                $dados['escola']['grupo'] = 13;
                $textoGrupo = 'Grupo: 4';
            } else {
                if ($years >= 4 && $years < 5) {
                    $dados['escola']['grupo'] = 14;
                    $textoGrupo = 'Grupo: 5';
                } else {
                    if ($years >= 5 && $years < 6) {
                        $dados['escola']['grupo'] = 15;
                        $textoGrupo = 'Grupo: 6';
                    } else {
                        $dados['escola']['grupo'] = -1;
                        $textoGrupo = 'Idade Máxima Atingida.';
                    }
                }
            }
        }
    }
}

include_once '../fnc/buscaUeAluno.php';
$ues = buscaUeAluno($_GET['idAluno']);

foreach ($ues as $key => $value) {
    $pdf->Ln(6);
    $temp = buscaEscola($value[0]);
    $pdf->DadosEscola($temp[1][1]);
}

$uesI = buscaUeAlunoIntencao($_GET['idAluno']);

foreach ($uesI as $key => $value) {
    $pdf->Ln(6);
    $temp2 = buscaEscola($value[0]);
    $pdf->DadosIntencao($temp2[1][1], $value[1]);
}


//$pdf->AddPage();

// Logo
// $pdf->Image('../img/logo.png', 10, 6, 30);
// // Arial bold 15
// $pdf->SetFont('Arial', 'B', 13);
// // Move to the right
// $pdf->Cell(77);
// // Title
// $pdf->Cell(1, 0, iconv('utf-8', 'iso-8859-1', 'Prefeitura Municipal de Florianópolis'), 0, 0, 'C');
// // Line break
// $pdf->Ln(5);
// // Arial bold 15
// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(142, 0, iconv('utf-8', 'iso-8859-1', 'Secretaria Municipal de Educação'), 0, 0, 'C');
// // Line break
// $pdf->Ln(5);
// // Arial bold 15
// $pdf->SetFont('Arial', 'B', 10);
// $pdf->Cell(133, 0, iconv('utf-8', 'iso-8859-1', 'Sistema de Gerenciamento Escolar'), 0, 0, 'C');
// // Line break
// $pdf->Ln(10);
// // Arial bold 15
// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(0, 0, iconv('utf-8', 'iso-8859-1', 'Formulário de Cadastro de Aluno - Educação Infantil (Intenção)'), 0, 0, 'C');
// $pdf->Ln(10);
// Line break


//$pdf->Comprovante($priOpcao, $segOpcao, $unidadeInscricao, $nomePessoa, $grupo, $dados['dados_pessoais']['nome']);

$pdf->Output();
?>