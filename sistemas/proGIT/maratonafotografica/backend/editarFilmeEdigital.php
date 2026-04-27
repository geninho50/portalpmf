<?php

require_once("db.php"); 

/*ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);*/


	$nome             = utf8_decode($_POST['nome']);
	$nacionalidade    = utf8_decode($_POST['nacionalidade']);
	$rg               = utf8_decode($_POST['rg']);
	$cpf              = utf8_decode($_POST['cpf']);
	$dataNasc         = utf8_decode($_POST['dataNasc']);
	$modalidade       = utf8_decode($_POST['modalidade']);
	$email            = utf8_decode($_POST['email']);
	$telefone         = utf8_decode($_POST['telefone']);
	$celular          = utf8_decode($_POST['celular']);
	$equipamento      = utf8_decode($_POST['equipamento']);
	$endereco         = utf8_decode($_POST['endereco']);
	$cidade           = utf8_decode($_POST['cidade']);
	$bairro           = utf8_decode($_POST['bairro']);
	$cep              = utf8_decode($_POST['cep']);
	$profissao        = utf8_decode($_POST['profissao']);
	$localTrabalho    = utf8_decode($_POST['localTrabalho']);
	$banco            = utf8_decode($_POST['banco']);
	$bancoNum         = utf8_decode($_POST['bancoNum']);
	$agencia          = utf8_decode($_POST['agencia']);
	$contaNum         = utf8_decode($_POST['contaNum']);
	$id               = utf8_decode($_POST['id']);

    verificaVazio($nome, 'nome', 'nome' );
    verificaVazio($dataNasc, 'Data de Nascimento', 'dataNasc' );
    verificaVazio($nacionalidade, 'Nacionalidade', 'nacionalidade' );
    verificaVazio($email, 'Email', 'email' );
    verificaVazio($telefone, 'Telefone', 'telefone' );
    verificaVazio($celular, 'celular', 'celular' );
    verificaVazio($equipamento, 'Equipamento', 'equipamento' );
    verificaVazio($endereco, 'Endereço', 'endereco' );
    verificaVazio($bairro, 'Bairro', 'bairro' );
    verificaVazio($cidade, 'Cidade', 'cidade' );
    verificaVazio($cep, 'CEP', 'cep' );
    verificaVazio($localTrabalho, 'Local de Trabalho', 'localTrabalho' );
    verificaVazio($profissao, 'Profissão', 'profissao' );
    verificaVazio($banco, 'Banco', 'banco' );
    verificaVazio($agencia, 'Agencia', 'agencia' );
    verificaVazio($bancoNum, 'N° do Banco', 'bancoNum' );
    verificaVazio($contaNum, 'N° da Conta', 'contaNum' );
    verificaVazio($cpf, 'CPF', 'cpf' );
    verificaVazio($rg, 'RG', 'rg' );

    $dataNasc = explode('/', $dataNasc);
    $dataNasc = $dataNasc[2]  . "-" . $dataNasc[1] . "-" . $dataNasc[0];

$insertQuery = $db->prepare("UPDATE filmeEdigital 
                                      SET nome = ?, dataNasc = ?, modalidade = ?, email = ?, telefone = ?,
                                      celular = ?, equipamento = ?, endereco = ?, bairro = ?, cidade = ?, 
                                      cep = ?, localTrabalho = ?, profissao = ?, banco = ?, agencia = ?,
							          bancoNum = ?, contaNum = ?, nacionalidade = ?, cpf = ?, rg = ? 
							          WHERE id = ?");

$insertQuery->bindParam(1, $nome);
$insertQuery->bindParam(2, $dataNasc);
$insertQuery->bindParam(3, $modalidade);
$insertQuery->bindParam(4, $email);
$insertQuery->bindParam(5, $telefone);
$insertQuery->bindParam(6, $celular);
$insertQuery->bindParam(7, $equipamento);
$insertQuery->bindParam(8, $endereco);
$insertQuery->bindParam(9, $bairro);
$insertQuery->bindParam(10, $cidade);
$insertQuery->bindParam(11, $cep);
$insertQuery->bindParam(12, $localTrabalho);
$insertQuery->bindParam(13, $profissao);
$insertQuery->bindParam(14, $banco);
$insertQuery->bindParam(15, $agencia);
$insertQuery->bindParam(16, $bancoNum);
$insertQuery->bindParam(17, $contaNum);
$insertQuery->bindParam(18, $nacionalidade);
$insertQuery->bindParam(19, $cpf);
$insertQuery->bindParam(20, $rg);
$insertQuery->bindParam(21, $id);

$execute = $insertQuery->execute();

if($execute){
	session_start();
	$_SESSION['id'] = $db->lastInsertId();

	echo json_encode(array('sucesso' => 1));
}else{
	echo json_encode(array('sucesso' => 0, 'erro' => 'Falha ao enviar', 'classe' => 'geral'));
}
?>