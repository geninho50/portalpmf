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
	$placa = $_POST['xplaca'];
	$marcamodelo = $_POST['xmarcamodelo'];
	$rua = $_POST['rua'];
	$numero = $_POST['numero'];
	$bairro = $_POST['bairro'];
	$referencia = $_POST['referencia'];
	$obs = $_POST['obs'];
	$obsT = strtr(strtoupper($obs),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	$guarnicao = $_POST['idguarnicao'];
	$infracao = $_POST['xait'];
	$drv = $_POST['xdrv'];
	$tamanho = strlen($placa);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	
	$data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");

	$sqlG = "SELECT * FROM guarnicao where id=$guarnicao";
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

		// incluir
		$query = "insert into guinchamento (guarda,placa,marcamodelo,rua,numero,bairro,referencia,obs,idguarnicao,infracao,drv,data_cadastro,hora_cadastro,idocorrencia) values ('$guarda','$placa','$marcamodelo','$rua','$numero','$bairro','$referencia','$obsT','$guarnicao','$infracao','$drv','$data_atual','$hora_atual','$idOcorrencia')";
		$conexao->executaQuery($query);
		
		$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Veiculo guinchado pela Guarnicao $idGuarnicao - $vtrTemp, $guarda1 $guarda2 $guarda3 $guarda4 $guarda5 referente a ocorrencia $idOcorrencia')";
			$conexao->executaQuery($queryA);
		
		echo "<script>alert('Cadastro guinchamento realizada com sucesso!');</script>";                       
?>