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
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
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
	<legend class="negrito">Cadastro Pedido de Folga</legend>
<form name="form1" method="post" action="../classes/controlePedidoFolga.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%"  border="0" cellspacing="1" cellpadding="1">
	  <tr>
        <td align="right">Controle Interno: </td>
        <td><input name="idfolga" type="text" id="idfolga" value="<?php echo $idfolga; ?>" size="8" readonly="readonly" />          </td>
        <td width="15%" align="right">&nbsp;</td>
        <td width="0%">&nbsp;</td>
      </tr>
	  <tr>
	    <td align="right">Descri&ccedil;&atilde;o da Folga:</td>
	    <td><input name="descricao" type="text" id="descricao" value="<?php echo $descricao; ?>" size="80" readonly="readonly" /></td>
	    <td>&nbsp;</td>
    </tr>
	  <tr>
        <td width="14%" align="right">Matricula:</td>
        <td width="71%"><input name="matricula" type="text" value="<?php echo $matricula; ?>" size="8" readonly="readonly"/>
        <input name="gmsolicitante" type="text" id="gmsolicitante" value="<?php echo $loginTemp; ?>" readonly="readonly" /></td>
        <td width="15%">&nbsp;</td>
	  </tr>
	  <tr>
	    <td align="right">Dias haver: </td>
	    <td><input name="qtadeatual" type="text" value="<?php echo $resultatual; ?>" size="2" readonly="readonly"/></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
        <td width="14%" align="right">Atividade ou Turno:<font class="bignum">*</font>:</td>
        <td width="71%"><select name="yturno" id="yturno">
         <option value="0">Selecionar...</option>
                  <option value="0">Selecionar...</option>
                  <option value="Administrativo">Administrativo</option>
				  <option value="Central">Central</option>
				  <option value="Comando">Comando</option>
				  <option value="Digitacao">Digitacao</option>
				  <option value="Educacao">Educacao</option>
				  <option value="Logistica">Logistica</option>
				  <option value="Matutino">Operacional Matutino</option>
                  <option value="Vespertino">Operacional Vespertino</option>
                  <option value="15x33">Operacional 15x33</option>
                  <option value="Ronda Escolar">Ronda Escolar</option>
				  <option value="Sentinela">Sentinela</option>
				  <option value="Zona Azul">Zona Azul</option>
				  <option value="Obras">Obras</option>
                  <option value="Canil">Canil</option>
        </select>	</td>
		<td width="15%">&nbsp;</td>
	  </tr>
	  <tr>
	    <td width="14%" height="24" align="right" class="letra">Data da folga <font class="bignum">*</font>:</td>
  	    <td width="71%" align="left">
			<input name="xdatainicio" type="text" class="stylo1" id="xdatainicio" value="<? echo $datainicio;?>" size="12" readonly/>  			
			<a onClick="displayCalendar(document.forms[0].xdatainicio,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>   
			a 
			<input name="xdatafim" type="text" class="stylo1" id="xdatafim" value="<? echo $datafim;?>" size="12" readonly/>  			
			<a onClick="displayCalendar(document.forms[0].xdatafim,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a> 
   		</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
        <td width="14%" align="right" valign="top">Motivo(s): </td>
        <td width="71%"><textarea name="motivo" cols="80" rows="8"></textarea></td>
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
        <td width="71%"><input name="Submit" type="submit" class="botao" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
		<td>&nbsp;</td>
    </tr>
</table>
</form>
</fieldset>

	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>

