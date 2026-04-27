<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$tipo  	        = $gdb->vargetpost('tipo');
$titulo  	    = $gdb->vargetpost('titulo');
$texto   	    = $gdb->vargetpost('texto');
$codigoUsuario  = $gdb->vargetpost('codigoUsuario');
$codigoMensagem = $gdb->vargetpost('codigoMensagem');

if( $tipo == "m" ){ $select = "INSERT INTO caixaEnvioMNC ( codigoUsuario,assunto, mensagem )VALUES ( '$codigoUsuario','$titulo','$texto' )"; }
else{ $select = "INSERT INTO caixaRespostaMNC ( codigoUsuario,codigoMensagem, resposta )VALUES ( '$codigoUsuario','$codigoMensagem','$texto' )"; }

if( $gdb->open( $select ) ){ 
   echo 1;	
}else{
   echo 0;
}
?>