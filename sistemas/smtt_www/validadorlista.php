<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<link rel="stylesheet" type="text/css" href="estilos.css">
<?php
	include "conecta.php";
	require("valida_qq_sessao.php");
	$op=$_GET["op"];
	$filtro=$_POST["filtro"];
	session_start();
	if ($op == 'a')
	{
		$_SESSION['filtro']='';
	}
	if ($op == 'v')
	{
		$sqlwhere=$_SESSION['sqlwhere'];
	}

	$filtrodata1=$_POST["data1"];
	$_SESSION['data1']=$_POST["data1"];
	$dia=substr($filtrodata1,0,2);
	$mes=substr($filtrodata1,3,2);
	$ano=substr($filtrodata1,6,4);
	$filtrodata1=$ano.$mes.$dia;
	$filtrodata2=$_POST["data2"];
	$_SESSION['data2']=$_POST["data2"];
	$dia=substr($filtrodata2,0,2);
	$mes=substr($filtrodata2,3,2);
	$ano=substr($filtrodata2,6,4);
	$filtrodata2=$ano.$mes.$dia.'9999';
	$filtrohora1=$_POST["hora1"];
	$_SESSION['hora1']=$_POST["hora1"];
	$filtrohora2=$_POST["hora2"];
	$_SESSION['hora2']=$_POST["hora2"];
	$filtrolinha=$_POST["linha"];
	$_SESSION['linha']=$_POST["linha"];
	$sqlwhere="";
	if ($filtrodata1 != '')
	{
		$sqlwhere=$sqlwhere." dataini>=".$filtrodata1;
	}
	if ($filtrodata2 != '')
	{
		if ($sqlwhere != "")
		{
			$sqlwhere=$sqlwhere.' and ';
		}
		$sqlwhere=$sqlwhere." dataini<=".$filtrodata2;
	}
	if ($filtrohora1 != '')
	{
		if ($sqlwhere != "")
		{
			$sqlwhere=$sqlwhere.' and ';
		}
		$sqlwhere=$sqlwhere." horaini>='".$filtrohora1."'";
	}
	if ($filtrohora2 != '')
	{
		if ($sqlwhere != "")
		{
			$sqlwhere=$sqlwhere.' and ';
		}
		$sqlwhere=$sqlwhere." horaini<='".$filtrohora2."'";
	}
	if ($filtrolinha != '')
	{
		if ($sqlwhere != "")
		{
			$sqlwhere=$sqlwhere.' and ';
		}
		$sqlwhere=$sqlwhere." linha='".trim($filtrolinha)."'";
	}
	$_SESSION['sqlwhere']=$sqlwhere;

	echo "<table align='center' border=0>";
	echo "<tr>";
	echo "<td><align='center'><a class='sma' href='javascript:window.history.go(-1)'>Voltar </a></td>";
	echo "</tr>";
	$sql = "SELECT * FROM validador WHERE $sqlwhere ORDER BY dataini, horaini";
	$_SESSION['sqlwhereimp']=$sqlwhere;
	$resultado=pg_query($sql);
	if($resultado != FALSE)
	{
		$linhas=pg_num_rows($resultado);
		echo "<table width='600' align='center' border=4 bordercolor='#9ACD32'>";
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
		echo "<td width='200' align='center'><font face='verdana' size='1'><b>Data</b></font></td>";
		echo "<td width='200' align='center'><font face='verdana' size='1'><b>".utf8_encode('Início'). "</b></font></td>";
		echo "<td width='200' align='center'><font face='verdana' size='1'><b>Fim</b></font></td>";
		echo "<td width='200' align='center'><font face='verdana' size='1'><b>".utf8_encode('Duração'). "</b></font></td>";
		echo "<td width='200' align='center'><font face='verdana' size='1'><b>Sentido </b></font></td>";
		echo "<td width='200' align='center'><font face='verdana' size='1'><b>Linha </b></font></td>";
		echo "<td width='200' align='center'><font face='verdana' size='1'><b>".utf8_encode('Veículo'). "</b></font></td>";
		echo "<td width='200' align='center'><font face='verdana' size='1'><b>Giros</b></font></td>";
		echo "</tr>";
		for ($i=0; $i<$linhas; $i++)
		{
			$data=pg_result($resultado,$i,"dataini");
			$dia=substr($data,8,2);
			$mes=substr($data,5,2);
			$ano=substr($data,0,4);
			$dataini=$dia.'/'.$mes.'/'.$ano;
			$hora=pg_result($resultado,$i,"horaini");
			$horaini=substr($hora,0,5);
			$hora=pg_result($resultado,$i,"horafim");
			$horafim=substr($hora,0,5);
			$duracao=pg_result($resultado,$i,"duracao");
			$sentido=pg_result($resultado,$i,"sentido");
			$linha=pg_result($resultado,$i,"linha");
			$veiculo=pg_result($resultado,$i,"veiculo");
			$giros=pg_result($resultado,$i,"totalgiros");
			if($corfundo == "#EAE9DB")
			{
				$corfundo="#FFFFFF";
			}
			else
			{
				$corfundo="#EAE9DB";
			}
			echo "<tr bgcolor=$corfundo>";
			echo "<td align='center'><font face='verdana' size='1'>$dataini</td>";
			echo "<td align='center'><font face='verdana' size='1'>$horaini </td>";
			echo "<td align='center'><font face='verdana' size='1'>$horafim </td>";
			echo "<td align='center'><font face='verdana' size='1'>$duracao </td>";
			echo "<td align='center'><font face='verdana' size='1'>$sentido </td>";
			echo "<td align='center'><font face='verdana' size='1'>$linha </td>";
			echo "<td align='center'><font face='verdana' size='1'>$veiculo </td>";
			echo "<td align='center'><font face='verdana' size='1'>$giros </td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	echo "<table align='center' border=0";
	echo "<tr>";
	echo "<td align='center'><a class='sma' href='javascript:window.history.go(-1)'>Voltar</a></td>";
	//echo "<td align='center'><font face='verdana' size='1'><a href='comunicalistaimp.php' target='_blank'>Imprimir </a></td>";
	echo "</tr>";
?>
<tr>
<td align='center'><a class='sma' href="logout.php">Sair</a></td>
</tr>
</table>
</body>
</html>