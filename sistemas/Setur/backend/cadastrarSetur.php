<?php

require_once("db-comum.php"); 
$cpf   = utf8_decode($_POST['cpf']);
$cpf   = str_replace('.', '', $cpf);
$cpf   = str_replace('-', '', $cpf);

// Verificando o CPF
$sql = "SELECT count(*) as qtd FROM `setur`.`setur` WHERE cpf = '$cpf' ";
$result = $conn->query($sql);
$result = $result->fetch_assoc();

if( $result['qtd']>0 ){
	echo json_encode( array('sucesso' => 0, 'error' => 'Esse CPF já foi cadastrado ! ', 'classe' => 'geral') );
	die();
}

	require_once("db.php"); 

	$nome               = utf8_decode($_POST['nome']); 
	$genero      		= utf8_decode($_POST['genero']);
	$dataNasc    		= utf8_decode($_POST['dataNasc']);
	$rua        		= utf8_decode($_POST['rua']);
	$numero    			= utf8_decode($_POST['numero']);
	$bairro     		= utf8_decode($_POST['bairro']);
	$cep         		= utf8_decode($_POST['cep']);
	$escolaridade  		= utf8_decode($_POST['escolaridade']);
	$email       		= utf8_decode($_POST['email']);
	$telefone    		= utf8_decode($_POST['telefone']);
	$celular     		= utf8_decode($_POST['celular']);
	$profissional  		= utf8_decode($_POST['profissional']);
	$qual        		= utf8_decode($_POST['qual']);
	$ctps        		= utf8_decode($_POST['ctps']);
	$area        		= utf8_decode($_POST['area']);
	$rg       		    = utf8_decode($_POST['rg']);

	verificaVazio($nome, 'nome', 'nome' );
	verificaVazio($dataNasc, 'Data de Nascimento', 'dataNasc' );
	verificaVazio($genero, 'genero', 'genero' );
	verificaVazio($rua, 'rua', 'rua' );
	verificaVazio($numero, 'numero', 'numero' );
	verificaVazio($bairro, 'bairro', 'bairro' );
	verificaVazio($escolaridade, 'escolaridade', 'escolaridade' );
	verificaVazio($email, 'email', 'email' );
	verificaVazio($celular, 'celular', 'celular' );
	verificaVazio($profissional, 'profissional', 'profissional' );
	verificaVazio($ctps, 'ctps', 'ctps' );
	verificaVazio($rg, 'rg', 'rg' );
	verificaVazio($cpf, 'cpf', 'cpf' );



	$db->beginTransaction();
	$insertQuery = "INSERT INTO `setur`.`setur` 
								 ( `nome`, 
								 `genero`, 
								 `dataNasc`, 
								 `rua`, 
								 `numero`, 
								 `bairro`, 
								 `cep`, 
								 `escolaridade`, 
								 `email`, 
								 `telefone`, 
								 `celular`, 
								 `profissional`, 
								 `qual`, 
								 `ctps`, 
								 `area`, 
								 `rg`,
								 `cpf`)
								 VALUES 
								 	('$nome', 
								 	'$genero', 
								 	'$dataNasc', 
								 	'$rua', 
								 	'$numero', 
								 	'$bairro', 
								 	'$cep', 
								 	'$escolaridade', 
								 	'$email', 
								 	'$telefone', 
								 	'$celular', 
								 	'$profissional', 
								 	'$qual', 
								 	'$ctps', 
								 	'$area', 
								 	'$rg', 
								 	'$cpf')";

	$execute = $db->exec($insertQuery);


	if($execute){
		//session_start();
		//$_SESSION['id'] = $db->lastInsertId();
		$id1 = $db->lastInsertId();
		$db->commit();
		echo json_encode( array('sucesso' => 1, 'id' => $id1) );
	}else{
		echo json_encode( array('sucesso' => 0, 'error' => 'Falha ao enviar', 'classe' => 'geral') );
	} 

function verificaVazio($var, $fieldName, $fieldProblem) {
    if(empty($var)){
        $error = 'O Campo "'.$fieldName.'" não pode ficar em branco';
        echo json_encode(array('success' => 0, 'error' => $error, 'fieldProblem' => $fieldProblem));
        die;
    }
}

?>