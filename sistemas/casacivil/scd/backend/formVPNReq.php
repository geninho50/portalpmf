<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');


include "db.php"; 
include "funcoes.php";
function get_client_ip() {
	$ipaddress = '';
	if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) )
	$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if( isset($_SERVER['HTTP_X_FORWARDED_FOR']) )
	$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if( isset($_SERVER['HTTP_X_FORWARDED']) )
	$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if( isset($_SERVER['HTTP_FORWARDED_FOR']) )
	$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if( isset($_SERVER['HTTP_FORWARDED']) )
	$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if( isset($_SERVER['REMOTE_ADDR']) )
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
	$ipaddress = 'UNKNOWN';
	return $ipaddress;
}

$nome_istituicao = $_POST['nome_instituicao'];
$entidade = $_POST['entidade'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$naturalidade = $_POST['naturalidade'];
$email = $_POST['email'];
$nascimento = $_POST['nascimento'];
$uf = $_POST['uf'];
$matricula = $_POST['matricula'];
$adicional = $_POST['adicional'];
$motivo = $_POST['motivo'];
$cnpj = $_POST['cnpj'];
$telefone = $_POST['telefone'];
$data = date('Y-m-d');
$ip = get_client_ip();
$razao_social  = $_POST['entidade'];


$nome_istituicao  = utf8_decode ( $nome_istituicao );
$entidade = utf8_decode ( $entidade );
$razao_social  = utf8_decode ( $razao_social  );
$nome = utf8_decode ( $nome );
$naturalidade = utf8_decode ( $naturalidade );
$email = utf8_decode ( $email );
$nascimento = utf8_decode ( $nascimento );
$matricula = utf8_decode ( $matricula );
$adicional = utf8_decode ( $adicional );
$motivo  = utf8_decode ( $motivo  );
 
validateEmpty($nome_istituicao, "Nome da Instituicao", "nome_instituicao");
validateEmpty($cnpj, "CNPJ", "cnpj");
validateEmpty($entidade, "Entidade", "Entidade"); 
validateEmpty($telefone, "Telefone", "telefone"); 
validateEmpty($nome, "Nome", "nome");
validateEmpty($cpf, "CPF", "cpf");
validateCPF($cpf, "CPF");
validateCNPJ($cnpj,"CNPJ");
validateEmpty($nascimento, "Data de Nascimento", "nascimento"); 
$nova_data = explode("/", $nascimento);
$nascimento = "$nova_data[2]-$nova_data[1]-$nova_data[0]";
validateEmpty($naturalidade, "Naturalidade", "naturalidade"); 
validateEmpty($uf, "UF", "uf"); 
validateEmpty($email, "E-mail", "email"); 
validateMail($email, "E-mail");
validateEmpty($motivo, "Motivo", "motivo"); 

$insetQr = $db->prepare("INSERT INTO scd.liberacaovpn
							(nomeInstituicao, entidade, nome, cpf, naturalidade, email, dataNasc, uf, matricula, outrosDados, motivo, data, telefone, cnpj, ip)
						VALUES
							(:nomeInstituicao, :entidade, :nome, :cpf, :naturalidade, :email, :dataNasc, :uf, :matricula, :outrosDados, :motivo, :data, :telefone, :cnpj, :ip)");

$insetQr->bindParam(':nomeInstituicao', $nome_istituicao);
$insetQr->bindParam(':entidade', $entidade);
$insetQr->bindParam(':nome', $nome);
$insetQr->bindParam(':cpf', $cpf);
$insetQr->bindParam(':naturalidade', $naturalidade);
$insetQr->bindParam(':email', $email);
$insetQr->bindParam(':dataNasc', $nascimento);
$insetQr->bindParam(':uf', $uf);
$insetQr->bindParam(':matricula', $matricula);
$insetQr->bindParam(':outrosDados', $adicional);
$insetQr->bindParam(':motivo', $motivo);
$insetQr->bindParam(':data', $data);
$insetQr->bindParam(':telefone', $telefone);
$insetQr->bindParam(':cnpj', $cnpj);
$insetQr->bindParam(':ip', $ip);
$execute = $insetQr->execute();

if($execute){
	session_start();
	$_SESSION['id'] = $db->lastInsertId();
	echo json_encode(array('success' => 1));
	
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha ao enviar', 'fieldProblem' => $fieldProblem));
}