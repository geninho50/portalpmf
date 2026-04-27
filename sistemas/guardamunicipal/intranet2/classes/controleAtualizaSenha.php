<?php
	require ("DB_mysql.php");
	$obj = new DB_mysql;
	
	$cpf = $_POST['xcpf'];
	$senhaantiga = $_POST['xsenhaantiga'];
	$novasenha = $_POST['xnovasenha'];
	$confirmarsenha = $_POST['xconfirmarsenha'];
	
	$tamanho = strlen($novasenha);
	
	if($tamanho>=6){
	
	
		$sql = "SELECT * FROM guarda_gmf where cpf='$cpf'";
		$result = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($result);
		if( $linha )
		{
			$id = $linha["id"];
			$senha = $linha["senha"];
		}
		$senhaantiga = md5($senhaantiga);
	
		if( $senha == $senhaantiga )
		{
			if($novasenha==$confirmarsenha)
			{
				$novasenha = md5($novasenha);
				$query = "UPDATE guarda_gmf set senha='$novasenha' where cpf=$cpf";		
				$obj->executaQuery($query);
				echo "<script>alert('Senha alterada com sucesso!');</script>";                       
				echo "<script> window.location.href = '../controle/recado_principal.php' </script>";
			} else {                        
					echo "<script>alert('Senhas novas nao conferem!');</script>";                       
					echo "<script> window.location.href = '../controle/recado_principal.php' </script>";
				}
		}
		else { 
			echo "<script>alert('Senhas antigas nao conferem!');</script>";                       
			echo "<script> window.location.href = '../controle/recado_principal.php' </script>";             
		}
	}
	else{
		echo "<script>alert('Senhas tem que ter no minimo 6 caracteres!');</script>";                       
		echo "<script> window.location.href = '../controle/recado_principal.php' </script>";
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