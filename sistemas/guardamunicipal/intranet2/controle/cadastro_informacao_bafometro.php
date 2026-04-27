<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a pÃ¡gina seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	require ("../classes/trataString.php");
	$objS = new trataString;
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
    $idOcorrencia = 0;
	$idOcorrencia = (int)$_POST['idOcorrencia'];
	$acimalimite = (int)$_POST['xacimalimite'];
	if( $idOcorrencia == 0 )
	{
		$idOcorrencia = (int)$_GET['idOcorrencia'];
		$acimalimite = (int)$_GET['xacimalimite'];
	}
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHeadCentral.php");?>
<!-- fim inc head -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
     <th bgcolor="#666666" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabealho">DADOS DE ABORDAGEM DO BAFOMETRO</legend>
    <form name="form" action="../classes/controleBafometro.php" method="post" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td align="right"  class="letra">Guarda:</td>
          <td><input name="guarda" type="text" maxlength="10" class="negrito" id="guarda" readonly="readonly" value="<? echo $login;?>"/></td>
        </tr>
        <tr>
          <td width="19%" align="right"  class="letra">OcorrÃªncia:</td>
          <td width="81%"><input name="idOcorrencia" type="text" class="negrito" maxlength="10" id="idOcorrencia" readonly="readonly" value="<? echo $idOcorrencia;?>"/></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="19%" align="right" class="letra" >Teste Realizados :</td>
          <td width="81%"><input name="xabordados" class="negrito" type="text" id="xabordados" value="<? echo $abordados;?>" size="4" maxlength="10" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
        </tr>
        <tr>
          <td align="right" class="letra" >Acima do Limite: </td>
          <td><input name="xacimalimite" class="negrito" type="text" id="xacimalimite" value="<? echo $acimalimite;?>" size="4" maxlength="10" readonly="readonly" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>
	  
	  <?
	  for($i=0; $i<$acimalimite; $i++){
	  ?>
	  	<table width="100%"  border="0" cellspacing="1" cellpadding="1">
		  <tr>
			<td width="19%" align="right">Nome:</td>
			<td width="38%" align="left"><input name="xnome<? echo $i;?>" class="negrito type="text" id="xnome<? echo $i;?>" value="<? echo $nome; ?>" size="50" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
			<td width="4%" align="right">CNH:</td>
			<td width="39%" align="left"><input name="xcnh<? echo $i;?>" type="text" id="xcnh<? echo $i;?>" value="<? echo $cnh; ?>" size="10" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
		  </tr>
		  <tr>
			<td align="right">DNRC:</td>
			<td align="left"><input type="text" name="xdnrc<? echo $i;?>" class="negrito id="xdnrc<? echo $i;?>" value="<? echo $dnrc; ?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
			<td align="right">Indice:</td>
			<td align="left"><input name="xindice<? echo $i;?>" type="text" id="xindice<? echo $i;?>" class="negrito value="<? echo $indice; ?>" size="10" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" />
			Ex.: 0.3 (usar ponto) </td>
		  </tr>
		  </table>
			<hr>

	  <?	
	  }
	  ?>
	  
	  
	  
	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="19%" align="right">&nbsp;</td>
          <td width="81%"><input name="Confirmar" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
          </tr>
      </table></td>
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
