<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>
<?php
	$id = 0;
	$status = '';
	$acao = '';
	$id = $_POST['id'];
	$status = $_POST['status'];
	$acao = $_POST['acao'];
	if( $id == 0 )
	{
		$id = $_GET['id'];
		$status = $_GET['status'];
		$acao = $_GET['acao'];
	}
	$gmsolicitante = $_POST['gmsolicitante'];
	$matricula = $_POST['matricula'];
	$gmsolicitado = $_POST['xguarda'];
	$datatroca = $_POST['xdatatroca'];
	$formareposicao = $_POST['xformareposicao'];
	$motivotroca = $_POST['motivo'];
	$motivostatus = $_POST['xmotivostatus'];
	$turno = $_POST['yturno'];
	$tamanho = strlen($gmsolicitante);
	$tamanhogm = strlen($gmsolicitado);


	require ("DB_mysql.php");
	$obj = new DB_mysql;
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
	
	if( $status > 0 && $id > 0)
	{
		// alterar
		$query = "UPDATE trocaservico set status='$status',motivostatus='$motivostatus' where id=$id";
		$verAtualizar = true;	
		echo "<script>alert('Atualizado com sucesso!');</script>"; 
		echo "<script> window.location.href = '../controle/cadastro_troca_servico.php' </script>";                          
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM trocaservico where id=$id";
		$obj->closeVar($path);
		echo "<script>alert('Deletado com sucesso!');</script>";  
		echo "<script> window.location.href = '../controle/cadastro_troca_servico.php' </script>";                         
	}
	else
	{
			$query = "INSERT INTO trocaservico (gmsolicitante,matricula, data, gmsolicitado, datatroca, formareposicao, motivotroca,grupo,status) values ('$gmsolicitante',$matricula,'$data_atual','$gmsolicitado','$datatroca','$formareposicao','$motivotroca','$turno',0)";
			echo "<script>alert('Inserido com sucesso!');</script>";   
			echo "<script> window.location.href = '../controle/cadastro_troca_servico.php' </script>";                    
	}
	
	// Excluir a Categoria
	$obj->executaQuery($query);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($oArquivo);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>