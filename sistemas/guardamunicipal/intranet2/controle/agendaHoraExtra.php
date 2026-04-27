<?php

	class_exists('../classes/DB_mysql') || require_once("../classes/DB_mysql.php");
	class_exists('../classes/trataString') || require_once ("../classes/trataString.php");
	class_exists('../classes/trataArquivo') || require_once ("../classes/trataArquivo.php");
	class_exists('../classes/trataData') || require_once ("../classes/trataData.php");

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
			case 1:  $mescaseInt = "JANEIRO";   break;
			case 2:  $mescaseInt = "FEVEREIRO"; break;
			case 3:  $mescaseInt = "MARCO";     break;
			case 4:  $mescaseInt = "ABRIL";     break;
			case 5:  $mescaseInt = "MAIO";      break;
			case 6:  $mescaseInt = "JUNHO";     break;
			case 7:  $mescaseInt = "JULHO";     break;
			case 8:  $mescaseInt = "AGOSTO";    break;
			case 9:  $mescaseInt = "SETEMBRO";  break;
			case 10: $mescaseInt = "OUTUBRO";   break;
			case 11: $mescaseInt = "NOVEMBRO";  break;
			case 12: $mescaseInt = "DEZEMBRO";  break;
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
<script type="text/javascript" src="scripts/wz_tooltip.js"></script>
<!-- fim mensagem imagem -->
<fieldset>
		<legend class="cabecalho">CALENDARIOS DE SERVICOS</legend>
<table width="504" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td colspan="3">&nbsp;</td>
</tr>

<?php
	// Agenda deste Mês e Ano
	$queryA = "select * from guarnicao where MONTH(data_entrada)='".$mes."' and YEAR(data_entrada)='".$ano."' order by DAY(data_entrada)";
	$resultadoA = $obj->executaQuery($queryA);
	//$nvaloresagendaint = 0;
	//$nvaloresagendaint = $obj->numregistros($queryA);
	while ( $linhaA = mysql_fetch_array($resultadoA) )
	{
		$idagendaA = $linhaA['id'];
		$outrosA = $linhaA['outros'];
		$guarda1A = $linhaA['guarda1'];
		$guarda2A = $linhaA['guarda2'];
		$guarda3A = $linhaA['guarda3'];
		$guarda4A = $linhaA['guarda4'];
		$guarda5A = $linhaA['guarda5'];
		$hora_entradaA = $linhaA['hora_entrada'];
		$hora_saidaA = $linhaA['hora_saida'];
		$data_entradaA = $linhaA['data_entrada'];
		$dataA = $oData->formataDataPInterface($data_entrada);
?>
<?php
	} // fim while	
?>
<tr>
  <td width="23"  align="left"><a href="javascript:mudarAgendaInt(8,1,<?php echo $mesant; ?>,<?php echo $anoant; ?>);"><img src="imagens/seta_esq.jpg" width="23" height="25" border="0"></a></td>
  <td width="461" align="center" bgcolor="#E9E9E9" class="style7"><?php echo "".mesesInt($mes)." | <FONT COLOR=\"#7A3635\">".$ano."</FONT>"; ?></td>
  <td width="24"><a href="javascript:mudarAgendaInt(8,1,<?php echo $mesprox; ?>,<?php echo $anoprox; ?>);"><img src="imagens/seta_dir.jpg" width="24" height="25" border="0"></a></td>
</tr>
<tr align="center">
  <td colspan="3">
  
  <table width="504" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">

	  <tr align="center" bgcolor="#006699" class="style2">
		<td width="72" height="30">D</td>
		<td width="72">S</td>
		<td width="72">T</td>
		<td width="72">Q</td>
		<td width="72">Q</td>
		<td width="72">S</td>
		<td width="72">S</td>
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
				
				$query = "select * from guarnicao where MONTH(data_entrada)='".$mes."' and YEAR(data_entrada)='".$ano."' and DAY(data_entrada)='".$d."' order by DAY(data_entrada)";
				$resultado = $obj->executaQuery($query);
				if ( $linha = mysql_fetch_array($resultado) )
				{
					$idagenda = $linha['id'];
					$outros = $linha['outros'];
					$guarda1 = $linha['guarda1'];
					$guarda2 = $linha['guarda2'];
					$guarda3 = $linha['guarda3'];
					$guarda4 = $linha['guarda4'];
					$guarda5 = $linha['guarda5'];
					$hora_entrada = $linha['hora_entrada'];
					$hora_saida = $linha['hora_saida'];
					$data_entrada = $linha['data_entrada'];
					$data = $oData->formataDataPInterface($data_entrada);
?>
<td style="background-color: rgb(135, 206, 235)"><a href="administrar_horaextra.php?&data=<? echo $data_entrada; ?>"><FONT COLOR="white" size="2"><?php echo $d; ?></FONT></a></td>				
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
			$queryC = "select * from guarnicao where MONTH(data_entrada)='".$mesC."' and YEAR(data_entrada)='".$anoC."' and DAY(data_entrada)='".$dC."' order by DAY(data_entrada)";
			$resultadoC = $obj->executaQuery($queryC);
			if ( $linhaC = mysql_fetch_array($resultadoC) )
			{
				$idagendaC = $linhaC['id'];
				$outrosC = $linhaC['outros'];
				$guarda1C = $linhaC['guarda1'];
				$guarda2C = $linhaC['guarda2'];
				$guarda3C = $linhaC['guarda3'];
				$guarda4C = $linhaC['guarda4'];
				$guarda5C = $linhaC['guarda5'];
				$hora_entradaC = $linhaC['hora_entrada'];
				$hora_saidaC = $linhaC['hora_saida'];
				$data_entradaC = $linhaC['data_entrada'];
				$dataC = $oData->formataDataPInterface($dataC);
?>
<td style="background-color: rgb(135, 206, 235)"><a href="administrar_horaextra.php?data=<? echo $data_entrada; ?>"><FONT COLOR="white" size="2"><?php echo $dini; ?></FONT></a></td><?php
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
<tr>
  <td colspan="3">&nbsp;</td>
</tr>
</table>
</fieldset>
</div>