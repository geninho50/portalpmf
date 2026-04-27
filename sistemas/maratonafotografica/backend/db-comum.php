<?php
$servername = "192.168.12.24";
$username = "portal";
$password = "Change2024";
$dbname = "portal-bd";
$port = 3311; // Substitua pela porta correta, se for diferente

// Adicione a porta como um parâmetro no construtor do mysqli
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verifique se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}