<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>

<?php
	$idOcorrencia = 0;
	$idOcorrencia = (int)$_POST['idOcorrencia'];
	$idguarnicao = (int)$_POST['idguarnicao'];
	$idguarnicao2 = (int)$_POST['yidguarnicao2'];
	if( $idOcorrencia == 0 )
	{
		$idOcorrencia = (int)$_GET['idOcorrencia'];
	}
	$vtr1 = $_POST['vtr'];
	$vtr2 = $_POST['yvtr2'];
	$data_atual = date("Y-m-d");
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	
	$sqlG = "SELECT * FROM guarnicao where id=$idguarnicao";
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

	$sqlG2 = "SELECT * FROM guarnicao where id=$idguarnicao2";
	$resultadoG2 = $conexao->executaQuery($sqlG2);
	$linhaG2 = mysql_fetch_array($resultadoG2);
	if( $linhaG2 )
	{
		$vtrTemp2 = $linhaG2["vtr"];
		$guarda12 = $linhaG2["guarda1"];
		$guarda22 = $linhaG2["guarda2"];
		$guarda32 = $linhaG2["guarda3"];
		$guarda42 = $linhaG2["guarda4"];
		$guarda52 = $linhaG2["guarda5"];
	}

	if( $idOcorrencia > 0 )
	{
		// alterar dados
		$queryI = "insert into troca_guarnicao(idocorrencia, idguarnicao_saida, idguarnicao_entrada, hora_troca, data_troca) values('$idOcorrencia','$idguarnicao','$idguarnicao2','$hora_atual','$data_atual')";
		$conexao->executaQuery($queryI);	

		$conexao->executaQuery($queryU);
		$queryG = "UPDATE guarnicao set status=1 where id='$idguarnicao'";
		$conexao->executaQuery($queryG);
		$queryT = "UPDATE guarnicao set status=2 where id='$idguarnicao2'";
		$conexao->executaQuery($queryT);
		$queryOG = "UPDATE ocorrencia_atendida set idguarnicao=$idguarnicao2 where idguarnicao='$idguarnicao' and idocorrencia='$idOcorrencia'";
		$conexao->executaQuery($queryOG);	
		
		$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Guarnicao $idguarnicao - $vtrTemp, $guarda1 $guarda2 $guarda3 $guarda4 $guarda5 substituida pela Guarnicao $idguarnicao2 - $vtrTemp2, $guarda12 $guarda22 $guarda32 $guarda42 $guarda52')";
		$conexao->executaQuery($queryA);
		
		echo "<script>alert('Guarnicao trocada com sucesso!');</script>";    
	}
?>