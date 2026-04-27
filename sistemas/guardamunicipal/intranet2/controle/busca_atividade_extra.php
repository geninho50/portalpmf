<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$campos_query = "*";
	$final_query  = "FROM atividadeextra order by id desc";
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	
	<fieldset>
		<legend class="cabecalho">ATICIDADEE EXTRA</legend>
	
		<table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
		<tr>
			
			<td width="28%" class="branco"><B>Atividade</B></td>
			<td width="53%" align="left" class="branco"><B>Informa&ccedil;&otilde;es Adicionais</B></td>
            <td width="13%" align="center" class="branco"><b>Disponibilidade</b></td>
			<td width="3%" align="left" class="branco">&nbsp;</td>
			<td width="3%" align="left" class="branco">&nbsp;</td>	
		  </tr> 
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<?php
		$chavet = true;
		$queryA = "SELECT id,data_cadastro, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, atividade, complemento,status, data $final_query LIMIT $inicio,$maximo";
		$resultadoA = $obj->executaQuery($queryA);
		while ( $linha = mysql_fetch_array($resultadoA) )
		{		
		
			$id = $linha['id'];
			$atividade = $linha['atividade'];
			$data = $linha['data'];
			$complemento = $linha['complemento'];
			$status = $linha['status'];
			$dia = $linha['dia'];
			$mes = $linha['mes'];
			$ano = $linha['ano'];
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
			<td width="28%" align="left" class="negrito"><? echo $linha['atividade']; ?></td>		
			<td width="53%" align="left" class="negrito"><? echo $linha['complemento']; ?></td>
            <td width="13%" align="center" class="negrito"><?php echo $dia." / ".$mes." / ".$ano; ?></td>
			<td width="3%" class="negrito" align="center"><A HREF="cadastro_atividade_extra.php?id=<? echo $linha['id']; ?>" border="0"><IMG SRC="imagens/atualizar.png" width="20" height="20"BORDER="0" title="ATUALIZAR"></A></td>
			<td width="3%" class="negrito" align="center"><a href="javascript:POPUP('candidatos_atividade_extra.php?id=<? echo $linha['id']; ?>','350','550')"><IMG SRC="imagens/vizualizar.png" width="20" height="20" BORDER="0" title="VIZUALIZAR LISTA DE CANDIDATOS"></a></td>
            
            

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
    
    
	</td>
	</tr>
	</table>
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