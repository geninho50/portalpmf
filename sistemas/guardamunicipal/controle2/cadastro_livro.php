<?php
	header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past	

	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	$idLivro = (int)$_GET['idLivro'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql;
	$objT = new trataArquivo;
	$objS = new trataString;
	
	if( $idLivro > 0 )
	{		
		$obj->conectarConf();
		$query = "SELECT * FROM livros where id=$idLivro";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		$linha = mysql_fetch_array($resultado);
		
		$id = 0;
		$codigo = 0;
		$titulo = "";
		$subtitulo = "";
		$autor = "";
		$assunto = "";
		$editora = "";
		$anopublicacao = "";
		$edicao = "";
		$paginas = "";
		$idiomas = "";
		$tipo = "";
		
		if( $linha )
		{
			$id = $linha["id"];
			$codigo = $linha["codigo"];
			$titulo = $linha["titulo"];
			$subtitulo = $linha["subtitulo"];
			$autor = $linha["autor"];
			$assunto = $linha["assunto"];
			$editora = $linha["editora"];
			$anopublicacao = $linha["anopublicacao"];
			$edicao = $linha["edicao"];
			$paginas = $linha["paginas"];
			$idiomas = $linha["idiomas"];
			$tipo = $linha["tipo"];
			
			// Path
			$path = $objT->getPath(17).$id."/";
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
	<legend class="negrito">Cadastro de Livros</legend>

	<form name="form1" method="post" action="../classes/controleLivros.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')" enctype="multipart/form-data">
	
	<table width="80%" border="0" cellspacing="1" cellpadding="1">
	
	 <tr>
		<td width="19%" align="right" class="letra"></td>
		<td width="81%"><input name="idLivro" type="text" id="idLivro" value="<?echo $id;?>" size="20" maxlength="6" readonly="readonly"/></td>
	 </tr>
	 <tr>
		<td width="19%" align="right" class="letra">C&oacute;digo:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="81%"><input name="xcodigo" type="text" id="xcodigo" value="<?echo $codigo;?>" size="20" maxlength="6"/></td>
	 </tr>
	 <tr>
		<td width="19%" align="right" class="letra">T&iacute;tulo:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="81%"><input name="xtitulo" type="text" id="xtitulo" value="<?echo $titulo;?>" size="52"/></td>
	 </tr>
	
	 <tr>
		<td width="19%" align="right" class="letra">Subt&iacute;tulo:</td>
		<td width="81%"><input name="subtitulo" type="text" id="subtitulo" value="<?echo $subtitulo;?>" size="52"/></td>
	 </tr>
	
	   <tr>
		<td width="19%" align="right" class="letra">Autor:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="81%"><input name="xautor" type="text" id="xautor" value="<?echo $autor;?>" size="52"/></td>
	 </tr>
	 <tr>
		<td width="19%" align="right" class="letra">Assunto:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="81%"><input name="xassunto" type="text" id="xassunto" value="<?echo $assunto;?>" size="52"/>
		</td>
	 </tr>
	 <tr>
		<td width="19%" align="right" class="letra">Editora:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="81%"><input name="xeditora" type="text" id="xeditora" value="<?echo $editora;?>" size="52"/></td>
	 </tr>
	 <tr>
		<td width="19%" align="right" class="letra">Ano Publica&ccedil;&atilde;o :<FONT COLOR="#FF0033">*</FONT></td>
		<td width="81%"><input name="xanopulicacao" type="text" id="xanopulicacao" value="<?echo $anopublicacao;?>" size="20" maxlength="6"/></td>
	 </tr>
	<tr>
		<td width="19%" align="right" class="letra">Edi&ccedil;&atilde;o:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="81%"><input name="xedicao" type="text" id="xedicao" value="<?echo $edicao;?>" size="52"/></td>
	 </tr>
	 <tr>
		<td width="19%" align="right" class="letra">P&aacute;ginas:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="81%"><input name="xpaginas" type="text" id="xpaginas" value="<?echo $paginas;?>" size="20" maxlength="6"/></td>
	 </tr>
	 <tr>
		<td width="19%" align="right" class="letra">Idioma(s):<FONT COLOR="#FF0033">*</FONT></td>
		<td width="81%"><input name="xidiomas" type="text" id="xidiomas" value="<?echo $idiomas;?>" size="52"/></td>
	 </tr>
	 <tr>
		<td width="19%" align="right" class="letra">Tipo:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="81%"><select name="ytipo">
		  <option value="0">Selecionar...</option>
		  <option value="Livro">Livro</option>
		  <option value="Revista">Revista</option>
		  <option value="Apostila">Apostila</option>
		  <option value="Panfleto">Panfleto</option>
		  <option value="Dissertacao">Dissertação</option>
		  <option value="CD/DVD">CD/DVD</option>
		</select></td>
	 </tr>
	 <tr>
		<td align="right" valign="top" class="letra">Enviar Imagem:</td>
		<td>
			<input name="arquivo" size="52" type="file"/>
			<?php 
				if( $tamanhonomearquivo > 0 )
				{
			?>
					<BR><img src="fotos/biblioteca/<?php echo $linha["id"]; ?>/<?php echo $linha["id"]?>_1.jpg" border="0" hspace="10" align="left">
			<?php
				}
			?>
		</td>
	  </tr>
	
	<?php
		$tamanhoadministrador = strlen($administrador);
		$tamanhonoticia = strlen($noticia);
		$tamanhoeducacao = strlen($educacao);
		$tamanhocomando = strlen($comando);
		$tamanhoguardas = strlen($guardas);
	?>
	
	 <INPUT TYPE="hidden" NAME="idLivro" value="<?echo $idLivro;?>">	
		
	 <tr height="2">
		<td align="left" class="letra" colspan="2">&nbsp;</td>
	  </tr>
	
	  <tr>	
		<td align="right">
		<td><input name="Submit" type="submit" id="Confirmar" class="botao" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
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