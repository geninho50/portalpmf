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
	
	$id = 0;
	$id = (int)$_POST['id'];
	if( $id == 0 )
	{
		$id = (int)$_GET['id'];
		$status = $_GET['status'];
	}
	
	if($status == 2){
		$tempstatus='Negado';
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
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
	<legend class="cabecalho">PEDIDO DOAÇÃO DE SANGUE</legend>
<form name="form1" method="post" action="../classes/controleDoacaoSangue.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="14%" align="right" class="letra">N&ordm;:</td>
              <td width="86%"><input name="id" type="text" id="id" value="<?php echo $id; ?>" size="5" readonly="readonly" /></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="14%" align="right" valign="top" class="letra">Status:</td>
              <td width="86%" align="left">			
              <input name="status" type="text" id="status" value="<?php echo $status; ?>" size="3" readonly="readonly" />
              <?php echo '<font class="letra">'.$tempstatus.'</font>'; ?></td>

          </table></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="14%" align="right" valign="top" class="letra">Motivo(s) da Nega&ccedil;&atilde;o: </td>
              <td width="86%"><textarea name="xmotivostatus" cols="80" rows="8"></textarea>
			  </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    <tr>	
    	<td width="14%">&nbsp;		</td>
        <td width="86%"><input name="Submit" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
    </tr>
</table>
</form>
</fieldset>

</td>
</tr>
</table>

<!--fim adm-->
	</td>
  </tr>
</table>


</body>
</html>

