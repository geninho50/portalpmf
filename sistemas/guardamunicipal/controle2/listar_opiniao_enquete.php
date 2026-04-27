<?php
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
   
		$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$resultado = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$login = $linha["login"];
		}
   
    $idenquete = 0;
	$idenquete = (int)$_POST['idenquete'];
	if( $idenquete == 0 )
	{
		$idenquete = (int)$_GET['idenquete'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
  <table width="100%"  border="0" cellpadding="1" cellspacing="1">
    <?
    $sqlA = "SELECT * FROM opiniao where idenquete=$idenquete";
    $resultadoA = $obj->executaQuery($sqlA);
	while( $linhaA = mysql_fetch_array($resultadoA))
	{
		$data = $linhaA["data"];
		$descricao = $linhaA["descricao"];
		$guarda = $linhaA["guarda"];
	?>
        <tr>
          <td width="10%" align="right" bgcolor="#CCCCCC" class="negrito">Guarda:</td>
          <td width="15%" align="left"><? echo $guarda;?></td>
          <td width="7%" align="right" bgcolor="#CCCCCC" class="negrito">Data:</td>
          <td width="68%" align="left"><? echo $data;?></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#CCCCCC"class="negrito">Opiniao:</td>
          <td colspan="3" align="left"><? echo $descricao;?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3">&nbsp;</td>
        </tr>
    <?
	}
	?>
    </table>

	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>
