<?php

session_start();

include_once './conexao.php';

$morador_cadastrado = $_POST['morador_cadastrado'];
$morador_gestante = $_POST['morador_gestante'];
$pcd = $_POST['pcd'];
$pcd_acompanhante = $_POST['pcd_acompanhante'];
$estudante_menor = $_POST['estudante_menor'];
$mae_estudante = $_POST['mae_estudante'];
$estudante = $_POST['estudante'];
$idoso = $_POST['idoso'];
$nao_cadastrado = $_POST['nao_cadastrado'];
$id_viagem = $_GET['id_viagem'];
$id = $_GET['id'];

$sql = "UPDATE lacustre.viagens SET 

morador_cadastrado= :morador_cadastrado,
morador_gestante= :morador_gestante,
pcd= :pcd,
pcd_acompanhante= :pcd_acompanhante,
estudante_menor= :estudante_menor,
mae_estudante= :mae_estudante,
estudante= :estudante,
idoso= :idoso,
nao_cadastrado= :nao_cadastrado
WHERE 
id=:id ";


$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id);

$stmt->bindValue(':morador_cadastrado', $morador_cadastrado, PDO::PARAM_INT);
$stmt->bindValue(':morador_gestante', $morador_gestante, PDO::PARAM_INT);
$stmt->bindValue(':pcd', $pcd, PDO::PARAM_INT);
$stmt->bindValue(':pcd_acompanhante', $pcd_acompanhante, PDO::PARAM_INT);

$stmt->bindValue(':estudante_menor', $estudante_menor, PDO::PARAM_INT);
$stmt->bindValue(':mae_estudante', $mae_estudante, PDO::PARAM_INT);
$stmt->bindValue(':estudante', $estudante, PDO::PARAM_INT);
$stmt->bindValue(':idoso', $idoso, PDO::PARAM_INT);
$stmt->bindValue(':nao_cadastrado', $nao_cadastrado, PDO::PARAM_INT);


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
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=form_viagem-7.php?id_viagem=". $id_viagem . "&id=". $id. "' > 
					";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=form_viagem-6.php?name1=value1&name2=value2'>
				<script type=\"text/javascript\">
					alert(\"Erro.\");
				</script>
			";	
		}?>
	</body>
</html>