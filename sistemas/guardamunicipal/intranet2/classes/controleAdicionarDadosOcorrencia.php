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
	if( $idOcorrencia == 0 )
	{
		$idOcorrencia = (int)$_GET['idOcorrencia'];
	}
	$guarda = $_POST['guarda'];
	$descricao = $_POST['descricao'];
	$descricaoT = strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	$tamanho = strlen($descricaoT);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	
	$data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");

		$sqlA = "SELECT * FROM dados_ocorrencia where idOcorrencia=$idOcorrencia";
		$resultadoA = $conexao->executaQuery($sqlA);
		$linhaA = mysql_fetch_array($resultadoA);
		if( $linhaA )
		{
			$query = "UPDATE dados_ocorrencia set descricao_ocorrencia='$descricaoT' where idOcorrencia=$idOcorrencia";
			$conexao->executaQuery($query);	
			$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Atualizando dados a Ocorrencia $idOcorrencia pelo guarda $guarda')";
			$conexao->executaQuery($queryA);
			
			echo "<script>alert('Atualizado com sucesso!');</script>";  
		}
		else{
			$query = "insert into dados_ocorrencia (idocorrencia,descricao_ocorrencia,data,hora,guarda) values ('$idOcorrencia','$descricaoT','$data_atual','$hora_atual','$guarda')";
			$conexao->executaQuery($query);
			$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Inserindo dados a Ocorrencia $idOcorrencia pelo guarda $guarda')";
			$conexao->executaQuery($queryA);
			
			echo "<script>alert('Inserido com sucesso!');</script>";  
		}
?>