<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql ;
	$objS = new trataString;
	$conexao = $obj->conectarConf();
	
	$idTipo = 0;
	$idTipo = $_GET['idTipo'];
	if( $idTipo == 0 )
	{
		$idTipo = $_POST['idTipo'];
	}
	
	if( $idTipo > 0 )
	{		
		$query = "SELECT * FROM tipo where id=$idTipo";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$id = $linha["id"];
			$idespecie = $linha["idespecie"];
			$tipo = $linha["tipo"];
		}
	}
	
	//Pega a data atual
    $data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultadoG = $obj->executaQuery($sql);
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
    <td width="42%" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CADASTRO ESPÉCIE DE VEÍCULO</legend>
	<form name="form" action="../classes/controleTipoVeiculo.php" method="post" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Continuar','Continuar')">

<table width="100%" border="0" cellspacing="1" cellpadding="1">
 <tr>
    <td width="14%" align="right" class="letra">Espécie:</td>
    <td width="86%"><select name="yespecie" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
      <option value="0">Selecionar...</option>
	  <?
      	$queryE = "SELECT * FROM especie";
		$resultadoE = $obj->executaQuery($queryE);
		while( $linhaE = mysql_fetch_array($resultadoE) )
		{
			$id = $linhaE["id"];
			$especie = $linhaE["especie"];
	  ?>
      
      <option value="<? echo $id; ?>"><? echo $especie;?></option>
	<?
		}
	?>
    </select></td>
    </tr>
  <tr>
    <td align="right" class="letra">Tipo:</td>
    <td><input name="xtipo" type="text" class="negrito" id="xtipo" value="<? echo $tipo;?>" size="30" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input name="Submit" type="submit" class="letra" id="Continuar" onClick="onClickButton(null,'Aguarde...','','Continuar')" value="Cadastrar" /></td>
    </tr>

</table>
</form>
</fieldset>
<fieldset>
	<legend class="cabecalho">LISTA DE ESPÉCIE DE VEÍCULOS</legend>
<table width="50%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#666" style="border-collapse: collapse">
  <?
 		$queryE = "SELECT * FROM especie";
		$resultadoE = $obj->executaQuery($queryE);
		while( $linhaE = mysql_fetch_array($resultadoE) )
		{
			$id = $linhaE["id"];
			$especie = $linhaE["especie"];
		
  ?>
  <tr>
    <td width="25%" align="right" valign="top" class="negrito" bgcolor="#E4E4E4"><? echo $especie; ?>:</td>
    <td width="75%" align="left">
	<? 
		$queryT = "SELECT * FROM tipo where idespecie=$id";
		$resultadoT = $obj->executaQuery($queryT);
		while( $linhaT = mysql_fetch_array($resultadoT) )
		{
			$idT = $linhaT["id"];
			echo'&nbsp;<font class="letra">'.$tipo = $linhaT["tipo"].'</font>&nbsp;<br>';	
		}
	?>
    </td>
  </tr>
  <?
  		}
  ?>
</table>
</fieldset>
	<!--fim adm-->	</td>
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