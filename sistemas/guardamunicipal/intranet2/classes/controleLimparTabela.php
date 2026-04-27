<?php

require ("DB_mysql.php");
$obj = new DB_mysql();

	$idescala  = $_GET['idescala'];

	$queryT = "DELETE FROM tempescala where idescala=$idescala";
	$obj->executaQuery($queryT);
						
	echo "<script>alert('Deletado com sucesso!');</script>";                       
	echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";	

   $obj->closeVar($query);      
   $obj->closeQuery();
   $obj->closeConexaoGeral();

?>