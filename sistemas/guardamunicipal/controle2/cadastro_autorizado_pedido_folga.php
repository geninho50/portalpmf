<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	$objS = new trataString;
	
	$idfolga = 0;
	$idtemp = 0;
	$gmsolicitante = "";
	$status = "";
	$gmsolicitante = "";
	
	$idfolga = (int)$_GET['idfolga'];
	$idtemp = (int)$_GET['idtemp'];
	$status = mysql_escape_string($_GET['status']);
	$gmsolicitante = mysql_escape_string($_GET['gmsolicitante']);
	
	if( $idfolga == 0 )
	{
		$idfolga = (int)$_POST['idfolga'];
		//$id = $_POST['id'];
		$gmsolicitante = mysql_escape_string($_POST['gmsolicitante']);
		$status = mysql_escape_string($_POST['status']);
	}
	
	$queryG = "SELECT datainicio,datafim,turno FROM pedidofolga where id=$idtemp order by id desc";
	$resultG = $obj->executaQuery($queryG);
    $linhaG = mysql_fetch_array($resultG); 
	if($linhaG)
	{
		$datafim = $linhaG['datafim'];
		$datainicio = $linhaG['datainicio'];
		$turno = $linhaG['turno'];		
	}
	$sqlF = "SELECT * FROM folga where id=$idfolga";
	$resultF = $obj->executaQuery($sqlF);
	$linhaF = mysql_fetch_array($resultF);
	if( $linhaF )
	{
		$idfolga = $linhaF["id"];
		$descricao = $linhaF["descricao"];
	}
	
	$data1=''; // coloque a data vinda do banco de dados
	$data1= explode("-",$datainicio); 
	$data2=''; // coloque a data vinda do banco de dados
	$data2= explode("-",$datafim); 
				
	$datatemp1 = mktime(0,0,0,$data1[1],$data1[2],$data1[0]);
	$datatemp2 = mktime(0,0,0,$data2[1],$data2[2],$data2[0]);
	$dias = ($datatemp2 - $datatemp1)/86400;
	$dias = ceil($dias)+1;
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
  
    	
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
	<fieldset>
	<legend class="negrito">Pedido de Folga</legend>
<form name="form1" method="post" action="../classes/controleFolgaCalendario.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%"  border="0" cellspacing="1" cellpadding="1">
	  <tr>
        <td align="right">&nbsp;</td>
        <td><input name="idtemp" type="text" id="idtemp" value="<?php echo $idtemp; ?>" size="8" readonly="readonly" /></td>
        <td width="15%" align="right">&nbsp;</td>
        <td width="0%">&nbsp;</td>
      </tr>
	  <tr>
        <td align="right" class="letra">Folga:</td>
        <td><input name="idfolga" type="text" id="idfolga" value="<?php echo $idfolga; ?>" size="8" readonly="readonly" />
          <input name="descricao" type="text" id="descricao" value="<?php echo $descricao; ?>" size="80" readonly="readonly" /></td>
        <td width="15%" align="right">&nbsp;</td>
        <td width="0%">&nbsp;</td>
      </tr>
	  <tr>
	    <td align="right" class="letra">Solicitante:</td>
	    <td><input name="gmsolicitante" type="text" id="gmsolicitante" value="<?php echo $gmsolicitante; ?>" size="20" readonly="readonly" /></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td align="right" class="letra">Turno:</td>
	    <td><input name="yturno" type="text" id="yturno" value="<?php echo $turno; ?>" size="20" readonly="readonly" /></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td align="right" class="letra">Periodo:</td>
	    <td><input name="xdatainicio" type="text" id="xdatainicio" value="<?php echo $datainicio; ?>" size="10" readonly="readonly" />
	      <input name="xdatafim" type="text" id="xdatafim" value="<?php echo $datafim; ?>" size="10" readonly="readonly" /></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td align="right" valign="top" class="letra">Motivo:</td>
	    <td><textarea name="motivo" cols="50" rows="4" readonly="readonly" ><? echo $descricao?></textarea></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
        <td width="14%" align="right" class="letra">Status:</td>
        <td width="71%"><input name="status" type="text" value="<?php echo $status; ?>" size="3" readonly="readonly"/>
		<? if($status == 1){?>
			Autorizado
		<? }?>	
		
		</td>
		<td width="15%">&nbsp;</td>
	  </tr>
	  <tr>
	    <td align="right" class="letra">Dias Solicitados: </td>
	    <td><input name="diassolicitados" type="text" id="diassolicitados" value="<?php echo $dias; ?>" size="3" readonly="readonly" /></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
        <td align="right">&nbsp;</td>
        <td><?
		echo $dataincio;
		$quebrarDatas = explode("-", $datainicio);
		list($ano, $mes, $dia) = $quebrarDatas; 
			for($i=0;$i<=$dias-1;$i++){
				$dataNova = date('Y/m/d', mktime(0,0,0, $mes, $dia + $i, $ano));
				?>
					<input name="conf[]" type="checkbox" value="<? echo $dataNova;?>">
					<input name="data" type="text" value="<?php echo $dataNova; ?>" readonly="readonly" size="8"/><br>
				<?
			}
		
		?></td>
        <td>&nbsp;</td>
      </tr>
	  <INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">
	  <tr>	
    	<td width="14%">&nbsp;		</td>
        <td width="71%"><input name="Confirmar" type="submit" class="botao" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
		<td>&nbsp;</td>
    </tr>
</table>
</form>
</fieldset>
<fieldset>
	<legend class="negrito">Pedido de Folga</legend>

    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<tr>
		<td width="10%" align="center" class="branco"><B>GM Solicitante</B></td>
		<td width="20%" align="center" class="branco"><B>No Periodo de...</B></td>
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
	<!--fim adm-->
	</td>
  </tr>
</table>


</body>
</html>

