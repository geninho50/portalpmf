<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	require ("../classes/trataData.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	$objS = new trataString;
	$objD = new trataData;

	$data_e = $_GET['data'];
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	//Pega a data atual
    $data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

</head>

<body> 
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
 <tr>
    <td width="42%" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<!--inicio adm-->

	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	 
	  <tr>
		<td width="41">&nbsp;</td>
		<td width="1204" valign="top">
			<!-- ini agenda -->
				<?php include("agendaHoraExtra.php"); ?>
				<!-- fim agenda  -->
		</td>
	  </tr>
	
	  <tr>
	    <td>&nbsp;</td>
	    <td valign="top">&nbsp;</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td valign="top">Data da Consulta: <? $dataT = $objD->formataDataPInterface($data_e); echo $dataT;?> </td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td valign="top">&nbsp;</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td valign="top">
		  <table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
            <tr align="center">
              <td width="25%" class="branco"><b>Atendimento 153</b> </td>
              <td width="25%" class="branco"><b>Pro Cidadao</b> </td>
              <td width="25%" class="branco"><b>Zona Azul</b> </td>
              <td width="25%" class="branco"><b><b>Hora Extra</b> </td>
              </tr>
			</table>
			<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
            <tr align="center">
				<td width="25%" valign="top">			
					<?
					$queryC = "select * from guarnicao where outros='ATENDIMENTO 153' and data_entrada='$data_e' order by outros asc";
					$resultadoC = $obj->executaQuery($queryC);
					while( $linhaC = mysql_fetch_array($resultadoC) )
					{
						$idagendaC = $linhaC['id'];
						$outrosC = $linhaC['outros'];
						$guarda1C = $linhaC['guarda1'];
						$guarda2C = $linhaC['guarda2'];
						$guarda3C = $linhaC['guarda3'];
						$guarda4C = $linhaC['guarda4'];
						$guarda5C = $linhaC['guarda5'];
						$vtr = $linhaC['vtr'];
						$hora_entradaC = $linhaC['hora_entrada'];
						$hora_saidaC = $linhaC['hora_saida'];
						$data_entradaC = $linhaC['data_entrada'];
						$dataC = $oData->formataDataPInterface($dataC);
					?>
						<table width=100% border=0 cellpadding=1 cellspacing=1 bgcolor="#CCCCCC">
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>VTR:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $vtr; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Guarnicao:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $guarda1C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda2C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda3C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda4C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda5C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Entrada:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_entradaC; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Saida:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_saidaC; ?></td>
								</tr>
						</table>
						<HR>
					<? } ?>
			</td>
            <td width="25%" valign="top">			
					<?
					$queryC = "select * from guarnicao where outros='PRO CIDADAO' and data_entrada='$data_e' order by outros asc";
					$resultadoC = $obj->executaQuery($queryC);
					while( $linhaC = mysql_fetch_array($resultadoC) )
					{
						$idagendaC = $linhaC['id'];
						$outrosC = $linhaC['outros'];
						$guarda1C = $linhaC['guarda1'];
						$guarda2C = $linhaC['guarda2'];
						$guarda3C = $linhaC['guarda3'];
						$guarda4C = $linhaC['guarda4'];
						$guarda5C = $linhaC['guarda5'];
						$vtr = $linhaC['vtr'];
						$hora_entradaC = $linhaC['hora_entrada'];
						$hora_saidaC = $linhaC['hora_saida'];
						$data_entradaC = $linhaC['data_entrada'];
						$dataC = $oData->formataDataPInterface($dataC);
					?>
						<table width=100% border=0 cellpadding=1 cellspacing=1 bgcolor="#EAEAEA">
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>VTR:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $vtr; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Guarnicao:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $guarda1C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda2C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda3C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda4C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda5C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Entrada:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_entradaC; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Saida:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_saidaC; ?></td>
								</tr>
						</table>
						<HR>
					<? } ?>
			</td>
              <td width="25%" valign="top">
			  <?
					$queryC = "select * from guarnicao where outros='ZONA AZUL' and data_entrada='$data_e' order by outros asc";
					$resultadoC = $obj->executaQuery($queryC);
					while( $linhaC = mysql_fetch_array($resultadoC) )
					{
						$idagendaC = $linhaC['id'];
						$outrosC = $linhaC['outros'];
						$guarda1C = $linhaC['guarda1'];
						$guarda2C = $linhaC['guarda2'];
						$guarda3C = $linhaC['guarda3'];
						$guarda4C = $linhaC['guarda4'];
						$guarda5C = $linhaC['guarda5'];
						$vtr = $linhaC['vtr'];
						$hora_entradaC = $linhaC['hora_entrada'];
						$hora_saidaC = $linhaC['hora_saida'];
						$data_entradaC = $linhaC['data_entrada'];
						$dataC = $oData->formataDataPInterface($dataC);
					?>
						<table width=100% border=0 cellpadding=1 cellspacing=1 bgcolor="#CCCCCC">
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>VTR:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $vtr; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Guarnicao:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $guarda1C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda2C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda3C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda4C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda5C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Entrada:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_entradaC; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Saida:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_saidaC; ?></td>
								</tr>
				  </table>
						<HR>
					<? } ?>
			  </td>
              <td width="25%" valign="top">
			  <?
					$queryC = "select * from guarnicao where outros='HORA EXTRA' and data_entrada='$data_e' order by outros asc";
					$resultadoC = $obj->executaQuery($queryC);
					while( $linhaC = mysql_fetch_array($resultadoC) )
					{
						$idagendaC = $linhaC['id'];
						$outrosC = $linhaC['outros'];
						$guarda1C = $linhaC['guarda1'];
						$guarda2C = $linhaC['guarda2'];
						$guarda3C = $linhaC['guarda3'];
						$guarda4C = $linhaC['guarda4'];
						$guarda5C = $linhaC['guarda5'];
						$vtr = $linhaC['vtr'];
						$hora_entradaC = $linhaC['hora_entrada'];
						$hora_saidaC = $linhaC['hora_saida'];
						$data_entradaC = $linhaC['data_entrada'];
						$dataC = $oData->formataDataPInterface($dataC);
					?>
						<table width=100% border=0 cellpadding=1 cellspacing=1 bgcolor="#EAEAEA">
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>VTR:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $vtr; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Guarnicao:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $guarda1C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda2C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda3C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda4C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda5C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Entrada:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_entradaC; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B> Saida:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_saidaC; ?></td>
								</tr>
						</table>
						<HR>
					<? } ?>
			  </td>
              </tr>
            </table>
              <table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
            <tr align="center">
              <td width="25%" class="branco"><b>Apoio Sesp</b></td>
              <td width="25%" class="branco"><b>Ronda Escolar Sul</b> </td>
              <td width="25%" class="branco"><b>Ronda Escolar Norte</b> </td>
              <td width="25%" class="branco"><b>Ronda Escolar Centro</b> </td>
            </tr>
			</table>
			<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
            <tr>
              <td width="25%" valign="top">
			  <?
					$queryC = "select * from guarnicao where outros='APOIO SESP' and data_entrada='$data_e' order by outros asc";
					$resultadoC = $obj->executaQuery($queryC);
					while( $linhaC = mysql_fetch_array($resultadoC) )
					{
						$idagendaC = $linhaC['id'];
						$outrosC = $linhaC['outros'];
						$guarda1C = $linhaC['guarda1'];
						$guarda2C = $linhaC['guarda2'];
						$guarda3C = $linhaC['guarda3'];
						$guarda4C = $linhaC['guarda4'];
						$guarda5C = $linhaC['guarda5'];
						$vtr = $linhaC['vtr'];
						$hora_entradaC = $linhaC['hora_entrada'];
						$hora_saidaC = $linhaC['hora_saida'];
						$data_entradaC = $linhaC['data_entrada'];
						$dataC = $oData->formataDataPInterface($dataC);
					?>
						<table width=100% border=0 cellpadding=1 cellspacing=1 bgcolor="#cccccc">
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>VTR:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $vtr; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Guarnicao:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $guarda1C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda2C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda3C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda4C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda5C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B> Entrada:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_entradaC; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B> Saida:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_saidaC; ?></td>
								</tr>
				  </table>
						<HR>
					<? } ?>
			  </td>
              <td width="25%" valign="top">
			  <?
					$queryC = "select * from guarnicao where outros='RONDA ESCOLAR SUL' and data_entrada='$data_e' order by outros asc";
					$resultadoC = $obj->executaQuery($queryC);
					while( $linhaC = mysql_fetch_array($resultadoC) )
					{
						$idagendaC = $linhaC['id'];
						$outrosC = $linhaC['outros'];
						$guarda1C = $linhaC['guarda1'];
						$guarda2C = $linhaC['guarda2'];
						$guarda3C = $linhaC['guarda3'];
						$guarda4C = $linhaC['guarda4'];
						$guarda5C = $linhaC['guarda5'];
						$vtr = $linhaC['vtr'];
						$hora_entradaC = $linhaC['hora_entrada'];
						$hora_saidaC = $linhaC['hora_saida'];
						$data_entradaC = $linhaC['data_entrada'];
						$dataC = $oData->formataDataPInterface($dataC);
					?>
						<table width=100% border=0 cellpadding=1 cellspacing=1 bgcolor="#EAEAEA">
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>VTR:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $vtr; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Guarnicao:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $guarda1C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda2C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda3C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda4C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda5C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B> Entrada:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_entradaC; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B> Saida:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_saidaC; ?></td>
								</tr>
						</table>
						<HR>
					<? } ?>
			  </td>
              <td width="25%" valign="top">
			  <?
					$queryC = "select * from guarnicao where outros='RONDA ESCOLAR NORTE' and data_entrada='$data_e' order by outros asc";
					$resultadoC = $obj->executaQuery($queryC);
					while( $linhaC = mysql_fetch_array($resultadoC) )
					{
						$idagendaC = $linhaC['id'];
						$outrosC = $linhaC['outros'];
						$guarda1C = $linhaC['guarda1'];
						$guarda2C = $linhaC['guarda2'];
						$guarda3C = $linhaC['guarda3'];
						$guarda4C = $linhaC['guarda4'];
						$guarda5C = $linhaC['guarda5'];
						$vtr = $linhaC['vtr'];
						$hora_entradaC = $linhaC['hora_entrada'];
						$hora_saidaC = $linhaC['hora_saida'];
						$data_entradaC = $linhaC['data_entrada'];
						$dataC = $oData->formataDataPInterface($dataC);
					?>
						<table width=100% border=0 cellpadding=1 cellspacing=1 bgcolor="#CCCCCC">
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>VTR:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $vtr; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Guarnicao:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $guarda1C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda2C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda3C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda4C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda5C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B> Entrada:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_entradaC; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B> Saida:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_saidaC; ?></td>
								</tr>
						</table>
						<HR>
					<? } ?>
			  </td>
              <td width="25%" valign="top">
			  <?
					$queryC = "select * from guarnicao where outros='RONDA ESCOLAR CENTRO' and data_entrada='$data_e' order by outros asc";
					$resultadoC = $obj->executaQuery($queryC);
					while( $linhaC = mysql_fetch_array($resultadoC) )
					{
						$idagendaC = $linhaC['id'];
						$outrosC = $linhaC['outros'];
						$guarda1C = $linhaC['guarda1'];
						$guarda2C = $linhaC['guarda2'];
						$guarda3C = $linhaC['guarda3'];
						$guarda4C = $linhaC['guarda4'];
						$guarda5C = $linhaC['guarda5'];
						$vtr = $linhaC['vtr'];
						$hora_entradaC = $linhaC['hora_entrada'];
						$hora_saidaC = $linhaC['hora_saida'];
						$data_entradaC = $linhaC['data_entrada'];
						$dataC = $oData->formataDataPInterface($dataC);
					?>
						<table width=100% border=0 cellpadding=1 cellspacing=1 bgcolor="#EAEAEA">
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>VTR:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $vtr; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B>Guarnicao:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $guarda1C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda2C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda3C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda4C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top></td>
								<td width=75% align=left class=negrito><?php echo $guarda5C; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B> Entrada:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_entradaC; ?></td>
								</tr>
								<tr>
								<td width=25% align=right valign=top><FONT SIZE=1><B> Saida:</B></FONT></td>
								<td width=75% align=left class=negrito><?php echo $hora_saidaC; ?></td>
								</tr>
						</table>
						<HR>
					<? } ?>
			  </td>            </tr>
			</table>

          </table>
	</td>
	    </tr>
	</table>

	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>

