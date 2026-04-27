<?php
	ini_set('default_charset','UTF-8');
	
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
	
	$idfolga = 0;
	$idtemp = 0;
	$gmsolicitante = "";
	$status = "";
	$gmsolicitante = "";
	
	$idfolga = (int)$_GET['idfolga'];
	$idtemp = (int)$_GET['idtemp'];
	$status = (int)$_GET['status'];
	$gmsolicitante = mysql_escape_string($_GET['gmsolicitante']);
	
	if( $idfolga == 0 )
	{
		$idfolga = (int)$_POST['idfolga'];
		//$id = $_POST['id'];
		$gmsolicitante = mysql_escape_string($_POST['gmsolicitante']);
		$status = (int)$_GET['status'];
	}
	
	$queryG = "SELECT datainicio,datafim,grupo FROM pedidofolga where id=$idtemp order by id desc";
	$resultG = $obj->executaQuery($queryG);
    $linhaG = mysql_fetch_array($resultG); 
	if($linhaG)
	{
		$datafim = $linhaG['datafim'];
		$datainicio = $linhaG['datainicio'];
		$grupo = $linhaG['grupo'];		
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
  
  	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
    	
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
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">PEDIDO DE FOLGA</legend>
<form name="form1" method="post" action="../classes/controlePedidoFolga.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%"  border="0" cellspacing="1" cellpadding="1">
	  <tr>
        <td align="right">&nbsp;</td>
        <td><input name="idtemp" type="text" id="idtemp" value="<?php echo $idtemp; ?>" size="8" readonly="readonly" class="negrito"/></td>
        <td width="15%" align="right">&nbsp;</td>
        <td width="0%">&nbsp;</td>
      </tr>
	  <tr>
	    <td align="right" class="letra">Chefe:</td>
	    <td><input name="gmautorizou" type="text" id="gmautorizou" value="<?php echo $login; ?>" size="20" readonly="readonly" class="negrito"/></td>
	    <td align="right">&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
        <td align="right" class="letra">Folga:</td>
        <td><input name="idfolga" type="text" id="idfolga" value="<?php echo $idfolga; ?>" size="8" readonly="readonly" class="negrito"/>
          <input name="descricao" type="text" id="descricao" value="<?php echo $descricao; ?>" size="80" readonly="readonly" class="negrito"/></td>
        <td width="15%" align="right">&nbsp;</td>
        <td width="0%">&nbsp;</td>
      </tr>
	  <tr>
	    <td align="right" class="letra">Solicitante:</td>
	    <td><input name="gmsolicitante" type="text" id="gmsolicitante" value="<?php echo $gmsolicitante; ?>" size="20" readonly="readonly" class="negrito"/></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td align="right" class="letra">Grupo:</td>
	    <td><input name="ygrupo" type="text" id="ygrupo" value="<?php echo $grupo; ?>" size="20" readonly="readonly" class="negrito"/></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td align="right" class="letra">Data:</td>
	    <td><input name="xdatainicio" type="text" id="xdatainicio" value="<?php echo $datainicio; ?>" size="10" readonly="readonly" class="negrito"/></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td align="right" valign="top" class="letra">Motivo:</td>
	    <td><textarea name="motivo" cols="96" rows="4" readonly="readonly" class="negrito"><? echo $descricao?></textarea></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td width="14%" align="right" class="letra">Status:</td>
	    <td width="71%"><input name="status" type="text" value="<?php echo $status; ?>" size="3" readonly="readonly" class="negrito"/>
	      <? if($status == 1){?>
	      Autorizado
	      <? }?>	
	      
	      </td>
	    <td width="15%">&nbsp;</td>
	    </tr>
	  <tr>
	    <td align="right">&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">
	  <tr>	
    	<td width="14%">&nbsp;		</td>
        <td width="71%"><input name="Confirmar" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
		<td>&nbsp;</td>
    </tr>
</table>
</form>
</fieldset>
<fieldset>
	<legend class="cabecalho">PEDIDO DE FOLGA</legend>

    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<tr>
		<td width="10%" align="center" class="branco"><B>GM Solicitante</B></td>
		<td width="20%" align="center" class="branco"><B>Na data</B></td>
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
		
			$ano =  substr("$dataincio", 0, 4);
			$mes =  substr("$dataincio", 5, -3);
			$dia =  substr("$dataincio", 8, 9);
		
			$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );
		
			switch($diasemana) {
				case"0": $diasemana = "Domingo";       break;
				case"1": $diasemana = "Segunda-Feira"; break;
				case"2": $diasemana = "Terça-Feira";   break;
				case"3": $diasemana = "Quarta-Feira";  break;
				case"4": $diasemana = "Quinta-Feira";  break;
				case"5": $diasemana = "Sexta-Feira";   break;
				case"6": $diasemana = "Sábado";        break;
			}
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
		<td width="20%" align="center" class="negrito"><?PHP echo $diainicio.' / '.$mesinicio.' / '.$anoinicio.' - '.$diasemana; ?></td>
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

