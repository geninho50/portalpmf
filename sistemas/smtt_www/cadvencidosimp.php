<?php

require("conecta.php");
//$servico = "%%";
//$serv = $_GET['serv'];
session_start();
$serv = $_SESSION['serv'];
$servico = "%".$_SESSION['servico']."%";
//echo $serv;
//exit;

//$sql = "SELECT nomeservico, placa, noordem, vencimentoselo, vencimentolicenca FROM vencimentos WHERE nomeservico = '$servico'";
$sql = "select * from vencimentos where nomeservico like '$servico' and (vencimentoselo < current_date or vencimentolicenca < current_date)";
$sql = $sql." order by nomeservico, noordem";
$resultado=pg_query($sql);
if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	
	echo "<font face='verdana' size='3'>";
	echo "<p align='center'>VENCIDOS</p></a>";
	echo "<p align='center'>".date('d.M.y')."</a></p></font>";
	echo "<table align='center' border=4 bordercolor='#000000'>";
	echo "<tr bgcolor=$corfundo>";

	echo "<td align='center'><font face='verdana' size='1'><b>Servi&ccedilo </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>N&ordm Ordem </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Placa </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Venc. Selo </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Venc. Licen&ccedila </b></font></td>";
	if(($serv=="ESCOLAR") || ($serv=="TAXI") || (empty($serv)))
	{
		echo "<td align='center'><font face='verdana' size='1'><b>Local de Atua&ccedil&atildeo</b></td>";
	}	
	echo "</tr>";
	for ($i=0; $i<$linhas; $i++)
	{
		$nomeservico=pg_result($resultado,$i,"nomeservico");
		$placa=pg_result($resultado,$i,"placa");
		$noordem=pg_result($resultado,$i,"noordem");
		$vencimentoselo=pg_result($resultado,$i,"vencimentoselo");
		$vencselo=substr($vencimentoselo,8,2).'/'.substr($vencimentoselo,5,2).'/'.substr($vencimentoselo,0,4);
		$vencimentolicenca=pg_result($resultado,$i,"vencimentolicenca");
		$venclicenca=substr($vencimentolicenca,8,2).'/'.substr($vencimentolicenca,5,2).'/'.substr($vencimentolicenca,0,4);
		$local=strtoupper(pg_result($resultado,$i,"local"));
		
		echo "<tr bgcolor=$corfundo>";
		echo "<td align='center'><font face='verdana' size='1'>$nomeservico </td>";
		echo "<td align='center'><font face='verdana' size='1'>$noordem </td>";
		echo "<td align='center'><font face='verdana' size='1'>$placa </td>";
		echo "<td align='center'><font face='verdana' size='1'>$vencselo </td>";
		echo "<td align='center'><font face='verdana' size='1'>$venclicenca </td>";
		if(($serv=="ESCOLAR") || ($serv=="TAXI") || (empty($serv)))
		{
			echo "<td align='center'><font face='verdana' size='1'>".utf8_encode($local)."</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}
else
{
	echo pg_error();
}
?>