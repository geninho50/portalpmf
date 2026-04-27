<?php
	
	require ("DB_mysql.php");
	$obj = new DB_mysql();
	
	$conf  = $_POST['conf'];
	$id = $_POST['idfolga'];
	$idpedido = $_POST['idtemp'];
	$data = $_POST['data'];
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
	$qtadeatual = 1;


	$tamanho = strlen($conf);
	if(isset($conf)) {
	   foreach($conf as $data => $value){
		  if($tamanho > 0){
					if( $status > 0 && $id > 0)
					{
						if($status == 1){
							$query = "UPDATE pedidofolga set status='$status' where id=$idpedido";	
							$obj->executaQuery($query);
							
							$queryF = "UPDATE folga set qtadeatual=qtadeatual+$qtadeatual where id=$idfolga";
							$obj->executaQuery($queryF);
							
							$queryP = "INSERT INTO folgacalendario(idfolga,idpedido,data,gm,motivo,turno) values ('$idfolga','$idpedido','$value','$gmsolicitante','$motivofolga','$turno')";
							$obj->executaQuery($queryP);
							
							echo "<script>alert('Folga abonada com sucesso!');</script>";             	
							echo "<script> window.location.href = '../controle/administrar_servicos_online.php' </script>";
							
						}else{
								if($status == 2){
									$query = "UPDATE pedidofolga set status='$status',motivostatus='$motivostatus' where id=$idpedido";
									$obj->executaQuery($query);
									$verAtualizar = true;
								}
						}	
				}
				else
				if( $id > 0 )
				{
					// excluir Categoria
					$query = "DELETE FROM pedidofolga where id=$id";
					$obj->executaQuery($query);
					$verExcluir = true;
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
						$query = "INSERT INTO pedidofolga(idfolga,gmsolicitante,matricula,data,turno,datainicio,datafim,motivofolga,status) values ('$idfolga','$gmsolicitante','$matricula','$data_atual','$turno','$datainicio','$datafim','$motivofolga',0)";
						$obj->executaQuery($query);
						echo "<script>alert('Folga cadastrada com sucesso!');</script>";             	
						echo "<script> window.location.href = '../controle/administrar_servicos_online.php' </script>";
					}else{
						echo "<script>alert('Impossível registrar pedido de folga. Você tem direito a '.$resultado.' dias de folga e está solicitando '.$dias.' dias!');</script>";
						echo "<script> window.location.href = '../controle/cadastro_pedido_folga_chefia.php' </script>";
					}
				}
			}	
		//fim if status		
   		}
	}


/*
	$data = $_POST['dataini'];
	$gm = $_POST['ygmsolicitante'];
	$motivo = $_POST['motivo'];
	$turno = $_POST['yturno'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;
	$tamanho = strlen($gm);
	
	$data_atual = date("Y-m-d");
	
	if( $status > 0 && $id > 0)
	{
		// alterar
		$query = "UPDATE folgacalendario set data='$data',gm='$gm',motivo='$motivo',turno='$turno' where id=$id";	
		$verAtualizar = true;	
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM folgacalendario where id=$id";
		$obj->closeVar($path);
		$verExcluir = true;
	}
	else
	{
			$query = "INSERT INTO folgacalendario (data,gm,motivo,turno) values ('$data','$gm','$motivo','$turno')";
		$verIncluir = true;
	}
	
	
	// Excluir a Categoria
	$obj->executaQuery($query);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

	// Redireciona
	if( $verIncluir == true )
	{
		header ("Location:../controle/administrar_servicos_online.php");
	}
	else
	{
		if( $verAtualizar == true )
		{
			echo 'Atualizado com sucesso';
		}
		else{
			if( $verExcluir == true )
			{
				echo 'Excluído com sucesso';
			}
		}
	}
*/
?>