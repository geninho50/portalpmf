<?php
	$idTransporte = 0;
	$idTransporte = (int)$_POST['idTransporte'];
	$status = (int)$_POST['status'];
	if( $idTransporte == 0 )
	{
		$idTransporte = (int)$_GET['idTransporte'];
		$status = (int)$_GET['status'];

	}
	$nome = $_POST['xnome'];
	$telefone = $_POST['xtelefone'];
	$data = $_POST['dataini'];
	$rua = $_POST['xrua'];
	$numero = (int)$_POST['xnumero'];
	$bairro = $_POST['xbairro'];
	$referencia = $_POST['xreferencia'];
	$justificativa = $_POST['xjutificativa'];
	$hora = $_POST['xhora'];
	$informacao = $_POST['xinformacao'];
	$informacao_adicional = $_POST['xinformacao_adicional'];
	$estado_clinico = $_POST['estado_clinico'];
	$destino = $_POST['destino'];
	$cancelamento = $_POST['xcancelamento'];
	$motivonegado = $_POST['xmotivonegado'];
	$tamanho = strlen($descricao_ocorrrencia);
	
	$dataTemp = date('Y-m-d', strtotime("+3 days"));
	$horaTemp = date("H:i");
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	
	//1 aceito - 2 negado - 3 cancelado
	
	if( $status == 2 && $idTransporte > 0 )
	{
		$query = "UPDATE transporte set status=$status, motivonegado='$motivonegado',hora='$horaTemp' where id=$idTransporte";
		$conexao->executaQuery($query);	
		echo "<script>alert('Negado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_transporte.php' </script>";
	}
	if($status == 3 && $idTransporte > 0){
		$query = "UPDATE transporte set status=$status, cancelamento='$cancelamento',hora='$horaTemp' where id=$idTransporte";
		$conexao->executaQuery($query);	
		echo "<script>alert('Cancelado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_transporte.php' </script>";
	}
	if($status == 1 && $idTransporte > 0){
		$query = "UPDATE transporte set status=$status, hora='$hora',informacao_adicional='$informacao',estado_clinico='$estado_clinico',destino='$destino',motivo_aceito='$informacao_adicional' where id=$idTransporte";
		$conexao->executaQuery($query);	
		echo "<script>alert('Atualizado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_transporte.php' </script>";	
	}
	
	/*if($data < $dataTemp){
		echo "<script>alert('Data que está sendo cadastrada é menor que a data limite!');</script>";                       
		echo "<script> window.location.href = '../controle/cadastro_transporte_solidario.php' </script>";
	}else{
		// incluir
		$query = "insert into transporte (nome,telefone,data,rua,numero,bairro,referencia,justificativa,status) values ('$nome','$telefone','$data','$rua','$numero','$bairro','$referencia','$justificativa',0)";
		$conexao->executaQuery($query);
		echo "<script>alert('Cadastro realizada com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/cadastro_transporte_solidario.php' </script>";
	}*/
		
		
		/*// Pega o ultimo id inserido e atualiza a variavel $idAnotacao
		$query = "select MAX(id) as id from recado_agente";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		while ($linha=mysql_fetch_array($resultado))
		{
			$idAnotacao = $linha['id'];
		}*/
?>