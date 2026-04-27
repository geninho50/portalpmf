<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the pas	


	include("incValidaSessao.php");
	$id = $_GET['id'];
	if( $id > 0 )
	{
		// Pegou o Id
	}
	else
	{
		$id = $_POST['id'];
	}

	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$tamanho = 0;
	$nome = "";
	$valor = "";
	
	if( $id > 0 )
	{		
		$query = "SELECT * FROM nivel where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		$id = 0;
		$nomeCategoria = "";		
		if( $linha )
		{
			$id = $linha["id"];
			$nome = $linha["nome"];
			$valor = $linha["valor"];
			$tamanho = strlen($nome);
		}		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<fieldset>
	<legend class="cabecalho">CADASTRO NÍVEL</legend>
<form name="form1" method="post" action="../classes/controleNivel.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="52%" border="0" cellspacing="1" cellpadding="1">

 <tr>
    <td width="156" align="right" class="letra">N&iacute;vel:</td>
    <td width="376"><input name="xnome" id="xnome" type="text" onKeyUp="counterUpdate('xnome','countNome','195');" size="52" value="<?echo $nome;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
 </tr>

  <tr>
	<td width="156">&nbsp;</td>
    <td align="left" class="letra">
	Voc&ecirc; digitou <B><span id="countNome"><?php echo $tamanho;?></span></B> caracteres » Limite: <B>195</B> caracteres</p>
	</td>
  </tr>

  <tr>
    <td width="156" align="right" class="letra">Valor :</td>
    <td width="376"><input name="xvalor" id="xvalor" type="text" size="20" value="<?echo $valor;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
  </tr>
 <INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">	
	
  <tr height="2">
    <td align="left" class="letra" colspan="2">&nbsp;</td>
  </tr>

  <tr>	
    <td align="right">
    <td><input name="Submit" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
	</td>
  </tr>

</table>
</form>
</fieldset>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>

</body>
</html>

<?php
	// Fechando as variáveis de conexão
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeVar($id);
	$obj->closeVar($nomeCategoria);
	if( $id > 0 )
	{
		$obj->closeQuery();
		$obj->closeConexaoGeral();
	}
?>
