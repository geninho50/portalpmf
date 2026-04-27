<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql ;
	$objS = new trataString;
	$conexao = $obj->conectarConf();
	
	
  	$data_atual = date("Y-m-d");
   	$hora_atual = date("H:i:s");
	

	$idespecie = (int)$_POST['yespecie'];
	$tipo = $_POST['xtipo'];
	$tamanho = strlen($tipo);

	if( $tamanho > 0 && $idtipo > 0 )
	{
		// alterar dados
		$query = "UPDATE tipo set idespecie=$idespecie, tipo='$tipo' where id=$idtipo";
		$obj->executaQuery($query);	
		echo "<script>alert('Tipo do veiculo atualizado com sucesso!');</script>";    
		echo "<script> window.location.href = '../controle/cadastro_tipo_veiculo.php' </script>";                   
	}
	else
	{
		// incluir
		$query = "insert into tipo (idespecie,tipo) values('$idespecie','$tipo')";
		$obj->executaQuery($query);
		echo "<script>alert('Tipo do veiculo cadastrado com sucesso!');</script>";
		echo "<script> window.location.href = '../controle/cadastro_tipo_veiculo.php' </script>";
	}
?>