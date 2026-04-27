<?php

session_start();

include '../fnc/buscaEnderecoCEP.php';

$cep = str_replace(".", "", $_GET['cd_cep']);
$cep = str_replace("-", "", $cep);

$endereco = buscaEnderecoCEP($cep);

echo json_encode($endereco);
?>
