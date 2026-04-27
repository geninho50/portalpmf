<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
   $idOcorrencia = 0;
   $idOcorrencia = (int)$_POST['idOcorrencia'];
   if( $idOcorrencia == 0 )
   {
	 $idOcorrencia = (int)$_GET['idOcorrencia'];
   }

    $sqlA = "SELECT * FROM ocorrencia where id=$idOcorrencia";
    $resultadoA = $obj->executaQuery($sqlA);
	if( $linhaA = mysql_fetch_array($resultadoA))
	{
		$id = $linhaA["id"];
		$telefone = $linhaA["telefone"];
		$comunicante = $linhaA["comunicante"];
		$rua = $linhaA["rua"];
		$numero = $linhaA["numero"];
		$bairro = $linhaA["bairro"];
		$descricao_ocorrrencia = $linhaA["descricao_ocorrencia"];
   }  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHeadCentral.php");?>
<!-- fim inc head -->
</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td width="42%" align="left"><span class="menu_guia">Voc&ecirc; est&aacute; em: <a href="menu_entrada.php">Menu Principal </a> -> <a href="menu_central.php">Central </a> -> <font color="#FF0000">Controle Administrativo </font></span></td>
    <td width="58%" align="right"><font class="menu_guia"><? echo $data_atual.' / '.$hora_atual.' Operador: '.$login; ?></font></td>
  </tr>
  <tr>
    <td colspan="2">
	<!--inicio adm-->
	<fieldset>
	<legend class="negrito">Controle Administrativo</legend>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="3%">&nbsp;</td>			
			<tD width="61%">&nbsp;</tD>
			<td width="4%">&nbsp;</td>
		  </tr>
		 
			<?
						$sqlG = "SELECT * FROM guarnicao where status=1 AND idclassevtr=5 order by guarda1 asc";
						$resultadoG = $obj->executaQuery($sqlG);
						while( $linhaG = mysql_fetch_array($resultadoG))
						{
							$id = $linhaG["id"];
							$vtr = $linhaG["vtr"];
							$guarda1 = $linhaG["guarda1"];
							$guarda2 = $linhaG["guarda2"];
							$guarda3 = $linhaG["guarda3"];
							$guarda4 = $linhaG["guarda4"];
							$guarda5 = $linhaG["guarda5"];
							$outros = $linhaG["outros"];
			?>
				<tr onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor=''">
					<th height="23" align="center">&nbsp;</th>
					<th width="61%" height="23" align="left" class="negrito">
					<? 
								if($guarda1 != '' ){echo $guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								if($outros != '' ){echo ' - '.$outros;}
					?>
					<hr>
					</th>
					<th width="4%" align="center"><a onClick="FINALIZAR('../classes/controleJ12Adm.php?idGuarnicao=<? echo $id;?>&chave=1&vtr=<? echo $vtr;?>')" href="#"><IMG SRC="images/j12.png" width="20" height="20" BORDER="0" title="FINALIZAR"></A></th>
				</tr>
			<?
						}
			?>
			<?
						$sqlG = "SELECT * FROM guarnicao where status=1 AND idclassevtr=3 order by vtr";
						$resultadoG = $obj->executaQuery($sqlG);
						while( $linhaG = mysql_fetch_array($resultadoG))
						{
							$id = $linhaG["id"];
							$vtr = $linhaG["vtr"];
							$guarda1 = $linhaG["guarda1"];
							$guarda2 = $linhaG["guarda2"];
							$guarda3 = $linhaG["guarda3"];
							$guarda4 = $linhaG["guarda4"];
							$guarda5 = $linhaG["guarda5"];
							$outros = $linhaG["outros"];
			?>
			<?
						}
			?>
			<?
						$sqlG = "SELECT * FROM guarnicao where status=1 AND idclassevtr=2 order by vtr";
						$resultadoG = $obj->executaQuery($sqlG);
						while( $linhaG = mysql_fetch_array($resultadoG))
						{
							$id = $linhaG["id"];
							$vtr = $linhaG["vtr"];
							$guarda1 = $linhaG["guarda1"];
							$guarda2 = $linhaG["guarda2"];
							$guarda3 = $linhaG["guarda3"];
							$guarda4 = $linhaG["guarda4"];
							$guarda5 = $linhaG["guarda5"];
							$outros = $linhaG["outros"];
			?>
			<?
						}
			?>
			<?
						$sqlG = "SELECT * FROM guarnicao where status=8 order by vtr";
						$resultadoG = $obj->executaQuery($sqlG);
						while( $linhaG = mysql_fetch_array($resultadoG))
						{
							$id = $linhaG["id"];
							$vtr1 = $linhaG["vtr"];
							$guarda1 = $linhaG["guarda1"];
							$guarda2 = $linhaG["guarda2"];
							$guarda3 = $linhaG["guarda3"];
							$guarda4 = $linhaG["guarda4"];
							$guarda5 = $linhaG["guarda5"];
							$sqlP = "SELECT id,motivo FROM p18 where idguarnicao=$id and status=0";
							$resultadoP = $obj->executaQuery($sqlP);
							if( $linhaP = mysql_fetch_array($resultadoP))
							{
								$idp18 = $linhaP["id"];
								$motivo = $linhaP["motivo"];
			?>
			<?
							}
						}
			?>
			<?
						$sqlG = "SELECT * FROM guarnicao where status=1 AND idclassevtr=1 order by vtr";
						$resultadoG = $obj->executaQuery($sqlG);
						while( $linhaG = mysql_fetch_array($resultadoG))
						{
							$id = $linhaG["id"];
							$vtr1 = $linhaG["vtr"];
							$guarda1 = $linhaG["guarda1"];
							$guarda2 = $linhaG["guarda2"];
							$guarda3 = $linhaG["guarda3"];
							$guarda4 = $linhaG["guarda4"];
							$guarda5 = $linhaG["guarda5"];
							$outros = $linhaG["outros"];
			?>
			<?
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
