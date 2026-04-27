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
   
   $idAtendimento = 0;
   $idAtendimento = (int)$_POST['idAtendimento'];
   if( $idAtendimento == 0 )
   {
	 $idAtendimento = (int)$_GET['idAtendimento'];
   }
   
    $sqlA = "SELECT * FROM atendimento_escola where id=$idAtendimento";
	$resultadoA = $obj->executaQuery($sqlA);
	if( $linhaA = mysql_fetch_array($resultadoA))
	{
		$id = $linhaA["id"];
		$idescola = $linhaA["idescola"];
		$idguarnicao = $linhaA["idguarnicao"];
		$data_empenho = $linhaA["data_empenho"];
		$hora_empenho = $linhaA["hora_empenho"];
		$hora_chegada = $linhaA["hora_chegada"];
		
		$sqlG = "SELECT * FROM guarnicao where id=$idguarnicao";
		$resultadoG = $obj->executaQuery($sqlG);
		if( $linhaG = mysql_fetch_array($resultadoG))
		{
			$vtr = $linhaG["vtr"];
		}
   }
	$sqlE = "SELECT * FROM escolas where id=$idescola";
    $resultadoE = $obj->executaQuery($sqlE);
	if( $linhaE = mysql_fetch_array($resultadoE))
	{
		$idescola = $linhaE["id"];
		$nome = $linhaE["nome"];
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
	
	<fieldset>
	<legend class="cabecalho">DETALHES DO ATENDIMENTO</legend>
  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td align="right"  class="letra">VTR:</td>
          <td class="negrito"><? echo $vtr;?></td>
        </tr>
        <tr>
          <td width="13%" align="right"  class="letra">Escola:</td>
          <td class="negrito"><? echo $nome; ?></td>
		  </tr>
        <tr>
          <td width="13%" align="right"  class="letra">Data Empenho:</td>
          <td width="87%" class="negrito"><? echo $data_empenho; ?></td>
          </tr>
		<tr>
          <td width="13%" align="right"  class="letra">Hora Empenho:</td>
          <td width="87%" class="negrito"><? echo $hora_empenho; ?></td>
          </tr>
      </table></td>
    </tr>
  </table>
</fieldset>

<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">FINALIZAR ATENDIMENTO</legend>
    <form name="form" action="../classes/controleEscolaGuarnicao.php" method="post" onSubmit="return validaFormAll(this,'Continuar','Continuar')">

  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    
	<tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
		<tr>
			<td align="right" valign="top" class="letra" >Atendimento:</td>
			<td><input name="id" value="<? echo $id;?>" readonly="readonly" type="text" class="negrito" /></td>
		</tr>		
		<tr>
          <td align="right" valign="top" class="letra" >VTR:</td>
          <td><input name="yidguarnicao" type="text" value="<? echo $idguarnicao;?>" size="3" readonly="readonly" class="negrito" />
          	  <input name="yvtr" value="<? echo $vtr;?>" readonly="readonly" type="text" class="negrito" /></td>
        </tr>
		<tr>
          <td align="right" valign="top" class="letra" >Status:</td>
          <td><input name="chave" type="text" id="chave" value="2" size="2" readonly="readonly" class="negrito"/></td>
        </tr>
        <tr>
          <td width="160" align="right" valign="top" class="letra" >Encerramento:</td>
          <td width="1082"><textarea name="descricao" cols="80" rows="15" class="negrito"><? echo $encerramento_ocorrrencia;?></textarea></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="13%" align="right">&nbsp;</td>
          <td width="31%"><input name="Submit" type="submit" class="letra" id="Submit" onclick="onClickButton(null,'Aguarde...','','Continuar')" value="Confirmar" /></td>
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
