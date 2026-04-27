<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	$id = (int)$_GET['id'];
	if( $id > 0 )
	{
		// Pegou o Id
	}
	else
	{
		$id = (int)$_POST['id'];
	}

	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$local = "";
	$tempo = "";
	$complemento = "";
	
	if( $id > 0 )
	{		
		$query = "SELECT * FROM atividadeextra where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		if( $linha > 0 )
		{
			$id = $linha["id"];
			$tempo = $linha["tempo"];
			$local = $linha["local"];
			$complemento = $linha["complemento"];
		}		
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CADASTRO ATIVIDADE EXTRA</legend>

	<form name="form1" method="post" action="../classes/controleAtividadeExtra.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	
	<table width="83%" height="263" border="0" cellpadding="1" cellspacing="1">
	  <tr>
		<td height="24" align="right" class="letra">Atividade:</td>
		<td>      <input name="xatividade" id="xatividade" type="text" size="60" value="<?echo $atividade;?>" class="negrito" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
	  </tr>
	  <tr>
		<td width="21%" height="24" align="right" class="letra">Tempo Dispon&iacute;vel:</td>
		<td width="79%">
        <input type="text" value="<? echo $dataini;?>" readonly name="dataini" class="negrito" size="12" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" />
		  <a onClick="displayCalendar(document.forms[0].dataini,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' tille='Selecione a Data'></a>
          </td>
	 </tr>
	  <tr>
		<td height="136" align="right" valign="top" class="letra">Informa&ccedil;&otilde;es Complementares:</td>
		<td valign="top"><textarea name="complemento" cols="90" rows="10" id="complemento" class="negrito" onkeyup="converteUpper(this);"><?echo $complemento;?></textarea></td>
	  </tr>
	
	 <INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">	
		
	  <tr>	
		<td align="right">
		<td><input name="Confirmar" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
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
	if( $id > 0 )
	{
		$obj->closeQuery();
		$obj->closeConexaoGeral();
	}
?>
