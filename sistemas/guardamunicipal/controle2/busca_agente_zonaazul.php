<?php
		// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">
	<?php 
		$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$resultado = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$login = $linha["login"];
			
			include("menu.php");
		}
	?>
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="letra">Resultado(s)</legend>

	<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
		<tr>
			<td width="48%" align="left" class="branco"><B>Nome</B></td>
			<td width="11%" align="center" class="branco"><b>Turno</b></td>
			<td width="10%" align="center" class="branco"><b>Coloca&ccedil;&atilde;o</b> </td>
			<td width="14%" align="center" class="branco"><b>Dias de Trabalho</b> </td>
			<td width="13%" align="center" class="branco"><b>Data Limite</b> </td>				
			<td width="2%" align="center" class="branco">&nbsp;</td>		
			<td width="2%" align="center" class="branco">&nbsp;</td>
		</tr> 
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<?php
		 $chavet = true;
		$query = "SELECT id,nome,turno,colocacao,dias,DAY(datalimite) as dia,MONTH(datalimite) as mes,YEAR(datalimite) as ano FROM agente_zonaazul order by colocacao asc";
		$resultado = $obj->executaQuery($query);
		while ( $linha = mysql_fetch_array($resultado) )
		{		
	?>
		<tr  bgColor="<?PHP if($chavet)
							{
								echo '#cccccc';
							}
							else{ 
								echo '#ffffff';
							} 
							$chavet=!$chavet;
						?>">
	
			<td width="48%" align="left" class="negrito"><? echo $linha['nome']; ?></td>		
			<td width="11%" align="center" class="negrito"><? echo $linha['turno']; ?></a></td>
			<td width="10%" align="center" class="negrito"><? echo $linha['colocacao']; ?></a></td>
			<td width="14%" align="center" class="negrito"><? echo $linha['dias']; ?></td>
			<td width="13%" align="center" class="negrito"><? echo $linha['dia'].' / '.$linha['mes'].' / '.$linha['ano']; ?></td>
			<td width="2%" class="letra" align="center"><A HREF="cadastro_agente_zonaazul.php?id=<? echo $linha['id']; ?>" border="0"><IMG SRC="images/editar.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT="Alterar"></A></td>
			<td width="2%" class="letra" align="center"><a onClick="Excluir('../classes/controleAgenteZonaAzul.php?id=<? echo $linha['id']; ?>')" href="#"><IMG SRC="images/lixeira.jpg" WIDTH="16" HEIGHT="16" BORDER="0" ALT="Excluir"></A></td>
	
		</tr>
	
	<?php
		}
	?>
		
	</table>
	
	</fieldset>
	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>

<?php
	// Fechando as vari�veis de conex�o
	$obj->closeVar($conexao);
	$obj->closeVar($xBusca);
	$obj->closeVar($tamanho);
	$obj->closeVar($nvaloresencontrados);
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>