<?php
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	$idEvento = 0;
	$idEvento = (int)$_POST['idevento'];
	if( $idEvento == 0 )
	{
		$idEvento = (int)$_GET['idevento'];
		
		
	}
	$descricao = $_POST['descricao'];
	$descricaoT = strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	
	if($status=1){
		$query = "UPDATE evento set status=1,relatorionaoatendimento='$descricaoT' where id=$idEvento";
		$conexao->executaQuery($query);		
		echo "<script>alert('Atualizado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/adm_evento.php' </script>";	
	}
?>