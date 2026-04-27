<?php

require ("DB_mysql.php");
$obj = new DB_mysql();

$login = $_POST['login'];
$conf  = $_POST['conf'];
$idescala  = $_POST['idescala'];
$horas1  = $_POST['hora1'];
$horas2  = $_POST['hora2'];
$data  = $_POST['data'];
$chefe  = $_POST['xchefe'];
$auditado  = $_POST['auditado'];
$he  = $_POST['he'];

$tamanho = strlen($conf);
if(isset($conf)) {
   foreach($conf as $login => $value){
      if($tamanho > 0){
			$query = "insert into listaescala(idescala,login,data,hora1,hora2,chefe,auditado,chave,he) values('$idescala','$value','$data','$horas1','$horas2','$chefe','$auditado',0,'$he')";
			$obj->executaQuery($query);
							
			$queryE = "update escalahoraextra set status='N' where id='$idescala'";
			$obj->executaQuery($queryE);
			// excluir candidatos
			$query = "DELETE FROM candidatos where idescala='$idescala'";
			$obj->executaQuery($query);
			
			$queryT = "DELETE FROM tempescala where idescala='$idescala'";
			$obj->executaQuery($queryT);
						
			echo "<script>alert('Escala Montada com sucesso!');</script>";                       
			echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";	
   	  } 
   }

   $obj->closeVar($query);      
   $obj->closeQuery();
   $obj->closeConexaoGeral();
}
?>