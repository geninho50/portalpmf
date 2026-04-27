<?php
	ini_set('default_charset','UTF-8');

	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$objT = new trataArquivo;
	$objS = new trataString;
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$login = $linhaS["login"];
		$matricula = $linhaS["matricula"];
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
        <legend class="vermelho">TROCA DE SERVIÇO</legend>
           <?php include("troca_servico.php"); ?>
    </fieldset>
<br>
    <fieldset>
        <legend class="vermelho">PEDIDO DE FOLGA</legend>
           <?php include("pedido_folga.php"); ?>
    </fieldset>
<br>
    <fieldset>
        <legend class="vermelho">DOAÇÃO DE SANGUE</legend>
            <?php include("doacao_sangue.php"); ?>
    </fieldset>
	<!--fim adm-->
	
	</td>
  </tr>
</table>


<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="3%">&nbsp;</td>
    <td width="94%">
		<!-- ini agenda -->
			<?php include("agendaint.php"); ?>
			<!-- fim agenda  -->
	</td>
    <td width="3%">&nbsp;</td>
  </tr>
</table>

</body>
</html>

