<?php

	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the pas

	include("incValidaSessao.php");
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	// Realiza a consulta ao banco;
	$xBusca = "";
	$xBusca = $_POST['xBusca'];
	$xBusca = trim($xBusca);
	$tamanho = strlen($xBusca);
	$nvaloresencontrados = 0;
	$query = "SELECT * FROM nivel where UPPER(nome) like UPPER('%$xBusca%') order by nome";
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body ONLOAD="setaFocusForm(1)">

<fieldset>
	<legend class="cabecalho">CONSULTAR NÍVEL</legend>
<form name="form1" method="post" action="busca_nivel.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="67%" border="0" cellspacing="1" cellpadding="1">

  <tr>
    <td width="40%" align="right" class="letra">Digite o <B>Nome</B> dado ao N&iacute;vel:</td>
    <td width="31%"><input name="xBusca" type="text" size="30" value="<?echo $xBusca;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
      <td width="29%"><input name="Submit" type="submit" class="letra" id="Pesquisar" value="Pesquisar" onClick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
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
	<legend class="letra"><B>RESULTADO(s) <?echo $nvaloresencontrados;?> PARA <?echo $xBusca;?></B></legend>

<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
	<tr>
		<td width="30%" align="left" class="branco"><B>Nome</B></td>	
		<td width="10%" align="center" class="branco"><B>Valor </B></td>
		<td width="28%" align="center" class="branco">&nbsp;</td>
		<td width="3%" align="center" class="branco">&nbsp;</td>		
		<td width="5%" align="center" class="branco">&nbsp;</td>
	</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$resultado = $obj->executaQuery($query);
	while ( $linha = mysql_fetch_array($resultado) )
	{		
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

		<td width="30%" align="left" class="negrito"><? echo $linha['nome']; ?></td>		
		<td width="10%" align="center" class="negrito"><? echo $linha['valor']; ?></td>
		<td width="28%" align="center" class="branco">&nbsp;</td>
		<td width="3%" class="negrito" align="center"><A HREF="cadastro_nivel.php?id=<? echo $linha['id']; ?>" border="0"><IMG SRC="imagens/editor_texto.png" WIDTH="20" HEIGHT="20" BORDER="0" ALT="Alterar"></A></td>
	    <td width="5%" class="negrito" align="center"><a onClick="Excluir('../classes/controleNivel.php?id=<? echo $linha['id']; ?>')" href="#">	   
	   <IMG SRC="imagens/excluir.png" WIDTH="20" HEIGHT="20" BORDER="0" ALT="Excluir"></A></td>

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
	<legend class="letra"><B>RESULTADO(s) <?echo $nvaloresencontrados;?> PARA <?echo $xBusca;?></B></legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td width="100%" colspan="3" align="center" class="letra">Nenhuma ocorr&ecirc;ncia para <B><?echo $xBusca;?></B></td>
	</tr>	
</table>
</fieldset>

<?php	
	}
?>
</body>
</html>

<?php
	// Fechando as variáveis de conexão
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