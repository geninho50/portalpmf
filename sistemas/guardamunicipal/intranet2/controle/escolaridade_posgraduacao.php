<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	$matricula = $_GET['matricula'];
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql ;
	$conexao = $obj->conectarConf();
	
	$query = "SELECT * FROM posgraduacao where matricula=$matricula";
	$resultado = $obj->executaQuery($query);
	if( $linha = mysql_fetch_array($resultado) )
	{
		$id = $linha["id"];
		$cursoposgraduacao = $linha["cursoposgraduacao"];
		$instensino = $linha["instensino"];
		$numhoras = $linha["numhoras"];
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
	<legend class="cabecalho">CADASTRO INFORMAÇÕES PÓS-GRADUAÇÃO</legend>

    <table width="100%"  border="0">
      <tr>
        <td width="7%" align="center">&nbsp;</td>
        <td width="14%" align="center"><a href="javascript:POPUP('escolaridade_graduacao.php?matricula=<? echo $matricula; ?>','750','650')"><img src="imagens/graduacao.png" width="60" height="60" border="0" title="ADICIONAR INFORMA&Ccedil;&Otilde;ES DA GRADUA&Ccedil;&Atilde;O" /></a></td>
        <td width="14%" align="center"><a href="javascript:POPUP('escolaridade_posgraduacao.php?matricula=<? echo $matricula; ?>','750','650')"><img src="imagens/posgraduacao.png" width="60" height="60" border="0" title="ADICIONAR INFORMA&Ccedil;&Otilde;ES DA P&Oacute;S-GRADUA&Ccedil;&Atilde;O" /></a></td>
        <td width="14%" align="center"><a href="javascript:POPUP('escolaridade_cursos.php?matricula=<? echo $matricula; ?>','750','650')"><img src="imagens/cursos.png" width="60" height="60" border="0" title="ADICIONAR INFORMA&Ccedil;&Otilde;ES DE CURSOS" /></a></td>
        <td width="51%" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">Gradua&ccedil;&atilde;o</td>
        <td align="center" class="negrito">P&oacute;s-Gradua&ccedil;&atilde;o</td>
        <td align="center" class="negrito">Cursos</td>
        <td align="center" class="negrito">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
      </tr>
    </table>
    <form name="form" action="../classes/controleUsuarioEscolaridade.php" method="post" onSubmit="return validaFormAll(this,'Continuar','Continuar')">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td align="right" class="letra">&nbsp;</td>
    <td class="white"><input name="matricula" type="text" size="10" readonly="readonly" class="negrito" value="<? echo $matricula; ?>" />
      <input name="tipo" type="text" id="tipo" value="posgraduacao" size="12" readonly="readonly" /></td>
    <td width="0%" align="right">&nbsp;</td>
    <td width="0%">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top" class="letra">Curso(s) de P&oacute;s-Gradua&ccedil;&atilde;o:<br></td>
    <td><input name="cursoposgraduacao" type="text" id="cursoposgraduacao" class="negrito" value="<? echo $cursoposgraduacao; ?>" size="60" onkeyup="converteUpper(this);"/>
      (Lato Sensu / Strict Sensu)</td>
    </tr>
  
 <!--dados do curso-->
  <tr>
    <td align="right" valign="top" class="letra">Institui&ccedil;&atilde;o de Ensino: </td>
    <td class="bignum"><input name="instensino" type="text" id="instensino" class="negrito" value="<? echo $instensino; ?>" size="60" onkeyup="converteUpper(this);"/></td>
  </tr>
  <tr>
    <td align="right" valign="top" class="letra">N&ordm; de horas: </td>
    <td class="bignum"><input name="numhoras" type="text" id="numhoras" class="negrito" value="<? echo $numhoras; ?>" size="8"/></td>
  </tr>
  <tr>
    <td align="right" valign="top" class="letra">&nbsp;</td>
    <td class="bignum">&nbsp;</td>
    </tr>
   <tr>
    <td align="right">&nbsp;</td>
    <td><input name="Submit" type="submit" class="letra" id="Continuar" onClick="onClickButton(null,'Aguarde...','','Continuar')" value="Continuar" /></td>
    </tr>

</table>
</form>
</fieldset>
	<!--fim adm-->
	
	<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
  <tr>
    <td width="51%" class="branco">Nome do Curso</td>
    <td width="33%" class="branco">Instituicao de Insino</td>
	<td width="16%" class="branco">Horas</td>
  </tr>
 </table>
 <table width="100%"  border="0" cellspacing="1" cellpadding="1">
<? 
	$sqlG = "SELECT * FROM posgraduacao where matricula=$matricula";
	$resultadoG = $obj->executaQuery($sqlG);
	while($linhaG = mysql_fetch_array($resultadoG)){
?>
  <tr>
    <td width="51%" class="negrito"><? echo $linhaG['cursoposgraduacao']?></td>
    <td width="33%" class="negrito"><? echo $linhaG['instensino']?></td>
	<td width="16%" class="negrito"><? echo $linhaG['numhoras']?>h</td>
  </tr>
<? 
	}
?> 
  
</table>

	
	</td>
  </tr>
</table>


</body>
</html>
