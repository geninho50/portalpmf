<?php
	ini_set('default_charset','UTF-8');
	
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
		$id = $_POST['id'];
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
	
	$queryG = "SELECT * from guarda_gmf where id=$idsession";
	$resultadoG = $obj->executaQuery($queryG);	
	$linhaG = mysql_fetch_array($resultadoG);
	if ( $linhaG )
	{
		$matricula = $linhaG["matricula"];
	}
	
	if( $id > 0 )
	{		
		$query = "SELECT * FROM digital where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		$id = 0;
		$nomeCategoria = "";		
		if( $linha )
		{
			$id = $linha["id"];
			$guarda = $linha["guarda"];
			$ano = $linha["ano"];
			$titulo = $linha["titulo"];
			$tamanho = strlen($nome);

			// Path onde os arquivos s�o cadastradas
			$path = $objT->getPath(6).$id."/";
			$nomearquivo = $objT->retornaArquivo($path);
			$tamanhonomearquivo = strlen($nomearquivo);
		}		
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
	<legend class="cabecalho">CADASTRO DE CONTEÚDO DIGITAL</legend>

	<form name="form1" method="post" action="../classes/controleDigital.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	
	<table width="74%" border="0" cellspacing="1" cellpadding="1">
	
	 <tr>
		<td width="26%" align="right" class="letra">Nome do Guarda:</td>
		<td width="74%"><input name="xGM1_1" id="xGM1_1" type="text" class="negrito" onKeyUp="converteUpper(this);" size="52" value="<? echo $guarda;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
	 </tr>
	  <tr>
		<td width="26%" align="right" class="letra">Título:</td>
		<td width="74%"><input name="xtitulo" id="xtitulo" class="negrito" type="text" size="52" value="<? echo $titulo;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
	 </tr>
	  <tr>
		<td width="26%" align="right" class="letra">Ano:</td>
		<td width="74%"><input name="xano" id="xano" type="text" size="15" class="negrito" value="<?echo $ano;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
	 </tr>
	 <tr>
		<td align="right" class="letra">Enviar Arquivo:</td>
		<td>		
		<input name="arquivo" size="52" type="file" class="negrito" />
		</td>
	  </tr>
	
	 <INPUT TYPE="hidden" NAME="id" id="idhidden" value="<?echo $id;?>"> 
	
	 <tr height="2">
	   <td align="left" class="letra" colspan="2">&nbsp;</td>
	   </tr>
	
	  <tr>	
		<td align="right">
		<td><input name="Submit" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
		</td>
	  </tr>
	
	</table>
	</form>
	</fieldset>
	<!--fim adm-->
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
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
