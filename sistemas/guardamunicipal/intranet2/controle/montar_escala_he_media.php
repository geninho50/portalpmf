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
	
   $idescala  = $_GET['idescala'];
   $chave  = $_GET['chave'];
   
   if($chave == 1){
   	$consulta = 'order by somah1 asc';
   }else{
   	if($chave == 2){
		$consulta = 'order by somah2 asc';
	}
   }



   $queryT = "SELECT id,semana,horainicial,horafinal,data,local,he, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM escalahoraextra where id=$idescala";
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
   
   //Pega a data atual
   $data_atual = date("Y-m-d");
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">DEMONSTRATIVO DA SOMA DE HORA EXTRA</legend>
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
				<td>
                    <select name="ychefe" class="negrito" onfocus="mudacor(this,'#8BC5F3')">
          <option value="0">SELECIONAR...</option>
          <?php 
				$queryU = "SELECT * FROM guarda_gmf where cargo!='GUARDA MUNICIPAL' order by login";
				$resultadoU = $obj->executaQuery($queryU);
				while($linhaU = mysql_fetch_array($resultadoU))
				{
					$login = $linhaU['login'];
					$cargo = $linhaU['cargo'];
			  ?>
          <option value="<?php echo $login; ?>"><?php echo $cargo.' '.$login; ?></option>
          <?php 
				} 
	  		  ?>
        </select>
                </td>
			  </tr>
			  <tr>
				<td width="129" align="right" class="letra">Auditado por:</td>
				<td><input name="auditado" type="text" value="" size="35" class="negrito" onkeyup="converteUpper(this);"/></td>
			  </tr>
			</table>
			<br>
		
			<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8"  >
              <tr>
                <td width="3%" align="center" class="branco"><input name="checktodos" type="checkbox" /></td>
                <td width="18%" align="left" class="branco"><b>Guardas</b></td>
                <td width="7%" align="center" class="branco"><b>HE 100%</b></td>
                <td width="7%" align="center" class="branco"><b>HE 200%</b></td>
                <td width="7%" align="center" class="branco"><a href="montar_escala_he_media.php?chave=1&idescala=<? echo $idescala;?>"><b>SOMA 100%</b></a></td>
                <td width="7%" align="center" class="branco"><b>QTD 100%</b></td>
                <td width="7%" align="center" class="branco"><a href="montar_escala_he_media.php?chave=2&idescala=<? echo $idescala;?>"><b>SOMA 200%</b></a></td>
                <td width="7%" align="center" class="branco"><b>QTD 200%</b></td>
                <td width="17%" align="left" class="branco"><b>Data</b></td>
                <td width="12%" align="left" class="branco"><b>Escala</b></td>
				<td width="8%" align="left" class="branco"><b>HE</b></td>
              </tr>
            </table>
			<?
				
				$query = "SELECT * from tempescala where idescala=$idescala $consulta";
				$result = $obj->executaQuery($query);
				while($linha = mysql_fetch_array($result)){
					$idescala = $linha['idescala'];
					$login = $linha['login'];
					$hora1 = $linha['hora1'];
					$hora2 = $linha['hora2'];
					$somah1 = $linha['somah1'];
					$somah2 = $linha['somah2'];
					$data = $linha['data'];
					$he = $linha['he'];
					
					$queryS = "SELECT (select count(id) from listaescala where login='".$login."' and MONTH(data)=$mesT AND YEAR(data)=$ano_atual and idescala>0 and he=1) as total1, (select count(id) from listaescala where login='".$login."' and MONTH(data)=$mesT AND YEAR(data)=$ano_atual and idescala>0 and he=2) as total2";
					$resultS = $obj->executaQuery($queryS);
					while($linhaS = mysql_fetch_array($resultS)){
						$total1 = $linhaS['total1'];
						$total2 = $linhaS['total2'];
			?>
				<table width="100%" border="0" cellpadding="1" cellspacing="1">
					<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
				 	 <td width="3%" align="center"><input name="conf[]" type="checkbox" value="<?php echo $login; ?>"/></td>
					 <td width="18%"><input name="login" type="text" value="<?php echo $login; ?>" readonly="readonly" class="negrito"/></td>
					 <td width="7%"><input name="hora1" type="text" value="<?php echo $hora1; ?>" size="1" readonly="readonly" class="negrito"/></td>
					 <td width="7%"><input name="hora2" type="text" value="<?php echo $hora2; ?>" size="1"readonly="readonly" class="negrito"/></td>
					 <td width="7%" align="center"><input name="somah1" type="text" value="<?php echo $somah1; ?>" size="1" readonly="readonly" class="negrito"/></td>
                      <td width="7%" align="center" class="negrito"><?php echo $total1; ?></td>
					 <td width="7%" align="center"><input name="somah2" type="text" value="<?php echo $somah2; ?>" size="1"readonly="readonly" class="negrito"/></td>
					 <td width="7%" align="center" class="negrito"><?php echo $total2; ?></td>
					 <td width="17%"><input name="data" type="text" value="<?php echo $data; ?>" size="10" readonly="readonly" class="negrito"/></td>
					 <td width="12%"><input name="idescala" type="text" value="<?php echo $idescala; ?>" size="1" readonly="readonly" class="negrito"/></td>
					 <td width="8%"><input name="he" type="text" value="<?php echo $he; ?>" size="1" readonly="readonly" class="negrito"/></td>
			 		</tr>
			  </table>
			<?
					}
				}	
			?>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
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