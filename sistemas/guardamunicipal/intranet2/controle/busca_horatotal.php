<?php
	ini_set('default_charset','UTF-8');

	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	// Realiza a consulta ao banco;
	$xMes = $_POST['Mes'];
	$xAno = $_POST['Ano'];
	$xBusca = "";
	$xBusca = $_POST['xguarda'];
	$xBusca = trim($xBusca);
	$tamanho = strlen($xBusca);
	$nvaloresencontrados = 0;
	
	if($xBusca=='TODOS'){
		$xBusca='%';	
	}
	
	
	if($xMes == 13 & $xAno != 13){
		$query = "SELECT DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, login, hora1, hora2, adicional,idescala FROM listaescala where UPPER(login) like UPPER('%$xBusca%') and YEAR(data)=$xAno order by login";
	}else{
		if($xAno == 13 & $xMes != 13){
			$query = "SELECT DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, login, hora1, hora2, adicional,idescala FROM listaescala where UPPER(login) like UPPER('%$xBusca%') and MONTH(data)=$xMes order by login";
		}else{
			if($xMes == 13 & $xAno == 13){
				$query = "SELECT DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, login, hora1, hora2, adicional,idescala FROM listaescala where UPPER(login) like UPPER('%$xBusca%') order by login";
			}else{
				$query = "SELECT DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, login, hora1, hora2, adicional,idescala FROM listaescala where UPPER(login) like UPPER('%$xBusca%') and MONTH(data)=$xMes and YEAR(data)=$xAno order by login";
			}
		}
	}
	
	
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body ONLOAD="setaFocusForm(1)">

<fieldset>
	<legend class="cabecalho">CONSULTAR HORAS EXTRAS</legend>
<form name="form1" method="post" action="busca_horatotal.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="74%" border="0" cellspacing="1" cellpadding="1">

  <tr>
    <td width="29%" align="right" class="letra">Digite o <B>Nome</B>:</td>
    <td width="26%"><input type="text" class="negrito" name="xguarda" id="xguarda" size="20" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
      <td width="18%"><select name="Mes" class="negrito">
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
      <td width="27%"><select name="Ano" class="negrito">
      <option value="13">Todos</option>
	  <option value="2020">2020</option>
      <option value="2019">2019</option>
      <option value="2018">2018</option>
      <option value="2017">2017</option>
      <option value="2016">2016</option>
      <option value="2015">2015</option>
      <option value="2014">2014</option>
      <option value="2013">2013</option>
      <option value="2012">2012</option>
      <option value="2011">2011</option>
      <option value="2010">2010</option>
    </select></td>
  </tr>

  <tr>
    <td align="right" class="letra">&nbsp;</td>
	<td width="26%"><input name="Submit" type="submit" class="letra" id="Pesquisar" value="Pesquisar" onClick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
  </tr>

</table>

</form>
</fieldset>

<?php
	if( $nvaloresencontrados > 0 )
	{
?>
<fieldset>
	<legend class="CABECALHO"><b>RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA <?echo $xBusca;?></b></legend>

<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
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
	<legend class="cabecalho">SOMA TOTAL DE HORA DO MÊS <b><?PHP echo $xMes; ?></b></legend>
<?PHP 
 if($xMes == 13 & $xAno != 13){
		$queryH = "select (SELECT sum(hora1) FROM listaescala where UPPER(login) like UPPER('%$xBusca%') and YEAR(data)=$xAno)as temphora1, (SELECT sum(hora2) FROM listaescala where UPPER(login) like UPPER('%$xBusca%') and YEAR(data)=$xAno)as temphora2 ";
	}else{
		if($xAno == 13 & $xMes != 13){
			$queryH = "select (SELECT sum(hora1) FROM listaescala where UPPER(login) like UPPER('%$xBusca%') and MONTH(data)=$xMes)as temphora1, (SELECT sum(hora2) FROM listaescala where UPPER(login) like UPPER('%$xBusca%') and MONTH(data)=$xMes)as temphora2 ";
			
		}else{
			if($xMes == 13 & $xAno == 13){
				echo $queryH = "select (SELECT sum(hora1) FROM listaescala where UPPER(login) like UPPER('%$xBusca%'))as temphora1, (SELECT sum(hora2) FROM listaescala where UPPER(login) like UPPER('%$xBusca%'))as temphora2 ";
				
			}else{
				$queryH = "select (SELECT sum(hora1) FROM listaescala where UPPER(login) like UPPER('%$xBusca%') and MONTH(data)=$xMes and YEAR(data)=$xAno)as temphora1, (SELECT sum(hora2) FROM listaescala where UPPER(login) like UPPER('%$xBusca%') and MONTH(data)=$xMes and YEAR(data)=$xAno)as temphora2 ";
			}
		}
	}
 $resultadoH = $obj->executaQuery($queryH);
 $linhaH = mysql_fetch_array($resultadoH);
 
 
 
 if($linhaH > 0){
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td width="15%" align="right" class="letra">Total de hora de 100%:</td>
		<td align="left" class="letra" colspan="2"><font size="-1" color="#FF0000"><?PHP echo $linhaH['temphora1']; ?></font> Horas</td>
	</tr>
	<tr>
		<td width="15%" align="right" class="letra">Total de hora de 200%:</td>
		<td align="left" class="letra" colspan="2"><font size="-1" color="#FF0000"><?PHP echo $linhaH['temphora2']; ?></font> Horas</td>
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
	<legend class="letra">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $xBusca;?></legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td width="100%" colspan="3" align="center" class="letra">Nenhuma ocorr&ecirc;ncia para <B><?echo $xBusca;?></B></td>
	</tr>	
</table>
</fieldset>

<?php	
	}
?>
</body>
</html>

<?php
	// Fechando as variáveis de conexão
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