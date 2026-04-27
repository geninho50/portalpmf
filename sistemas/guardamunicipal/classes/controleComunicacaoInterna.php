<?php
	$verIncluir = false;
	$verAtualizar = false;
	$verExcluir = false;
	
	$idCi = 0;
	$acao = '';
	$idCi = (int)$_POST['idCi'];
	if( $idCi == 0 )
	{
		$idCi = (int)$_GET['idCi'];
		$acao = $_GET['acao'];
	}
	$de = $_POST['xlogin'];
	$tratamento = $_POST['ytratamento'];
	$para = $_POST['ypara'];
	$assunto = $_POST['xassunto'];
	$texto = $_POST['xtexto'];
	$tamanho = strlen($de);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	
   //Pega a data atual
    $data_atual = date("Y-m-d");
	$hora_atual = date("H:i:s");


	if( $acao == 'responder' )
	{
		// alterar dados
		$query = "insert into recadodiretoresposta (idCi,de,para,assunto,textoresposta,dataresposta,statusresposta) values ('$idCi','$de','$para','$assunto','$textoresposta',CURRENT_DATE(),'$statusresposta')";
		$conexao->executaQuery($query);		
		$verAtualizar = true;
	}
	else
	if( $acao == 'excluir' )
	{
		// excluir notícia
		$query = "UPDATE recadodireto set statusexcluir=1 where id=$idCi";
		$conexao->executaQuery($query);
		$verExcluir = true;
		
	}
	else
	{
		// incluir
		$query = "insert into comunicacaointerna(de,tratamento,para,assunto,texto,data,hora) values ('$de','$tratamento','$para','$assunto','$texto','$data_atual','$hora_atual')";
		$conexao->executaQuery($query);
		echo "<script>alert('Comunicacao Interna com numero $idCi cadastrada com sucesso!');</script>";  
		echo "<script> window.location.href = '../controle/cadastro_comunicacao_interna.php' </script>";
	}
?>