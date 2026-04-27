<?php
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
	header('Content-Type: text/html; charset=iso-8859-1');
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
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">
	<?php 
		$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$resultado = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$login = $linha["login"];
			
			include("menu.php");
		}
	?>
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<fieldset>
	<legend class="fieldset">Cadastrar Novo Grupo </legend>
<form name="form1" method="post" action="../classes/controleTrocaGrupo.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="8%" align="right" class="letra">GM:</td>
    <td width="92%" align="left">
      <input name="login" type="text" value="<? echo $loginagente; ?>">	</td>
    </tr>
	<tr>
	  <td align="right" class="letra">Grupo:</td>
	  <td align="left"><input name="grupo" type="text" value="<? echo $nome; ?>">
	  </td>
    </tr>
  <tr>
    <td width="8%" align="right" class="letra">Novo Grupo :</td>
    <td width="92%" align="left"><select name="ygrupo">
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
	<td width="8%" align="right"><span class="letra"></span></td>
	<td width="92%" align="left"><input name="Submit" type="submit" class="botao" id="Submit4" value="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" /></td>
    </tr>

</table>
</form>
</fieldset>
</body>
</html>

