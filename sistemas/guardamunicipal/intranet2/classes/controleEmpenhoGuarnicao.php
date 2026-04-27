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
	$idguarnicao = (int)$_POST['idguarnicao'];
	$login = $_POST['login'];
	$motivo = $_POST['pfisica'];
	$motivo_finalizar = $_POST['motivo_finalizar'];
	$horaempenho = $_POST['hora_empenho'];
	$data_atual = date("Y-m-d");
	$hora_atual = date("H:i:s");

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	$tamanho = strlen($vtr1);

	if( $idguarnicao > 0 && $idOcorrencia > 0 )
	{
		// alterar dados
		$query = "UPDATE ocorrencia set hora_empenho='$horaempenho',status=1 where id=$idOcorrencia";
		$conexao->executaQuery($query);	
		$queryG = "UPDATE guarnicao set status=2 where id='$idguarnicao'";
		$conexao->executaQuery($queryG);
		$queryOA = "UPDATE ocorrencia_atendida set hora_cadastro='$hora_atual',idguarnicao=$idguarnicao, visivel=2 where idocorrencia=$idOcorrencia";
		$conexao->executaQuery($queryOA);
		
		//$queryI = "insert into ocorrencia_guarnicao (idocorrencia,idguarnicao,data,hora)values('$idOcorrencia','$idguarnicao','$data_atual','$horaempenho')";
		//$conexao->executaQuery($queryI);	
		
		$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Ocorrencia $idOcorrencia empenhada a guarnicao $idguarnicao')";
		$conexao->executaQuery($queryA);
		
		echo "<script>alert('Guarnicao empenhada com sucesso!');</script>"; 
	}
	else{
			// alterar dados
			
			$query = "UPDATE ocorrencia set guarda_finalizar='$login', motivo_finalizar='$motivo',encerramento_ocorrencia='$motivo_finalizar',hora_saida='$hora_atual',status=2 where id=$idOcorrencia";
			$conexao->executaQuery($query);	
			
			$query2 = "delete from ocorrencia_atendida where idocorrencia=$idOcorrencia";
			$conexao->executaQuery($query2);
			
			echo "<script>alert('Ocorrencia finalizada com sucesso!');</script>";
	}
?>