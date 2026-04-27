<?php
	$id = 0;
	$id = (int)$_POST['id'];
	if( $id == 0 )
	{
		$id = (int)$_GET['id'];
	}
	$visivel = $_POST['yvisivel'];
	$he = $_POST['yhe'];
	$data = $_POST['dataini'];
	$semana = $_POST['ysemana'];
	$horainicial = $_POST['xhorainicial'];
	$horafinal = $_POST['xhorafinal'];
	$qtdhoras1 = $_POST['xqtdhoras1'];
	$qtdhoras2 = $_POST['xqtdhoras2'];
	$qtdguardas = $_POST['xqtdguardas'];
	$local = $_POST['xlocal'];
	$missao = $_POST['xmissao'];
	$status = $_POST['status'];	
	$lanche = $_POST['lanche'];	
	$tempo = $_POST['tempo'];
	
	if($visivel==1){
		$status='N';
	}else{
		if($visivel==2){
			$status='S';
		}
	}
	require ("DB_mysql.php");
	$obj = new DB_mysql;

	if( $id > 0 )
	{
		// alterar
		$query = "UPDATE escalahoraextra set he='$he',data='$data',semana='$semana',horainicial='$horainicial',horafinal='$horafinal',local='$local',missao='$missao',qtdhoras1='$qtdhoras1',qtdhoras2='$qtdhoras2',qtdguardas='$qtdguardas',tempo='$tempo',lanche='$lanche',status='$status' where id=$id";	
		$obj->executaQuery($query);	
		echo "<script>alert('Dados alterado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/lista_escala_horaextra.php' </script>";	
	}
	else{
			$query = "INSERT INTO escalahoraextra (he,data,semana,horainicial,horafinal,local,missao,qtdhoras1,qtdhoras2,qtdguardas,tempo,lanche,status,chave,visivel) values ('$he','$data','$semana','$horainicial','$horafinal','$local','$missao','$qtdhoras1','$qtdhoras2','$qtdguardas','$tempo','$lanche','$status','0','$visivel')";
			$obj->executaQuery($query);
			echo "<script>alert('Escala cadastrada com sucesso!');</script>";                       
			echo "<script> window.location.href = '../controle/cadastro_escala_horaextra.php' </script>";	
	}
?>