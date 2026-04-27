<?php
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
	<!--inicio adm-->
	<fieldset>
	<legend class="negrito">Consulta Resultado de Valores</legend>

	<table  width="50%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
		<tr>
			<td width="15%" align="center" class="branco"><B>Matricula</B></td>
			<td width="28%" align="left" class="branco"><B>Nome de Guerra</B></td>	
			<td width="22%" align="center" class="branco">Grat. Chefia</td>	
			<td width="21%" align="center" class="branco">Grat. Incentivo</td>		
			<td width="14%" align="center" class="branco">Trienio</td>
		  </tr> 
	</table>
	
	<table width="50%" border="0" cellspacing="1" cellpadding="1">
	<?php
		$query = "SELECT u.login, i.gratificacao, i.incentivo, i.trienio, i.matricula FROM institucional i inner join guarda_gmf u where i.matricula=u.matricula order by u.login";
		$chavet = true;
		$resultado = $obj->executaQuery($query);
		while ( $linha = mysql_fetch_array($resultado) )
		{		
			$login =  $linha['login'];
			$gratificacao =  $linha['gratificacao'];
			$incentivo =  $linha['incentivo'];
			$trienio =  $linha['trienio'];
			$matricula =  $linha['matricula'];
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
			<td width="15%" align="center" class="letra"><a href="alterar_informacoes_valores.php?matricula=<? echo $matricula; ?>"><? echo $matricula; ?></a></td>
			<td width="28%" align="left" class="letra"><? echo $login; ?></td>	
			<td width="22%" align="center" class="letra"><? echo 'R$ '.$gratificacao; ?></td>		
			<td width="21%" align="center" class="letra">
				<? 
					if($incentivo == 1){ 
						echo 'Sim';
					}else{ 
						echo 'Nao'; 
					}
				?>
			</td>
			<td width="14%" align="center" class="letra"><? echo $trienio; ?></td>
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