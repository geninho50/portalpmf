<?php


	class_exists('../classes/DB_mysql') || require_once("../classes/DB_mysql.php");
	class_exists('../classes/trataString') || require_once ("../classes/trataString.php");
	class_exists('../classes/controleAcessoClique') || require_once ("../classes/controleAcessoClique.php");
	class_exists('../classes/trataArquivo') || require_once ("../classes/trataArquivo.php");
	class_exists('../classes/trataData') || require_once ("../classes/trataData.php");

	$objAcesso = new controleAcessoClique;
	$obj = new DB_mysql;
	$objS = new trataString;
	$objT = new trataArquivo;
	$oData = new trataData;
	$conexao = $obj->conectarConf();

	$query = "";
	$normal = "style=color:#333333;";
	$hoje = "style=color:#FF0000;";
	$evento = "style=color:##990000;";
	$eventobgcolor = "bgcolor=\"#DFDFDF\"";
	$mes  = date("m");
	$dia  = date("d");
	$ano  = date("Y");
	$ano_ = substr($ano,-2);
	$mes = $mes+1;
	//$dia = $dia-2;
	// Mes Parâmentro
	$mesp = $_GET['mes'];
	if( $mesp > 0 )
	{
		// Pegou...
	}
	else
	{
		$mesp = $_POST['mes'];
	}
	if( $mesp > 0 )
	{
		$mes = $mesp;
	}

	// Dia Parâmentro
	$diap = $_GET['dia'];
	if( $diap > 0 )
	{
		// Pegou...
	}
	else
	{
		$diap = $_POST['dia'];
	}
	if( $diap > 0 )
	{
		$dia = $diap;
	}

	// Ano Parâmentro
	$anop = $_GET['ano'];
	if( $anop > 0 )
	{
		// Pegou...
	}
	else
	{
		$anop = $_POST['ano'];
	}
	if( $anop > 0 )
	{
		$ano = $anop;
		$ano_ = substr($ano,-2);
	}

	function mesesInt($a) 
	{
		switch($a)
		{
			case 1:  $mescaseInt = "janeiro";   break;
			case 2:  $mescaseInt = "fevereiro"; break;
			case 3:  $mescaseInt = "março";     break;
			case 4:  $mescaseInt = "abril";     break;
			case 5:  $mescaseInt = "maio";      break;
			case 6:  $mescaseInt = "junho";     break;
			case 7:  $mescaseInt = "julho";     break;
			case 8:  $mescaseInt = "agosto";    break;
			case 9:  $mescaseInt = "setembro";  break;
			case 10: $mescaseInt = "outubro";   break;
			case 11: $mescaseInt = "novembro";  break;
			case 12: $mescaseInt = "dezembro";  break;
		}
		return $mescaseInt;
	}

	// Mês Anterior
	$primeiro_dia_mes = 01;
	$dataant = $oData->somardiasData($ano."-".$mes."-".$primeiro_dia_mes,-1); // 2009-11-01
	$dataanttemp = explode("-", $dataant);
	$diaant = $dataanttemp[2];
	$mesant = $dataanttemp[1];
	$anoant = $dataanttemp[0];

	// Próximo Mês
	$ultimodiames = $oData->retornaUltimoDiaMes($mes,$ano);
	$dataprox = $oData->somardiasData($ano."-".$mes."-".$ultimodiames,1); // 2009-11-01
	$dataproxtemp = explode("-", $dataprox);
	$diaprox = $dataproxtemp[2];
	$mesprox = $dataproxtemp[1];
	$anoprox = $dataproxtemp[0];
?>

<div id="mostraComboAgendaInt">
<?php include("incCarregandoInt.php");?>

<!-- ini mensagem imagem -->
<script type="text/javascript" src="js/wz_tooltip.js"></script>
<!-- fim mensagem imagem -->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td colspan="3">&nbsp;</td>
</tr>

<?php
	// Agenda deste Mês e Ano
	$queryA = "select * from horaagente where Length(agente) > 0 and MONTH(data)='".$mes."' and YEAR(data)='".$ano."' order by DAY(data)";
	$resultadoA = $obj->executaQuery($queryA);
	//$nvaloresagendaint = 0;
	//$nvaloresagendaint = $obj->numregistros($queryA);
	while ( $linhaA = mysql_fetch_array($resultadoA) )
	{
		$idagendaA = $linhaA['id'];
		$nomeA = $linhaA['agente'];
		$turnoA = $linhaA['turno'];
		$dataA = $linhaA['data'];
		$dataA = $oData->formataDataPInterface($dataA);
?>

<?php
	} // fim while	
?>


<tr>
  <td colspan="3">&nbsp;</td>
</tr>
<tr>
  <td width="23"  align="center"><a href="javascript:mudarAgendaInt(2,1,<?php echo $mesant; ?>,<?php echo $anoant; ?>);"><img src="images/seta_esq.jpg" width="23" height="25" border="0"></a></td>
  <td width="1198" align="center" bgcolor="#E9E9E9" class="style7"><?php echo "".mesesInt($mes)." | <FONT COLOR=\"#7A3635\">".$ano."</FONT>"; ?></td>
  <td width="24" align="center"><a href="javascript:mudarAgendaInt(2,1,<?php echo $mesprox; ?>,<?php echo $anoprox; ?>);"><img src="images/seta_dir.jpg" width="24" height="25" border="0"></a></td>
</tr>
<tr align="center">
  <td colspan="3">
  
  <table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">

	  <tr align="center" bgcolor="#006699" class="style2">
		<td width="30" height="30">D</td>
		<td width="72">S</td>
		<td width="72">T</td>
		<td width="72">Q</td>
		<td width="72">Q</td>
		<td width="72">S</td>
		<td width="30">S</td>
	  </tr>


<?php
	$Data = strtotime($mes."/".$dia."/".$ano_);
	$Dia  = date('w',strtotime(date('n/\0\1\/Y',$Data)));
	$Dias = date('t',$Data);
	$dini = 0;
	$d = 0;
	for ($i=1,$d=1;$d<=$Dias;)
	{
		echo("<tr align=\"center\" bgcolor=\"#DFDFDF\" class=\"style2\">");
		for ($x=1;$x<=7 && $d <= $Dias;$x++,$i++)
		{
			if ($i > $Dia)
			{
				$destaque = '';
				$bgcolor = '';
				if ($d != $dia)    { $destaque = $normal; }
				if ($d == $dia) { $destaque = $hoje; }
				if (($x == 1) && ($d == $dia)) { $destaque = $hoje; }				
				
				$query = "select * from horaagente where Length(agente) > 0 and MONTH(data)='".$mes."' and YEAR(data)='".$ano."' and DAY(data)='".$d."' order by DAY(data)";
				$resultado = $obj->executaQuery($query);
				if ( $linha = mysql_fetch_array($resultado) )
				{
					$idagenda = $linha['id'];
					$nome = $linha['agente'];
					$turno = $linha['turno'];
					$datac = $linha['data'];
					$data = $oData->formataDataPInterface($datac);
?>

	<td valign="top" style="background-color: rgb(135, 206, 235);"><FONT COLOR="white" size="2"><?php echo $d; ?></FONT>

			 <table align=center valign=middle width=100%>
	<tr>
	<td>
	
						
			<table width=100% border=1 cellpadding=1 cellspacing=1 bordercolor="#FFFFFF">
			<tr>
				<td width=25% align=left valign=top bgcolor="#006699" bordercolor="#FFFFFF" class="branco"><b>Matutino</b></td>
					<? 
					 $queryt = "SELECT * FROM horaagente where turno='Matutino' and data='$datac'";
					  $resultadot = $obj->executaQuery($queryt);
					  while($linhat = mysql_fetch_assoc($resultadot)){ 
							$id = $linhat['id'];
							$nome = $linhat['agente'];
							$turno = $linhat['turno'];
					?>		
					
					<tr>
								<td width=75% align=left class=negrito><a href="../classes/controleAdicionarAgente.php?id=<? echo $id;?>&nome=<? echo $nome; ?>"><font color="#000000" size="1"><?php echo $nome; ?></font></a></td>
					</tr>
					
					<? 
					}
					?>
			</tr>
			<tr>
				<td width=25% align=left valign=top bgcolor="#006699" bordercolor="#FFFFFF" class="branco"><b>Vespertino</b></td>
					<? 
					 $queryt = "SELECT * FROM horaagente where turno='Vespertino' and data='$datac'";
					 $resultadot = $obj->executaQuery($queryt);
					  while($linhat = mysql_fetch_assoc($resultadot)){ 
							$id = $linhat['id'];
							$nome = $linhat['agente'];
							$turno = $linhat['turno'];
					?>		
					
					<tr>
								<td width=75% align=left class=negrito><a href="../classes/controleAdicionarAgente.php?id=<? echo $id;?>&nome=<? echo $nome; ?>"><font color="#000000" size="1"><?php echo $nome; ?></font></a></td>
					</tr>
					
					<? 
					}
					?>
			</tr>
			</table>
	</td>
	</tr>
</table>			</td>
<?php
				}
				else
				{
					echo("<td height=\"30\" ".$destaque.">".$d."</td>");
				}
				$d = $d + 1;
			}
			else { echo("<td> </td>"); }
		}
		for (;$x<=7;$x++)
		{ 
			$dini++;
			$datadini = $oData->somardiasData($oData->formataDataPBanco($data),$dini); // retona no formato: 2009-12-01
			$datadinitemp = explode("-", $datadini);
			$dC = $datadinitemp[2];
			$mesC = $datadinitemp[1];
			$anoC = $datadinitemp[0];
			$queryC = "select * from horaagente where Length(agente) > 0 and MONTH(data)='".$mesC."' and YEAR(data)='".$anoC."' and DAY(data)='".$dC."' order by DAY(data)";
			$resultadoC = $obj->executaQuery($queryC);
			if ( $linhaC = mysql_fetch_array($resultadoC) )
			{
				$idagendaC = $linhaC['id'];
				$nomeC = $linhaC['agente'];
				$turnoC = $linhaC['turno'];
				$dataC = $linhaC['data'];
				$dataC = $oData->formataDataPInterface($dataC);
?>
<td valign="top" style="background-color: rgb(135, 206, 235); " ><FONT COLOR="white" size="2"><?php echo $dini; ?></FONT>

  <table align=center valign=middle width=100%>
	<tr>
	<td>
	
						
			<table width=100% border=1 cellpadding=1 cellspacing=1 bordercolor="#FFFFFF">
			<tr>
				<td width=25% align=left valign=top bgcolor="#006699" bordercolor="#FFFFFF" class="branco"><b>Matutino</b></td>
					<? 
					 $queryt = "SELECT * FROM horaagente where turno='Matutino' and data='$dataC'";
					  $resultadot = $obj->executaQuery($queryt);
					  while($linhat = mysql_fetch_assoc($resultadot)){ 
							$id = $linhat['id'];
							$nome = $linhat['agente'];
							$turno = $linhat['turno'];
					?>		
					
					<tr>
								<td width=75% align=left class=negrito><a href="../classes/controleAdicionarAgente.php?id=<? echo $id;?>&nome=<? echo $nome; ?>"><font color="#000000" size="1"><?php echo $nome; ?></font></a></td>
					</tr>
					
					<? 
					}
					?>
			</tr>
			<tr>
				<td width=25% align=left valign=top bgcolor="#006699" bordercolor="#FFFFFF" class="branco"><b>Vespertino</b></td>
					<? 
					 $queryt = "SELECT * FROM horaagente where turno='Vespertino' and data='$dataC'";
					  $resultadot = $obj->executaQuery($queryt);
					  while($linhat = mysql_fetch_assoc($resultadot)){ 
							$id = $linhat['id'];
							$nome = $linhat['agente'];
							$turno = $linhat['turno'];
					?>		
					
					<tr>
								<td width=75% align=left class=negrito><a href="../classes/controleAdicionarAgente.php?id=<? echo $id;?>&nome=<? echo $nome; ?>"><font color="#000000" size="1"><?php echo $nome; ?></font></a></td>
					</tr>
					
					<? 
					}
					?>
			</tr>
			</table>
	</td>
	</tr>
</table></td>						
<?php
			}
			else
			{
				echo("<td height=\"30\"> ".$dini." </td>"); 
			}
		}
		echo("</tr>");
	}
?>
  </table></td>
</tr>
<tr align="left">
  <td colspan="3"><a href="javascript:POPUP('pop_hora_zonaazul.php','800','600')"><img src="images/impressora4.jpg" width="32" height="32" border="0"></a></td>
</tr>
</table>

</div>