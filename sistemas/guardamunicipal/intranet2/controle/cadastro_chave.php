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
	
	$cpf = $_GET['cpf'];
	$matricula = $_GET['matricula'];
	
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CADASTRO CHAVE DE SEGURANÇA</legend>

<form name="form1" method="post" action="../classes/controleChaveSeguranca.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%" border="0" cellspacing="1" cellpadding="1">

 <tr>
    <td width="19%" align="right" class="letra">Matricula:</td>
    <td width="79%"><input name="xmatricula" id="xmatricula" type="text" class="negrito" size="60" value="<? echo $matricula;?>"/></td>
    <td width="2%">&nbsp;</td>
 </tr>
 <tr>
    <td width="19%" align="right" class="letra">CPF:</td>
    <td width="79%"><input name="xcpf" id="xcpf" type="text" maxlength="11" class="negrito" size="60" value="<? echo $cpf;?>"/></td>
    <td width="2%">&nbsp;</td>
 </tr>

 <tr>
    <td align="right" valign="top" class="letra">Nova chave:</td>
    <td> <input name="xnovachave" type="text" size="60" id="xnovachave" maxlength="4" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" onkeypress="return SomenteNumero(event);"/><font color="#FF0000" size="1"><b>OBRIGATORIO TER 4 NÚMEROS</b></font></td>
    <td>&nbsp;</td>
 </tr>
	
  <tr height="2">
    <td align="left" class="quote" colspan="3">&nbsp;</td>
  </tr>

  <tr>	
    <td align="right">
    <td><input name="Submit" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
	</td>
    <td>&nbsp;</td>
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