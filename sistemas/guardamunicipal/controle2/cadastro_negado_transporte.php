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
	
	$idTransporte = 0;
	$idTransporte = (int)$_POST['idTransporte'];
	if( $idTransporte == 0 )
	{
		$idTransporte = (int)$_GET['idTransporte'];
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
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
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
	<legend class="negrito">Negar pedido de transporte</legend>
<form name="form1" method="post" action="../classes/controleTransporte.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%"  border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="14%" align="right" class="letra">N&ordm;:</td>
              <td width="86%"><input name="idTransporte" type="text" id="idTransporte" value="<?php echo $idTransporte; ?>" size="3" readonly="readonly" /></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="14%" align="right" valign="top" class="letra">Status:</td>
              <td width="86%" align="left">			
              <input name="status" type="text" id="status" value="<?php echo $status; ?>" size="3" readonly="readonly" />
              <?php echo $tempstatus; ?></td>

          </table></td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="14%" align="right" valign="top" class="letra">Motivo(s) da Nega&ccedil;&atilde;o: </td>
              <td width="86%"><textarea name="xmotivonegado" cols="80" rows="8" onkeyup="converteUpper(this);"></textarea>
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
        <td width="86%"><input name="Submit" type="submit" class="botao" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
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

