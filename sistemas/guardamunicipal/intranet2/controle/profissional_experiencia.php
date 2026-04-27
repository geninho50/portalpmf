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
	
	$query = "SELECT * FROM esperiencia where matricula=$matricula";
	$resultado = $obj->executaQuery($query);
	if( $linha = mysql_fetch_array($resultado) )
	{
		$id = $linha["id"];
		$experiencia = $linha["experiencia"];
		$tempo = $linha["tempo"];
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
	<legend class="cabecalho">CADASTRO DE EXPERIÊNCIA PROFISSIONAL</legend>

<table width="100%"  border="0">
      <tr>
        <td width="16%" align="center">&nbsp;</td>
        <td width="13%" align="center"><a href="profissional_conhecimento_especifico.php?matricula=<? echo $matricula; ?>"><img src="imagens/cursos.png" width="60" height="60" border="0" /></a></td>
        <td width="12%" align="center"><a href="profissional_esperiencia.php?matricula=<? echo $matricula; ?>"><img src="imagens/esperiencia.png" width="60" height="60" border="0" /></a></td>
        <td width="59%" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">Conhecimentos Espec&iacute;ficos </td>
        <td align="center" class="negrito">Experi&ecirc;ncias Profissionais </td>
        <td align="center" class="negrito">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
      </tr>
</table>

<form name="form" action="../classes/controleUsuarioProfissional.php" method="post" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="22%" align="right" class="letra">&nbsp;</td>
    <td width="78%" class="white"><input name="matricula" type="text" size="7" readonly="readonly" value="<? echo $matricula; ?>" />
      <input name="tipo" type="text" size="12" readonly="readonly" value="experiencia" /></td>
    <td width="0%" align="right">&nbsp;</td>
    <td width="0%">&nbsp;</td>
  </tr>

  <tr>
    <td align="right" valign="top" class="letra">Experi&ecirc;ncias Profissionais:</td>
    <td class="bignum"><input name="experiencia" type="text" id="esperiencia" class="negrito" value="<? echo $experiencia;?>" size="60"  onkeyup="converteUpper(this);"/></td>
    </tr>
  <tr>
    <td align="right" class="letra">Empresa:</td>
    <td><span class="bignum">
      <input name="empresa" type="text" id="empresa" class="negrito" value="<? echo $empresa;?>" size="60"  onkeyup="converteUpper(this);"/>
    </span></td>
  </tr>
  <tr>
    <td align="right" class="letra">Tempo:</td>
    <td><span class="white">
      <input name="tempo" type="text" id="tempo" class="negrito" value="<? echo $tempo; ?>" size="7"/>
    </span></td>
  </tr>
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
	<!--fim adm-->
	<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
  <tr>
    <td width="47%" class="branco">Experiencia</td>
	<td width="41%" class="branco">Empresa</td>
	<td width="12%" class="branco">Tempo</td>
	
  </tr>
 </table>
 <table width="100%"  border="0" cellspacing="1" cellpadding="1">
<? 
	$sqlG = "SELECT * FROM experiencia where matricula=$matricula";
	$resultadoG = $obj->executaQuery($sqlG);
	while($linhaG = mysql_fetch_array($resultadoG)){
?>
  <tr>
    <td width="47%" class="negrito"><? echo $linhaG['experiencia']?></td>
    <td width="41%" class="negrito"><? echo $linhaG['empresa']?></td>
	<td width="12%" class="negrito"><? echo $linhaG['tempo']?></td>
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
