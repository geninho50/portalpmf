<?php
		// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
		
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
	<legend class="negrito">Cadastro Folga</legend>
	<form name="form1" method="post" action="../classes/controleFolga.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td colspan="2"><table width="100%"  border="0" cellspacing="1" cellpadding="1">
		  <tr>
		    <td align="right">Cadastrado por: </td>
		    <td><input name="login" readonly="readonly" value="<? echo $login;?>" type="text" size="15"></td>
		    </tr>
		  <tr>
			<td width="12%" align="right">GM:</td>
			<td width="88%">
			<select name="yGM" class="letra">
				  <option value="0">Selecionar...</option>
				  <?php 
					$query = "SELECT * FROM guarda_gmf where login != '$login' order by login";
					$resultado = $obj->executaQuery($query);
					while($linha = mysql_fetch_array($resultado))
					{
						$login = $linha['login'];
				  ?>
							 <option value="<?php echo $login; ?>"><?php echo $login; ?></option>
				  <?php 
					} 
				  ?>
			  </select>
			</td>
			</tr>
		</table></td>
	  </tr>
	  <tr>
		<td colspan="2"><table width="100%"  border="0" cellspacing="1" cellpadding="1">
		  <tr>
			<td width="12%" height="24" align="right">Descri&ccedil;&atilde;o da Folga:</td>
			<td width="88%"><input name="xDescricao" type="text" value="<?php echo $descricao; ?>" size="80" />	</td>
			</tr>
		</table></td>
	  </tr>
			<INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">
			<tr>
			  <td colspan="2"><table width="100%"  border="0" cellspacing="1" cellpadding="1">
				<tr>
				  <td width="12%" align="right" valign="top">Qtade de Dias: </td>
				  <td width="88%"><input name="xQtade" type="text" value="<?php echo $qtade; ?>" size="8" />
	</td>
				</tr>
			  </table></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
		<tr>	
			<td width="12%">&nbsp;		</td>
			<td width="88%"><input name="Submit" type="submit" class="botao" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
		</tr>
	</table>
	</form>
	</fieldset>
	
	</td>
	</tr>
	</table>
	<!--fim adm-->
	</td>
  </tr>
</table>


</body>
</html>

