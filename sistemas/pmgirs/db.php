<?php
try {
	$db = new PDO('mysql:host=192.168.1.20;dbname=pmgirs', 'dados', 'https!@17');
	//$db = new PDO('mysql:host=localhost;dbname=scd', 'root', '');
} catch (Exception $e) {
	echo "Could not connect to the database.";
	exit;
}


?>
