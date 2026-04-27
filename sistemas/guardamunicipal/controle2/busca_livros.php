<?php
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past	
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	$obj = new DB_mysql;
	$objT = new trataArquivo;
	$conexao = $obj->conectarConf();

	// Realiza a consulta ao banco;
	$ultimoslivros = $_GET['ultimoslivros'];
	if( $ultimoslivros > 0 )
	{
		// Pegou o Id
	}
	else
	{
		$ultimoslivros = $_POST['ultimoslivros'];
	}

	$livro = "";
	$livro = $_POST['xTermo'];
	$buscar = $_POST['buscar'];
	$ordenar = $_POST['ordenar'];
	$livro = trim($livro);
	$tamanho = strlen($livro);
	$nvaloresencontrados = 0;
	
	if( $ultimoslivros > 0 )
		$query = "SELECT * FROM livros order by data desc";
	else{
		if(($buscar != 'livre') && ($ordenar == 'livre')){
			$query = "SELECT * FROM livros where UPPER(".$buscar.") like UPPER('%$livro%')";
		}else{
			if(($buscar != 'livre') && ($ordenar != 'livre')){
			$query = "SELECT * FROM livros where UPPER(".$buscar.") like UPPER('%$livro%') order by ".$ordenar." asc";
			}
		}
	}
	
	if( $tamanho > 0 || $ultimoslivros > 0 )
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
	<legend class="negrito">Consulta Livro</legend>
<form name="form1" method="post" action="busca_livros.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="67%" border="0" cellspacing="1" cellpadding="1">

  <tr>
    <td width="31%" align="right" class="letra">Digite o <B>Termo</B> para consulta:</td>
    <td width="56%"><input name="xTermo" type="text" size="70" value="<?echo $livro;?>"/></td>
      <td width="13%">&nbsp;</td>
  </tr>

  <tr>
    <td align="right" class="letra">Buscar por: </td>
    <td class="letra"><select name="buscar">
	  <option value="titulo">Titulo</option>
      <option value="autor">Autor</option>
	  <option value="assunto">Assunto</option>
    </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="letra">Ordenar por: </td>
    <td class="letra"><select name="ordenar">
      <option value="livre">Livre</option>
	  <option value="titulo">Titulo</option>
      <option value="anopublicacao">Ano Publica&ccedil;&atilde;o</option>
      <option value="codigo">C&oacute;digo de Acervo</option>
      <option value="tipo">Tipo de Obra</option>
      <option value="idiomas">Idioma</option>
        </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="letra">&nbsp;</td>
    <td align="right" class="letra"><input name="Submit" type="submit" class="botao" id="Submit" value="Pesquisar" onclick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td width="40%" align="right" class="letra">&nbsp;</td>
    <td width="31%" class="negrito"><A HREF="busca_livros.php?ultimoslivros=1"><font color="#000000" size="2">Listar Todos</font></A></td>
      <td width="29%">&nbsp;</td>
  </tr>
</table>



</form>
</fieldset>

<?php
	if( $nvaloresencontrados > 0 )
	{
?>
<fieldset>
	<legend class="letra">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $livro;?></legend>

<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
	<tr>
		<td width="6%" align="center" class="branco"><B>Tipo</B></td>
		<td width="11%" align="center" class="branco"><B>Código</B></td>
		<td width="63%" align="left" class="branco"><B>Descrição</B></td>
		<td width="14%" align="center" class="branco"><B>Imagem</B></td>
		<td width="2%" align="center" class="branco">&nbsp;</td>
		<td width="2%" align="center" class="branco">&nbsp;</td>		
		<td width="2%" align="center" class="branco">&nbsp;</td>
	</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$resultado = $obj->executaQuery($query);
	$path = $objT->getPath(17);
	while ($linha=mysql_fetch_array($resultado))
	{		
		$codigo = $linha['codigo'];
		$titulo = $linha['titulo'];
		$subtitulo = $linha['subtitulo'];
		$autor = $linha['autor'];
		$assunto = $linha['assunto'];
		$editora = $linha['editora'];
		$anopublicacao = $linha['anopublicacao'];
		$edicao = $linha['edicao'];
		$paginas = $linha['paginas'];
		$idiomas = $linha['idiomas'];
		$tipo = $linha['tipo'];
		
		$codigo = $linha['codigo'];
		// Path onde as Noticias sao cadastradas
		$path = $objT->getPath(17).$linha['id']."/";
		$nomearquivo = $objT->retornaArquivo($path);
		$tamanhonomearquivo = strlen($nomearquivo);
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

		<td width="6%" align="center" class="negrito"><? echo $tipo; ?></td>
		<td width="11%" align="center" class="negrito"><? echo $codigo; ?></td>
		<td width="63%" align="left" valign="top" class="negrito"><font color="#000099" face="Arial, Helvetica, sans-serif" size="2"><? echo $titulo.'<br> '.$subtitulo.' / '.$anopublicacao.' - '.$tipo.' </font><br>'.$autor.' - '.$paginas.'pg '.$edicao.'ed - '.$editora.' - '.$idiomas; ?></td>
		<td width="14%" align="center">
			<? if( $tamanhonomearquivo > 0 ){?>
				<img src="fotos/biblioteca/<?php echo $linha['id']; ?>/<?php echo $linha['id'];?>_1.jpg" border="0" > <? } ?>
		</td>
		<td width="2%" class="letra" align="center">
		<a href="javascript:POPUP('reserva_livro.php?idLivro=<? echo $linha['id']; ?>','700','350')"><IMG SRC="images/calendario.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT="Alterar"></a>
		<td width="2%" class="letra" align="center"><A HREF="cadastro_livro.php?idLivro=<? echo $linha['id']; ?>" border="0"><IMG SRC="images/editar.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT="Alterar"></A></td>
	    <td width="2%" class="letra" align="center"><a onClick="Excluir('../classes/controleLivros.php?idLivro=<? echo $linha['id']; ?>')" href="#"><IMG SRC="images/lixeira.jpg" WIDTH="16" HEIGHT="16" BORDER="0" ALT="Excluir"></A></td>

	</tr>
<?php
	}
?>
	
</table>

</fieldset>


</td>
</tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="3%" align="center"><img src="images/calendario.gif" width="16" height="16" /></td>
    <td width="97%">Reserva de livro </td>
  </tr>
</table>
<?php
	}

	if( $nvaloresencontrados == 0 && $tamanho > 0 )
	{
		
?>
<fieldset>
	<legend class="negrito">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $livro;?></legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">

	<tr>
		<td width="100%" colspan="3" align="center" class="negrito">Nenhuma ocorr&ecirc;ncia para <B><?echo $livro;?></B></td>
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