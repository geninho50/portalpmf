<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
</head>
<link rel="stylesheet" type="text/css" href="estilos.css">
<body>
<?php
require("conecta.php");
require("valida_qq_sessao.php");
require("gerapontoformatado.php");
//echo "01";
//echo $_POST["nomeus"];
//echo $_SESSION["nomeusuario"];
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

$_SESSION['fiscalid']=$fiscalid;
$_SESSION['nome']=$fiscalnome;
$_SESSION['dia1']=$dia1;
$_SESSION['dia2']=$dia2;
$_SESSION['diaf1']=$diaf1;
$_SESSION['diaf2']=$diaf2;

//echo "03";
//exit;
echo "<p align='center'><font face='Verdana' size='2'><a href='gerenciapontoh.php'>Voltar</a></font></p>";
echo "<p align='center'><font face='Verdana' size='2'><a href='listapontoperhrimp.php' target='_blank'>IMPRIMIR</a></font></p>";

$sql = "SELECT nome, funcao, id_ponto, ponto.usuario_id, usuarios.nome, dataref, horaref, date_part('day',dataref) as dia, date_part('month',dataref) as mes,";
$sql = $sql." date_part('year',dataref) as ano, ipref, entsai FROM ponto INNER JOIN usuarios";
$sql = $sql." ON ponto.usuario_id = usuarios.usuario_id WHERE (ponto.usuario_id = $fiscalid or usuarios.nome $filtrofiscalnome)";
$sql = $sql." AND entsai <> '' AND dataref >= $diaf1 AND dataref <= $diaf2";
$sql = $sql." order by ponto.usuario_id, dataref, horaref";
//echo $sql;
//exit;
$resultado=pg_query($sql);

if($resultado != FALSE)
{
	//echo "01";
	//exit;

	$linhas=pg_num_rows($resultado);
	$numhs=0;
	$entsai_ant="";
//	echo "<BR>";
//	echo $linhas;
//	exit;
	for ($i=0; $i<$linhas; $i++)
	{
		if($data_ant != $data)
		{
			$nodias=$nodias+1;
		}
		//$numhs = ($fim - $inicio);
		$fiscalnome=pg_result($resultado,$i,"nome");
		$hri=substr($hora_ant,0,2);
		$mni=substr($hora_ant,3,2);
		$inicio=mktime($hri,$mni,0,$mes_ant,$dia_ant,$ano_ant);
		$dia=pg_result($resultado,$i,"dia");
		$mes=pg_result($resultado,$i,"mes");
		$ano=pg_result($resultado,$i,"ano");		
		$hrf=substr($hora,0,2);
		$mnf=substr($hora,3,2);
		$fim= mktime($hrf,$mnf,0,$mes,$dia,$ano);
		$numhs = ($fim - $inicio) / 3600;
		$entsai=pg_result($resultado,$i,"entsai");

//		echo "02";
//		exit;
		
		if(($entsai_ant == "E") && ($entsai == "E") && ($numhs < 6))
		{
			//ignora registro de ponto
			//$ignora_ant="S";
		}
		elseif(($entsai_ant == "S") && ($entsai == "S") && ($numhs < 6))
		{
			$id_ponto=pg_result($resultado,$i,"id_ponto");
			$data=pg_result($resultado,$i,"dataref");
			$dia=pg_result($resultado,$i,"dia");
			$mes=pg_result($resultado,$i,"mes");
			$ano=pg_result($resultado,$i,"ano");
			$dataf=date("d.M.y",mktime(0,0,0, $mes,$dia,$ano));
			$hora=pg_result($resultado,$i,"horaref");
			$horaf=substr($hora,0,8);
			$entsai=pg_result($resultado,$i,"entsai");
			if($data_ant != "")
			{
			//echo "02";
			//exit;
				geraponto($us_id,$id_ponto_ant,$entsai_ant,$dia_ant,$mes_ant,$ano_ant,$hora_ant,$id_ponto,$entsai,$dia,$mes,$ano,$hora);
			}
			$id_ponto_ant=pg_result($resultado,$i,"id_ponto");
			$data_ant=pg_result($resultado,$i,"dataref");
			$dia_ant=pg_result($resultado,$i,"dia");
			$mes_ant=pg_result($resultado,$i,"mes");
			$ano_ant=pg_result($resultado,$i,"ano");
			$hora_ant=pg_result($resultado,$i,"horaref");
			$entsai_ant=pg_result($resultado,$i,"entsai");
		}
		else
		{
			if($fiscalnome == "")
			{
				$nome=pg_result($resultado,$i,"nome");
				$funcao=pg_result($resultado,$i,"funcao");
			}
			$us_id=pg_result($resultado,$i,"usuario_id");
			$id_ponto=pg_result($resultado,$i,"id_ponto");
			$data=pg_result($resultado,$i,"dataref");
			$dia=pg_result($resultado,$i,"dia");
			$mes=pg_result($resultado,$i,"mes");
			$ano=pg_result($resultado,$i,"ano");
			$dataf=date("d.M.y",mktime(0,0,0, $mes,$dia,$ano));
			$hora=pg_result($resultado,$i,"horaref");
			$horaf=substr($hora,0,8);
			$entsai=pg_result($resultado,$i,"entsai");
			
			//echo $us_id;
			//echo $id_ponto;
			//exit;
			if($data_ant != "")
			{
			//echo $us_id;
			//exit;
			geraponto($us_id,$id_ponto_ant,$entsai_ant,$dia_ant,$mes_ant,$ano_ant,$hora_ant,$id_ponto,$entsai,$dia,$mes,$ano,$hora);
			}
			$id_ponto_ant=pg_result($resultado,$i,"id_ponto");
			$data_ant=pg_result($resultado,$i,"dataref");
			$dia_ant=pg_result($resultado,$i,"dia");
			$mes_ant=pg_result($resultado,$i,"mes");
			$ano_ant=pg_result($resultado,$i,"ano");
			$hora_ant=pg_result($resultado,$i,"horaref");
			$entsai_ant=pg_result($resultado,$i,"entsai");	
		}
	}
	if($linhas == 0)
	{ echo " <p align='center'><font face='verdana' size='2' color='#FF0000'>Nenhum registro encontrado.</p></font>"; 
	}
	//exit;
	//	echo "<p align='center'><font face='Verdana' size='2'><a href='gerenciaponto.php'>Voltar</a></font></p>";
}
else
{
	echo pg_error();
}

$sql = "SELECT nome, funcao, dataent, horaent, date_part('day',dataent) as diaent, date_part('month',dataent) as mesent,";
$sql = $sql." date_part('year',dataent) as anoent, ocent,";
$sql = $sql." datasai, horasai, date_part('day',datasai) as diasai, date_part('month',datasai) as messai,";
$sql = $sql." date_part('year',datasai) as anosai, ocsai, totalhs";
$sql = $sql." FROM ponto_formatado INNER JOIN usuarios";
$sql = $sql." ON ponto_formatado.usuario = usuarios.usuario_id WHERE (usuarios.usuario_id = $fiscalid or usuarios.nome $filtrofiscalnome)";
$sql = $sql." AND dataent >= $diaf1 AND dataent <= $diaf2";
$sql = $sql." order by dataent, horaent";
//echo $sql;
//exit;
$resultado=pg_query($sql);

if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	if($fiscalnome != "")
	{
		$funcao=pg_result($resultado,$i,"funcao");
		echo " <p align='center'> <font face='verdana' size='5'>".utf8_encode($fiscalnome)."</p></font>";
		echo " <p align='center'> <font face='verdana' size='5'>".utf8_encode($funcao)."</p></font>";
		echo " <p align='center'> <font face='verdana' size='5'>$dia1 a $dia2</p></font>";
	}
	

	
	
//	echo "<table align='center' width='400' border=4 bordercolor='#9ACD32'>";
//	echo "<tr><td width='200'> Entrada </td><td width='200'> Saída </td></tr>";
//	echo "</table>";

	echo "<table align='center' border=4 bordercolor='#9ACD32'>";
	echo "<tr>";
	if($fiscalnome == "")
	{
		echo "<td align='center'><font face='verdana' size='2'><b>Nome </b></font></td>";
		echo "<td align='center'><font face='verdana' size='2'><b>Função</b></font></td>";
	}
	
	echo "<table align='center' width='450' border=4 bordercolor='#9ACD32'>";
	echo "<tr>";
	echo "<td width='200' align='center'><a class='tab'>Entrada</td>";
	echo "<td width='200' align='center'><a class='tab'>Saida</td>";
	echo "<td width='50'></td></a></tr>";
	echo "</table>";
	echo "<table align='center' width='450' border=4 bordercolor='#9ACD32'>";
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
		if($fiscalnome == "")
		{
			$nome=pg_result($resultado,$i,"nome");
			$funcao=pg_result($resultado,$i,"funcao");
		}
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
		$mudacor='S';
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
			echo "<td align='center'><font face='verdana' size='1'>".$nome."</font></td>";
			echo "<td align='center'><font face='verdana' size='1'>".$funcao."</font></td>";
		}
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
//	echo "<p align='center'><font face='Verdana' size='2'><a href='pontolistames.php'>Controle de Frequencia</a></font></p>";
	echo "<p align='center'><font face='Verdana' size='2'><a href='gerenciapontoh.php'>Voltar</a></font></p>";
}
?>
</body>
</html>