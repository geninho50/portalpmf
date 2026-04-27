<?php

$verIncluir = false;
require ("DB_mysql.php");
$obj = new DB_mysql();

$conf  = $_POST['conf'];
$idescala  = $_POST['idescala'];
$tamanho = strlen($conf);


if(isset($conf)) {

   foreach($conf as $login => $value){
			$query = "INSERT INTO montarescala(idescala,login,hora,troca) values ('$idescala','".$value['LOGIN']."','".$value['HORA']."','')";
			$obj->executaQuery($query);
			$verIncluir = true;
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
		header ("Location:../adm/busca_escala_finalsemana.php");
	}
}
?>