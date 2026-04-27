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
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	//Pega a data atual
    $data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");
   
   $idElogio = 0;
   $idElogio = (int)$_POST['idElogio'];
   if( $idElogio == 0 )
   {
	 $idElogio = (int)$_GET['idElogio'];
   }

    $sqlA = "SELECT * FROM elogio where id=$idElogio";
    $resultadoA = $obj->executaQuery($sqlA);
	if( $linhaA = mysql_fetch_array($resultadoA))
	{
		$id = $linhaA["id"];
		$guarda = $linhaA["guarda"];
		$numero = $linhaA["numero"];
		$data = $linhaA["data"];
		$titulo = $linhaA["titulo"];
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
    <td width="42%" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CADASTRO ELOGIOS</legend>
    <form name="form" action="../classes/controleElogios.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
    <table width="100%"  border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="12%" align="right" class="letra">Guarda:</td>
      <td width="88%">
		<input type="text" name="xguarda" id="xguarda" size="20" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" onkeyup="converteUpper(this);" /></td>
    </tr>
    <tr>
      <td align="right" class="letra">Numero:</td>
      <td><input name="xnumero" type="text" size="10" value="<? echo $numero;?>" class="negrito"  onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
    </tr>
    <tr>
      <td align="right" class="letra">Data: </td>
      <td>
	  	  <input type="text" value="<? echo $dataini;?>" readonly name="xdataini" class="negrito" size="12" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
		  <a onClick="displayCalendar(document.forms[0].xdataini,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' tille='Selecione a Data'>
	  </td>
    </tr>
    <tr>
      <td align="right" class="letra">Titulo:</td>
      <td><input name="xtitulo" type="text" size="60" value="<? echo $titulo;?>" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" onkeyup="converteUpper(this);" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
