<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   $idescala =  (int)$_POST['idescala'];
   if( $idescala == 0 )
   {
      $idescala = (int)$_GET['idescala'];
	  $dataTemp = $_GET['data'];
   }
   
   require ("../classes/DB_mysql.php");
   require ("../classes/trataData.php");
   $objD = new trataData;
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
  
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
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

</head>

<body> 
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th>&nbsp;</th>
  </tr>
  <tr>
    <td colspan="2">
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">LISTA DE CHAMADA</legend>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="45%">
<form name="form1" action="" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="0"  >
  <tr>
     <td width="5%" align="left" class="branco">&nbsp;</td>
     <td width="95%" align="left" class="letra">
		<!-- ini agenda -->
			<?php include("calPresenca.php"); ?>
		<!-- fim agenda  -->
	</td>
	</tr>
  <tr>
    <td align="left" class="branco">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="branco">&nbsp;</td>
    <td align="left" class="letra">Data da Consulta: <? $dataT = $objD->formataDataPInterface($dataTemp); echo $dataT;?> </td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
	<td width="25%" valign="top">
		<fieldset>
   			<legend class="cabecalho">MATUTINO</legend>
			<?
			$queryE = "select * from usuario where turno=1 order by turno asc, login asc";
			$resultE = $obj->executaQuery($queryE);
			while($linhaE = mysql_fetch_array($resultE)):
				$loginJ =  $linhaE['login'];
				$turno =  $linhaE['turno'];
			?>
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
						<tr align="left">
							
							<? 
							$queryP = "select * from chamada where login='$loginJ' and data='$dataTemp'";
							$resultP = $obj->executaQuery($queryP);
							$linhaP= mysql_fetch_array($resultP);
							if($linhaP){
							?>
                                  <td bgcolor="#228B22" width="5%" align="center"></td>	
							<? 
                            }else{
                            ?>    
                                  <td bgcolor="#cccccc" width="5%" align="center"></td>
                            <?    
                             }
							?>						  
							
							<td width="42%" >
                            <input name="login" type="text" value="<?php echo $linhaE['login']; ?>" readonly="readonly" /> </td>
							<td width="53%" align="left">
							<? 
							$queryF = "select max(id) as id from ferias where login='$loginJ'";
							$resultF = $obj->executaQuery($queryF);
							while($linhaF = mysql_fetch_array($resultF)):
								$idF=$linhaF['id'];
								
								$queryFD = "select * from ferias where id='$idF'";
								$resultFD = $obj->executaQuery($queryFD);
								$linhaFD = mysql_fetch_array($resultFD);
								if($linhaFD){
									$datai=$linhaFD['data_inicial'];
									$dataf=$linhaFD['data_final'];
									$atividade=$linhaFD['atividade'];
								
									if($data_atual>=$datai && $data_atual<=$dataf){
										if($atividade==0){echo'';}
										if($atividade==1){echo'<B><font color="#666666" size="2">FERIAS</font></B>';}
										if($atividade==2){echo'<B><font color="#4682B4" size="2">ATESTADO</font></B>';}
										if($atividade==3){echo'<B><font color="#cccccc" size="2">FOLGA</font></B>';}
										if($atividade==4){echo'<B><font color="#FF0000" size="2">DOACAO</font></B>';}
										if($atividade==5){echo'<B><font color="#ffa500" size="2">LICENCA GALA</font></B>';}
										if($atividade==6){echo'<B><font color="#cccccc" size="2">LICENCA NOJO</font></B>';}
										if($atividade==7){echo'<B><font color="#00bfff" size="2">LICENCA PATERNIDADE</font></B>';}
										if($atividade==8){echo'<B><font color="#ff00ff" size="2">LICENCA GESTACAO</font></B>';}
										if($atividade==9){echo'<B><font color="#ffff00" size="2">LICENCA NAO REMUNERADA</font></B>';}
										if($atividade==10){echo'<B><font color="#63b8ff" size="2">LICENCA PREMIA</font></B>';}
									}
								}
							endwhile
							?>
							</td>
						<TR>
					</table>
			<?
			endwhile
			?>
		</fieldset>
	</td>
	<td width="25%" valign="top">
		<fieldset>
  			<legend class="cabecalho">VESPERTINO</legend>
			<?
			$queryE = "select * from usuario where turno=2 order by turno asc, login asc";
			$resultE = $obj->executaQuery($queryE);
			while($linhaE = mysql_fetch_array($resultE)):
				$loginJ =  $linhaE['login'];
				$turno =  $linhaE['turno'];
				$chave =  $linhaE['chave'];
				$datai=$linhaE['data_inicial'];
				$dataf=$linhaE['data_final'];
				$atividade=$linhaE['atividade'];
			?>
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
						<tr align="left">
							<? 
							$queryP = "select * from chamada where login='$loginJ' and data='$dataTemp'";
							$resultP = $obj->executaQuery($queryP);
							$linhaP= mysql_fetch_array($resultP);
							if($linhaP){?>
                                                            <td bgcolor="#228B22" width="5%" align="center"></td>	
                                                
							<? 
                                                        }else{
                                                        ?>    
                                                            <td bgcolor="#cccccc" width="5%" align="center"></td>
                                                        <?    
                                                        }
							?>
							<td width="42%" >
                            <input name="login" type="text" value="<?php echo $linhaE['login']; ?>" readonly="readonly" /> </td>
							<td width="53%" align="left">
							<? 
							$queryF = "select max(id) as id from ferias where login='$loginJ'";
							$resultF = $obj->executaQuery($queryF);
							while($linhaF = mysql_fetch_array($resultF)):
								$idF=$linhaF['id'];
								
								$queryFD = "select * from ferias where id='$idF'";
								$resultFD = $obj->executaQuery($queryFD);
								$linhaFD = mysql_fetch_array($resultFD);
								if($linhaFD){
									$datai=$linhaFD['data_inicial'];
									$dataf=$linhaFD['data_final'];
									$atividade=$linhaFD['atividade'];
								
									if($data_atual>=$datai && $data_atual<=$dataf){
										if($atividade==0){echo'';}
										if($atividade==1){echo'<B><font color="#666666" size="2">FERIAS</font></B>';}
										if($atividade==2){echo'<B><font color="#4682B4" size="2">ATESTADO</font></B>';}
										if($atividade==3){echo'<B><font color="#cccccc" size="2">FOLGA</font></B>';}
										if($atividade==4){echo'<B><font color="#FF0000" size="2">DOACAO</font></B>';}
										if($atividade==5){echo'<B><font color="#ffa500" size="2">LICENCA GALA</font></B>';}
										if($atividade==6){echo'<B><font color="#cccccc" size="2">LICENCA NOJO</font></B>';}
										if($atividade==7){echo'<B><font color="#00bfff" size="2">LICENCA PATERNIDADE</font></B>';}
										if($atividade==8){echo'<B><font color="#ff00ff" size="2">LICENCA GESTACAO</font></B>';}
										if($atividade==9){echo'<B><font color="#ffff00" size="2">LICENCA NAO REMUNERADA</font></B>';}
										if($atividade==10){echo'<B><font color="#63b8ff" size="2">LICENCA PREMIA</font></B>';}
									}
								}
							endwhile
							?>
							</td>
						<TR>
					</table>
			<?
			endwhile
			?>
		</fieldset>
	</td>
    <td width="25%" valign="top">
		<fieldset>
   			<legend class="cabecalho">GRUPAMENTO ALFA</legend>
			<?
			$queryE = "select * from usuario where turno=3 order by turno asc, login asc";
			$resultE = $obj->executaQuery($queryE);
			while($linhaE = mysql_fetch_array($resultE)):
				$loginJ =  $linhaE['login'];
				$turno =  $linhaE['turno'];
				$chave =  $linhaE['chave'];
				$datai=$linhaE['data_inicial'];
				$dataf=$linhaE['data_final'];
				$atividade=$linhaE['atividade'];
			?>
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
						<tr align="left">
							<? 
							$queryP = "select * from chamada where login='$loginJ' and data='$dataTemp'";
							$resultP = $obj->executaQuery($queryP);
							$linhaP= mysql_fetch_array($resultP);
							if($linhaP){?>
                                                            <td bgcolor="#228B22" width="5%" align="center"></td>	
                                                
							<? 
                                                        }else{
                                                        ?>    
                                                            <td bgcolor="#cccccc" width="5%" align="center"></td>
                                                        <?    
                                                        }
							?>							
							<td width="42%" >
                            <input name="login" type="text" value="<?php echo $linhaE['login']; ?>" readonly="readonly" /> </td>
							<td width="53%" align="left">
							<? 
							$queryF = "select max(id) as id from ferias where login='$loginJ'";
							$resultF = $obj->executaQuery($queryF);
							while($linhaF = mysql_fetch_array($resultF)):
								$idF=$linhaF['id'];
								
								$queryFD = "select * from ferias where id='$idF'";
								$resultFD = $obj->executaQuery($queryFD);
								$linhaFD = mysql_fetch_array($resultFD);
								if($linhaFD){
									$datai=$linhaFD['data_inicial'];
									$dataf=$linhaFD['data_final'];
									$atividade=$linhaFD['atividade'];
								
									if($data_atual>=$datai && $data_atual<=$dataf){
										if($atividade==0){echo'';}
										if($atividade==1){echo'<B><font color="#666666" size="2">FERIAS</font></B>';}
										if($atividade==2){echo'<B><font color="#4682B4" size="2">ATESTADO</font></B>';}
										if($atividade==3){echo'<B><font color="#cccccc" size="2">FOLGA</font></B>';}
										if($atividade==4){echo'<B><font color="#FF0000" size="2">DOACAO</font></B>';}
										if($atividade==5){echo'<B><font color="#ffa500" size="2">LICENCA GALA</font></B>';}
										if($atividade==6){echo'<B><font color="#cccccc" size="2">LICENCA NOJO</font></B>';}
										if($atividade==7){echo'<B><font color="#00bfff" size="2">LICENCA PATERNIDADE</font></B>';}
										if($atividade==8){echo'<B><font color="#ff00ff" size="2">LICENCA GESTACAO</font></B>';}
										if($atividade==9){echo'<B><font color="#ffff00" size="2">LICENCA NAO REMUNERADA</font></B>';}
										if($atividade==10){echo'<B><font color="#63b8ff" size="2">LICENCA PREMIA</font></B>';}
									}
								}
							endwhile
							?>
							</td>
						<TR>
					</table>
			<?
			endwhile
			?>
		</fieldset>
	</td>
    <td width="25%" valign="top">
		<fieldset>
   			<legend class="cabecalho">GRUPAMENTO BRAVO</legend>
			<?
			$queryE = "select * from usuario where turno=4 order by turno asc, login asc";
			$resultE = $obj->executaQuery($queryE);
			while($linhaE = mysql_fetch_array($resultE)):
				$loginJ =  $linhaE['login'];
				$turno =  $linhaE['turno'];
				$chave =  $linhaE['chave'];
				$datai=$linhaE['data_inicial'];
				$dataf=$linhaE['data_final'];
				$atividade=$linhaE['atividade'];
			?>
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
						<tr align="left">
							<? 
							$queryP = "select * from chamada where login='$loginJ' and data='$dataTemp'";
							$resultP = $obj->executaQuery($queryP);
							$linhaP= mysql_fetch_array($resultP);
							if($linhaP){?>
                                                            <td bgcolor="#228B22" width="5%" align="center"></td>	
                                                
							<? 
                                                        }else{
                                                        ?>    
                                                            <td bgcolor="#cccccc" width="5%" align="center"></td>
                                                        <?    
                                                        }
							?>
							<td width="42%" >
                            <input name="login" type="text" value="<?php echo $linhaE['login']; ?>" readonly="readonly" /> </td>
							<td width="53%" align="left">
							<? 
							$queryF = "select max(id) as id from ferias where login='$loginJ'";
							$resultF = $obj->executaQuery($queryF);
							while($linhaF = mysql_fetch_array($resultF)):
								$idF=$linhaF['id'];
								
								$queryFD = "select * from ferias where id='$idF'";
								$resultFD = $obj->executaQuery($queryFD);
								$linhaFD = mysql_fetch_array($resultFD);
								if($linhaFD){
									$datai=$linhaFD['data_inicial'];
									$dataf=$linhaFD['data_final'];
									$atividade=$linhaFD['atividade'];
								
									if($data_atual>=$datai && $data_atual<=$dataf){
										if($atividade==0){echo'';}
										if($atividade==1){echo'<B><font color="#666666" size="2">FERIAS</font></B>';}
										if($atividade==2){echo'<B><font color="#4682B4" size="2">ATESTADO</font></B>';}
										if($atividade==3){echo'<B><font color="#cccccc" size="2">FOLGA</font></B>';}
										if($atividade==4){echo'<B><font color="#FF0000" size="2">DOACAO</font></B>';}
										if($atividade==5){echo'<B><font color="#ffa500" size="2">LICENCA GALA</font></B>';}
										if($atividade==6){echo'<B><font color="#cccccc" size="2">LICENCA NOJO</font></B>';}
										if($atividade==7){echo'<B><font color="#00bfff" size="2">LICENCA PATERNIDADE</font></B>';}
										if($atividade==8){echo'<B><font color="#ff00ff" size="2">LICENCA GESTACAO</font></B>';}
										if($atividade==9){echo'<B><font color="#ffff00" size="2">LICENCA NAO REMUNERADA</font></B>';}
										if($atividade==10){echo'<B><font color="#63b8ff" size="2">LICENCA PREMIA</font></B>';}
									}
								}
							endwhile
							?>
							</td>
						<TR>
					</table>
			<?
			endwhile
			?>
		</fieldset>
	</td>
  </tr>
</table>

</form>	
</td>
    </tr>
</table>
	</fieldset>
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