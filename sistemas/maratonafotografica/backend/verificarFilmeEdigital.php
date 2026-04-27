<?
include "db.php";

$txtSql = "SELECT COUNT(*) AS qtd FROM filmeEdigital WHERE ano = ".date("Y");
$sql = $db->prepare($txtSql);
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);	

if($data['qtd'] >= 370){
	echo json_encode(array('sucesso' => 0 ));
}else{
	echo json_encode(array('sucesso' => 1 ));
}
