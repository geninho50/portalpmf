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
		echo $idOcorrencia = (int)$_GET['idOcorrencia'];
	}
	$login = $_POST['guarda'];
	$gerado = $_POST['gerado'];
	$tipificacao = $_POST['xtipificacao'];
	$infracao = $_POST['ait'];
	$autuados = $_POST['autuados'];
	$orientados = $_POST['orientados'];
	$motivo = $_POST['motivo'];
	$encerramento = $_POST['encerramento'];
	$encerramentoT = strtr(strtoupper($encerramento),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;

	if($gerado=='SOLICITANTE'){
		$geradoTemp=1;	
	}else{$geradoTemp=2;}
	
	
	if( $idOcorrencia > 0 )
	{
		$data_atual = date("Y-m-d");
		$hora_atual = date("H:i:s");

		$query = "UPDATE ocorrencia set guarda_finalizar='$login',tipificacao2='$tipificacao',infracao2='$infracao',autuados=$autuados,orientados=$orientados,motivo='$motivo',encerramento_ocorrencia='$encerramentoT',hora_saida='$hora_atual',status=2 where id=$idOcorrencia";
		$conexao->executaQuery($query);	
		$sql = "select * from ocorrencia_atendida where idocorrencia=$idOcorrencia";
		//echo''.$sql.'<br>';
		$result = $conexao->executaQuery($sql);
		while( $dados = mysql_fetch_array($result) )
		{
			$idguarnicao = $dados['idguarnicao'];
			$updade = "UPDATE guarnicao set status=1 where id=$idguarnicao";
			$conexao->executaQuery($updade);	
			
			$queryA = "insert into ocorrencia_atendida (idguarnicao,data_cadastro,hora_cadastro,valor,gerado,idocorrencia) values(idguarnicao,'$data_atual','$hora_atual',1,$geradoTemp,$idOcorrencia)";
			$conexao->executaQuery($queryA);
			
			$queryA = "insert into ocorrencia_finalizada (idocorrencia,data_cadastro,hora_cadastro,guarda,descricao) values($idOcorrencia,'$data_atual','$hora_atual','$login','$encerramentoT')";
			$conexao->executaQuery($queryA);

		}
		$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Ocorrencia $idOcorrencia encerrada pelo Guarda $login')";
		$conexao->executaQuery($queryA);
		echo "<script>alert('Ocorrencia finalizada com sucesso!');</script>";                     
	}
	else
	{
		echo "<script>alert('Problema no cadastro!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";
	}
?>
