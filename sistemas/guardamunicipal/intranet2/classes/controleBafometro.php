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
	$abordados = (int)$_POST['xabordados'];
	$acimalimite = (int)$_POST['xacimalimite'];
	
	$tamanho = strlen($guarda);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");

		// incluir
		for($i=0; $i<$acimalimite; $i++){
			$nome = $_POST['xnome'.$i];
			$cnh = $_POST['xcnh'.$i];
			$dnrc = $_POST['xdnrc'.$i];
			$indice = $_POST['xindice'.$i];
			$query = "insert into bafometro (idocorrencia,guarda,abordado,acimalimite,nome,cnh,dnrc,indice) values ('$idOcorrencia','$guarda','$abordados','$acimalimite','$nome','$cnh','$dnrc','$indice')";
			$conexao->executaQuery($query);
		}
		
		$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Dados do bafometro inserido na ocorrencia $idOcorrencia')";
			$conexao->executaQuery($queryA);
		
		echo "<script>alert('Cadastro dos dados realizada com sucesso!');</script>";                       
?>