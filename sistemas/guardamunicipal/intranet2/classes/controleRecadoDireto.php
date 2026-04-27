<?php
	$verIncluir = false;
	$verAtualizar = false;
	$verExcluir = false;
	
	$idRecado = 0;
	$acao = '';
	$idRecado = $_POST['idRecado'];
	echo ''.$idRecado;
	if( $idRecado == 0 )
	{
		$idRecado = $_GET['idRecado'];
		$acao = $_GET['acao'];
	}
	$de = $_POST['xlogin'];
	$para = $_POST['ypara'];
	$assunto = $_POST['xassunto'];
	$texto = $_POST['xtexto'];
	$resposta = $_POST['resposta'];
	$status = $_POST['status'];
	$tamanho = strlen($de);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;

	if( $acao == 'responder' )
	{
		// alterar dados
		$query = "insert into recadodiretoresposta (idrecado,de,para,assunto,textoresposta,dataresposta,statusresposta) values ('$idrecado','$de','$para','$assunto','$textoresposta',CURRENT_DATE(),'$statusresposta')";
		$conexao->executaQuery($query);		
		$verAtualizar = true;
	}
	else
	if( $acao == 'excluir' )
	{
		// excluir notícia
		$query = "UPDATE recadodireto set statusexcluir=1 where id=$idRecado";
		$conexao->executaQuery($query);
		$verExcluir = true;
		
	}
	else
	{
		// incluir
		$data_texto = "";
		$data_texto = $objD->getData();
		$query = "insert into recadodireto (de,para,assunto,texto,datacadastro,statusleitura,statusexcluir) values ('$de','$para','$assunto','$texto',CURRENT_DATE(),0,0)";
		$conexao->executaQuery($query);
		$verIncluir = true;
	}
	
	if( $verIncluir == true )
	{
		header ("Location:../adm/cadastro_recado_direto.php");
	}
	else
	{
		if( $verAtualizar == true )
		{
			header ("Location:../adm/home.php");
		}
		else{
			if( $verExcluir == true )
			{
				header ("Location:../adm/home.php");
			}
		}
	}
	
	// Redireciona
	
?>