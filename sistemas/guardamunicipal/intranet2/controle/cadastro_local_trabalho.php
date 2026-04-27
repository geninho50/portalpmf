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
	  <legend class="cabecalho">CONTROLE INFORMAÇÕES INSTATUCIONAL</legend>

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
    <form name="form" action="../classes/controleLocalTrabalho.php" method="post" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="16%" align="right" class="letra">&nbsp;</td>
    <td width="84%" class="white"><input name="matricula" type="text" size="15" readonly="readonly" value="<? echo $matricula; ?>" /></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top" class="letra">Local de Trabalho:<font color="#FF0000">*</font></td>
    <td><input name="xlocaltrabalho" type="text" id="xlocaltrabalho" class="negrito" value="<? echo $localtrabalho; ?>" size="50" onkeyup="converteUpper(this);" /></td>
  </tr>

 <!--dados do curso-->
  <tr>
    <td align="right" class="letra">Data:<font color="#FF0000">*</font></td>
    <td>
	<input type="text" value="<? echo $dataini;?>" readonly name="dataini" class="negrito" size="12" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" />
		  <a onClick="displayCalendar(document.forms[0].dataini,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' tille='SELECIONE A DATA'></a> 
	</td>
    </tr>
   <tr>
    <td align="right">&nbsp;</td>
    <td><input name="Submit" type="submit" class="botao" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
    </tr>

</table>
</form>
</fieldset>
	<!--fim adm-->
	
	<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
  <tr>
    <td width="14%" class="branco">Local de Trabalho </td>
	<td width="14%" class="branco">Data de Entrada </td>
	
  </tr>
 </table>
 <table width="100%"  border="0" cellspacing="1" cellpadding="1">
<? 
	$sqlG = "SELECT localtrabalho,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM localtrabalho where matricula='$matricula' order by id desc";
	$resultadoG = $conexao->executaQuery($sqlG);
	while($linhaG = mysql_fetch_array($resultadoG)){
		$localtrabalho = $linhaG['localtrabalho'];
		$dia = $linhaG['dia'];
		$mes = $linhaG['mes'];
		$ano = $linhaG['ano'];
?>
  <tr>
    <td width="14%" class="negrito"><? echo $localtrabalho;?></td>
	<td width="14%" class="negrito"><? echo $dia."-".$mes."-".$ano;?></td>
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
