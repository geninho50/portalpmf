<?php
    	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	// MUDA O NOME DESTE ARQUIVO EM PHP NãO SE USA ACENTOS
   	include("incValidaSessao.php");
	$idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$sqlS = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultS = $obj->executaQuery($sqlS);
	$linhaS = mysql_fetch_array($resultS);
	if( $linhaS )
	{
		$nome = $linhaS["nome"];
		$cargo = $linhaS["cargo"];
	}

		$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Marco", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
		$diasdasemana = array (1 => "Segunda-Feira",2 => "Terca-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado",0 => "Domingo");
		 $hoje = getdate();
		 $diaA = $hoje["mday"];
		 $mesA = $hoje["mon"];
		 $nomemes = $meses[$mesA];
		 $anoA = $hoje["year"];
		 $diadasemana = $hoje["wday"];
		 $nomediadasemana = $diasdasemana[$diadasemana];
		  
		//Pega a data atual
	   $data_atual = date("Y-m-d");
	   // Pega o ano da variavel $data_atual
	   $ano_atual = substr($data_atual,0,4);
	   // Pega o mês da variavel $data_atual
	   $mes_atual = substr($data_atual,5,2);
	   // Pega o dia da variavel $data_atual
	   $dia_atual = substr($data_atual,8,2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
      <?php include("head/incHead.php");?>
<!-- fim inc head -->

</head>

<body>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top">    
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	 <tr>
        <td width="25%" align="center"><img src="imagens/brasao_pmf.png" width="90" height="107" /></td>
        <td width="50%" height="43" align="center"><font class="cabecalho2"><b>PREFEITURA MUNICIPAL DE FLORIANOPOLIS</b></font><br>
          <font class="cabecalho2">SECRETARIA MUNICIPAL DE SEGURANCA E DEFESA DO CIDADAO<br>
          GUARDA MUNICIPAL DE FLORIANOPOLIS</font> </td>
        <td width="25%" align="center"><img src="imagens/brasao.png" width="90" height="107" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">&nbsp; </td>
  </tr>
  <tr>
    <td align="center" class="bignum1">ESCALA DE HORA EXTRA </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="100%" align="center" valign="top">
	<?
				echo "<table border=0 cellpadding=0 cellspacing=0 bordercolor=#000000 style=border-collapse:collapse>";
				$query="select id, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano,semana, local, horainicial, horafinal,qtdhoras1,qtdhoras2 from escalahoraextra where chave = 0";
				$resultado = mysql_query($query);
				echo "<tr valign='top'>";
				$i=0;
				while ($valor=mysql_fetch_array($resultado)) {
					if(($i % 3) == 0){ echo "</tr><tr>"; }
					
						$id = $valor['id'];
						$semana = $valor['semana'];
						$local = $valor['local']; 
						$horai = $valor['horainicial'];
						$horaf = $valor['horafinal'];  
						$hora1 = $valor['qtdhoras1']; 
						$hora2 = $valor['qtdhoras2']; 
						$dia = $valor['dia'];
						$mes = $valor['mes'];
						$ano = $valor['ano'];
				?>
					<td valign="top"><?
						
						echo '
						<table border=1 cellspacing=0 cellpadding=0 bordercolor=#000000 align=center width=220px style=border-collapse:collapse>
							<tr bordercolor=#000000 class=negrito>
								<td align=center class=bignum>'.$local.'</td>
							</tr>
							<tr bordercolor=#000000>
								<td align=center class=data><font class=bignum>'.$semana.'</font><br>'.$dia.'/'.$mes.'/'.$ano.'<br> <font class=bignum>'.$horai.' - '.$horaf.'</font></td>
							</tr bordercolor=#000000>
							<tr>
								<td align=center class=nome height=350px>';
								$sql2="select * from listaescala where idescala=$id ";
								$resultado2 = $obj->executaQuery($sql2);
								while($dados2 = mysql_fetch_array($resultado2)){
									$login = $dados2["login"];
									$chefe = $dados2['chefe'];
									$auditado = $dados2['auditado'];

									$queryH1 ="SELECT login, sum(hora1) as horat1 FROM listaescala WHERE data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$mes_atual."-".$dia_atual."' and login='".$login."' GROUP BY login ";
									$resultH1 = $obj->executaQuery($queryH1);
									$linhaH1 = mysql_fetch_array($resultH1);
									
									$hora1temp = $linhaH1['horat1'];
									//$mediaH1 = $hora1temp/$parametro;
						  			//$media1 = number_format( $mediaH1, 2, ",", "." );
									
									$queryH2="SELECT login, sum(hora2) as horat2 FROM listaescala WHERE data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$mes_atual."-".$dia_atual."' and login='".$login."' GROUP BY login ";
									$resultH2 = $obj->executaQuery($queryH2);
									$linhaH2 = mysql_fetch_array($resultH2);
									
									$hora2temp = $linhaH2['horat2'];
									//$mediaH2 = $hora2temp/$parametro;
						  			//$media2 = number_format( $mediaH2, 2, ",", "." );
									
									echo ''.$login.' <font color=#999999> ('.$hora1temp.') ('.$hora2temp.')</font><br>';
								}
						echo'
								</td>
							</tr>
						</table>';
						
						
					?></td>
				<?
					$i++;
				}
				echo"</tr>";
				mysql_free_result($resultado);
				echo "</table>";

		?>
	
	</td>
  </tr>
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
    <td align="center"><font color="#333333" face="Arial, Helvetica, sans-serif" size="-1">Obs.: Os parenteses () ao lado do nome de cada GM, referem-se as horas feitas de 100% e 200%.</font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  </tr>
  <tr>
    <td align="center"><?php echo '<b>Auditato por '.$auditado.'</b>';?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="style8"><?php echo '<b>'.$nome.'</b>';?></td>
  </tr>
  <tr>
    <td align="center" class="style8"><?php echo '<b>'.$cargo.'</b>';?></td>
  </tr>
  <tr>
    <td align="center"><?php echo '<b>Florianopolis, '.$nomediadasemana.', '. $diaA.' de '.$nomemes.' de '.$anoA;  ?></td>
  </tr>
  
  <tr>
    <td align="right"><a href="#" OnClick="javascript:DoPrinting()"><IMG SRC="imagens/impressora.png"WIDTH="22" HEIGHT="22" BORDER=0 title="Imprimir o Relat&oacute;rio"></a></td>
  </tr>
</table>

</table>

</body>
</html>

<?php
   // Fechando as variáveis de conexão

   $obj->closeQuery();
   $obj->closeConexaoGeral();
?>