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

	// Realiza a consulta ao banco;
	$ultimosrecado = $_GET['ultimosrecado'];
	if( $ultimosrecado > 0 )
	{
		// Pegou o Id
	}
	else
	{
		$ultimosrecado = $_POST['ultimosrecado'];
	}

	$xBusca = "";
	$xBusca = $_POST['xBusca'];
	$xBusca = trim($xBusca);
	$tamanho = strlen($xBusca);
	$nvaloresencontrados = 0;
	if( $ultimosrecado > 0 )
		$query = "SELECT * FROM recado order by data desc LIMIT 0, 30";
	else
		$query = "SELECT * FROM recado where UPPER(nome) like UPPER('%$xBusca%')";
	if( $tamanho > 0 || $ultimosrecado > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>
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
		$result = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($result);
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
	
	<!-- inicio do adm -->
	<fieldset>
	<legend class="negrito">Consultar Recados</legend>
<form name="form1" method="post" action="busca_recado.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="67%" border="0" cellspacing="1" cellpadding="1">

  <tr>
    <td width="40%" align="right" class="letra">Digite o <B>Nome</B> da Noticia:</td>
    <td width="31%"><input name="xBusca" type="text" size="30" value="<?echo $xBusca;?>"/></td>
    <td width="29%"><input name="Submit" type="submit" class="botao" id="Pesquisar" value="Pesquisar" onClick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
  </tr>

  <tr>
    <td width="40%" align="right" class="letra">&nbsp;</td>
    <td width="31%" class="letra"><A HREF="busca_recado.php?ultimosrecado=1">Ver as ultimos 30 recados</A></td>
      <td width="29%">&nbsp;</td>
  </tr>

  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>



</form>
</fieldset>

<?php
	if( $nvaloresencontrados > 0 )
	{
?>
<fieldset>
	<legend class="negrito">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $xBusca;?></legend>

<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
	<tr>
		<td width="60%" align="left" class="branco"><B>Nome</B></td>
		<td width="10%" align="center" class="branco"><B>Alterar</B></td>		
		<td width="10%" align="center" class="branco"><B>Excluir</B></td>
	</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$resultado = $obj->executaQuery($query);
	while ($linha=mysql_fetch_array($resultado))
	{		
		// Tratando o tamanho do nome da not�cia
		$nome = $obj->retornaSringTamanho($linha['nome'],150);
?>
	<tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>">

		<td width="60%" align="left" class="letra"><A HREF="cadastro_recado.php?idRecado=<? echo $linha['id']; ?>" border="0"><? echo $nome; ?></A></td>
		<td width="10%" class="letra" align="center"><A HREF="cadastro_recado.php?idRecado=<? echo $linha['id']; ?>" border="0"><IMG SRC="images/editar.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT="Alterar"></A></td>
	    <td width="10%" class="letra" align="center"><a onClick="Excluir('../classes/controleRecado.php?idRecado=<? echo $linha['id']; ?>')" href="#">	   
	   <IMG SRC="images/lixeira.jpg" WIDTH="16" HEIGHT="16" BORDER="0" ALT="Excluir"></A></td>

	</tr>
<?php
	}
?>
	
</table>

</fieldset>

	</td>
	</tr> 
	
</table>


<?php
	}

	if( $nvaloresencontrados == 0 && $tamanho > 0 )
	{
		
?>

<fieldset>
	<legend class="negrito">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $xBusca;?></legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">

	<tr>
		<td width="100%" colspan="3" align="center" class="negrito">Nenhuma ocorr&ecirc;ncia para <B><?echo $xBusca;?></B></td>
	</tr>
	
</table>
</fieldset>
<?php	
	}
?>
	<!-- fim do adm -->
	</td>
  </tr>
</table>

</body>
</html>