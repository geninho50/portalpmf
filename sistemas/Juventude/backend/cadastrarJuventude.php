<?php

require_once("db-comum.php"); 
$cpf   = utf8_decode($_POST['cpf']);
$cpf   = str_replace('.', '', $cpf);
$cpf   = str_replace('-', '', $cpf);
$turno = utf8_decode($_POST['turno']);

/* Inicio Obtendo idturma */
$idcurso = substr($_POST['turno'],0,1);
$nuturma = substr($_POST['turno'],1);

$sqlturma = "SELECT idturma FROM `juventude`.`turma` WHERE idcurso = '$idcurso' AND nuturma = '$nuturma'";
$resultturma = $conn->query($sqlturma);
$resultturma = $resultturma->fetch_assoc();
$idturma = $resultturma['idturma'];
/* Fim Obtendo idturma */

// Verificando o CPF
$sql = "SELECT count(*) as qtd FROM `juventude`.`juventude` WHERE cpf = '$cpf' AND ano = '".(date("Y"))."'";
$result = $conn->query($sql);
$result = $result->fetch_assoc();

if( $result['qtd']>0 ){
	echo json_encode( array('sucesso' => 0, 'error' => 'Esse CPF já foi cadastrado ! ', 'classe' => 'geral') );
	die();
}

// Verificando o Turno
$sql = "SELECT count(*) as qtd FROM `juventude`.`juventude` WHERE idturma = '$idturma' AND ano = '".(date("Y"))."'";
$result2 = $conn->query($sql);
$result2 = $result2->fetch_assoc();

if( $result2['qtd']<= 29 ){
	require_once("db.php"); 

	$nome               = utf8_decode($_POST['nome']); 
	$genero      		= utf8_decode($_POST['genero']);
	$dataNasc    		= utf8_decode($_POST['dataNasc']);
	$logradouro         = utf8_decode($_POST['logradouro']);
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
	$rg       		    = utf8_decode($_POST['rg']);
	$turno       		= utf8_decode($_POST['turno']); //Usado até 2018
	$turma       		= utf8_decode($idturma); //Usado de 2019 em diante
	$etnia       		= utf8_decode($_POST['etnia']);
	$ano 				= utf8_decode(date('Y'));

	verificaVazio($nome, 'nome', 'nome' );
	verificaVazio($dataNasc, 'Data de Nascimento', 'dataNasc' );
	verificaVazio($genero, 'genero', 'genero' );
	verificaVazio($logradouro, 'logradouro', 'logradouro' );
	verificaVazio($numero, 'numero', 'numero' );
	verificaVazio($bairro, 'bairro', 'bairro' );
	verificaVazio($escolaridade, 'escolaridade', 'escolaridade' );
	verificaVazio($email, 'email', 'email' );
	verificaVazio($celular, 'celular', 'celular' );
	verificaVazio($profissional, 'profissional', 'profissional' );
	verificaVazio($ctps, 'ctps', 'ctps' );
	verificaVazio($turno, 'turno', 'turno' );
	verificaVazio($rg, 'rg', 'rg' );
	verificaVazio($cpf, 'cpf', 'cpf' );



	$db->beginTransaction();
	$insertQuery = "INSERT INTO `juventude`.`juventude` 
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
								 `rg`,
								 `cpf`,
								 `turno`,
								 `idturma`,
								 `etnia`,
								 `ano`)
								 VALUES 
								 	('$nome', 
								 	'$genero', 
								 	'$dataNasc', 
								 	'$logradouro', 
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
								 	'$rg', 
								 	'$cpf', 
								 	'$turno',
								 	'$turma',
								    '$etnia',
									'$ano')";

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
	echo json_encode( array('sucesso' => 0, 'error' => 'Número máximo de inscrições atingido para esta turma', 'classe' => 'geral') );
} 

function verificaVazio($var, $fieldName, $fieldProblem) {
    if(empty($var)){
        $error = 'O Campo "'.$fieldName.'" não pode ficar em branco';
        echo json_encode(array('success' => 0, 'error' => $error, 'fieldProblem' => $fieldProblem));
        die;
    }
}

?>