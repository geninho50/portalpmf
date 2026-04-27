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
		$query = "DELETE FROM escalahoraextra where id=$id";
		$obj->executaQuery($query);
		$queryC = "DELETE FROM candidatos where idescala=$id";
		$obj->executaQuery($queryC);
		$queryTC = "DELETE FROM tempcandidatos where idescala=$id";
		$obj->executaQuery($queryTC);
		$queryLE = "DELETE FROM listaescala where idescala=$id";
		$obj->executaQuery($queryLE);
		
		echo "<script>alert('Dados deletados com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";

	}else{
		echo "<script>alert('Erro para exclusão dos dados!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";	
	}
	
	
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($nome);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

?>
<?php
/*	$verIncluir = false;
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
			$queryLE = "DELETE FROM listaescala where idescala='$id'";
			$obj->executaQuery($queryLE);
		} 
		
		$obj->executaQuery($query);
		$verIncluir = true;
	}
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($nome);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

	// Redireciona
	if( $verIncluir == false )
	{
		header ("Location:../controle/busca_escala_horaextra.php");
	}
	else
	{
		header ("Location:../controle/busca_escala_horaextra.php");
	}
*/?>