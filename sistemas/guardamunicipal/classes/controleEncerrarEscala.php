<?php 
require ("DB_mysql.php"); 
$obj = new DB_mysql; 


$id  = $_GET['idescala'];
$chave = $_GET['chave'];
     
	if($id>0) {
			$queryLE = "update escalahoraextra set chave='$chave' where id=$id";
            $obj->executaQuery($queryLE); 
			echo "<script>alert('Escala finalizada!');</script>";    
			echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";                   
	}else{
		echo "<script>alert('Problema para confirmar encerramento da atividade da escala!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";
	}
      $obj->closeVar($queryLE); 
      $obj->closeQuery(); 
      $obj->closeConexaoGeral(); 
?>