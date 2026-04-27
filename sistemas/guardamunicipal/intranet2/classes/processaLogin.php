<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	
	$data_atual = date("Y-m-d");
	$hora_atual = date("H:i:s");
	$cpf = mysql_escape_string($_POST['xCPF']);
	
	$sql_acesso ="select * from guarda_gmf where cpf='$cpf'";
    $resultado_acesso = mysql_query($sql_acesso) or die ("Não foi possível realizar a consulta ao banco de dados");	
	$linha_acesso = mysql_fetch_array($resultado_acesso);
    $acesso = $linha_acesso['acesso'];
	if($acesso==0){
		header("Location:../controle/atualiza_senha_primera.php?cpf=$cpf");
	}else{
	
		$sql_ativo ="select * from banido where cpf='$cpf' and data='$data_atual'";
		$resultado_ativo = mysql_query($sql_ativo);	
		$linha_ativo = mysql_fetch_array($resultado_ativo);
		$qdade = $linha_ativo['qdade'];
		
		if($qdade == 3)
		{
			$sqlGM = "update guarda_gmf set status='Inativo' where cpf='$cpf'";
			$conexao = $obj->executaQuery($sqlGM);
			header("Location:../controle/login_erro.php?Mensagem=Usuário bloqueado!<br>Entre em contato com o Administrador para resolver o problema!");
		}
		else{
			$cpf = mysql_escape_string($_POST['xCPF']);
			$senha = mysql_escape_string($_POST['xSENHA']);	
			$senhaCorreta = md5($senha);
			$ip_visitante = $_SERVER['REMOTE_ADDR'];
				
			$query = "SELECT * FROM guarda_gmf where cpf='$cpf' LIMIT 1";
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
				
				$data = date("d-m-Y");
				$hora = date("H:i:s");
				$dataHora = $data.' as '.$hora;
				$sql = "insert into conexao_gmf (cpf,senha, data, ip_visitante) values('$cpf','$senha','$dataHora','$ip_visitante')";
				$conexao = $obj->executaQuery($sql);
				$queryA = "insert into atividade (hora,data,dados)values('$hora','$data_atual','Usuario com CPF $cpf logou no sistema')";
				$conexao = $obj->executaQuery($queryA);
				
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
				header ("Location:../controle/framePrincipal.php");	
					
			}
			else{
				$data = $objD->getData();
				$hora = date("H:i:s");
				$dataHora = $data.' - '.$hora;
				$sql = "insert into conexao_gmf_erro (cpf,senha, data, ip_visitante) values('$cpf','$senha','$dataHora','$ip_visitante')";
				$conexao = $obj->executaQuery($sql);
						
				if($linha_ativo){
					$sqlTemp = "update banido set qdade=qdade+1 where cpf='$cpf' and data='$data_atual'";
					$conexao = $obj->executaQuery($sqlTemp);
				}else{
						$sqlTemp = "insert into banido (cpf,senha, data, ip_visitante, qdade) values('$cpf','$senha','$data_atual','$ip_visitante',1)";
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
				header("Location:../controle/index_erro.php?Mensagem=Login ou Senha nao confere! Voce esta sendo monitorado, seu IP e: $ip_visitante");
			}
		}   
	}
?>