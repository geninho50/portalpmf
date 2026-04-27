<?
include "db.php";

$sql = $db->prepare("SELECT count(*) as qtd FROM infantoJuvenil");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);	

if($data['qtd'] >= 100){
	echo json_encode(array('sucesso' => 0 ));
}else{
	echo json_encode(array('sucesso' => 1 ));
}
