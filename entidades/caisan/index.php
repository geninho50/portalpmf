<?php 
  error_reporting( 1 ); // sem msg de erro
  error_reporting( E_ALL ); // todas

  require_once($_SERVER['DOCUMENT_ROOT']."/scripts/php/config.php");
  require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");
  foreach( $_GET as $i=>$value ){
		$drive->verificarEntrada($i);
		}
  $drive->conecta();
  $pasta = explode("/" , $_SERVER['PHP_SELF']);
  $path = $pasta[2];
  $sql = "SELECT * FROM entidades WHERE entidade_path = '$path'";
  $resultado = $drive->pedido($sql);
  require_once("../qwerty.php"); ?>