
<?php
	$idMunicao = 0;
	$idMunicao = (int)$_POST['idMunicao'];
	if( $idMunicao == 0 )
	{
		$idMunicao = (int)$_GET['idMunicao'];
	}
	$descricaocurta = $_POST['xdescricaocurta'];
	$calibre = $_POST['xcalibre'];
	$qtd = $_POST['xqtd'];
	$numeroestojo = $_POST['xnumeroestojo'];
	$datafabricacao = $_POST['datafabricacao'];
	$datavalidade = $_POST['datavalidade'];
	$tipo = $_POST['ytipo'];
	$emprego = $_POST['yemprego'];
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	$tamanho = strlen($calibre);

	if( $tamanho > 0  && $idMunicao > 0 )
	{
		// alterar dados
		$query = "UPDATE material set estoque='$estoque' where id=$idMunicao";
		$conexao->executaQuery($query);	
		echo "<script>alert('Munucai atualizado com sucesso!');</script>";  
		echo "<script> window.location.href = '../controle/cadastro_departamento.php' </script>"; 
		                    
	}
	else{
		if( $idMunicao > 0 )
		{
			// excluir envento
			$query = "delete from material where id=$idMunicao";
			$conexao->executaQuery($query);
			echo "<script>alert('Municao deletado com sucesso!');</script>";
			echo "<script>window.location.href = '../controle/cadastro_departamento.php' </script>";
		}
		else
		{
				$query = "insert into material (descricaocurta,calibre,quantidade,numeroestojo,datafabricacao,datavalidade,tipo,emprego) values('$descricaocurta','$calibre','$qtd','$numeroestojo','$datafabricacao','$datavalidade','$tipo','$emprego')";
				$conexao->executaQuery($query);
				echo "<script>alert('Municao cadastrada com sucesso!');</script>";
				echo "<script>window.location.href = '../controle/cadastro_municao.php' </script>";
				
		}
	}
?>