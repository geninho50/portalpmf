<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>
<?php
	ini_set('default_charset','UTF-8');
   
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
	
	$idcaixa = $_POST['idcaixa'];
	$guarda = $_POST['login'];
	$numinicialbloco = $_POST['xnumbloco'];
	$agente = $_POST['xGM1_1'];
	$data_baixa = $_POST['xdataini'];
	
	$last_access = date('Y-m-d', strtotime('+5 year', strtotime($data_baixa)));
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	$tamanho = strlen($guarda);

	$queryTB = "SELECT * FROM caixa where id=$idcaixa";
	$resultadoTB = $conexao->executaQuery($queryTB);
	$linhaTB = mysql_fetch_array($resultadoTB);
    if($linhaTB)
    {
		$numbloco = $linhaTB['numbloco'];
	}


	$queryB = "SELECT count(idcaixa) as total FROM bloco where idcaixa=$idcaixa group by idcaixa";
	$resultadoB = $conexao->executaQuery($queryB);
	$linhaB = mysql_fetch_array($resultadoB);
    if($linhaB)
    {
        $total = $linhaB['total'];
		
		if($total > $numbloco){
			echo "<script>alert('Caixa com limite de 30 blocos ja cadastrado!');</script>";
			echo "<script> window.location.href = '../controle/pre_cadastro_bloco.php' </script>";
		}else{
			$sqlA = "SELECT * FROM bloco where numinicialbloco='$numinicialbloco'";
			$resultadoA = $conexao->executaQuery($sqlA);
			$linhaA = mysql_fetch_array($resultadoA);
			if( $linhaA )
			{
				echo "<script>alert('Bloco ja cadastrado!');</script>";
				echo "<script> window.location.href = '../controle/cadastro_bloco.php' </script>";
			}
			else{
				$query = "insert into bloco (idcaixa,guarda,numinicialbloco,agente,data_fim,data_baixa,data_cadastro,hora_cadastro,status) values('$idcaixa','$guarda','$numinicialbloco','$agente','$last_access','$data_baixa','$data_atual','$hora_atual',0)";
				$conexao->executaQuery($query);
				echo "<script>alert('Bloco cadastrado com sucesso!');</script>";
				echo "<script> window.location.href = '../controle/cadastro_bloco.php?idcaixa=$idcaixa' </script>";
			}
		}
	}

	
?>