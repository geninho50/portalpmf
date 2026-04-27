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
		<td width="9%" align="center" class="branco"><B>GM Solicitante</B></td>
		<td width="18%" align="center" class="branco"><B>Na Data</B></td>
		<td width="18%" align="left" class="branco"><B>Folga</B></td>
		<td width="32%" align="left" class="branco"><B>Motivo</B></td>
		<td width="7%" align="center" class="branco"><b>Pendentes</b></td>
		<td width="5%" align="center" class="branco"><B>Status</B></td>				
	</tr> 
</table>
<?php 
	/*	if($linhaL)
		{
				
				include("online/folga_diretoria.php");
				include("online/folga_central.php");
				include("online/folga_administrativo.php");
				include("online/folga_educacao.php");
				include("online/folga_logistica.php");
				include("online/folga_sentinela.php");
				include("online/folga_digitacao.php");
				include("online/folga_matutino.php");
				include("online/folga_vespertino.php");
				include("online/folga_alfa.php");
				include("online/folga_bravo.php");
				include("online/folga_zonaazul.php");
				include("online/folga_obras.php");
				include("online/folga_rondaescolar.php");
				include("online/folga_canil.php");
		}*/
		if($linhaL)
		{
			if( $linhaL['logistica']=='S' ){
				include("online/folga_logistica.php");
			}
			if( $linhaL['sentinela']=='S' ){
				include("online/folga_sentinela.php");
			}
			if( $linhaL['vespertino']=='S' ){
				include("online/folga_vespertino.php");
			}
			if( $linhaL['zonaazul']=='S' ){
				include("online/folga_zonaazul.php");
			}
			if( $linhaL['matutino']=='S' ){
				include("online/folga_matutino.php");
			}
			if( $linhaL['central']=='S' ){
				include("online/folga_central.php");
			}
			if( $linhaL['alfa']=='S' ){
				include("online/folga_alfa.php");
			}
			if( $linhaL['bravo']=='S' ){
				include("online/folga_bravo.php");
			}
			if( $linhaL['obras']=='S' ){
				include("online/folga_obras.php");
			}
			if( $linhaL['digitacao']=='S' ){
				include("online/folga_digitacao.php");
			}
			if( $linhaL['educacao']=='S' ){
				include("online/folga_educacao.php");
			}
			if( $linhaL['rondaescolar']=='S' ){
				include("online/folga_rondaescolar.php");
			}
			if( $linhaL['administrativo']=='S' ){
				include("online/folga_administrativo.php");
			}
			if( $linhaL['diretoria']=='S' ){
				include("online/folga_diretoria.php");
			}
		}
?>


