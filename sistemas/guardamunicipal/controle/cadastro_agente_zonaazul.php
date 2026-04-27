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
	$tamanho = 0;
	$nome = "";
	$colocacao = "";
	$dias = "";
	
	if( $id > 0 )
	{		
		$query = "SELECT * FROM agente_zonaazul where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		$id = 0;
		$nomeCategoria = "";		
		if( $linha )
		{
			$id = $linha["id"];
			$nome = $linha["nome"];
			$dias = $linha["dias"];
			$turno = $linha["turno"];
			$colocacao = $linha["colocacao"];
			$tamanho = strlen($nome);
			$tamanholink = strlen($link);
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
	<legend class="negrito">Cadastro Agente Zona Azul</legend>

	<form name="form1" method="post" action="../classes/controleAgenteZonaAzul.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	
	<table width="52%" border="0" cellspacing="1" cellpadding="1">
	
	 <tr>
		<td width="25%" align="right" class="letra">Nome de Guerra:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="75%"><input name="xnome" id="xnome" type="text" onKeyUp="counterUpdate('xnome','countNome','195');" size="52" value="<?echo $nome;?>"/></td>
	 </tr>
	
	  <tr>
		<td width="25%">&nbsp;</td>
		<td align="left" class="letra">
		Voc&ecirc; digitou <B><span id="countNome"><?php echo $tamanho;?></span></B> caracteres � Limite: <B>195</B> caracteres</p>
		</td>
	  </tr>
	
	  <tr>
		<td width="7%" align="right" class="letra">Turno:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="12%" align="left"><select name="yturno">
		 <option value="0">Selecionar...</option>
		  <option value="Matutino">Matutino</option>
		  <option value="Vespertino">Vespertino</option>
		</select></td>
	  </tr>
	  <tr>
		<td width="25%" align="right" class="letra">Colocacao :<FONT COLOR="#FF0033">*</FONT></td>
		<td width="75%"><input name="xcolocacao" id="xcolocacao" type="text" size="4" value="<?echo $colocacao;?>"/></td>
	 </tr>
	 <tr>
		<td width="25%" align="right" class="letra">Dias de Trabalho :<FONT COLOR="#FF0033">*</FONT></td>
		<td width="75%"><input name="xdias" id="xdias" type="text" onKeyUp="counterUpdate('xlink','countNomeLink','248');" size="4" value="<?echo $dias;?>"/></td>
	 </tr>
	 <td width="5%" align="right" class="letra">Data Limite:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="13%" align="left"><input type="text" value="<? echo $datalimite;?>" readonly name="datalimite" class="stylo1" size="12"/>
		  <a onclick="displayCalendar(document.forms[0].datalimite,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data' /></a> 
	 </td>
	
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
	// Fechando as vari�veis de conex�o
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
