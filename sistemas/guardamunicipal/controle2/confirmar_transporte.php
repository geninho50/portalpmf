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
	
	if($status == 1){
		$tempstatus='Positivo';
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
	<legend class="negrito">Autorizar pedido de transporte</legend>
<form name="form1" method="post" action="../classes/controleTransporte.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%"  border="0" cellspacing="1" cellpadding="1">
        <tr>
         <td align="right"><span class="letra">N&ordm;:</span></td>
		  <td align="left"><input name="idTransporte" type="text" id="idTransporte" value="<?php echo $idTransporte; ?>" size="3" readonly="readonly" /></td>
        </tr>
        <tr>
          <td align="right"><span class="letra">Status:</span></td>
		  <td align="left"><input name="status" type="text" id="status" value="<?php echo $status; ?>" size="3" readonly="readonly" />
            <?php echo $tempstatus; ?></td>
        </tr>
        <tr>
          <td align="right"><span class="letra">Hora: </span></td>
		  <td><input name="xhora" type="text" id="xhora" onKeyPress="valida_horas(this)" size="12" maxlength="8"></td>
        </tr>
        <tr>
          <td align="right" valign="top">Informacoes adicionais: </td>
		  <td align="left"><textarea name="xinformacao_adicional" id="xinformacao_adicional" cols="50" rows="5" onkeyup="converteUpper(this);"></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
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
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>

