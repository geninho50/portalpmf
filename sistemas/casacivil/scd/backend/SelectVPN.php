<?php

include "backend/db.php";
include "backend/funcoes.php";

$sql = $db->prepare("SELECT * FROM liberacaovpn");
$sql->execute();
$data = $sql->fetchALL(PDO::FETCH_ASSOC);

$tabela = '';


for($i = 0; $i < sizeof($data); $i++){
	$tabela .= "<tr>";
		$tabela .= "<td>";		
			$tabela .= $data[$i]['nomeInstituicao'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['razaoSocialInstituicao'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['nome'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['cpf'];
		$tabela .= "</td>";	
		$tabela .= "<td>";	
			
		$nova_data = explode("-", $data[$i]['dataNasc']);
		$data[$i]['dataNasc'] = "$nova_data[2]/$nova_data[1]/$nova_data[0]";	
			$tabela .= $data[$i]['dataNasc'];
		$tabela .= "</td>";	
		
		$tabela .= "<td>";		
			$tabela .= $data[$i]['naturalidade'];
		$tabela .= "</td>";	
		
		$tabela .= "<td>";		
			$data[$i]['uf'] = estado($data[$i]['uf']);
			$tabela .= $data[$i]['uf'];
		$tabela .= "</td>";	
		
		$tabela .= "<td>";		
			$tabela .= $data[$i]['email'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['matricula'];
		$tabela .= "</td>";	
		
		if ($data[$i]['outrosDados'] == ''){
		$data[$i]['outrosDados'] = 'Não informado';
		}
	
		if ($data[$i]['motivo'] == ''){
		$data[$i]['motivo'] = 'Não informado';
		}
		
		$tabela .= "<td>";		
			$tabela .= $data[$i]['outrosDados'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['motivo'];
		$tabela .= "</td>";	
}

?>





