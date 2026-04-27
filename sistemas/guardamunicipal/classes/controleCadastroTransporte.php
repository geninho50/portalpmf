<?php
	$idTransporte = 0;
	$idTransporte = (int)$_POST['idTransporte'];
	if( $idTransporte == 0 )
	{
		$idTransporte = (int)$_GET['idTransporte'];

	}
	$nome = $_POST['xnome'];
	$telefone = $_POST['xtelefone'];
	$data = $_POST['dataini'];
	$rua = $_POST['xrua'];
	$numero = (int)$_POST['xnumero'];
	$bairro = $_POST['ybairro'];
	$referencia = $_POST['xreferencia'];
	$justificativa = $_POST['xjutificativa'];
	$hora = $_POST['xhora'];
	$motivonegado = $_POST['xmotivonegado'];
	$tamanho = strlen($descricao_ocorrrencia);
	
	$dataTemp = date('Y-m-d', strtotime("+3 days"));
	$horaTemp = date("H:i");
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	
	if($data < $dataTemp){
		echo "<script>alert('Data que está sendo cadastrada é menor que a data limite!');</script>";                       
		echo "<script> window.location.href = '../controle/cadastro_transporte_solidario.php' </script>";
	}else{
		// incluir
		$query = "insert into transporte (nome,telefone,data,rua,numero,bairro,referencia,justificativa,status) values ('$nome','$telefone','$data','$rua','$numero','$bairro','$referencia','$justificativa',0)";
		$conexao->executaQuery($query);
		echo "<script>alert('Cadastro realizada com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/confirmacao_cadastro.php' </script>";
	}
		
		
		/*// Pega o ultimo id inserido e atualiza a variavel $idAnotacao
		$query = "select MAX(id) as id from recado_agente";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		while ($linha=mysql_fetch_array($resultado))
		{
			$idAnotacao = $linha['id'];
		}*/
?>