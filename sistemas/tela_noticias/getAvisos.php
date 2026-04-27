<?php 

ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

require_once("../../scripts/php/config.php");
require_once("../../scripts/php/funcoes_bd.php");
require_once("../../scripts/php/funcoes.php");
$drive->conecta();

$hoje = date("Y-m-d");
$noticias_home = "0"; 
	$sql 		= "SELECT * FROM telao where inicio <= '$hoje' and fim >= '$hoje' ";
	$result		= $drive->pedido($sql);
	$avisos = pg_fetch_all($result);   
	$avisosArr = array();
	if($avisos){
		for($i = 0; $i < count($avisos); $i++) {
			$avisosArr[$i]["imagem"] =    $avisos[$i]["imagem"];
			$avisosArr[$i]["origem"] =   "Aviso";
			$avisosArr[$i]["titulo"] =    $avisos[$i]["manchete"];
			$avisosArr[$i]["manchete"] =  $avisos[$i]["texto"];
			$avisosArr[$i]["tela_cheia"] = $avisos[$i]["tela_cheia"];
		}
	}
	

echo json_encode(array_values($avisosArr));