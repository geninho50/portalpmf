<?php
	ini_set('default_charset','UTF-8');
	
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

	$nvaloresencontrados = 0;
	$query = "SELECT * FROM monografia order by nome asc LIMIT 0, 30";
	$nvaloresencontrados = $obj->numregistros($query);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
<fieldset>
	<legend class="cabecalho">RETORNOU <B><?echo $nvaloresencontrados;?></B> MONOGRAFIAS CADASTRADAS</legend>

    <table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
      <tr>
        <td width="19%" align="left" class="branco"><b>Autor</b></td>
        <td width="36%" align="left" class="branco"><b>Título do Trabalho</b></td>
        <td width="8%" align="center" class="branco"><b>Download</b></td>
        <td width="5%" align="center" class="branco"><strong>Ano</strong></td>
        <td width="12%" align="center" class="branco"><b>Tipo</b></td>
        <td width="14%" align="center" class="branco"><b>Tamanho</b></td>
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
				<legend class=style1><FONT class=style1><B>Infomações</B></FONT></legend>	
					<table width=90% border=0 cellspacing=1 cellpadding=1>
						<tr  bgcolor="#FFFFCC">
							<td width=30% align=right valign=top><FONT class=style5><B>Autor: </B></FONT></td>
							<td width=2% align=right valign=top>&nbsp;</td>
							<td width=70% align=left class=style2><?php echo $nome; ?></td>
						</tr>
						<tr bgcolor="#FFFFCC">
							<td width=30% align=right valign=top><FONT class=style5><B>Título do Trabalho: </B></FONT></td>
							<td width=2% align=right valign=top>&nbsp;</td>
							<td width=70% align=left class=style2><?php echo $linha['t_trabalho']; ?></td>
						</tr>
						<tr>
							<td width=30% align=right valign=top><FONT class=style5><B>Ano: </B></FONT></td>
							<td width=2% align=right valign=top>&nbsp;</td>
							<td width=70% align=left class=style2><?php echo $linha['ano']; ?></td>
						</tr>
						<tr>
							<td width=30% align=right valign=top><FONT class=style5><B>Título: </B></FONT></td>
							<td width=2% align=right valign=top>&nbsp;</td>
							<td width=70% align=left class=style2><?php echo $linha['titulo']; ?></td>
						</tr>
						<tr>
							<td width=30% align=right valign=top><FONT class=style5><B>Curso: </B></FONT></td>
							<td width=2% align=right valign=top>&nbsp;</td>
							<td width=70% align=left class=style2><?php echo $linha['t_especializacao']; ?></td>
						</tr>
						<tr>
							<td width=30% align=right valign=top><FONT class=style5><B>Postado em: </B></FONT></td>
							<td width=2% align=right valign=top>&nbsp;</td>
							<td width=70% align=left class=style2><?php echo $objDt->formataDataPInterface($linha['data']); ?></td>
						</tr>
						<tr>
							<td width=30% align=right valign=top><FONT class=style5><B>Tamanho: </B></FONT></td>
							<td width=2% align=right valign=top>&nbsp;</td>
							<td width=70% align=left class=style2><?php echo $tamanho_k; ?></FONT> (<?php echo $tamanho_arquivo; ?> bytes)</td>
						</tr>
						<tr>
							<td width=30% align=right valign=top><FONT class=style5><B>Download: </B></FONT></td>
							<td width=2% align=right valign=top>&nbsp;</td>
							<td width=70% align=left class=style2>
							<?php if($tamanho_arquivo>0){ ?>
							<A HREF="forcaDownload.php?id=<? echo $id ?>&file=<? echo $path ?>&tipo=<?php echo $tipo; ?>"><IMG SRC="imagens/downloadarquivo.png" width="16" height="16" BORDER="0"></A>
							<?php } else { echo "arquivo não encontrado"; } ?>
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
		<td width="8%" align="center" class="negrito"><?php if($tamanho_arquivo>0){ ?><A HREF="forcaDownload.php?id=<? echo $id ?>&file=<? echo $path ?>&tipo=<?php echo $tipo; ?>"><IMG SRC="imagens/anexar.png" width="18" height="18" BORDER="0"></A><?php } else { echo "arquivo n�o encontrado"; } ?></td>
		<td width="5%" align="center" class="negrito"><? echo $linha['ano']; ?></td>
		<td width="12%" align="center" class="negrito"><? echo $linha['tipo']; ?></td>
		<td width="14%" align="center" class="negrito"><FONT SIZE="1"><FONT COLOR="#FF6666"><?php echo $tamanho_k; ?></FONT> (<?php echo $tamanho_arquivo; ?> bytes)</FONT></td>
	</tr>
<?php
	}
?>
	
</table>

</fieldset>


	<!--fim adm-->
	</td>
  </tr>
</table>

<BR>


	<fieldset>
		<legend class="cabecalho">MATERIAL DIGITAL</legend>
	
	<table  bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
		<tr>
			<td width="45%" align="left" class="branco"><B>Nome</B></td>
			<td width="9%" align="center" class="branco"><B>download</B></td>
			<td width="10%" align="center" class="branco"><B>postado em</B></td>
			<td width="19%" align="left" class="branco"><B>tamanho</B></td>
		</tr> 
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<?php
		$chave = true;
		$queryD = "SELECT * FROM digital order by data desc";
		$resultadoD = $obj->executaQuery($queryD);
		while ( $linhaD = mysql_fetch_array($resultadoD) )
		{
			$id = $linhaD['id'];
			$guarda = $linhaD['guarda'];
			$titulo = $linhaD['titulo'];
			$ano = $linhaD['ano'];
			$nomearquivo = $linhaD['nomearquivo'];
			$tamanho_arquivo = $linhaD['tamanho'];
			$path = $objT->getPath(6).$id."/".$nomearquivo;
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
	
			<td width="45%" style="cursor: pointer" align="left" class="negrito" onclick="openDialog('content<?php echo $id; ?>');"><FONT COLOR="black"><? echo $linhaD['titulo']; ?></FONT>
			
			<span id="content<?php echo $id; ?>" style="display:none">
			  <table align=center valign=middle width=100%>
				<tr>
				<td>
					<fieldset class=style1>
					<legend class=style1><FONT class=style1><B>Infomações</B></FONT></legend>	
						<table width=90% border=0 cellspacing=1 cellpadding=1>
						<tr  bgcolor="#FFFFCC">
						<td width=25% align=right valign=top><FONT class=style5><B>nome: </B></FONT></td>
						<td width=2% align=right valign=top>&nbsp;</td>
						<td width=75% align=left class=style2><?php echo $nome; ?></td>
						</tr>
						<tr>
						<td width=25% align=right valign=top><FONT class=style5><B>postado em: </B></FONT></td>
						<td width=2% align=right valign=top>&nbsp;</td>
						<td width=75% align=left class=style2><?php echo $objDt->formataDataPInterface($linhaD['data']); ?></td>
						</tr>
						<tr>
						<td width=25% align=right valign=top><FONT class=style5><B>tamanho: </B></FONT></td>
						<td width=2% align=right valign=top>&nbsp;</td>
						<td width=75% align=left class=style2><?php echo $tamanho_k; ?></FONT> (<?php echo $tamanho_arquivo; ?> bytes)</td>
						</tr>
						<tr bgcolor="#FFFFCC">
						<td width=25% align=right valign=top><FONT class=style5><B>descrição: </B></FONT></td>
						<td width=2% align=right valign=top>&nbsp;</td>
						<td width=75% align=left class=style2><?php echo $descricao; ?></td>
						</tr>
						<tr>
						<td width=25% align=right valign=top><FONT class=style5><B>download: </B></FONT></td>
						<td width=2% align=right valign=top>&nbsp;</td>
						<td width=75% align=left class=style2>
						<?php if($tamanho_arquivo>0){ ?>
						<A HREF="forcaDownload.php?id=<? echo $id ?>&file=<? echo $path ?>"><IMG SRC="imagens/downloadarquivo.png" BORDER="0"></A>
						<?php } else { echo "arquivo não encontrado"; } ?>
						</td>
						</tr>
						</table>
					</fieldset>
				</td>
				</tr>
			</table>
			</span>
			
			</td>
	
			<td width="9%" align="center" class="negrito"><?php if($tamanho_arquivo>0){ ?><A HREF="forcaDownload.php?id=<? echo $id ?>&file=<? echo $path ?>"><IMG SRC="imagens/anexar.png" width="20" height="20" BORDER="0"></A><?php } else { echo "arquivo não encontrado"; } ?></td>
			
			<td width="10%" align="center" class="negrito"><? echo $objDt->formataDataPInterface($linhaD['data']); ?></td>
	
	
			<td width="19%" align="left" class="negrito"><FONT SIZE="1"><FONT COLOR="#FF6666"><?php echo $tamanho_k; ?></FONT> (<?php echo $tamanho_arquivo; ?> bytes)</FONT></td>
	
		</tr>
	<?php
		}
	?>
		
	</table>
	
	</fieldset>




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