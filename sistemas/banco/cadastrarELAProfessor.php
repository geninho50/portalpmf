<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$habilidades   = $gdb->vargetpost('habilidades');
$nome          = $gdb->vargetpost('nome');
$rg            = $gdb->vargetpost('rg');
$cpf           = $gdb->vargetpost('cpf');
$pis           = $gdb->vargetpost('pis');
$celular       = $gdb->vargetpost('celular');
$telefone      = $gdb->vargetpost('telefone');
$cep           = $gdb->vargetpost('cep');
$logradouro    = $gdb->vargetpost('logradouro');
$bairro        = $gdb->vargetpost('bairro');
$municipio     = $gdb->vargetpost('municipio');
$numero        = $gdb->vargetpost('numero');
$email         = $gdb->vargetpost('email');
$banco         = $gdb->vargetpost('banco');
$agencia       = $gdb->vargetpost('agencia');
$conta     	   = $gdb->vargetpost('contaNum');
$tipoConta     = $gdb->vargetpost('tipoConta');
$curriculo     = $gdb->vargetpost('curriculo');
$facebook      = $gdb->vargetpost('facebook');
$youtube       = $gdb->vargetpost('youtube');
$video         = $gdb->vargetpost('video');
$codigoprojeto = $gdb->vargetpost('codigoprojeto');
$nascimento    = $gdb->vargetpost('nascimento');
$codigoPessoa  = $gdb->vargetpost('codigoPessoa');
$profissao     = $gdb->vargetpost('profissao');

if( $logradouro !="" && $codigoPessoa == "" ){
	
    $gdb->open("select * from pessoa where cpf = '$cpf' ");	
	
	if( $gdb->linhas == 0 && $logradouro !='' ){
		
		$gdb->open("INSERT INTO pessoa ( nome, 									 
										 cpf, 
										 pis, 
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
										 '$pis',
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
										 
	}else if( $gdb->linhas == 1 && $logradouro !='' ) {
		
	   $codigo = $gdb->gs['CODIGOPESSOA'][0];	
	   
	   $gdb->open("UPDATE pessoa 
					  SET nome       = '$nome', 
						  pis        = '$pis', 
						  celular    = '$celular', 
						  telefone   = '$telefone', 
						  cep        = '$cep', 
						  logradouro = '$logradouro', 
						  bairro     = '$bairro', 
						  municipio  = '$municipio', 
						  numero     = '$numero', 
						  estado     = 'SC', 
						  identidade = '$rg',
						  email      = '$email',   
						  pais       = 'BRASIL',
						  nascimento = '$nascimento'
					WHERE codigoPessoa  = '$codigo' "); 
	}								 

	$gdb->open("select * from pessoaAuxiliar where codigopessoa = $codigo and codigoprojeto = '$codigoprojeto' ");

	if( $gdb->linhas == 0 ){

		$gdb->open("INSERT INTO pessoaAuxiliar ( codigopessoa,
												 codigoprojeto,
												 banco,
												 agencia,
												 conta,
												 habilidades,
												 curriculoELA,
												 facebookELA,
												 youtube,
												 video,
												 tipoConta,
												 profissao)										 

								VALUES ( $codigo,
										'$codigoprojeto', 
										'$banco',
										'$agencia',
										'$conta',
										'$habilidades',
										'$curriculo',
										'$facebook',
										'$youtube',
										'$video',
										'$tipoConta',
										'$profissao') " );
	}else{
		$gdb->open("UPDATE pessoaAuxiliar 
					  SET  banco 	     = '$banco',
						   agencia 	     = '$agencia',
						   conta 	     = '$conta',
						   habilidades   = '$habilidades',
						   curriculoELA  = '$curriculo',
						   facebookELA   = '$facebook',
						   youtube       = '$youtube',
						   video 	     = '$video',
						   codigoprojeto = '$codigoprojeto',
						   tipoConta     = '$tipoConta',
						   profissao     = '$profissao'
					WHERE codigopessoa  = '$codigo' ");				
	}								
	$operacao = array( "codigo"=>"$codigo" );
	$retorno = json_encode( $operacao );
	
}else if( $codigoPessoa !=""){
	
		$gdb->open("SELECT * 
					  FROM pessoaAuxiliar 
					 WHERE codigopessoa = $codigoPessoa 
					   AND codigoprojeto = '$codigoprojeto' ");
					   
		$codigo = $codigoPessoa;
		
		if( $gdb->linhas == 0 ){

			$gdb->open("INSERT INTO pessoaAuxiliar ( codigopessoa,
													 codigoprojeto,
													 banco,
													 agencia,
													 conta,
													 habilidades,
													 curriculoELA,
													 facebookELA,
													 youtube,
													 video,
													 tipoConta,
													 profissao)										 

									VALUES ( $codigo,
											'$codigoprojeto', 
											'$banco',
											'$agencia',
											'$conta',
											'$habilidades',
											'$curriculo',
											'$facebook',
											'$youtube',
											'$video',
											'$tipoConta',
											'$profissao') " );
		}else{
			$gdb->open("UPDATE pessoaAuxiliar 
						  SET  banco 	     = '$banco',
							   agencia 	     = '$agencia',
							   conta 	     = '$conta',
							   habilidades   = '$habilidades',
							   curriculoELA  = '$curriculo',
							   facebookELA   = '$facebook',
							   youtube       = '$youtube',
							   video 	     = '$video',
							   codigoprojeto = '$codigoprojeto',
							   tipoConta     = '$tipoConta',
							   profissao     = '$profissao',
							   atualizarDados = sysdate()
						WHERE codigopessoa  = '$codigo' ");				
		}								
		$operacao = array( "codigo"=>"$codigo" );
		$retorno = json_encode( $operacao );
	
}else{
	$operacao = array( "codigo"=>"E" );
	$retorno = json_encode( $operacao );	
}


echo $retorno;
?>