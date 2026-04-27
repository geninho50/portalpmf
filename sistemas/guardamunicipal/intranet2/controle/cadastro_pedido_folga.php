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
	$idfolga = $_GET['idfolga'];
	$logintemp = $_GET['login'];
	if( $idfolga == 0 )
	{
		$idfolga = $_POST['idfolga'];
		$logintemp = $_POST['login'];
	}
	
	$sqlF = "SELECT * FROM folga where id=$idfolga";
	$resultF = $obj->executaQuery($sqlF);
	$linhaF = mysql_fetch_array($resultF);
	if( $linhaF )
	{
		$idfolga = $linhaF["id"];
		$descricao = $linhaF["descricao"];
		$qtade = $linhaF['qtade'];
		$qtadeatual = $linhaF['qtadeatual'];
			
		$resultatual = $qtade - $qtadeatual;
	}

	$sql = "SELECT * FROM guarda_gmf where login='$logintemp'";
	$result = $obj->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$loginTemp = $linhaS["login"];
		$matricula = $linhaS["matricula"];
	}
	//Pega a data atual
   $data_atual = date("Y-m-d");
   
    	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CADASTRO PEDIDO DE FOLGA</legend>
<form name="form1" method="post" action="../classes/controlePedidoFolgaGuarda.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%"  border="0" cellspacing="1" cellpadding="1">
	  <tr>
        <td align="right" class="letra">Controle Interno: </td>
        <td><input name="idfolga" type="text" id="idfolga" class="negrito" value="<?php echo $idfolga; ?>" size="8" readonly="readonly" />          </td>
        <td width="15%" align="right">&nbsp;</td>
        <td width="0%">&nbsp;</td>
      </tr>
	  <tr>
	    <td align="right" class="letra">Descri&ccedil;&atilde;o da Folga:</td>
	    <td><input name="descricao" type="text" id="descricao" class="negrito" value="<?php echo $descricao; ?>" size="80" readonly="readonly" /></td>
	    <td>&nbsp;</td>
    </tr>
	  <tr>
        <td width="14%" align="right" class="letra">Matricula:</td>
        <td width="71%"><input name="matricula" type="text" class="negrito" value="<?php echo $matricula; ?>" size="8" readonly="readonly"/>
        <input name="gmsolicitante" class="negrito" type="text" id="gmsolicitante" value="<?php echo $loginTemp; ?>" readonly="readonly" /></td>
        <td width="15%">&nbsp;</td>
	  </tr>
	  <tr>
	    <td align="right" class="letra">Dias haver: </td>
	    <td><input name="qtadeatual" type="text" class="negrito" value="<?php echo $resultatual; ?>" size="2" readonly="readonly"/></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
        <td width="14%" align="right" class="letra">Grupo:</td>
        <td width="71%"><select name="ygrupo" id="ygrupo" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
            <option value="0">Selecionar...</option>
            <option value="Diretoria">DIRETORIA</option>
            <option value="Central">CENTRAL</option>
            <option value="Administrativo">ADMINISTRATIVO</option>
            <option value="Educacao">EDUCAÇÃO</option>
            <option value="Logisitca">LOGÍSTICA</option>
            <option value="Sentinela">SENTINELA</option>
            <option value="Digitacao">DIGITAÇÃO</option>
            <option value="Matutino">OPERACIONAL MATUTINO</option>
            <option value="Vespertino">OPERACIONAL VESPERTINO</option>
            <option value="Alfa">ALFA</option>
            <option value="Bravo">BRAVO</option>
            <option value="Zona Azul">ZONA AZUL</option>
            <option value="Obras">OBRAS</option>
            <option value="Ronda Escolar">RONDA ESCOLAR</option>
            <option value="Canil">CANÍL</option>
        </select>	</td>
		<td width="15%">&nbsp;</td>
	  </tr>
	  <tr>
	    <td width="14%" height="24" align="right" class="letra">Data da folga:</td>
  	    <td width="71%" align="left">
			<input name="xdatainicio" type="text" class="negrito" id="xdatainicio" value="<? echo $datainicio;?>" size="12" readonly onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>  			
			<a onClick="displayCalendar(document.forms[0].xdatainicio,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a> 
   		</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
        <td width="14%" align="right" valign="top" class="letra">Motivo(s): </td>
        <td width="71%"><textarea name="motivo" cols="80" rows="8" class="negrito" onKeyUp="converteUpper(this);"></textarea></td>
      	<td>&nbsp;</td>      
	  </tr>
	  <INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">
	  <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	  <tr>	
    	<td width="14%">&nbsp;		</td>
        <td width="71%"><input name="Submit" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
		<td>&nbsp;</td>
    </tr>
</table>
</form>
</fieldset>

	<!--fim adm-->
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

