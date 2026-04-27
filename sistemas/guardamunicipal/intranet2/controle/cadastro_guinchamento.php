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
		$infracao = $linhaA["infracao"];
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
	<legend class="cabecalho">CADASTRO GUINCHAMENTO</legend>
    <form name="form" action="../classes/controleGuinchamento.php" method="post" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="14%" align="right"  class="letra">Ocorrencia de N&ordm;:</td>
          <td width="21%"><font color="#000000" size="+2">
          	<input name="idOcorrencia" type="text" id="idOcorrencia" class="negrito" value="<? echo $idOcorrencia;?>" size="5" maxlength="10" readonly="readonly"/>
          </font></td>
          <td align="right" class="letra">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right" class="letra">Atendente:</td>
          <td><input name="guarda" type="text" maxlength="10" id="guarda" class="negrito" readonly="readonly" value="<? echo $login;?>"/></td>
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
          <td><input name="xplaca" type="text" maxlength="8" id="xplaca" class="negrito" value="<? echo $placa;?>" OnKeyPress="formatar(this, '###-####')" onkeyup="converteUpper(this);"  onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
          <td width="12%" align="right"  class="letra">Marca/Modelo:</td>
          <td width="53%"><input name="xmarcamodelo" type="text" size="40" id="xmarcamodelo" class="negrito" value="<? echo $marcamodelo; ?>" onkeyup="converteUpper(this);"  onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="14%" align="right"  class="letra">Rua:</td>
          <td>
		  <input name="rua" type="text" id="rua" size="40" value="<? echo $rua; ?>" class="negrito"/>
		  <td width="9%" align="right"  class="letra">N&uacute;mero:</td>
          <td width="47%"><input name="numero" type="text" id="numero" value="<? echo $numero; ?>" size="8" maxlength="4" class="negrito"/></td>
        </tr>
        <tr>
          <td width="14%" align="right"  class="letra">Bairro:</td>
          <td width="30%"><input name="bairro" type="text" id="bairro" class="negrito" value="<? echo $bairro; ?>" size="30" onkeyup="converteUpper(this);"/></td>
          <td align="right"  class="letra">Refer&ecirc;ncia:</td>
          <td><input name="referencia" type="text" id="referencia" class="negrito" value="<? echo $referencia; ?>" size="30" onkeyup="converteUpper(this);"/></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="14%" align="right" valign="top" class="letra" >OBS:</td>
          <td width="86%"><textarea name="obs" cols="100" rows="10" id="obs" class="negrito"><? echo $obs;?></textarea></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>
	  <table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="14%" align="right" class="letra" >Guarni&ccedil;&atilde;o:</td>
          <td width="86%">
		  <?
		$sqlG = "SELECT guarnicao.id,ocorrencia_guarnicao.idguarnicao,guarnicao.vtr,guarnicao.guarda1,guarnicao.guarda2,guarnicao.guarda3,guarnicao.guarda4,guarnicao.guarda5 FROM ocorrencia_guarnicao inner join guarnicao where ocorrencia_guarnicao.idocorrencia=$idOcorrencia and guarnicao.id=ocorrencia_guarnicao.idguarnicao";
		$resultadoG = $obj->executaQuery($sqlG);
		while( $linhaG = mysql_fetch_array($resultadoG))
		{
			$idguarnicao = $linhaG["id"];
			$vtr = $linhaG["vtr"];
			$guarda1 = $linhaG["guarda1"];
			$guarda2 = $linhaG["guarda2"];
			$guarda3 = $linhaG["guarda3"];
			$guarda4 = $linhaG["guarda4"];
			$guarda5 = $linhaG["guarda5"];
			?>
			 <input name="idguarnicao" type="text" value="<? echo $idguarnicao;?>" class="negrito" size="3" readonly="readonly" />
			 <?
			 	if($guarda1 != '' ){echo $vtr.': '.$guarda1;}
				if($guarda2 != '' ){echo ' / '.$guarda2;}
				if($guarda3 != '' ){echo ' / '.$guarda3;}
				if($guarda4 != '' ){echo ' / '.$guarda4;}
				if($guarda5 != '' ){echo ' / '.$guarda5;}
			 ?>
		<?
		}
		  ?>		</td>
          </tr>
      </table>
	  
	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="14%" align="right" class="letra" >Infra&ccedil;&atilde;o:</td>
          <td width="86%"><input name="xait" id="xait" type="text" size="100" class="negrito" value="<? echo $infracao; ?>" /></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="14%" align="right" class="letra" >DRV:</td>
          <td width="86%"><input name="xdrv" type="text" maxlength="10" id="xdrv" class="negrito" value="<? echo $drv;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
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
          <td width="37%"><input name="Confirmar" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="14%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="86%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>
</body>
</html>
