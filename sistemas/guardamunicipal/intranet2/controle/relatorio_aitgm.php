<fieldset>
	<legend class="negrito">AIT entregues  entre <? echo $diai.'-'.$mesi.'-'.$anoi.' a '.$diaf.'-'.$mesf.'-'.$anof;?>.</legend>
    
<!-- //quantidade de ocorrencias no geral -->


<table  width="40%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#36648B" style="border-collapse:collapse">
	<tr>
		<td width="56%" align="left" class="branco"><B>Nome do Guarda</B></td>		
		<td width="44%" align="center" class="branco"><B>Quantidade de AIT:</B></td>
	</tr> 
</table>

<table width="40%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
<?php
	$query = "select sum(quantidade) as total, matricula from receber_auto where data_cadastro between '$datainicial' and '$datafinal' group by matricula order by total desc";
	$resultado = $obj->executaQuery($query);
	while ( $linhaQ = mysql_fetch_array($resultado) )
	{		
		$matricula = $linhaQ['matricula'];
		$total = $linhaQ['total'];
		
		$sqlM = "SELECT * FROM guarda_gmf where matricula=$matricula";
		$resultadoM = $obj->executaQuery($sqlM);
		$linhaM = mysql_fetch_array($resultadoM);
		if( $linhaM )
		{
			$loginM = $linhaM["login"];
		}
		
?>
	<tr>
		<td width="56%" align="left" class="negrito"><a href="javascript:POPUP('lista_aitgm.php?xmatricula=<? echo $matricula;?>&xdatainicial=<? echo $datainicial;?>&xdatafinal=<? echo $datafinal; ?>','350','350')"><? echo $loginM.' - '.$matricula;?></a></td>		
		<td width="44%" align="center" class="negrito"><? echo $total; ?></td>
	</tr>
<?php
	}
	
		$sqlM = "SELECT * FROM guarda_gmf";
		$resultadoM = $obj->executaQuery($sqlM);
		
		while( $linhaM = mysql_fetch_array($resultadoM) )
		{
			$mat = $linhaM["matricula"];
			$mat = trim($mat);
			$tamanho = strlen($mat);
			if($tamanho==5){
				$mat.'<br>';
			}
		}
?>
</table>

</fieldset>