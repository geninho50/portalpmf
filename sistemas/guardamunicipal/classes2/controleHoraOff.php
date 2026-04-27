<?php
	$login = $_POST['ylogin'];
	$dataini  = $_POST['dataini'];
	$hora1  = $_POST['xhora1'];
	$hora2  = $_POST['xhora2'];
	$adicional  = $_POST['xadicional'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$tamanho = strlen($login);
	
	$data_atual = date("Y-m-d");
	
	if( $tamanho > 0 )
	{
		// incluir
			$query = "INSERT INTO totalhoras (login,hora1,hora2,adicional,idescala,data) values ('$login','$hora1','$hora2','$adicional',0,'$dataini')";
			$obj->executaQuery($query);
			$query1 = "INSERT INTO listaescala (login,idescala,hora1,hora2,data) values ('$login',0,'$hora1','$hora2','$dataini')";
			$obj->executaQuery($query1);
			echo "<script>alert('Hora Off inserida com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/cadastro_horaextra_off.php' </script>";	}
?>