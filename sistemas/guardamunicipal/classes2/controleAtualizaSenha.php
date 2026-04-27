<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	$login = mysql_escape_string($_POST['xlogin']);
	$senhaantiga = $_POST['xsenhaantiga'];
	$novasenha = $_POST['xnovasenha'];
	$confirmarsenha = $_POST['xconfirmarsenha'];
	
	$sql = "SELECT * FROM guarda_gmf where login_usuario='$login'";
	$result = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($result);
	if( $linha )
	{
		$id = $linha["id"];
		$senha = $linha["senha"];
	}

	if( $senha == $senhaantiga )
	{
		if($novasenha==$confirmarsenha)
		{
			if(strlen(stristr($novasenha, $login))> 0) { 
				echo "<script>alert('Sua senha não pode conter o login!');</script>";                       
				echo "<script> window.location.href = '../controle/atualiza_senha.php' </script>";
			}else{
				if (preg_match('/^[A-Za-z0-9]{6,28}$/i', $novasenha)) {
					$senhanova = md5($novasenha);
					$query = "UPDATE guarda_gmf set senha='$senhanova' where login_usuario='$login'";	
					$obj->executaQuery($query);
					
					$sqlacessoGM = "update guarda_gmf set acesso=1 where login_usuario='$login'";
					$obj->executaQuery($sqlacessoGM);
					
					echo "<script>alert('Senha alterada com sucesso!');</script>";                       
					echo "<script> window.location.href = '../controle/recado_principal.php' </script>";
				}
				else{
					echo "<script>alert('Sua senha tem que conter letras e número e ter no mínimo 6 caracteres!');</script>";                       
					echo "<script> window.location.href = '../controle/atualiza_senha.php' </script>";
				}
			}
		}else {                        
				echo "<script>alert('Senhas novas não conferem!');</script>";                       
				echo "<script> window.location.href = '../controle/atualiza_senha.php' </script>";
			}
	}
	else {                
		echo "<script>alert('Senha antiga não confere!');</script>";                
		echo "<script> window.location.href = '../controle/atualiza_senha.php' </script>";             
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