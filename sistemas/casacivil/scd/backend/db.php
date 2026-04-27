<?php

try {
	$db = new PDO('mysql:host=192.168.1.20;dbname=scd', 'scd', 'https!@17');
	//$db = new PDO('mysql:host=localhost;dbname=scd', 'root', '');
} catch (Exception $e) {
	echo "Could not connect to the database.";
	exit;
}


/*$link = mysql_connect('localhost', 'root', '');
if (!$link) {
   die('Não conseguiu conectar: ' . mysql_error());
}

// seleciona o banco
$db_selected = mysql_select_db('scd', $link);
if (!$db_selected) {
   die ('Não pode selecionar o banco de dados : ' . mysql_error());
}*/