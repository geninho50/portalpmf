<?php
$hostname = '192.168.1.20';
$username = 'root';
$password = 'https!@17';
$database = 'calendario';
 
try {
    $conexao = new PDO("mysql:host=192.168.1.20;dbname=calendario", $username, $password,
	array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	    //echo 'Conexao efetuada com sucesso!';
    }
catch(PDOException $e)
    {
    	echo $e->getMessage();
    }
?>