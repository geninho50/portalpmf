<?
include "db.php";

$sql = $db->prepare("SELECT count(*) as qtd FROM IsnardAzevedo.dadosCadastro");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);	

if($data['qtd'] >= 301){
	echo json_encode(array('sucesso' => 0 ));
}else{
	echo json_encode(array('sucesso' => 1 ));
}
