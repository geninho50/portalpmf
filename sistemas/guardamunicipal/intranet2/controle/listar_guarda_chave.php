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

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">LISTAR GUARDA</legend>

	<table  width="50%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
		<tr>
			<td width="30%" align="center" class="branco"><B>Matricula</B></td>
			<td width="60%" align="left" class="branco"><B>Nome de Guerra</B></td>
            <td width="10%" align="left" class="branco"><B>Chave</B></td>
		  </tr> 
	</table>
	
	<table width="50%" border="0" cellspacing="1" cellpadding="1">
	<?php
		$query = "SELECT * FROM guarda_gmf order by login";
		$chavet = true;
		$resultado = $obj->executaQuery($query);
		while ( $linha = mysql_fetch_array($resultado) )
		{		
			$login =  $linha['login'];
			$cpf =  $linha['cpf'];
			$matricula =  $linha['matricula'];
			$chave = $linha['chave'];
			$tamanho = strlen($chave);
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
			<td width="30%" align="center" class="negrito"><? echo $cpf; ?></td>
			<td width="60%" align="left" class="negrito"><a href="cadastro_chave.php?cpf=<? echo $cpf; ?>&matricula=<? echo $matricula?>"><? echo $login; ?></a></td>
            <td width="10%" align="center" class="negrito"><? if($tamanho>1){ echo'OK'; } ?></td>	
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