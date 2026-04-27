<? 
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past


	include("incValidaSessao.php");
	$idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
   
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
	
	
	$campos_query = "*";
	$final_query  = "FROM escalahoraextra ORDER BY data desc, horainicial desc";
	// Maximo de registros por pagina
	$maximo = 15;
	// Declaracao da pagina inicial
	$pagina = $_GET["pagina"];
	if($pagina == "") {
		$pagina = "1";
	}
	// Calculando o registro inicial
	$inicio = $pagina - 1;
	$inicio = $maximo * $inicio;
	// Conta os resultados no total da query
	$strCount = "SELECT COUNT(*) AS 'num_registros' $final_query";
	$resultado = $obj->executaQuery($strCount);
	//$query = mysql_query($strCount);
	$row = mysql_fetch_array($resultado);
	$total = $row["num_registros"];
	?>    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<!-- iniocio do adm -->
	<fieldset>
	<legend class="cabecalho">ADMINISTRAR ESCOLA DE HORA EXTRA</legend>
	<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
		<tr>
			<td width="3%" align="center" class="branco">&nbsp;</td>
			<td width="3%" align="center" class="branco">&nbsp;</td>
			<td width="3%" align="center" class="branco">&nbsp;</td>
			<td width="9%" align="center" class="branco"><B>Data</B></td>
			<td width="10%" align="center" class="branco"><B>Hora</B></td>
			<td width="54%" align="left" class="branco"><B>Evento</B></td>	
			<td width="3%" align="center" class="branco">&nbsp;</td>
			<td width="3%" align="center" class="branco">&nbsp;</td>
			<td width="3%" align="center" class="branco">&nbsp;</td>
			<td width="3%" align="center" class="branco">&nbsp;</td>
			<td width="3%" align="center" class="branco">&nbsp;</td>
		</tr> 
	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<?php
		
		$query="SELECT id,semana, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, horainicial, horafinal, local, chave,status, visivel $final_query LIMIT $inicio,$maximo";
		$resultado = $obj->executaQuery($query);
		while ( $linhaN = mysql_fetch_array($resultado) )
		{		
		
			$id = $linhaN['id'];
			$semana = $linhaN['semana'];
			$horainicial = $linhaN['horainicial'];
			$horafinal = $linhaN['horafinal'];
			$local = $linhaN['local'];
			$dia = $linhaN['dia'];
			$mes = $linhaN['mes'];
			$ano = $linhaN['ano'];
			$chave = $linhaN['chave'];
			$visivel = $linhaN['visivel'];
			$status = $linhaN['status'];
	?>
		<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
			<td width="3%" align="center" height="25" class="negrito" 
				<? 
				if($chave==1)
				{ 
                    echo'bgcolor=#AAE173';
			 	}
			 	if($chave==2)
				{
                	echo'bgcolor=#C9DDFC';
			 	}?> 
             >
			<? 
			if($visivel==1)
			{
				echo'off';
			}else{
				if($visivel==2)
				{
					echo'on';
				}
			}
			?>
			</td>
			<td width="3%" align="center" class="negrito"
            <? 
				if($chave==1)
				{ 
                    echo'bgcolor=#AAE173';
			 	}
			 	if($chave==2)
				{
                	echo'bgcolor=#C9DDFC';
			 	}?> 
            >
			<?php 
				if($chave==0)
				{
			?>
					<img src="imagens/a.png" width="18" height="18" border="0" title="ESCALA EM ABERTO" />
			<?PHP 
				}
				if($chave==1){
					
			?>
					<img src="imagens/montar.png" width="18" height="18" border="0" title="ESCALA MONTADA E ESPERANDO CONFIRMACAO"/>
			<?PHP 
				}
				if($chave==2){
					
			?>
					<img src="imagens/f.png" width="18" height="18" border="0" title="ESCALA DE HORA EXTRA FINALIZADA COM SUCESSO"/>
			<?PHP 
				} 
			?></td>
			<td width="3%" align="center" height="25" class="negrito"
            <? 
				if($chave==1)
				{ 
                    echo'bgcolor=#AAE173';
			 	}
			 	if($chave==2)
				{
                	echo'bgcolor=#C9DDFC';
			 	}?> 
            ><A HREF="../classes/controleExcluirEscala.php?idescala=<?PHP echo $id; ?> " border="0"><IMG SRC="imagens/excluir.png" title="EXCLUIR ESCALA" width="20" height="20" BORDER="0"></A></td>		
			<td width="9%" align="center" class="negrito"
            <? 
				if($chave==1)
				{ 
                    echo'bgcolor=#AAE173';
			 	}
			 	if($chave==2)
				{
                	echo'bgcolor=#C9DDFC';
			 	}?> 
            ><?php echo $dia." / ".$mes." / ".$ano; ?></td>		
			<td width="10%" align="center" class="negrito"
            <? 
				if($chave==1)
				{ 
                    echo'bgcolor=#AAE173';
			 	}
			 	if($chave==2)
				{
                	echo'bgcolor=#C9DDFC';
			 	}?> 
            ><? echo $linhaN['horainicial']; ?> as <? echo $linhaN['horafinal']; ?></td>		
			<td width="54%" align="left" class="negrito"
            <? 
				if($chave==1)
				{ 
                    echo'bgcolor=#AAE173';
			 	}
			 	if($chave==2)
				{
                	echo'bgcolor=#C9DDFC';
			 	}?> 
            ><A HREF="cadastro_escala_horaextra.php?id=<? echo $linhaN['id']; ?>" 
			title="
			<?
				$sqlCan = "select * from tempcandidatos where idescala=$id order by login asc";
				$resultCan = $obj->executaQuery($sqlCan);
				while ( $linhaCan = mysql_fetch_array($resultCan) )
				{
					echo $nomesCan = $linhaCan['login'].'&#13;';
				}
			?>
			"><? echo $linhaN['local'].' - '.$semana; ?></A></td>		
			<td width="3%" class="negrito" align="center">
			<?
				if($status=='S'){
			?>
				<A HREF="../classes/controleVisivelEscala.php?idescala=<? echo $linhaN['id']; ?>&status=N" border="0"><IMG SRC="imagens/sinal_verde.png" title="ESCALA VISIVEL PARA OS GUARDAS" width="16" height="16" BORDER="0"></A>
			<?		
				}else{
					if($status=="N"){
			?>		
				<A HREF="../classes/controleVisivelEscala.php?idescala=<? echo $linhaN['id']; ?>&status=S" border="0"><IMG SRC="imagens/sinal_vermelho.png" title="ESCALA NAO VISIVEL PARA OS GUARDAS" width="16" height="16" BORDER="0"></A>
			<?		
					}
				}
			?>
			
			</td>
			<td width="3%" class="negrito" align="center"><A HREF="montar_escala_he_frequencia.php?idescala=<? echo $linhaN['id']; ?>" border="0"><IMG SRC="imagens/montar.png" title="MONTAR ESCALA" width="20" height="20" BORDER="0"></A></td>
			<td width="3%" class="negrito" align="center"><A HREF="adicionar_nome_escala.php?idescala=<? echo $linhaN['id']; ?>" border="0"><IMG SRC="imagens/adicionar.png" title="ADICIONAR GUARDAS A ESCALA" width="20" height="20" BORDER="0"></A></td>
			<td width="3%" class="negrito" align="center"><A HREF="trocar_chefe_escala.php?idescala=<? echo $linhaN['id']; ?>" border="0"><IMG SRC="imagens/TR.png" title="TROCAR CHEFE DE GUARNICAO" width="20" height="20" BORDER="0"></A></td>
			<td width="3%" class="negrito" align="center"><A HREF="confirmar_escala_horaextra.php?idescala=<? echo $linhaN['id']; ?>" border="0"><IMG SRC="imagens/confirmar.png" title="CONFIRMAR ESCALA" width="20" height="20" BORDER="0"></A></td>
		</tr>
	
	<?php
		}
	?>
	</table>
</fieldset>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td align="center">
		
		<?
		$menos = $pagina - 1;
		$mais = $pagina + 1;
		 
		$pgs = ceil($total / $maximo);
		 
		if($pgs > 1 ) {
	 
			echo "<br />";
	 
		 // Mostragem de pagina
			if($menos > 0) {
				echo "<a href=".$_SERVER['PHP_SELF']."?pagina=$menos>anterior</a>&nbsp; ";
		 }
	 
			// Listando as paginas
			for($i=1;$i <= $pgs;$i++) {
				if($i != $pagina) {
					echo " <a href=".$_SERVER['PHP_SELF']."?pagina=".($i).">$i</a> | ";
				} else {
					echo " <strong>".$i."</strong> | ";
				}
			}
	 
			if($mais <= $pgs) {
				echo " <a href=".$_SERVER['PHP_SELF']."?pagina=$mais>proximo</a>";
			}
		}
		?>
		
		</td>
	  </tr>
	</table>
	
	<!-- fim do adm -->
			<table width="100%"  border="0" cellspacing="1" cellpadding="1">
			  <tr>
				<td width="2%" align="right"><img src="imagens/montar.png" title="MONTAR" width="20" height="20" border="0" /></td>
				<td width="25%" class="negrito">Montar Escala de Hora-Extra </td>
				<td width="2%" align="center" class="letra"><img src="imagens/impressora.png" title="IMPRIMIR" width="20" height="20" border="0" /></td>
				<td width="25%" class="negrito">Imprimir Escala de Hora-Extra </td>
				<td width="2%" align="center" class="letra"><img src="imagens/TR.png" width="20" height="20" /></td>
				<td width="44%" class="negrito">Trocar chefe de Guarni&ccedil;&atilde;o </td>
			  </tr>
			  <tr>
				<td align="right"><img src="imagens/adicionar.png" width="20" height="20" /></td>
				<td class="negrito">Adicionar mais Guardas a Escala </td>
				<td align="center"><img src="imagens/confirmar.png" title="CONFIRMAR" width="20" height="20" border="0" /></td>
				<td class="negrito">Confirmar Escala de Hora-Extra </td>
				<td class="letra">&nbsp;</td>
				<td class="letra">&nbsp;</td>
			  </tr>
			  <tr>
				<td align="right"><img src="imagens/excluirgm.png" width="20" height="20" /></td>
				<td class="negrito">Excluir Candidato da Escala </td>
				<td align="center"><img src="imagens/excluir.png" title="EXCLUIR"  width="20" height="20" /></td>
				<td class="negrito">Excluir Escala de Hora-Extra</td>
				<td class="letra">&nbsp;</td>
				<td class="letra">&nbsp;</td>
			  </tr>
			</table>
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