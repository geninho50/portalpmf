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
	$conexao = new DB_mysql ;
	$objS = new trataString;

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
	  <legend class="cabecalho">CONTROLE INFORMAÇÕES INSTITUCIONAL</legend>

    <table width="100%"  border="0">
      <tr>
        <td width="6%" align="center">&nbsp;</td>
        <td width="14%" align="center"><a href="javascript:POPUP('cadastro_local_trabalho.php?matricula=<? echo $matricula; ?>','750','650')"><img src="imagens/local_trabalho.png" width="60" height="60" border="0" title="ADICIONAR INFORMA&Ccedil;&Otilde;ES DO LOCAL DE TRABALHO" /></a></td>
        <td width="14%" align="center"><a href="javascript:POPUP('cadastro_notas.php?matricula=<? echo $matricula; ?>','750','650')"><img src="imagens/notas.png" width="60" height="60" border="0" title="ADICIONAR INFORMA&Ccedil;&Otilde;ES DAS NOTAS" /></a></td>
        <td width="15%" align="center"><a href="javascript:POPUP('cadastro_atividades_extras.php?matricula=<? echo $matricula; ?>','750','650')"><img src="imagens/bloco_notas.png" width="60" height="60" border="0" title="ADICIONAR ATIVIDADES EXTRAS" /></a></td>
        <td width="18%" align="center"><a href="anexar_documentos.php?matricula=<? echo $matricula; ?>"><img src="imagens/anexar.png" width="60" height="60" border="0" /></a></td>
        <td width="33%" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">Local de Trabalho</td>
        <td align="center" class="negrito">Notas</td>
        <td align="center" class="negrito">Projetos Apresentados</td>
        <td align="center" class="negrito">Anexar Documentos </td>
        <td align="center" class="negrito">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
      </tr>
    </table>
    <form name="form" action="../classes/controleUsuarioInstitucional.php" method="post" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="16%" align="right" class="letra">&nbsp;</td>
    <td width="84%" class="white"><input name="matricula" type="text" size="15" readonly="readonly" value="<? echo $matricula; ?>" /></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="letra">Concurso:</td>
    <td>Posi&ccedil;&atilde;o:
      <input name="xconcursoposicao" type="text" id="xconcursoposicao" class="negrito" value="<? echo $concursoposicao; ?>" size="5" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
      Nota:
      <input name="xconcursonota" type="text" id="xconcursonota" class="negrito" value="<? echo $concursonota; ?>" size="5" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
  </tr>
  <tr>
    <td align="right" class="letra">Curso:</td>
    <td>Posi&ccedil;&atilde;o:
      <input name="xcursoposicao" type="text" id="xcursoposicao" class="negrito" value="<? echo $xcursonota; ?>" size="5" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
Nota:
<input name="xcursonota" type="text" id="xcursonota" class="negrito" value="<? echo $cursonota; ?>" size="5" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
  </tr>

 <!--dados do curso-->
  <tr>
    <td align="right" class="letra">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
   <tr>
    <td align="right">&nbsp;</td>
    <td><input name="Submit" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
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

	<!--fim adm-->
	
	<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
  <tr>
    <td width="14%" class="branco">Posicao/Nota Concurso</td>
	<td width="14%" class="branco">Posicao/Nota Curso</td>
	
  </tr>
 </table>
 <table width="100%"  border="0" cellspacing="1" cellpadding="1">
<? 
	$sqlG = "SELECT * FROM institucional where matricula='$matricula'";
	$resultadoG = $conexao->executaQuery($sqlG);
	while($linhaG = mysql_fetch_array($resultadoG)){
?>
  <tr>
    <td width="14%" class="negrito"><? echo $linhaG['concursoposicao'].' - '.$linhaG['concursonota'];?></td>
	<td width="14%" class="negrito"><? echo $linhaG['cursoposicao'].' - '.$linhaG['cursonota'];?></td>
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
