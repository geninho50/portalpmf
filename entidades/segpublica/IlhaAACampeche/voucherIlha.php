<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once("banco/gdb.php");
include_once("php/gerarqrcode/phpqrcode/qrlib.php");

$db  = new gdb( );

$hoje      = date("d/m/Y");
$data      = $hoje;
$url       = "http://192.168.12.4/desenvolvimento/desenv1/IlhaCampeche/validar.php?codigo=";
$file      = "images/qrcode/";
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

// Verificando a quantidade de visitas em um m�s.
$db->open("select * 
             from voucher 
            where voupescodigo   = '$pescodigo' 
              and month(voudata) = month( STR_TO_DATE('$dataVisita', '%d/%m/%Y') )
              and year(voudata)  = year( STR_TO_DATE('$dataVisita', '%d/%m/%Y') ) ");

$totalvisitas = $db->linhas;

if( $temVoucher > 0 ){
    // print 'Essa pessoa, que tem reserva nesse dia !';        
}else if( $totalvisitas == 40 ){
          print 'Voce atingiu o limite de visitas para esse mes !';
}else{
   
      // veficando qual o �ltimo c�digo lan�ado, para criar o pr�ximo.
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
               
              // inserindo os pr�ximos.
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

// Verificando se tem o codigo do VOUCHER
if( $voucodigo>0 ){
    // Verificando se o VOUCHER foi criado
    $file2  = $file."qrcode".str_pad($voucodigo, 8, '0', STR_PAD_LEFT)."A00000000.png";

    if( !file_exists($file2) ){
        $qrcode        = str_pad($voucodigo, 8, '0', STR_PAD_LEFT)."A00000000";
        $url2          = $url.$qrcode;
        QRcode::png($url2, $file2, 'L', 10, 2);

        // Verificando os dados do acompanhante
        $db->open("select * from acompanhante aco where aco.acovoucodigo = $voucodigo");
        if( $db->linhas>0 ){
            foreach( $db->gs['ACOCODIGO'] as  $value ){
                     $file2        = $file."qrcode".str_pad($voucodigo, 8, '0', STR_PAD_LEFT)."A".str_pad($value, 8, '0', STR_PAD_LEFT).".png";
                     $qrcode       = str_pad($voucodigo, 8, '0', STR_PAD_LEFT)."A".str_pad($value, 8, '0', STR_PAD_LEFT);
                     $url2         = $url.$qrcode;
                     QRcode::png($url2, $file2, 'L', 10, 2);
            }
        }            
    }

    echo "<div><h4 class='alinharH4'>Sua reserva foi realizada com sucesso,<br> verifique o voucher abaixo</h4><br><br></div>";
    echo "<div class='alinhaCards'>";

    $db->open("select *, 
                    DATE_FORMAT( voudata,'%d/%m/%Y') as dvisita 
                from voucher vou, 
                    pessoa pes 
                where pescodigo = voupescodigo 
                and voucodigo = '$voucodigo' ");

    voucher($db->gs['PESNOME'][0],
            $db->gs['PESCPF'][0], 
            $db->gs['DVISITA'][0],
            $file, 
            $voucodigo, 
            0 );

    print "<br><br>";

    $db->open("select *, 
                    DATE_FORMAT( voudata,'%d/%m/%Y') as dvisita 
                from voucher vou,
                    acompanhante aco, 
                    pessoa pes 
                where pescodigo = voupescodigo 
                and aco.acovoucodigo = vou.voucodigo 
                and voucodigo = '$voucodigo' ");

    if( isset($db->linhas )  && $db->linhas>0 ){
        
        foreach( $db->gs['ACOCODIGO'] as $id => $value ){
            voucher($db->gs['ACONOME'][$id],
                    $db->gs['ACODOCUMENTO'][$id], 
                    $db->gs['DVISITA'][$id],
                    $file,
                    $voucodigo,
                    $value );
                  
        }
        
    }
   echo "</div>";
}

function voucher($nome, $cpf, $dvisita, $file,$voucodigo,$value ){

    $nomeArquivo = $file."qrcode".str_pad($voucodigo, 8, '0', STR_PAD_LEFT)."A".str_pad($value, 8, '0', STR_PAD_LEFT).".png";
    $voucodigo2  = str_pad($voucodigo, 8, '0', STR_PAD_LEFT)."A".str_pad($value, 8, '0', STR_PAD_LEFT);
    $cpf2        = substr($cpf,0,3)."****".substr($cpf,7,4);
    ?>
    
    <div class="container">  
        
        <img src="images/logopmfbranco.png" alt="Logo" class="logo">
        <div class="linha-branca"></div>
        <!--<h4>Sua reserva foi realizada com sucesso,<br> verifique o voucher abaixo</h4>-->
        <h2>ILHA DO CAMPECHE</h2>
        <h2><?=$dvisita; ?></h2>
        <!--<div style="width: 200px; height: 200px; background-color: #fff; border-radius: 20px; margin: 20px auto;"></div>-->
        <img src="<?=$nomeArquivo;?>" width="200px;" height="200px;" >        
        <h2><?=$voucodigo2; ?></h2>
        <h4> Titular: <?=$nome; ?> </h4>
        <h4> CPF: <?=$cpf2; ?> </h4>
        <h4> Data de Emissão: <?=date('d/m/Y'); ?> </h4>
        <h5>Consulte o Regulamento <a href="">Aqui</a></h5>
       

    </div>
    
   
<?php
}

?>

<style>
        body {

margin: 0;
padding: 0;
background-color: #f2f2f2;
}


.alinharH4 {
display: flex;
justify-content: center;
}

.alinhaCards {
font-family: Arial, sans-serif;
display: flex;
flex-wrap: wrap;
align-items: center;
justify-content: center;

}

.container {
margin: 1%;
text-align: center;
max-width: 250px;
padding: 20px;
background: linear-gradient(to bottom right, #002f66, #0093d4);
border-radius: 20px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
color: #fff;
}

.logo {
max-width: 250px;

}

.linha-branca {
width: 100%;
height: 1px;
background-color: #fff;
margin: 10px 0;
}

   /* Estilos específicos para impressão */
   @media print {
        .alinhaCards {
            display: block; 
            
            margin-left: 30%;

            
        }
        .container {
            page-break-before: always; 
            
        }
        .alinharH4{
            visibility: hidden;
            display: none;
            height: 0;
            overflow: hidden;
        }
    }
</style>