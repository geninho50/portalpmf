<?php
	$id = 0;
	$id = $_POST['idescala'];
	$status = $_POST['status'];
	if( $id == 0 )
	{
		$id = $_GET['idescala'];
		$status = $_GET['status'];
	}
	require ("DB_mysql.php");
	$obj = new DB_mysql;

	if( $id > 0 )
	{
		$query = "DELETE FROM escalahoraextra where id='$id'";
		
		$queryCA = "SELECT * from candidatos where idescala='$id'";
		$resultado = $obj->executaQuery($queryCA);
		while ( $linhaCA = mysql_fetch_array($resultado) ){
			$queryC = "DELETE FROM candidatos where idescala='$id'";
			$obj->executaQuery($queryC);
		}
		
		$queryTCA = "SELECT * from tempcandidatos where idescala='$id'";
		$resultadoTCA = $obj->executaQuery($queryTCA);
		while ( $linhaTCA = mysql_fetch_array($resultadoTCA) ){
			$queryTC = "DELETE FROM tempcandidatos where idescala='$id'";
			$obj->executaQuery($queryTC);
		} 
		
		$queryLCA = "SELECT * from listaescala where idescala='$id'";
		$resultadoLCA = $obj->executaQuery($queryLCA);
		while ( $linhaLCA = mysql_fetch_array($resultadoLCA) ){
			$queryLC = "DELETE FROM listaescala where idescala='$id'";
			$obj->executaQuery($queryLC);
		} 
		
		$obj->executaQuery($query);
		
		$queryT = "DELETE FROM tempescala where idescala='$id'";
		$obj->executaQuery($queryT);
		
		echo "<script>alert('Escala deletada com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";
	}
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($nome);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

?>