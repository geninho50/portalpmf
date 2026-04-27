<?php
   require ("DB_mysql.php");
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
 
	$id = 0;
	$id = (int)$_POST['id'];
	if( $id == 0 )
	{
		$id = (int)$_GET['id'];
		$guarda2 = $_GET['guarda'];
	}
	
	
	$turno = $_POST['yturno'];
	$data = $_POST['dataini'];
	$guarda = $_POST['guarda'];
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m?s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
   
   $mesTemp = $mes_atual+1;
	
	if( $id > 0 )
	{
		// excluir Categoria
		$queryR = "select * from horaextra where id=$id";
		$resultR = $obj->executaQuery($queryR);
		$dadosR = mysql_fetch_array($resultR);
		if($dadosR['guarda']==$guarda2){
			$query = "DELETE FROM horaextra where id=$id and guarda='$guarda2'";
			$obj->executaQuery($query);
			echo "<script>alert('Seu nome foi removido com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/listar_escala_horaextra.php' </script>";
		}else{
			echo "<script>alert('Voce nao tem permissao para excluir o nome de outro usuario!');</script>";
			echo "<script> window.location.href = '../controle/listar_escala_horaextra.php' </script>";
		}
	}
	else
	{
			$queryD = "select * from horaextra where guarda='$guarda' and MONTH(data)='$mesTemp'";
			$resultD = $obj->executaQuery($queryD);
			$contador = mysql_num_rows($resultD);
			if($contador==2){
				echo "<script>alert('Seu nome ja esta cadastrado para dois dias!');</script>";
				echo "<script> window.location.href = '../controle/listar_escala_horaextra.php' </script>";
			}else{
				$queryD = "select * from horaextra where guarda='$guarda' and data='$data' and turno='$turno'";
				$resultD = $obj->executaQuery($queryD);
				$dadosD = mysql_fetch_array($resultD);
				
				if($dadosD){
					echo "<script>alert('Seu nome ja esta cadastrado para esse turno!');</script>";
					echo "<script> window.location.href = '../controle/listar_escala_horaextra.php' </script>";
				}
				else{
					$query = "select * from horaextra where data='$data' and turno='$turno'";
					$resultado = $obj->executaQuery($query);
					$dados = mysql_fetch_array($resultado);
					$cont = mysql_num_rows($resultado);
					$turno = $dados['turno'];
					if($turno=='MATUTINO' && $cont >= 3 || $turno=='VESPERTINO' && $cont >= 4){
						echo "<script>alert('Limite de no maximos de 3 vagas para o turno matutino ou 4 para o turno vespertino foram preenchidos!');</script>";
						echo "<script> window.location.href = '../controle/listar_escala_horaextra.php' </script>";
					}
					else{
						$queryA = "insert into horaextra (guarda,turno,data) values('$guarda','$turno','$data')";
						$obj->executaQuery($queryA);
						echo "<script>alert('Nome adicionado com sucesso a escala!');</script>";
						echo "<script> window.location.href = '../controle/listar_escala_horaextra.php' </script>";
					}
				}
			}
	}
	
	
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>
