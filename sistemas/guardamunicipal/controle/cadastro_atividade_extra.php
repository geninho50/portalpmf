<?php
		header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past	
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	$id = (int)$_GET['id'];
	if( $id > 0 )
	{
		// Pegou o Id
	}
	else
	{
		$id = (int)$_POST['id'];
	}

	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$local = "";
	$tempo = "";
	$complemento = "";
	
	if( $id > 0 )
	{		
		$query = "SELECT * FROM atividadeextra where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		if( $linha > 0 )
		{
			$id = $linha["id"];
			$tempo = $linha["tempo"];
			$local = $linha["local"];
			$complemento = $linha["complemento"];
		}		
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
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="negrito">Cadastro Atidade Extra</legend>

	<form name="form1" method="post" action="../classes/controleAtividadeExtra.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	
	<table width="83%" height="263" border="0" cellpadding="1" cellspacing="1">
	  <tr>
		<td height="24" align="right" class="letra">Atividade:<font color="#FF0033">*</font></td>
		<td>      <input name="xlocal" id="xlocal" type="text" size="60" value="<?echo $local;?>"/></td>
	  </tr>
	  <tr>
		<td width="21%" height="24" align="right" class="letra">Tempo Dispon&iacute;vel:</td>
		<td width="79%"><input name="tempo" id="tempo2" type="text" size="60" value="<?echo $tempo;?>"/></td>
	 </tr>
	  <tr>
		<td height="136" align="right" valign="top" class="letra">Informa&ccedil;&otilde;es Complementares:</td>
		<td valign="top"><textarea name="complemento" cols="90" rows="10" id="complemento" ><?echo $complemento;?></textarea></td>
	  </tr>
	
	 <INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">	
		
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
	// Fechando as vari�veis de conex�o
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeVar($id);
	if( $id > 0 )
	{
		$obj->closeQuery();
		$obj->closeConexaoGeral();
	}
?>
