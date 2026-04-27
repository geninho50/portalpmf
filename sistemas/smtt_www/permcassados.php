<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link rel="stylesheet" type="text/css" href="estilos.css">
<?php
require("conecta.php");
//echo $cpf;
$msg="";
echo "<p align='center'><font face='Verdana' size='2'><a href='seleciona.php'>Voltar</a></font></p>";
echo "<a class='tit'><p align='center'>Permission&aacuterios que tiveram selo e licen&ccedila recolhidos por motivo judicial</p></a>";

$sql = "select noordem, permissionario, placa from vencimentos where obs = 'SELO E LICENÇA RECOLHIDOS POR MOTIVO JUDICIAL' order by noordem";
$resultado=pg_query($sql);
if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	echo "<a class='tit'><p align='center'>Total de Permission&aacuterios: ".$linhas."</p></a>";
	if($corfundo == "#EAE9DB")
	{
		$corfundo="#FFFFFF";
	}
	else
	{
		$corfundo="#EAE9DB";
	}
	echo "<table align='center' border=4 bordercolor='#9ACD32'>";	
	echo "<tr bgcolor=$corfundo>";
	echo "<td align='center'><font face='verdana' size='1'><b>N&ordm Ordem </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Permission&aacuterio </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Placa </b></font></td>";
	echo "</tr>";
	for ($i=0; $i<$linhas; $i++)
	{
		$noordem=pg_result($resultado,$i,"noordem");
		$permissionario=pg_result($resultado,$i,"permissionario");
		$placa=pg_result($resultado,$i,"placa");
				
		if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		echo "<tr bgcolor=$corfundo>";
		echo "<td align='center'><font face='verdana' size='1'>$noordem </td>";
		echo "<td align='center'><font face='verdana' size='1'>".utf8_encode($permissionario)."</td>";
		echo "<td align='center'><font face='verdana' size='1'>$placa </td>";		
		echo "</tr>";
	}
	echo "</table>";
	echo "<p align='center'><font face='Verdana' size='2'><a href='seleciona.php'>Voltar</a></font></p>";
}
else
{
	echo pg_error();
	$msg ='CPF '.$cpfform.' inválido';
	mensagemfalhacpf($msg);
}


function mensagemfalhacpf($msg)
{	
	echo "<a class='tit'><p align='center'>".utf8_encode($msg)."</p></a>";
	echo "<p align='center'><font face='Verdana' size='2'><a href='condutorpermis.php'>Voltar</a></font></p>";
}

?>
</html>
