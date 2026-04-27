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
	
	$idEspecie = 0;
	$idEspecie = (int)$_POST['idEspecie'];
	if( $idEspecie == 0 )
	{
		$idEspecie = (int)$_GET['idEspecie'];
	}
	$especie = $_POST['xespecie'];
	$tamanho = strlen($especie);

	if( $tamanho > 0 && $idEspecie > 0 )
	{
		// alterar dados
		$query = "UPDATE especie set especie='$especie' where id=$idEspecie";
		$obj->executaQuery($query);	
		echo "<script>alert('Especie do veiculo atualizado com sucesso!');</script>";  
		echo "<script> window.location.href = '../controle/cadastro_especie_veiculo.php' </script>";                     
	}
	else
	{
		// incluir
		$query = "insert into especie (especie) values('$especie')";
		$obj->executaQuery($query);
		echo "<script>alert('Especie do veiculo cadastrado com sucesso!');</script>";
		echo "<script> window.location.href = '../controle/cadastro_especie_veiculo.php' </script>";
	}
?>