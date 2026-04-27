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
	$query = "SELECT * FROM escolas where UPPER(nome) like UPPER('%$xBusca%') order by nome asc";
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script type="text/javascript" src="scripts/jquery.min.js"></script> 
		<script type="text/javascript">
		jQuery(document).ready(function() {
		  jQuery(".content").hide();
		  //toggle the componenet with class msg_body
		  jQuery(".heading").click(function()
		  {
			jQuery(this).next(".content").slideToggle(500);
		  });
		});
</script>
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

</head>

<body> 
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th>&nbsp;</th>
  </tr>
  <tr>
    <td colspan="2">
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CONSULTAR ESCOLA</legend>
<form name="form" method="post" action="busca_escola.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="67%" border="0" cellspacing="1" cellpadding="1">

  <tr>
    <td width="40%" align="right" class="letra">Digite o <B>Nome</B> da Escola:</td>
    <td width="31%"><input name="xBusca" type="text" size="30" value="<?echo $xBusca;?>" class="negrito"/></td>
      <td width="29%"><input name="Submit" type="submit" class="letra" id="Pesquisar" value="Pesquisar" onClick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
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
	<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA <?echo $xBusca;?></legend>

<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
	<tr>
		<td width="32%" align="left" class="branco"><B>Nome</B></td>	
		<td width="62%" align="center" class="branco">&nbsp;</td>	
		<td width="4%" align="center" class="branco">&nbsp;</td>
        <td width="4%" align="center" class="branco">&nbsp;</td>	
		</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$resultado = $obj->executaQuery($query);
	while ( $linha = mysql_fetch_array($resultado) )
	{		
?>
	
    <div class="layer1">
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>">
			<td width="32%" align="left" class="negrito"><? echo $linha['nome']; ?> </td>		
			<td width="62%" align="left" class="negrito"><p class="heading">Mais Informções</p>
			
			<div class="content">
				<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
				  <tr>
					<td width="20%" align="right" bgcolor="#006699" class="branco">Endereco:</td>
					<td width="80%" align="left"  class="negrito"><?php echo $linha['rua']." - ".$linha['numero']." - ".$linha['bairro']; ?></td>
				  </tr>
				  <tr>
					<td width="20%" align="right" bgcolor="#006699" class="branco">Diretor:</td>
					<td width="80%" align="left"  class="negrito"><?php echo $linha['diretor']; ?></td>
				  </tr>
				  <tr>
					<td align="right" bgcolor="#006699" class="branco">Telefone:</td>
					<td align="left"  class="negrito"><?php echo $linha['telefone'];?></td>
				  </tr>
				  <tr>
					<td align="right" bgcolor="#006699" class="branco">Email: </td>
					<td align="left"  class="negrito"><?php echo $linha['email']; ?></td>
				  </tr>
				  <tr>
					<td align="right" bgcolor="#006699" class="branco">Numero de Alunos: </td>
					<td align="left"  class="negrito"><?php echo $linha['numalunos']; ?></td>
				  </tr>
                  <tr>
					<td align="right" bgcolor="#006699" class="branco">Necessidade: </td>
					<td align="left"  class="negrito"><?php echo $linha['necessidade']; ?></td>
				  </tr>
			</table>
		  </div>		  

          </td>
			<td width="4%" class="negrito" align="center"><A HREF="listar_solcitacao_escola.php?idEscola=<? echo $linha['id']; ?>" border="0"><IMG SRC="imagens/gerenciar.png" WIDTH="21" HEIGHT="21" BORDER="0" title="GERENCIAR DADOS DA ESCOLA"></A></td>
            <td width="4%" class="negrito" align="center"><A HREF="cadastro_escola.php?idEscola=<? echo $linha['id']; ?>" border="0"><IMG SRC="imagens/atualizar.png" WIDTH="21" HEIGHT="21" BORDER="0" title="ATUALIZAR DADOS DA ESCOLA"></A></td>
		</tr>
	</table>
	</div>
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
	<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA <?echo $xBusca;?></legend>
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