<?php
   include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
   
   $idescala =  (int)$_POST['idescala'];
   
   if( $idescala == 0 )
   {
      $idescala = (int)$_GET['idescala'];
   }
   
   
   require ("../classes/DB_mysql.php");
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
   
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$nome = $linhaS["nome"];
		$cargo = $linhaS["cargo"];
	}
   
   //Pega a data atual
   $data_atual = date("Y-m-d");
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
    
		$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Mar�o", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
		$diasdasemana = array (1 => "Segunda-Feira",2 => "Ter�a-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "S�bado",0 => "Domingo");
		 $hoje = getdate();
		 $dia = $hoje["mday"];
		 $mes = $hoje["mon"];
		 $nomemes = $meses[$mes];
		 $ano = $hoje["year"];
		 $diadasemana = $hoje["wday"];
		 $nomediadasemana = $diasdasemana[$diadasemana];

	$queryT="select login from guarda_gmf where cargo='Guarda Municipal' ORDER BY login ASC";
	$resultT = $obj->executaQuery($queryT);
	$totalT = mysql_num_rows($resultT);
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<html xmlns="http://www.w3.org/1999/xhtml">
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
		$resultado = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$login = $linha["login"];
			
			include("menu.php");
		}
	?>
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	
	<!--inicio adm-->
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="19%" valign="top">
	
	<fieldset>
	<legend class="negrito">Resultado M&eacute;dia referente ao mes <?php echo ' '.$nomemes;  ?></legend>

	<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
	
	
	  <tr>
		<td width="100%" align="left" valign="top">
		<?	
			$chavet = true;
			$query = "SELECT t.login, MONTH(t.data) as mes, sum(t.hora1) as horat1, sum(t.hora2) as horat2 FROM listaescala t inner join guarda_gmf u WHERE t.login=u.login and t.data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual.'-'.$mes_atual.'-'.$dia_atual."' and u.cargo='Guarda Municipal' GROUP BY t.login ORDER BY login ASC ";
			$result = $obj->executaQuery($query);
			echo "<table width=100% border=0 cellpadding=0 cellspacing=0 align=left>";
			$coluna = 3;
			if ($totalT>0) { 
				for($i=0;$i<=$totalT;$i++) { 
					if (($i%$coluna)==0) { 
						echo "</tr>"; //oque � isto? 
					} 
					echo '<td valign=top align=left>
							<table border=0 cellspacing=0 cellpadding=0 align=left>
								<tr bgColor='; if($chavet)
												{
													echo '#cccccc';
												}
											else{ 
													echo '#ffffff';
												} 
											$chavet=!$chavet;
										echo'>';
									if ( $dados = mysql_fetch_array($result) )
									{		
										  $login = $dados['login'];
										  $hora1 = $dados['horat1'];
										  $mestemp = $dados['mes'];
										  //$mediaH1 = $hora1/$parametro;
										  //$media1 = number_format( $mediaH1, 2, ",", "." );
										  $hora2 = $dados['horat2'];
										 // $mediaH2 = $hora2/$parametro;
										 // $media2 = number_format( $mediaH2, 2, ",", "." );
										echo '<td width="150" class=negrito>'.$login.'</td> 
											  <td align=center class=negrito>('.$hora1.') ('.$hora2.')</td>';
									}
							echo'
									
								</tr>
							</table>
						</td> ';
				}
			} else {
			echo "Nenhum registro encontrado";
			}
			echo'</table>';
			?>
			
		</td>
	  </tr>
	 </table>
	<table width="100%"  border="0">
	  <tr>
		<td align="center"><?php echo '<b>Atualizado em: '.$nomediadasemana.', '. $dia.' de '.$nomemes.' de '.$ano;  ?></td>
	  </tr>
	  <tr>
		<td align="center" class="style8">&nbsp;</td>
	  </tr>
	
	  <tr>
		<td align="center" class="style8"><?php echo '<b>'.$nome.'</b>';?></td>
	  </tr>
	  <tr>
		<td align="center" class="style8"><?php echo '<b>'.$cargo.'</b>';?></td>
	  </tr>
	  
	 <tr>
		<td align="right"><a href="#" OnClick="javascript:DoPrinting()"><IMG SRC="images/impressora4.jpg"WIDTH="16" HEIGHT="16" BORDER=0 ALT="Imprimir o Relat&oacute;rio"></a></td>
	  </tr>
	
	
	</table>
	</fieldset>	
	
	</td>
	  </tr>
	</table>
	<!--fim adm-->
	
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