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
	
	$idGuarnicao = (int)$_POST['idGuarnicao'];
	$chave = $_POST['chave'];
	$motivo = $_POST['xmotivo'];
	$motivo = strtr(strtoupper($motivo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	$vtr = $_POST['vtr'];

   	$idp18 = (int)$_GET['idp18'];
   
   if( $idGuarnicao == 0 )
   {
	 $idGuarnicao = (int)$_GET['idGuarnicao'];
	 $chave = $_GET['chave'];
	 $vtr = $_GET['vtr'];
   }
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();

	$sqlG = "SELECT * FROM guarnicao where id=$idGuarnicao";
	$resultadoG = $conexao->executaQuery($sqlG);
	$linhaG = mysql_fetch_array($resultadoG);
	if( $linhaG )
	{
		$vtrTemp = $linhaG["vtr"];
		$guarda1 = $linhaG["guarda1"];
		$guarda2 = $linhaG["guarda2"];
		$guarda3 = $linhaG["guarda3"];
		$guarda4 = $linhaG["guarda4"];
		$guarda5 = $linhaG["guarda5"];
	}

	if( $chave == 1 )
	{
		// alterar dados
		$query = "UPDATE guarnicao set status=8 where id=$idGuarnicao";
		$conexao->executaQuery($query);	
		$queryJ4 = "insert into p18(idGuarnicao, hora_entrada, data_entrada,motivo,status) values ($idGuarnicao,'$hora_atual','$data_atual','$motivo',0)";
		$conexao->executaQuery($queryJ4);
		
		$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','$idGuarnicao - $vtrTemp, $guarda1 $guarda2 $guarda3 $guarda4 $guarda5 adicionada ao P18')";
		$conexao->executaQuery($queryA);
		
		echo "<script>alert('Guarnicao em P18!');</script>"; 
		
	}
	else{
			$query = "UPDATE guarnicao set status=1 where id=$idGuarnicao";
			$conexao->executaQuery($query);	
			$queryJ4 = "UPDATE p18 set hora_saida='$hora_atual',status=1 where id=$idp18";
			$conexao->executaQuery($queryJ4);	
			
			$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','$idGuarnicao - $vtrTemp removida do P18')";
			$conexao->executaQuery($queryA);
			
			echo "<script>alert('Guarnicao Diponivel novamente!');</script>"; 
			echo "<script> window.location.href = '../controle/controle_guarnicao_disponivel.php' </script>"; 
	}
?>