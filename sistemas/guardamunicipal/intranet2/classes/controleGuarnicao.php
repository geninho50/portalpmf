<?php
	
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
	
	$idOcorrencia = 0;
	$idOcorrencia = (int)$_POST['idOcorrencia'];
	if( $idOcorrencia == 0 )
	{
		$idOcorrencia = (int)$_GET['idOcorrencia'];
	}
	$vtr = $_POST['yvtr'];
	$guarda1 = $_POST['xGM1_1'];
	$guarda2 = $_POST['GM1_2'];
	$guarda3 = $_POST['GM1_3'];
	$guarda4 = $_POST['GM1_4'];
	$guarda5 = $_POST['GM1_5'];
	$setor = $_POST['setor'];
	$outros = $_POST['ytipo'];
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	$tamanho = strlen($vtr1);

	$sql = "SELECT * FROM vtr where vtr='$vtr'";
	$resultado = $conexao->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$id = $linha["id"]; 
		$idclasse = $linha["idclasse"];  
	}
	
	if( $vtr == 'A PE'){
		$idclasse=4;
	}else{
		if( $vtr == 'ADMINISTRATIVO'){
			$idclasse=5;
		}
	}
	
	/*if( $tamanho > 0 && $idOcorrencia > 0 )
	{
		// alterar dados
		echo $query = "UPDATE ocorrencia set vtr01='$vtr1',vtr02='$vtr2',guarnicao1_1='$gm1_1',guarnicao1_2='$gm1_2',guarnicao1_3='$gm1_3',guarnicao1_4='$gm1_4',guarnicao2_1='$gm2_1',guarnicao2_2='$gm2_2',guarnicao2_3='$gm2_3',guarnicao2_4='$gm2_4',guarnicao2_5='$gm2_5',hora_empenho1='$horaempenho',status=1 where id=$idOcorrencia";
		$conexao->executaQuery($query);	
		echo "<script>alert('Guarnição empenhada com sucesso!');</script>";  
		
		$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Guarnicao empenhada na ocorrencia $idOcorrencia pelo GM $guarda no setor $setor')";
		$conexao->executaQuery($queryA);                     
	}
	else
	{*/
		// incluir
		$query = "insert into guarnicao (outros,vtr,idclassevtr,guarda1,guarda2,guarda3,guarda4,guarda5,setor,data_entrada,hora_entrada,status) values ('$outros','$vtr','$idclasse','$guarda1','$guarda2','$guarda3','$guarda4','$guarda5',$setor,'$data_atual','$hora_atual',1)";
		$conexao->executaQuery($query);
		$query = "UPDATE vtr set status=1 where id=$id";
		$conexao->executaQuery($query);	
		echo "<script> window.location.href = '../controle/cadastro_guarnicao.php' </script>";
		
		$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Guarnicao $guarda1,$guarda2,$guarda3,$guarda4,$guarda5 adicionada com sucesso na $vtr no setor $setor')";
		$conexao->executaQuery($queryA);
	//}
?>