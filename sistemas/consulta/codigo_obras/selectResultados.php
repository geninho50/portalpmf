<?php
require_once "db.php";


$sql = $db->prepare("SELECT * FROM smdu ORDER BY id");
$sql->execute();
$data = $sql->fetchALL(PDO::FETCH_ASSOC);

$tabela = '';


for($i = 0; $i < sizeof($data); $i++){
	$tabela .= "<tr>";		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['id']);
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['nome']);
		$tabela .= "</td>";	

		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['email']);
		$tabela .= "</td>";

		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['ocupacao']);
		$tabela .= "</td>";

		$tema = utf8_encode($data[$i]['tema']);

		switch($tema){
		
		case "1":
			$tema = "DIREITOS E RESPONSABILIDADES";
		break;
		case "2":
			$tema = "NORMAS ADMINISTRATIVAS";
		break;
		case "3":
			$tema = "INFRAÇÕES E PENALIDADES";
		break;
		case "4":
			$tema = "EXECUÇÃO DE OBRAS";
		break;

		case "5":
			$tema = "NORMAS TECNICAS";
		break;

		case "6":
			$tema = "ACESSIBILIDADE";
		break;

		case "7":
			$tema = "SUSTENTABILIDADE";
		break;

		case "8":
			$tema = "OUTROS";
		break;
		}

		$tabela .= "<td>";		
			$tabela .= $tema;
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['sugestao']);
		$tabela .= "</td>";
		
}

?>