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
    
	$query = "SELECT * FROM parametro";
	$resultado = $obj->executaQuery($query);
	while ( $linha = mysql_fetch_array($resultado) )
	{	
		$parametro = $linha['parametro'];
	}
	
	$queryT = "SELECT id,semana,horainicial,horafinal,local, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM escalahoraextra where id=$idnome";
	$resultadoT = $obj->executaQuery($queryT);
	while ( $linhaT = mysql_fetch_array($resultadoT) )
	{	
		$localT = $linhaT['local'];
		$semanaT = $linhaT["semana"];
		$horainicial = $linhaT["horainicial"];
		$horafinal = $linhaT["horafinal"];
		$diaT = $linhaT['dia'];
		$mesT = $linhaT['mes'];
		$anoT = $linhaT['ano'];
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
	<legend class="negrito">Montar Escala de Hora Extra</legend>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="45%" align="left" valign="top">
			
		<fieldset>
		<legend class="negrito"><? echo $localT.' - '.$semanaT.' - '.$diaT." / ".$mesT." / ".$anoT.' - '.$horainicial.' as '.$horafinal; ?></legend>
			<form name="form1" action="../classes/controleMontarEscala.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
			<br>
			<table border="0" cellpadding="1" cellspacing="1">
			  <tr>
				<td width="129" align="right" class="letra">Chefe de Guarni&ccedil;&atilde;o:</td>
				<td><input name="xchefe" type="text" value="" size="35" /></td>
			  </tr>
			  <tr>
				<td width="129" align="right" class="letra">Auditado por:</td>
				<td><input name="auditado" type="text" value="" size="35" /></td>
			  </tr>
			</table>
			<br>
			
			<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8"  >
			  <tr>
				 <td width="5%" align="left" class="branco"><input name="checktodos" type="checkbox" /></td>
				<td width="38%" align="left" class="branco"><b>Guardas</b></td>
				<td width="12%" align="center" class="branco"><b>100%</b></td>
				<td width="12%" align="center" class="branco"><b>200%</b></td>
				<td width="22%" align="left" class="branco">Data</td>
				<td width="11%" align="left" class="branco">Escala</td>
			  </tr>
			</table>
			
			<?php 
			  $queryE = "SELECT candidatos.login,escalahoraextra.local,escalahoraextra.id,escalahoraextra.qtdhoras1,escalahoraextra.qtdhoras2,escalahoraextra.data FROM candidatos inner join escalahoraextra where candidatos.idescala='".$idnome."' and escalahoraextra.id=candidatos.idescala order by candidatos.login asc";
			   //$queryE = "SELECT * FROM candidatos where idescala='".$idnome."' order by login asc";
			   $resultE = $obj->executaQuery($queryE);
			   while($linhaE = mysql_fetch_array($resultE)):
			   
					$login =  $linhaE['login'];
					
					$query = "SELECT count(idescala) as total FROM listaescala where login='".$login."' and MONTH(data)=$mes_atual AND YEAR(data)=$ano_atual";
					$result = $obj->executaQuery($query);
					while($linha = mysql_fetch_array($result)){
							$total = $linha['total'];
			?>
			<table width="100%" border="0" cellpadding="1" cellspacing="1">
					<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
					  <td width="5%"><input name="conf[]" type="checkbox" value="<?php echo $linhaE['login']; ?>"/></td>
					 <td width="38%"><input name="login" type="text" value="<?php echo $linhaE['login']; ?>" readonly="readonly" /><? echo $total;?></td>
					 <td width="11%"><input name="hora1" type="text" value="<?php echo $linhaE['qtdhoras1']; ?>" size="1" readonly="readonly"/></td>
					 <td width="13%"><input name="hora2" type="text" value="<?php echo $linhaE['qtdhoras2']; ?>" size="1"readonly="readonly" /></td>
					 <td width="22%"><input name="data" type="text" value="<?php echo $linhaE['data']; ?>" size="10" readonly="readonly"/></td>
					 <td width="11%"><input name="idescala" type="text" value="<?php echo $linhaE['id']; ?>" size="1" readonly="readonly"/></td>
			  </tr>
			</table>
			<?php 
							
				}
			   endwhile
			   
			
			?>
			
			
			<table width="100%"  border="0">
			<tr>   
				<td><input name="Submit" type="submit" id="Confirmar" class="botao" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />   </td>
			  </tr>
			  <tr>
				<td class="letra" align="center"><a href="javascript:history.back(1);">Voltar</a></td>
			  </tr>
			</table>
			</form>
		</fieldset>	
		</td>
		<td width="12%" align="center" valign="top">
			<div id="div1">	
				<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
					<tr>
					  <td align="left" class="branco">M&ecirc;s <? echo $mes_atual; ?> de 100%</td>
				  </tr>
					<tr>
						<td align="left" class="branco"><b>Nome</B></td>
					</tr>
				</table>
				<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">	
					<?
						$queryC = "select c.login from candidatos c inner join listaescala t where c.login=t.login and MONTH(t.data)=$mes_atual and YEAR(data) = ".$ano_atual." and t.hora1 > 0 group by c.login";
						$resultadoC = $obj->executaQuery($queryC);
						while($linhaC = mysql_fetch_array($resultadoC)){
							$logintemp = $linhaC['login'];
							
					?>
				
					<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
						<td align="left" class="letra"><? echo''.$logintemp; ?></td>
					</tr>
					<? 
						} 
					?> 
				</table>
		</div>	</td>
		<td width="15%" align="center" valign="top">
		<div id="div1">
	
				<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
					<tr>
					  <td align="left" class="branco">Somatoria do mes <? echo $mes_atual; ?> </td>
					  <td align="center" class="branco">&nbsp;</td>
				  </tr>
					<tr>
						<td width="75%" align="left" class="branco"><B>Nome</B></td>				
						<td width="25%" align="center" class="branco"><B>100%</B></td>	
					</tr> 
				</table>
	
				<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
				<?php
						/*$sqlca = "select login from candidatos where idescala=$idescala";
						$resultca = $obj->executaQuery($sqlca);
						while ( $linhaca = mysql_fetch_array($resultca) )
						{	
							$loginca = $linhaca['login'];
							$sqlhora1 = "select sum(hora1) as horat1 from listaescala where login = '$loginca' and data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$parametro."-".$dia_atual."' order by horat1 asc";*/

							$sqlhora1 = "SELECT candidatos.id, candidatos.login, sum(listaescala.hora1) as horat1 from candidatos inner join listaescala where candidatos.idescala=$idnome and candidatos.login=listaescala.login and listaescala.data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$parametro."-31' group by candidatos.id order by horat1";

							$resultadohora1 = $obj->executaQuery($sqlhora1);
							while ( $linhaH1 = mysql_fetch_array($resultadohora1) )
							{	
								  $loginH1 = $linhaH1['login'];
								  $hora1 = $linhaH1['horat1'];
								  $mediaH1 = $hora1/$parametro;
								  $media1 = number_format( $mediaH1, 2, ",", "." );
					?>
							<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
								<td width="75%" align="left" class="letra"><? echo $loginH1; ?></td>
								<td width="25%" class="letra" align="center"><? echo $media1; ?></td>
							</tr>
					<?php
							}
						//}		
					?>
				</table>
		</div>	
		</td>
		<td width="1%" align="left" valign="top">&nbsp;</td>
		<td width="12%" align="center" valign="top">
			<div id="div1">	
				<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
					<tr>
					  <td align="left" class="branco">M&ecirc;s <? echo $mes_atual; ?> de 200%</td>
				  </tr>
					<tr>
						<td align="left" class="branco"><b>Nome</B></td>
					</tr>
				</table>
				<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">	
					<?
						$queryC = "select c.login from candidatos c inner join listaescala t where c.login=t.login and MONTH(t.data)=$mes_atual and YEAR(data) = ".$ano_atual." and t.hora2 > 0 group by c.login";
						$resultadoC = $obj->executaQuery($queryC);
						while($linhaC = mysql_fetch_array($resultadoC)){
							$logintemp = $linhaC['login'];
							
					?>
				
					<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
						<td align="left" class="letra"><? echo''.$logintemp; ?></td>
					</tr>
					<? 
						} 
					?> 
				</table>
		</div>	</td
		
		><td width="15%" align="center" valign="top">
		<div id="div1">
	
			<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
				<tr>
				  <td align="left" class="branco">Somatoria do mes <? echo $mes_atual; ?></td>
				  <td align="center" class="branco">&nbsp;</td>
			  </tr>
				<tr>
					<td width="75%" align="left" class="branco"><B>Nome</B></td>				
					<td width="25%" align="center" class="branco"><B> 200%</B></td>	
				</tr> 
			</table>
	
			<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
			<?php
						/*$sqlca2 = "select login from candidatos where idescala=$idescala order by login asc";
						$resultca2 = $obj->executaQuery($sqlca2);
						while ( $linhaca2 = mysql_fetch_array($resultca2) )
						{	
							$loginca2 = $linhaca2['login'];
							$sqlhora2 = "select sum(hora2) as horat2 from totalhoras where login = '$loginca2' and data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$parametro."-".$dia_atual."' order by horat2 asc";*/
							
							$sqlhora2 = "SELECT candidatos.id, candidatos.login, sum(listaescala.hora2) as horat2 from candidatos inner join listaescala where candidatos.idescala=$idnome and candidatos.login=listaescala.login and listaescala.data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$parametro."-31' group by candidatos.id order by horat2";
							
							$resultadohora2 = $obj->executaQuery($sqlhora2);
							while ( $linhaH2 = mysql_fetch_array($resultadohora2) )
							{	
								  $loginH2 = $linhaH2['login'];
								  $hora2 = $linhaH2['horat2'];
								  $mediaH2 = $hora2/$parametro;
								  $media2 = number_format( $mediaH2, 2, ",", "." );
					?>
							<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
								<td width="75%" align="left" class="letra"><? echo $loginH2; ?></td>
								<td width="25%" class="letra" align="center"><? echo $media2; ?></td>
							</tr>
					<?php
							}
						//}		
					?>
			</table>
		  </div>
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