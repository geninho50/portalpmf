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

$sql = $db->prepare("SELECT * FROM filmeEdigital WHERE ano = ".date("Y")." ORDER BY modalidade, id");
//$sql = $db->prepare("SELECT * FROM filmeEdigital WHERE ano = 2018 ORDER BY id");
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
		

		/*
		$tabela .= "<td>";		
			$tabela .= $data[$i]['rg'];
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= $data[$i]['cpf'];
		$tabela .= "</td>";	
		*/

		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['dataNasc']);
		$tabela .= "</td>";
		
		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['modalidade']);
		$tabela .= "</td>";
		

		/*
		$tabela .= "<td>";		
			$tabela .= $data[$i]['email'];
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= $data[$i]['telefone'];
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= $data[$i]['celular'];
		$tabela .= "</td>";
		*/

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['equipamento']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['endereco']);
		$tabela .= "</td>";
		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['bairro']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['cidade']);
		$tabela .= "</td>";

		/*
		$tabela .= "<td>";		
			$tabela .= $data[$i]['cep'];
		$tabela .= "</td>";
	 	
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['profissao']);
		$tabela .= "</td>";

		/*
		$tabela .= "<td>";		
			$tabela .= $data[$i]['localTrabalho'];
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= $data[$i]['banco'];
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= $data[$i]['bancoNum'];
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= $data[$i]['agencia'];
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= $data[$i]['ContaNum'];
		$tabela .= "</td>";
		*/











		$id = $data[$i]['id'];

		$tabela .= "<td>";		
			$tabela .= "<input type='button' value='Editar' id=$id class='botaoVerMais btn btn-primary btn-xs' onCLick='editar($id);'>";
		$tabela .= "</td>";	
		$tabela .= "<td>";
			$tabela .= "<input type='button' value='Excluir' id=$id class='botaoVerMais btn btn-primary btn-xs' onCLick=excluir($id)>";
		$tabela .= "</td>";
}

?>