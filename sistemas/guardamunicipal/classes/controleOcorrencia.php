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
	$telefone = $_POST['xtelefone'];
	$comunicante = $_POST['comunicante'];
	$rua = $_POST['rua'];
	$numero = $_POST['numero'];
	$bairro = $_POST['bairro'];
	$referencia = $_POST['referencia'];
	$descricao = $_POST['xdescricao'];
	$tipificacao = $_POST['tipificacao'];
	$data_cadastro = $_POST['data_cadastro'];
	$horacadastro = $_POST['hora_cadastro'];
	$tamanho = strlen($descricao_ocorrrencia);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;

	if( $tamanho > 0 && $idOcorrencia > 0 )
	{
		// alterar dados
		$query = "UPDATE ocorrencia set texto='$texto' where id=$idOcorrencia";
		$conexao->executaQuery($query);	
		echo "<script>alert('Atualizado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";	
	}
	else
	{
		// incluir
		$query = "insert into ocorrencia (guarda,telefone,comunicante,rua,numero,bairro,referencia,descricao_ocorrencia,tipificacao,data_cadastro,hora_cadastro,status) values ('$guarda','$telefone','$comunicante','$rua','$numero','$bairro','$referencia','$descricao','$tipificacao','$data_cadastro','$hora_cadastro',0)";
		$conexao->executaQuery($query);
		echo "<script>alert('Cadastro realizada com sucesso!');</script>";                       
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