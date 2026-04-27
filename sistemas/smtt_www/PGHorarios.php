<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>HORARIO �NIBUS</title>

</head>

<body class="branco">
<link rel="stylesheet" href="estilos.css" type="text/css">
<div align="center">


<?php

//echo "<p><img src='http://www.pmf.sc.gov.br/prefeitura.bmp' width='200' height='174' /></p>";
echo "<p><img src='brasao.jpg' width='200' height='174' /></p>";

echo "<tr>";
echo "<td>";
echo "&nbsp;";
echo " <h2>SECRETARIA MUNICIPAL DE TRANSPORTES, MOBILIDADE E TERMINAIS</h2>";
echo "</td>";
echo "</tr>";

echo "<p></p>";

$_varlin = $_GET['numero_linha'];

include_once("conecta_db.php");
//Montar o nome da tabela
$_sql_0 = pg_query("SELECT linha, nome_linha, valortarifa1, valortarifa2, tempoperc1, tempoperc2, extensao1, extensao2, inicio_oper FROM linhas where linha='".$_varlin."'");
$_row_0 = pg_fetch_array($_sql_0,0,null);
if(isset($_GET['dataprox']))
{
	$datapx=$_GET['dataprox'];
}
if ($_row_0['inicio_oper'] <= date("Y-m-d")){
	IF(!empty($datapx))
	{
		$_vardt=$datapx;
	}
	else
	{
		$_vardt=date("Y-m-d");
		//$_vardt="2010-05-20";
	}
} else {
	$_vardt=$_row_0['inicio_oper'];
}
//Execu�ao consulta
$_sql_1 = pg_query("SELECT id, linha, tipo_dia, origem_destino, sentido FROM horarios where linha='".$_varlin."'ORDER BY tipo_dia, sentido");
//$_sql1 = odbc_exec($_con,"SELECT ID, Linha, TipoDia, OrigemDestino, Sentido FROM Horarios where linha='".$_varlin."' ORDER BY TipoDia, Sentido"); 
echo "<p><a href='PGItinerarios.php?numero_linha=$_varlin' class='lp'> Visualizar Itiner&aacuterio</a></p>";
echo "<p align='center'><a href='PGHorariosimp.php?numero_linha=$_varlin&dataref=$_vardt' target='_blank' class='lp'>IMPRIMIR</a></p>";
echo "<table border='1' bordercolor='#9ACD32' align='center' width='500' id='horarios_table'>";

if( !isset( $corfundo ) ){
	$corfundo = '';
}

if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		echo "<tr bgcolor=$corfundo>";
echo "<td>";
echo "<font face='verdana' size='4'>&nbsp;";
echo $_row_0['linha'] . "  -  "  . utf8_encode($_row_0['nome_linha']);
//if($_row_0['linha'] == "630   " && $_vardt >= "2010-09-20")
//{
//	echo $_row_0['linha'] . "  -  CORREDOR CONTINENTE";
//}
//else
//{
//	echo $_row_0['linha'] . "  -  " . $_row_0['nome_linha'];
//}
echo "</font>";
echo "</td>";
echo "</tr>";
echo "</table>";

echo "<table border='1' bordercolor='#9ACD32' align='center' width='500'>";
if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		echo "<tr bgcolor=$corfundo>";
echo "<td>";
echo "<font face='verdana' size='2'>&nbsp;";
echo utf8_encode($_row_0['valortarifa1']);
echo "</font>";
echo "</td>";
echo "<td>";
echo "<font face='verdana' size='2'>&nbsp;";
echo utf8_encode($_row_0['valortarifa2']);
echo "</font>";
echo "</td>";
echo "</tr>";
if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		echo "<tr bgcolor=$corfundo>";
echo "<td>";
echo "<font face='verdana' size='2'>&nbsp;";
echo utf8_encode($_row_0['tempoperc1']);
echo "</font>";
echo "</td>";
echo "<td>";
echo "<font face='verdana' size='2'>&nbsp;";
echo utf8_encode($_row_0['tempoperc2']);
echo "</font>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<font face='verdana' size='2'>&nbsp;";
echo utf8_encode($_row_0['extensao1']);
echo "</font>";
echo "</td>";
echo "<td>";
echo "<font face='verdana' size='2'>&nbsp;";
echo utf8_encode($_row_0['extensao2']);
echo "</font>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
while($_row_1 = pg_fetch_array($_sql_1,0,null ) ) {
	$_cabecalho = "";	
	switch ($_row_1['tipo_dia']) {
		case 1:
			$_cabecalho = "Dia de semana";
			break;
		case 2:
			$_cabecalho = "S�bado";
			break;
		case 3:
			$_cabecalho = "Domingo ou Feriado";
			break;
	}
	$_cabecalho.= " - " . $_row_1['origem_destino'] . " - " . $_row_1['sentido'];
	$_sql_2 = pg_query("SELECT id_per, data_i, data_f FROM horarios_per
								WHERE id = '" . $_row_1['id'] ."' and data_i <='" . $_vardt . "' and data_f >='" . $_vardt . "'");	
	$_row_2 = pg_fetch_assoc($_sql_2);
	
	$_ano_data_f = substr($_row_2['data_f'],0,4);
	if($_ano_data_f == 2099){
		$_vigencia = "Vig&ecirc;ncia a partir de " . substr($_row_2['data_i'],8,2) . "/" . substr($_row_2['data_i'],5,2) . "/" . substr($_row_2['data_i'],0,4);
		IF(empty($datapx))
		{
			$vigenciaprox = "";
			$dataprox = null;
		}
		else
		{
			$vigenciaprox = "Vig�ncia Atual";
			$dataprox = null;
			//$dataprox = date("Y-m-d");
		}
	} else {
		$_vigencia = "Vig&ecirc;ncia de " . substr($_row_2['data_i'],8,2) . "/" . substr($_row_2['data_i'],5,2) . "/" .
					substr($_row_2['data_i'],0,4) . " a " . substr($_row_2['data_f'],8,2) . "/" . 
					substr($_row_2['data_f'],5,2) . "/" . substr($_row_2['data_f'],0,4);
		IF(!empty($datapx))
		{
			$vigenciaprox = "Vig�ncia Atual";
			$dataprox = date("Y-m-d");
		}
		else
		{
			$vigenciaprox = "Pr�xima Vig&ecirc;ncia";
			$dataprox = date("Y-m-d",mktime(0,0,0,substr($_row_2['data_f'],5,2),substr($_row_2['data_f'],8,2)+1,substr($_row_2['data_f'],0,4)));
			//$aux=$dataprox;
		}
	}
	//Caso a consulta retorne vazia nao imprime nada
	$_sql_3 = pg_query("SELECT hor, complementos FROM horarios_per_det WHERE id_per = '" . $_row_2['id_per'] ."'ORDER BY turno, hor");
	$_row_aux = pg_fetch_assoc($_sql_3);
	if($_row_aux['hor'] != NULL){
	//if($_row_2['id_per'] != NULL){
	    
		echo "<table border='0' bordercolor='#9ACD32' align='center' width='500'>";	
		echo "<tr>";
		echo "<td align='left'>";
		echo "<font face='verdana' size='2'>&nbsp;";
		echo utf8_encode($_vigencia);
		//echo $datapx;
		//echo $aux;
		echo "</font>";
		echo "</td>";		
		if($vigenciaprox != "")
		{
			echo "<td align='right'>";
			echo "<font face='verdana' size='2'><a href='PGHorarios.php?numero_linha=$_varlin&dataprox=$dataprox'>";
			echo utf8_encode($vigenciaprox);
			echo "</font>";
			echo "</td>";
		}
		echo "</tr>";
		echo "</table>";
		echo "<table border='0' bordercolor='#9ACD32' align='center' width='500'>";
		echo "<tr>";
		echo "<td align='left'>";
		echo "<font face='verdana' size='2'>&nbsp;";
		echo strtoupper(utf8_encode($_cabecalho));
		echo "</font>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		
		//imprimir o id da linha para conferencia
		//echo $_row_2['id_per'];
		$_sql_3 = pg_query("SELECT hor, complementos FROM horarios_per_det WHERE id_per = '" . $_row_2['id_per'] ."'ORDER BY turno, hor");
		$_i = 0;
		$_num_col_tab = 8;
		echo "<table border='1' bordercolor='#9ACD32' align='center' width='500'>";
		while($_row_3 = pg_fetch_assoc($_sql_3)) {
			if($_i == 0){				
				if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		echo "<tr bgcolor=$corfundo>";
				echo "<td width='40'><a class='hr'>";
				echo formata_horario($_row_3['hor']);
				//echo $_row_3['hor'] . " - " .  strlen($_row_3['hor']);
				echo $_row_3['complementos'];
				echo "</td></a>";
				$_i++;
			}elseif($_i == $_num_col_tab-1){
				echo "<td align='center' width='40'><a class='hr'>";
				echo formata_horario($_row_3['hor']);
				echo $_row_3['complementos'];
				echo "</td></a>";
				echo "</tr>";
				$_i = 0;
			}else{
				echo "<td align='center' width='40'><a class='hr'>";
				echo formata_horario($_row_3['hor']);
				echo $_row_3['complementos'];
				echo "</td></a>";
				$_i++;
			}
		}			
		echo "</table>";
		echo "<br>";
	}
}
$_sql_4 = pg_query("SELECT observacao FROM linhas where linha='".$_varlin."'"); 
$_row_4 = pg_fetch_assoc($_sql_4);
if($_row_4['observacao'] != NULL){
	echo "<table border='1' bordercolor='#9ACD32' align='center' width='500'>";
	if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		echo "<tr bgcolor=$corfundo>";
	echo "<td><a class='hr'>";
	echo utf8_encode($_row_4['observacao']);
	echo "</td></a>";
	echo "</tr>";
	echo "</table>";
	
}

function formata_horario($_horario){
	$_tamanho = strlen($_horario);
	if($_tamanho == 1){
		$_aux = substr($_horario, -1, 1);
		return "00:0" . $_aux;
	}
	elseif($_tamanho == 2){
		$_aux = substr($_horario, -2, 2);
		return "00:" . $_aux;
	}
	elseif($_tamanho == 3){
		$_aux = substr($_horario, -2);
		$_aux_2 = substr($_horario, -3, 1);
		return "0" . $_aux_2 . ":" . $_aux;
	} else {
		$_aux = substr($_horario, -2);
		$_aux_2 = substr($_horario, -4, 2);
		return $_aux_2 . ":" . $_aux;
	}
}

?>
</div>
</body>
</html>