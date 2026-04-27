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
	
	$idEspecie = 0;
	$idEspecie = $_GET['idEspecie'];
	if( $idEspecie == 0 )
	{
		$idEspecie = $_POST['idEspecie'];
	}
	
	if( $idEspecie > 0 )
	{		
		$query = "SELECT * FROM especie where id=$idEspecie";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$id = $linha["id"];
			$especie = $linha["especie"];
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
	<form name="form" action="../classes/controleEspecieVeiculo.php" method="post" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Continuar','Continuar')">

<table width="100%" border="0" cellspacing="1" cellpadding="1">
 <tr>
    <td width="14%" align="right" class="letra">Especie:</td>
    <td width="86%">
    <input name="idEspecie" type="text" class="negrito" id="idEspecie" value="<? echo $idEspecie;?>" size="5" readonly="readonly"/>
    <input name="xespecie" type="text" class="negrito" id="xespecie" value="<? echo $especie;?>" size="30" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
    </td>
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
	<legend class="cabecalho">LISTA DAS ESPÉCIES DE VEÍCULOS</legend>
<table width="100%"  border="0">
  <?
 		$queryE = "SELECT * FROM especie";
		$resultadoE = $obj->executaQuery($queryE);
		while( $linhaE = mysql_fetch_array($resultadoE) )
		{
			$id = $linhaE["id"];
			$especie = $linhaE["especie"];
		
  ?>
  <tr>
    <td width="14%" align="right">&nbsp;</td>
    <td width="86%" align="left" class="negrito"><a href="cadastro_especie_veiculo.php?idEspecie=<? echo $id; ?>"><? echo $especie; ?></a></td>
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