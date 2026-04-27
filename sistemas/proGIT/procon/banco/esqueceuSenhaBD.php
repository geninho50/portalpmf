<?php

include_once("/home/www/sistemas/banco/gdb.php"); 
include_once("/home/www/sistemas/Biblioteca/email/enviarEmailPROCON.php"); 

$gdb 			= new gdb();  

$email          = $gdb->vargetpost('email');
$corpoMensagem	= "";
$txtAssunto 	= "ESQUECEU SENHA ";

$gdb->open("select p.codigoPessoa as codigo 
			  From pessoa p, 
				   pessoaAuxiliar pa 
			 where p.codigoPessoa = pa.codigoPessoa  
			   and upper(p.email) = upper('$email') 
			   and pa.codigoProjeto = 'PROCON' ");

if( $gdb->linhas>0 ){
	$codigo          = $gdb->gs['CODIGO'][0];	
	$corpoMensagem	.= "Clique <a href='https://www.pmf.sc.gov.br/sistemas/procon/index.php?codigo=$codigo' target = '_blank' ><b>aqui</b></a> e faça uma nova senha.";
	$error = smtpmailer($email,'sistema.procon@pmf.sc.gov.br',  $txtNome, $txtAssunto, iconv('utf-8','iso-8859-1',$corpoMensagem) );
	if( strpos($error,'Sucesso')>0 ){
		$operacao = array( "success"=>"1","mensagem"=>"Foi enviado um email com informações para criação de uma nova senha !" );
	}else {
		$operacao = array( "success"=>"2","mensagem"=>"Erro no envio de email :".$error );
	}
}else{
	$msg = iconv('utf-8','iso-8859-1','Não foi encontrado nenhum consumidor com esse email!');
	$operacao = array( "success"=>"1","mensagem"=>$msg );
}

$retorno = json_encode( $operacao );
echo $retorno;		
?>