<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once("../../../Biblioteca/fpdf/fpdf.php");
include_once("banco/gdb.php");
include_once("php/gerarqrcode/phpqrcode/qrlib.php");


$pdf = new FPDF("P"); // relat rio em orienta  o "portrait"
$db  = new gdb( );

$pdf->Header("");
$pdf->Footer(False);
// $pdf->Open();

$hoje      = date("d/m/Y");
$data      = $hoje;
$url       = "http://192.168.12.4/desenvolvimento/desenv1/IlhaCampeche/validar.php?codigo=";
$file      = "/var/www/html/desenvolvimento/desenv1/IlhaCampeche/images/qrcode/";
$voucodigo = 0;


$cpfFirst            = $db->vargetpost("cpfFirst");
$nomeFirst           = $db->vargetpost("nomeFirst");
$dataNascimentoFirst = $db->vargetpost("dataNascimentoFirst");
$pescodigo           = $db->vargetpost("pescodigo");
$dataVisita          = $db->vargetpost("dataVisita");

if( isset( $_POST['cpf'] ) ){
    $cpf            = $db->vargetpost("cpf");
    $nome           = $db->vargetpost("nome");
    $dataNascimento = $db->vargetpost("dataNascimento");
}

// Verificando se tem voucher nesse dia
$db->open("select * from voucher where voupescodigo = '$pescodigo' and voudata = STR_TO_DATE('$dataVisita', '%d/%m/%Y') ");
$temVoucher = $db->linhas;

if( isset($temVoucher) && $temVoucher>0 ){
    $voucodigo = $db->gs['VOUCODIGO'][0];
}

// Verificando a quantidade de visitas em um mês.
$db->open("select * 
             from voucher 
            where voupescodigo   = '$pescodigo' 
              and month(voudata) = month( STR_TO_DATE('$dataVisita', '%d/%m/%Y') )
              and year(voudata)  = year( STR_TO_DATE('$dataVisita', '%d/%m/%Y') ) ");

$totalvisitas = $db->linhas;

if( $temVoucher > 0 ){
    // print 'Essa pessoa, que tem reserva nesse dia !';    
}else if( $totalvisitas == 40 ){
          print 'Você atingiu o limite de visitas para esse mês !';
}else{
   
      // veficando qual o último código lançado, para criar o próximo.
      $db->open("select IFNULL(max(voucodigo),0) + 1  as ID from voucher");

      // inserindo os dados do Voucher
      $voucodigo = $db->gs['ID'][0];
      $db->open("insert into voucher( voucodigo, 
                                      voupescodigo,
                                      voudata, 
                                      vouvalor ) 
                              values( $voucodigo, 
                                      $pescodigo,  
                                      STR_TO_DATE('$dataVisita', '%d/%m/%Y'),
                                      0) ");

      // inserindo os dados do primeiro acompantes
      if( $cpfFirst !=='' ){        
          $db->open("select IFNULL(max(acocodigo),0) + 1  as ID from acompanhante ");
          $acocodigo = $db->gs['ID'][0];
          $db->open("insert into acompanhante( acocodigo,
                                               aconome,
                                               aconascimento,
                                               acodocumento,
                                               acopescodigo,
                                               acovoucodigo )
                                      values( $acocodigo,
                                             '$nomeFirst',
                                             '$dataNascimentoFirst',
                                             '$cpfFirst',
                                              $pescodigo,
                                              $voucodigo ) ");

          // verificando se tem mais acompanhante                                    
          if( isset( $cpf ) ){
              $db->open("select IFNULL(max(acocodigo),0) + 1  as ID from acompanhante ");
              $acocodigo = $db->gs['ID'][0];
               
              // inserindo os próximos.
              foreach( $cpf as $i=>$value ){
                $acocodigo += 1;
                $db->open("insert into acompanhante( acocodigo,
                                                     aconome,
                                                     aconascimento,
                                                     acodocumento,
                                                     acopescodigo,
                                                     acovoucodigo )
                                           values(  $acocodigo,
                                                   '$nome[$i]',
                                                   '$dataNascimento[$i]',
                                                   '$cpf[$i]',
                                                   $pescodigo,
                                                   $voucodigo ) ");

              }
  
          }
      }
}

/*

print "<pre>";
print_r($_POST);
print_r($_GET);
print "</pre>";

*/

// Verificando se tem o código do VOUCHER
if( $voucodigo>0 ){
    $file2 = $file."qrcode".str_pad($voucodigo, 8, '0', STR_PAD_LEFT)."A000000.png";
    $url2  = $url.str_pad($voucodigo, 8, '0', STR_PAD_LEFT)."A000000";
    QRcode::png($url2, $file2, 'L', 10, 2);

    // Verificando os dados do acompanhante
    $db->open("select * from acompanhante aco where aco.acovoucodigo = $voucodigo");
    if( $db->linhas>0 ){
        foreach( $db->gs['ACOCODIGO'] as  $value ){
          $file2 = $file."qrcode".str_pad($voucodigo, 8, '0', STR_PAD_LEFT)."A".str_pad($value, 8, '0', STR_PAD_LEFT).".png";
          $url2  = $url.str_pad($voucodigo, 8, '0', STR_PAD_LEFT)."A".str_pad($value, 8, '0', STR_PAD_LEFT);
          QRcode::png($url2, $file2, 'L', 10, 2);
        }
    }            
}

imprimirVoucher( $pdf, $db, $voucodigo, $file );

$pdf->Output('PDF', 'I');


function imprimirVoucher( $pdf, $db, $voucodigo, $file ) {  

    $db->open("select *, DATE_FORMAT( voudata,'%d/%m/%Y') as dvisita from voucher vou, pessoa pes where pescodigo = voupescodigo and voucodigo   = '$voucodigo' ");

    $pdf->AddPage();

    /*
    $pdf->SetLineWidth(1);
    $pdf->Rect(7, 7, 196, 275);

    $pdf->Image('http://192.168.12.4/desenvolvimento/desenv1/FPDF/imgs/icone.png', 10, 9, 40 ,30);// importa uma imagem   

    $pdf->SetXY(50,17);
    $pdf->SetFont('Arial','B',12);   
    $pdf->MultiCell(0,5,utf8_decode("PREFEITURA MUNICIPAL DE FLORIANÃ“POLIS"),0,"L");
   
    $pdf->SetXY(50,23);
    $pdf->SetFont('Arial','B',11);   
    $pdf->MultiCell(0,5,utf8_decode("SECRETARIA MUNICIPAL DE SEGURANÃ‡A E ORDEM PÃšBLICA"),0,"L");

    $pdf->SetLineWidth(0.3);
    $pdf->Line(10, 43, 201, 43);

    
    $pdf->SetXY(50,47);
    $pdf->SetFont('Arial','B',13);   
    $pdf->MultiCell(0,5,utf8_decode("VOUCHER PARA ACESSO DA ILHA DO CAMPECHE"),0,"L");

    $pdf->SetXY(12,53);
    $pdf->SetFont('Arial','',11);   
    $pdf->MultiCell(0,5,utf8_decode("ParabÃ©ns pela sua reserva! Agora vocÃª tem acesso garantido para explorar a deslumbrante Ilha do Campeche. Prepare-se para se maravilhar com praias intocadas, trilhas exuberantes e Ã¡guas cristalinas. Sua jornada de descobertas e relaxamento estÃ¡ prestes a comeÃ§ar. Aproveite cada momento e crie memÃ³rias inesquecÃ­veis neste paraÃ­so natural. Bem-vindo Ã  Ilha do Campeche!"),0,"J");

    $pdf->SetLineWidth(0.3);
    $pdf->Line(10, 75.5, 201, 75.5);

    $pdf->SetXY(80,82);
    $pdf->SetFont('Arial','B',13);   
    $pdf->MultiCell(0,5,utf8_decode("1Â° CartÃ£o de Acesso "),0,"L");

    */
    
    $pdf->SetXY(12,90);
    $pdf->SetFont('Arial','',12);   
    $pdf->MultiCell(0,5,utf8_decode("Voucher:"),0,"L");
    $pdf->SetXY(30,90);
    $pdf->MultiCell(0,5,utf8_decode( str_pad($voucodigo, 8, '0', STR_PAD_LEFT)),0,"L");

    $pdf->SetXY(12,100);
    $pdf->SetFont('Arial','',12);   
    $pdf->MultiCell(0,5,utf8_decode("Nome:"),0,"L");
    $pdf->SetXY(26,100);
    $pdf->MultiCell(0,5,utf8_decode( $db->gs['PESNOME'][0] ),0,"L");

    $pdf->SetXY(12,110);
    $pdf->SetFont('Arial','',12);   
    $pdf->MultiCell(0,5,utf8_decode("CPF:"),0,"L");
    $pdf->SetXY(27,110);
    $pdf->MultiCell(0,5,utf8_decode($db->gs['PESCPF'][0]),0,"L");

    $pdf->SetXY(12,120);
    $pdf->SetFont('Arial','',12);   
    $pdf->MultiCell(0,5,utf8_decode("Data da Visita:"),0,"L");
    $pdf->SetXY(41,120);
    $pdf->MultiCell(0,5,utf8_decode(  $db->gs['DVISITA'][0] ),0,"L");

    $nomeArquivo = $file."qrcode".str_pad($voucodigo, 8, '0', STR_PAD_LEFT)."A000000.png";

    $pdf->SetLineWidth(0.3);
    $pdf->Rect(140, 80, 45, 45);
    $pdf->Image($nomeArquivo,141,81,43);
    $pdf->SetLineWidth(0.3);
    $pdf->Line(10, 130, 201, 130);

    $pdf->SetXY(80,271);
    $pdf->SetFont('Arial','',12);   
    $pdf->MultiCell(0,5,utf8_decode("Desenvolvido pela E-gov"),0,"L");

}

?>