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

$sql = $db->prepare("SELECT * FROM agendamentoGrupos ORDER BY id");
$sql->execute();
$data = $sql->fetchALL(PDO::FETCH_ASSOC);

$tabela = '';


for($i = 0; $i < sizeof($data); $i++){
	$tabela .= "<tr>";		
		$tabela .= "<td>";		
			$tabela .= $data[$i]['id'];
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['nome']);
		$tabela .= "</td>";	
		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['logradouro']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['numero']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['complemento']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['municipio']);
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['bairro']);
		$tabela .= "</td>";

		$tabela .= "<td>";
			$tabela .= $data[$i]['cep'];
		$tabela .= "</td>";
		
		$tabela .= "<td>";		
			$tabela .= $data[$i]['telefone'];
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= $data[$i]['celular'];
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['email1']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .=  utf8_encode($data[$i]['email2']);
		$tabela .= "</td>"; 

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['turma']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['faixaEtaria']);
		$tabela .= "</td>";
		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['titulo']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['data']);
		$tabela .= "</td>";
		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['horario']);
		$tabela .= "</td>";
	 	
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['local']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['ingressosEstudantes']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['ingressosProfissionais']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['nomeResponsavel']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['foneResponsa']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['emailResponsa']);
		$tabela .= "</td>";



		$id = $data[$i]['id'];

		$tabela .= "<td>";		
			$tabela .= "<input type='button' value='Editar' id=$id class='botaoVerMais btn btn-primary btn-xs' onCLick=editar($id)>";
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= "<input type='button' value='Excluir' id=$id class='botaoVerMais btn btn-primary btn-xs' onCLick=excluir($id)>";
		$tabela .= "</td>";	
}

?>