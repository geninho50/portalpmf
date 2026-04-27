<?php
	$idmaterial = 0;
	$idmaterial = (int)$_POST['idmaterial'];
	if( $idmaterial == 0 )
	{
		$idmaterial = (int)$_GET['idmaterial'];
	}
	$login = $_POST['login'];
	$idcautela = $_POST['idcautela'];
	$qtd = $_POST['xqtd'];
	$subgrupo = $_POST['subgrupo'];
	$nome = $_POST['xdescricaocurta'];
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	$tamanho = strlen($codmaterial);
	
	$query = "SELECT * FROM material where id='$idmaterial'";
	$result = $conexao->executaQuery($query);
	$dados = mysql_fetch_array($result);
	if( $dados )
	{
		$quantidade = $dados["quantidade"];
		$codmaterial = $dados["codmaterial"];
	}
	
	//Pega a data atual
    $data_atual = date("Y-m-d");
	$hora_atual = date("H:i:s");
	if($idcautela > 0){
		$tempQtd = $quantidade-$qtd;
		$queryU = "UPDATE material set quantidade='$tempQtd' where id=$idmaterial";
		$conexao->executaQuery($queryU);
		$queryC = "insert into cautela(idmaterial,idcautela,nome,subgrupo,qtd,data,hora,status) values($idmaterial,$idcautela,'$nome','$subgrupo',$qtd,'$data_atual','$hora_atual',0)";
		$conexao->executaQuery($queryC);
		$query2 = "insert into estoque_movimento(idmaterial,codmaterial,qtdanterior,qtdinserida,data,hora,login,chave) values($idmaterial,'$codmaterial',$quantidade,$qtd,'$data_atual','$hora_atual','$login',4)";
		$conexao->executaQuery($query2);
		
	echo "<script>alert('Material inserido a cautela com sucesso!');</script>";  		
	echo "<script> window.location.href = '../controle/cautela_material.php' </script>"; 
	}else{
		echo "<script>alert('Cadastre primeiro a matricula antes de selecionar o material!');</script>";  		
		echo "<script> window.location.href = '../controle/pre_cautela_material.php' </script>"; 
	}
			
?>