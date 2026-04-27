<?php
	
	require ("DB_mysql.php");
	$obj = new DB_mysql();
	

	$id = $_GET['id'];
	$idfolga = $_GET['idfolga'];
	$idpedido = $_GET['idpedido'];
		

	if( $id > 0 )
	{
		// excluir Categoria
		$queryD = "DELETE FROM folgacalendario where id=$id";
		$obj->executaQuery($queryD);
		$queryF = "UPDATE folga set qtadeatual=qtadeatual-1 where id=$idfolga";
		$obj->executaQuery($queryF);
		
		$queryDF = "select * from folga where id=$idfolga";
		$result = $obj->executaQuery($queryDF);
		$linha = mysql_fetch_array($result);
		if($linha)
		{
			$qtdatual = $linha['qtadeatual'];
			if($qtdatual == 0){
				$query = "DELETE FROM pedidofolga where id=$idpedido";
				$obj->executaQuery($query);
			}
		}
		
		
		echo "<script>alert('Folga removida com sucesso!');</script>";             	
		echo "<script> window.location.href = '../controle/administrar_servicos_online.php' </script>";
	}

?>