<?php
require_once "db.php";



$ordem = $_GET['ordem'];
	switch ($ordem) {
		case 'nome':
			$ordernar = 'nome';
			break;
		default:
			$ordernar = 'id';
			break;
}

$sql = $db->prepare("SELECT * FROM dados ORDER BY id");
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
			$tabela .= utf8_encode($data[$i]['localidade']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['fone1']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['email']);
		$tabela .= "</td>";
		

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['proposta']);
		$tabela .= "</td>";




		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['justificativa']);
		$tabela .= "</td>";													

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['metodologia']);
		$tabela .= "</td>";	

		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['entidade']);
		$tabela .= "</td>";

}

?>
