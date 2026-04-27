<?php
	
		//Pega a data atual
   $data_atual = date("Y-m-d");
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o mês da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
   include("../controle/incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   require ("DB_mysql.php");
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
   
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$login = $linhaS["login"];
	}
	
	$verIncluir = false;
	$verAtualizar = false;
	$verExcluir = false;

	$id = (int)$_POST['id'];
	$nome = $_POST['nome'];
	
	
	if( $id == 0 )
	{
		$id = (int)$_GET['id'];
		$nome = $_GET['nome'];
	}
	$data = $_POST['dataini'];
	$agente = $_POST['yagente'];
	
	
	$sql2 = "SELECT * FROM agente_zonaazul where nome='$agente'";
	$result2 = $obj->executaQuery($sql2);
	$linha2 = mysql_fetch_array($result2);
	if( $linha2 )
	{
		$turno = $linha2["turno"];
		
	}
	
	$tamanho = strlen($agente);
	
	//verifica se já está em algum dia cadastrado a hora, para futura comparação e não permitindo cadastrar no mesmo dia.
	$queryH = "select * from horaagente where agente='$agente' and data='$data'";
	$resultH = $obj->executaQuery($queryH);
	$dadosH = mysql_fetch_array($resultH);
	$agenteTemp = $dadosH['agente'];
	$dataTemp = $dadosH['data'];
	
	$data_atual = date("Y-m-d");
	
	if( $tamanho > 0 && $id > 0)
	{
		// alterar
		$query = "UPDATE horaagente set data='$data',agente='$agente',turno='$turno' where id=$id";	
		$verAtualizar = true;	
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM horaagente where id=$id";
		$obj->executaQuery($query);
		$queryD = "UPDATE agente_zonaazul set dias=dias+1 where nome='$nome'";
		$obj->executaQuery($queryD);
		$obj->closeVar($path);
		$verExcluir = true;
	}
	else
	{
			$queryT = "select * from agente_zonaazul where nome='$agente'";
			$obj->executaQuery($queryT);
			$resultT = mysql_query($queryT) or die ("Não foi possível realizar a consulta ao banco de dados AGENTE");	
			$dadosT=mysql_fetch_array($resultT);
			
			$dias = $dadosT['dias'];
			$idU = $dadosT['id'];
			$idAgente=$dadosT['colocacao'];
			$idTemp = $idAgente-1;
			
			//guarda anterior
			$queryD = "select * from agente_zonaazul where colocacao=$idTemp";
			$obj->executaQuery($queryD);
			$resultD = mysql_query($queryD) or die ("Não foi possível realizar a consulta ao banco de dados AGENTE");	
			$dadosD=mysql_fetch_array($resultD);
			
			$diasTemp = $dadosD['dias'];//dias do anterior
			$datalimite = $dadosD['datalimite'];//data limite do anterior
			$nomeTemp = $dadosD['nome'];
			    
			if($data_atual <= $datalimite && $login != 'ALBERTO'){//verifica se o anterior ainda está dentro do limite de data de escolha
				header ("Location:../controle/mensagem.php?Mensagem=Impossível cadastrar, agente anterior tem que cadastrar seus dias");
			}else{
				  if($data_atual > $datalimite && $login == $agente || $login == 'ALBERTO'){
					$diaTemp=$dias-1;

					if($agenteTemp == $agente && $dataTemp == $data){//verifica se o agente já foi cadastrado
						header ("Location:../controle/mensagem.php?Mensagem=Seu nome já foi inserido nesta data");
					}else{
						if($agenteTemp != $agente && dataTemp != $data || $agenteTemp == $agente && dataTemp != $data){
							if($login == $agente || $login == 'ALBERTO'){
								$query = "INSERT INTO horaagente (data,agente,turno) values ('$data','$agente','$turno')";
								$queryU = "UPDATE agente_zonaazul set dias=$diaTemp where id=$idU";	
								$verIncluir = true;
							}
							else{
								if($login != $agente){
									header ("Location:../controle/mensagem.php?Mensagem=Você está inserindo o nome de outro usuário");
								}
							}
						}
					}
				}
			}
	}
	
	
	// Excluir a Categoria       
	$obj->executaQuery($query);
	$obj->executaQuery($queryU);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

	// Redireciona
	if( $verIncluir == true )
	{
		if($login == 'ALBERTO' || $login == 'JONAS'){
			header ("Location:../controle/administrar_agente_zonaazul.php");
		}else{
			header ("Location:../controle/adicionar_agente_zonaazul.php");
		}
	}
	else
	{
		if( $verAtualizar == true )
		{
			header ("Location:../controle/mensagem.php?Mensagem=Atualizado com sucesso");
		}
		else{
			if( $verExcluir == true )
			{
				header ("Location:../controle/administrar_agente_zonaazul.php");
			}
		}
	}
?>
