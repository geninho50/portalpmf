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
	
	$idOcorrencia = 0;
	$idOcorrencia = (int)$_POST['idOcorrencia'];
	if( $idOcorrencia == 0 )
	{
		$idOcorrencia = (int)$_GET['idOcorrencia'];
	}
	$vtr = $_POST['yvtr1'];
	$guarda1 = $_POST['yGM1_1'];
	$guarda2 = $_POST['GM1_2'];
	$guarda3 = $_POST['GM1_3'];
	$guarda4 = $_POST['GM1_4'];
	$outros = $_POST['pfisica'];
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	$tamanho = strlen($vtr1);

	if( $tamanho > 0 && $idOcorrencia > 0 )
	{
		// alterar dados
		$query = "UPDATE ocorrencia set vtr01='$vtr1',vtr02='$vtr2',guarnicao1_1='$gm1_1',guarnicao1_2='$gm1_2',guarnicao1_3='$gm1_3',guarnicao1_4='$gm1_4',guarnicao2_1='$gm2_1',guarnicao2_2='$gm2_2',guarnicao2_3='$gm2_3',guarnicao2_4='$gm2_4',hora_empenho1='$horaempenho',status=1 where id=$idOcorrencia";
		$conexao->executaQuery($query);	
		echo "<script>alert('Guarnição empenhada com sucesso!');</script>";                       
	}
	else
	{
		// incluir
		$data_texto = "";
		$data_texto = $objD->getData();
		$query = "insert into guarnicao (outros,vtr01,guarda1,guarda2,guarda3,guarda4,data_entrada,hora_entrada,status) values ('$outros','$vtr','$guarda1','$guarda2','$guarda3','$guarda4','$data_atual','$hora_atual',1)";
		echo''.$query;
		$conexao->executaQuery($query);
		echo "<script> window.location.href = '../controle/cadastro_guarnicao.php' </script>";
	
		
		/*// Pega o ultimo id inserido e atualiza a variavel $idAnotacao
		$query = "select MAX(id) as id from recado_agente";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		while ($linha=mysql_fetch_array($resultado))
		{
			$idAnotacao = $linha['id'];
		}*/
	}
?>