<?php

	$idescala = 0;
	$idescala = (int)$_POST['idescala'];
	if( $idescala == 0 )
	{
		$idescala = (int)$_GET['idescala'];
	}
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	$tamanho = strlen($guarda);

		// alterar dados
		$query = "UPDATE escalahoraextra set chave=2 where id=$idescala";
		$conexao->executaQuery($query);	
		echo "<script>alert('Escala concluida com sucesso!');</script>";
		echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";                       

?>