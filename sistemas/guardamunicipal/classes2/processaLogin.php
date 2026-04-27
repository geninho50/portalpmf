<?php
	
	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	
	$data_atual = date("Y-m-d");
	$login = mysql_escape_string($_POST['xlogin']);
	
	$sql_acesso ="select * from guarda_gmf where login_usuario='$login'";
    $resultado_acesso = mysql_query($sql_acesso) or die ("Não foi possível realizar a consulta ao banco de dados");	
	$linha_acesso = mysql_fetch_array($resultado_acesso);
    $acesso = $linha_acesso['acesso'];
	if($acesso==0){
		header("Location:../controle/atualiza_senha_primera.php?login_acesso=$login");
	}else{
	
		$sql_ativo ="select * from banido where login='$login' and data='$data_atual'";
		$resultado_ativo = mysql_query($sql_ativo);	
		$linha_ativo = mysql_fetch_array($resultado_ativo);
		$qdade = $linha_ativo['qdade'];
		
		if($qdade == 3)
		{
			$sqlGM = "update guarda_gmf set status='Inativo' where login_usuario='$login'";
			$conexao = $obj->executaQuery($sqlGM);
			header("Location:../controle/login_erro.php?Mensagem=Usuário bloqueado!<br>Entre em contato com o Administrador para resolver o problema!");
		}
		else{
			$login = mysql_escape_string($_POST['xlogin']);
			$senha = mysql_escape_string($_POST['xsenha']);	
			$senhaCorreta = md5($senha);
			$ip_visitante = $_SERVER['REMOTE_ADDR'];
				
			$query = "SELECT * FROM guarda_gmf where BINARY login_usuario='$login' LIMIT 1";
			$resultadoC = $obj->executaQuery($query);	
			if($linha = mysql_fetch_array($resultadoC))
			{
				$senhaTemp = $linha['senha'];
				$statusTemp = $linha['status'];
			}
			if($senhaCorreta == $senhaTemp && $statusTemp=='Ativo')
			{
				$id = "";
				$nomeSESSION = "";
				$obj = new DB_mysql;
				$obj->retornarItem($query);
				$id = $obj->getId();
				$nomeSESSION = $obj->getNome();		
				session_start();
				if( isset ($_SESSION["nomeSESSION"])?$_SESSION["nomeSESSION"]:"" )
				{
					//DESTRÓI AS SESSOES
					unset($_SESSION["nomeSESSION"]);
					unset($_SESSION["idSESSION"]);
					session_destroy();
		
					// Início da nova Sessão do Usuário
					session_start();
					$_SESSION["idSESSION"] = $id;
					$_SESSION["nomeSESSION"] = $nomeSESSION;
				}
				else{
					$data = $objD->getData();
					$hora = date("H:i:s");
					$dataHora = $data.' - '.$hora;
					$sql = "insert into conexao_gmf (login,senha, data, ip_visitante) values('$login','$senha','$dataHora','$ip_visitante')";
					$conexao = $obj->executaQuery($sql);
					
					// Início da Sessão do Usuário			
					$_SESSION["idSESSION"] = $id;
					$_SESSION["nomeSESSION"] = $nomeSESSION;
				}	
				// Fechando as variáveis
				$obj->closeVar($xlogin);
				$obj->closeVar($xsenha);
				$obj->closeVar($conexao);
				$obj->closeVar($query);
				$obj->closeVar($id);
				$obj->closeVar($nomeSESSION);
				$obj->closeQuery();
				$obj->closeConexaoGeral();
				// Redirecione o usuário para a página de Admin 
				header ("Location:../controle/painel.php");		
			}
			else{
				$data = $objD->getData();
				$hora = date("H:i:s");
				$dataHora = $data.' - '.$hora;
				$sql = "insert into conexao_gmf_erro (login,senha, data, ip_visitante) values('$login','$senha','$dataHora','$ip_visitante')";
				$conexao = $obj->executaQuery($sql);
						
				if($linha_ativo){
					$sqlTemp = "update banido set qdade=qdade+1 where login='$login' and data='$data_atual'";
					$conexao = $obj->executaQuery($sqlTemp);
				}else{
						$sqlTemp = "insert into banido (login,senha, data, ip_visitante, qdade) values('$login','$senha','$data_atual','$ip_visitante',1)";
						$conexao = $obj->executaQuery($sqlTemp);
				}
		
				// Fechando as variáveis
				$obj->closeVar($xlogin);
				$obj->closeVar($xsenha);
				$obj->closeVar($conexao);
				$obj->closeVar($query);
				$obj->closeQuery();
				$obj->closeConexaoGeral();
				// Redirecionar para url login_erro.php
				header("Location:../controle/login_erro.php?Mensagem=Login ou Senha não confere! Você está sendo monitorado, seu IP é: $ip_visitante");
			}
		}   
	}
?>