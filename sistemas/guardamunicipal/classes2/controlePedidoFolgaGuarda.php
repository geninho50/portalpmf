<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	
	
	$verIncluir = false;
	$verAtualizar = false;
	$verExcluir = false;
	$id = 0;
	$id = (int)$_POST['idtemp'];
	if( $id == 0 )
	{
		$id = (int)$_GET['idtemp'];
	}
	$idfolga = $_POST['idfolga'];
	$descricao = $_POST['descricao'];
	$status = $_POST['status'];
	$gmsolicitante = $_POST['gmsolicitante'];
	$matricula = $_POST['matricula'];
	$turno = $_POST['yturno'];
	$datainicio = $_POST['xdatainicio'];
	$datafim = $_POST['xdatafim'];
	$motivofolga = $_POST['motivo'];
	$motivostatus = $_POST['xmotivostatus'];
	$qtadeatual = $_POST['xqtadeatual'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;
	$tamanho = strlen($gmsolicitante);
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	$data_atual = date("Y-m-d");
	$hora_atual = date("H:i:s");
	
	$data1=''; // coloque a data vinda do banco de dados
	$data1= explode("-",$datainicio); 
	$data2=''; // coloque a data vinda do banco de dados
	$data2= explode("-",$datafim); 
				
	$datatemp1 = mktime(0,0,0,$data1[1],$data1[2],$data1[0]);
	$datatemp2 = mktime(0,0,0,$data2[1],$data2[2],$data2[0]);
	$dias = ($datatemp2 - $datatemp1)/86400;
	$dias = ceil($dias)+1;
		
	$queryR = "SELECT * FROM folga where id=$idfolga";
	$resultR = $obj->executaQuery($queryR);
	$linhaR = mysql_fetch_array($resultR);
	if( $linhaR )
	{
		$qtade = $linhaR['qtade'];
		$qtadeatual = $linhaR['qtadeatual'];
		if($qtade > $qtadeatual){
			$resultado = $qtade - $qtadeatual;
		}
	}
			
	if($dias <= $resultado){
		$query = "INSERT INTO pedidofolga(idfolga,gmsolicitante,matricula,data,hora,turno,datainicio,datafim,motivofolga,status) values ('$idfolga','$gmsolicitante','$matricula','$data_atual','$hora_atual','$turno','$datainicio','$datafim','$motivofolga',0)";
		$obj->executaQuery($query);
		echo "<script>alert('Folga cadastrada com sucesso!');</script>";             	
		echo "<script> window.location.href = '../controle/listar_pedido_folga.php' </script>";
	}else{
			echo "<script>alert('Impossível registrar pedido de folga. Você tem direito a $resultado dias de folga e está solicitando $dias dias!');</script>";
			echo "<script> window.location.href = '../controle/cadastro_pedido_folga_chefia.php?idfolga=$idfolga&login=$gmsolicitante' </script>";
	}
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($oArquivo);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>