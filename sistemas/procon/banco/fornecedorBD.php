<?php

include_once("../../banco/gdb.php"); 

$gdb = new gdb();  

$nome           = $gdb->vargetpost('nome');
$cpf            = $gdb->vargetpost('cpf');
$celular        = $gdb->vargetpost('celular');
$telefone       = $gdb->vargetpost('telefone');
$cep            = $gdb->vargetpost('cep');
$logradouro     = $gdb->vargetpost('logradouro');
$bairro         = $gdb->vargetpost('bairro');
$municipio      = $gdb->vargetpost('municipio');
$numero         = $gdb->vargetpost('numero');
$email          = $gdb->vargetpost('email');
$estado         = $gdb->vargetpost('estado');
$complemento	= $gdb->vargetpost('complemento');
$codigoprojeto  = 'PROCON';
$temCPF         = 0;

// Retirando os ponto e traço do CEP	
$cep = str_replace('.','',$cep);
$cep = str_replace('-','',$cep);

if( strlen( $cpf ) == 11 ) $campoDocumento = 'cpf';
else $campoDocumento = 'cnpj';
/*
  print "<pre>";
  print_r( $_GET );
  print_r( $_POST );
  print_r( $_FILES );
  print "</pre>";
*/

$gdb->open("select * from pessoa p , pessoaAuxiliar pa  where p.codigopessoa = pa.codigopessoa and $campoDocumento = '$cpf' and codigoprojeto = '$codigoprojeto' and pa.situacaoPROCON='F' ");

if( $gdb->linhas > 0 ){
	$temCPF = 1;
}
	
/* 

$gdb->open("select * from pessoa p , pessoaAuxiliar pa  where p.codigopessoa = pa.codigopessoa and email = '$email' and codigoprojeto = '$codigoprojeto' ");
if( $gdb->linhas > 0 ){
	$temEmail = 1;
}

*/

if( !$temCPF  ){
	
		$gdb->open("INSERT INTO pessoa ( nome, 									 
										 $campoDocumento, 
										 senha, 
										 celular, 
										 telefone, 
										 identidade,
										 email )
								VALUES ( '$nome',									  
										 '$cpf', 
										 '$senha',
										 '$celular',
										 '$telefone',
										 '$rg',
										 '$email' )");
										 
		$gdb->open("select max(codigopessoa) as codigo from pessoa ");
		$codigo = $gdb->gs['CODIGO'][0];

		$gdb->open("INSERT INTO pessoaAuxiliar ( codigopessoa,
												 codigoprojeto,
												 situacaoPROCON	)										 
								VALUES ( $codigo,
										'$codigoprojeto',
										'F' ) " );

		$gdb->open("INSERT INTO pessoaEndereco (  codigopessoa,
												  cep, 
												  logradouro, 
												  bairro, 
												  municipio, 
												  numero, 	
												  complemento,												  
												  estado,
												  pais,
												  codigoprojeto )
										VALUES (  $codigo,
												 '$cep',
												 '$logradouro', 
												 '$bairro',
												 '$municipio',
												 '$numero',
												 '$complemento',
												 '$estado',
												 'BRASIL',
												 '$codigoprojeto')");
		
		$operacao = array( "success"=>"1","mensagem"=>"Cadastro de Fornecedor realizado com SUCESSO!" );
				 
}else{

	if( $temCPF ){
		$operacao = array( "success"=>"2","mensagem"=>"Já tem um cadastro com esse $campoDocumento !" );
	}

}
	$retorno = json_encode( $operacao );
	echo $retorno;							
?>