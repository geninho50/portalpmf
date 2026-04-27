<?php

	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	// Recebe o valor enviado 
	$valor = $_GET['valor'];

    $sql = "SELECT * FROM guarda_gmf where matricula=$valor";
	$resultado = $obj->executaQuery($sql);
	while( $linha = mysql_fetch_array($resultado) )
	{
		echo $login = $linha["login"];
	}
?>

<?php
/*// Incluir aquivo de conexão
include("conn.php");
 
// Recebe o valor enviado
$valor = $_GET['valor'];
 
// Procura titulos no banco relacionados ao valor
$sql = mysql_query("SELECT * FROM noticias WHERE titulo LIKE '%".$valor."%'");
 
// Exibe todos os valores encontrados
while ($noticias = mysql_fetch_object($sql)) {
	echo "<a href=\"javascript:func()\" onclick=\"exibirConteudo('".$noticias->id."')\">" . $noticias->titulo . "</a><br />";
}
 
// Acentuação
header("Content-Type: text/html; charset=ISO-8859-1",true);*/
?>