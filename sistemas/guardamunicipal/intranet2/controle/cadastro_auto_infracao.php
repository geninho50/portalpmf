<?php
	ini_set('default_charset','UTF-8');
	
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
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
	$sqlA = "SELECT * FROM ocorrencia where id=$idOcorrencia";
    $resultadoA = $obj->executaQuery($sqlA);
	if( $linhaA = mysql_fetch_array($resultadoA))
	{
		$id = $linhaA["id"];
		$telefone = $linhaA["telefone"];
		$comunicante = $linhaA["comunicante"];
		$rua = $linhaA["rua"];
		$numero = $linhaA["numero"];
		$bairro = $linhaA["bairro"];
		$descricao_ocorrrencia = $linhaA["descricao_ocorrencia"];
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
	<legend class="negrito">Cadastrar Guinchamento</legend>
    <form name="form" action="../classes/controleAutoInfracao.php" method="post" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="14%" align="right"  class="letra">Ocorrencia de N&ordm;:</td>
          <td width="21%"><font color="#000000" size="+2"><input name="idOcorrencia" type="text" id="idOcorrencia" value="<? echo $idOcorrencia;?>" size="5" maxlength="10" readonly="readonly"/>
          </font></td>
          <td align="right" class="letra">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right" class="letra">Atendente:</td>
          <td><input name="guarda" type="text" maxlength="10" id="guarda" readonly="readonly" value="<? echo $login;?>"/></td>
          <td align="right"  class="letra">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right" class="letra">&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right" class="letra">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right" class="letra">Placa:</td>
          <td><input name="xplaca" type="text" maxlength="8" id="xplaca" value="<? echo $placa;?>" OnKeyPress="formatar(this, '###-####')" onkeyup="converteUpper(this);"/></td>
          <td width="12%" align="right"  class="letra">Marca/Modelo:</td>
          <td width="53%"><input name="xmarcamodelo" type="text" size="40" id="xmarcamodelo" value="<? echo $marcamodelo; ?>" onkeyup="converteUpper(this);"/></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="14%" align="right" class="letra" >Infra&ccedil;&atilde;o:</td>
          <td width="86%"><input name="ait" id="ait" type="text" size="100" /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="14%" align="right" class="letra" >Data:</td>
          <td width="13%"><input name="data_cadastro" type="text" size="11" value="<? echo $data_atual;?>" readonly="readonly" /></td>
          <td width="5%" align="right" class="letra" >Hora:</td>
          <td width="68%"><input name="hora_cadastro" type="text" size="11" value="<? echo $hora_atual;?>" /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="7%" align="right">&nbsp;</td>
          <td width="37%"><input name="Confirmar" type="submit" class="botao" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
          <td width="7%">&nbsp;</td>
          <td width="49%">&nbsp;</td>
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
