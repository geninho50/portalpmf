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
	
	$loginTemp = $_GET['xlogin'];
	$data = $_GET['xdata'];
	
	$arrayI = explode("-", $data);
	$diai = $arrayI[2];
	$mesi = $arrayI[1];
	$anoi = $arrayI[0];
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
	<legend class="cabecalho">AIT ENTREGUES NO DIA <? echo $diai.'-'.$mesi.'-'.$anoi;?>.</legend>
    
<!-- //quantidade de ocorrencias no geral -->


<table  width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#36648B" style="border-collapse:collapse">
	<tr>
		<td width="40%" align="left" class="branco"><B>Nome do Guarda</B></td>		
		<td width="25%" align="center" class="branco"><B>AIT:</B></td>
        <td width="35%" align="center" class="branco"><B>Data/Hora:</B></td>
	</tr> 
</table>

<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
<?php
	$query = "select * from receber_auto where data_cadastro='$data' AND login='$loginTemp' order by numblocoinicial desc";
	$resultado = $obj->executaQuery($query);
	while ( $linhaQ = mysql_fetch_array($resultado) )
	{		
		$numblocoinicial = $linhaQ['numblocoinicial'];
		$numblocofinal = $linhaQ['numblocofinal'];
		$data_entrega = $linhaQ['data_cadastro'];
		$hora_entrega = $linhaQ['hora_cadastro'];
?>
	<tr>
		<td width="40%" align="left" class="negrito"><? echo $loginTemp;?></td>		
		<td width="25%" align="center" class="negrito"><? echo $numblocoinicial; ?></td>
        <td width="35%" align="center" class="negrito"><? echo $data_entrega.' - '.$hora_entrega; ?></td>
	</tr>
<?php
	}
?>
</table>

</fieldset>


</body>
</html>