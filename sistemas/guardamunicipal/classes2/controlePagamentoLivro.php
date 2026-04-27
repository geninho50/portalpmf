<?php
	require ("DB_mysql.php");	
	$conexao = new DB_mysql;
	$conexao->conectarConf();
	
	//Pega a data atual
	$data_atual = date("Y-m-d");
	
	$idReserva = 0;
	$idReserva = (int)$_POST['idReserva'];
	if( $idReserva == 0 )
	{
		$idReserva = (int)$_GET['idReserva'];
	}
	
	$codigo = $_POST['codigo'];
	$titulo = $_POST['titulo'];
	$guardareserva = $_POST['guardareserva'];
	$datapagamento = $_POST['datareserva'];
	
	$chave = mysql_escape_string($_POST['chave']);
	$login = mysql_escape_string($_POST['login']);
	$senha = mysql_escape_string($_POST['xsenha']);	
	$senhaCorreta = md5($senha);
	
	$query = "SELECT * FROM guarda_gmf where BINARY login='$login' LIMIT 1";
	$resultadoC = $conexao->executaQuery($query);	
	if($linha = mysql_fetch_array($resultadoC))
	{
		$senhaTemp = $linha['senha'];
	}
	if($chave=='Pagamento')
	{
		if($senhaCorreta == $senhaTemp)
		{
			$queryP = "INSERT INTO pagamentolivro (guardareserva,codigolivro,titulo,datapagamento,datadevolucao,guardaatendente,datatexto,status) values ('$guardareserva','$codigo','$titulo','$datapagamento','$datadevolucao','$guardareserva',CURRENT_DATE(),0)";
			$conexao->executaQuery($queryP);
			$queryD = "DELETE FROM reserva where codigolivro='$codigo' and guardareserva='$guardareserva' and datareserva='$datapagamento'";
			$conexao->executaQuery($queryD);
			echo "<script>alert('Pagamento Realizado com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/listar_reservas_livro.php' </script>";
		}
		else{
			echo "<script>alert('Senha não confere!');</script>";                       
			echo "<script> window.location.href = '../controle/listar_reservas_livro.php' </script>";
		}
	}
	else
	{
			$queryR = "UPDATE pagamentolivro set datadevolucao='$data_atual', status=1 where id=$idReserva";		
			$conexao->executaQuery($queryR);
			echo "<script>alert('Devolução Realizado com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/listar_devulucao_livro.php' </script>";
	}
?>