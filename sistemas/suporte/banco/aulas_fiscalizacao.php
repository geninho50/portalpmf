<?php
include_once("gdb.php");

if($_POST["tipo"]=='iniciar'){

	$gdb = new gdb();
	$gdb2 = new gdb();

	$sql = "SELECT * FROM suporteStm.aulasFiscalizacao WHERE ID_MODULO = ".$_POST["modulo"]." AND ID_USUARIO = ".$_POST["idUsuario"]." AND NUM_AULA = ".$_POST["numAula"]." LIMIT 1";


	$gdb->open($sql);

	if($gdb->linhas == 1){
		echo 'Aula já iniciada';
	}else{
		$sql2 = "INSERT INTO suporteStm.aulasFiscalizacao (ID_USUARIO, ID_MODULO, NUM_AULA, DATA_INICIO,AULA_COMPLETADA) VALUES (".$_POST["idUsuario"].", ".$_POST["modulo"].", ".$_POST["numAula"]." , NOW(), '0')";
		$gdb2->open($sql2);
		echo $sql2;
	}
}else if($_POST["tipo"]=='inserir'){
	
	$gdb = new gdb();

	$sql = "UPDATE suporteStm.aulasFiscalizacao SET DATA_FINALIZACAO = NOW(), AULA_COMPLETADA = '1' WHERE ID_USUARIO = ".$_POST["idUsuario"]." AND ID_MODULO = ".$_POST["modulo"]." AND NUM_AULA = ".$_POST["numAula"]." AND AULA_COMPLETADA = '0'";

	$gdb->open($sql);
	echo ($sql);

}

?>

