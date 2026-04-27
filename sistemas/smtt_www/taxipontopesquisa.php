<html>
<link rel="stylesheet" type="text/css" href="estilos.css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="60%" bordercolor="#7CFC00" height="80">
	<tr>
	    <td width="10%" bgcolor="#9ACD32" height="20">
	    <p align="center"><font face="verdana" size='3'>Diretoria de Fiscaliza&ccedil&atildeo</font>
		</td>
	</tr>
	<tr align="center">
		<td width="60%" height="40">
		<p align="center"> <h2><br>Permission&aacuterios por Ponto</p></h2>
				
<table border="0"> <form method="POST" action="taxipontolistaperm.php">
<tr><td align="left">
<?php
require("valida_qq_sessao.php");
if(!empty($_GET["campo"]))
	{ 
		if ($_GET["campo"] == 'tp')
		{
			echo "<td align='left'><font face='verdana' color='#FF0000' size='2' > Escolha um local</font>";
		}
	}
?>
	</td></tr>
	<tr>
<?php
	
	require("conecta.php");
	echo " <td align='right'><a class='smt'>Ponto de Taxi:</a></td>";
	session_start();
	echo "<td align='left'><SELECT name='idponto' align='center'>";
	echo "<OPTION></OPTION>";
	$sql="select id_ponto, nomeponto from pontostaxi order by nomeponto";
	$resultado=pg_query($sql);
	$linhas=pg_num_rows($resultado);
	for ($i=0;$i<$linhas;$i++)
	{
		$id_ponto=pg_result($resultado,$i,"id_ponto");
		$nomeponto=pg_result($resultado,$i,"nomeponto");
		//$us_id=pg_result($resultado,$i,"usuario_id");
		echo "<OPTION value=".$id_ponto.">".utf8_encode($nomeponto)."</OPTION>";
	}
	echo "</td>";
?>
</tr>
</table>
 <input type="hidden" name="operacao" value="listar">
				<p></p><input type="submit" value="LISTAR PERMISSIONARIOS" name="enviar" face="verdana">
				</form>
				<p align="center"><a class='lp' href="logout.php">Sair</a></font></p>
				
</html>

