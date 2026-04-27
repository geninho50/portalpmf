<?php
include "db.php";
error_reporting(E_ALL);
ini_set("display_errors", 1);


$sql = $db->prepare("SELECT * FROM setur WHERE aprovado = 1 AND projeto = 1 ORDER BY id");
$sql->execute();
$data = $sql->fetchALL(PDO::FETCH_ASSOC);

$tabela = '';
$aprovado ='';

for($i = 0; $i < sizeof($data); $i++){
	$tabela .= "<tr>";		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['id']);
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['nome']);
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['sugestao']);
		$tabela .= "</td>";
	$tabela .= "</tr>";	
}

for($i = 0; $i < sizeof($data); $i++){
	$aprovado .= "<tr>";		
		$aprovado .= "<td>";		
			$aprovado .= utf8_encode($data[$i]['id']);
		$aprovado .= "</td>";	

		$aprovado .= "<td>";		
			$aprovado .= utf8_encode($data[$i]['nome']);
		$aprovado .= "</td>";	

		$aprovado .= "<td>";		
			$aprovado .= utf8_encode($data[$i]['sugestao']);
		$aprovado .= "</td>";

		$aprovado .= "<td>";		
			$aprovado .= "<input type='button' value='Excluir' id=".$data[$i]['id']." class='botaoVerMais btn btn-primary btn-xs' onCLick=excluir(".$data[$i]['id'].")>";
		$aprovado .= "</td>";
	$aprovado .= "</tr>";
}

?>