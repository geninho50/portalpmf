<?php

require_once("db.php"); 


ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);


$nome                 = utf8_encode($_POST['nome']);
$logradouro           = utf8_encode($_POST['logradouro']);
$numero               = utf8_encode($data['numero']);
$complemento          = utf8_encode($data['complemento']);
$municipio  		  = utf8_encode($_POST['municipio']);
$bairro               = utf8_encode($_POST['bairro']);
$cep                  = utf8_encode($_POST['cep']);
$telefone             = utf8_encode($_POST['telefone']);
$celular              = utf8_encode($_POST['celular']);
$email1               = utf8_encode($_POST['email1']);
$email2               = utf8_encode($_POST['email2']);
$turma                = utf8_encode($_POST['turma']);
$faixaEtaria          = utf8_encode($_POST['faixaEtaria']);
$titulo               = utf8_encode($_POST['titulo']);
$data      		      = utf8_encode($_POST['data']);
$horario              = utf8_encode($_POST['horario']);
$local                = utf8_encode($_POST['local']);
$ingressosEstudantes 	 = utf8_encode($_POST['ingressosEstudantes']);
$ingressosProfissionais  = utf8_encode($_POST['ingressosProfissionais']);
$nomeResponsavel         = utf8_encode($_POST['nomeResponsavel']);
$foneResponsa    		 = utf8_encode($_POST['foneResponsa']);
$emailResponsa     		 = utf8_encode($_POST['emailResponsa']);


function verificaVazio($var, $campo, $campoClass) {
	if(empty($var)){
		$erro = 'O Campo "'.$campo.'" não pode ficar em branco';
		echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => $campoClass));
		die;
	}
}


$insertQuery = $db->prepare("UPDATE agendamentoGrupos SET
							 nome = :nome, logradouro = :logradouro, numero = :numero, complemento = :complemento, municipio = :municipio, bairro = :bairro, cep = :cep, telefone = :telefone, celular = :celular, email1 = :email1, email2 = :email2, turma = :turma, faixaEtaria = :faixaEtaria, titulo = :titulo, data = :data, horario = :horario,  local = :local, ingressosEstudantes = :ingressosEstudantes, ingressosProfissionais = :ingressosProfissionais, nomeResponsavel = :nomeResponsavel, foneResponsa = :foneResponsa, emailResponsa = :emailResponsa where id = :id");


$insertQuery->bindParam(':nome', $nome);
$insertQuery->bindParam(':logradouro', $logradouro);
$insertQuery->bindParam(':numero', $numero);
$insertQuery->bindParam(':complemento', $complemento);
$insertQuery->bindParam(':municipio', $municipio);
$insertQuery->bindParam(':bairro', $bairro);
$insertQuery->bindParam(':cep', $cep);
$insertQuery->bindParam(':telefone', $telefone);
$insertQuery->bindParam(':celular', $celular);
$insertQuery->bindParam(':email1', $email1);
$insertQuery->bindParam(':email2', $email2);
$insertQuery->bindParam(':turma', $turma);
$insertQuery->bindParam(':faixaEtaria', $faixaEtaria);
$insertQuery->bindParam(':titulo', $titulo);
$insertQuery->bindParam(':data', $data);
$insertQuery->bindParam(':horario', $horario);
$insertQuery->bindParam(':local', $local);
$insertQuery->bindParam(':ingressosEstudantes', $ingressosEstudantes);
$insertQuery->bindParam(':ingressosProfissionais', $ingressosProfissionais);
$insertQuery->bindParam(':nomeResponsavel', $nomeResponsavel);
$insertQuery->bindParam(':foneResponsa', $foneResponsa);
$insertQuery->bindParam(':emailResponsa', $emailResponsa);

$execute = $insertQuery->execute();

if($execute){
	session_start();
	$_SESSION['id'] = $db->lastInsertId();

	echo json_encode(array('sucesso' => 1));
}else{
	echo json_encode(array('sucesso' => 0, 'erro' => 'Falha ao enviar', 'classe' => 'geral'));
}



?>