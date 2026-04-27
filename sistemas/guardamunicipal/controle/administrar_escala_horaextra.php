<? 
// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
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
	// Declara��o da pagina inicial
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
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">
	<!-- ini menu -->
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
    <!-- fim menu -->
	</th>
  </tr>
   <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!-- iniocio do adm -->
	<fieldset>
	<legend class="negrito">Administrar Escala de Hora Extra</legend>
	<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
		<tr>
			<td width="2%" align="center" class="branco">&nbsp;</td>
			<td width="2%" align="center" class="branco">&nbsp;</td>
			<td width="2%" align="center" class="branco">&nbsp;</td>
			<td width="7%" align="center" class="branco"><B>Data</B></td>
			<td width="9%" align="center" class="branco"><B>Hora</B></td>
			<td width="60%" align="left" class="branco"><B>Evento</B></td>	
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
			<td width="2%" align="center" height="25" class="negrito">
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
			<td width="2%" align="center" class="negrito">
			<?php 
				if($chave>0)
				{
			?>
					<a href="javascript:POPUP('listar_horas_cadidatos.php?idescala=<?php echo $id; ?>','400','450')"><img src="images/true.gif" border="0" title="CONFIRMAR HORAS DOS CANDIDATOS" /></a>
			<?PHP 
				}else{
			?>
					<A HREF="../classes/controleEncerrarEscala.php?idescala=<?PHP echo $id; ?>&chave=1 ?>" border="0"><img src="images/false.gif" border="0" /> </A>
			<?PHP 
					} 
			?></td>
			<td width="2%" align="left" height="25" class="negrito"><A HREF="../classes/controleExcluirEscala.php?idescala=<?PHP echo $id; ?> " border="0"><IMG SRC="images/lixeira.jpg" title="Excluir Escala" width="16" height="16" BORDER="0"></A></td>		
			<td width="7%" align="center" class="negrito"><?php echo $dia." / ".$mes." / ".$ano; ?></td>		
			<td width="9%" align="center" class="negrito"><? echo $linhaN['horainicial']; ?> as <? echo $linhaN['horafinal']; ?></td>		
			<td width="60%" align="left" class="negrito"><A HREF="cadastro_escala_horaextra.php?id=<? echo $linhaN['id']; ?>" 
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
			<td width="2%" class="negrito" align="center">
			<?
				if($status=='S'){
			?>
				<A HREF="../classes/controleVisivelEscala.php?idescala=<? echo $linhaN['id']; ?>&status=N" border="0"><IMG SRC="images/sinal_verde.png" title="Escala visivel para os Guardas" width="16" height="16" BORDER="0"></A>
			<?		
				}else{
					if($status=="N"){
			?>		
				<A HREF="../classes/controleVisivelEscala.php?idescala=<? echo $linhaN['id']; ?>&status=S" border="0"><IMG SRC="images/sinal_vermelho.png" title="Escala nao visivel para os Guardas" width="16" height="16" BORDER="0"></A>
			<?		
					}
				}
			?>
			
			</td>
			<td width="2%" class="negrito" align="center"><A HREF="montar_escala_he_frequencia.php?idescala=<? echo $linhaN['id']; ?>" border="0"><IMG SRC="images/novo.gif" title="Montar Escala" width="16" height="16" BORDER="0"></A></td>
			<td width="2%" class="negrito" align="center"><A HREF="adicionar_nome_escala.php?idescala=<? echo $linhaN['id']; ?>" border="0"><IMG SRC="images/funcionario.gif" title="Adicionar Guarda a Escala" width="18" height="18" BORDER="0"></A></td>
			<td width="2%" class="negrito" align="center"><A HREF="excluir_nome_escala.php?idescala=<? echo $linhaN['id']; ?>" border="0"><IMG SRC="images/excluir_fun.png" title="Excluir Guarda da Escala" width="16" height="16" BORDER="0"></A></td>
			<td width="2%" class="negrito" align="center"><A HREF="trocar_chefe_escala.php?idescala=<? echo $linhaN['id']; ?>" border="0"><IMG SRC="images/novopreso.gif" title="Trocar Chefe de Guarni��o" width="16" height="16" BORDER="0"></A></td>
			<td width="2%" class="negrito" align="center"><A HREF="confirmar_escala_horaextra.php?idescala=<? echo $linhaN['id']; ?>" border="0"><IMG SRC="images/reincidente.gif" title="Confirmar Escala" width="16" height="16" BORDER="0"></A></td>
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
				<td width="2%" align="right"><img src="images/novo.gif" title="Montar" width="16" height="16" border="0" /></td>
				<td width="25%" class="negrito">Montar Escala de Hora-Extra </td>
				<td width="2%" align="center" class="letra"><img src="images/impressora4.jpg" title="Imprimir" width="16" height="16" border="0" /></td>
				<td width="25%" class="negrito">Imprimir Escala de Hora-Extra </td>
				<td width="2%" align="center" class="letra"><img src="images/novopreso.gif" width="16" height="16" /></td>
				<td width="44%" class="negrito">Trocar chefe de Guarni&ccedil;&atilde;o </td>
			  </tr>
			  <tr>
				<td align="right"><img src="images/funcionario.gif" width="18" height="18" /></td>
				<td class="negrito">Adicionar mais Guardas a Escala </td>
				<td align="center"><img src="images/reincidente.gif" title="Confirmar" width="16" height="16" border="0" /></td>
				<td class="negrito">Confirmar Escala de Hora-Extra </td>
				<td class="letra">&nbsp;</td>
				<td class="letra">&nbsp;</td>
			  </tr>
			  <tr>
				<td align="right"><img src="images/excluir_fun.png" width="16" height="16" /></td>
				<td class="negrito">Excluir Candidato da Escala </td>
				<td align="center"><img src="images/lixeira.jpg" title="Excluir"  width="14" height="14" /></td>
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