<?php
	
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	//$idFuncionario = $_GET['idFuncionario'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$conexao = new DB_mysql ;
	$objT = new trataArquivo;
	$objS = new trataString;
	$idsubgrupo = 0;
	$idsubgrupo = $_GET['idsubgrupo'];
	if( $idsubgrupo == 0 )
	{
		$idsubgrupo = $_POST['idsubgrupo'];
	}
	
	if( $idsubgrupo > 0 )
	{		
		$conexao->conectarConf();
		$query = "SELECT * FROM subgrupo_material where id=$idgrupo";
		$resultado = $conexao->executaQuery($query);
		$linhaG = mysql_fetch_array($resultado);
		if( $linhaG )
		{
			$idsubgrupo = $linhaG["id"];
			$nomesubgrupo = $linhaG["nome"];
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CADASTRO DE GRUPOS</legend>

    <form name="form" action="../classes/controleSubGrupoMaterial.php" method="post" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Continuar','Continuar')">

<table width="100%" border="0" cellspacing="1" cellpadding="1">

<!--dados da matricula-->
 <tr>
   <td align="right" class="letra">Grupo:</td>
   <td>
   <select name="ygrupo" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
        <option value="0">Selecionar...</option>
        <?
	  	$queryD = "SELECT * FROM grupo_material";
		$resultadoD = $conexao->executaQuery($queryD);
		while($linhaD = mysql_fetch_array($resultadoD))
		{
			$id = $linhaD["id"];
			$nome = $linhaD["nome"];
	  ?>
        <option value="<? echo $nome;?>"><? echo $nome;?></option>
        <?
		}
	  ?>
      </select>
   </td>
 </tr>
 <tr>
    <td width="14%" align="right" class="letra">SubGrupo:</td>
    <td width="86%">
		<input name="xsubgrupo" type="text" class="negrito" id="xsubgrupo" value="<? echo $nomesubgrupo;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input name="Submit" type="submit" class="letra" id="Continuar" onClick="onClickButton(null,'Aguarde...','','Continuar')" value="Continuar" /></td>
    </tr>

</table>
</form>
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
<br>
<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
  <tr>
    <td width="92%" class="branco">Grupo</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
  </tr>
  </table>
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
  <?
  	$chavet = true;
	$conexao->conectarConf();
	$query = "SELECT * FROM subgrupo_material";
	$resultado = $conexao->executaQuery($query);
	while($linhaG = mysql_fetch_array($resultado))
	{
		$id = $linhaG["id"];
		$nome = $linhaG["nome"];
  ?>	
  <tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>" >
    <td width="92%" class="negrito"><? echo $nome; ?></td>
    <td width="4%" align="center"><a href="cadastro_subgrupo_material.php?idsubgrupo=<? echo $id;?>"><img src="imagens/atualizar.png" width="24" height="24" border="0" /></a></td>
    <td width="4%" align="center"><a href="../classes/controleSubGrupoMaterial.php?idsubgrupo=<? echo $id;?>"><img src="imagens/excluir.png" width="24" height="24" border="0" /></a></td>
  </tr>
  <?
  }
  ?>
</table>


</body>
</html>