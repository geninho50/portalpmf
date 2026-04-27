<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>
<?php
	$id = 0;
	$id = $_POST['idtemp'];
	if( $id == 0 )
	{
		$id = $_GET['idtemp'];
	}
	$idfolga = $_POST['idfolga'];
	$descricao = $_POST['descricao'];
	$gmautorizou = $_POST['gmautorizou'];
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
	
	$queryG = "SELECT turno FROM usuario where login='$gmsolicitante'";
	$resultG = $obj->executaQuery($queryG);
    $linhaG = mysql_fetch_array($resultG); 
	if($linhaG)
	{
		$turno = $linhaG['turno'];
	}
	
	
	if( $status > 0 && $id > 0)
	{
		
		//autorizando a folga
		if($status == 1){
			$query = "UPDATE pedidofolga set status='$status', autorizado='$gmautorizou' where id=$id";	
			$obj->executaQuery($query);
			$queryF = "UPDATE folga set qtadeatual=qtadeatual+1 where id=$idfolga";
			$obj->executaQuery($queryF);
			$queryFC = "INSERT INTO folgacalendario (idfolga,idpedido,data,gm,motivo,grupo) values ($idfolga,$id,'$datainicio','$gmsolicitante','$motivofolga','$grupo')";
			$obj->executaQuery($queryFC);
			
			$queryI = "INSERT INTO ferias(login,data_inicial,data_final,atividade,turno) values ('$gmsolicitante','$datainicio','$datainicio',3,$turno)";
			$obj->executaQuery($queryI);
			
			echo "<script>alert('Autorizado com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/administrar_servicos_online.php' </script>";
		}else{
				//negando a folga
				if($status == 2){
					$query = "UPDATE pedidofolga set status='$status',motivostatus='$motivostatus', autorizado='$gmautorizou' where id=$id";
					$obj->executaQuery($query);
					echo "<script>alert('Negado com sucesso!');</script>";
					echo "<script> window.location.href = '../controle/administrar_servicos_online.php' </script>";
				}
		}	
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM pedidofolga where id=$id";
		$obj->executaQuery($query);
		echo "<script>alert('Deletado com sucesso!');</script>";
		echo "<script> window.location.href = '../controle/troca_servico.php' </script>";
	}
	else
	{
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
			
			$data_atual = date("Y-m-d");
			
			if($dias <= $resultado){
				$query = "INSERT INTO pedidofolga(idfolga,gmsolicitante,matricula,data,grupo,datainicio,datafim,motivofolga,status) values ('$idfolga','$gmsolicitante','$matricula','$data_atual','$grupo','$datainicio','$datafim','$motivofolga',0)";
				$obj->executaQuery($query);
				echo "<script>alert('Inserido com sucesso!');</script>";
				echo "<script> window.location.href = '../controle/troca_servico.php' </script>";
			}else{
				header ("Location:../controle/mensagem.php?Mensagem=Impossível registrar pedido de folga. Você tem direito a ".$resultado." dias de folga e está solicitando ".$dias." dias!");
			}

	}
	// Excluir a Categoria
	//$obj->executaQuery($query);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($oArquivo);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

?>