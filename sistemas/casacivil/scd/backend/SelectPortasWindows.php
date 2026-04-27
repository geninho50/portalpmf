<?php

include "backend/db.php";

$id = $_POST['id'];
$id_servidor = $_GET['id'];
$sql = $db->prepare("SELECT * FROM portaswindows WHERE servidor_id = $id_servidor" );
$sql->execute();
$data = $sql->fetchALL(PDO::FETCH_ASSOC);

$tabela = '';

for($i = 0; $i < sizeof($data); $i++){
	$tabela .= "<tr>";
		$tabela .= "<td>";		
			$tabela .= $data[$i]['porta'];
		$tabela .= "</td>";	
		$id = $data[$i]['id'];
		$tabela .= "<td>";		
			$tabela .= "<input type='button' value='Excluir' id=$id class='botaoVerMais btn btn-primary btn-xs' onCLick=excluir($id)>";
		$tabela .= "</td>";	
	$tabela .= "<tr>";
}

?>