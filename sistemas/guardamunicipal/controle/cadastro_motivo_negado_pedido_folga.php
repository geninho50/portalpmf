<?php
		header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past	
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	$objS = new trataString;
	
	$idtemp = 0;
	$idtemp = (int)$_POST['idtemp'];
	$idfolga = (int)$_POST['idfolga'];
	$gmsolicitante = mysql_escape_string($_POST['gmsolicitante']);
	if( $idtemp == 0 )
	{
		$idtemp = (int)$_GET['idtemp'];
		$status = $_GET['status'];
		$idfolga = (int)$_GET['idfolga'];
		$gmsolicitante = mysql_escape_string($_GET['gmsolicitante']);

	}
	
	if($status == 2){
		$tempstatus='Negado';
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
	<!--inicio adm-->
	<fieldset>
	<legend class="negrito">Pedido de Folga</legend>
<form name="form1" method="post" action="../classes/controleFolgaNegado.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%"  border="0" cellspacing="1" cellpadding="1">
            <tr>
              <td width="14%" align="right" class="letra">N&ordm;:</td>
              <td width="86%"><input name="idtemp" type="text" id="idtemp" value="<?php echo $idtemp; ?>" size="5" readonly="readonly" /></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%"  border="0" cellspacing="1" cellpadding="1">
            <tr>
              <td width="14%" align="right" valign="top" class="letra">Status:</td>
              <td width="86%" align="left">			
              <input name="status" type="text" id="status" value="<?php echo $status; ?>" size="3" readonly="readonly" />
              <?php echo $tempstatus; ?></td>

          </table></td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%"  border="0" cellspacing="1" cellpadding="1">
            <tr>
              <td width="14%" align="right" valign="top" class="letra">Motivo(s) da Nega&ccedil;&atilde;o: </td>
              <td width="86%"><textarea name="xmotivostatus" cols="80" rows="8"></textarea> </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    <tr>	
    	<td width="14%">&nbsp;		</td>
        <td width="86%"><input name="Submit" type="submit" class="botao" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
    </tr>
</table>
</form>
</fieldset>

<fieldset>
	<legend class="negrito">Pedido de Folga</legend>

    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<tr>
		<td width="10%" align="center" class="branco"><B>GM Solicitante</B></td>
		<td width="20%" align="center" class="branco"><B>No Per�odo de...</B></td>
		<td width="20%" align="left" class="branco"><B>Folga</B></td>
		<td width="32%" align="left" class="branco"><B>Motivo</B></td>
		<td width="7%" align="center" class="branco">Pendentes</td>
	</tr> 
</table>

<?php 
	 $chavet = true;
	$query = "SELECT id, DAY(datainicio) as diainicio,MONTH(datainicio) as mesinicio,YEAR(datainicio) as anoinicio,DAY(datafim) as diafim,MONTH(datafim) as mesfim,YEAR(datafim) as anofim,idfolga,gmsolicitante,datainicio,datafim, motivofolga, motivostatus, status FROM pedidofolga where status=0 and gmsolicitante='$gmsolicitante' and idfolga=$idfolga order by id desc";
	$result = $obj->executaQuery($query);
	
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
			$idfolgatemp = $linhaT['id'];
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
		<td width="10%" align="center" class="negrito"><? echo $gmsolicitante; ?></td>
		<td width="20%" align="center" class="negrito"><?PHP echo $diainicio.' / '.$mesinicio.' / '.$anoinicio.' -- '.$diafim.' / '.$mesfim.' / '.$anofim.' -> '.$dias.' dias'; ?></td>
		<td width="20%" align="left" class="negrito"><? echo $descricao; ?></td>
		<td width="32%" align="left" class="negrito"><? echo $linhaF['motivofolga']; ?></td>
		<td width="7%" align="center" class="negrito"><?PHP echo $resultado; ?></td>
	</tr>


</table>

<?php
		}
	}
?>

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

