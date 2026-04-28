<?php
require_once($_SERVER['DOCUMENT_ROOT']."/scripts/php/config.php");
require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");
$drive->conecta();
$pasta = explode("/" , $_SERVER['PHP_SELF']);
$path = $pasta[2];
$sql = "SELECT * FROM entidades WHERE entidade_path = '$Tsite'";
$resultado = $drive->pedido($sql);
require_once("../serv_sistema.php"); 
?>