<?php
	ini_set('default_charset','UTF-8');

	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past


	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$objS = new trataString;
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	$login = "";
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($result);
	if( $linha )
	{
		$login = $linha["login"];
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />

<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="negrito">CADASTRO DE RECADO</legend>

<form name="form1" method="post" action="../classes/controleRecadoDireto.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%" border="0" cellspacing="1" cellpadding="1">

 <tr>
    <td width="13%" align="right" class="letra">De:</td>
    <td width="87%"><input name="xlogin" id="xlogin" class="negrito" type="text" readonly="readonly" size="52" value="<?echo $login;?>"/></td>
 </tr>

  <tr>
    <td width="13%" align="right" class="letra">Para:</td>
    <td width="87%"><input type="text" class="negrito" name="xguarda" id="xguarda" size="20" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
 </tr>
  <tr>
    <td align="right" valign="top" class="letra">Assunto:</td>
    <td><input name="xassunto" type="text" size="52" class="negrito" value="<?echo $assunto;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
  </tr>
  <tr>
    <td width="13%" align="right" valign="top" class="letra">Texto:</td>
    <td width="87%"><textarea name="xtexto" cols="90" class="negrito" rows="10" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" ><? echo $xtexto;?></textarea>
	
</td>
 </tr>

 <INPUT TYPE="hidden" NAME="idRecado" value="<?echo $idRecado;?>">	
	
  <tr height="2">
    <td align="left" class="quote" colspan="2">&nbsp;</td>
  </tr>

  <tr>	
    <td align="right">
    <td><input name="Submit" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
	</td>
  </tr>

</table>

</form>
</fieldset>
	<!--fim adm-->
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>


</body>
</html>

<?php
	// Fechando as vari�veis de conex�o
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
