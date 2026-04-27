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
   
    $id = 0;
	$id = (int)$_POST['id'];
	if( $id == 0 )
	{
		$id = (int)$_GET['id'];
	}
  	
	$sqlA = "SELECT * FROM enquete where id=$id";
    $resultadoA = $obj->executaQuery($sqlA);
	while( $linhaA = mysql_fetch_array($resultadoA))
	{
		$nome = $linhaA["nome"];
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
	<fieldset>
	<legend class="negrito">Dados da Opiniao</legend>
    <form name="form" action="../classes/controleOpiniao.php" method="post" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="15%" align="right"  class="letra">Guarda:</td>
          <td width="85%"><input name="guarda" type="text" maxlength="10" id="guarda" readonly="readonly" value="<? echo $login;?>"/></td>
        </tr>
		<tr>
          <td width="15%" align="right"  class="letra">Enquete:</td>
          <td width="85%"><input name="id" type="text" maxlength="10" id="id" readonly="readonly" value="<? echo $id;?>"/></td>
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
          <td width="15%" align="right" valign="top" class="letra" >Descri&ccedil;&atilde;o da Opiniao:</td>
          <td width="85%"><textarea name="opiniao" cols="100" rows="10"><? echo $opiniao;?></textarea></td>
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
          <td width="37%"><input name="Confirmar" type="submit" class="botao" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
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
