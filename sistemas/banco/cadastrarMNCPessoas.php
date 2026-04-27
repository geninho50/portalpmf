<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$nome          = $gdb->vargetpost('nome');
$rg            = $gdb->vargetpost('rg');
$cpf           = $gdb->vargetpost('cpf');
$celular       = $gdb->vargetpost('celular');
$telefone      = $gdb->vargetpost('telefone');
$cep           = $gdb->vargetpost('cep');
$logradouro    = $gdb->vargetpost('logradouro');
$bairro        = $gdb->vargetpost('bairro');
$municipio     = $gdb->vargetpost('municipio');
$numero        = $gdb->vargetpost('numero');
$email         = $gdb->vargetpost('email');
$codigoprojeto = $gdb->vargetpost('codigoprojeto');
$nascimento    = $gdb->vargetpost('nascimento');
$curso		   = $gdb->vargetpost('curso');
$numeroMorador = $gdb->vargetpost('numeroMorador');
$senha		   = $gdb->vargetpost('senha');
$profissao     = $gdb->vargetpost('profissao');


$gdb->open("select * from pessoa where cpf = '$cpf' ");

if( $gdb->linhas == 0 ){
	$gdb->open("INSERT INTO pessoa ( nome, 									 
									 cpf, 
									 senha, 
									 celular, 
									 telefone, 
									 cep, 
									 logradouro, 
									 bairro, 
									 municipio, 
									 numero, 									 
									 email,
                                     identidade,
                                     estado,
									 pais,
                                     nascimento )
							VALUES ( '$nome',									  
									 '$cpf', 
									 '$senha',
									 '$celular',
									 '$telefone',
									 '$cep',
									 '$logradouro', 
									 '$bairro',
									 '$municipio',
									 '$numero',
									 '$email',
									 '$rg',
									 'SC',
									 'BRASIL',
									 '$nascimento')");
									 
	$gdb->open("select max(codigopessoa) as codigo from pessoa ");
	$codigo = $gdb->gs['CODIGO'][0];
									 
}else{
	
   $codigo = $gdb->gs['CODIGOPESSOA'][0];	
   
   $gdb->open("UPDATE pessoa 
                  SET nome = '$nome', 
					  senha = '$senha', 
					  celular = '$celular', 
					  telefone = '$telefone', 
					  cep  = '$cep', 
					  logradouro = '$logradouro', 
					  bairro = '$bairro', 
					  municipio = '$municipio', 
					  numero = '$numero', 
					  estado = 'SC', 
					  identidade = '$rg',
					  email = '$email',   
					  pais  = 'BRASIL',
					  nascimento = '$nascimento'
				WHERE cpf = '$cpf'" ); 
}								 

$gdb->open("select * from pessoaAuxiliar where codigopessoa = $codigo ");

if( $gdb->linhas == 0 ){
	$gdb->open("INSERT INTO pessoaAuxiliar ( codigopessoa,
	                                         codigoprojeto,
											 numeroMorador,
											 profissao )										 

							VALUES ( $codigo,
							        '$codigoprojeto',
									'$numeroMorador',
									'$profissao') " );
}else{
	$gdb->open("UPDATE pessoaAuxiliar 
	              SET  numeroMorador = '$numeroMorador',
					   profissao 	 = '$profissao'				  
				WHERE codigopessoa  = '$codigo'
                  AND codigoprojeto = '$codigoprojeto' ");				
}

$gdb->open("select * from eventoInscricao where codigopessoa = $codigo and codigoturma = $curso ");

if( $gdb->linhas == 0 ){
	$gdb->open("INSERT INTO eventoInscricao ( codigopessoa,
	                                          codigoturma,
											  tipo )										 

							VALUES ( $codigo,
	                                 $curso,
									 'P') " );	
}

$operacao = array( "codigo"=>"$codigo","curso"=>"$curso" );
$retorno = json_encode( $operacao );
echo $retorno;

?>