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
   
   $idEvento = 0;
   $idEvento = (int)$_POST['idEvento'];
   if( $idEvento == 0 )
   {
	 $idEvento = (int)$_GET['idEvento'];
   }
   
	$sqlE = "SELECT * FROM evento where id=$idEvento";
    $resultadoE = $obj->executaQuery($sqlE);
	if( $linhaE = mysql_fetch_array($resultadoE))
	{
		$idevento = $linhaE["id"];
		$nome = $linhaE["nome"];
   }
   
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
	<legend class="cabecalho">FINALIZAR ATENDIMENTO</legend>
    <form name="form" action="../classes/controleEventoStatus.php" method="post" onSubmit="return validaFormAll(this,'Continuar','Continuar')">

  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    
	<tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
		<tr>
			<td align="right" valign="top" class="letra" >Evento:</td>
			<td><input name="idevento" type="text" value="<? echo $idevento?>" size="5" readonly="readonly" /><? echo $nome; ?></td>
		</tr>		
        <tr>
          <td width="160" align="right" valign="top" class="letra" >Encerramento:</td>
          <td width="1082"><textarea name="descricao" cols="80" rows="15"><? echo $encerramento_ocorrrencia;?></textarea></td>
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
          <td width="31%"><input name="Submit" type="submit" class="botao" id="Submit" onclick="onClickButton(null,'Aguarde...','','Continuar')" value="Confirmar" /></td>
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
