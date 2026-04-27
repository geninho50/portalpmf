<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	// Realiza a consulta ao banco;
	$xMes = $_POST['Mes'];
	$xAno = $_POST['Ano'];
	$xBusca = "";
	$xBusca = $_POST['xBusca'];
	$xBusca = trim($xBusca);
	$tamanho = strlen($xBusca);
	$nvaloresencontrados = 0;
	
	if($xMes == 13 & $xAno != 13){
		$query = "SELECT DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, login, hora1, hora2, adicional,idescala FROM listaescala where login='$xBusca' and YEAR(data)=$xAno order by login";
		$queryH = "SELECT sum(hora1) as temphora1 FROM listaescala where login='$xBusca' and YEAR(data)=$xAno";
		$queryH2 = "SELECT sum(hora2) as temphora2 FROM listaescala where login='$xBusca' and YEAR(data)=$xAno";
	}else{
		if($xAno == 13 & $xMes != 13){
			$query = "SELECT DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, login, hora1, hora2, adicional,idescala FROM listaescala where login='$xBusca' and MONTH(data)=$xMes order by login";
			$queryH = "SELECT sum(hora1) as temphora1 FROM listaescala where login='$xBusca' and MONTH(data)=$xMes";
			$queryH2 = "SELECT sum(hora2) as temphora2 FROM listaescala where login='$xBusca' and MONTH(data)=$xMes";
		}else{
			if($xMes == 13 & $xAno == 13){
				$query = "SELECT DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, login, hora1, hora2, adicional,idescala FROM listaescala where login='$xBusca' order by login";
				$queryH = "SELECT sum(hora1) as temphora1 FROM listaescala where login='$xBusca'";
				$queryH2 = "SELECT sum(hora2) as temphora2 FROM listaescala where login='$xBusca'";
			}else{
				$query = "SELECT DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, login, hora1, hora2, adicional,idescala FROM listaescala where login='$xBusca' and MONTH(data)=$xMes and YEAR(data)=$xAno order by login";
				$queryH = "SELECT sum(hora1) as temphora1 FROM listaescala where login='$xBusca' and MONTH(data)=$xMes and YEAR(data)=$xAno";
				$queryH2 = "SELECT sum(hora2) as temphora2 FROM listaescala where login='$xBusca' and MONTH(data)=$xMes and YEAR(data)=$xAno";
			}
		}
	}
	
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<html xmlns="http://www.w3.org/1999/xhtml">
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
	<legend class="negrito">Consulta Horal Total</legend>
	<form name="form1" method="post" action="busca_horatotal.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
	
	<INPUT TYPE="hidden" name="cadastro" value="true">
	
	<table width="74%" border="0" cellspacing="1" cellpadding="1">
	
	  <tr>
		<td width="29%" align="right" class="letra">Digite o <B>Nome</B>:</td>
		<td width="26%">
        <select name="xBusca">
				  <option value="0">Selecionar...</option>
				  <?php 
					$queryS = "SELECT * FROM guarda_gmf order by login";
					$resultadoS = $obj->executaQuery($queryS);
					while($linhaS = mysql_fetch_array($resultadoS))
					{
						$login = $linhaS['login'];
				  ?>
							 <option value="<?php echo $login; ?>"><?php echo $login; ?></option>
				  <?php 
					} 
				  ?>
			  </select>
        </td>
		  <td width="18%"><select name="Mes" class="form">
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
		  <td width="27%"><select name="Ano" class="form">
		  <option value="13">Todos</option>
		  <option value="2010">2010</option>
		  <option value="2011">2011</option>
		  <option value="2012">2012</option>
		  <option value="2013">2013</option>
          <option value="2014">2014</option>
          <option value="2015">2015</option>
		</select></td>
	  </tr>
	
	  <tr>
		<td align="right" class="letra">&nbsp;</td>
		<td width="26%"><input name="Submit" type="submit" class="botao" id="Pesquisar" value="Pesquisar" onClick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
	  </tr>
	
	</table>
	
	</form>
	</fieldset>
	
	<?php
		if( $nvaloresencontrados > 0 )
		{
	?>
	<fieldset>
		<legend class="negrito">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $xBusca;?></legend>
	
	<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
		<tr>
			<td width="14%" align="left" class="branco"><B>Nome</B></td>				
			<td width="8%" align="center" class="branco"><B>Horas 100%</B></td>		
			<td width="8%" align="center" class="branco"><B>Horas 200%</B></td>
			<td width="11%" align="center" class="branco"><B>Adc. Noturno</B></td>
			<td width="10%" align="center" class="branco"><B>Data</B></td>
			<td width="49%" align="left" class="branco"><B>Escala</B></td>
		</tr> 
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<?php
		$chave = true;
		$resultado = $obj->executaQuery($query);
		while ( $linha = mysql_fetch_array($resultado) )
		{		
			$login = $linha['login']; 
			$idescala = $linha['idescala']; 
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
			<td width="14%" align="left" class="negrito"><font face="Arial, Helvetica, sans-serif"><? echo $linha['login']; ?></font></td>		
			<td width="8%" class="negrito" align="center"><font face="Arial, Helvetica, sans-serif"><? echo $linha['hora1']; ?></font></td>
		   <td width="8%" class="negrito" align="center"><font face="Arial, Helvetica, sans-serif"><? echo $linha['hora2']; ?></font></td>
		   <td width="11%" align="center" class="negrito"><font face="Arial, Helvetica, sans-serif"><? echo $linha['adicional']; ?></font></td>
		   <td width="10%" align="center" class="negrito"><font face="Arial, Helvetica, sans-serif"><? echo $linha['dia']; ?> / <? echo $linha['mes']; ?> / <? echo $linha['ano']; ?></font></td>
		   <? 
			$queryE = "select * from escalahoraextra where id='$idescala'";
			$resultadoE = $obj->executaQuery($queryE);
			if ( $linhaE = mysql_fetch_array($resultadoE) )
			{
		   ?>
				<td width="49%" align="left" class="negrito"><font face="Arial, Helvetica, sans-serif"><? echo $linhaE['local'];?></font></td>
			<? 
			}
			?>
		</tr>
	<?php
		}
	?>
	</table>
	</fieldset>
	
	<fieldset>
		<legend class="negrito">Soma Total de Hora do m�s <b><?PHP echo $xMes; ?></b></legend>
	<?PHP 
	 $resultadoH = $obj->executaQuery($queryH);
	 $linhaH = mysql_fetch_array($resultadoH);
	 if($linhaH > 0){
	?>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td width="15%" align="right" class="letra">Total de hora de 100%:</td>
			<td align="left" class="letra" colspan="2"><font size="-1" color="#FF0000"><?PHP echo $linhaH['temphora1']; ?></font> Horas</td>
		</tr>
	</table>
	<?PHP 
		}
	  $resultadoH2 = $obj->executaQuery($queryH2);
	 $linhaH2 = mysql_fetch_array($resultadoH2);
	 if($linhaH2 > 0){
	?>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td width="15%" align="right" class="letra">Total de hora de 200%:</td>
			<td align="left" class="letra" colspan="2"><font size="-1" color="#FF0000"><?PHP echo $linhaH2['temphora2']; ?></font> Horas</td>
		</tr>
	</table>
	<?PHP 
		}
	?>
	</fieldset>
	</td>
  </tr> 
		
	</table>
	
	
	<?php
		}
	
		if( $nvaloresencontrados == 0 && $tamanho > 0 )
		{
			
	?>
	
	<fieldset>
		<legend class="negrito">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $xBusca;?></legend>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td width="100%" colspan="3" align="center" class="letra">Nenhuma ocorr&ecirc;ncia para <B><?echo $xBusca;?></B></td>
		</tr>	
	</table>
	</fieldset>
	
	<?php	
		}
	?>
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