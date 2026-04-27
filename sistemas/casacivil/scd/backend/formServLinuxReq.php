<?php

include "db.php"; 
include "funcoes.php";
$name_vm       = $_POST['name_vm'];
$host_name     = $_POST['host_name'];
$ip            = $_POST['ip'];
$disco         = $_POST['disco'];
$memoria       = $_POST['memoria'];
$core          = $_POST['core'];
$os            = $_POST['os'];
$vm_serial     = $_POST['vm_serial'];
$server_serial = $_POST['server_serial'];
$servicos      = $_POST['servicos'];
$custo         = $_POST['custo'];
$login         = $_POST['login'];

validateEmpty($ip, "IP", "ip");

$insertQuery = $db->prepare("INSERT INTO servidoreslinux 
					(name_vm,host_name,ip,disco,memoria,core,os,vm_serial,server_serial,servicos,login,custo) 
				VALUES 
					(:name_vm,:host_name,:ip,:disco,:memoria,:core,:os,:vm_serial,:server_serial,:servicos,:login,:custo)");

$insertQuery->bindParam(':name_vm', $name_vm);
$insertQuery->bindParam(':host_name', $host_name);
$insertQuery->bindParam(':ip', $ip);
$insertQuery->bindParam(':disco', $disco);
$insertQuery->bindParam(':memoria', $memoria);
$insertQuery->bindParam(':core', $core);
$insertQuery->bindParam(':os', $os);
$insertQuery->bindParam(':vm_serial', $vm_serial);
$insertQuery->bindParam(':server_serial', $server_serial);
$insertQuery->bindParam(':servicos', $servicos);
$insertQuery->bindParam(':login', $login);
$insertQuery->bindParam(':custo',$login);
$execute = $insertQuery->execute();

if($execute){
	echo json_encode(array('success' => 1));
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha ao enviar', 'fieldProblem' => $fieldProblem));
}

?>