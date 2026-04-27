<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	// Realiza a consulta ao banco;
	$xMes = 0;
	$xMes = $_POST['yMes'];
	$xAno = $_POST['yAno'];
	$xBusca = "";
	$xBusca = $_POST['xBusca'];
	$xBusca = trim($xBusca);
	$tamanho = strlen($xBusca);
	$nvaloresencontrados = 0;
	//$query = "select candidatos.login, avg(totalhoras.hora1) as mediah1 from candidatos inner join totalhoras where UPPER(totalhoras.login) like UPPER('%$xBusca%') and candidatos.idescala=$idescala and totalhoras.login = candidatos.login and MONTH(totalhoras.data)=$xMes and YEAR(totalhoras.data)=$xAno group by totalhoras.login order by mediah1 asc";
	$query = "SELECT DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, login, hora1, hora2, adicional,idescala FROM listaescala where UPPER(login) like UPPER('%$xBusca%') and MONTH(data)=$xMes and YEAR(data)=$xAno order by login";
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
	<legend class="negrito">Consulta Valor da Hora Extra</legend>
	<form name="form1" method="post" action="busca_valores_horaextra.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
	
	<INPUT TYPE="hidden" name="cadastro" value="true">
	
	<table width="74%" border="0" cellspacing="1" cellpadding="1">
	
	  <tr>
		<td width="29%" align="right" class="letra">Digite o <B>Nome</B>:</td>
		<td width="26%"><input name="xBusca" type="text" size="30" value="<?echo $xBusca;?>"/></td>
		  <td width="18%"><select name="yMes" class="form">
		  <option value="0">Selecione o mes...</option>
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
		  <td width="27%"><select name="yAno" class="form">
		  <option value="0">Selecione o ano...</option>
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
			<td width="10%" align="center" class="branco"><B>Remuneracao</B></td>
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
		<legend class="negrito">Soma Total de Hora do mes <b><?PHP echo $xMes; ?></b></legend>
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
		<legend class="negrito">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $xBusca;?></legend>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td width="100%" colspan="3" align="center" class="negrito">Nenhuma ocorr&ecirc;ncia para <B><?echo $xBusca;?></B></td>
		</tr>	
	</table>
	</fieldset>
	
	<?php	
		}
	?>
	<!--fim ad-->
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