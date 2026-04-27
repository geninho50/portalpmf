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
	$vtr1 = $_POST['yvtr1'];
	$vtr2 = $_POST['vtr2'];
	$data_atual = date("Y-m-d");
	
	$horaempenho = $_POST['hora_empenho'];

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;

	if( $idOcorrencia > 0 )
	{
		// alterar dados
		$query = "UPDATE ocorrencia set vtr01='$vtr1',vtr02='$vtr2',hora_empenho1='$horaempenho',status=1 where id=$idOcorrencia";
		$conexao->executaQuery($query);	
		$queryG = "UPDATE guarnicao set status=2 where vtr01='$vtr1' and data_entrada='$data_atual' and status=1";
		$conexao->executaQuery($queryG);	
		echo "<script>alert('Guarnição empenhada com sucesso!');</script>";                       
	}
	else
	{
		echo "<script>alert('Problema no cadastro!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";
		
		
		/*// Pega o ultimo id inserido e atualiza a variavel $idAnotacao
		$query = "select MAX(id) as id from recado_agente";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		while ($linha=mysql_fetch_array($resultado))
		{
			$idAnotacao = $linha['id'];
		}*/
	}
?>