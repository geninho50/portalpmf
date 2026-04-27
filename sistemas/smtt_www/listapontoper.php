<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
</head>
<link rel="stylesheet" type="text/css" href="estilos.css">
<body>
<form method="POST" action="fiscalnovo.php">
<?php
require("conecta.php");
require("data_funcoes.php");
//echo "01";
//exit;
session_start();
if(empty($_POST["nomeus"]) && empty($_SESSION["nomeusuario"]))
{
	header("Location: gerenciaponto.php?campo=nf");
	exit;
}
else if(!empty($_POST["nomeus"]))
{
	$fiscalid = $_POST["nomeus"];
//echo $fiscalid;
//exit;
}
else
{
	$fiscalnome = $_SESSION["nomeusuario"];
	$fiscalid = 0;
}
if((empty($_POST["dia1"])) || (empty($_POST["dia2"])))
{
	header("Location: gerenciaponto.php?campo=per");                           
}
$filtrofiscalnome = "='".$fiscalnome."'";
$dia1 = $_POST["dia1"];
$dia2 = $_POST["dia2"];
$diaf1= "'".substr($dia1,6,4)."-".substr($dia1,3,2)."-".substr($dia1,0,2)."'";
$diaf2= "'".substr($dia2,6,4)."-".substr($dia2,3,2)."-".substr($dia2,0,2)."'";

$_SESSION['nome']=$fiscalnome;
$_SESSION['dia1']=$dia1;
$_SESSION['dia2']=$dia2;
$_SESSION['diaf1']=$diaf1;
$_SESSION['diaf2']=$diaf2;

echo "<p align='center'><font face='Verdana' size='2'><a href='gerenciaponto.php'>Voltar</a></font></p>";
echo "<p align='center'><font face='Verdana' size='2'><a href='listapontoperimp.php' target='_blank'>IMPRIMIR</a></font></p>";

$sql = "SELECT nome, funcao as funcao, dataref, horaref, date_part('day',dataref) as dia, date_part('month',dataref) as mes,";
$sql = $sql." date_part('year',dataref) as ano, ipref, entsai FROM ponto INNER JOIN usuarios";
$sql = $sql." ON ponto.usuario_id = usuarios.usuario_id WHERE (ponto.usuario_id = $fiscalid or usuarios.nome $filtrofiscalnome)";
$sql = $sql." AND entsai <> '' AND dataref >= $diaf1 AND dataref <= $diaf2";
$sql = $sql." order by dataref, horaref";
$resultado=pg_query($sql);

//echo $fiscalid;
//echo $fiscalnome;
//exit;

if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	if($fiscalnome != "" || $fiscalid != "" )
	{
		$nome=pg_result($resultado,$i,"nome");
		$funcao=pg_result($resultado,$i,"funcao");
		echo " <p align='center'> <font face='verdana' size='5'>".utf8_encode($nome)."</p></font>";
		echo " <p align='center'> <font face='verdana' size='5'>".utf8_encode($funcao)."</p></font>";
	}
	echo "<table align='center' border=4 bordercolor='#9ACD32'>";
	echo "<tr>";
	if($fiscalnome == "" && $fiscalid == "")
	{
		echo "<td align='center'><font face='verdana' size='2'><b>Nome </b></font></td>";
		echo "<td align='center'><font face='verdana' size='2'><b>Função</b></font></td>";
	}
	echo "<td align='center'><font face='verdana' size='2'><b>Data</font></b></td>";
//	echo "<td align='center'><font face='verdana' size='2'><b>Dia da Sem.</font></b></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Hora</font></b></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Local</font></b></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>E/S</font> </b></td>";
	echo "</tr>";
	$corfundo="#EAE9DB";
	for ($i=0; $i<$linhas; $i++)
	{
		if($fiscalnome == "" && $fiscalid == "")
		{
			$nome=pg_result($resultado,$i,"nome");
			$funcao=pg_result($resultado,$i,"funcao");
		}
		$data=pg_result($resultado,$i,"dataref");
		$dia=pg_result($resultado,$i,"dia");
		$mes=pg_result($resultado,$i,"mes");
		$ano=pg_result($resultado,$i,"ano");
		$dataf=date("d.M.y",mktime(0,0,0, $mes,$dia,$ano));
		$nds=date("N",mktime(0,0,0, $mes,$dia,$ano));
		$dsem=dia_da_semana($nds);
		$hora=pg_result($resultado,$i,"horaref");
		$horaf=substr($hora,0,8);
		$ip=pg_result($resultado,$i,"ipref");
		$sql = "SELECT * from ip_local where num_ip = '$ip'";
		$resip=pg_query($sql);
		$mudacor='S';
		if($resip != FALSE)
		{
			$linhasip=pg_num_rows($resip);
			if ($linhasip == 1)
			{
				$ip_reg = pg_result($resip,0,"nome_local");
				if(!empty($ip_reg))
				{
					$ip=$ip_reg;
					$mudacor='N';
				}
			}
		}
		$entradasaida=pg_result($resultado,$i,"entsai");
		
		if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		echo "<tr bgcolor=$corfundo>";
		if($fiscalnome == "" && $fiscalid == "")
		{
			echo "<td align='center'><font face='verdana' size='1'>".$nome."</font></td>";
			echo "<td align='center'><font face='verdana' size='1'>".$funcao."</font></td>";
		}
		echo "<td align='center'><font face='verdana' size='1'>$dataf</font></td>";
//		echo "<td align='center'><font face='verdana' size='1'>$dsem</font></td>";
		echo "<td align='center'><font face='verdana' size='1'>$horaf</font></td>";
		if($mudacor == 'S')
		{
			echo "<td align='center'><font face='verdana' size='1' color='#FF0000'>$ip</font></td>";
		}
		else
		{
			echo "<td align='center'><font face='verdana' size='1'>$ip</font></td>";
		}
		echo "<td align='center'><font face='verdana' size='1'>$entradasaida </font></td>";
		
		echo "</tr>";
	}
	echo "</table>";
	if($linhas == 0)
	{ echo " <p align='center'><font face='verdana' size='2' color='#FF0000'>Nenhum registro encontrado.</p></font>"; 
	}
	echo "<p align='center'><font face='Verdana' size='2'><a href='gerenciaponto.php'>Voltar</a></font></p>";
}
else
{
	echo pg_error();
}
?>
</form>
</body>
</html>