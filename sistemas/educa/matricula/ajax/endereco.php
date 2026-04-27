<?php

session_start();

include '../fnc/buscaEndereco.php';

$cep = str_replace(".", "", $_GET['cd_cep']);
$cep = str_replace("-", "", $cep);

$endereco = buscaEndereco($cep);

echo json_encode($endereco);
?>
