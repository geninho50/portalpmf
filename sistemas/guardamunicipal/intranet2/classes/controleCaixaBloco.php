<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>
<?php
	
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
	
	$idcaixa = $_POST['idcaixa'];
	$caixa = $_POST['xcaixa'];
	$numbloco = $_POST['xnumbloco'];
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	$tamanho = strlen($caixa);
	
	
	if($tamanho > 0 && $idcaixa > 0){
		$query = "UPDATE caixa set caixa='$caixa',numbloco=$numbloco where id=$idcaixa";
		$conexao->executaQuery($query);		
		echo "<script>alert('Caixa atualizada com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/cadastro_caixa_bloco.php' </script>";	
	}else{
		$queryE = "SELECT * FROM caixa where caixa='$caixa'";
		$resultE = $conexao->executaQuery($queryE);
		$linhaE = mysql_fetch_array($resultE);
		if($linhaE){
			echo "<script>alert('Caixa ja cadastrada!');</script>";
			echo "<script> window.location.href = '../controle/cadastro_caixa_bloco.php' </script>";
		}else{
			$query = "insert into caixa (caixa,numbloco) values('$caixa',$numbloco)";
			$conexao->executaQuery($query);
			echo "<script>alert('Caixa cadastrada com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/cadastro_caixa_bloco.php' </script>";
		}
	}
?>