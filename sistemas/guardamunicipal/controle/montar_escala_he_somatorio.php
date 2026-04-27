<?php
   
   // Este primeiro header, corrigi o problema de acentuação dos caracteres.
	header('Content-Type: text/html; charset=iso-8859-1');
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];

	$loginF = $_POST['login'];
	$conf  = $_POST['conf'];
	$idescala  = $_POST['idescala'];
	$data  = $_POST['data'];

   
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
	
	$queryT = "SELECT id,semana,horainicial,horafinal,data,local,he, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM escalahoraextra where id=$idescala";
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
	<legend class="negrito">Quantidade de escala realizadas</legend>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="45%" align="left" valign="top">
			
		<fieldset>
		<legend class="negrito"><? echo $localT.' - '.$semanaT.' - '.$diaT." / ".$mesT." / ".$anoT.' - '.$horainicial.' as '.$horafinal; ?></legend>
			<form name="form1" action="pre_montar_escala_media.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
			<br>
		
			<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8"  >
			  <tr>
				<td width="5%" align="center" class="branco"><input name="checktodos" type="checkbox" /></td>
				<td width="33%" align="left" class="branco"><b>Guardas</b></td>
				<td width="6%" align="center" class="branco"><b>QTD 100%</b></td>
				<td width="6%" align="center" class="branco"><b>QTD 200%</b></td>
				<td width="22%" align="left" class="branco"><b>Data</b></td>
				<td width="11%" align="left" class="branco"><b>Escala</b></td>
				<td width="5%" align="left" class="branco"><b>HE</b></td>
			  </tr>
			</table>
			
			<?
			$tamanho = strlen($conf);
			if(isset($conf)) {
		   		foreach($conf as $loginF => $value){
		   			if($tamanho > 0){
						$query = "SELECT (select count(id) from listaescala where login='".$value."' and MONTH(data)=$mesT AND YEAR(data)=$ano_atual and idescala>0 and he=1) as total1, (select count(id) from listaescala where login='".$value."' and MONTH(data)=$mesT AND YEAR(data)=$ano_atual and idescala>0 and he=2) as total2";
						$result = $obj->executaQuery($query);
						while($linha = mysql_fetch_array($result)){
							$total1 = $linha['total1'];
							$total2 = $linha['total2'];
			?>
							<table width="100%" border="0" cellpadding="1" cellspacing="1">
								<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
				 				  <td width="5%" align="center"><input name="conf[]" type="checkbox" value="<?php echo $value; ?>"/></td>
									<td width="33%"><input name="login" type="text" value="<?php echo $value; ?>" readonly="readonly" /></td>
								  <td width="6%" align="center"><input name="total" type="text" value="<?php echo $total1; ?>" size="1" readonly="readonly"/></td>
								  <td width="6%" align="center"><input name="total" type="text" value="<?php echo $total2; ?>" size="1" readonly="readonly"/></td>
									<td width="22%" align="left"><input name="data" type="text" value="<?php echo $data; ?>" size="10"readonly="readonly" /></td>
									<td width="11%"><input name="idescala" type="text" value="<?php echo $idescala; ?>" size="10" readonly="readonly"/></td>
									<td width="5%"><input name="he" type="text" value="<?php echo $he; ?>" size="5" readonly="readonly"/></td>
			 					</tr>
							</table>
			<?
						}
					}
				}
			}	
			
			?>
			<table width="100%"  border="0">
			<tr>   
				<td><input name="Submit" type="submit" id="Confirmar" class="botao" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Continuar" />   </td>
			  </tr>
				<?		 
				$queryE = "SELECT * from tempescala where idescala='".$idescala."'";
				$resultE = $obj->executaQuery($queryE);
				$linhaE = mysql_fetch_array($resultE);
				if($linhaE){
				?>
              <tr>
				<td class="letra" align="center"><a href="../classes/controleLimparTabela.php?idescala=<? echo $idescala;?>">Limpar Tabela</a></td>
			  </tr>
				<?
                    }
				?>
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