<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
require("conecta.php");
$sql = "SELECT condutores.condutornome, condutores.cpf, perm_condutores.servico, perm_servicos.numordem, permissionarios.nome, perm_condutores.dataini ";
$sql=$sql."FROM perm_condutores INNER JOIN condutores ON perm_condutores.condutor = condutores.id INNER JOIN permissionarios ON perm_condutores.perm = permissionarios.id ";
$sql=$sql."INNER JOIN perm_servicos ON perm_condutores.servico = perm_servicos.servico AND perm_condutores.perm = perm_servicos.perm_id ";
$sql=$sql."WHERE perm_condutores.datafim Is Null ORDER BY condutores.condutornome, perm_servicos.numordem";
$resultado=pg_query($sql);
if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	echo "<table align='center' border=4 bordercolor='#9ACD32'>";
	echo "<tr>";
	echo "<td align='center'><font face='verdana' size='2'><b>Nome do Condutor </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>CPF </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Servi&ccedilo </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>N&ordm Ordem </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Permission&aacuterio </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Data In&iacutecio </b></font></td>";
	echo "</tr>";
	for ($i=0; $i<$linhas; $i++)
	{
		$condutornome=pg_result($resultado,$i,"condutornome");
		$cpf=pg_result($resultado,$i,"cpf");
		if($cpf != ""){
			$cpf=substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,6,3).'-'.substr($cpf,9,2);
		}
		else{
			$cpf="";
		}
		$servico=pg_result($resultado,$i,"servico");
		$numordem=pg_result($resultado,$i,"numordem");
		$nome=pg_result($resultado,$i,"nome");
		$dataini=pg_result($resultado,$i,"dataini");
		if($dataini != '')
		{	
			$datain=substr($dataini,8,2).'/'.substr($dataini,5,2).'/'.substr($dataini,0,4);
		}
		else
		{
			$datain=$dataini;
		}
		echo "<tr>";
		echo "<td align='center'>".utf8_encode($condutornome)." </td>";
		echo "<td align='center'>$cpf </td>";
		echo "<td align='center'>$servico </td>";
		echo "<td align='center'>$numordem </td>";
		echo "<td align='center'>".utf8_encode($nome)."</td>";
		echo "<td align='center'>$datain </td>";
		echo "</tr>";
	}
	echo "</table>";
}
else
{
	echo pg_error();
}
?>
</html>