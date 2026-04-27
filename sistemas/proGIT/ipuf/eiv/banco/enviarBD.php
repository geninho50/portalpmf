<?php

@header("Cache-Control: no-cache, must-revalidate");
@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

include_once("/home/www/sistemas/banco/gdb.php"); 
include_once("/home/www/sistemas/Biblioteca/email/enviarEmaiIPUF.php"); 

$gdb 			 = new gdb();  

$nome            = $gdb->vargetpost('nome');
$email           = $gdb->vargetpost('email');
$duvida   	     = $gdb->vargetpost('duvida');
$tipo            = $gdb->vargetpost("tipo");
$txtAssunto      = $gdb->vargetpost("area");
$corpoMensagem	 = "";

$txtNome 		 = iconv('utf-8','iso-8859-1//TRANSLIT',$nome );

$corpoMensagem	.= "<b>Dados da $tipo</b><br><br>";
$corpoMensagem	.= "Nome ......:  $nome <br>";
$corpoMensagem	.= "Email .....:  $email <br><br>";
$corpoMensagem	.= "<b>$tipo :</b><br> $duvida <br><br> ";

$error = smtpmailer('atendimento.ipuf@pmf.sc.gov.br', 
                    'suporte.site@pmf.sc.gov.br',
                    iconv('utf-8','iso-8859-1','Sistema DGOV'), 
                    $txtAssunto, 
                    iconv('utf-8','iso-8859-1//TRANSLIT',$corpoMensagem) );

$operacao = array( "success"=>"1","mensagem"=>"Sua $tipo foi enviada com sucesso !" );					

$retorno = json_encode( $operacao );
echo $retorno;	

?>