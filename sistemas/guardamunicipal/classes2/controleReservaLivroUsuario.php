<?php
	require ("DB_mysql.php");	
	$conexao = new DB_mysql;
	$conexao->conectarConf();
	
	$idReserva = 0;
	$idReserva = (int)$_POST['idReserva'];
	if( $idReserva == 0 )
	{
		$idReserva = (int)$_GET['idReserva'];
	}
	
	$matricula = (int)$_POST['matricula'];
	$guardareserva = $_POST['login'];
	$codigo = $_POST['codigo'];
	$titulo = $_POST['titulo'];
	$data = $_POST['dataini'];
	
	$tamanho = strlen($titulo);
	if( $tamanho > 0 && $idReserva > 0 )
	{
		// alterar
		$query = "UPDATE reserva set data='$data' where id=$idReserva";		
		$conexao->executaQuery($query);
	}
	else
	if( $idReserva > 0 )
	{
		// excluir
		$query = "DELETE FROM reserva where id=$idReserva";
		$conexao->executaQuery($query);	
	}
	else
	{
			// incluir
		$queryC = "select id,DAY(datareserva) as dia,MONTH(datareserva) as mes,YEAR(datareserva) as ano, codigolivro from reserva where codigolivro='$codigo' and datareserva='$data'";
		$resultadoC = mysql_query($queryC);	
		//echo''.$resultadoC;
		$linhaC = mysql_fetch_array($resultadoC);
			$dia = $linhaC["dia"];
			$mes = $linhaC["mes"];
			$ano = $linhaC["ano"];
		
		if($linhaC){		
			echo 'Livro já está reservado para o dia '.$dia." / ".$mes." / ".$ano.'!';
		}else{
		
			$queryR = "select id,DAY(datalocacao) as diaL,MONTH(datalocacao) as mesL,YEAR(datalocacao) as anoL, DAY(datadevolucao) as diaD,MONTH(datadevolucao) as mesD,YEAR(datadevolucao) as anoD, codigolivro from locacao where codigolivro='$codigo'";
			$resultadoR = mysql_query($queryR);	
			$linhaR = mysql_fetch_array($resultadoR);
				$diaL = $linhaC["diaL"];
				$mesL = $linhaC["mesL"];
				$anoL = $linhaC["anoL"];
				$diaD = $linhaC["diaD"];
				$mesD = $linhaC["mesD"];
				$anoD = $linhaC["anoD"];
			if($linhaC){		
				echo 'Livro já está reservado para o dia '.$dia." / ".$mes." / ".$ano.'!';
			}else{
				$query = "INSERT INTO reserva (matricula,guarda,codigolivro,titulo,datareserva,guardareserva,data) values ('$matricula','$guarda','$codigo','$titulo','$data','$guardareserva',CURRENT_DATE())";
				$conexao->executaQuery($query);
				echo "<script>alert('Reserva realizada com sucesso!');</script>";                       
				echo "<script> window.location.href = '../controle/busca_livros_usuario.php' </script>";
			}
		}
	}		
	
	// Redireciona
?>