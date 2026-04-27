<?php
function geraponto($us_id,$id_ponto_ant,$entsai_ant,$dia_ant,$mes_ant,$ano_ant,$hora_ant,$id_ponto,$entsai,$dia,$mes,$ano,$hora)
{
	$hri=substr($hora_ant,0,2);
	$mni=substr($hora_ant,3,2);
	$inicio=mktime($hri,$mni,0,$mes_ant,$dia_ant,$ano_ant);
	$hrf=substr($hora,0,2);
	$mnf=substr($hora,3,2);
	$fim= mktime($hrf,$mnf,0,$mes,$dia,$ano);
	$numhs = ($fim - $inicio) / 3600;
	//$numhs = ($fim - $inicio);
	if(($entsai_ant == "E") && ($entsai == "S"))
	{
		if($numhs < 14)
		{
			$ocent=0;
			$ocsai=0;
			insereregponto($us_id,$id_ponto_ant,$dia_ant,$mes_ant,$ano_ant,$hora_ant,$ocent,$id_ponto,$dia,$mes,$ano,$hora,$ocsai,$numhs);
		}
		else
		{
			$ocent=0;
			$ocsai=9;
			insereregponto($us_id,$id_ponto_ant,$dia_ant,$mes_ant,$ano_ant,$hora_ant,$ocent,0,$dia_ant,$mes_ant,$ano_ant,$hora_ant,$ocsai,0);
			$ocent=9;
			$ocsai=0;
			insereregponto($us_id,0,$dia,$mes,$ano,$hora,$ocent,$id_ponto,$dia,$mes,$ano,$hora,$ocsai,0);
		}
	}
	if(($entsai_ant == "E") && ($entsai == "E"))
	{
		if($numhs < 6)
		{
			// ja tratado
		}
		else
		{
			$ocent=0;
			$ocsai=9;
			insereregponto($us_id,$id_ponto_ant,$dia_ant,$mes_ant,$ano_ant,$hora_ant,$ocent,0,$dia_ant,$mes_ant,$ano_ant,$hora_ant,$ocsai,0);
		}
	}
	if(($entsai_ant == "S") && ($entsai == "S"))
	{
		if($numhs < 6)
		{
			$ocent=0;
			$ocsai=0;
			alteraregpontosaida($us_id,$id_ponto_ant,$dia_ant,$mes_ant,$ano_ant,$hora_ant,$ocent,$id_ponto,$dia,$mes,$ano,$hora,$ocsai,$numhs);
		}
		else
		{
			$ocent=9;
			$ocsai=0;
			insereregponto($us_id,0,$dia,$mes,$ano,$hora,$ocent,$id_ponto,$dia,$mes,$ano,$hora,$ocsai,0);
		}
	}
}
function insereregponto($us_id,$id_ponto_ant,$dia_ant,$mes_ant,$ano_ant,$hora_ant,$ocent,$id_ponto,$dia,$mes,$ano,$hora,$ocsai,$numhs)
{
	$dataf_ant= "'".$ano_ant."-".$mes_ant."-".$dia_ant."'";
	$dataf= "'".$ano."-".$mes."-".$dia."'";
	$sql="INSERT INTO ponto_formatado (usuario,id_pontoent, dataent, horaent, ocent,id_pontosai, datasai, horasai, ocsai, totalhs) ";
	$sql=$sql."VALUES ('$us_id','$id_ponto_ant',$dataf_ant,'$hora_ant','$ocent','$id_ponto',$dataf,'$hora','$ocsai',$numhs)";
	$resultado=pg_query($sql);
//	if($dia==13)
//	{
		//echo $dataf_ant;
		//echo $dataf;
		//echo $sql;
		//exit;
//	}
	if($resultado != FALSE)
	{
		$nreg=pg_affected_rows($resultado);
		if($nreg == FALSE)
		{
			echo pg_result_error();
		}
	}
	else
	{
		echo pg_result_error();
	}
}

function alteraregpontosaida($us_id,$id_ponto_ant,$dia_ant,$mes_ant,$ano_ant,$hora_ant,$ocent,$id_ponto,$dia,$mes,$ano,$hora,$ocsai,$numhs)
{
	$dataf_ant= "'".$ano_ant."-".$mes_ant."-".$dia_ant."'";
	$dataf= "'".$ano."-".$mes."-".$dia."'";
	$sql="UPDATE ponto_formatado SET id_pontosai=$id_ponto, datasai=$dataf, horasai = '$hora', ocsai = '$ocsai', totalhs = totalhs + $numhs ";
	$sql=$sql."WHERE usuario=$us_id AND id_pontosai= $id_ponto_ant";
	$resultado=pg_query($sql);
//	if ($id_ponto==14127)
//	{
//		echo $dataf;
//		echo $hora_ant;
//		echo $hora;
//		echo $sql;
//		exit;
//	}
	if($resultado != FALSE)
	{
		$nreg=pg_affected_rows($resultado);
		if($nreg == FALSE)
		{
			echo pg_result_error();
		}
	}
	else
	{
		echo pg_result_error();
	}
}
?>