<?php
	ini_set('default_charset','UTF-8');
	
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

	$xBusca = $_GET['xBusca'];

	$xBusca = "";
	$xBusca = $_POST['xBusca'];

	$xBusca = trim($xBusca);
	$tamanho = strlen($xBusca);
	$nvaloresencontrados = 0;	
	$query = "SELECT id, nome,hora,solicitante, telefone, rua, bairro, descricao,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM evento where UPPER(nome) like UPPER('%$xBusca%') order by data asc";
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
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
    <td colspan="2">  
  <tr>
    <td width="100%" colspan="2">
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">CONSULTAR EVENTOS POR NOME</legend>
	<form name="form1" method="post" action="busca_evento_nome.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">

		<INPUT TYPE="hidden" name="cadastro" value="true">
		
		<table width="67%" border="0" cellspacing="1" cellpadding="1">
		
		  <tr>
			<td width="40%" align="right" class="letra">Digite o <B>Nome</B> do Evento:</td>
			<td width="31%"><input name="xBusca" type="text" size="30" value="<?echo $xBusca;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
			  <td width="29%"><input name="Submit" type="submit" class="letra" id="Pesquisar" value="Pesquisar" onClick="onClickButton(null,'Aguarde...','','Pesquisar')" />	  
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
			<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA <?echo $xBusca;?></legend>
		
		<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
			<tr>
				<td width="9%" align="center" class="branco">Vizualizar DOC </td>
				<td width="14%" align="center" class="branco"><B>Data</B></td>
				<td width="9%" align="center" class="branco"><B>Hora</B></td>
				<td width="65%" align="left" class="branco"><B>Nome</B></td>				
				<td width="3%" align="center" class="branco">&nbsp;</td>
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
				<td width="3%" align="center" class="letra">
									
					<? if( $tamanhonomearquivoordem > 0 ){?>
							<A HREF="javascript:POPUP('mostrar_pedido.php?idEvento=<?PHP echo $id; ?>','600','600')"><IMG SRC="imagens/editor_texto.png" title="Existe Pedido cadastrada para esse evento" width="20" height="20" BORDER="0"></A>
					<? } ?>
				</td>
				<td width="3%" align="center" class="letra">
					<? if( $tamanhonomearquivo > 0 ){?>
							<A HREF="javascript:POPUP('mostrar_mapa.php?idEvento=<?PHP echo $id; ?>','600','600')"><IMG SRC="imagens/google_maps.png" title="Existe imagem cadastrada para esse evento" width="20" height="20" BORDER="0"></A>
						<?php }?>
		
				</td>
				
				<td width="3%" align="center" class="letra">
					<? if( $tamanhonomearquivoteste > 0 ){?>
							<A HREF="javascript:POPUP('mostrar_autorizacao.php?idEvento=<?PHP echo $id; ?>','600','600')"><IMG SRC="imagens/bloco_notas.png" title="Existe Autorizacao cadastrada para esse evento" width="20" height="20" BORDER="0"></A>
					 <? } ?>
				</td>
				<td width="14%" align="center" class="negrito"><? echo $linha['dia'].' / '.$linha['mes'].' / '.$linha['ano']; ?></td>
				<td width="9%" align="center" class="negrito"><? echo $linha['hora']; ?></td>		
				<td width="65%" align="left" class="negrito"><? echo $linha['nome']; ?></td>		
		    <td width="3%" class="letra" align="center"><A HREF="javascript:POPUP('imprimir_evento.php?idEvento=<? echo $linha['id']; ?>','600','600')"><IMG SRC="imagens/impressora.png" WIDTH="20" HEIGHT="20" BORDER="0" title="Imprimir"></A></td>
		</tr>
		<?php
			}
		?>
			
		</table>
</table>
		
        <?php
			}
		
			if( $nvaloresencontrados == 0 && $tamanho > 0 )
			{
				
		?>
<fieldset>
			<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA <?echo $xBusca;?></legend>
		
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