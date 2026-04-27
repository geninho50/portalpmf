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
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
  
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CADASTRO FOLGAS</legend>
	<form name="form1" method="post" action="../classes/controleFolga.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td colspan="2"><table width="100%"  border="0" cellspacing="1" cellpadding="1">
		  <tr>
		    <td align="right" class="letra">Cadastrado por: </td>
		    <td><input name="login" readonly="readonly" value="<? echo $login;?>" type="text" size="15" class="negrito"></td>
		    </tr>
		  <tr>
			<td width="12%" align="right" class="letra">GM:</td>
			<td width="88%">
           <input type="text" class="codigo" name="xguarda" id="xguarda" size="20" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
           
            </td>
			</tr>
		</table></td>
	  </tr>
	  <tr>
		<td colspan="2"><table width="100%"  border="0" cellspacing="1" cellpadding="1">
		  <tr>
			<td width="12%" height="24" align="right" class="letra">Descri&ccedil;&atilde;o da Folga:</td>
			<td width="88%"><input name="xDescricao" type="text" class="negrito" value="<?php echo $descricao; ?>" size="80" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" />	</td>
			</tr>
		</table></td>
	  </tr>
			<INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">
			<tr>
			  <td colspan="2"><table width="100%"  border="0" cellspacing="1" cellpadding="1">
				<tr>
				  <td width="12%" align="right" valign="top" class="letra">Qtade de Dias: </td>
				  <td width="88%"><input name="xQtade" class="negrito" type="text" value="<?php echo $qtade; ?>" size="8" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" />
	</td>
				</tr>
			  </table></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
		<tr>	
			<td width="12%">&nbsp;		</td>
			<td width="88%"><input name="Submit" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
		</tr>
	</table>
	</form>
	</fieldset>
	
	</td>
	</tr>
	</table>
	<!--fim adm-->
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

