
<?php
	$idFuncionario = 0;
	$idFuncionario = (int)$_POST['idFuncionario'];
	if( $idFuncionario == 0 )
	{
		$idFuncionario = (int)$_GET['idFuncionario'];
	}
	$matricula = $_POST['xmatricula'];
	$nome = $_POST['xnome'];
	$login = $_POST['xlogin'];
	$senha = $_POST['xsenha'];
	$palavra = strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	
	$hash = md5($senha);
	
	$horario = date(" Y-m-d H:i:s");
	
	require ("DB_mysql.php");	
	$conexao = new DB_mysql;
	$conexao->conectarConf();
	
	$tamanho = strlen($nome);
	if( $tamanho > 0 && $idFuncionario > 0 )
	{
		// alterar
		$query = "UPDATE guarda_gmf set matricula='$matricula',nome='$palavra',login='$login',senha='$hash' where id=$idFuncionario";		
		$conexao->executaQuery($query);
	}
	else
	if( $idFuncionario > 0 )
	{
		// excluir
		$query = "DELETE FROM guarda_gmf where id=$idFuncionario";
		$conexao->executaQuery($query);	
	}
	else
	{
		$queryC = "select login from guarda_gmf where login='$login'";
		$resultadoC = mysql_query($queryC) or die ("Não foi possível realizar a consulta ao banco de dados");	
		$linhaC = mysql_fetch_array($resultadoC);
		if($linhaC){		
			echo 'Usuário já cadastrado!';
		}else{
			// incluir
			$query = "INSERT INTO guarda_gmf (matricula,nome,login,senha) values ('$matricula','$palavra','$login','$hash')";
			$queryConexao = "insert into conexao_gmf(login,data) values ('$login','$horario')";
			$conexao->executaQuery($query);
			$conexao->executaQuery($queryConexao);
			
			header ("Location:../controle/cadastro_funcionario.php");
			
		}	
	}
	
	// Redireciona
	
	//,nivel='$nivel',cargo='$cargo',status='$status',administrador='$administrador',educacao='$educacao',central='$cetral',noticia='$noticia',comando='$comando',escala='$escala',eventos='$eventos',recados='$recados',servicos='$servicos',atividades='$atividades',monografia='$monografia',zonaazul='$zonaazul',atestado='$atestado',atestadoadm='$atestadoadm',atestadochefia='$atestadochefia',funcionario='$funcionario',parametro='$parametro',nivelfunc='$nivelfunc',manutencao='$manutencao',guardas='$guardas',zonaazulagente='$zonaazulagente'
	//,nivel,status,cargo,administrador,educacao,central,noticia,comando,escala,eventos,recados,servicos,atividades,monografia,zonaazul,atestado,atestadoadm,atestadochefia,funcionario,parametro,nivelfunc,manutencao,guardasa,zonaazulagente
	//,'$nivel','$status','$cargo','$administrador','$educacao','$central','$noticia','$comando','$escala','$eventos','$recados','$servicos','$atividades','$monografia','$zonaazul','$atestado','$atestadoadm','$atestadochefia','$funcionario','$parametro','$nivelfunc','$manutencao','$guardas','$zonaazulagente'
?>