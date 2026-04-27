<?
include "db.php";

$txtSql = "SELECT COUNT(*) AS qtd FROM infantoJuvenil WHERE ano = ".date("Y");
$sql = $db->prepare($txtSql);
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);	

if($data['qtd'] >= 80){
	echo json_encode(array('sucesso' => 0 ));
}else{
	echo json_encode(array('sucesso' => 1 ));
}
