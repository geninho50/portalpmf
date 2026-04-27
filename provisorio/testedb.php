<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
try{
	$db = new PDO('mysql:host=192.168.1.7;dbname=smsdb', 'smsdb', 'saude2070');
	//$db = new PDO('mysql:host=localhost;dbname=scd', 'root', '');

} catch (Exception $e) {
	echo "Could not connect to the database.";
	exit;
}

$sql = $db->prepare("SHOW TABLES");
$sql->execute();
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

if($data != null){
	var_dump($data);
}