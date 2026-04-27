<?php
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$idsession = $_SESSION['idSESSION'];
	
	$sql = "SELECT * FROM usuario where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$login = $linhaS["login"];
	}
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");

   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<script type="text/javascript" src="js/jquery.min.js"></script> 
		<script type="text/javascript">
		jQuery(document).ready(function() {
		  jQuery(".content").hide();
		  //toggle the componenet with class msg_body
		  jQuery(".heading").click(function()
		  {
			jQuery(this).next(".content").slideToggle(500);
		  });
		});
</script>
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
		$result = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($result);
		if( $linha )
		{
			$login = $linha["login"];
			
			include("menu.php");
		}
	?>
	</th>
  </tr>
  </tr>
  <tr>
	<td align="center" valign="top" class="negrito">
		
		<?
			$queryM = "SELECT sum(hora1) as horat1,sum(hora2) as horat2 from listaescala where login='$login' and data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$mes_atual."-31' group by login";
			$resultM = $obj->executaQuery($queryM);
			while($linhaM = mysql_fetch_array($resultM)){
				$hora1 = $linhaM['horat1'];
				//$mediaH1 = $hora1/$parametro;
				//$media1 = number_format( $mediaH1, 2, ",", "." );
		  
				$hora2 = $linhaM['horat2'];
				//$mediaH2 = $hora2/$parametro;
				//$media2 = number_format( $mediaH2, 2, ",", "." );
			}
		?>
		
		
		<table width="372" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="170" align="center">
				<table width="100%" border="1" cellspacing="1" cellpadding="1" bordercolor="#cccccc" style="border-collapse: collapse">
				  <tr>
					<td width="140" align="center" bgcolor="#0086A8" class="branco">Soma da Hora de 100% </td>
				  </tr>
				  <tr>
					<td align="center" class="negrito"><? echo $hora1;?></td>
				  </tr>
			  </table>

			</td>
			<td width="38">&nbsp;</td>
		  	<td width="164" align="center">
		  		
				<table width="100%" border="1" cellspacing="1" cellpadding="1" bordercolor="#cccccc" style="border-collapse: collapse">
				  <tr>
					<td width="130" align="center" bgcolor="#0086A8" class="branco">Soma da Hora de 200% </td>
				  </tr>
				  <tr>
					<td align="center" class="negrito"><? echo $hora2;?></td>
				  </tr>
			  </table>
		  	</td>
		  </tr>
    </table>	</td>
  </tr>
  <tr>
    <td>
	<!-- inicio do adm -->
	<fieldset>
	<legend class="fieldset">Escalas que estou concorrendo </legend>

    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<tr>
		<td width="53%" align="left" class="branco"><B>Evento</B></td>	
		<td width="11%" align="center" class="branco"><B>Retirar nome</B></td>				
	</tr> 
	</table>
	
	<?php 
		$chaveF = true;
		$queryE = "SELECT * FROM tempcandidatos where login='$login' and idescala in (select idescala from escalahoraextra where status='S')";
		$resultE = $obj->executaQuery($queryE);
		
		while( $linhaE = mysql_fetch_array($resultE) )
		{
	
			$ids = $linhaE["idescala"];
			
				$queryF = "select id,semana,local, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano,horainicial,horafinal from escalahoraextra where id=$ids and status='S'";
				$resultF = $obj->executaQuery($queryF);
				while ( $linhaF = mysql_fetch_array($resultF) )
				{		
					$id = $linhaF['id'];
					$semana = $linhaF['semana'];
					$horainicial = $linhaF['horainicial'];
					$horafinal = $linhaF['horafinal'];
					$local = $linhaF['local'];
					$dia = $linhaF['dia'];
					$mes = $linhaF['mes'];
					$ano = $linhaF['ano'];
					
	?>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	
		<tr bgColor="<?PHP if($chaveF)
							{
								echo '#cccccc';
							}
							else{ 
								echo '#ffffff';
							} 
							$chaveF=!$chaveF;
						?>">
			<td width="53%" align="left" class="negrito"><? echo $linhaF['local'].' - '.$semana; ?> - <?php echo $dia." / ".$mes." / ".$ano.' - '.$horainicial; ?> as <?php echo $horafinal; ?></td>		
			<td width="11%" class="negrito" align="center"><A HREF="../classes/controleNomeEscala.php?id=<? echo $linhaF['id']; ?>&login=<? echo $login; ?>&chave=2" border="0"><IMG SRC="images/false.gif" ALT="Clic na imagem para retirar nome da escala" width="16" height="16"BORDER="0"></A></td>
		</tr>
	
	
	</table>
	
	<?php
				}
		}
	?>
	
	</fieldset>
	
	
	<fieldset>
		<legend class="fieldset">Candidatos que est&atilde;o concorrendo a escala </legend>
	
		<table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
			<tr>
				<td width="40%" align="left" class="branco"><B>Evento</B></td>	
				<td width="60%" align="left" class="branco"><b>Candidatos a Escalas</b></td>
			</tr> 
		</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<?php
		$chave = true;
		$queryJ = "SELECT id,semana,local, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano,horainicial,horafinal FROM escalahoraextra where id in (SELECT idescala FROM candidatos) and status='S' order by data asc, horainicial asc ";
		$resultadoJ = $obj->executaQuery($queryJ);
		while ( $linhaJ = mysql_fetch_array($resultadoJ) )
		{		
		
			$idescala = $linhaJ['id'];
			$semanaJ = $linhaJ['semana'];
			$horainicial = $linhaJ['horainicial'];
			$horafinal = $linhaJ['horafinal'];
			$local = $linhaJ['local'];
			$dia = $linhaJ['dia'];
			$mes = $linhaJ['mes'];
			$ano = $linhaJ['ano'];
	?>
		<div class="layer1">
		<tr bgColor="<?PHP if($chave)
							{
								echo '#cccccc';
							}
							else{ 
								echo '#ffffff';
							} 
							$chave=!$chave;
						?>">
			<td width="40%" align="left" class="negrito"><? echo $local.' - '.$semanaJ; ?> - <?php echo $dia." / ".$mes." / ".$ano.' - '.$horainicial; ?> as <?php echo $horafinal; ?></td>
			<td width="60%" class="negrito" align="left"><p class="heading">Mais Detalhes</p>
			
				<div class="content">			
					<?PHP 
						$query = "SELECT login FROM candidatos where idescala=$idescala order by login asc";
						GeraColunas(3, $query);
					?>  
				</div>			
		    </td>
		</tr>
	 </div>
	<?php
		}
	?>
	</table>
	
	</fieldset>
	<fieldset>
		<legend class="fieldset">Escalas Disponiveis</legend>
	
		<table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
		<tr>
			<td width="32%" align="left" class="branco"><B>Evento</B></td>
			<td width="62%" align="left" class="branco"><B>Informacoes do Evento</B></td>	
			<td width="6%" align="center" class="branco"><b>Participar</b></td>
		</tr> 
	</table>
	
	
	<?php
		$chavet = true;
		$query = "SELECT id,semana, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano,horainicial,horafinal,local,tempo,qtdguardas,qtdhoras1,qtdhoras2,missao,lanche FROM escalahoraextra where status='S' order by data asc, horainicial asc";
		$resultado = $obj->executaQuery($query);
		while ( $linhaN = mysql_fetch_array($resultado) )
		{		
		
			$id = $linhaN['id'];
			$semanaN = $linhaN['semana'];
			$horainicial = $linhaN['horainicial'];
			$horafinal = $linhaN['horafinal'];
			$qtdhoras1 = $linhaN["qtdhoras1"];
			$qtdhoras2 = $linhaN["qtdhoras2"];
			$qtdguardas = $linhaN["qtdguardas"];
			$local = $linhaN['local'];
			$missao = $linhaN["missao"];
			$dia = $linhaN['dia'];
			$mes = $linhaN['mes'];
			$ano = $linhaN['ano'];
			$tempo = $linhaN['tempo'];
			$lanche = $linhaN['lanche'];

	?>
	<div class="layer1">
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>">
			<td width="32%" align="left" class="negrito"><? echo $linhaN['local'].'<br><font class="fieldset"> '.$dia.'/'.$mes.'/'.$ano.' - '.$semanaN.'</font> - '.$horainicial; ?> as <?php echo $horafinal; ?> </td>		
			<td width="62%" align="left" class="negrito"><p class="heading">Mais Detalhes</p>
			
			<div class="content">
				<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
				  <tr>
					<td width="351" align="right" bgcolor="#006699" class="branco">Data:</td>
					<td width="881" align="left"  class="negrito"><?php echo $dia." / ".$mes." / ".$ano; ?></td>
				  </tr>
				  <tr>
					<td width="351" align="right" bgcolor="#006699" class="branco">Semana:</td>
					<td width="881" align="left"  class="negrito"><?php echo $semanaN; ?></td>
				  </tr>
				  <tr>
					<td align="right" bgcolor="#006699" class="branco">Hora:</td>
					<td align="left"  class="negrito"><?php echo $horainicial; ?> as <?php echo $horafinal; ?></td>
				  </tr>
				  <tr>
					<td align="right" bgcolor="#006699" class="branco">Qtd de Horas: </td>
					<td align="left"  class="negrito"><?php echo $qtdhoras1; ?> de 100% e <?php echo $qtdhoras2; ?> de 200%</td>
				  </tr>
				  <tr>
					<td align="right" bgcolor="#006699" class="branco">Qtd de Guardas: </td>
					<td align="left"  class="negrito"><?php echo $qtdguardas; ?></td>
				  </tr>
				  <tr>
					<td align="right" bgcolor="#006699" class="branco">Evento:</td>
					<td align="left" class="negrito"><?php echo $local; ?></td>
				  </tr>
				  <tr>
					<td align="right" valign="top" bgcolor="#006699" class="branco">Missao:</td>
					<td align="left"  class="negrito"><?php echo $missao; ?></td>
				  </tr>
				  <tr>
					<td align="right" bgcolor="#006699" class="branco">Tempo de publica&ccedil;&atilde;o:</td>
					<td align="left" class="negrito"><?php echo $tempo; ?></td>
				  </tr>
				  <tr>
					<td align="right" bgcolor="#006699" class="branco">Lanche:</td>
					<td align="left" class="negrito"><?php echo $lanche; ?></td>
				  </tr>
				</table>
		  </div>		  
		  </td>
			<td width="6%" align="center" class="negrito"><A HREF="../classes/controleNomeEscala.php?id=<? echo $linhaN['id']; ?>&login=<? echo $login; ?>&chave=1" border="0"><IMG SRC="images/true.gif" ALT="Clic na imagem para fazer parte da escala" width="14" height="13"BORDER="0"></A></td>
		</tr>
	</table>
	</div>
	<?php
		}
	?>
	</fieldset>
	
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
	
	</td>
  </tr>
</table>
	<!-- fim do adm -->
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