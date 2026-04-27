<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$habilidades = $gdb->vargetpost('habilidades');
$nome        = $gdb->vargetpost('nome');
$rg          = $gdb->vargetpost('rg');
$cpf         = $gdb->vargetpost('cpf');
$pis         = $gdb->vargetpost('pis');
$celular     = $gdb->vargetpost('celular');
$telefone    = $gdb->vargetpost('telefone');
$cep         = $gdb->vargetpost('cep');
$logradouro  = $gdb->vargetpost('logradouro');
$bairro      = $gdb->vargetpost('bairro');
$municipio   = $gdb->vargetpost('municipio');
$numero      = $gdb->vargetpost('numero');
$email       = $gdb->vargetpost('email');
$banco       = $gdb->vargetpost('banco');
$agencia     = $gdb->vargetpost('agencia');
$contaNum    = $gdb->vargetpost('contaNum');
$tipoConta   = $gdb->vargetpost('tipoConta');
$curriculo   = $gdb->vargetpost('curriculo');
$facebook    = $gdb->vargetpost('facebook');
$youtube     = $gdb->vargetpost('youtube');
$video       = $gdb->vargetpost('video');

$gdb->open("select * from pessoa where cpf = '$cpf' ");

if( $gdb->linhas == 0 ){
	$gdb->open("INSERT INTO pessoa ( nome, 
									 identidade, 
									 cpf, 
									 pais, 
									 celular, 
									 telefone, 
									 cep, 
									 logradouro, 
									 bairro, 
									 municipio, 
									 numero, 
									 email )
							VALUES ( '$nome',
									 '$rg', 
									 '$cpf', 
									 '$pis',
									 '$celular',
									 '$telefone',
									 '$cep',
									 '$logradouro', 
									 '$bairro',
									 '$municipio',
									 '$numero',
									 '$email')");
									 
	$gdb->open("select max(codigopessoa) as codigo from pessoa ");
	$codigo = $gdb->gs['CODIGO'][0] + 1;
									 
}else{
	
   $codigo = $gdb->gs['CODIGOPESSOA'][0];	
   
   $gdb->open("UPDATE pessoa 
                  SET nome = '$nome', 
					  identidade = '$identidade', 
					  cpf = '$cpf', 
					  pais = '$pais', 
					  celular = '$celular', 
					  telefone = '$telefone', 
					  cep  = '$cep', 
					  logradouro = '$logradouro', 
					  bairro = '$bairro', 
					  municipio = '$municipio', 
					  numero = '$numero', 
					  email = '$email'   
				WHERE cpf = '$cpf'"); 
}								 

$gdb->open("select * from pessoaAuxiliar where codigopessoa = $codigo ");

if( $gdb->linhas == 0 ){

	$gdb->open("INSERT INTO pessoaAuxiliar ( codigopessoa,
											 banco,
											 agencia,
											 conta,
											 habilidades,
											 curriculo,
											 facebook,
											 youtube,
											 video)										 

							VALUES ( $codigo,
									'$banco',
									'$agencia',
									'$conta',
									'$habilidades',
									'$curriculo',
									'$facebook',
									'$youtube',
									'$video') ");
}else{
	$gdb->open("UPDATE pessoaAuxiliar 
	              SET  banco 	   = '$banco',
					   agencia 	   = '$agencia',
					   conta 	   = '$conta',
					   habilidades = '$habilidades',
  				       curriculo   = '$curriculo',
					   facebook    = '$facebook',
					   youtube     = '$youtube',
					   video 	   = '$video',
				WHERE codigopessoa = '$codigo' ");
}								

?>