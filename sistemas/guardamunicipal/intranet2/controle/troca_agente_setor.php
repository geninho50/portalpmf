<?php
	ini_set('default_charset','UTF-8');

	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$objT = new trataArquivo;
	$objS = new trataString;
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$id = $_GET['id'];
	
	$query = "SELECT * FROM usuario where id=$id";
	$result = $obj->executaQuery($query);
	if( $dados = mysql_fetch_array($result) )
	{
		$idagente = $dados["id"];
		$idgrupo = $dados["grupo"];
		$loginagente = $dados["login"];
	}
	
	$queryG = "SELECT * FROM grupo where id=$idgrupo";
	$resultG = $obj->executaQuery($queryG);
	if( $dadosG = mysql_fetch_array($resultG) )
	{
		$nome = $dadosG["nome"];
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
    <td width="58%" align="right">&nbsp;</td>
  </tr>
</table>
<fieldset>
  <legend class="cabecalho">CADASTRO NOVO GRUPO</legend>
<form name="form1" method="post" action="../classes/controleTrocaGrupo.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="11%" align="right" class="letra">GM:</td>
    <td width="89%" align="left">
      <input name="login" type="text" class="negrito" value="<? echo $loginagente; ?>">	</td>
    </tr>
	<tr>
	  <td align="right" class="letra">Grupo:</td>
	  <td align="left"><input name="grupo" type="text" class="negrito" value="<? echo $nome; ?>">
	  </td>
    </tr>
  <tr>
    <td width="11%" align="right" class="letra">Novo Grupo :</td>
    <td width="89%" align="left"><select name="ygrupo" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" >
      <option value="0">Selecionar novo grupo...</option>
      <?php 
		echo $sqlG = "SELECT * FROM grupo";
		$resultadoG = $obj->executaQuery($sqlG);
		while( $linhaG = mysql_fetch_array($resultadoG) )
		{
			$id = $linhaG["id"];
			$nome = $linhaG["nome"];
		?>
			<option value="<? echo $id;?>"><? echo $nome;?></option>
		<?
		}
	?>
	   </select>	
	 </td>
	</tr>
	<tr>
	  <td align="right">Turno:</td>
	  <td align="left"><select name="turno" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
	   <option value="0">REMOVER DA CHAMADA</option>
	    <option value="1">MATUTINO</option>
	    <option value="2">VESPERTINO</option>
	    <option value="3">ALFA</option>
	    <option value="4">BRAVO</option>
      </select></td>
    </tr>
	<tr>
	<td width="11%" align="right"><span class="letra"></span></td>
	<td width="89%" align="left"><input name="Submit" type="submit" class="letra" id="Submit4" value="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" /></td>
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
</body>
</html>

