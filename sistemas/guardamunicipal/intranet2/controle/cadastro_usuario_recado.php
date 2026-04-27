<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
	
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$conexao = new DB_mysql ;
	$objS = new trataString;
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $conexao->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	//Pega a data atual
    $data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");
	
	$matricula = $_GET['matricula'];
	if( $matricula > 0 )
	{		
		$conexao->conectarConf();
		$query = "SELECT * FROM recado_usuario where matricula=$matricula";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$nomerecado = $linha["nomerecado"];
			$nomeemergencia = $linha["nomeemergencia"];
			$fonerecado = $linha["fonerecado"];
			$foneemergencia = $linha["foneemergencia"];
			$parentescorecado = $linha["parentescorecado"];
			$parentescoemergencia = $linha["parentescoemergencia"];
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
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="100%" colspan="2">
		<!--topo--><!--topo-->
	</th>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<!--inicio adm-->
	<table width="540"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="130"><a href="cadastro_usuario.php?matricula=<? echo $matricula; ?>"><img src="imagens/pessoal_0.jpg" width="130" height="40" border="0" onMouseOver="this.src='imagens/pessoal_1.jpg'" onMouseOut="this.src='imagens/pessoal_0.jpg'" /></a></td>
    <td width="130"><img src="imagens/recado_1.jpg" width="130" height="40" /></td>
    <td width="130"><a href="cadastro_usuario_saude.php?matricula=<? echo $matricula; ?>"><img src="imagens/saude_0.jpg"  width="130" height="40" border="0" onMouseOver="this.src='imagens/saude_1.jpg'" onMouseOut="this.src='imagens/saude_0.jpg'" /></a></td>
    <td width="150"><a href="cadastro_usuario_escolaridade.php?matricula=<? echo $matricula; ?>"><img src="imagens/escolaridade_0.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/escolaridade_1.jpg'" onMouseOut="this.src='imagens/escolaridade_0.jpg'" /></a></td>
	<td width="150"><a href="cadastro_usuario_profissional.php?matricula=<? echo $matricula; ?>"><img src="imagens/profissional_0.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/profissional_1.jpg'" onMouseOut="this.src='imagens/profissional_0.jpg'" /></a></td>
  	<td width="150"><a href="cadastro_usuario_institucional.php?matricula=<? echo $matricula; ?>"><img src="imagens/institucional_0.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/institucional_1.jpg'" onMouseOut="this.src='imagens/institucional_0.jpg'" /></a></td>
  </tr>

</table>
<fieldset>
	<legend class="cabecalho">CADASTRO RECADO</legend>

<form name="form" action="../classes/controleUsuarioRecado.php" method="post" onSubmit="return validaFormAll(this,'Continuar','Continuar')">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td align="right" class="letra">&nbsp;</td>
    <td class="white"><input name="matricula" type="text" size="15" readonly="readonly" value="<? echo $matricula; ?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    </tr>
  <tr>
    <td align="right" class="letra">&nbsp;</td>
    <td class="white">&nbsp;</td>
    </tr>
  <tr bgcolor="#007CB9">
    <td width="14%" align="right" class="letra">&nbsp;</td>
    <td width="86%" class="branco"><b>EM CASO DE RECADO:</b></td>
    </tr>
  <tr>
    <td align="right" class="letra">Nome:</td>
    <td><input name="xnomerecado" type="text" id="xnomerecado" class="negrito" value="<? echo $nomerecado;?>" size="30" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    </tr>
  
  
  
  
 <!--dados do grau de instrução-->
  <tr>
    <td align="right" class="letra">Grau de Parentesco:</td>
    <td><input name="xparentescorecado" type="text" id="xparentescorecado" class="negrito" value="<? echo $parentescorecado;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    </tr>
  <tr>
    <td align="right" class="letra">Telefone:</td>
    <td><input name="xfonerecado" type="text" id="xfonerecado2" class="negrito" value="<? echo $fonerecado;?>" OnKeyPress="formatar(this, '##-####-####')" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    </tr>
  <tr>
    <td align="right" class="letra">&nbsp;</td>
    <td class="branco">&nbsp;</td>
  </tr>
  <tr bgcolor="#007CB9">
    <td align="right" class="letra">&nbsp;</td>
    <td class="branco"><b>EM CASO DE EMERG&Ecirc;NCIA:</b></td>
    </tr>
  <tr>
    <td align="right" class="letra">Nome:</td>
    <td><input name="xnomeemergencia" type="text" id="xnomeemergencia" class="negrito" value="<? echo $nomeemergencia;?>" size="30" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    </tr>
  <tr>
    <td align="right" class="letra">Grau de Parentesco: </td>
    <td><input name="xparentescoemergencia" type="text" id="xparentescoemergencia2" class="negrito" value="<? echo $parentescoemergencia;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    </tr>
  <tr>
    <td align="right" class="letra">Telefone:</td>
    <td><input name="xfoneemergencia" type="text" id="xfoneemergencia2" value="<? echo $foneemergencia;?>" class="negrito" OnKeyPress="formatar(this, '##-####-####')" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    </tr>
  <tr>
    <td align="right" class="letra">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>

   <tr>
    <td align="right">&nbsp;</td>
    <td><input name="Submit" type="submit" class="letro" id="Continuar" onClick="onClickButton(null,'Aguarde...','','Continuar')" value="Continuar" /></td>
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
