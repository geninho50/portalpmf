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
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	//Pega a data atual
    $data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");
	
	// Realiza a consulta ao banco;
	$xBusca = "";
	$xBusca = $_POST['xBusca'];
	$xBusca = trim($xBusca);
	$tamanho = strlen($xBusca);
	$nvaloresencontrados = 0;
	$query = "SELECT * FROM guarda_gmf where UPPER(nome) like UPPER('%$xBusca%') order by login asc";
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

</head>

<body> 
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="100%" colspan="2">
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CONSULTAR FUNCIONÁRIO</legend>
<form name="form" method="post" action="busca_funcionario.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="67%" border="0" cellspacing="1" cellpadding="1">

  <tr>
    <td width="40%" align="right" class="letra">Digite o <B>Nome</B> do Usuário ou Matricula:</td>
    <td width="31%"><input name="xBusca" type="text" size="30" value="<?echo $xBusca;?>" class="codigo" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
      <td width="29%"><input name="Submit" type="submit" class="letra" id="Pesquisar" value="Pesquisar" onClick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
  </tr>

  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
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
<?php
	if( $nvaloresencontrados > 0 )
	{
?>
<fieldset>
	<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA <?echo $xBusca;?></legend>

<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
	<tr>
		<td width="31%" align="left" class="branco"><B>Nome</B></td>	
		<td width="9%" align="center" class="branco"><B>Matricula</B></td>
		<td width="18%" align="left" class="branco"><B>Nome de Guerra</B></td>	
		<td width="33%" align="left" class="branco"><B>Nível</B></td>			
		<td width="3%" align="center" class="branco">&nbsp;</td>	
		<td width="4%" align="center" class="branco">&nbsp;</td>
	</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$resultado = $obj->executaQuery($query);
	while ( $linha = mysql_fetch_array($resultado) )
	{		
		$nivel =  $linha['nivel'];
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
		<td width="31%" align="left" class="negrito"><? echo $linha['nome']; ?></td>
		<td width="9%" align="center" class="negrito"><? echo $linha['matricula']; ?></td>	
		<td width="18%" align="left" class="negrito"><? echo $linha['login']; ?></td>		
		<td width="33%" align="left" class="negrito"><? echo $linha['nivel']; ?></td>		
   	    <td width="3%" class="negrito" align="center"><A HREF="cadastro_usuario.php?matricula=<? echo $linha['matricula']; ?>" border="0"><IMG SRC="imagens/atualizar.png" WIDTH="21" HEIGHT="21" BORDER="0" ALT="Alterar"></A></td>
	   <td width="4%" class="negrito" align="center"><a onClick="Excluir('../classes/controleUsuario.php?idFuncionario=<? echo $linha['id']; ?>')" href="#">	   
	   <IMG SRC="imagens/excluir.png" WIDTH="21" HEIGHT="21" BORDER="0" ALT="Excluir"></A></td>

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
	<legend class="negrito">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA <?echo $xBusca;?></legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">

	<tr>
		<td width="100%" colspan="3" align="center" class="letra">Nenhuma ocorr&ecirc;ncia para <B><?echo $xBusca;?></B></td>
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


</body>
</html>

<?php
	// Fechando as variáveis de conexão
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