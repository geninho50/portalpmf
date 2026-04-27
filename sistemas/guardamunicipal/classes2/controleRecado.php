<?php
	$idRecado = 0;
	$idRecado = (int)$_POST['idRecado'];
	if( $idRecado == 0 )
	{
		$idRecado = (int)$_GET['idRecado'];
	}
	$nome = $_POST['xnome'];
	$texto = $_POST['xtexto'];
	$tamanho = strlen($nome);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;

	if( $tamanho > 0 && $idRecado > 0 )
	{
		// alterar dados
		$query = "UPDATE recado set nome='$nome',texto='$texto' where id=$idRecado";
		$conexao->executaQuery($query);		
	}
	else
	if( $idRecado > 0 )
	{
		// excluir notícia
		$query = "delete from recado where id=$idRecado";
		$conexao->executaQuery($query);
	}
	else
	{
		// incluir
		$data_texto = "";
		$data_texto = $objD->getData();
		$query = "insert into recado (nome,texto,data,data_texto) values ('$nome','$texto',CURRENT_DATE(),'$data_texto')";
		$conexao->executaQuery($query);

		/*// Pega o ultimo id inserido e atualiza a variavel $idRecado
		$query = "select MAX(id) as id from recado";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		while ($linha=mysql_fetch_array($resultado))
		{
			$idRecado = $linha['id'];
		}*/
	}

	// Redireciona
	header ("Location:../controle/busca_recado.php");
?>