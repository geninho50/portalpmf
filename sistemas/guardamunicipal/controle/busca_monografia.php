<?php
		header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past	
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataData.php");
	class_exists('../classes/trataArquivo') || require_once ("../classes/trataArquivo.php");
	$obj = new DB_mysql;
	$objDt = new trataData;
	$conexao = $obj->conectarConf();
	$objT = new trataArquivo;

	// Realiza a consulta ao banco;
	$ultimastrinta = $_GET['ultimastrinta'];
	if( $ultimastrinta > 0 )
	{
		// Pegou o Id
	}
	else
	{
		$ultimastrinta = $_POST['ultimastrinta'];
	}

	/* 
		Quem acessa o material
		1 - M�dicos & Alunos;
		2 - Para M�dicos;
		3 - Para Alunos.
	*/
	$acessomaterial = $_GET['acessomaterial'];
	if( $acessomaterial > 0 )
	{
		// Pegou o acessomaterial
	}
	else
	{
		$acessomaterial = $_POST['acessomaterial'];
	}

	$temp = "";
	if( $acessomaterial == 3 )
	{
		$temp = "acesso=1 OR acesso=".$acessomaterial;
	}
	else
	{
		$temp = "acesso=1 OR acesso=2";
	}

	// Realiza a consulta ao banco;
	$xBusca = "";
	$xBusca = $_POST['xBusca'];
	$xBusca = trim($xBusca);
	$tamanho = strlen($xBusca);
	$nvaloresencontrados = 0;

	if( $ultimastrinta > 0 || $tamanho == 0 )
	{
		$query = "SELECT * FROM monografia order by nome asc LIMIT 0, 30";
		$nvaloresencontrados = $obj->numregistros($query);
	}
	else
	{
		$query = "SELECT * FROM monografia where (".$temp.") and UPPER(nome) like UPPER('%$xBusca%') order by nome asc";
	}
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
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
	<legend class="negrito">Consulta Monografia</legend>
	<form name="form1" method="post" action="busca_monografia.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
	
	<INPUT TYPE="hidden" name="cadastro" value="true">
	
	<table width="67%" border="0" cellspacing="1" cellpadding="1">
	
	  <tr>
		<td width="40%" align="right" class="letra">Digite o <B>Nome</B> dado ao Material:</td>
		<td width="31%"><input name="xBusca" type="text" size="30" value="<?echo $xBusca;?>"/></td>
		  <td width="29%"><input name="Submit" type="submit" id="Pesquisar" value="Pesquisar" class="botao" onClick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
	  </tr>
	
	  <tr>
		<td width="40%" align="right" class="letra">&nbsp;</td>
		<td width="31%" class="negrito"><A HREF="busca_monografia.php?ultimastrinta=1">Ver os materiais mais recentes</A></td>
		  <td width="29%">&nbsp;</td>
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
		<legend class="letra">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $xBusca;?></legend>
	
		<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
		  <tr>
			<td width="19%" align="left" class="branco"><b>Autor</b></td>
			<td width="36%" align="left" class="branco"><b>T�tulo do Trabalho</b></td>
			<td width="8%" align="center" class="branco"><b>download</b></td>
			<td width="5%" align="center" class="branco"><strong>ano</strong></td>
			<td width="12%" align="center" class="branco"><b>tipo</b></td>
			<td width="14%" align="center" class="branco"><b>tamanho</b></td>
			<td width="3%" align="center" class="branco">&nbsp;</td>
			<td width="3%" align="center" class="branco">&nbsp;</td>
		  </tr>
	  </table>
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<?php
		$chave = true;
		$resultado = $obj->executaQuery($query);
		while ( $linha = mysql_fetch_array($resultado) )
		{
			$id = $linha['id'];
			$nome = $linha['nome'];
			$t_trabalho = $linha['t_trabalho'];
			$nomearquivo = $linha['nomearquivo'];
			$tipo = $linha['tipo'];
			$dia = $linha['dia'];
			$mes = $linha['mes'];
			$ano = $linha['ano'];
			$tamanho_arquivo = $linha['tamanho'];
			$path = $objT->getPath(2).$id."/".$nomearquivo;
			$tamanho_k = $objT->converteUnidade($tamanho_arquivo,3);
			$tamanhoNomeArq = 0;
			$tamanhoNomeArq = strlen($nomearquivo);
			if( $nomearquivo{$tamanhoNomeArq-1} == 'r' && $nomearquivo{$tamanhoNomeArq-2} == 'a' && $nomearquivo{$tamanhoNomeArq-3} == 'r')
			{
				$tipo = "application/x-rar-compressed";
			}
			else
			if( $nomearquivo{$tamanhoNomeArq-1} == 'l' && $nomearquivo{$tamanhoNomeArq-2} == 'q' && $nomearquivo{$tamanhoNomeArq-3} == 's')
			{
				$tipo = "text/sql";
			}
			else
			if( $nomearquivo{$tamanhoNomeArq-1} == 't' && $nomearquivo{$tamanhoNomeArq-2} == 'a' && $nomearquivo{$tamanhoNomeArq-3} == 'b')
			{
				$tipo = "text/bat";
			}
			else
			if( $nomearquivo{$tamanhoNomeArq-1} == 'p' && $nomearquivo{$tamanhoNomeArq-2} == 'h' && $nomearquivo{$tamanhoNomeArq-3} == 'p')
			{
				$tipo = "text/php";
			}
			else
			if( $nomearquivo{$tamanhoNomeArq-1} == 'p' && $nomearquivo{$tamanhoNomeArq-2} == 's' && $nomearquivo{$tamanhoNomeArq-3} == 'j')
			{
				$tipo = "text/jsp";
			}
			else
			if( $nomearquivo{$tamanhoNomeArq-1} == 'a' && $nomearquivo{$tamanhoNomeArq-2} == 'v' && $nomearquivo{$tamanhoNomeArq-3} == 'a' && $nomearquivo{$tamanhoNomeArq-4} == 'j')
			{
				$tipo = "text/java";
			}
	?>
		<tr bgColor="<?PHP if($chave)
							{
								echo '#cccccc';
							}
							else{ 
								echo '#ffffff';
							} 
							$chave=!$chave;
						?>">
	
			<td width="19%" style="cursor: pointer" align="left" class="negrito" onClick="openDialog('content<?php echo $id; ?>');"><FONT COLOR="black"><? echo $linha['nome']; ?></FONT>
			
			<span id="content<?php echo $id; ?>" style="display:none">
			  <table align=center valign=middle width=100%>
				<tr>
				<td>
					<fieldset class=style1>
					<legend class=style1><FONT class=style1><B>Infoma��es</B></FONT></legend>	
						<table width=90% border=0 cellspacing=1 cellpadding=1>
							<tr  bgcolor="#FFFFCC">
								<td width=30% align=right valign=top><FONT class=style5><B>Autor: </B></FONT></td>
								<td width=2% align=right valign=top>&nbsp;</td>
								<td width=70% align=left class=style2><?php echo $nome; ?></td>
							</tr>
							<tr bgcolor="#FFFFCC">
								<td width=30% align=right valign=top><FONT class=style5><B>T�tulo do Trabalho: </B></FONT></td>
								<td width=2% align=right valign=top>&nbsp;</td>
								<td width=70% align=left class=style2><?php echo $linha['t_trabalho']; ?></td>
							</tr>
							<tr>
								<td width=30% align=right valign=top><FONT class=style5><B>Ano: </B></FONT></td>
								<td width=2% align=right valign=top>&nbsp;</td>
								<td width=70% align=left class=style2><?php echo $linha['ano']; ?></td>
							</tr>
							<tr>
								<td width=30% align=right valign=top><FONT class=style5><B>T�tulo: </B></FONT></td>
								<td width=2% align=right valign=top>&nbsp;</td>
								<td width=70% align=left class=style2><?php echo $linha['titulo']; ?></td>
							</tr>
							<tr>
								<td width=30% align=right valign=top><FONT class=style5><B>Curso: </B></FONT></td>
								<td width=2% align=right valign=top>&nbsp;</td>
								<td width=70% align=left class=style2><?php echo $linha['t_especializacao']; ?></td>
							</tr>
							<tr>
								<td width=30% align=right valign=top><FONT class=style5><B>postado em: </B></FONT></td>
								<td width=2% align=right valign=top>&nbsp;</td>
								<td width=70% align=left class=style2><?php echo $objDt->formataDataPInterface($linha['data']); ?></td>
							</tr>
							<tr>
								<td width=30% align=right valign=top><FONT class=style5><B>tamanho: </B></FONT></td>
								<td width=2% align=right valign=top>&nbsp;</td>
								<td width=70% align=left class=style2><?php echo $tamanho_k; ?></FONT> (<?php echo $tamanho_arquivo; ?> bytes)</td>
							</tr>
							<tr>
								<td width=30% align=right valign=top><FONT class=style5><B>download: </B></FONT></td>
								<td width=2% align=right valign=top>&nbsp;</td>
								<td width=70% align=left class=style2>
								<?php if($tamanho_arquivo>0){ ?>
								<A HREF="forcaDownload.php?id=<? echo $id ?>&file=<? echo $path ?>&tipo=<?php echo $tipo; ?>"><IMG SRC="imagens/downloadarquivo.png" width="16" height="16" BORDER="0"></A>
								<?php } else { echo "arquivo n�o encontrado"; } ?>
								</td>
							</tr>
						</table>
					</fieldset>
				</td>
				</tr>
			</table>
			</span>
			
			</td>
			<td width="36%" align="left" class="negrito"><? echo $linha['t_trabalho']; ?></td>
			<td width="8%" align="center" class="negrito"><?php if($tamanho_arquivo>0){ ?><A HREF="forcaDownload.php?id=<? echo $id ?>&file=<? echo $path ?>&tipo=<?php echo $tipo; ?>"><IMG SRC="images/downloadarquivo.png" width="16" height="16" BORDER="0"></A><?php } else { echo "arquivo n�o encontrado"; } ?></td>
			<td width="5%" align="center" class="negrito"><? echo $linha['ano']; ?></td>
			<td width="12%" align="center" class="negrito"><? echo $linha['tipo']; ?></td>
			<td width="14%" align="center" class="negrito"><FONT SIZE="1"><FONT COLOR="#FF6666"><?php echo $tamanho_k; ?></FONT> (<?php echo $tamanho_arquivo; ?> bytes)</FONT></td>
			<td width="3%" class="negrito" align="center"><A HREF="cadastro_monografia.php?id=<? echo $linha['id']; ?>" border="0"><IMG SRC="images/editar.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT="Alterar"></A></td>
		    <td width="3%" class="negrito" align="center">
				<a onClick="Excluir('../classes/controleMonografia.php?id=<? echo $linha['id']; ?>')" href="#"><IMG SRC="images/lixeira.jpg" WIDTH="16" HEIGHT="16" BORDER="0" ALT="Excluir"></A>
			</td>
	
		</tr>
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
		<legend class="negrito">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $xBusca;?></legend>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td width="100%" colspan="3" align="center" class="negrito">Nenhuma ocorr&ecirc;ncia para <B><?echo $xBusca;?></B></td>
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
	// Fechando as vari�veis de conex�o
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