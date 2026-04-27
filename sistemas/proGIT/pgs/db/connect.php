
<?php
$host = "192.168.12.2:3316";
$username = "pmf_pgs";
$password = "Pm7#pgs24";
$database = "db-pgs";

// Criar conexão
$conn = new mysqli($host, $username, $password, $database);

// Checar conexão
if ($conn->connect_error) {
    echo"<script>'alert(NAO DEU CERTO)'<script>";
    die("Conexão falhou: " . $conn->connect_error);
}
?>
