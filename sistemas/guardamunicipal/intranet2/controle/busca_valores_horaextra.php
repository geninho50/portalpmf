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
	$xMes = 0;
	$xMes = $_POST['yMes'];
	$xAno = $_POST['yAno'];
	$xBusca = "";
	$xBusca = $_POST['xguarda'];
	$xBusca = trim($xBusca);
	$tamanho = strlen($xBusca);
	$nvaloresencontrados = 0;
	//$query = "select candidatos.login, avg(listaescala.hora1) as mediah1 from candidatos inner join listaescala where UPPER(listaescala.login) like UPPER('%$xBusca%') and candidatos.idescala=$idescala and listaescala.login = candidatos.login and MONTH(listaescala.data)=$xMes and YEAR(listaescala.data)=$xAno group by listaescala.login order by mediah1 asc";
	
	if($xBusca=='TODOS'){
		$query = "SELECT DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, login, hora1, hora2, adicional,idescala FROM listaescala where UPPER(login) like UPPER('%%%') and MONTH(data)=$xMes and YEAR(data)=$xAno order by login";
	}else{
		$query = "SELECT DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, login, hora1, hora2, adicional,idescala FROM listaescala where UPPER(login) like UPPER('%$xBusca%') and MONTH(data)=$xMes and YEAR(data)=$xAno order by login";
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
	<legend class="cabecalho">CONSULTA VALORES</legend>
<form name="form1" method="post" action="busca_valores_horaextra.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="74%" border="0" cellspacing="1" cellpadding="1">

  <tr>
    <td width="29%" align="right" class="letra">Digite o <B>Nome</B>:</td>
    <td width="26%"><input type="text" class="negrito" name="xguarda" id="xguarda" size="20" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
      <td width="18%"><select name="yMes" class="negrito">
      <option value="0">SELECIONE...</option>
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
      <td width="27%"><select name="yAno" class="negrito">
      <option value="0">SELECIONE...</option>
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
	<legend class="letra"><B>RESULTADO(s) <?echo $nvaloresencontrados;?> PARA <?echo $xBusca;?></B></legend>

<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
	<tr>
		<td width="14%" align="left" class="branco"><B>Nome</B></td>
		<td width="10%" align="center" class="branco"><B>Remuneração</B></td>
		<td width="9%" align="center" class="branco"><B>Risco de Vida</B></td>		
		<td width="8%" align="center" class="branco"><B>Grat. Chefia</B></td>		
		<td width="9%" align="center" class="branco"><strong>Grat. Incentivo </strong></td>		
		<td width="8%" align="center" class="branco"><B>Tri&ecirc;nio</B></td>
	    <td width="11%" align="center" class="branco"><B>Adc. Noturno</B></td>
		<td width="11%" align="center" class="branco"><B>Valor  Hora 100% </B></td>
		<td width="11%" align="center" class="branco"><b>Valor Hora 200% </b></td>
		<td width="9%" align="center" class="branco"><b>Valor Total </b></td>
	</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chave = true;
	$resultado = $obj->executaQuery($query);
	while ( $linha = mysql_fetch_array($resultado) )
	{		
		$login = $linha['login'];
		$adicional = $linha['adicional'];
		$hora100 = $linha['hora1'];
		$hora200 = $linha['hora2'];
		
		$queryV = "select * from guarda_gmf where UPPER(login) like UPPER('".$login."')";
		$resultadoV = $obj->executaQuery($queryV);
		while ( $linhaV = mysql_fetch_array($resultadoV) )
		{
			$nivel = $linhaV['nivel'];
			$matricula = $linhaV['matricula'];
			
			$queryN = "select * from nivel where id='$nivel'";
			$resultadoN = $obj->executaQuery($queryN);
			while ( $linhaN = mysql_fetch_array($resultadoN) )
			{
				$valorremuneracao = $linhaN['valor'];
				$risco = $valorremuneracao/2;
				$riscovida = number_format( $risco, 2, ",", "" );
				
				$queryG = "select * from institucional where matricula=$matricula";
				$resultadoG = $obj->executaQuery($queryG);
				while ( $linhaG = mysql_fetch_array($resultadoG) )
				{
					$gratificacao = $linhaG['gratificacao'];
					$incentivo = $linhaG['incentivo'];
					$trienio = $linhaG['trienio'];
					if($incentivo==1){
						$gratincentivo = $valorremuneracao*(20/100);
						$gratincentivoT = number_format( $gratincentivo, 2, ",", "" );
					}else{ $gratincentivoT = $incentivo;}
					
					//calcula o valor do trienio
					$valortrienio = ($valorremuneracao*(3/100))*$trienio;
					$valortrienioT = number_format( $valortrienio, 2, ",", "" );
					
					//calcula o valor do adc noturno
					$adicionalN = ((($valorremuneracao+$valortrienio)/220)*(50/100))*$adicional;
					$adicionalNT = number_format( $adicionalN, 2, ",", "" );
					
					//calcula o valor da hora de 100% e 200%
					$hora1 = (($valorremuneracao+$riscovida+$gratificacao+$gratincentivo+$valortrienio+$adicionalN)/220)*2;
					$hora1T = number_format( $hora1, 2, ",", "" );
					$hora2 = (($valorremuneracao+$riscovida+$gratificacao+$gratincentivo+$valortrienio+$adicionalN)/220)*3;
					$hora2T = number_format( $hora2, 2, ",", "" );
					
					//calcula o valor de horas feitas de 100% e 200%
					$valorGM = (($hora100*$hora1)+($hora200*$hora2));
					$valorGMT = number_format( $valorGM, 2, ",", "" );
					
					//calcula o valor total a receber de horas extras
					$valortotal=$valortotal+$valorGMT;
					$valortotalT = number_format( $valortotal, 2, ",", "" );
					
					$totalhora1=$totalhora1+$hora100;
					$totalhora2=$totalhora2+$hora200;
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
		<td width="14%" align="left" class="negrito"><? echo $linha['login']; ?></td>
		<td width="10%" align="center" class="negrito"><? echo $nivel.' - '.$valorremuneracao; ?></td>
		<td width="9%" align="center" class="negrito"><? echo $riscovida; ?></td>		
		<td width="8%" align="center" class="negrito"><? echo $gratificacao; ?></td>
	    <td width="9%" class="negrito" align="center"><? echo $gratincentivoT; ?></td>
   	   <td width="8%" class="negrito" align="center"><? echo $valortrienioT; ?></td>
	   <td width="11%" align="center" class="negrito"><? echo $adicionalNT; ?></td>
	   <td width="11%" align="center" class="negrito"><? echo $hora1T; ?></td>
	   <td width="11%" align="center" class="negrito"><? echo $hora2T; ?></td>
	   <td width="9%" align="center" class="negrito"><? echo $valorGMT; ?></td>
	</tr>
<?php
				}
			}
		}
	}
?>
</table>
</fieldset>

<fieldset>
	<legend class="letra"><b>SOMA TOTAL DE HORA DO MÊS <?PHP echo $xMes; ?></b></legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td width="15%" align="right" class="letra">Total de hora de 100%:</td>
		<td align="left" class="letra" colspan="2"><font size="-1" color="#FF0000"><?PHP echo $totalhora1; ?></font> Horas</td>
		<td width="76%" align="left" class="letra" colspan="2"></td>
	</tr>
	<tr>
		<td width="15%" align="right" class="letra">Total de hora de 200%:</td>
		<td align="left" class="letra" colspan="2"><font size="-1" color="#FF0000"><?PHP echo $totalhora2; ?></font> Horas</td>
		<td width="76%" align="left" class="letra" colspan="2"><font size="-1" color="#FF0000"><?PHP echo 'R$: '.$valortotalT; ?></font></td>
	</tr>
</table>

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
	<legend class="letra"><B>RESULTADO(s) <?echo $nvaloresencontrados;?> PARA <?echo $xBusca;?></B></legend>
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