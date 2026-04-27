<?php
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
	header('Content-Type: text/html; charset=iso-8859-1');
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$objT = new trataArquivo;
	$objS = new trataString;
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$login = $linhaS["login"];
		$matricula = $linhaS["matricula"];
	}
	
	/*$sqlP = "select * from permissao_setor where matricula=$matricula";
	$resultP = $obj->executaQuery($sqlP);
	$linhaP = mysql_fetch_array($resultP);
	if( $linhaP )
	{
		
		$logistica = $linhaP["logistica"];
		$pessoal = $linhaP["pessoal"];
		$digitacao = $linhaP["digitacao"];
		$educacao = $linhaP["educacao"];
		$central = $linhaP["central"];
		$ti = $linhaP["ti"];
		$matutino = $linhaP["matutino"];
		$vespertino = $linhaP["vespertino"];
		$noturno = $linhaP["noturno"];
		$especial = $linhaP["12x36"];
		$passarela = $linhaP["passarela"];
		$rondaescolar = $linhaP["rondaescolar"];
	}
	
	if($logistica=='S'){
		$queryD = "SELECT id, DAY(datatroca) as dia,MONTH(datatroca) as mes,YEAR(datatroca) as ano,gmsolicitante,gmsolicitado,formareposicao,motivotroca,status FROM trocaservico where status=0 and turno='Logisitca' order by id desc";
		$resultD = $obj->executaQuery($queryD);
		$query = "SELECT id, DAY(datainicio) as diainicio,MONTH(datainicio) as mesinicio,YEAR(datainicio) as anoinicio,DAY(datafim) as diafim,MONTH(datafim) as mesfim,YEAR(datafim) as anofim,idfolga,gmsolicitante,datainicio,datafim, motivofolga, motivostatus, status FROM pedidofolga where status=0 and turno='Logisitca' order by id desc";
		$result = $obj->executaQuery($query);
		$queryE = "SELECT id, DAY(datadoacao) as dia,MONTH(datadoacao) as mes,YEAR(datadoacao) as ano,gmsolicitante,status FROM doacaosangue where status=0 and turno='Logisitca' order by id desc";
		$resultE = $obj->executaQuery($queryE);
	}*/
	
	
	if( $login=='PAULO' || $login=='ALEX'){
		$queryD = "SELECT id, DAY(datatroca) as dia,MONTH(datatroca) as mes,YEAR(datatroca) as ano,gmsolicitante,gmsolicitado,formareposicao,motivotroca,status,data FROM trocaservico where status=0 and turno='Matutino' order by id desc";
		$resultD = $obj->executaQuery($queryD);
		$query = "SELECT id, DAY(datainicio) as diainicio,MONTH(datainicio) as mesinicio,YEAR(datainicio) as anoinicio,DAY(datafim) as diafim,MONTH(datafim) as mesfim,YEAR(datafim) as anofim,idfolga,gmsolicitante,datainicio,datafim, motivofolga, motivostatus, status FROM pedidofolga where status=0 and turno='Matutino' order by id desc";
		$result = $obj->executaQuery($query);
		$queryE = "SELECT id, DAY(datadoacao) as dia,MONTH(datadoacao) as mes,YEAR(datadoacao) as ano,gmsolicitante,status,data FROM doacaosangue where status=0 and turno='Matutino' order by id desc";
		$resultE = $obj->executaQuery($queryE);
	}
	if( $login=='BASSI'){
		$queryD = "SELECT id, DAY(datatroca) as dia,MONTH(datatroca) as mes,YEAR(datatroca) as ano,gmsolicitante,gmsolicitado,formareposicao,motivotroca,status,data FROM trocaservico where status=0 and turno in('Vespertino','Noturno','12x36','Passarela','Sentinelas') order by id desc";
		$resultD = $obj->executaQuery($queryD);
		$query = "SELECT id, DAY(datainicio) as diainicio,MONTH(datainicio) as mesinicio,YEAR(datainicio) as anoinicio,DAY(datafim) as diafim,MONTH(datafim) as mesfim,YEAR(datafim) as anofim,idfolga,gmsolicitante,datainicio,datafim, motivofolga, motivostatus, status FROM pedidofolga where status=0 and turno in('Vespertino','Noturno','12x36','Passarela','Sentinelas')order by id desc";
		$result = $obj->executaQuery($query);
		$queryE = "SELECT id, DAY(datadoacao) as dia,MONTH(datadoacao) as mes,YEAR(datadoacao) as ano,gmsolicitante,status,data FROM doacaosangue where status=0 and turno in('Vespertino','Noturno','12x36','Passarela','Sentinelas') order by id desc";
	}
	/*if( $login=='ANDREY' ){
		$queryD = "SELECT id, DAY(datatroca) as dia,MONTH(datatroca) as mes,YEAR(datatroca) as ano,gmsolicitante,gmsolicitado,formareposicao,motivotroca,status,data FROM trocaservico where status=0 and turno='Logistica' order by id desc";
		$resultD = $obj->executaQuery($queryD);
		$query = "SELECT id, DAY(datainicio) as diainicio,MONTH(datainicio) as mesinicio,YEAR(datainicio) as anoinicio,DAY(datafim) as diafim,MONTH(datafim) as mesfim,YEAR(datafim) as anofim,idfolga,gmsolicitante,datainicio,datafim, motivofolga, motivostatus, status FROM pedidofolga where status=0 and turno='Logistica' order by id desc";
		$result = $obj->executaQuery($query);
		$queryE = "SELECT id, DAY(datadoacao) as dia,MONTH(datadoacao) as mes,YEAR(datadoacao) as ano,gmsolicitante,status,data FROM doacaosangue where status=0 and turno='Logistica' order by id desc";
		$resultE = $obj->executaQuery($queryE);
	}*/
	/*if( $login=='MARYANNE' ){
		$queryD = "SELECT id, DAY(datatroca) as dia,MONTH(datatroca) as mes,YEAR(datatroca) as ano,gmsolicitante,gmsolicitado,formareposicao,motivotroca,status,data FROM trocaservico where status=0 and turno in('Educacao','Central','Comando') order by id desc";
		$resultD = $obj->executaQuery($queryD);
		$query = "SELECT id, DAY(datainicio) as diainicio,MONTH(datainicio) as mesinicio,YEAR(datainicio) as anoinicio,DAY(datafim) as diafim,MONTH(datafim) as mesfim,YEAR(datafim) as anofim,idfolga,gmsolicitante,datainicio,datafim, motivofolga, motivostatus, status FROM pedidofolga where status=0 and turno in('Educacao','Central','Comando') order by id desc";
		$result = $obj->executaQuery($query);
		$queryE = "SELECT id, DAY(datadoacao) as dia,MONTH(datadoacao) as mes,YEAR(datadoacao) as ano,gmsolicitante,status,data FROM doacaosangue where status=0 and turno in('Educacao','Central','Comando') order by id desc";
		$resultE = $obj->executaQuery($queryE);
	}*/
	if( $login=='JONAS' || $login=='ALBERTO' || $login=='JOSENEY' ){
		$queryD = "SELECT id, DAY(datatroca) as dia,MONTH(datatroca) as mes,YEAR(datatroca) as ano,gmsolicitante,gmsolicitado,formareposicao,motivotroca,status,data FROM trocaservico where status=0 order by id desc";
		$resultD = $obj->executaQuery($queryD);
		$query = "SELECT id,DAY(data) as diaD,MONTH(data) as mesD,YEAR(data) as anoD, DAY(datainicio) as diainicio,MONTH(datainicio) as mesinicio,YEAR(datainicio) as anoinicio,DAY(datafim) as diafim,MONTH(datafim) as mesfim,YEAR(datafim) as anofim,idfolga,gmsolicitante,datainicio,datafim, motivofolga, motivostatus, status,data FROM pedidofolga where status=0 order by id desc";
		$result = $obj->executaQuery($query);
		$queryE = "SELECT id, DAY(datadoacao) as dia,MONTH(datadoacao) as mes,YEAR(datadoacao) as ano,gmsolicitante,status,data FROM doacaosangue where status=0 order by id desc";
		$resultE = $obj->executaQuery($queryE);
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
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
	<fieldset>
	<legend class="negrito">Administrar Servicos Online</legend>
	<!--inicio adm-->
	<fieldset>
	<legend class="fieldset">Troca de Servico</legend>

    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<tr>
		<td width="4%" align="center" class="branco"><strong>N</strong></td>	
		<td width="7%" align="center" class="branco"><strong>Data</strong></td>	
		<td width="10%" align="center" class="branco"><B>GM Solicitante</B></td>
		<td width="11%" align="center" class="branco"><B>Troca com...</B></td>
		<td width="8%" align="center" class="branco"><B>Para o dia...</B></td>
		<td width="15%" align="center" class="branco"><B>Forma de Reposicao</B></td>
		<td width="38%" align="left" class="branco"><B>Motivo</B></td>
		<td width="7%" align="center" class="branco"><B>Status</B></td>				
	</tr> 
</table>

<?php 
    $chavet = true;
	while( $linhaD = mysql_fetch_array($resultD) )
	{
		$status = $linhaD['status'];
		$id = $linhaD['id'];
		$dia = $linhaD['dia'];
		$mes = $linhaD['mes'];
		$ano = $linhaD['ano'];
		$data = $linhaD['data'];
?>

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
		<td width="4%" align="center" class="negrito"><? echo $linhaD['id']; ?></td>
		<td width="7%" align="center" class="negrito"><? echo $linhaD['data']; ?></td>
		<td width="10%" align="center" class="negrito"><? echo $linhaD['gmsolicitante']; ?></td>
		<td width="11%" align="center" class="negrito"><? echo $linhaD['gmsolicitado']; ?></td>
		<td width="8%" align="center" class="negrito"><?PHP echo $dia.' / '.$mes.' / '.$ano; ?></td>
		<td width="15%" align="center" class="negrito"><? echo $linhaD['formareposicao']; ?></td>		
		<td width="38%" align="left" class="negrito"><? echo $linhaD['motivotroca']; ?></td>
		<td width="7%" class="negrito" align="center">
		<a href="../classes/controleTrocaServico.php?id=<?PHP echo $id; ?>&status=1" border="0"><IMG SRC="images/true.gif" ALT="Mais detalhes" width="14" height="13" BORDER="0"></A>
		<a href="cadastro_motivo_negado_troca_servico.php?id=<?PHP echo $id; ?>&status=2" border="0"><IMG SRC="images/false.gif" ALT="Mais detalhes" width="14" height="13" BORDER="0"></A>
		</td>
	</tr>


</table>

<?php
	}
?>

</fieldset>

<fieldset>
	<legend class="fieldset">Pedido de Folga</legend>

    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<tr>
		<td width="4%" align="center" class="branco"><strong>N</strong></td>
		<td width="7%" align="center" class="branco"><strong>Data</strong></td>	
		<td width="9%" align="center" class="branco"><B>GM Solicitante</B></td>
		<td width="18%" align="center" class="branco"><B>No Periodo de...</B></td>
		<td width="18%" align="left" class="branco"><B>Folga</B></td>
		<td width="32%" align="left" class="branco"><B>Motivo</B></td>
		<td width="7%" align="center" class="branco"><b>Pendentes</b></td>
		<td width="5%" align="center" class="branco"><B>Status</B></td>				
	</tr> 
</table>

<?php 
	$chavet = true;
	while( $linhaF = mysql_fetch_array($result) )
	{
		$idtemp = $linhaF['id'];
		$status = $linhaF['status'];
		$idfolga = $linhaF['idfolga'];
		$gmsolicitante = $linhaF['gmsolicitante'];
		$diainicio = $linhaF['diainicio'];
		$mesinicio = $linhaF['mesinicio'];
		$anoinicio = $linhaF['anoinicio'];
		$diafim = $linhaF['diafim'];
		$mesfim = $linhaF['mesfim'];
		$anofim = $linhaF['anofim'];
		$datafim = $linhaF['datafim'];
		$dataincio = $linhaF['datainicio'];		
		$diaD = $linhaF['diaD'];
		$mesD = $linhaF['mesD'];
		$anoD = $linhaF['anoD'];

		$data1=''; // coloque a data vinda do banco de dados
		$data1= explode("-",$dataincio); 
		$data2=''; // coloque a data vinda do banco de dados
		$data2= explode("-",$datafim); 
		
		$datatemp1 = mktime(0,0,0,$data1[1],$data1[2],$data1[0]);
		$datatemp2 = mktime(0,0,0,$data2[1],$data2[2],$data2[0]);
		$dias = ($datatemp2 - $datatemp1)/86400;
		$dias = ceil($dias)+1;
		
		$queryT = "SELECT * FROM folga where id='$idfolga' order by id desc";
		$resultT = $obj->executaQuery($queryT);
		
		while( $linhaT = mysql_fetch_array($resultT) )
		{
			$descricao = $linhaT['descricao'];
			$idfolga = $linhaT['id'];
			$qtade = $linhaT['qtade'];
			$qtadeatual = $linhaT['qtadeatual'];
			
			$resultado = $qtade - $qtadeatual;
?>

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
		<td width="4%" align="center" class="negrito"><? echo $linhaF['id']; ?></td>
		<td width="7%" align="center" class="negrito"><? echo $diaD.' / '.$mesD.' / '.$anoD; ?></td>
		<td width="9%" align="center" class="negrito"><? echo $gmsolicitante; ?></td>
		<td width="18%" align="center" class="negrito"><?PHP echo $diainicio.' / '.$mesinicio.' / '.$anoinicio.' -- '.$diafim.' / '.$mesfim.' / '.$anofim.' -> '.$dias.' dias'; ?></td>
		<td width="18%" align="left" class="negrito"><? echo $descricao; ?></td>
		<td width="32%" align="left" class="negrito"><? echo $linhaF['motivofolga']; ?></td>
		<td width="7%" align="center" class="negrito"><?PHP echo $resultado; ?></td>
		<td width="5%" class="negrito" align="center">
		<a href="cadastro_autorizado_pedido_folga.php?idtemp=<?PHP echo $idtemp; ?>&status=1&idfolga=<? echo $idfolga;?>&gmsolicitante=<? echo $gmsolicitante;?>" border="0"><IMG SRC="images/true.gif" ALT="Mais detalhes" width="14" height="13" BORDER="0"></A>
		<a href="cadastro_motivo_negado_pedido_folga.php?idtemp=<?PHP echo $idtemp; ?>&status=2&idfolga=<? echo $idfolga;?>&gmsolicitante=<? echo $gmsolicitante;?>" border="0"><IMG SRC="images/false.gif" ALT="Mais detalhes" width="14" height="13" BORDER="0"></A>
		</td>
	</tr>


</table>

<?php
		}
	}
?>

</fieldset>

<fieldset>
	<legend class="fieldset">Doacao de Sangue</legend>

    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<tr>
		<td width="5%" align="center" class="branco"><strong>N</strong></td>	
		<td width="9%" align="center" class="branco"><strong>Data</strong></td>	
		<td width="10%" align="center" class="branco"><B>GM Solicitante</B></td>
		<td width="70%" align="left" class="branco"><B>Para o dia...</B></td>
		<td width="6%" align="center" class="branco"><B>Status</B></td>				
	</tr> 
</table>

<?php 
	 $chavet = true;
	while( $linhaE = mysql_fetch_array($resultE) )
	{
		$status = $linhaE['status'];
		$id = $linhaE['id'];
		$dia = $linhaE['dia'];
		$mes = $linhaE['mes'];
		$ano = $linhaE['ano'];
?>

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
		<td width="5%" align="center" class="negrito"><? echo $linhaE['id']; ?></td>
		<td width="9%" align="center" class="negrito"><? echo $linhaE['data']; ?></td>
		<td width="10%" align="center" class="negrito"><? echo $linhaE['gmsolicitante']; ?></td>
		<td width="70%" align="left" class="negrito"><?PHP echo $dia.' / '.$mes.' / '.$ano; ?></td>
		<td width="6%" class="negrito" align="center">
		<a href="../classes/controleDoacaoSangue.php?id=<?PHP echo $id; ?>&status=1" border="0"><IMG SRC="images/true.gif" ALT="Mais detalhes" width="14" height="13" BORDER="0"></A>
		<a href="cadastro_motivo_negado_doacao_sangue.php?id=<?PHP echo $id; ?>&status=2" border="0"><IMG SRC="images/false.gif" ALT="Mais detalhes" width="14" height="13" BORDER="0"></A>
		</td>
	</tr>


</table>

<?php
	}
?>

</fieldset>



</table>
<fieldset>
	<legend class="fieldset">Cadastrar Folgas</legend>
<form name="form1" method="post" action="../classes/controleFolgaCalendario.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="5%" align="right" class="letra">Data:<span class="style1">*</span></td>
    <td width="13%" align="left"><input type="text" value="<? echo $dataini;?>" readonly name="dataini" class="stylo1" size="12"/>
      <a onclick="displayCalendar(document.forms[0].dataini,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data' /></a> 
	</td>
    <td width="5%" align="right"><span class="letra">GM:<span class="style1">*</span></span></td>
    <td width="12%" align="left"><select name="ygmsolicitante">
      <option value="0">Selecionar...</option>
      <?php 
				$queryS = "SELECT * FROM guarda_gmf order by login";
				$resultadoS = $obj->executaQuery($queryS);
				while($linhaS = mysql_fetch_array($resultadoS))
				{
					$login = $linhaS['login'];
			  ?>
      <option value="<?php echo $login; ?>"><?php echo $login; ?></option>
      <?php 
				} 
	  		  ?>
    </select></td>
    <td width="10%" align="right"><span class="letra">Motivo Folga: </span></td>
    <td width="14%" align="left"><input type="text" name="motivo" /></td>
    <td width="7%" align="right"><span class="letra">Turno:<span class="style1">*</span></span></td>
    <td width="12%" align="left"><select name="yturno">
     <option value="0">Selecionar...</option>
	  <option value="Matutino">Matutino</option>
      <option value="Vespertino">Vespertino</option>
      <option value="Noturno">Noturno</option>
	  <option value="12x36">12x36</option>
    </select></td>
    <td width="22%" align="left"><input name="Submit" type="submit" class="botao" id="Submit4" value="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" /></td>
    </tr>

</table>

</form>
</fieldset>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30">&nbsp;</td>
    <td width="1084">
		<!-- ini agenda -->
			<?php include("agendaint.php"); ?>
			<!-- fim agenda  -->
	</td>
    <td width="30">&nbsp;</td>
  </tr>
</table>
	<!--fim adm-->
	</fieldset>
	
	</td>
  </tr>
</table>


</body>
</html>

