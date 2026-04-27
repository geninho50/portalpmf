<?php

$verIncluir = false;
require ("DB_mysql.php");
$obj = new DB_mysql();

$idescala  = $_GET['idescala'];
$status  = $_GET['status'];

	$queryE = "update escalahoraextra set status='$status' where id='$idescala'";
	$obj->executaQuery($queryE);
	if($status=='S'){
		echo "<script>alert('Visualizacao para os Guarda esta Habilitada!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";	
	}else{
		if($status=="N"){
			echo "<script>alert('Visualizacao para os Guarda esta Desabilitada!');</script>";                       
			echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";
		}
	}
   $obj->closeVar($query);      
   $obj->closeQuery();
   $obj->closeConexaoGeral();
	
?>