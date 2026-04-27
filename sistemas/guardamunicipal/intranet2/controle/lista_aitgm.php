<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
	
	$matricula = $_GET['xmatricula'];
	$datainicial = $_GET['xdatainicial'];
	$datafinal = $_GET['xdatafinal'];
	
	$arrayI = explode("-", $datainicial);
	$diai = $arrayI[2];
	$mesi = $arrayI[1];
	$anoi = $arrayI[0];
	
	$arrayF = explode("-", $datafinal);
	$diaf = $arrayF[2];
	$mesf = $arrayF[1];
	$anof = $arrayF[0];

	?>
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>
</head>

<body>
<fieldset>
	<legend class="negrito">AIT entregues  entre <? echo $diai.'-'.$mesi.'-'.$anoi.' a '.$diaf.'-'.$mesf.'-'.$anof;?>.</legend>
    
<!-- //quantidade de ocorrencias no geral -->


<table  width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#36648B" style="border-collapse:collapse">
	<tr>
		<td width="56%" align="left" class="branco"><B>Nome do Guarda</B></td>		
		<td width="44%" align="center" class="branco"><B>AIT:</B></td>
	</tr> 
</table>

<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
<?php
	$query = "select * from receber_auto where data_cadastro between '$datainicial' and '$datafinal' AND matricula=$matricula order by numblocoinicial desc";
	$resultado = $obj->executaQuery($query);
	while ( $linhaQ = mysql_fetch_array($resultado) )
	{		
		$numblocoinicial = $linhaQ['numblocoinicial'];
		$numblocofinal = $linhaQ['numblocofinal'];
		
		$sqlM = "SELECT * FROM guarda_gmf where matricula=$matricula";
		$resultadoM = $obj->executaQuery($sqlM);
		$linhaM = mysql_fetch_array($resultadoM);
		if( $linhaM )
		{
			$loginM = $linhaM["login"];
		}
		
?>
	<tr>
		<td width="56%" align="left" class="negrito"><? echo $loginM.' - '.$matricula;?></td>		
		<td width="44%" align="center" class="negrito"><? echo $numblocoinicial.' - '.$numblocofinal; ?></td>
	</tr>
<?php
	}
?>
</table>

</fieldset>


</body>
</html>