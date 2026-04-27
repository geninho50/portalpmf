<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link rel="stylesheet" type="text/css" href="estilos.css">
<body>
<?php
	include "conecta.php";
	require("valida_qq_sessao.php");
	session_start();
	$sqlwhere=$_SESSION['sqlwhereimp'];
//	echo $sqlwhere;
//	exit;
	echo "<table width='400' align='center' border=0>";
	$sql = "SELECT * FROM comunica WHERE $sqlwhere ORDER BY id DESC";
	$resultado=pg_query($sql);
	if($resultado != FALSE)
	{
		$linhas=pg_num_rows($resultado);	
		echo "<table width='400' align='center' border=4 bordercolor='#9ACD32'>";
		$corfundo="#FFFFFF";
		if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		echo "<tr bgcolor=$corfundo>";
		echo "<td align='center'><font face='verdana' size='1'><b>".utf8_encode('Nº'). "</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>Data e Hora </b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>".utf8_encode('Serviço'). "</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>Placa </b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>".utf8_encode('Nº Ordem'). "</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>".utf8_encode('Permissionário'). "</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>Fiscal </b></font></td>";
		echo "<td width='400' align='center'><font face='verdana' size='1'><b>".utf8_encode('****Comunicação****'). "</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>Prazo</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>Terminal</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>".utf8_encode('Situação'). "</b></font></td>";
		echo "</tr>";
		for ($i=0; $i<$linhas; $i++)
		{
			$id=pg_result($resultado,$i,"id");
			$numero=pg_result($resultado,$i,"numero");
			$data=pg_result($resultado,$i,"datacom");
			$hora=pg_result($resultado,$i,"hora");
			$hora=substr($hora,0,8);
			$dia=substr($data,8,2);
			$mes=substr($data,5,2);
			$ano=substr($data,0,4);
			$dataformatada=$dia.'/'.$mes.'/'.$ano.' '.$hora;
			$servico=pg_result($resultado,$i,"servico");
			$placa=pg_result($resultado,$i,"placa");
			$numordem=pg_result($resultado,$i,"numordem");
			$permissionario=pg_result($resultado,$i,"permissionario");
			$fiscal=pg_result($resultado,$i,"fiscal");
			$comunicado=pg_result($resultado,$i,"comunicado");
			$prazo=pg_result($resultado,$i,"prazo");
			$terminal=pg_result($resultado,$i,"terminal");
			$status=pg_result($resultado,$i,"status");
			$encerrada_por=pg_result($resultado,$i,"encerrada_por");
			if($corfundo == "#EAE9DB")
			{
				$corfundo="#FFFFFF";
			}
			else
			{
				$corfundo="#EAE9DB";
			}
			echo "<tr bgcolor=$corfundo>";
			echo "<td align='center'><font face='verdana' size='1'>$numero</td>";
			echo "<td align='center'><font face='verdana' size='1'>$dataformatada</td>";
			echo "<td align='center'><font face='verdana' size='1'>$servico </td>";
			echo "<td align='center'><font face='verdana' size='1'>$placa </td>";
			echo "<td align='center'><font face='verdana' size='1'>$numordem </td>";
			echo "<td align='center'><a class='sma'>$permissionario </td>";
			echo "<td align='center'><a class='sma'>$fiscal </td>";
			echo "<td align='center'><a class='sma'>$comunicado </a></td>";
			echo "<td align='center'><font face='verdana' size='1'>$prazo </td>";
			echo "<td align='center'><font face='verdana' size='1'>$terminal </td>";
			if ($status == 'Encerrada')
			{
				echo "<td align='center'><font face='verdana' size='1'>$status $encerrada_por </span></td>";
			}
			else
			{
				echo "<td align='center'><font face='verdana' size='1'>$status </td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
?>
</body>
</html>