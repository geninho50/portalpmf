<?php

  @header("Cache-Control: no-cache, must-revalidate");
  @header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

include_once("../../banco/gdb.php"); 
include_once("../../banco/sessao.php");       

$gdb = new gdb();  
$sessao = new sessao();

$codigoPessoa = $gdb->vargetpost('codigoPessoa');

$gdb->open("SELECT u.codigoUsuario as codigo 
             FROM pessoa p, 
			      usuario u 
		    WHERE p.email = u.login 
			  AND p.codigoPessoa = '$codigoPessoa'  ");


if( $gdb->linhas > 0 ){
	$usid = $gdb->gs['CODIGO'][0];
	$sessao->encerrar_sessao('PROCON', $usid);
	$operacao = array( "success"=>"1","mensagem"=>"Senha foi alterada com SUCESSO!" );			 
}else{
   $operacao = array( "success"=>"2","mensagem"=>"Usuário não foi encontrado!" );
}
$retorno = json_encode( $operacao );
echo $retorno;

?>