<?php
@header("Cache-Control: no-cache, must-revalidate");
@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 


include_once("../../banco/gdb.php"); 
include_once("../../Biblioteca/email/enviarEmailPROCON.php"); 

$gdb 			 = new gdb();  

$nome            = $gdb->vargetpost('nome');
$email           = $gdb->vargetpost('email');
$duvida   	     = $gdb->vargetpost('duvida');
$situacao        = $gdb->vargetpost("inSituacao");

$corpoMensagem	 = "";

$txtNome 		 = iconv('utf-8','iso-8859-1//TRANSLIT',$nome );
$txtAssunto		 = "DUVIDA DO CONSUMIDOR ";

$corpoMensagem	.= "<b>DADOS DA DUVIDA</b><br><br>";
$corpoMensagem	.= "Nome ......:  $nome <br>";
$corpoMensagem	.= "Email .....:  $email <br><br>";
$corpoMensagem	.= "<b>DUVIDA :</b><br> $duvida <br><br> ";

$error = smtpmailer('procon.online@pmf.sc.gov.br', 'sistema.procon@pmf.sc.gov.br',iconv('utf-8','iso-8859-1',"Sistema DGOV"), $txtAssunto, iconv('utf-8','iso-8859-1//TRANSLIT',$corpoMensagem) );					
$operacao = array( "success"=>"1","mensagem"=>"Sua duvida foi enviada com sucesso !" );					

$retorno = json_encode( $operacao );
echo $retorno;	
?>