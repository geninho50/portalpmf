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
	
	//Pega a data atual
  /*  $data_atual = date("Y-m-d");
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
   }  */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	<legend class="cabecalho">CADASTRO DE CHAMADA JUSTIFICADA</legend>
    <form name="form" action="../classes/controleChamadaJustificada.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
    <table width="100%"  border="0" cellpadding="1" cellspacing="1">
	<tr>
      <td width="12%" align="right" class="letra">Chefe:</td>
      <td width="88%">
		  <select name="ychefe" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
			  <option value="0">Selecione...</option>
              <option value="JOSUE">CHEFE DE SETOR JOSUE</option>
              <option value="FERNADES">CHEFE DE OPERCACOES FERNANDES</option>
              <option value="JOEL">CHEFE DE OPERCACOES JOEL</option>
              <option value="FRANCO">CHEFE DE OPERCACOES FRANCO</option>
              <option value="PEREIRA">CHEFE DE OPERCACOES PEREIRA</option>
              <option value="LARISSA">CHEFE DE OPERCACOES LARISSA</option>
              <option value="RAFAEL">CHEFE DE OPERCACOES RAFAEL</option>
			</select> 
		</td>
    </tr>
	<tr>
      <td align="right" class="letra">Turno:</td>
      <td>
	  	<select name="yturno" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
		  <option value="0">Selecione...</option>
		  <option value="1">MATUTINO</option>
		  <option value="2">VESPERTINO</option>
		</select>
</td>
    </tr>
    <tr>
		<td height="24" align="right" class="letra">Data:</td>
		<td align="left" class="letra">

        <input type="text" value="<? echo $dataini;?>" readonly name="xdataini" size="12" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
			<a onClick="displayCalendar(document.forms[0].xdataini,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
        
		</td>
	</tr>
	<tr>
		<td height="24" align="right" class="letra">Hora:</td>
		<td width="1685"><input name="xhora" id="xhora" class="negrito" type="text" size="12" value="<? echo $hora;?>" maxlength="8"  onkeypress="valida_horas(this)" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
	</tr>
    <tr>
      <td align="right" valign="top" class="letra">Guarda:</td>
      <td>
		<input type="text" name="xGM1_1" id="xGM1_1" class="negrito" size="20" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/><br>
		</td>
    </tr>
    
    <tr>
      <td align="right" valign="top" class="letra">Justificativa:</td>
      <td><span class="letra">
        <textarea name="xjustificativa" cols="80" rows="4" class="negrito" id="xjustificativa" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"><? echo $justificativa; ?></textarea>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="Confirmar" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
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
