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
	require ("../classes/trataString.php");
	$objS = new trataString;
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
    $idOcorrencia = 0;
	$idOcorrencia = (int)$_POST['idOcorrencia'];
	if( $idOcorrencia == 0 )
	{
		$idOcorrencia = (int)$_GET['idOcorrencia'];
	}
  	
	$sqlA = "SELECT * FROM dados_ocorrencia where idOcorrencia=$idOcorrencia";
    $resultadoA = $obj->executaQuery($sqlA);
	$linhaA = mysql_fetch_array($resultadoA);
	if( $linhaA )
	{
		$descricao_ocorrrencia = $linhaA["descricao_ocorrencia"];
    }
	else{
		$descricao_ocorrrencia='Adicinar Informacoes.';
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
	<legend class="cabecalho">ADICIONAR INFORMAÇÕES NA OCORRÊNCIA</legend>
    <form name="form" action="../classes/controleAdicionarDadosOcorrencia.php" method="post" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td align="right"  class="letra">Guarda:</td>
          <td><input name="guarda" type="text" maxlength="10" id="guarda" readonly="readonly" value="<? echo $login;?>"/></td>
        </tr>
        <tr>
          <td width="15%" align="right"  class="letra">Ocorrência:</td>
          <td width="85%"><input name="idOcorrencia" type="text" maxlength="10" id="idOcorrencia" readonly="readonly" value="<? echo $idOcorrencia;?>"/></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="15%" align="right" valign="top" class="letra" >Descri&ccedil;&atilde;o da Ocorr&ecirc;ncia:</td>
          <td width="85%"><textarea name="descricao" cols="100" rows="10"><? echo $descricao_ocorrrencia;?></textarea></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="15%" align="right">&nbsp;</td>
          <td width="85%"><input name="Confirmar" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
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

</body>
</html>
