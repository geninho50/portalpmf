<?php
	$idgrupo = 0;
	$idgrupo = $_POST['idgrupo'];
	if( $idgrupo == 0 )
	{
		$idgrupo = $_GET['idgrupo'];
	}
	$grupo = $_POST['xgrupo'];
	$tamanho = strlen($texto);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;

	if( $tamanho > 0 && $idgrupo > 0 )
	{
		// alterar dados
		$query = "UPDATE grupo set nome='$grupo' where id=$idgrupo";
		$conexao->executaQuery($query);	
		echo "<script>alert('Grupo atualizado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/cadastro_grupo.php' </script>";	
	}
	else
	if( $idgrupo > 0 )
	{
		// excluir notícia
		$query = "delete from grupo where id=$idgrupo";
		$conexao->executaQuery($query);
		echo "<script>alert('Grupo deletado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/cadastro_grupo.php' </script>";
	}
	else
	{
		// incluir
		$data_texto = "";
		$data_texto = $objD->getData();
		$query = "insert into grupo (nome,status) values ('$grupo',0)";
		$conexao->executaQuery($query);
		echo "<script>alert('Grupo cadastrado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/cadastro_grupo.php' </script>";
	}
?>