<?php

include_once("gdb.php"); 

$gdb = new gdb();  
$gdb2 = new gdb(); 

$cnpj         		 = $gdb->vargetpost('cnpj');
$nome         		 = $gdb->vargetpost('nome');
$responsavel         = $gdb->vargetpost('responsavel');
$telefone     		 = $gdb->vargetpost('telefone');
$celular       	     = $gdb->vargetpost('celular');
$cep                 = $gdb->vargetpost('cep');
$logradouro          = $gdb->vargetpost('logradouro');
$numero              = $gdb->vargetpost('numero');
$complemento         = $gdb->vargetpost('complemento');
$bairro              = $gdb->vargetpost('bairro');
$email     		     = $gdb->vargetpost('email');
$senha     		     = $gdb->vargetpost('senha');
$regiao              = $gdb->vargetpost('regiao');
$descricaoInteresse  = $gdb->vargetpost('descricaoInteresse');

$gdb->open("SELECT idEscola FROM escola WHERE cnpj = '$cnpj' ");

$gdb2->open("SELECT login FROM usuario WHERE UPPER(login) = UPPER('$email') AND codigoProjeto = 'JME'");

if ($gdb2->linhas != 0) {
	echo json_encode(array('error' => "Este email já esta sendo usado!"));
} else {

	if($gdb->open("INSERT INTO escola ( cnpj, 	
										 nome,								 
										 responsavel, 
										 telefone,
										 celular,
										 cep,
										 endereco,
										 numero,
										 complemento,
										 bairro,
										 email,
										 regiao,
										 descricaoInteresse )
										VALUES ( '$cnpj',
												 '$nome',									  
												 '$responsavel',
												 '$telefone',
												 '$celular',
												 '$cep',
												 '$logradouro',
												 '$numero',
												 '$complemento',
												 '$bairro',
												 '$email', 
												 '$regiao',
												 '$descricaoInteresse')")){
		$senha = md5($senha);

		$gdb->open("INSERT INTO usuario ( login,
										  nome,
										  senha,
										  codigoProjeto,
										  status,
										  perfil )
										VALUES ('$email', 
												'$nome',
												'$senha',
												'JEM',
												'1',
												'P')");	

		echo json_encode(array('success' => 1));

	}else {

		echo json_encode(array('error' => 0));

	}
 	
}
								 
										 
?>