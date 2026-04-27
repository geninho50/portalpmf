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
		<td width="5%" align="center" class="branco"><strong>N</strong></td>	
		<td width="9%" align="center" class="branco"><strong>Data</strong></td>	
		<td width="10%" align="center" class="branco"><B>GM Solicitante</B></td>
		<td width="70%" align="left" class="branco"><B>Para o dia...</B></td>
		<td width="6%" align="center" class="branco"><B>Status</B></td>				
	</tr> 
</table>
<?php 
		if($linhaL)
		{
			if( $linhaL['logistica']=='S' ){
				include("online/doacao_logistica.php");
			}
			if( $linhaL['sentinela']=='S' ){
				include("online/doacao_sentinela.php");
			}
			if( $linhaL['vespertino']=='S' ){
				include("online/doacao_vespertino.php");
			}
			if( $linhaL['zonaazul']=='S' ){
				include("online/doacao_zonaazul.php");
			}
			if( $linhaL['matutino']=='S' ){
				include("online/doacao_matutino.php");
			}
			if( $linhaL['central']=='S' ){
				include("online/doacao_central.php");
			}
			if( $linhaL['alfa']=='S' ){
				include("online/doacao_alfa.php");
			}
			if( $linhaL['bravo']=='S' ){
				include("online/doacao_bravo.php");
			}
			if( $linhaL['obras']=='S' ){
				include("online/doacao_obras.php");
			}
			if( $linhaL['digitacao']=='S' ){
				include("online/doacao_digitacao.php");
			}
			if( $linhaL['educacao']=='S' ){
				include("online/doacao_educacao.php");
			}
			if( $linhaL['rondaescolar']=='S' ){
				include("online/doacao_rondaescolar.php");
			}
			if( $linhaL['administrativo']=='S' ){
				include("online/doacao_administrativo.php");
			}
			if( $linhaL['diretoria']=='S' ){
				include("online/doacao_diretoria.php");
			}
		}
?>




