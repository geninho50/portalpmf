 <html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
</head>

<body>
<?php
require("conecta.php");
require("valida_qq_sessao.php");
require("gerapontoformatado.php");
//echo "01";
//exit;
session_start();


//echo "02";
//exit;
$fiscalid = $_SESSION['fiscalid'];
$fiscalnome = $_SESSION['nome'];
$dia1 =$_SESSION['dia1'] ;
$dia2 =$_SESSION['dia2'];
$diaf1=$_SESSION['diaf1'];
$diaf2=$_SESSION['diaf2'];

//echo "03";
//exit;

$sql = "SELECT nome, funcao, dataent, horaent, date_part('day',dataent) as diaent, date_part('month',dataent) as mesent,";
$sql = $sql." date_part('year',dataent) as anoent, ocent,";
$sql = $sql." datasai, horasai, date_part('day',datasai) as diasai, date_part('month',datasai) as messai,";
$sql = $sql." date_part('year',datasai) as anosai, ocsai, totalhs";
$sql = $sql." FROM ponto_formatado INNER JOIN usuarios";
$sql = $sql." ON ponto_formatado.usuario = usuarios.usuario_id WHERE (usuarios.usuario_id = $fiscalid or usuarios.nome = '$fiscalnome')";
$sql = $sql." AND dataent >= $diaf1 AND dataent <= $diaf2";
$sql = $sql." order by dataent, horaent";
//echo $sql;
//exit;
$resultado=pg_query($sql);

if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
//	echo $linhas;
//	exit;

	if($fiscalid != "" )
	{
		$funcao=pg_result($resultado,$i,"funcao");
		$fiscalnome=pg_result($resultado,$i,"nome");
		echo "<p align='center'> <font face='verdana' size='5'>".utf8_encode($fiscalnome)."</p></font>";
		echo "<p align='center'> <font face='verdana' size='5'>".utf8_encode($funcao)."</p></font>";
		echo "<p align='center'> <font face='verdana' size='5'>$dia1 a $dia2</p></font>";
	}
	

	
	


	echo "<table align='center' border=4 bordercolor='#000000'>";
	echo "<tr>";
	
	echo "<table align='center' width='450' border=4 bordercolor='#000000'>";
	echo "<tr>";
	echo "<td width='200' align='center'><a class='tab'>Entrada</td>";
	echo "<td width='200' align='center'><a class='tab'>Saida</td>";
	echo "<td width='50'></td></a></tr>";
	echo "</table>";
	echo "<table align='center' width='450' border=4 bordercolor='#000000'>";
	echo "<tr>";
	echo "<td width='80' align='center'><a class='smt'>Data</td>";
	echo "<td width='80' align='center'><a class='smt'>Hora</td>";
	echo "<td width='40' align='center'><a class='smt'>Oc</td>";
	echo "<td width='80' align='center'><a class='smt'>Data</td>";
	echo "<td width='80' align='center'><a class='smt'>Hora</td>";
	echo "<td width='40' align='center'><a class='smt'>Oc</td>";
	echo "<td width='50' align='center'><a class='smt'>Tot.Hs</a>";
	echo "</tr>";

	
//	echo "<td align='center'><font face='verdana' size='2'><b>Data</font></b></td>";
//	echo "<td align='center'><font face='verdana' size='2'><b>Hora</font></b></td>";
//	echo "<td align='center'><font face='verdana' size='2'><b>Ocor.</font></b></td>";
//	echo "<td align='center'><font face='verdana' size='2'><b>Data</font></b></td>";
//	echo "<td align='center'><font face='verdana' size='2'><b>Hora</font></b></td>";
//	echo "<td align='center'><font face='verdana' size='2'><b>Ocor.</font></b></td>";
//	echo "<td align='center'><font face='verdana' size='2'><b>Tot.Hs.</font></b></td>";
//	echo "</tr>";
	$totalhs=0;
	$corfundo="#EAE9DB";
	$data_ultima = "";
	$data_atual = "";
	$nodias=0;
	for ($i=0; $i<$linhas; $i++)
	{
		$data_atual=pg_result($resultado,$i,"dataent");
		$dataent=pg_result($resultado,$i,"dataent");
		$diaent=pg_result($resultado,$i,"diaent");
		$mesent=pg_result($resultado,$i,"mesent");
		$anoent=pg_result($resultado,$i,"anoent");
		$dataentf=date("d.M.y",mktime(0,0,0, $mesent,$diaent,$anoent));
		$horaent=pg_result($resultado,$i,"horaent");
		$horaentf=substr($horaent,0,8);
		$ocent=pg_result($resultado,$i,"ocent");
		$datasai=pg_result($resultado,$i,"datasai");
		$diasai=pg_result($resultado,$i,"diasai");
		$messai=pg_result($resultado,$i,"messai");
		$anosai=pg_result($resultado,$i,"anosai");
		$datasaif=date("d.M.y",mktime(0,0,0, $messai,$diasai,$anosai));
		$horasai=pg_result($resultado,$i,"horasai");
		$horasaif=substr($horasai,0,8);
		$ocsai=pg_result($resultado,$i,"ocsai");
		//$hs=round(pg_result($resultado,$i,"totalhs"),2);
		$hs=pg_result($resultado,$i,"totalhs") + 3;
		$totalhs=$totalhs + round(($hs-3)*3600,0);
		$hs=round($hs*3600,0);
		if($data_ultima != $data_atual)
		{
			$nodias=$nodias+1;
			$data_ultima=$data_atual;
		}			
		//$totalhs=$totalhs + ($hs-3)*3600;
		$hsf=date("H:i",($hs));
//		echo $hs;
//		echo "<br>";
//		echo $hsf;
//		exit;
//		$mn=round(($hs - intval($hs)),2) * 600;
//		$mn=round($mn/10,1)*10;
//		$hsf=strval(intval($hs)).':'.$mn;
		
		echo "<tr >";
		echo "<td width='80' align='center'><font face='verdana' size='1'>$dataentf</font></td>";
		if($ocent != 0)
		{
			echo "<td width='80' align='center'><font face='verdana' size='1'></font></td>";
			echo "<td width='40' align='center'><font face='verdana' color='#FF0000' size='1'>$ocent</font></td>";
		}
		else
		{
			echo "<td width='80' align='center'><font face='verdana' size='1'>$horaentf</font></td>";
			echo "<td width='40' align='center'><font face='verdana' size='1'>$ocent</font></td>";
		}		
		echo "<td width='80' align='center'><font face='verdana' size='1'>$datasaif</font></td>";
		if($ocsai != 0)
		{
			echo "<td width='80' align='center'><font face='verdana' size='1'></font></td>";
			echo "<td width='40' align='center'><font face='verdana' color='#FF0000' size='1'>$ocsai</font></td>";
		}
		else
		{
			echo "<td width='80' align='center'><font face='verdana' size='1'>$horasaif</font></td>";
			echo "<td width='40' align='center'><font face='verdana' size='1'>$ocsai</font></td>";
		}
		echo "<td width='50' align='center'><font face='verdana' size='1'>$hsf</font></td>";
		echo "</tr>";
	}
	echo "</table>";
	//echo $totald;
	$totalhs=$totalhs + (3 * 3600);
	//echo date("d, H:i",($totalhs));
	if((($totalhs / 3600)-3) >= 24)
	{
	//echo date("d, H:i",($totalhs));
		$totald=substr(date("d, H:i",($totalhs)),0,2)-1;
		$totald= $totald * 24 + substr(date("d, H:i",($totalhs)),4,2);
		$totalform=strval($totald).':'.substr(date("d, H:i",($totalhs)),7,2);
	}
	else
	{
		$totald= substr(date("H:i",($totalhs)),0,2);
		$totalform=date("H:i",($totalhs));
	}
	$media=round($totalform/$nodias,1);
	echo "<table align='center' width='450' border=0 bordercolor='#9ACD32'>";
	echo "<tr>";
	echo "<td width='150' align='left'><a class='tab'>Total de Horas:</td>";
	echo "<td width='300' align='left'><a class='tab'>$totalform</td>";
	echo "</tr></table>";
	echo "<table align='center' width='450' border=0 bordercolor='#9ACD32'>";
	echo "<tr>";
	echo "<td width='150' align='left'><a class='tab'>Dias trabalhados:</td>";
	echo "<td width='300' align='left'><a class='tab'>$nodias</td></tr></table>";
	echo "<table align='center' width='450' border=0 bordercolor='#9ACD32'>";
	echo "<tr>";
	echo "<td width='150' align='left'><a class='tab'>M&eacutedia (hs/dia):</td>";
	echo "<td width='300' align='left'><a class='tab'>$media</td></tr></table>";
	if($linhas == 0)
	{ echo " <p align='center'><font face='verdana' size='2' color='#FF0000'>Nenhum registro encontrado.</p></font>"; 
	}
	
}
?>
</body>
</html>