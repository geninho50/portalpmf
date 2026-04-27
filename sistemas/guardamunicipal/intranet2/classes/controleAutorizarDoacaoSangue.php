<?php
	require("DB_mysql.php");
   	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$id = 0;
	$status = '';
	$id = $_POST['id'];
	$status = $_POST['status'];
	if( $id == 0 )
	{
		$id = $_GET['id'];
		$status = $_GET['status'];
		$gmsolicitante = $_GET['gmsolicitante'];
		$matricula = $_GET['matricula'];
		$grupo = $_GET['ygrupo'];
		$datadoacao = $_GET['xdatadoacao'];
		$motivostatus = $_GET['xmotivostatus'];
	}


	$sql = "SELECT turno FROM usuario where login='$gmsolicitante'";
	$result = $obj->executaQuery($sql);
    $linha = mysql_fetch_array($result); 
	if($linha)
	{
		$turno = $linha['turno'];
	}
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
	
	if( $status > 0 && $id > 0)
	{
		// alterar
		$query = "UPDATE doacaosangue set status='$status',motivostatus='$motivostatus' where id=$id";		
		$obj->executaQuery($query);
				
		$queryFC = "INSERT INTO folgacalendario (idpedido,data,gm,motivo,grupo) values ($id,'$datadoacao','$gmsolicitante','DOACAO DE SANGUE','$grupo')";
		$obj->executaQuery($queryFC);
			
		$queryI = "INSERT INTO ferias(login,data_inicial,data_final,atividade,turno) values ('$gmsolicitante','$datadoacao','$datadoacao',4,$turno)";
		$obj->executaQuery($queryI);
		
		echo "<script>alert('Doacao de sangue autorizada com sucesso!');</script>";
		echo "<script> window.location.href = '../controle/administrar_servicos_online.php' </script>";
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM doacaosangue where id=$id";
		$obj->closeVar($path);
		echo "<script>alert('Doacao de sangue deletado com sucesso!');</script>";
		echo "<script> window.location.href = '../controle/administrar_servicos_online.php' </script>";
	}
	else
	{
			$query = "INSERT INTO doacaosangue (gmsolicitante,matricula, data, grupo, datadoacao, status) values ('$gmsolicitante','$matricula','$data_atual','$grupo','$datadoacao',0)";
			echo "<script>alert('Doacao de sangue cadastrado com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/administrar_servicos_online.php' </script>";
	}
	// Excluir a Categoria
	
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($oArquivo);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>