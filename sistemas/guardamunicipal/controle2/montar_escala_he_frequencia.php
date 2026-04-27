<?php
   
   // Este primeiro header, corrigi o problema de acentuação dos caracteres.
	header('Content-Type: text/html; charset=iso-8859-1');
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   $idnome =  (int)$_POST['idescala'];
   
   if( $idnome == 0 )
   {
      $idnome = $_GET['idescala'];
   }
   
   
   require ("../classes/DB_mysql.php");
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
   
   //Pega a data atual
   $data_atual = date("Y-m-d");
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
   
   $dataTemp = $mes_atual-1;
	$queryT = "SELECT id,semana,horainicial,horafinal,data,local,he, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM escalahoraextra where id=$idnome";
	$resultadoT = $obj->executaQuery($queryT);
	while ( $linhaT = mysql_fetch_array($resultadoT) )
	{	
		$localT = $linhaT['local'];
		$semanaT = $linhaT["semana"];
		$horainicial = $linhaT["horainicial"];
		$horafinal = $linhaT["horafinal"];
		$he = $linhaT["he"];
		$diaT = $linhaT['dia'];
		$mesT = $linhaT['mes'];
		$anoT = $linhaT['ano'];
		$data = $linhaT['data'];
	}
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
  <tr>
    <th bgcolor="#666666">
	<!-- ini menu -->
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
    <!-- fim menu -->
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!-- inicio do adm -->
	<fieldset>
	<legend class="negrito">Quantitativo de falta em escalas de servico</legend>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="45%" align="left" valign="top">
			
		<fieldset>
		<legend class="negrito"><? echo $localT.' - '.$semanaT.' - '.$diaT." / ".$mesT." / ".$anoT.' - '.$horainicial.' as '.$horafinal; ?></legend>
			<form name="form1" action="montar_escala_he_somatorio.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
			<br>
		
			<table width="70%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8"  >
			  <tr>
				 <td width="10%" align="center" class="branco"><input name="checktodos" type="checkbox" /></td>
				<td width="46%" align="left" class="branco"><b>Guardas</b></td>
				<td width="18%" align="center" class="branco"><b>Data</b></td>
				<td width="16%" align="center" class="branco"><b>Escala</b></td>
				<td width="10%" align="center" class="branco"><b>HE</b></td>
			  </tr>
			</table>
			<table width="70%" border="0" cellpadding="1" cellspacing="1">
			<?php 
			  $queryE = "SELECT * FROM candidatos where idescala=$idnome";
			  $resultE = $obj->executaQuery($queryE);
			  while($linhaE = mysql_fetch_array($resultE)):
				$guarda = $linhaE['login'];
			?>			
				<tr
			<? 
					 	$query = "select MAX(datafim) as datafim from falta where guarda='$guarda'";
						$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");
						while ($linha=mysql_fetch_array($resultado))
						{
							$datafim = $linha['datafim'];
							if($data_atual<=$datafim)
							{
								$time_inicial = strtotime($data_atual);
								$time_final = strtotime($datafim);
								$diferenca = $time_final - $time_inicial; // 19522800 segundos
								$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
			?>
									bgcolor="#FF0000">
			<?
							}else{
			?> 
                        		bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'" > 
			<?
							}
						}
					 ?> 
					 <td width="10%" align="center"><input name="conf[]" type="checkbox" value="<?php echo $linhaE['login']; ?>"/></td>
					 <td width="46%">
                     	<input name="login" type="text" value="<?php echo $linhaE['login']; ?>" readonly="readonly" class="negrito"/> 
						<? 
							if($data_atual<=$datafim)
							{
								echo '<font class="branco">Faltam '.$dias.' dias para concorrer a nova escala.</font>';
                      		} 
						?> 
                     </td>
					 <td width="18%" align="center"><input name="data" type="text" value="<?php echo $data; ?>" size="10" readonly="readonly" class="negrito"/></td>
					 <td width="16%" align="center"><input name="idescala" type="text" value="<?php echo $linhaE['idescala']; ?>" size="1" readonly="readonly" class="negrito"/></td>
					 <td width="10%" align="center"><input name="he" type="text" value="<?php echo $he; ?>" size="1" readonly="readonly" class="negrito"/></td>
			  </tr>
			<?php 
			   endwhile
			?>
			</table>
			<table width="100%"  border="0">
			  <tr>   
				<td><input name="Submit" type="submit" id="Confirmar" class="letra" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Continuar" />   </td>
			  </tr>
			  <tr>
				<td class="letra" align="center"><a href="javascript:history.back(1);">Voltar</a></td>
			  </tr>
			</table>
			</form>
			</fieldset>
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