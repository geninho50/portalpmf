<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
   $idGuarnicao = 0;
   $idGuarnicao = (int)$_POST['idGuarnicao'];
   $chave = (int)$_POST['chave'];
   if( $idGuarnicao == 0 )
   {
	 $idGuarnicao = (int)$_GET['idGuarnicao'];
	 $chave = (int)$_GET['chave'];
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHeadCentral.php");?>
<!-- fim inc head -->
</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">GUARNIÇÃO INDISPONÍVEL</legend>
    <form name="form" action="../classes/controleP18.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
    <table width="100%"  border="0" cellpadding="1" cellspacing="1">
	<tr>
      <td width="12%" align="right"></td>
      <td width="88%"><input name="idGuarnicao" id="idGuarnicao" type="text" value="<? echo $idGuarnicao;?>" size="6" readonly="readonly" class="negrito" /><input name="chave" id="chave" readonly="readonly" value="<? echo $chave;?>" type="text" class="negrito"/></td>
    </tr>
    <tr>
      <td align="right" valign="top" class="letra">Motivo:</td>
      <td><textarea name="xmotivo" id="xmotivo" cols="50" rows="5" onkeyup="converteUpper(this);" class="negrito" ></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="Confirmar" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
    </tr>
  </table>
</form>
</fieldset>

	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>
