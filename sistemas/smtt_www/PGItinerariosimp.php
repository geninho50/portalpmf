<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ITINERÁRIO ÔNIBUS</title>
<link rel="stylesheet" href="estilos.css" type="text/css">
</head>
<body class='branco'>
<div align="center">
  <p>
    <?php


echo "<tr>";
echo "<td>";
echo "<h2>&nbsp;";
echo "SECRETARIA MUNICIPAL DE TRANSPORTES, MOBILIDADE E TERMINAIS";
echo "</h2>";
echo "</td>";
echo "</tr>";

echo "<p></p>";

echo "<p></p>";

$_varlin = $_GET['numero_linha'];
//$_varlin = 131;

// echo "varlinha" . $_varlin;

include_once("conecta_db.php");
//Montar o nome da tabela
$_sql_0 = pg_query("SELECT linha, nome_linha, valortarifa1, valortarifa2, tempoperc1, tempoperc2, extensao1, extensao2 FROM linhas where linha='".$_varlin."'");
$_row_0 = pg_fetch_array($_sql_0);
//Execuçao consulta
$_sql_1 = pg_query("SELECT id, linha, tipo_dia, origem_destino, sentido FROM horarios where linha='".$_varlin."'ORDER BY tipo_dia, sentido"); 
//$_sql1 = odbc_exec($_con,"SELECT ID, Linha, TipoDia, OrigemDestino, Sentido FROM Horarios where linha='".$_varlin."' ORDER BY TipoDia, Sentido"); 
echo "<table border='1' align='center' width='500'>";
echo "<tr>";
echo "<td>";
echo "<font face='verdana' size='4'>&nbsp;";
echo $_row_0['linha'] . "  -  "  . utf8_encode($_row_0['nome_linha']);
echo "</font>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<table border='1' align='center' width='500'>";
echo "<tr>";
echo "<td>";
echo "<font face='verdana' size='2'>&nbsp;";
echo utf8_encode($_row_0['valortarifa1']);
echo "</font>";
echo "</td>";
echo "<td>";
echo "<font  face='verdana' size='2'>&nbsp;";
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
	//Caso a consulta retorne vazia nao imprime nada
	$_sql_3 = pg_query("SELECT rua, id_itin, sentido FROM itinerarios WHERE linha = '".$_varlin."' ORDER BY sentido, ordem, id_itin");
	//$_row_aux = pg_fetch_assoc($_sql_3);
	//if($_row_aux['id_itin'] != NULL){
		echo "<table border='1' align='center' width='500'>";
		while($_row_3 = pg_fetch_assoc($_sql_3)) {		
				echo "<tr>";
				if($_varsentido != $_row_3['sentido']){
				echo "</tr>";
				echo "</table>";
				echo "<br>";
				echo "<table border='1' align='center' width='500'>";
				echo "<tr>";
				}
				echo "<td width='500'><a class='hr'>";
				echo utf8_encode($_row_3['rua']);
				echo "</td></a></tr>";
				$_varsentido = $_row_3['sentido'];
			}			
		echo "</table>";
		echo "<br>";
	//} else {echo "Reg nao encontrado";
        //}
?>
    </p>
</div>
</body>
</html>