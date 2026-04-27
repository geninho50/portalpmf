<?php
	
	require ("DB_mysql.php");
	$obj = new DB_mysql();
	

	$id = $_POST['idtemp'];
	$status = $_POST['status'];
	$motivostatus = $_POST['xmotivostatus'];
	$gmautorizou = $_POST['gmautorizou'];
	
	if($status == 2){
		$query = "UPDATE pedidofolga set status='$status',motivostatus='$motivostatus' , autorizado='$gmautorizou' where id=$id";
		$obj->executaQuery($query);
		echo "<script>alert('Folga negada com sucesso!');</script>";             	
		echo "<script> window.location.href = '../controle/administrar_servicos_online.php' </script>";
	}
?>