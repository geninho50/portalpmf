<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$nome          = $gdb->vargetpost('nome');
$cpf           = $gdb->vargetpost('cpf');
$celular       = $gdb->vargetpost('celular');
$telefone      = $gdb->vargetpost('telefone');
$email         = $gdb->vargetpost('email');
$codigoprojeto = $gdb->vargetpost('codigoprojeto');

$gdb->open("select * from pessoa where cpf = '$cpf' ");

if( $gdb->linhas == 0 ){
	$gdb->open("INSERT INTO pessoa ( nome, 									 
									 cpf, 
									 celular, 
									 telefone, 						 
									 email )
							VALUES ( '$nome',									  
									 '$cpf',
									 '$celular',
									 '$telefone',
									 '$email')");
									 
	$gdb->open("select max(codigopessoa) as codigo from pessoa ");
	$codigo = $gdb->gs['CODIGO'][0];
									 
}else{
	
   $codigo = $gdb->gs['CODIGOPESSOA'][0];	
   
   $gdb->open("UPDATE pessoa 
                  SET nome = '$nome', 
					  celular = '$celular', 
					  telefone = '$telefone', 
					  email = '$email'
				WHERE cpf = '$cpf'" ); 
}								 

$gdb->open("select * from pessoaAuxiliar where codigopessoa = $codigo ");

if( $gdb->linhas == 0 ){
	$gdb->open("INSERT INTO pessoaAuxiliar ( codigopessoa,
	                                         codigoprojeto )										 

							VALUES ( $codigo,
							        '$codigoprojeto') " );
}

$gdb->open("select * from eventoInscricao where codigopessoa = $codigo and codigoturma = $curso ");

if( $gdb->linhas == 0 ){
	$gdb->open("INSERT INTO eventoInscricao ( codigopessoa,
	                                          codigoEvento,
											  tipo )										 

							VALUES ( $codigo,
	                                 1,
									 'E') " );	
}

$operacao = array( "codigo"=>"$codigo","evento"=>"1" );
$retorno = json_encode( $operacao );
echo $retorno;

?>