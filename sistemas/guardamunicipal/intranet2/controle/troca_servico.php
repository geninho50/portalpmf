<?php
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$login = $linhaS["login"];
		$matricula = $linhaS["matricula"];
	}
	$queryL = "SELECT * FROM usuario where id=$idsession";
	$resultL = $obj->executaQuery($queryL);
	$linhaL = mysql_fetch_array($resultL);
?>
<table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<tr>
		<td width="4%" align="center" class="branco"><strong>N</strong></td>	
		<td width="7%" align="center" class="branco"><strong>Data</strong></td>	
		<td width="10%" align="center" class="branco"><B>GM Solicitante</B></td>
		<td width="11%" align="center" class="branco"><B>Troca com...</B></td>
		<td width="8%" align="center" class="branco"><B>Para o dia...</B></td>
		<td width="15%" align="center" class="branco"><B>Forma de Reposicao</B></td>
		<td width="38%" align="left" class="branco"><B>Motivo</B></td>
		<td width="7%" align="center" class="branco"><B>Status</B></td>				
	</tr> 
</table>
<?php 
		if($linhaL)
		{
			if( $linhaL['logistica']=='S' ){
				include("online/trocaservico_logistica.php");
			}
			if( $linhaL['sentinela']=='S' ){
				include("online/trocaservico_sentinela.php");
			}
			if( $linhaL['vespertino']=='S' ){
				include("online/trocaservico_vespertino.php");
			}
			if( $linhaL['zonaazul']=='S' ){
				include("online/trocaservico_zonaazul.php");
			}
			if( $linhaL['matutino']=='S' ){
				include("online/trocaservico_matutino.php");
			}
			if( $linhaL['central']=='S' ){
				include("online/trocaservico_central.php");
			}
			if( $linhaL['alfa']=='S' ){
				include("online/trocaservico_alfa.php");
			}
			if( $linhaL['bravo']=='S' ){
				include("online/trocaservico_bravo.php");
			}
			if( $linhaL['obras']=='S' ){
				include("online/trocaservico_obras.php");
			}
			if( $linhaL['digitacao']=='S' ){
				include("online/trocaservico_digitacao.php");
			}
			if( $linhaL['educacao']=='S' ){
				include("online/trocaservico_educacao.php");
			}
			if( $linhaL['rondaescolar']=='S' ){
				include("online/trocaservico_rondaescolar.php");
			}
			if( $linhaL['administrativo']=='S' ){
				include("online/trocaservico_administrativo.php");
			}
			if( $linhaL['diretoria']=='S' ){
				include("online/trocaservico_diretoria.php");
			}
		}
?>




