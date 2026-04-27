<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link rel="stylesheet" type="text/css" href="estilos.css">
<?php
require("conecta.php");
if(isset($_POST["idponto"]))
{
	$id_ponto = $_POST["idponto"];
}

if($id_ponto == null)
{
	$id_ponto = 0;
	$nomeponto='Favor escolher um ponto';
}
else
{
	$sql = "select nomeponto from pontostaxi where id_ponto = '$id_ponto'";
	$resultado=pg_query($sql);
	$linhas=pg_num_rows($resultado);
	if($linhas ==1)
	{
		$nomeponto=pg_result($resultado,$i,"nomeponto");
	}
}

$sql = "select noordem, permissionario from vencimentos where pontotaxi = '$id_ponto' order by noordem";
$resultado=pg_query($sql);
if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	//echo $linhas;
	echo "<p align='center'><font face='Verdana' size='2'><a href='taxipontopesquisa.php'>Voltar</a></font></p>";
	echo "<a class='tit'><p align='center'>Ponto: ".utf8_encode($nomeponto)."</p></a>";
	echo "<table align='center' border=4 bordercolor='#9ACD32'>";
	if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
	echo "<tr bgcolor=$corfundo>";
	echo "<td align='center'><font face='verdana' size='1'><b>N&ordm Ordem </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Permission&aacuterio </b></font></td>";
	echo "</tr>";
	for ($i=0; $i<$linhas; $i++)
	{
		$noordem=pg_result($resultado,$i,"noordem");
		$permissionario=pg_result($resultado,$i,"permissionario");
				
		if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		echo "<tr bgcolor=$corfundo>";
		echo "<td align='center'><font face='verdana' size='1'>$noordem </td>";
		echo "<td align='center'><font face='verdana' size='1'>".utf8_encode($permissionario)."</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<p align='center'><font face='Verdana' size='2'><a href='taxipontopesquisa.php'>Voltar</a></font></p>";
}
else
{
	echo pg_error();
}
?>
</html>
