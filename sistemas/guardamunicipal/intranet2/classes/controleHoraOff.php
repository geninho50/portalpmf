<?php
	$login = $_POST['xguarda'];
	$dataini  = $_POST['dataini'];
	$hora1  = $_POST['xhora100'];
	$hora2  = $_POST['xhora200'];
	$adicional  = $_POST['xadicional'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$tamanho = strlen($login);
	
	$data_atual = date("Y-m-d");
	
	if( $tamanho > 0 )
	{
		$query = "INSERT INTO listaescala(login,hora1,hora2,adicional,idescala,data) values ('$login','$hora1','$hora2','$adicional',0,'$dataini')";
		$obj->executaQuery($query);
		echo "<script>alert('Hora Off cadastrada com sucesso!');</script>";
		echo "<script> window.location.href = '../controle/cadastro_horaextra_off.php' </script>";
	}else{
		echo "<script>alert('Não foi possível efetuar o cadastro!');</script>";
		echo "<script> window.location.href = '../controle/cadastro_horaextra_off.php' </script>";
    }
?>