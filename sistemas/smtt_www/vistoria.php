<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	</head>
<?php
require("conecta.php");
require("listaveiculos.php");
//session_start();
//if($_SESSION['ultform'] == 'listaveiculos')
//{
//	pg_close($conecta);
//	header ("Location: seleciona.php");
//	echo "Aqui 01";
//	exit;
//}
$servico="";
$veiculo="";
$noordem="";
//echo "<form method='POST' action='seleciona.php'>";
//echo "<input type='submit' value='Nova Pesquisa' name='nova'>";
//echo "</form>";
//echo "<input type='submit' value='Voltar' onclick='goBack()' />";
if(!empty($_POST["placa"]))
{
//$placa = $_POST["placa"];
	$placa = strtoupper($_POST["placa"]);
	$varid=idveicplaca($placa);

//echo $varid;
//echo $placa;
	if ($varid > 0)
	{
		dadosveiculoid($varid);
	}
	elseif ($varid == 0)
	{
		listaveicplaca($placa);
	}
	else
	{
	echo "Nenhum veículo foi encontrado nestas condições";
	echo "<p><td align='center'><font face='verdana'><a href='seleciona.php'>Nova Pesquisa </a></font></td></p>";	
//echo "<p><a href='javascript:window.history.go(-1)'>Voltar </a></p>";	
	}
	exit;
}
if(isset($_GET["placa"]))
{
	
	$placa = $_GET["placa"];
	$placa = strtoupper($_GET["placa"]);
	$varid=idveicplaca($placa);
//echo $varid;
//echo $placa;
	if ($varid > 0)
	{
		dadosveiculoid($varid);
	}
	elseif ($varid == 0)
	{
		listaveicplaca($placa);
	}
	else
	{
	echo "Nenhum veículo foi encontrado nestas condições";
	echo "<p><td align='center'><font face='verdana'><a href='seleciona.php'>Nova Pesquisa </a></font></td></p>";		
//echo "<p><a href='javascript:window.history.go(-1)'>Voltar </a></p>";	
	}
	exit;
}

if(!empty($_POST["noordem"]))
{
	$noordem = $_POST["noordem"];
	$varid=idveicnord($noordem);
//echo $varid;
	if ($varid > 0)
	{
		dadosveiculoid($varid);
	}
	elseif ($varid == 0)
	{
		listaveicordem($noordem);
	}
	else
	{
	echo "Nenhum veículo foi encontrado nestas condições";
	echo "<p><td align='center'><font face='verdana'><a href='seleciona.php'>Nova Pesquisa </a></font></td></p>";	
//echo "<p><a href='javascript:window.history.go(-1)'>Voltar </a></p>";	
	}
}
else
{
	if(isset($_POST["servico"]))
	{
		session_start();
		$_SESSION["servico"] = $_POST["servico"];
	}
	if($_POST["vt"]=="V")
	{
		header ("Location:cadvencidos.php");
	}
	else
	{
		$servico = $_POST["servico"];
		listaveicserv($servico);
	}

}

pg_close($conecta);
//echo "<form method='POST' action='seleciona.php'>";
//echo "<input type='submit' value='Nova Pesquisa' name='nova'>";
//echo "</form>";
//echo "<input type='submit' value='Voltar' onclick='goBack()' />";
//echo "<p></p>";
?>
</html>