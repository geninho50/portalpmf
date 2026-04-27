<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>
<?php
	ini_set('default_charset','UTF-8');
   
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
	
	$login = $_POST['login'];
	$matricula = $_POST['xmatricula'];
	$numblocoinicial = $_POST['xnumblocoinicial'];
	$numblocofinal = $_POST['xnumblocofinal'];
	$letra = $_POST['xletrainicial'];
	$senha = $_POST['xsenha'];
	$senhaCorreta = md5($senha);
	
	//$last_access = date('Y-m-d', strtotime('+5 year', strtotime($data_baixa)));
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	//$tamanho = strlen($guarda);


	//calculado a diferença
	$quantidade = ($numblocofinal - $numblocoinicial)+1;

	$query = "SELECT * FROM guarda_gmf where matricula=$matricula LIMIT 1";
	$resultadoC = $conexao->executaQuery($query);	
	if($linha = mysql_fetch_array($resultadoC))
	{
		$senhaTemp = $linha['senha'];
	}
	if($senhaCorreta == $senhaTemp)
	{
		$query = "SELECT * FROM receber_auto where matricula=$matricula and numblocoinicial=$numblocoinicial or numblocofinal=$numblocofinal";
		$resultadoC = $conexao->executaQuery($query);	
		$linha = mysql_fetch_array($resultadoC);
		if($linha)
			{
				echo "<script>alert('Auto ja Cadastrado!');</script>";
				echo "<script> window.location.href = '../controle/receber_auto_infracao.php?matricula=$matricula&numblocoinicial=$numblocoinicial&numblocofinal=$numblocofinal' </script>";
			}else{
				
				while($numblocoinicial<=$numblocofinal){
					$query = "insert into temp_receber_auto(login, matricula,numbloco,letra, quantidade,data_cadastro,hora_cadastro) values('$login',$matricula,$numblocoinicial,'$letra',$quantidade,'$data_atual','$hora_atual')";
					$conexao->executaQuery($query);
					$queryR = "insert into receber_auto(login, matricula,numbloco,letra, quantidade,data_cadastro,hora_cadastro) values('$login',$matricula,$numblocoinicial,'$letra',$quantidade,'$data_atual','$hora_atual')";
					$conexao->executaQuery($queryR);
					$numblocoinicial=$numblocoinicial+1;
				}
				echo "<script>alert('$quantidade autos cadastrados com sucesso!');</script>";
				echo "<script> window.location.href = '../controle/confirmar_receber_auto_infracao.php' </script>";
			}
	}else{
		echo "<script>alert('Senha ou matricula nao confere!');</script>";
		echo "<script> window.location.href = '../controle/receber_auto_infracao.php?matricula=$matricula&numblocoinicial=$numblocoinicial&numblocofinal=$numblocofinal' </script>";
	}
?>