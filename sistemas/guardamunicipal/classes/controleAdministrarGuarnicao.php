<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>
<?php
	
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
	
	$idGuarnicao = $_GET['idGuarnicao'];
	$chave = $_GET['chave'];
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();

	if( $chave == 'Finalizar' )
	{
		// alterar dados
		$query = "UPDATE guarnicao set status=0 where id=$idGuarnicao";
		$conexao->executaQuery($query);	
		echo "<script>alert('Expediente encerrado com sucesso!');</script>"; 
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";                       
	}
	if( $chave == 'J4' )
	{
		// alterar dados
		$query = "UPDATE guarnicao set status=3 where id=$idGuarnicao";
		$conexao->executaQuery($query);	
		$queryJ4 = "insert into j4(idGuarnicao, hora_entrada, data_entrada,status) values ($idGuarnicao,'$hora_atual','$data_atual',0)";
		$conexao->executaQuery($queryJ4);
		echo "<script>alert('Guarnição em J4!');</script>"; 
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";                       
	}
	else{
		if($chave=='ExcluirJ4')
		{
			$query = "UPDATE guarnicao set status=1 where id=$idGuarnicao";
			$conexao->executaQuery($query);	
			$queryJ4 = "UPDATE j4 set hora_saida='$hora_atual',status=1 where idGuarnicao=$idGuarnicao and status=0";
			echo''.$queryJ4;
			$conexao->executaQuery($queryJ4);	
			echo "<script>alert('Guarnição removida do J4!');</script>"; 
			echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>"; 
		}
	}
	if( $chave == 'J5' )
	{
		// alterar dados
		$query = "UPDATE guarnicao set status=4 where id=$idGuarnicao";
		$conexao->executaQuery($query);	
		$queryJ4 = "insert into j5(idGuarnicao, hora_entrada, data_entrada,status) values ($idGuarnicao,'$hora_atual','$data_atual',0)";
		$conexao->executaQuery($queryJ4);
		echo "<script>alert('Guarnição em J5!');</script>"; 
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";                       
	}
	else{
		if($chave=='ExcluirJ5')
		{
			$query = "UPDATE guarnicao set status=1 where id=$idGuarnicao";
			$conexao->executaQuery($query);	
			$queryJ4 = "UPDATE j5 set hora_saida='$hora_atual',status=1 where idGuarnicao=$idGuarnicao and status=0";
			echo''.$queryJ4;
			$conexao->executaQuery($queryJ4);	
			echo "<script>alert('Guarnição removida do J5!');</script>"; 
			echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>"; 
		}
	}
	if( $chave == 'J6' )
	{
		// alterar dados
		$query = "UPDATE guarnicao set status=5 where id=$idGuarnicao";
		$conexao->executaQuery($query);	
		$queryJ4 = "insert into j6(idGuarnicao, hora_entrada, data_entrada,status) values ($idGuarnicao,'$hora_atual','$data_atual',0)";
		$conexao->executaQuery($queryJ4);
		echo "<script>alert('Guarnição em J6!');</script>"; 
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";                       
	}
	else{
		if($chave=='ExcluirJ6')
		{
			$query = "UPDATE guarnicao set status=1 where id=$idGuarnicao";
			$conexao->executaQuery($query);	
			$queryJ4 = "UPDATE j6 set hora_saida='$hora_atual',status=1 where idGuarnicao=$idGuarnicao and status=0";
			echo''.$queryJ4;
			$conexao->executaQuery($queryJ4);	
			echo "<script>alert('Guarnição removida do J6!');</script>"; 
			echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>"; 
		}
	}
	if( $chave == 'J8' )
	{
		// alterar dados
		$query = "UPDATE guarnicao set status=6 where id=$idGuarnicao";
		$conexao->executaQuery($query);	
		$queryJ4 = "insert into j6(idGuarnicao, hora_entrada, data_entrada,status) values ($idGuarnicao,'$hora_atual','$data_atual',0)";
		$conexao->executaQuery($queryJ4);
		echo "<script>alert('Guarnição em J8!');</script>"; 
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";                       
	}
	else{
		if($chave=='ExcluirJ8')
		{
			$query = "UPDATE guarnicao set status=1 where id=$idGuarnicao";
			$conexao->executaQuery($query);	
			$queryJ4 = "UPDATE j8 set hora_saida='$hora_atual',status=1 where idGuarnicao=$idGuarnicao and status=0";
			echo''.$queryJ4;
			$conexao->executaQuery($queryJ4);	
			echo "<script>alert('Guarnição removida do J8!');</script>"; 
			echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>"; 
		}
	}
	if( $chave == 'INDISPONIVEL' )
	{
		// alterar dados
		$query = "UPDATE guarnicao set status=6 where id=$idGuarnicao";
		$conexao->executaQuery($query);	
		$queryJ4 = "insert into indisponivel(idGuarnicao, hora_entrada, data_entrada,status) values ($idGuarnicao,'$hora_atual','$data_atual',0)";
		$conexao->executaQuery($queryJ4);
		echo "<script>alert('Guarnição em J8!');</script>"; 
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";                       
	}
	else{
		if($chave=='ExcluirINDISPONIVEL')
		{
			$query = "UPDATE guarnicao set status=1 where id=$idGuarnicao";
			$conexao->executaQuery($query);	
			$queryJ4 = "UPDATE indisponivel set hora_saida='$hora_atual',status=1 where idGuarnicao=$idGuarnicao and status=0";
			echo''.$queryJ4;
			$conexao->executaQuery($queryJ4);	
			echo "<script>alert('Guarnição Diponível novamente!');</script>"; 
			echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>"; 
		}
	}
?>