<?php
session_start();
include_once("conexao.php");
$horario1 = $_POST['horario1'];
$horario2 = $_POST['horario2'];

$horario1 = date('H:i', strtotime($horario1));
$horario2 = date('H:i', strtotime($horario2));
echo $horario2;
$origem = $_POST['origem'];

$cep = $_POST['cep'];
$cep = (preg_replace("/[^0-9]/", "", $cep));
$rua = $_POST['rua'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];

$data_criado = date("Y-m-d H:i:s"); // 

$sql = 'INSERT INTO sim.pesquisaodshoppings
		(
			horario1, 
            horario2,
            origem,
			cep,
			rua, 
			complemento, 
			bairro, 
			cidade, 
			uf, 
		    data_criado
		)
		VALUES 
		(
			:horario1, 
			:horario2,
            :origem,
			:cep,
			:rua, 
			:complemento, 
			:bairro, 
			:cidade, 
			:uf, 
			:data_criado
		)';

$stmt = $conn->prepare ($sql);
$stmt->bindValue(':horario1', $horario1);
$stmt->bindValue(':horario2', $horario2);
$stmt->bindValue(':origem', $origem);
$stmt->bindValue(':cep', $cep, PDO::PARAM_INT);
$stmt->bindValue(':rua', $rua);
$stmt->bindValue(':complemento', $complemento);
$stmt->bindValue(':bairro', $bairro);
$stmt->bindValue(':cidade', $cidade);
$stmt->bindValue(':uf', $uf);
$stmt->bindValue(':data_criado', $data_criado);
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
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=shopping.php' > 
			<script type=\"text/javascript\">
					alert(\"Seu questionãrio foi cadastrado.\");
				</script>
					";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=shopping.php'>
				<script type=\"text/javascript\">
					alert(\"Erro ao cadastrar.\");
				</script>
			";	
		}?>
	</body>
</html>