<?php

require_once("db-comum.php"); 
$cpf   = utf8_decode($_POST['cpf']);
$cpf   = str_replace('.', '', $cpf);
$cpf   = str_replace('-', '', $cpf);
$turno = utf8_decode($_POST['turno']);

// Verificando o CPF
$sql = "SELECT count(*) as qtd FROM `maratonaFotografica`.`minicurso` WHERE cpf = '$cpf' ";
$result = $conn->query($sql);
$result = $result->fetch_assoc();

if( $result['qtd']>3 ){
	echo json_encode( array('sucesso' => 0, 'error' => 'Esse CPF já foi cadastrado mais que 2 vezes ! ', 'classe' => 'geral') );
	die();
}

// Verificando o Turno
$sql = "SELECT count(*) as qtd FROM `maratonaFotografica`.`minicurso`";
$result2 = $conn->query($sql);
$result2 = $result2->fetch_assoc();

if( $result2['qtd']<=60 ){
	require_once("db.php"); 

$nome                = utf8_decode($_POST['nome']);
$idade               = utf8_decode($_POST['idade']);
$responsavel         = utf8_decode($_POST['responsavel']);
$cpf                 = utf8_decode($_POST['cpf']);
$telefone            = utf8_decode($_POST['telefone']);
$email               = utf8_decode($_POST['email']);
$cep                 = utf8_decode($_POST['cep']);
$logradouro          = utf8_decode($_POST['logradouro']);
$numero              = utf8_decode($_POST['numero']);
$bairro              = utf8_decode($_POST['bairro']);
$municipio           = utf8_decode($_POST['municipio']);


verificaVazio($nome, 'Nome Completo', 'nome' );
verificaVazio($idade, 'Idade', 'idade' );
verificaVazio($responsavel, 'Nome do Responsável', 'responsavel' );
verificaVazio($cpf, 'cpf', 'cpf' );
verificaVazio($email, 'Email', 'email' );
verificaVazio($telefone, 'Telefone', 'telefone' );
verificaVazio($logradouro, 'logradouro', 'logradouro' );
verificaVazio($numero, 'numero', 'numero' );
verificaVazio($bairro, 'Bairro', 'bairro' );
verificaVazio($cep, 'CEP', 'cep' );
verificaVazio($municipio, 'municipio', 'municipio' ); 



	$db->beginTransaction();
	$insertQuery = "INSERT INTO `maratonaFotografica`.`minicurso` 
								(`nome`, 
								`idade`,
								`responsavel`,
								`cpf`, 
								`telefone`, 
								`email`, 	
								`cep`, 					
								`endereco`, 
								`numero`, 
								`bairro`, 								
								`municipio`) 
								 VALUES 
								 	('$nome', 
								 	'$idade', 
								 	'$responsavel', 
								 	'$cpf', 
								 	'$telefone', 
								 	'$email', 
								 	'$cep', 
								 	'$logradouro', 
								 	'$numero', 
								 	'$bairro', 
								 	'$municipio')";

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

}else{
	echo json_encode( array('sucesso' => 0, 'error' => 'Número máximo de inscrições atingidas', 'classe' => 'geral') );
} 

function verificaVazio($var, $fieldName, $fieldProblem) {
    if(empty($var)){
        $error = 'O Campo "'.$fieldName.'" não pode ficar em branco';
        echo json_encode(array('success' => 0, 'error' => $error, 'fieldProblem' => $fieldProblem));
        die;
    }
}

?>