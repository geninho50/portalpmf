<?php
	header('Content-Type: text/html; charset=iso-8859-1');
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->


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
  <tr>
    <td>
	<!--inicio adm-->
<fieldset>
	<legend class="negrito">Resultado da Busca</legend>
<form name="form1" method="post" action="busca_funcionario.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="67%" border="0" cellspacing="1" cellpadding="1">

  <tr>
    <td width="40%" align="right" class="letra">Digite o <B>Nome</B> do Usuário ou Matricula:</td>
    <td width="31%"><input name="xBusca" type="text" class="letra" size="30" value="<?echo $xBusca;?>"/></td>
      <td width="29%"><input name="Submit" type="submit" id="Pesquisar" value="Pesquisar" class="botao" onClick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
  </tr>

  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>



</form>
</fieldset>

<?php
	if( $nvaloresencontrados > 0 )
	{
?>
<fieldset>
	<legend class="letra">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $xBusca;?></legend>

<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
	<tr>
		
		<td width="5%" align="center" class="branco"><B>Status</B></td>
		<td width="7%" align="center" class="branco"><B>Matricula</B></td>
		<td width="27%" align="left" class="branco"><B>Nome</B></td>	
		<td width="15%" align="left" class="branco"><B>Nome de Guerra</B></td>	
		<td width="15%" align="left" class="branco"><B>Login</B></td>	
		<td width="24%" align="left" class="branco"><B>Senha</B></td>
		<td width="3%" align="center" class="branco">&nbsp;</td>	
		<td width="2%" align="center" class="branco">&nbsp;</td>		
		<td width="2%" align="center" class="branco">&nbsp;</td>
	</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$resultado = $obj->executaQuery($query);
	while ( $linha = mysql_fetch_array($resultado) )
	{		
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
		<td width="5%" align="center" class="letra"><? echo $linha['status']; ?></td>
		<td width="7%" align="center" class="letra"><? echo $linha['matricula']; ?></td>
		<td width="27%" align="left" class="letra"><? echo $linha['nome']; ?></td>
		<td width="15%" align="left" class="letra"><? echo $linha['login']; ?></td>
		<td width="15%" align="left" class="letra"><? if($linha['login']!=$linha['login_usuario']){?> <font color="#FF3300"><strong> <? echo $linha['login_usuario'];?> </strong></font><? }else{ echo $linha['login_usuario']; } ?></td>		
		<td width="24%" align="left" class="letra"><? echo $linha['senha'];; ?></td>
		<td width="3%" class="negrito" align="center"><A HREF="cadastro_usuario.php?matricula=<? echo $linha['matricula']; ?>" border="0"><IMG SRC="images/atualizar.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="Alterar"></A></td>
   	    <td width="2%" class="negrito" align="center"><A HREF="cadastro_funcionario.php?idFuncionario=<? echo $linha['id']; ?>" border="0"><IMG SRC="images/editar.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="Alterar"></A></td>
	   <td width="2%" class="negrito" align="center"><a onClick="Excluir('../classes/controleUsuario.php?idFuncionario=<? echo $linha['id']; ?>')" href="#">	   
	   <IMG SRC="images/lixeira.jpg" WIDTH="20" HEIGHT="20" BORDER="0" ALT="Excluir"></A></td>

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
	<legend class="letra">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $xBusca;?></legend>
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