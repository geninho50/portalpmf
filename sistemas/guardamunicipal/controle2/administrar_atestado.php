<?php
	include("incValidaSessão.php");
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	$objS = new trataString;

		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
<script type="text/javascript" src="adm/scripts/trata_erros.js" language="javascript"></script>
</head>

<body>

<fieldset>
	<legend><FONT COLOR="#FF0033" size="3">Controle de Atestado</FONT></legend>
<form name="form1" method="post" action="../classes/controleAtestado.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    
	<td width="5%" align="right"><span class="letra">GM:<span class="style1">*</span></span></td>
    <td width="12%" align="left"><select name="ygmsolicitante">
      <option value="0">Selecionar...</option>
      <?php 
				$queryS = "SELECT * FROM usuario order by login";
				$resultadoS = $obj->executaQuery($queryS);
				while($linhaS = mysql_fetch_array($resultadoS))
				{
					$login = $linhaS['login'];
			  ?>
      <option value="<?php echo $login; ?>"><?php echo $login; ?></option>
      <?php 
				} 
	  		  ?>
    </select></td><td width="5%" align="right" class="letra">Data:<span class="style1">*</span></td>
    <td width="13%" align="left"><input type="text" value="<? echo $dataini;?>" readonly name="dataini" class="stylo1" size="12"/>
      <a onclick="displayCalendar(document.forms[0].dataini,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data' /></a> 
	</td>
    
    <td width="7%" align="right"><span class="letra">Turno:<span class="style1">*</span></span></td>
    <td width="12%" align="left"><select name="yturno">
     <option value="0">Selecionar...</option>
	  <option value="Matutino">Matutino</option>
      <option value="Vespertino">Vespertino</option>
      <option value="Noturno">Noturno</option>
    </select></td>
    <td width="22%" align="left"><input name="Submit" type="submit" class="letra" id="Submit4" value="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" /></td>
    </tr>

</table>

</form>
</fieldset>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30">&nbsp;</td>
    <td width="1084">
		<!-- ini agenda -->
			<?php include("caladmatestado.php"); ?>
			<!-- fim agenda  -->
	</td>
    <td width="30">&nbsp;</td>
  </tr>
</table>
</body>
</html>

