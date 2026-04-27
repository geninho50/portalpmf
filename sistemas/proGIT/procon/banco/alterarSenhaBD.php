<?php

include_once("../../banco/gdb.php"); 

$gdb = new gdb();  

$senha           = md5( $gdb->vargetpost('senha') );
$atual           = md5( $gdb->vargetpost('atual') );
$repita          = $gdb->vargetpost('repita');
$codigoPessoa    = $gdb->vargetpost('codigoPessoa');

/*
  print "<pre>";
  print_r( $_GET );
  print_r( $_POST );
  print_r( $_FILES );
  print "</pre>";
*/

$gdb->open("SELECT u.codigoUsuario as codigo 
             FROM pessoa p, 
			      usuario u 
		    WHERE p.email = u.login 
			  AND p.codigoPessoa = '$codigoPessoa'  ");

if( $gdb->linhas > 0 ){
	$codigo = $gdb->gs['CODIGO'][0];
	$gdb->open("UPDATE usuario SET senha = '$senha' WHERE codigoUsuario='$codigo' ");
	$operacao = array( "success"=>"1","mensagem"=>"Senha foi alterada com SUCESSO!" );			 
}else{
   $operacao = array( "success"=>"2","mensagem"=>"Senha atual não foi confirmada !" );
}

$retorno = json_encode( $operacao );
echo $retorno;							
?>