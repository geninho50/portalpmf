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
	$escola = $_POST['idescola'];
	$data = $_POST['data'];
	$guarda = $_POST['guarda'];
	$guarda1 = $_POST['xGM1_1'];
	$guarda2 = $_POST['GM1_2'];
	$guarda3 = $_POST['GM1_3'];
	$vtr = $_POST['xvtr'];
	$comunicante = $_POST['comunicante'];
	$tipo = $_POST['xtipo'];
	$descricao = $_POST['xdescricao'];
	$tamanho = strlen($descricao);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	
	//Pega a data atual
    $data_atual = date("Y-m-d");
	$hora_atual = date("H:i:s");
	
	if( $tamanho > 0 && $idOcorrencia > 0 )
	{
		// alterar dados
		$query = "UPDATE solicitacaoescola set texto='$texto' where id=$idOcorrencia";
		$conexao->executaQuery($query);	
		
		echo "<script>alert('Dados da ocorrencia atualizado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";	
	}
	else
	{
		// incluir
		$query = "insert into solicitacaoescola (escola,guarda,guarda1,guarda2,guarda3,vtr,comunicante,tipo,descricao,data_cadastro,hora_cadastro) values ($escola,'$guarda','$guarda1','$guarda2','$guarda3','$vtr','$comunicante','$tipo','$descricao','$data','$hora_atual')";
		$conexao->executaQuery($query);
		echo "<script>alert('Ocorrencia Escolar inserida com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/listar_solcitacao_escola.php?idEscola=$escola' </script>";
	}
?>