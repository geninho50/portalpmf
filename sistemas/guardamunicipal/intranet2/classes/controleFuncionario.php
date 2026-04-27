<?php
	$idFuncionario = 0;
	$idFuncionario = $_POST['idFuncionario'];
	if( $idFuncionario == 0 )
	{
		$idFuncionario = $_GET['idFuncionario'];
	}
	$matricula = $_POST['xmatricula'];
	$login = $_POST['xlogin'];
	$administrador = $_POST["administrador"];
	$planejamento = $_POST["planejamento"];
	$chefia = $_POST["chefia"];
	$guardaonline = $_POST["guardaonline"];
	$setorpessoal = $_POST["setorpessoal"];
	$rondaescolar = $_POST["rondaescolar"];
	$digitacao = $_POST["digitacao"];
	$central = $_POST["central"];
	$logistica = $_POST["logistica"];
	
	$palavra = strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	$palavralogin = strtr(strtoupper($login),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	
	require ("DB_mysql.php");	
	require ("trataData.php");
	$conexao = new DB_mysql;
	$conexao->conectarConf();
	$objD = new trataData;
	
	$tamanho = strlen($login);
	if( $tamanho > 0 && $matricula > 0 )
	{
		// alterar
		$query = "UPDATE guarda_gmf set administrador='$administrador',planejamento='$planejamento',chefia='$chefia',guardaonline='$guardaonline',setorpessoal='$setorpessoal',rondaescolar='$rondaescolar',digitacao='$digitacao',central='$central',logistica='$logistica' where matricula=$matricula";		
		$conexao->executaQuery($query);
		echo "<script>alert('Dados Atualizados com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/cadastro_funcionario.php' </script>";
	}
	
?>