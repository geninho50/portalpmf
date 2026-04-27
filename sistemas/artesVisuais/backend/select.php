<?php
require_once "backend/db.php";


$ordem = $_GET['ordem'];
	switch ($ordem) {
		case 'nome':
			$ordernar = 'nome';
			break;
		default:
			$ordernar = 'id';
			break;
}

$sql = $db->prepare("SELECT * FROM `maratonaFotografica`.`minicurso` ORDER BY id");
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
			$tabela .= utf8_encode($data[$i]['idade']);
		$tabela .= "</td>";
		

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['responsavel']);
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= $data[$i]['cpf'];
		$tabela .= "</td>";	
		

		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['telefone']);
		$tabela .= "</td>";
		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['email']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= $data[$i]['cep'];
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['endereco']);
		$tabela .= "</td>";


		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['numero']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['bairro']);
		$tabela .= "</td>";
		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['municipio']);
		$tabela .= "</td>";

		$id = $data[$i]['id'];

/*
		$tabela .= "<td>";		
			$tabela .= "<input type='button' value='Editar' id=$id class='botaoVerMais btn btn-primary btn-xs' onCLick=editar2($id)>";
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= "<input type='button' value='Excluir' id=$id class='botaoVerMais btn btn-primary btn-xs' onCLick=excluir2($id)>";
		$tabela .= "</td>";	*/
}

?>