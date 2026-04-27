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
$inscricao     = $gdb->vargetpost('inscricao');

$gdb->open("select * from pessoa where cpf = '$cpf' ");

if( $gdb->linhas != 0 ){
		
    $codigo = $gdb->gs['CODIGOPESSOA'][0];	
   
    $gdb->open("UPDATE pessoa 
				  SET identidade = '$rg',
					  nascimento = '$nascimento'
				WHERE codigopessoa= '$codigo' " ); 

    $gdb->open("select * from pessoaEndereco where codigopessoa = '$codigo' and codigoprojeto = '1' ");   				
   
    if( $gdb->linhas == 0 ){
	   $gdb->open(" INSERT INTO pessoaEndereco ( cep, 
												 logradouro, 
												 bairro, 
												 municipio, 
												 numero, 									 									 
												 estado,
												 pais,
												 codigoprojeto,
												 codigopessoa	)
										VALUES ( '$cep',
												 '$logradouro', 
												 '$bairro',
												 '$municipio',
												 '$numero',									 									 
												 'SC',
												 'BRASIL',
												 '1',
												 '$codigo' ) ");	   
    }else{
		 $gdb->open("  UPDATE pessoaEndereco 
						  SET cep  		 	= '$cep', 
							  logradouro 	= '$logradouro', 
							  bairro 	 	= '$bairro', 
							  municipio  	= '$municipio', 
							  numero 	 	= '$numero', 
							  estado 	 	= 'SC', 							  
							  email 	 	= '$email',   
							  pais  	 	= 'BRASIL',
							  codigopessoa  = '$codigo',
							  codigoprojeto = '1'							  
						WHERE codigopessoa  = '$codigo' 
						  AND codigoprojeto = 1 "); 	   
		   
    }

	$gdb->open("select * from pessoaAuxiliar where codigopessoa = '$codigo' and codigoprojeto = 'MNC' ");

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
		$gdb->open("UPDATE pessoaAuxiliar SET  numeroMorador = '$numeroMorador'	WHERE codigopessoa  = '$codigo' AND codigoprojeto = '$codigoprojeto' ");
	}

	$gdb->open("UPDATE eventoInscricao SET codigoturma = '$curso', tipo = 'C' WHERE  codigoInscricao = '$inscricao' " );


	$operacao = array( "codigo"=>"$codigo","curso"=>"$curso" );
	$retorno = json_encode( $operacao );
	echo $retorno;
}else{
	echo 0;								 
}	
?>