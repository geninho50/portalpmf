<?php

include_once("gdb.php"); 

$gdb = new gdb();  
$gdb1 = new gdb();  
$gdb2 = new gdb();  

$nome         		 = $gdb->vargetpost('nome');
$cpf           		 = $gdb->vargetpost('cpf');
$email     		     = $gdb->vargetpost('email');
$telefone     		 = $gdb->vargetpost('telefone');
$secretaria          = $gdb->vargetpost('secretaria');
$funcao       	  	 = $gdb->vargetpost('funcao');
$matriculaEmpresa    = $gdb->vargetpost('matriculaEmpresa');
$setor               = $gdb->vargetpost('setor');


$gdb->open("SELECT count(*)as tem FROM usuarioDGOV WHERE cpf = '$cpf' ");
$gdb2->open("SELECT count(*)as tem FROM usuarioDGOV WHERE upper(email) =upper('$email') ");

if( $gdb->gs["TEM"][0] != 0)  {
	$error = 'Já existe um cadastrado com esse CPF !';
    echo json_encode(array('success' => 0, 'error' => $error));    
}elseif( $gdb1->gs["TEM"][0] != 0){
	$error = 'Já existe um cadastrado com esse email !';
    echo json_encode(array('success' => 0, 'error' => $error));    
}else{ 

	verificaVazio($nome, 'nome', 'nome' );
	verificaVazio($cpf, 'cpf', 'cpf' );
	verificaVazio($email, 'email', 'email' );
	verificaVazio($telefone, 'telefone', 'telefone' );
	verificaVazio($secretaria, 'secretaria', 'secretaria' );
	verificaVazio($matriculaEmpresa, 'matriculaEmpresa', 'matriculaEmpresa' );
	verificaVazio($setor, 'setor', 'setor' );


	$gdb->open("INSERT INTO usuarioDGOV ( nome, 									 
										 cpf, 
										 email,
										 telefone, 
										 secretaria, 
										 funcao, 
										 matriculaEmpresa,
										 setor )
								VALUES ( '$nome',									  
										 '$cpf', 
										 '$email', 
										 '$telefone',
										 '$secretaria',
										 '$funcao',
										 '$matriculaEmpresa',
										 '$setor')");	
    echo json_encode(array('success' => 1));	

		$Destinatario="no-reply.ad@pmf.sc.gov.br";

		$Titulo="Cadastro de Usuario";

		$mensagem1="Dados:

		Nome: $nome
		CPF: $cpf
		Email: $email
		Telefone: $telefone
		Secretaria: $secretaria
		Setor: $setor
		Regima: $funcao
		(1- Efetivo, 2- Estagiagio e 3- Terceirizado) 
		Matricula ou Empresa: $matriculaEmpresa

		";

	mail("$Destinatario","$Titulo", "$mensagem1","From:".iconv('utf-8','iso-8859-1', "Criação AD" ));									 
	
	echo $retorno;										 
}									 
										 

function verificaVazio($var, $fieldName, $fieldProblem) {
    if(empty($var)){
        $error = 'O Campo "'.$fieldName.'" não pode ficar em branco';
        echo json_encode(array('success' => 0, 'error' => $error, 'fieldProblem' => $fieldProblem));
        die;
    }
}
?>