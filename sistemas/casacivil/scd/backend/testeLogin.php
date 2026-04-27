<?php 

// error_reporting(E_ALL);
// ini_set('display_errors', 'On');


include "db.php"; 
include "funcoes.php";

$login= $_POST['login'];
$senha = $_POST['senha'];
$senha = md5( $senha );
$fieldProblem = "";

$sqlscript = "SELECT * FROM scd.usuario where login='$login' and senha='$senha'";
$sql = $db->prepare( $sqlscript );
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);

// $data = '';

if( $data != '' ){
	session_start();
	$_SESSION['login'] = $login;
	$_SESSION['permissoes'] = $data['permissoes'];
	
	echo json_encode(array('success' => 1));
}else{
	echo json_encode(array('success' => 0, 'error' => 'Login ou Senha Incorreto', 'fieldProblem' => $fieldProblem, 'SQL' => $sqlscript ));
}

?>