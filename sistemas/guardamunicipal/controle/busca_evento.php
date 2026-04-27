<?php
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	$objT = new trataArquivo;
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	$xBusca = "";
	$xBusca = $_POST['xBusca'];
	$data = "";
	$data = $_POST['dataini'];
	
	$xBusca = trim($xBusca);
	$tamanho = strlen($xBusca);
	$nvaloresencontrados = 0;	
	$query = "SELECT id, nome,horainicial,horafinal, responsavel, telefone, rua, bairro, descricao, tipoautorizacao,tipoordem,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM evento where UPPER(nome) like UPPER('%$xBusca%') and data='".$data."' order by data asc";
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
	<legend class="negrito">Consultar Eventos</legend>
	<form name="form1" method="post" action="busca_evento.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">

		<INPUT TYPE="hidden" name="cadastro" value="true">
		
		<table width="67%" border="0" cellspacing="1" cellpadding="1">
		
		  <tr>
			<td width="40%" align="right" class="letra">Digite o <B>Nome</B> do Evento:</td>
			<td width="31%"><input name="xBusca" type="text" size="30" value="<?echo $xBusca;?>"/></td>
			  <td width="29%"><input name="Submit" type="submit" class="botao" id="Pesquisar" value="Pesquisar" onClick="onClickButton(null,'Aguarde...','','Pesquisar')" />	  
			  </td>
		  </tr>
		
		  <tr>
			<td align="right">Data:</td>
			<td>
			<input value="<? echo $dataini;?>" name="dataini" class="stylo1" size="12" />
					<a onClick="displayCalendar(document.forms[0].dataini,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
			</td>
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
		
		<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
			<tr>
				<td width="2%" align="center" class="branco">&nbsp;</td>
				<td width="2%" align="center" class="branco">&nbsp;</td>
				<td width="2%" align="center" class="branco">&nbsp;</td>
				<td width="12%" align="center" class="branco">&nbsp;</td>
				<td width="8%" align="center" class="branco"><B>Data</B></td>
				<td width="9%" align="center" class="branco"><B>Hora</B></td>
				<td width="51%" align="left" class="branco"><B>Nome</B></td>				
				<td width="2%" align="center" class="branco">&nbsp;</td>
				<td width="2%" align="center" class="branco">&nbsp;</td>
				<td width="2%" align="center" class="branco">&nbsp;</td>
				<td width="2%" align="center" class="branco">&nbsp;</td>
				<td width="2%" align="center" class="branco">&nbsp;</td>		
				<td width="2%" align="center" class="branco">&nbsp;</td>
				<td width="2%" align="center" class="branco">&nbsp;</td>
			</tr> 
		</table>
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<?php
			$chavet = true;
			$resultado = $obj->executaQuery($query);
			
			$path = $objT->getPath(16);
			$pathordem = $objT->getPath(15);
			$pathautorizacao = $objT->getPath(18);
			
			while ( $linha = mysql_fetch_array($resultado) )
			{
				// Path onde as Noticias sao cadastradas
				$path = $objT->getPath(16).$linha['id']."/";
				$nomearquivo = $objT->retornaArquivo($path);
				$tamanhonomearquivo = strlen($nomearquivo);
				
				$pathordem = $objT->getPath(15).$linha['id']."/";
				$nomearquivoordem = $objT->retornaArquivo($pathordem);
				$tamanhonomearquivoordem = strlen($nomearquivoordem);
				
				$pathteste = $objT->getPath(18).$linha['id']."/";
				$nomearquivoteste = $objT->retornaArquivo($pathteste);
				$tamanhonomearquivoteste = strlen($nomearquivoteste);
				
				$id = $linha['id'];
				$tipo_at = $linha['tipoautorizacao'];
				$tipo_or = $linha['tipoordem'];
				
				$sql = "select * from chefes_evento where idevento=$id";
				
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
				<td width="2%" align="center" class="letra">
					<? if( $tamanhonomearquivo > 0 ){?>
							<A HREF="javascript:POPUP('fotos/eventogratis/<?PHP echo $id; ?>/<?PHP echo $id; ?>_1.jpg','600','600')"><IMG SRC="imagens/mapa.png" title="Existe imagem cadastrada para esse evento" width="16" height="16" BORDER="0"></A>
						<?php }?>
		
				</td>
				
				<td width="2%" align="center" class="letra">
					<? if( $tamanhonomearquivoteste > 0 ){?>
							<A HREF="javascript:POPUP('fotos/autorizacao/<?PHP echo $id; ?>/<?PHP echo $nomearquivoteste; ?>','600','600')"><IMG SRC="imagens/historico.gif" title="Existe Autoriza��o cadastrada para esse evento" width="14" height="16" BORDER="0"></A>
					 <? } ?>
				</td>
				<td width="2%" align="center" class="letra">
									
					<? if( $tamanhonomearquivoordem > 0 ){?>
							<A HREF="forcaDownload.php?id=<? echo $id ?>&file=<? echo $pathordem ?>&tipo=<?php echo $tipo_or; ?>"><IMG SRC="imagens/outros.gif" title="Existe Ordem de Servi�o cadastrada para esse evento" width="16" height="16" BORDER="0"></A>
					<? } ?>
				</td>
				<td width="12%" align="center" class="letra">
					<? 
						$result = $obj->executaQuery($sql);
						while ( $dados = mysql_fetch_array($result) )
						{
							$chefe = $dados['nome'];
							echo '<fonte class=negrito> >'.$chefe.'</font> ';
						}
					?>
				</td>
				<td width="8%" align="center" class="negrito"><? echo $linha['dia'].' / '.$linha['mes'].' / '.$linha['ano']; ?></td>
				<td width="9%" align="center" class="negrito"><? echo $linha['horainicial'].' �s '.$linha['horafinal']; ?></td>		
				<td width="51%" align="left" class="negrito"><? echo $linha['nome']; ?></td>		
				<td width="2%" class="letra" align="center"><A HREF="cadastro_mapa_evento.php?idEvento=<? echo $linha['id']; ?>&chave=1" border="0"><IMG SRC="imagens/mapa.png" WIDTH="16" HEIGHT="16" BORDER="0" title="Adicionar MAPA ao evento"></A></td>
				<td width="2%" class="letra" align="center"><A HREF="cadastro_altorizacao_evento.php?idEvento=<? echo $linha['id']; ?>&chave=2" border="0"><IMG SRC="imagens/historico.gif" WIDTH="14" HEIGHT="16" BORDER="0" title="Adicionar AUTORIZA&Ccedil;&Atilde;O no evento"></A></td>
				<td width="2%" class="letra" align="center"><A HREF="cadastro_ordemservico_evento.php?idEvento=<? echo $linha['id']; ?>&chave=3" border="0"><IMG SRC="imagens/outros.gif" WIDTH="16" HEIGHT="16" BORDER="0" title="Adicionar ORDEN DE SERVI&Ccedil;O ao evento"></A></td>
				<td width="2%" class="letra" align="center"><A HREF="cadastro_chefe_evento.php?idEvento=<? echo $linha['id']; ?>" border="0"><IMG SRC="imagens/novo.gif" WIDTH="16" HEIGHT="16" BORDER="0" title="Adicionar CHEFE ao evento"></A></td>
				<td width="2%" class="letra" align="center"><A HREF="cadastro_evento.php?idEvento=<? echo $linha['id']; ?>" border="0"><IMG SRC="imagens/editar.gif" WIDTH="20" HEIGHT="20" BORDER="0" title="Alterar"></A></td>
				<td width="2%" class="letra" align="center"><a onClick="Excluir('../classes/controleEvento.php?idEvento=<? echo $linha['id']; ?>')" href="#"><IMG SRC="imagens/lixeira.jpg" WIDTH="16" HEIGHT="16" BORDER="0" title="Excluir"></A></td>
				<td width="2%" class="letra" align="center"><A HREF="javascript:POPUP('imprimir_evento.php?idEvento=<? echo $linha['id']; ?>','600','600')"><IMG SRC="imagens/impressora4.jpg" WIDTH="16" HEIGHT="16" BORDER="0" title="Imprimir"></A></td>
			</tr>
		<?php
			}
		?>
			
		</table>
		
		
		
		</td>
		</tr>
		</table>
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="3%" align="center"><img src="images/mapa.png" width="16" height="16" /></td>
			<td width="97%" class="negrito">Adicionar MAPA ao evento. </td>
		  </tr>
		  <tr>
			<td align="center"><img src="images/historico.gif" width="14" height="16" /></td>
			<td class="negrito">Adicionar AUTORIZA&Ccedil;&Atilde;O no evento. </td>
		  </tr>
		  <tr>
			<td align="center"><img src="images/outros.gif" width="16" height="16" /></td>
			<td class="negrito">Adicionar ORDEN DE SERVI&Ccedil;O ao evento.</td>
		  </tr>
		  <tr>
			<td align="center"><img src="images/novo.gif" width="16" height="16" /></td>
			<td class="negrito">Adicionar CHEFE ao evento.</td>
		  </tr>
		
		</table>
		</fieldset>
		<?php
			}
		
			if( $nvaloresencontrados == 0 && $tamanho > 0 )
			{
				
		?>
		<fieldset>
			<legend class="letra">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $xBusca;?></legend>
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		
			<tr>
				<td width="100%" colspan="3" align="center" class="letra">Nenhuma ocorr&ecirc;ncia para <B><?echo $xBusca;?></B></td>
			</tr>
			
		</table>
		
		
		</fieldset>
		<?php	
			}
		?>
	<!-- fim do adm -->
	
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