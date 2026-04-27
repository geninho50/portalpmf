<?
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	$cpf = $_POST['xcpf'];
	$chave = $_POST['xchave'];
	$chave = md5($chave);
	$senha = $_POST['xsenha'];

	$query = "SELECT * FROM guarda_gmf where cpf='$cpf'";
	$resultado = $obj->executaQuery($query);
	$linha = mysql_fetch_array($resultado);
	if ($linha)
	{
		$chaveBanco = $linha['chave'];
		$cpfBanco = $linha['cpf'];
		//$emailBanco = $linha['email'];
	}
	
	if($cpf==$cpfBanco){
		if($chave==$chaveBanco){
			$senha = md5($senha);
			$queryE = "update guarda_gmf set senha='$senha' where cpf='$cpf'";
			$obj->executaQuery($queryE);
			echo '
			<script type="text/JavaScript">
			alert("Senha atualizada com sucesso! ");
			location.href="../controle/index.php"
			</script>
			';
		}
		else{
			echo '
			<script type="text/JavaScript">
			alert("Sua chave esta incorreto! ");
			location.href="../controle/index.php"
			</script>
			';
		}
	}
	else{
		echo '
		<script type="text/JavaScript">
		alert("Seu cpf esta incorreto! ");
		location.href="../controle/index.php"
		</script>
		';
	}
?> 