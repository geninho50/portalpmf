<?
include "db.php";

$sql = $db->prepare("SELECT count(*) as qtd FROM agendamentoGrupos");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);	

if($data['qtd'] >= 400){
	echo json_encode(array('sucesso' => 0 ));
}else{
	echo json_encode(array('sucesso' => 1 ));
}
