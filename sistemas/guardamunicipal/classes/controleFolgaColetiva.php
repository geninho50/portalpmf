<?php

$verIncluir = false;
require ("DB_mysql.php");
$obj = new DB_mysql();

$login = $_POST['login'];
$conf  = $_POST['conf'];
$dias  = $_POST['tdias'];
$folga  = $_POST['xfolga'];
$cadastrado  = $_POST['cadastrado'];
$data_atual = date("Y-m-d");

$tamanho = strlen($conf);
if(isset($conf)) {

   foreach($conf as $login => $value){
      //e então você insere na tabela
      if($tamanho > 0){
			$query = "insert into folga(login,guarda,descricao,qtade,qtadeatual,data) values('$cadastrado','$value','$folga','$dias',0,'$data_atual')";
			$obj->executaQuery($query);
			echo "<script>alert('Folga cadastrada com sucesso!');</script>";                       
			echo "<script> window.location.href = '../controle/administrar_servicos_online.php' </script>";
   	  } else{
		  	echo "<script>alert('Problema no cadastrada!');</script>";                       
			echo "<script> window.location.href = '../controle/cadastro_coletivo_folga.php' </script>";
		 }
   }

}
?>