<?php
   // Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   $id =  (int)$_POST['id'];
   if( $id == 0 )
   {
      $id = (int)$_GET['id'];
   }
   
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	require ("../classes/trataArquivo.php");
	$objT = new trataArquivo;
	require ("../classes/trataString.php");
	$objS = new trataString;
	$tamanho = 0;
	$nome = "";
	$descricao = "";
	
	if( $id > 0 )
	{		
		$query = "SELECT * FROM enquete where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		$id = 0;
		$nomeCategoria = "";		
		if( $linha )
		{
			$id = $linha["id"];
			$status = $linha["status"];
			$nome = $linha["nome"];
			$descricao = $linha["descricao"];
			$tamanho = strlen($nome);

			// Path onde os arquivos s�o cadastradas
			$path = $objT->getPath(13).$id."/";
			$nomearquivo = $objT->retornaArquivo($path);
			$tamanhonomearquivo = strlen($nomearquivo);
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
		$result = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($result);
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
	<!-- inicio do adm -->
<fieldset>
	<legend class="negrito">Cadastro Publicar Enquete</legend>	
<form name="form1" method="post" action="../classes/controleEnquete.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="52%" border="0" cellspacing="1" cellpadding="1">

 <tr>
   <td width="25%" align="right" class="letra">Nome:<FONT COLOR="#FF0033">*</FONT></td>
   <td width="75%"><input name="xnome" id="xnome" type="text" onKeyUp="counterUpdate('xnome','countNome','195');" size="52" value="<?echo $nome;?>"/></td>
 </tr>

  <tr>
	<td width="25%">&nbsp;</td>
    <td align="left" class="letra">
	Voc&ecirc; digitou <B><span id="countNome"><?php echo $tamanho;?></span></B> caracteres Limite: <B>195</B> caracteres</p>
	</td>
  </tr>

 <tr>
    <td align="right" class="letra">Enviar Arquivo:<FONT COLOR="#FF0033">*</FONT></td>
    <td>		
	<input name="arquivo" size="52" type="file" />
	</td>
  </tr>

 <INPUT TYPE="hidden" NAME="id" id="idhidden" value="<?echo $id;?>"> 

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
	<!-- fim do adm -->
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
