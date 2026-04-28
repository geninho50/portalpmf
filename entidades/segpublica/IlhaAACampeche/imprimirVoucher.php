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
$voucodigo = $db->vargetpost("voucodigo");

echo "<div><h4 class='alinharH4'>Imprima o voucher abaixo</h4><br><br></div>";
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