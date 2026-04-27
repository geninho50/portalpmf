<?php

require_once("db-comum.php"); 


	require_once("db.php"); 

	$nome           = utf8_decode($_POST['nome']); 
	$localidade     = utf8_decode($_POST['localidade']);
	$fone1    		= utf8_decode($_POST['fone1']);
	$proposta       = utf8_decode($_POST['proposta']);
	$email       	= utf8_decode($_POST['email']);
	$justificativa  = utf8_decode($_POST['justificativa']);
	$metodologia    = utf8_decode($_POST['metodologia']);
	$entidade  		= utf8_decode($_POST['entidade']);


	verificaVazio($nome, 'nome', 'nome' );
	verificaVazio($localidade, 'localidade', 'localidade' );
	verificaVazio($fone1, 'telefone', 'fone1' );
	verificaVazio($email, 'email', 'email' );
	verificaVazio($proposta, 'proposta', 'proposta' );
	verificaVazio($justificativa, 'justificativa', 'justificativa' );
	verificaVazio($metodologia, 'metodologia', 'metodologia' );



	$db->beginTransaction();
	$insertQuery = "INSERT INTO `infraestrutura`.`dados` 
								 ( `nome`, 
								 `localidade`, 
								 `fone1`, 
								 `proposta`, 
								 `email`, 
								 `justificativa`, 
								 `metodologia`, 
								 `entidade`)
								 VALUES 
								 	('$nome', 
								 	'$localidade', 
								 	'$fone1', 
								 	'$proposta', 
								 	'$email', 
								 	'$justificativa', 
								 	'$metodologia', 
								 	'$entidade')";

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