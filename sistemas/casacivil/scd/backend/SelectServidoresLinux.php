<?php

include "backend/db.php";
include "backend/funcoes.php";

$sql = $db->prepare("SELECT * FROM servidoreslinux");
$sql->execute();
$data = $sql->fetchALL(PDO::FETCH_ASSOC);

$tabela = '';

for($i = 0; $i < sizeof($data); $i++){
	$tabela .= "<tr>";		
		$tabela .= "<td>";		
			$tabela .= $i+1;
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['name_vm'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['host_name'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['ip'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['disco'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['memoria'];
		$tabela .= "</td>";			
		$tabela .= "<td>";		
			$tabela .= $data[$i]['core'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['os'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['vm_serial'];
		$tabela .= "</td>";
		$tabela .= "<td>";		
			$tabela .= $data[$i]['server_serial'];
		$tabela .= "</td>";
		$tabela .= "<td>";		
			$tabela .= $data[$i]['servicos'];
		$tabela .= "</td>";		
		$tabela .= "<td>";		
			$tabela .= $data[$i]['login'];
		$tabela .= "</td>";	
		
		$id = $data[$i]['id'];

		$tabela .= "<td>";		
			$tabela .= "<input type='button' value='Portas' id=$id class='botaoVerMais btn btn-primary btn-xs' onCLick=verPortas($id)>";
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= "<input type='button' value='Editar' id=$id class='botaoVerMais btn btn-primary btn-xs' onCLick=editar($id)>";
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= "<input type='button' value='Excluir' id=$id class='botaoVerMais btn btn-primary btn-xs' onCLick=excluir($id)>";
		$tabela .= "</td>";	
}

?>