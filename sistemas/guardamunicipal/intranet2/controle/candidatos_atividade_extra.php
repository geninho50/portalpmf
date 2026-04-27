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
	
	$id = $_GET['id'];
	
	$queryJ = "SELECT * FROM atividadeextra where id=$id order by id desc ";
	$resultadoJ = $obj->executaQuery($queryJ);
	while ( $linhaJ = mysql_fetch_array($resultadoJ) )
	{		
		$idatividade = $linhaJ['id'];
		$atividade = $linhaJ['atividade'];
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

	<fieldset>
		<legend class="cabecalho"><? echo $atividade;?></legend>
	
		<table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
		<tr>
			<td width="50%" align="left" class="branco"><B>Candidatos</B></td>
		</tr> 
	</table>
	
	<table width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<?php
		
	?>
		<tr>
			<td width="50%" class="quote" align="left">
					<?
						$queryT = "SELECT * FROM controleatividadeextra where idatividade=$idatividade order by id desc ";
						GeraColunasExtra(3, $queryT);
					?>
			</td>
		</tr>
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