<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
</head>
<link rel="stylesheet" type="text/css" href="estilos.css">
<form method="POST" action="fiscalnovo.php">
<?php
require("conecta.php");
require("valida_qq_sessao.php");
if((empty($_POST["nome"])) && (empty($_POST["dia"])))
{
header("Location: fiscalnovo.php?campo=nf");                           
}
else
{
//	if(isset($_SESSION['nome']) && !empty($_SESSION['nome']))
	if(isset($_POST["nome"]) && !empty($_POST["nome"]))
	{
		$fiscalid = $_POST["nome"];
		$fiscalnome = "*";
	}
	else
	{
		session_start();
		if ($_SESSION['admin']=="Z")
		{
			$fiscalnome = $_SESSION['nomeusuario'];
		}
		else
		{
			$fiscalnome = "";
		}
	}
	if($fiscalnome == "")
	{
		$filtrofiscalnome = "usuarios.nome like '%%'";
	}
	else
	{
		if(empty($fiscalid))
		{
			$filtrofiscalnome = "usuarios.nome='".$fiscalnome."'";
		}
		else
		{
			$filtrofiscalnome = "usuarios.usuario_id=".$fiscalid;
		}
	}
//	echo $fiscalnome;
//	exit;
	$dia = $_POST["dia"];
	if($dia == "")
	{
		$dia = ">=1";
	}
	else
	{
		$dia = "='".$dia."'";
	}	
//	echo $dia;
//	exit;
	$mesnum = $_POST["mesnum"];
	$ano = $_POST["ano"];
	
	echo "<p align='center'><font face='Verdana' size='2'><a href='fiscalnovo.php'>Voltar</a></font></p>";
	
	$sql = "SELECT nome, funcao as funcao, dataref, horaref, date_part('day',dataref) as dia, date_part('month',dataref) as mes,";
	$sql = $sql." date_part('year',dataref) as ano, ipref, entsai FROM ponto INNER JOIN usuarios";
	$sql = $sql." ON ponto.usuario_id = usuarios.usuario_id WHERE $filtrofiscalnome";
	$sql = $sql." AND entsai <> '' AND date_part('day',dataref) $dia ";
	$sql = $sql." AND date_part('year',dataref)=$ano AND date_part('month',dataref)=$mesnum order by dataref, horaref";
	$resultado=pg_query($sql);
	
	if($resultado != FALSE)
	{

		$linhas=pg_num_rows($resultado);
		if($fiscalnome != "")
		{
			$fiscalnome=utf8_encode(pg_result($resultado,$i,"nome"));
			$funcao=pg_result($resultado,$i,"funcao");
			echo " <p align='center'> <font face='verdana' size='5'>$fiscalnome</p></font>";
			echo " <p align='center'> <font face='verdana' size='5'>".utf8_encode($funcao)."</p></font>";
		}
		echo "<table align='center' border=4 bordercolor='#9ACD32'>";
		echo "<tr>";
		if($fiscalnome == "")
		{
			echo "<td align='center'><font face='verdana' size='2'><b>Nome </b></font></td>";
			echo "<td align='center'><font face='verdana' size='2'><b>Fun&ccedil&atildeo</b></font></td>";
		}
		echo "<td align='center'><font face='verdana' size='2'><b>Data</font></b></td>";
		echo "<td align='center'><font face='verdana' size='2'><b>Hora</font></b></td>";
		echo "<td align='center'><font face='verdana' size='2'><b>Local</font></b></td>";
		echo "<td align='center'><font face='verdana' size='2'><b>E/S</font> </b></td>";
		echo "</tr>";
		$corfundo="#EAE9DB";
		for ($i=0; $i<$linhas; $i++)
		{
			if($fiscalnome == "")
			{
				$nome=pg_result($resultado,$i,"nome");
				$funcao=pg_result($resultado,$i,"funcao");
			}
			$data=pg_result($resultado,$i,"dataref");
			$dia=pg_result($resultado,$i,"dia");
			$mes=pg_result($resultado,$i,"mes");
			$ano=pg_result($resultado,$i,"ano");
			$dataf=date("d.M.y",mktime(0,0,0, $mes,$dia,$ano));
			$hora=pg_result($resultado,$i,"horaref");
			$horaf=substr($hora,0,8);
//			$hora=pg_result($resultado,$i,"horaref");
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
			if($fiscalnome == "")
			{
				echo "<td align='center'><font face='verdana' size='1'>".utf8_encode($nome)."</font></td>";
				echo "<td align='center'><font face='verdana' size='1'>".utf8_encode($funcao)."</font></td>";
			}
			echo "<td align='center'><font face='verdana' size='1'>$dataf</font></td>";
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
		echo "<p align='center'><font face='Verdana' size='2'><a href='fiscalnovo.php'>Voltar</a></font></p>";
	}
	else
	{
		echo pg_error();
	}
}
?>
</form>
</body>
</html>