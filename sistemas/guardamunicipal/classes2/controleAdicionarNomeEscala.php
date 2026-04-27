<?php

$verIncluir = false;
require ("DB_mysql.php");
$obj = new DB_mysql();

$login = $_POST['login'];
$conf  = $_POST['conf'];
$idescala  = $_POST['idescala'];
$horas1  = $_POST['hora1'];
$horas2  = $_POST['hora2'];
$chefe  = $_POST['xchefe'];
$he  = $_POST['he'];
$auditado  = $_POST['auditado'];
$data_atual = date("Y-m-d");

$tamanho = strlen($conf);
if(isset($conf)) {

   foreach($conf as $login => $value){
      //e então você insere na tabela
      if($tamanho > 0){
			$query = "insert into listaescala(idescala,login,data,hora1,hora2,chefe,auditado,chave,he) values('$idescala','$value','$data_atual','$horas1','$horas2','$chefe','$auditado',0,'$he')";
			$obj->executaQuery($query);
			
			$query2 = "insert into candidatos(idescala,login) values('$idescala','$value')";
			$obj->executaQuery($query2);
			$verIncluir = true;
   	  } 
   }

   $obj->closeVar($query);      
   $obj->closeQuery();
   $obj->closeConexaoGeral();
	
	// Redireciona
	if( $verIncluir == false )
	{
		echo 'Não foi possível efetuar o cadastro.';
	}
	else
	{
		header ("Location:../controle/administrar_escala_horaextra.php");
	}
}
?>