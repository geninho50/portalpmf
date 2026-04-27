<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	// Realiza a consulta ao banco;
	$ygmsolicitante = "";
	$ygmsolicitante = mysql_escape_string($_POST['xguarda']);
	
	$ygmsolicitante = trim($ygmsolicitante);
	$tamanho = strlen($ygmsolicitante);
	$nvaloresencontrados = 0;
	
		if($tamanho > 0 ){
			$query = "SELECT * FROM folga where UPPER(guarda) like UPPER('%$ygmsolicitante%') order by data desc";
			}
	
	//echo ''.$query;
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CONSULTAR FOLGA</legend>
	<form name="form1" method="post" action="busca_folga.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
	
	<INPUT TYPE="hidden" name="cadastro" value="true">
	
	<table width="67%" border="0" cellspacing="1" cellpadding="1">
	
	  <tr>
		<td width="20%" align="right" class="letra">Solicitante:</td>
		<td width="53%">
        <input type="text" class="codigo" name="xguarda" id="xguarda" size="20" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
        </td>
		<td width="27%" align="right">&nbsp;</td>
		</tr>
	
	  <tr>
		<td align="right" class="letra">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="27%">    </tr>
	  <tr>
		<td align="right">&nbsp;</td>
		<td><input name="Submit" type="submit" class="letra" id="Submit3" value="Pesquisar" onClick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
		<td width="27%">    </tr>
	
	</table>
	
	</form>
	</fieldset>
	
	<?php
		if( $nvaloresencontrados > 0 )
		{
	?>
	<fieldset>
		<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA <?echo $ygmsolicitante;?></legend>
	
	<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
		<tr>
			<td width="11%" align="left" class="branco"><B>Nome</B></td>				
			<td width="70%" align="left" class="branco"><B>Descricao</B></td>
			<td width="8%" align="center" class="branco"><B>Qtade Atual</B></td>
			<td width="7%" align="center" class="branco"><B>Pendentes</B></td>
			<td width="2%" align="left" class="branco">&nbsp;</td>
			<td width="2%" align="left" class="branco">&nbsp;</td>
		</tr> 
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<?php
		$chavet = true;
		$resultado = $obj->executaQuery($query);
		while ( $linha = mysql_fetch_array($resultado) )
		{		
			$idfolga = $linha['id'];
			$solicitante = $linha['guarda'];
			$descricao = $linha['descricao'];
			$qtade = $linha['qtade'];
			$qtadeatual = $linha['qtadeatual'];
			
			$result = $qtade - $qtadeatual;
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
			<td width="11%" align="left" class="negrito"><? echo $solicitante; ?></td>		
			<td width="70%" align="left" class="negrito"><? echo $descricao; ?></td>
			<td width="8%" align="center" class="negrito"><? echo $qtade; ?></td>
			<td width="7%" align="center" class="negrito"><? echo $result; ?></td>
			<td width="2%" align="center" class="negrito"><a onClick="Excluir('../classes/controleFolga.php?id=<? echo $linha['id']; ?>')" href="#"><IMG SRC="imagens/excluir.png" WIDTH="18" HEIGHT="18" BORDER="0" TITLE="EXCLUIR"></A></td>
			<td width="2%" class="letra" align="center"><a href="cadastro_pedido_folga_chefia.php?idfolga=<? echo $linha['id']; ?>&login=<? echo $solicitante;?>"><IMG SRC="imagens/editor_texto.png" WIDTH="18" HEIGHT="18" BORDER="0" TITLE="PEDIDO"></A></td>
		</tr>
	
	<?php
		}
	?>
		
	</table>
	
	</fieldset>
	
	</td>
  </tr> 
		
	</table>
	
	
	<?php
		}
	
		if( $nvaloresencontrados == 0 && $tamanho > 0 )
		{
			
	?>
	
	<fieldset>
		<legend class="cabecalho">RESULTADO(s) <B><? echo $nvaloresencontrados;?></B> PARA <? echo $ygmsolicitante;?></legend>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td width="100%" colspan="3" align="center" class="negrito">Nenhuma ocorr&ecirc;ncia para <B><?echo $ygmsolicitante;?></B></td>
		</tr>	
	</table>
	</fieldset>
	
	<?php	
		}
	?>
	<!--fim adm-->
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="14%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="86%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>

</body>
</html>

<?php
	// Fechando as vari�veis de conex�o
	$obj->closeVar($conexao);
	$obj->closeVar($xBusca);
	$obj->closeVar($tamanho);
	$obj->closeVar($nvaloresencontrados);
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>