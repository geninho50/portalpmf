<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	$obj = new DB_mysql;
	$objT = new trataArquivo;
	$conexao = $obj->conectarConf();

	$termo = "";
	$termo = $_POST['xBusca'];
	$tipo = $_POST['tipo'];
	$livro = trim($termo);
	$tamanho = strlen($termo);
	$nvaloresencontrados = 0;
	
		if($tipo == 1){
			$query = "SELECT * FROM material where codmaterial=$termo order by codmaterial desc";
		}else{
			if($tipo == 2){
			$query = "SELECT * FROM material where UPPER(descricaocurta) like UPPER('%$termo%') order by codmaterial desc";
			}
		}
	
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
	}
	$sqlT = "select * from pre_cautela where status=0";
	$resulT = $obj->executaQuery($sqlT);
	$linhaT = mysql_fetch_array($resulT);
	if( $linhaT )
	{
		$idcautela = $linhaT["id"];
		$prematricula = $linhaT["matricula"];
	}
	
	$data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");

	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
		$matricula = $linha["matricula"];
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
    <td width="100%" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
     	  <tr>
	  		<!--lado esquerdo-->
        	<td width="50%" valign="top">
				<fieldset>
				<legend class="cabecalho">CAUTELA DE MATERIAL</legend>
					<form name="form1" method="post" action="cautela_material.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
					<INPUT TYPE="hidden" name="cadastro" value="true">
						<table width="100%" border="0" cellspacing="1" cellpadding="1">
				  			<tr>
								<td width="45%" align="right" class="letra">Digite o <B>C&oacute;digo ou Nome</B> da Mercadoria:</td>
								<td width="42%"><input name="xBusca" type="text" class="negrito" size="30" value="<?echo $xBusca;?>"/></td>
								<td width="13%">&nbsp;</td>
				  			</tr>
				  			<tr>
								<td align="right" class="letra">&nbsp;</td>
								<td class="letra"><input name="tipo" type="radio" value="1" class="negrito" />
								  C&oacute;digo
								  <input name="tipo" type="radio" value="2" class="negrito" checked/>
								  Nome</td>
								<td>&nbsp;</td>
				 			</tr>
				  			<tr>
								<td align="right">&nbsp;</td>
								<td><input name="Submit" type="submit" class="letra" id="Pesquisar" value="Pesquisar" onclick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
				  			</tr>
						</table>
				</form>
				</fieldset>

<?php
	if( $nvaloresencontrados > 0 )
	{
?>
<fieldset>
	<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA <?echo $termo;?></legend>
<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
	<tr>
		<td width="6%" align="center" class="branco">&nbsp;</td>
		<td width="35%" align="center" class="branco"><B>Material</B></td>
		<td width="59%" align="center" class="branco"><B>Descriç&atilde;o</B></td>
		</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$resultado = $obj->executaQuery($query);
	while($linha=mysql_fetch_array($resultado))
	{		
		// Tratando o tamanho do nome da notícia
		$descricaolonga = $obj->retornaSringTamanho($linha['descricaolonga'],150);
		$departamento = $linha['departamento'];
		$descricaocurta = $linha['descricaocurta'];
		$codmaterial = $linha['codmaterial'];
		$idmaterial = $linha['id'];
		
		
?>
	<tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>">
		<td width="6%" align="center" class="negrito">
		<a href="cadastro_cautela_material.php?idmaterial=<? echo $idmaterial;?>&idcautela=<? echo $idcautela;?>"><img src="imagens/troca.png" width="21" height="21" border="0" /></a>
		</td>
		<td width="35%" align="left" class="negrito"><? echo $descricaocurta;?></td>
		<td width="59%" align="left" class="negrito"><? echo $descricaolonga;?></td>
	</tr>
	
<?php
	}
?>
	
</table>


</fieldset>
<?php
	}

	if( $nvaloresencontrados == 0 && $tamanho > 0 )
	{
		
?>
<fieldset>
	<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA <?echo $termo;?></legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">

	<tr>
		<td width="100%" colspan="3" align="center" class="letra">Nenhuma ocorr&ecirc;ncia para <B><?echo $termo;?></B></td>
	</tr>
	
</table>
</fieldset>
<?php	
	}
?>
			</td>
			<!--lado direito-->
			<td width="50%" valign="top">
			
			<fieldset>
	<legend class="cabecalho">LISTA DE MATERIAL EM PROCESSO DE CAUTELA</legend>
<form name="form1" action="../classes/controleConfirmarCautela.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
    <table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
	<tr>
		<td width="15%" align="center" class="branco">&nbsp;</td>
		<td width="13%" align="center" class="branco"><B>QTD</B></td>
		<td width="66%" align="center" class="branco"><B>Descriç&atilde;o</B></td>
		</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$query = "select material.descricaolonga,cautela.idmaterial,cautela.idcautela,cautela.qtd from cautela inner join material where cautela.idmaterial=material.id and cautela.status=0 order by cautela.id asc";
	$resultado = $obj->executaQuery($query);
	while($linha=mysql_fetch_array($resultado))
	{		
		// Tratando o tamanho do nome da notícia
		$descricaolonga = $obj->retornaSringTamanho($linha['descricaolonga'],150);
		$idmaterial = $linha['idmaterial'];
		$qtd = $linha['qtd'];
		$idcautela = $linha['idcautela'];
?>
	<tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>">

		<td width="15%" align="center" class="negrito"><input name="idmaterial" type="text" value="<?php echo $idmaterial; ?>" size="2" readonly="readonly"/></td>
		<td width="13%" align="center" class="negrito"><?php echo $qtd; ?></td>
		<td width="57%" align="left" class="negrito"><?php echo $descricaolonga; ?></td>
		<td width="9%" align="center" class="negrito"><a href="../classes/controleExcluirCautela.php?idmaterial=<? echo $idmaterial;?>"><img src="imagens/excluir.png" width="21" height="21" border="0" /></a></td>
		</tr>
<?php
	}
?>
	
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="24%" align="right"><span class="negrito">
      <input name="idcautela" type="text" id="idcautela" class="negrito" value="<?php echo $idcautela; ?>" size="10" readonly="readonly"/>
    </span></td>
    <td width="76%" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td width="24%" align="right" class="negrito">GM4<input name="xmatriculagm4" maxlength="6" type="text" class="negrito" value="<?php echo $matricula; ?>" size="10" readonly="readonly"/></td>
    <td width="76%" class="negrito"><input name="xsenhagm4" type="password" size="10" class="negrito" />Senha</td>
  </tr>
  <tr>
    <td align="right" class="negrito">Matricula<input name="xmatriculaguarda" maxlength="6" type="text" size="10" class="negrito" value="<? echo $prematricula;?>" /></td>
    <td align="left" class="negrito"><input name="xsenhaguarda" type="password" size="10" class="negrito" />Senha</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="Submit" type="submit" id="Confirmar" class="letra" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
  </tr>
</table>
</form>

</fieldset>
			
			</td>
		  </tr>
   	  </table>
	</td>
  </tr>
</table>
	<!--fim adm-->
	</td>
  </tr>
</table>


</body>
</html>