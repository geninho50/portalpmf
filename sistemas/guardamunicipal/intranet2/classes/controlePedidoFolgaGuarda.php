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
	$grupo = $_POST['ygrupo'];
	$datainicio = $_POST['xdatainicio'];
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
	
	$queryT = "SELECT * FROM pedidofolga where gmsolicitante='$gmsolicitante' and idfolga=$idfolga";
	$nvaloresencontrados = $obj->numregistros($queryT);

	if($nvaloresencontrados < $qtade){
			$queryP = "SELECT * FROM pedidofolga where datainicio='$datainicio'";
			$resultP = $obj->executaQuery($queryP);
			$linhaP = mysql_fetch_array($resultP);
			if( $linhaP )
			{
				echo "<script>alert('Voce ja possue folga cadastrada para este dia: $datainicio!');</script>";
				echo "<script> window.location.href = '../controle/cadastro_pedido_folga.php?idfolga=$idfolga&login=$gmsolicitante' </script>";
			}else{
				$query = "INSERT INTO pedidofolga(idfolga,gmsolicitante,matricula,data,hora,grupo,datainicio,motivofolga,status) values ('$idfolga','$gmsolicitante','$matricula','$data_atual','$hora_atual','$grupo','$datainicio','$motivofolga',0)";
				$obj->executaQuery($query);
				echo "<script>alert('Folga cadastrada com sucesso!');</script>";             	
				echo "<script> window.location.href = '../controle/listar_pedido_folga.php' </script>";
			}
	}else{
			echo "<script>alert('Impossivel registrar este pedido de folga. Voce tem direito a $qtade dia(s) de folga e ja solicitando $nvaloresencontrados dia(s)!');</script>";
			echo "<script> window.location.href = '../controle/cadastro_pedido_folga.php?idfolga=$idfolga&login=$gmsolicitante' </script>";
	}
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($oArquivo);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>