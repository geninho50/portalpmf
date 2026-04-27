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
	
	if( $id > 0 )
	{		
		$query = "SELECT * FROM monografia where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		$id = 0;
		$nomeCategoria = "";		
		if( $linha )
		{
			$id = $linha["id"];
			$nome = $linha["nome"];
			$t_trabalho = $linha["t_trabalho"];
			$ano = $linha["ano"];
			$titulo = $linha["titulo"];
			$t_especializacao = $linha["t_especializacao"];
			$tamanho = strlen($nome);

			// Path onde os arquivos s�o cadastradas
			$path = $objT->getPath(2).$id."/";
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
	<legend class="cabecalho">CADASTRO DE MONOGRAFIA</legend>

	<form name="form1" method="post" action="../classes/controleMonografia.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	
	<table width="74%" border="0" cellspacing="1" cellpadding="1">
	
	 <tr>
		<td width="26%" align="right" class="letra">Nome do Autor:</td>
		<td width="74%"><input name="xnome" id="xnome" type="text" class="negrito" onKeyUp="converteUpper(this);" size="52" value="<?echo $nome;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
	 </tr>
	  <tr>
		<td width="26%" align="right" class="letra">Título do Trabalho:</td>
		<td width="74%"><input name="xtitulo_trabalho" id="xtitulo_trabalho" class="negrito" type="text" size="52" value="<?echo $t_trabalho;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
	 </tr>
	  <tr>
		<td width="26%" align="right" class="letra">Ano:</td>
		<td width="74%"><input name="xano" id="xano" type="text" size="15" class="negrito" value="<?echo $ano;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
	 </tr>
	 <tr>
		<td width="26%" align="right" class="letra">Título:</td>
		<td width="74%"><select name="ytitulo" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
		 <option value="0">SELECIONE...</option>
		  <option value="BACHAREL">BACHAREL</option>
		  <option value="LICENCIATURA">LICENCIATURA</option>
		  <option value="BACHARELLICENCIATURA">BACHAREL / LICENCIATURA</option>
		  <option value="POSGRADUACAO">PÓS-GRADUAÇÃO</option>
		  <option value="MESTRATO">MESTRATO</option>
		  <option value="DOUTORADO">DOUTORADO</option>
		</select></td>
	 </tr>
	<tr>
		<td width="26%" align="right" class="letra">Curso:</td>
		<td width="74%"><input name="xtitulo_especializacao" id="xtitulo_especializacao" class="negrito" type="text" size="52" value="<?echo $t_especializacao;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
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
