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

	$xMes = $_POST['Mes'];
	$xAno = $_POST['Ano'];
	
	$nvaloresencontrados = 0;	

	if($xMes == 13 & $xAno != 13){
		$query = "SELECT id, nome,hora,solicitante, telefone, rua, bairro, descricao,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM evento where YEAR(data)=$xAno order by data asc";
		//echo'Ano: '.$query;
	}else{
		if($xAno == 13 & $xMes != 13){
			$query = "SELECT id, nome,hora,solicitante, telefone, rua, bairro, descricao,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM evento where MONTH(data)=$xMes order by data asc";
			//echo'Mes: '.$query;
		}else{
			if($xMes == 13 & $xAno == 13){
				$query = "SELECT id, nome,hora,solicitante, telefone, rua, bairro, descricao,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM evento order by data asc";
				//echo'Todos: '.$query;
			}else{
				$query = "SELECT id, nome,hora,solicitante, telefone, rua, bairro, descricao,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM evento where MONTH(data)=$xMes and YEAR(data)=$xAno order by data asc";
				//echo'Mes e Ano: '.$query;
			}
		}
	}
	$nvaloresencontrados = $obj->numregistros($query);
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
	<legend class="cabecalho">CONSULTAR EVENTOS POR MÊS</legend>
	<form name="form1" method="post" action="busca_evento_mes.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">

		<INPUT TYPE="hidden" name="cadastro" value="true">
		
		<table width="67%" border="0" cellspacing="1" cellpadding="1">
		
		  <tr>
			<td width="40%" align="right">Mes:</td>
			<td width="31%"><select name="Mes" class="negrito">
		  <option value="13">Todos</option>
		  <option value="01">01</option>
		  <option value="02">02</option>
		  <option value="03">03</option>
		  <option value="04">04</option>
		  <option value="05">05</option>
		  <option value="06">06</option>
		  <option value="07">07</option>
		  <option value="08">08</option>
		  <option value="09">09</option>
		  <option value="10">10</option>
		  <option value="11">11</option>
		  <option value="12">12</option>
		</select></td>
		  </tr>
		  <tr>
			<td align="right">Ano:</td>
			<td><select name="Ano" class="negrito">
		  <option value="13">Todos</option>
		  <option value="2010">2010</option>
		  <option value="2011">2011</option>
		  <option value="2012">2012</option>
		  <option value="2013">2013</option>
          <option value="2014">2014</option>
          <option value="2015">2015</option>
		</select></td>
		<td width="29%"><input name="Submit" type="submit" class="letra" id="Pesquisar" value="Pesquisar" onClick="onClickButton(null,'Aguarde...','','Pesquisar')" />	  
		  </tr>
		</table>
		
		
		
	</form>
  </fieldset>
		
		<?php
			if( $nvaloresencontrados > 0 )
			{
		?>
		<fieldset>
			<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B></legend>
		
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
				<td width="65%" align="left" class="negrito"><? echo $linha['nome'];?></td>		
		    <td width="3%" class="letra" align="center"><A HREF="javascript:POPUP('imprimir_evento.php?idEvento=<? echo $linha['id']; ?>','600','600')"><IMG SRC="imagens/impressora.png" WIDTH="20" HEIGHT="20" BORDER="0" title="Imprimir"></A></td>
		</tr>
		<?php
			}
		?>
			
		</table>
</table>
		
        <?php
			}
		
			if( $nvaloresencontrados == 0 )
			{
				
		?>
<fieldset>
			<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B></legend>
		
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