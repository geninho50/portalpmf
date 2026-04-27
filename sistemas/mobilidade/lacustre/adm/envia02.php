<?php

session_start();

include_once './conexao.php';

$id = $_GET['id'];

$a = array();
$a['morador_cadastrado'] = $_POST['morador_cadastrado'];
$a['morador_gestante'] = intval($_POST['morador_gestante']);
$a['pcd'] = intval($_POST['pcd']);
$a['pcd_acompanhante']  = intval($_POST['pcd_acompanhante']);
$a['estudante_menor']  = intval($_POST['estudante_menor']);
$a['mae_estudante']  = intval($_POST['mae_estudante']);
$a['estudante']  = intval($_POST['estudante']);
$a['idoso']  = intval($_POST['idoso']);
$a['nao_cadastrado']  = intval($_POST['nao_cadastrado']);

$passageiros = json_encode($a); 

$sql = "UPDATE lacustre.viagens SET passageiros = :passageiros WHERE id=:id ";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->bindValue(':passageiros', $passageiros, PDO::PARAM_STR);

$stmt->execute();
$count = $stmt->rowCount();

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	</head>

	<body> <?php
		if($count != 0){
			echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=form03.php?&id=". $id. "' > 
					";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=form01.php'>
				<script type=\"text/javascript\">
					alert(\"Erro.\");
				</script>
			";	
		}?>
	</body>
</html>