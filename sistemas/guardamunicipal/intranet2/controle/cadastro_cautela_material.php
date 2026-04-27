<?php
	ini_set('default_charset','UTF-8');
	
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
	ini_set('default_charset','UTF-8');
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	//$idFuncionario = $_GET['idFuncionario'];
	require ("../classes/DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	
	$idmaterial = $_GET['idmaterial'];
	$idcautela = $_GET['idcautela'];
	$query = "SELECT * FROM material where id=$idmaterial";
	$resultado = $conexao->executaQuery($query);
	$linha=mysql_fetch_array($resultado);
	if($linha)
	{		
		// Tratando o tamanho do nome da notícia
		$descricaolonga = $conexao->retornaSringTamanho($linha['descricaolonga'],150);
		$grupo = $linha['grupo'];
		$subgrupo = $linha['subgrupo'];
		$descricaocurta = $linha['descricaocurta'];
		$codmaterial = $linha['codmaterial'];
		$tamanho = $linha['tamanho'];
		$sessao = $linha['sessao'];
		$prateleira = $linha['prateleira'];
		$coluna = $linha['coluna'];
		$data_validade = $linha['datavalidade'];
		$idmaterial = $linha['id'];
	}
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultadoG = $conexao->executaQuery($sql);
	$linhaG = mysql_fetch_array($resultadoG);
	if( $linhaG )
	{
		$login = $linhaG["login"];
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CADASTRO CAUTELA DE MATERIAL</legend>

    <form name="form" action="../classes/controleCautelaMaterial.php" method="post" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Continuar','Continuar')">

<table width="100%" border="0" cellspacing="1" cellpadding="1">
 <tr>
   <td align="right" class="letra">&nbsp;</td>
   <td width="64%" colspan="5"><input name="idmaterial" type="text" class="negrito" id="idmaterial" value="<? echo $idmaterial;?>" readonly="readonly" size="5"/>
   <input name="idcautela" type="text" class="negrito" id="idcautela" value="<? echo $idcautela;?>" readonly="readonly" size="5"/></td>
 </tr>
 <tr>
   <td align="right" class="letra">GM4:</td>
   <td colspan="5"><input name="login" type="text" class="negrito" id="login" value="<? echo $login;?>" readonly="readonly"/></td>
 </tr>
 <tr>
    <td align="right" class="letra">C&oacute;digo do Material:</td>
    <td colspan="5"><input name="codmaterial" type="text" class="negrito" id="codmaterial" value="<? echo $codmaterial;?>" readonly="readonly"/></td>
    </tr>
 <tr>
   <td align="right" class="letra">Grupo:</td>
   <td colspan="5"><input name="grupo" type="text" class="negrito" maxlength="6" id="grupo" value="<? echo $grupo;?>" readonly="readonly"/></td>
 </tr>
 <tr>
    <td width="36%" align="right" class="letra">SubGrupo:</td>
    <td colspan="5"><input name="subgrupo" type="text" class="negrito" maxlength="6" id="subgrupo" value="<? echo $subgrupo;?>" readonly="readonly"/></td>
    </tr> 
  <tr>
    <td width="36%" align="right" class="letra">Descri&ccedil;&atilde;o Curta:</td>
    <td colspan="5"><input name="xdescricaocurta" type="text" class="negrito" id="xdescricaocurta" readonly="readonly" value="<? echo $descricaocurta;?>" size="30" onkeyup="converteUpper(this);"/>
      </td>
    </tr>
 <tr>
   <td align="right" valign="top" class="letra">Descri&ccedil;&atilde;o T&eacute;cnica:</td>
   <td colspan="5"><textarea name="descricaolonga" cols="60" readonly="readonly" rows="4" onkeyup="converteUpper(this);"><? echo $descricaolonga;?></textarea></td>
   </tr>
 <tr>
   <td align="right" class="letra">Tamanho:</td>
   <td colspan="5"><input name="tamanho" type="text" readonly="readonly" id="tamanho" class="negrito" onkeyup="converteUpper(this);" value="<? echo $tamanho;?>" size="5" maxlength="4"/>    </td>
 </tr>
  <tr>
    <td align="right" class="letra">Data Validade:</td>
    <td colspan="5"><input name="datavalidade" class="negrito" readonly="readonly"  id="datavalidade" size="10" value="<? echo $data_validade;?>">
      </td>
  </tr>
  
 <!--dados do numero--> 
  <tr>
    <td align="right" class="letra">Quantidade:</td>
    <td colspan="5"><input name="xqtd" type="text" id="xqtd" class="negrito"  value="<? echo $qtd;?>" size="5" maxlength="4" /></td>
    </tr>
  
 <!--dados do sangue-->
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="5"><input name="Submit" type="submit" class="letra" id="Continuar" onClick="onClickButton(null,'Aguarde...','','Continuar')" value="Cadastrar" /></td>
    </tr>

</table>
</form>
</fieldset>

<!--fim adm-->	</td>
  </tr>
</table>

</body>
</html>