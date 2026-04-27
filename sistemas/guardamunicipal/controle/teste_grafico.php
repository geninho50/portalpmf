<?php

ini_set('default_charset','UTF-8');
	
// Este primeiro header, corrigi o problema de acentuação dos caracteres.
ini_set('default_charset','UTF-8');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

include("incValidaSessao.php");
$idsession = $_SESSION['idSESSION'];
require ("../classes/DB_mysql.php");
require ("../classes/trataString.php");
$obj = new DB_mysql ;
$objS = new trataString;
$conexao = $obj->conectarConf();


include ("jpgraph/src/jpgraph.php");
include ("jpgraph/src/jpgraph_bar.php");

$query = "select count(ocorrencia_guarnicao.idguarnicao) as total,guarnicao.vtr from guarnicao inner join ocorrencia_guarnicao where ocorrencia_guarnicao.data between '2013-12-10' and '2013-12-10' and ocorrencia_guarnicao.hora<='18:00:00' and ocorrencia_guarnicao.hora>='06:00:00' and ocorrencia_guarnicao.idguarnicao=guarnicao.id group by guarnicao.vtr order by total desc";

$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	

$datay=array();
$datax=array();
while ( $row = mysql_fetch_array($resultado) ){
array_push($datay,$row["altas"]);
array_push($datax,$row["uf"]);
}

// Create the graph. These two calls are always required
$graph = new Graph(400,280,"auto");	
$graph->SetScale("textlin");

// Add a drop shadow
$graph->SetShadow();

// Adjust the margin a bit to make more room for titles
$graph->img->SetMargin(40,30,20,40);

// Create a bar pot
$bplot = new BarPlot($datay);

// Adjust fill color
$bplot->SetFillColor('#CC9933');

// Setup values
$bplot->value->Show();
$bplot->value->SetFormat('%d');
$bplot->value->SetFont(FF_FONT1,FS_BOLD);

// Center the values in the bar
$bplot->SetValuePos('center');

// Make the bar a little bit wider
$bplot->SetWidth(0.7);

$graph->Add($bplot);

// Setup the titles
$graph->title->Set("Prospecção de Altas");
$graph->xaxis->SetTickLabels($datax);
$graph->yaxis->title->Set("Altas");

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Display the graph
$graph->Stroke();
?>