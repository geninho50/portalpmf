<?php
		header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past	
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	
		
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
		<legend class="negrito">Atividades Dispon�veis</legend>
	
		<table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
		<tr>
			<td width="27%" align="left" class="branco"><b>Disponibilidade</b></td>
			<td width="28%" class="branco"><B>Atividade</B></td>
			<td width="39%" align="left" class="branco"><B>Informa&ccedil;&otilde;es Adicionais</B></td>
			<td width="3%" align="left" class="branco">&nbsp;</td>
			<td width="3%" align="left" class="branco">&nbsp;</td>	
		  </tr> 
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<?php
		$chavet = true;
		$query = "SELECT * FROM atividadeextra where status='S' order by id desc";
		$resultado = $obj->executaQuery($query);
		while ( $linha = mysql_fetch_array($resultado) )
		{		
		
			$id = $linha['id'];
			$local = $linha['local'];
			$tempo = $linha['tempo'];
			$complemento = $linha['complemento'];
			$status = $linha['status'];
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
			<td width="27%" align="left" class="negrito"><? echo $linha['tempo']; ?></td>		
			<td width="28%" align="left" class="negrito"><? echo $linha['local']; ?></td>		
			<td width="39%" align="left" class="negrito"><? echo $linha['complemento']; ?></td>
			<td width="3%" class="negrito" align="center"><A HREF="cadastro_atividade_extra.php?id=<? echo $linha['id']; ?>" border="0"><IMG SRC="images/atualizar.gif" ALT="Clic na imagem para fazer parte da escala" width="16" height="20"BORDER="0"></A></td>
			<td width="3%" class="negrito" align="center"><A HREF="../classes/controleAtividadeExtra.php?id=<? echo $linha['id']; ?>" border="0"><IMG SRC="images/lixeira.jpg" ALT="Mais detalhes" width="16" height="20" BORDER="0"></A></td>
		</tr>
	
	<?php
		}
	?>
	</table>
	
	</fieldset>
	
	
	
	<fieldset>
		<legend class="negrito">Candidatos que est&atilde;o concorrendo a atividade </legend>
	
		<table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
		<tr>
			<td width="50%" align="left" class="branco"><B>Atividade</B></td>	
			<td width="50%" align="left" class="branco"><B>Candidatos</B></td>
		</tr> 
	</table>
	
	<table width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<?php
		$chave = true;
		$queryJ = "SELECT * FROM atividadeextra order by id desc ";
		$resultadoJ = $obj->executaQuery($queryJ);
		while ( $linhaJ = mysql_fetch_array($resultadoJ) )
		{		
			$id = $linhaJ['id'];
			$local = $linhaJ['local'];
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
			<td width="50%" align="left" class="negrito"><? echo $local; ?></td>
			<td width="50%" class="quote" align="left">
					<?
						$queryT = "SELECT * FROM controleatividadeextra where idatividade=$id order by id desc ";
						$resultadoT = $obj->executaQuery($queryT);
						while ( $linhaT = mysql_fetch_array($resultadoT) )
						{		
							$id = $linhaT['id'];
							$idatividade = $linhaT['idatividade'];
							$login = $linhaT['login'];
							
							echo '<font class=negrito>'.$login.'</font><br />';
							
						}
					?>
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