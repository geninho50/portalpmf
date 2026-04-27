<?php
ini_set('default_charset','UTF-8');

// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
	$idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	//$conexao = $obj->conectarConf();

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
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">CADASTRO HORA EXTRA OFF</legend>
	<form name="form1" method="post" action="../classes/controleHoraOff.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	
	<table width="67%" border="0" cellspacing="1" cellpadding="1">
	  <tr>
		<td width="20%" align="right" class="letra">GM:</td>
		<td width="53%">
        	 <input type="text" class="codigo" name="xguarda" id="xguarda" size="20" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
        </td>
		<td width="27%" align="right">&nbsp;</td>
		</tr>
	
	  <tr>
		<td align="right" class="letra">Data:</td>
		<td>
		 <input type="text" value="<? echo $dataini;?>" readonly name="dataini" class="stylo1" size="12"/>
		  <a onClick="displayCalendar(document.forms[0].dataini,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>   
		</td>
		<td>  
	  </tr>
	  <tr>
		<td height="24" align="right" class="letra">Hora de 100%:</td>
		<td><input name="xhora100" class="negrito" type="text" id="xhora100" size="5" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
		<td>  
	  </tr>
	  <tr>
		<td height="24" align="right" class="letra">Hora de 200%:</td>
		<td><input name="xhora200" class="negrito" type="text" id="xhora200" size="5" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
		<td>  </tr>
	  <tr>
		<td height="24" align="right" class="letra">Adic. Noturno: </td>
		<td><input name="xadicional" class="negrito" type="text" id="xadicional" size="5" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
		<td width="27%">    </tr>
	  <tr>
		<td height="24" align="right">&nbsp;</td>
		<td><input name="Submit" type="submit" class="letra" id="Confirmar" value="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" /></td>
		<td width="27%">    </tr>
	
	</table>
	
	</form>
	</fieldset>
<!-- fim do adm -->
	
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="14%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="86%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>
</body>
</html>

<?php
	// Fechando as vari�veis de conex�o
	$obj->closeVar($conexao);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>