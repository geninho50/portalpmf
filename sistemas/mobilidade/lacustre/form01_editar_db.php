<?php
session_start();
include_once './conexao.php';
$id = $_GET['id'];
$data_operacao = $_POST['data'];
$data_operacao = date('Y-m-d', strtotime($data_operacao));
$horario_operacao = $_POST['horario'];
$modalidade = $_POST['modalidade'];
$sentido = $_POST['sentido'];
$justificativa = $_POST['justificativa'];
$num_ficha = $_POST['num_ficha'];
$id_embarcacao = $_POST['id_embarcacao'];

echo $id;





$sql = "UPDATE lacustre.viagens SET  
id_embarcacao = :id_embarcacao,
data_operacao = :data_operacao,
horario_operacao = :horario_operacao,
sentido = :sentido,
justificativa = :justificativa,
modalidade = :modalidade,
num_ficha = :num_ficha


WHERE id=:id";




	$stmt = $conn->prepare ($sql);

	$stmt->bindValue(':id_embarcacao', $id_embarcacao);
	$stmt->bindValue(':data_operacao', $data_operacao);
	$stmt->bindValue(':horario_operacao', $horario_operacao);
	$stmt->bindValue(':sentido', $sentido);
	$stmt->bindValue(':justificativa', $justificativa);

	$stmt->bindValue(':modalidade', $modalidade);

	$stmt->bindValue(':num_ficha', $num_ficha, PDO::PARAM_INT);
	$stmt->bindValue(':id', $id);

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
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php?data=". $data_operacao."' > 
			<script type=\"text/javascript\">
			alert(\"Atualizado.\");
		</script>
					";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=form01.php>
				<script type=\"text/javascript\">
					alert(\"Erro ao cadastrar.\");
				</script>
			";	
		}?>
	</body>
</html>