<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HORARIO ÔNIBUS</title>

</head>

<body class="branco">
<link rel="stylesheet" href="estilos.css" type="text/css">
<div align="center">

<?php

echo "<tr>";
echo "<td>";
echo "&nbsp;";
echo " <h2>SECRETARIA MUNICIPAL DE TRANSPORTES, MOBILIDADE E TERMINAIS</h2>";
echo "</td>";
echo "</tr>";

echo "<p></p>";

$_varlin = $_GET['numero_linha'];
$dataref = $_GET['dataref'];
include_once("conecta_db.php");
//Montar o nome da tabela
$_sql_0 = pg_query("SELECT linha, nome_linha, valortarifa1, valortarifa2, tempoperc1, tempoperc2, extensao1, extensao2, inicio_oper FROM linhas where linha='".$_varlin."'");
$_row_0 = pg_fetch_array($_sql_0);
if ($_row_0['inicio_oper'] <= date("Y-m-d")){
	//$_vardt=date("Y-m-d");
	$_vardt=$dataref;
} else {
	$_vardt=$_row_0['inicio_oper'];
}
//Execuçao consulta
$_sql_1 = pg_query("SELECT id, linha, tipo_dia, origem_destino, sentido FROM horarios where linha='".$_varlin."'ORDER BY tipo_dia, sentido"); 
//$_sql1 = odbc_exec($_con,"SELECT ID, Linha, TipoDia, OrigemDestino, Sentido FROM Horarios where linha='".$_varlin."' ORDER BY TipoDia, Sentido"); 
//echo "<a href='PGItinerariosimp.php?numero_linha=$_varlin'>[Visualizar Itinerário]</a>";
echo "<table border='1' align='center' width='500' id='horarios_table'>";
echo "<tr>";
echo "<td>";
echo "<font face='verdana' size='4'>&nbsp;";
echo $_row_0['linha'] . "  -  "  . utf8_encode($_row_0['nome_linha']);
//if($_row_0['linha'] == "630   " && $_vardt >= "2010-09-20")
//{
//	echo $_row_0['linha'] . "  -  CORREDOR CONTINENTE";
//}
//else
//{
//	echo $_row_0['linha'] . "  -  "  . $_row_0['nome_linha'];
//}
echo "</font>";
echo "</td>";
echo "</tr>";
echo "</table>";

echo "<table border='1' bordercolor='#EAE9DB' align='center' width='500'>";
echo "<tr>";
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
echo "<tr>";
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
while($_row_1 = pg_fetch_array($_sql_1)) {
	$_cabecalho = "";	
	switch ($_row_1['tipo_dia']) {
		case 1:
			$_cabecalho = "Dia de semana";
			break;
		case 2:
			$_cabecalho = "SÁbado";
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
	} else {
		$_vigencia = "Vig&ecirc;ncia de " . substr($_row_2['data_i'],8,2) . "/" . substr($_row_2['data_i'],5,2) . "/" . substr($_row_2['data_i'],0,4) . 
											" a " . substr($_row_2['data_f'],8,2) . "/" . substr($_row_2['data_f'],5,2) . "/" . substr($_row_2['data_f'],0,4);
	}
	//Caso a consulta retorne vazia nao imprime nada
	$_sql_3 = pg_query("SELECT hor, complementos FROM horarios_per_det WHERE id_per = '" . $_row_2['id_per'] ."'ORDER BY turno, hor");
	$_row_aux = pg_fetch_assoc($_sql_3);
	if($_row_aux['hor'] != NULL){
	//if($_row_2['id_per'] != NULL){
	    
		echo "<table border='0' align='center' width='500'>";
		echo "<tr>";
		echo "<td align='left'>";
		echo "<font face='verdana' size='2'>&nbsp;";
		echo utf8_encode($_vigencia);
		echo "</font>";
		echo "</td>";
		echo "</tr>";
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
		$_num_col_tab = 15;
		echo "<table border='1' align='center' width='500'>";
		while($_row_3 = pg_fetch_assoc($_sql_3)) {
			if($_i == 0){				
				echo "<tr>";
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
	echo "<table border='1' align='center' width='500'>";
	echo "<tr>";
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