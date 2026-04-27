<?php

require_once("db.php"); 
require_once("funcoes.php");


ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);


	$nome             = utf8_encode($_POST['nome']);
	$nacionalidade    = utf8_encode($_POST['nacionalidade']);
	$rg               = utf8_encode($_POST['rg']);
	$cpf              = utf8_encode($_POST['cpf']);
	$dataNasc         = utf8_encode($_POST['dataNasc']);
	$modalidade       = utf8_encode($_POST['modalidade']);
	$email            = utf8_encode($_POST['email']);
	$telefone         = utf8_encode($_POST['telefone']);
	$celular          = utf8_encode($_POST['celular']);
	$equipamento      = utf8_encode($_POST['equipamento']);
	$endereco         = utf8_encode($_POST['endereco']);
	$cidade           = utf8_encode($_POST['cidade']);
	$bairro           = utf8_encode($_POST['bairro']);
	$cep              = utf8_encode($_POST['cep']);
	$profissao        = utf8_encode($_POST['profissao']);
	$localTrabalho    = utf8_encode($_POST['localTrabalho']);
	$banco            = utf8_encode($_POST['banco']);
	$bancoNum         = utf8_encode($_POST['bancoNum']);
	$agencia          = utf8_encode($_POST['agencia']);
	$contaNum         = utf8_encode($_POST['contaNum']);
	$id               = utf8_encode($_POST['id']);

if ($result['qtd'] > 0) {
	$erro = 'CPF JÁ CADASTRADO';
	echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => $cpf));
	die;
}

$insertQuery = $db->prepare("UPDATE filmeEdigital SET nome = :nome, dataNasc = :dataNasc, nacionalidade = :nacionalidade, modalidade = :modalidade,
							 email = :email, telefone = :telefone, celular = :celular, equipamento = :equipamento, endereco = :endereco, bairro = :bairro,
							  cidade = :cidade, cep = :cep, profissao = :profissao, localTrabalho = :localTrabalho, banco = :banco, agencia = :agencia,
							  bancoNum = :bancoNum, contaNum = :contaNum, cpf = :cpf, rg = :rg WHERE id = :id");

$insertQuery->bindParam(':nome', $nome);
$insertQuery->bindParam(':dataNasc', $dataNasc);
$insertQuery->bindParam(':modalidade', $modalidade);
$insertQuery->bindParam(':email', $email);
$insertQuery->bindParam(':telefone', $telefone);
$insertQuery->bindParam(':celular', $celular);
$insertQuery->bindParam(':equipamento', $equipamento);
$insertQuery->bindParam(':endereco', $endereco);
$insertQuery->bindParam(':bairro', $bairro);
$insertQuery->bindParam(':cidade', $cidade);
$insertQuery->bindParam(':cep', $cep);
$insertQuery->bindParam(':localTrabalho', $localTrabalho);
$insertQuery->bindParam(':profissao', $profissao);
$insertQuery->bindParam(':banco', $banco);
$insertQuery->bindParam(':agencia', $agencia);
$insertQuery->bindParam(':bancoNum', $bancoNum);
$insertQuery->bindParam(':contaNum', $contaNum);
$insertQuery->bindParam(':nacionalidade', $nacionalidade);
$insertQuery->bindParam(':cpf', $cpf);
$insertQuery->bindParam(':rg', $rg);

$execute = $insertQuery->execute();

if($execute){
	session_start();
	$_SESSION['id'] = $db->lastInsertId();

	echo json_encode(array('sucesso' => 1));
}else{
	echo json_encode(array('sucesso' => 0, 'erro' => 'Falha ao enviar', 'classe' => 'geral'));
}

}else{
	echo json_encode(array('sucesso' => 0, 'erro' => 'inscrições encerradas', 'classe' => 'geral'));
}

?>