<?php
session_start();

include_once './conexao.php';
$id = $_GET['id'];
$pontos = $_GET['pontos'];
$arr_pontos = array();
$arr_d = array();
$arr_e = array();


$i = 1;
for ($i = 1; $i <= $pontos; $i++) {
${$i. 'e'} = intval($_POST[$i.'e']);
${$i. 'd'} = intval($_POST[$i.'d']);
$arr_pontos[$i] = $i;
$arr_d[$i] = intval($_POST[$i.'d']);
$arr_e[$i] = intval($_POST[$i.'d']);

};

$array_embarque = array_combine($arr_pontos, $arr_e);
$array_desembarque = array_combine($arr_pontos, $arr_e);

$embarque= json_encode($array_embarque); 
$desembarque = json_encode($array_desembarque); 

$sql = "UPDATE lacustre.viagens SET embarque= :embarque, desembarque= :desembarque WHERE id=:id ";
	$stmt = $conn->prepare ($sql);
	$stmt->bindValue(':id', $id);
	$stmt->bindValue(':embarque', $embarque, PDO::PARAM_STR);
	$stmt->bindValue(':desembarque', $desembarque, PDO::PARAM_STR);
	$stmt->execute();
	$count = $stmt->rowCount();

	var_dump($embarque);

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	</head>

	<body> <?php
		if($count != 0){
			echo "
			ok
		";		
		}else{
			echo "
				<script type=\"text/javascript\">
					alert(\"Erro no cadastro\");
				</script>
			";	
		}?>
	</body>
</html>