 <html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
</head>
<link rel="stylesheet" type="text/css" href="estilos.css">
<body class='branco'>
<form method="POST" action="listapontper.php">
 <?php
require("conecta.php");
//echo "01";
//exit;
session_start();
//	if(isset($_SESSION['nome']) && !empty($_SESSION['nome']))
	
		$filtrofiscalnome = "='".$_SESSION['nome']."'";
		$fiscalnome = $_SESSION['nome'];
		$fiscalid = $_SESSION['fiscalid'];
	
//	echo $fiscalnome;
//	exit;
	$dia1 = $_SESSION["diaf1"];
	$dia2 = $_SESSION["diaf2"];

	$sql = "SELECT nome, funcao as funcao, dataref, horaref, date_part('day',dataref) as dia, date_part('month',dataref) as mes,";
	$sql = $sql." date_part('year',dataref) as ano, ipref, entsai FROM ponto INNER JOIN usuarios";
	$sql = $sql." ON ponto.usuario_id = usuarios.usuario_id WHERE (usuarios.usuario_id = $fiscalid or usuarios.nome = '$fiscalnome')";
	$sql = $sql." AND entsai <> '' AND dataref >= $dia1 AND dataref <= $dia2";
	$sql = $sql." order by dataref, horaref";
	$resultado=pg_query($sql);
	
	if($resultado != FALSE)
	{

		$linhas=pg_num_rows($resultado);
		if($fiscalnome != "" || $fiscalid != "")
		{
			$fiscalnome=pg_result($resultado,$i,"nome");
			$funcao=pg_result($resultado,$i,"funcao");
			echo " <p align='center'> <font face='verdana' size='5'>".utf8_encode($fiscalnome)."</p></font>";
			echo " <p align='center'> <font face='verdana' size='5'>".utf8_encode($funcao)."</p></font>";
		}
		echo "<table align='center' border=4 bordercolor='#000000'>";
		echo "<tr>";
		if($fiscalnome == "" && $fiscalid == "")
		{
			echo "<td align='center'><font face='verdana' size='2'><b>Nome </b></font></td>";
			echo "<td align='center'><font face='verdana' size='2'><b>Função</b></font></td>";
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
			
			
			if($fiscalnome == "")
			{
				echo "<td align='center'><font face='verdana' size='1'>".$nome."</font></td>";
				echo "<td align='center'><font face='verdana' size='1'>".$funcao."</font></td>";
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
		
		
		
	}
	else
	{
		echo pg_error();
	}

?>
</form>
</body>
</html>