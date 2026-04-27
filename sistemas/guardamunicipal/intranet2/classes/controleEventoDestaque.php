<?php
	$idEvento = 0;
	$idEvento = $_POST['idEvento'];
	if( $idEvento > 0 )
	{
		// id do Evento pego...
	}
	else
	{
		$idEvento = $_GET['idEvento'];
	}

	$acao = 1;
	$acao = $_POST['acao'];
	if( $acao == 0 )
	{
		$acao = $_GET['acao'];
	}

	require ("DB_mysql.php");
	$obj = new DB_mysql ;
	$conexao = $obj->conectarConf();
	$eventoDestaque = 0;

	// Para acao = 1 deve-se cadastrar o produto como destaque e acao = 2 deve-se removê-lo...
	if( $acao == 1 )
	{
		$query = "INSERT INTO eventodestaque (idevento) values ($idEvento)";
		
		// Verificar se o produto já é de Destaque
		$queryDe = "SELECT * from eventodestaque where idevento=$idEvento";
		$resultadoDe = $obj->executaQuery($queryDe);	
		if ( $linhaDe = mysql_fetch_array($resultadoDe) )
		{
			$eventoDestaque = 1;
		}
	}
	else
	{
		$query = "DELETE FROM eventodestaque where idevento=$idEvento";
	}
	if( ( $acao == 1 && $eventoDestaque == 0 ) || ( $acao != 1 ) )
	{
		$obj->executaQuery($query);
	}

	header ("Location:../adm/cadastro_evento_de_destaque.php");
?>