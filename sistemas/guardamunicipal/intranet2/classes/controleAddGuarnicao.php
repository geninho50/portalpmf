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
	$idguarnicao = (int)$_POST['yidguarnicao'];
	$hora_atual = date("H:i:s");
	$data_atual = date("Y-m-d");

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	$tamanho = strlen($vtr1);

	// alterar dados
	$queryG = "UPDATE guarnicao set status=2 where id='$idguarnicao'";
	$conexao->executaQuery($queryG);
	$queryI = "insert into ocorrencia_atendida (idocorrencia,idguarnicao,gerado,visivel,valor,data_cadastro,hora_cadastro)values('$idOcorrencia','$idguarnicao',0,2,1,'$data_atual','$hora_atual')";
	$conexao->executaQuery($queryI);
	
    //$query1 = "insert into guarnicao_apoio_ocorrencia(idguarnicao,idocorrencia,data,hora_entrada)values('$idguarnicao','$idOcorrencia','$data_atual','$hora_atual')";
	//$conexao->executaQuery($query1);	
	
	$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Guarnicao $idguarnicao adicionada na ocorrencia $idOcorrencia')";
	$conexao->executaQuery($queryA);
		
	echo "<script>alert('Guarnicao adicionada com sucesso!');</script>"; 
?>