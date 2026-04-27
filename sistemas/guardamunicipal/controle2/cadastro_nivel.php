<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	$id = $_GET['id'];
	if( $id > 0 )
	{
		// Pegou o Id
	}
	else
	{
		$id = $_POST['id'];
	}

	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$tamanho = 0;
	$nome = "";
	$valor = "";
	
	if( $id > 0 )
	{		
		$query = "SELECT * FROM nivel where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		$id = 0;
		$nomeCategoria = "";		
		if( $linha )
		{
			$id = $linha["id"];
			$nome = $linha["nome"];
			$valor = $linha["valor"];
			$tamanho = strlen($nome);
		}		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
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
	<legend class="letra">Cadastro de Nivel	</legend>
	<form name="form1" method="post" action="../classes/controleAlterarNivel.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="52%" border="0" cellspacing="1" cellpadding="1">

 <tr>
    <td width="156" align="right" class="letra">Nome:</td>
    <td width="376"><input name="xnome" id="xnome" type="text" onKeyUp="counterUpdate('xnome','countNome','195');" size="52" value="<?echo $nome;?>"/></td>
 </tr>

  <tr>
	<td width="156">&nbsp;</td>
    <td align="left" class="letra">
	Voc&ecirc; digitou <B><span id="countNome"><?php echo $tamanho;?></span></B> caracteres » Limite: <B>195</B> caracteres</p>
	</td>
  </tr>

  <tr>
    <td width="156" align="right" class="letra">Valor:</td>
    <td width="376"><input name="xvalor" id="xvalor" type="text" size="20" value="<?echo $valor100;?>"/></td>
  </tr>
 <INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">	
	
  <tr height="2">
    <td align="left" class="letra" colspan="2">&nbsp;</td>
  </tr>

  <tr>	
    <td align="right">
    <td><input name="Submit" type="submit" class="botao" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
	</td>
  </tr>

</table>

</form>
</fieldset>

	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>

<?php
	// Fechando as variáveis de conexão
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeVar($id);
	$obj->closeVar($nomeCategoria);
	if( $id > 0 )
	{
		$obj->closeQuery();
		$obj->closeConexaoGeral();
	}
?>
