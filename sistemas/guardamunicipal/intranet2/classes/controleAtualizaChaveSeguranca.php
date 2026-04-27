<?php
	require ("DB_mysql.php");
	$obj = new DB_mysql;
	
	$cpf = $_POST['xcpf'];
	$chaveantiga = $_POST['xchaveantiga'];
	$novachave = $_POST['xnovachave'];
	$confirmarchave = $_POST['xconfirmarchave'];
	
	$tamanho = strlen($novachave);
	if($tamanho==4){
	
	
		$sql = "SELECT * FROM guarda_gmf where cpf='$cpf'";
		$result = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($result);
		if( $linha )
		{
			$id = $linha["id"];
			$chave = $linha["chave"];
		}
		$chaveantiga = md5($chaveantiga);
	
		if($chave==$chaveantiga)
		{
			if($novachave==$confirmarchave)
			{
				$novachave = md5($novachave);
				$query = "UPDATE guarda_gmf set chave='$novachave' where cpf=$cpf";		
				$obj->executaQuery($query);
				echo "<script>alert('Chave alterada com sucesso!');</script>";                       
				echo "<script> window.location.href = '../controle/atualiza_chave_seguranca.php' </script>";
			}else{                        
				echo "<script>alert('Chaves novas nao conferem!');</script>";                       
				echo "<script> window.location.href = '../controle/atualiza_chave_seguranca.php' </script>";
			 }
		}
		else{ 
			echo "<script>alert('Chaves antigas nao conferem!');</script>";                       
			echo "<script> window.location.href = '../controle/atualiza_chave_seguranca.php' </script>";             
		}
	}
	else{
		echo "<script>alert('Chaves tem que ter 4 caracteres!');</script>";                       
		echo "<script> window.location.href = '../controle/atualiza_chave_seguranca.php' </script>";
	}
	
	// Excluir a Categoria
	$obj->executaQuery($query);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($nome);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

?>