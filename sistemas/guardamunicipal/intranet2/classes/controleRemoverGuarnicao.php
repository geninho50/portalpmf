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
	$idGuarnicao = (int)$_POST['idGuarnicao'];
	$cont = (int)$_POST['cont'];
	if( $idOcorrencia == 0 )
	{
		$idOcorrencia = (int)$_GET['idOcorrencia'];
		$idGuarnicao = (int)$_GET['idGuarnicao'];
		$cont = (int)$_GET['cont'];
	}
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;

	$data_atual = date("Y-m-d");
	$hora_atual = date("H:i:s");
	
	$sqlG = "SELECT * FROM guarnicao where id=$idGuarnicao";
	$resultadoG = $conexao->executaQuery($sqlG);
	$linhaG = mysql_fetch_array($resultadoG);
	if( $linhaG )
	{
		$vtrTemp = $linhaG["vtr"];
		$guarda1 = $linhaG["guarda1"];
		$guarda2 = $linhaG["guarda2"];
		$guarda3 = $linhaG["guarda3"];
		$guarda4 = $linhaG["guarda4"];
		$guarda5 = $linhaG["guarda5"];
	}	

	if( $idOcorrencia > 0 )
	{
		/*$sql = "select * from ocorrencia_atendida where idocorrencia=$idOcorrencia and idguarnicao=$idGuarnicao";
		$result = $conexao->executaQuery($sql);
		$linhaOI = mysql_fetch_array($result);
		//$cont = mysql_num_rows($result);
		$id = $linhaOI['id'];*/
		if($cont==1)
		{
			$updade1 = "UPDATE guarnicao set status=1 where id=$idGuarnicao";
			$conexao->executaQuery($updade1);

			//$updade2 = "UPDATE ocorrencia set status=0 where id=$idOcorrencia";
			//$conexao->executaQuery($updade2);

			$query1 = "update ocorrencia_atendida set visivel=1, hora_saida='$hora_atual' where idocorrencia=$idOcorrencia and idguarnicao=$idGuarnicao";
			$conexao->executaQuery($query1);	
			
			$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Guarnicao $idGuarnicao - $vtrTemp, $guarda1 $guarda2 $guarda3 $guarda4 $guarda5 removida da ocorrencia $idOcorrencia')";
			$conexao->executaQuery($queryA);
		
			echo "<script>alert('Guarnição removida com sucesso!');</script>";     
		}else{
			if($cont > 1){
				
				$sql = "select * from ocorrencia_atendida where idocorrencia=$idOcorrencia";
				$result = $conexao->executaQuery($sql);
				while($linhaOI = mysql_fetch_array($result)){
					$idg = $linhaOI['idguarnicao'];
					
					$updade3 = "UPDATE guarnicao set status=1 where id=$idg";
					$conexao->executaQuery($updade3);
					
					$query = "delete from ocorrencia_atendida where idocorrencia=$idOcorrencia and idguarnicao=$idg";
					$conexao->executaQuery($query);
				
				}
				
				$updade2 = "UPDATE ocorrencia set status=0 where id=$idOcorrencia";
				$conexao->executaQuery($updade2);
				
				$queryOA = "insert into ocorrencia_atendida (hora_cadastro,data_cadastro,gerado,valor,idocorrencia)values('$hora_atual','$data_atual',1,1,$idOcorrencia)";
		$conexao->executaQuery($queryOA);
				
				$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Guarnicao $idGuarnicao - $vtrTemp, $guarda1 $guarda2 $guarda3 $guarda4 $guarda5 removida da ocorrencia $idOcorrencia')";
				$conexao->executaQuery($queryA);
			
				echo "<script>alert('Guarnição removida com sucesso!');</script>";    
			}
		}
	}
?>
