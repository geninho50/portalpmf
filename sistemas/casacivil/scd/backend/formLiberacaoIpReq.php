<?php

include "db.php"; 
include "funcoes.php";

// Function to get the client ip address


$nome = $_POST['nome'];
$setor = $_POST['setor'];
$secretaria = $_POST['secretaria'];
$cpf = $_POST['cpf'];
$rg = $_POST['identidade'];
$matricula = $_POST['matricula'];
$telefone = $_POST['telefone'];
$data = date('Y-m-d');
$ip = $_POST['ip'];
$nome = utf8_encode ( $nome );
$setor = utf8_encode ( $setor );
$secretaria = utf8_encode ( $secretaria );
$cpf = utf8_encode ( $cpf );
$matricula  = utf8_encode ( $matricula );

validateEmpty($nome, "Nome", "nome");
validateEmpty($setor, "Setor", "setor");
validateEmpty($secretaria, "Secretaria", "secretaria");
validateEmpty($cpf, "CPF", "cpf");
validateCPF($cpf, "cpf");
validateEmpty($rg, "Identidade", "identidade");
validateEmpty($matricula, "Matricula", "matricula");
validateEmpty($telefone, "Telefone", "telefone");
validateEmpty($ip, "IP", "ip");
validateIp($ip, "IP");

$insetQr = $db->prepare("INSERT INTO liberacaoip
							(nome,setor,secretaria,cpf,rg,matricula,telefone,data, ip)
						VALUES
							(:nome,:setor,:secretaria,:cpf,:rg,:matricula,:telefone,:data, :ip)");

$insetQr->bindParam(':nome', $nome);
$insetQr->bindParam(':setor', $setor);
$insetQr->bindParam(':secretaria', $secretaria);
$insetQr->bindParam(':cpf', $cpf);
$insetQr->bindParam(':rg', $rg);
$insetQr->bindParam(':matricula', $matricula);
$insetQr->bindParam(':telefone', $telefone);
$insetQr->bindParam(':data', $data);
$insetQr->bindParam(':ip', $ip);
$execute = $insetQr->execute();

if($execute){
	session_start();
	$_SESSION['id'] = $db->lastInsertId();
	echo json_encode(array('success' => 1));
	
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha ao enviar', 'fieldProblem' => $fieldProblem));
}



