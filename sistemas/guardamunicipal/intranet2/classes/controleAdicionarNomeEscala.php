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
$data_atual = date("Y-m-d");
$hora_atual = date("H:i:s");

$tamanho = strlen($conf);
if(isset($conf)) {

   foreach($conf as $login => $value){
      //e então você insere na tabela
      if($tamanho > 0){
			$query = "insert into listaescala(idescala,login,data,hora1,hora2,chefe,auditado,chave,he) values('$idescala','$value','$data','$horas1','$horas2','$chefe','$auditado',0,$he)";
			$obj->executaQuery($query);
			
			$query2 = "INSERT INTO candidatos (idescala,login,data,hora) values ('$idescala','$valeu','$data_atual','$hora_atual')";
			$obj->executaQuery($query2);
			
			echo "<script>alert('Nomes inseridos com sucesso!');</script>";                       
			echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";
   	  } 
   }
}
?>