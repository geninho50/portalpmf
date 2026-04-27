<?php
	$verIncluir = false;
	$id = 0;
	$id = $_POST['id'];
	if( $id == 0 )
	{
		$id = $_GET['id'];
	}
	$nome = $_POST['xnome'];
	$palavranome = strtr(strtoupper($nome),"אבגדהוזחטיךכלםמןנסעףפץצקרשüת‏ÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞ‗"); 
	$dias = $_POST['xdias'];
	$turno = $_POST['yturno'];
	$datalimite = $_POST['datalimite'];

	require ("DB_mysql.php");	
	$obj = new DB_mysql;

	$tamanho = strlen($nome);
	if( $tamanho > 0 && $id > 0 )
	{
		// alterar
		$query = "UPDATE agente_zonaazul set nome='$palavranome',dias='$dias',turno='$turno',datalimite='$datalimite' where id=$id";		
	}
	else
	if( $id > 0 )
	{
		// excluir
		$query = "DELETE FROM agente_zonaazul where id=$id";
	}
	else
	{
		// incluir
		if( $tamanho > 0 ){
			// Pega o ultimo id inserido e atualiza a variavel $idNoticia
			$queryU = "select nome from agente_zonaazul where nome='$nome'";
			$obj->executaQuery($queryU);
			$result = mysql_query($queryU) or die ("Nדo foi possםvel realizar a consulta ao banco de dados AGENTE");	
			$dados=mysql_fetch_array($result);
			if($dados)
			{
				echo'O agente jב estב cadastrado';
			}else{
				$query = "INSERT INTO agente_zonaazul (nome,dias,turno,datalimite) values ('$palavranome','$dias','$turno','$datalimite')";
				$verIncluir = true;
			}
		}
	}
	
	$obj->executaQuery($query);
	// Fechando as variבveis
	$obj->closeVar($id);
	$obj->closeVar($nome);
	$obj->closeVar($colocacao);
	$obj->closeVar($query);
	$obj->closeQuery();
	$obj->closeConexaoGeral();
	// Redireciona
	if( $verIncluir == false )
	{
		header ("Location:../adm/busca_agente_zonaazul.php");
	}
	else
	{
		header ("Location:../adm/cadastro_agente_zonaazul.php");
	}
?>