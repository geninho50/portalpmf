<?php
try {
	$db = new PDO('mysql:host=192.168.1.20;dbname=maratonaFotografica;charset=utf8', 'root', 'https!@17');
} catch (Exception $e) {
	echo "Could not connect to the database.";
	exit;
}
