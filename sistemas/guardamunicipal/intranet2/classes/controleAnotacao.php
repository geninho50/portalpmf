<?php
	$idAnotacao = 0;
	$idAnotacao = $_POST['idAnotacao'];
	if( $idAnotacao == 0 )
	{
		$idAnotacao = $_GET['idAnotacao'];
	}
	$texto = $_POST['xtexto'];
	$tamanho = strlen($texto);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;

	if( $tamanho > 0 && $idAnotacao > 0 )
	{
		// alterar dados
		$query = "UPDATE anotacao set texto='$texto' where id=$idAnotacao";
		$conexao->executaQuery($query);		
	}
	else
	if( $idAnotacao > 0 )
	{
		// excluir notícia
		$query = "delete from anotacao where id=$idAnotacao";
		$conexao->executaQuery($query);
	}
	else
	{
		// incluir
		$data_texto = "";
		$data_texto = $objD->getData();
		$query = "insert into anotacao (texto,data,data_texto) values ('$texto',CURRENT_DATE(),'$data_texto')";
		$conexao->executaQuery($query);

		// Pega o ultimo id inserido e atualiza a variavel $idAnotacao
		$query = "select MAX(id) as id from recado_agente";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		while ($linha=mysql_fetch_array($resultado))
		{
			$idAnotacao = $linha['id'];
		}
	}

	// Redireciona
	header ("Location:../adm/cadastro_anotacao.php");
?>