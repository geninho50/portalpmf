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

	$idEvento = $_POST['idEvento'];
	if( $idEvento == 0 )
	{
		$idEvento = $_GET['idEvento'];
	}
	
	$nvaloresencontrados = 0;	
	$query = "SELECT id, nome,hora,solicitante, telefone, rua, bairro, descricao,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM evento where id=$idEvento";
	if( $idEvento > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
	}
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
   $resultado = $obj->executaQuery($sql);
   $linha = mysql_fetch_array($resultado);
   if( $linha )
   {
    	$login = $linha["login"];
   }
   
   //Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
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
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="100%" colspan="2">
	<!-- inicio do adm -->
		<?php
			if( $nvaloresencontrados > 0 )
			{
		?>
		<fieldset>
			<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B></legend>
		
		<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
			<tr>
				<td width="9%" align="center" class="branco">Vizualizar DOC </td>
				<td width="9%" align="center" class="branco"><B>Data</B></td>
				<td width="10%" align="center" class="branco"><B>Hora</B></td>
				<td width="55%" align="left" class="branco"><B>Nome</B></td>				
				<td width="9%" align="center" class="branco">Inserir DOC </td>
				<td width="3%" align="center" class="branco">&nbsp;</td>
				<td width="3%" align="center" class="branco">&nbsp;</td>		
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
				<td width="3%" align="center" class="letra">
									
					<? if( $tamanhonomearquivoordem > 0 ){?>
							<A HREF="javascript:POPUP('mostrar_pedido.php?idEvento=<?PHP echo $id; ?>','600','600')"><IMG SRC="imagens/editor_texto.png" title="EXISTE PEDIDO CADASTRADO PARA ESSE EVENTO" width="20" height="20" BORDER="0"></A>
					<? } ?>
				</td>
				<td width="3%" align="center" class="letra">
					<? if( $tamanhonomearquivo > 0 ){?>
							<A HREF="javascript:POPUP('mostrar_mapa.php?idEvento=<?PHP echo $id; ?>','600','600')"><IMG SRC="imagens/google_maps.png" title="EXISTE IMAGEM CADASTRADA PARA ESSE EBVENTO" width="20" height="20" BORDER="0"></A>
						<?php }?>
		
				</td>
				
				<td width="3%" align="center" class="letra">
					<? if( $tamanhonomearquivoteste > 0 ){?>
							<A HREF="javascript:POPUP('mostrar_autorizacao.php?idEvento=<?PHP echo $id; ?>','600','600')"><IMG SRC="imagens/bloco_notas.png" title="EXISTE AUTORIZACAO CADASTRADA PARA ESSE EVENTO" width="20" height="20" BORDER="0"></A>
					 <? } ?>
				</td>
				<td width="9%" align="center" class="negrito"><? echo $linha['dia'].' / '.$linha['mes'].' / '.$linha['ano']; ?></td>
				<td width="10%" align="center" class="negrito"><? echo $linha['hora']; ?></td>		
				<td width="55%" align="left" class="negrito">
					<A HREF="relatorio_final_evento.php?idEvento=<? echo $linha['id']; ?>&chave=3" border="0"><? echo $linha['nome']; ?></A>
					<a href="finalizar_naoatendimento_evento.php?idEvento=<? echo $linha['id']; ?>"><IMG SRC="imagens/negado.png" WIDTH="20" HEIGHT="20" BORDER="0" title="EVENTO NAO ATENDIDO."></A>
				</td>		
				<td width="3%" class="letra" align="center"><A HREF="cadastro_pedido_evento.php?idEvento=<? echo $linha['id']; ?>&chave=3" border="0"><IMG SRC="imagens/editor_texto.png" WIDTH="20" HEIGHT="20" BORDER="0" title="ADICIONAR PEDIDO PARA O EVENTO"></A></td>
				<td width="3%" class="letra" align="center"><A HREF="cadastro_mapa_evento.php?idEvento=<? echo $linha['id']; ?>&chave=1" border="0"><IMG SRC="imagens/google_maps.png" WIDTH="20" HEIGHT="20" BORDER="0" title="ADICIONAR MAPA AO EVENTO"></A></td>
				<td width="3%" class="letra" align="center"><A HREF="cadastro_altorizacao_evento.php?idEvento=<? echo $linha['id']; ?>&chave=2" border="0"><IMG SRC="imagens/bloco_notas.png" WIDTH="20" HEIGHT="20" BORDER="0" title="ADIONAR AUTORIZACAO NO EVENTO"></A></td>
				<td width="3%" class="letra" align="center"><A HREF="duplicar_cadastro_evento.php?idEvento=<? echo $linha['id']; ?>" border="0"><img src="imagens/copia.png" width="20" height="20" border="0" title="REALIZAR UMA COPIA DO EVENTO"></A></td>
				<td width="3%" class="letra" align="center"><A HREF="cadastro_evento.php?idEvento=<? echo $linha['id']; ?>" border="0"><IMG SRC="imagens/editar.png" WIDTH="20" HEIGHT="20" BORDER="0" title="ALTERAR EVENTO"></A></td>
				<td width="3%" class="letra" align="center"><a onClick="Excluir('../classes/controleEvento.php?idEvento=<? echo $linha['id']; ?>')" href="#"><IMG SRC="imagens/excluir.png" WIDTH="20" HEIGHT="20" BORDER="0" title="EXCLUIR EVENTO"></A></td>
			</tr>
		<?php
			}
		?>
		</table>
</fieldset>
		<?php
			}
		
			if( $nvaloresencontrados == 0 && $tamanho > 0 )
			{
				
		?>
		<fieldset>
			<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B></legend>
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		
			<tr>
				<td width="100%" colspan="3" align="center" class="letra">Nenhuma ocorr&ecirc;ncia</td>
			</tr>.
			
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