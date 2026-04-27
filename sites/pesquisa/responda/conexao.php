<?php
$servername = "192.168.12.2:3312"; // endere�o do servidor MySQL
$username = "cadastrosrh"; // substitua pelo seu nome de usu�rio
$password = "Change1."; // substitua pela sua senha
$dbname = "srh-db"; // substitua pelo nome do seu banco de dados

// Cria a conex�o
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conex�o
if ($conn->connect_error) {
    die("Conex�o falhou: " . $conn->connect_error);
}
?>
