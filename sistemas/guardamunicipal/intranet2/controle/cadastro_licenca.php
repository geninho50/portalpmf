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

	$ano_atual =  (int)$_POST['ano'];
   	if( $ano_atual == 0 )
   	{
		$data_atual = date("Y-m-d");
     	$ano_atual = substr($data_atual,0,4);
  	}
	
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
   // Pega o ano da variavel $data_atual
   
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
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
    <td width="42%" align="left">&nbsp;</td>
    <td width="58%" align="right">&nbsp;</td>
  </tr>
</table>
<fieldset>
  <legend class="cabecalho">ANO DE CONSULTA</legend>
<form name="form1" action="cadastro_licenca.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="7%">&nbsp;</td>
    <td width="7%">
    <select name="ano" class="negrito">
	  <option value="2016">2020</option>
      <option value="2016">2019</option>
      <option value="2016">2018</option>
      <option value="2016">2017</option>
      <option value="2013">2016</option>
      <option value="2014">2015</option>
      <option value="2015">2014</option>
      <option value="2016">2013</option>
	</select>
    </td>
    <td width="86%"><input name="Confirmar" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
  </tr>
</table>
</form>
</fieldset>	
<fieldset>
	<legend class="cabecalho">GABARITO DE LICENÇAS&nbsp;<? echo $ano_atual; ?> </legend>
<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#000000">
  <tr>
  	<td width="10%" align="center" bgcolor="#006699" class="branco"><b>SETORES</b></td>
    <td width="15%" align="center" bgcolor="#006699" class="branco"><b>JANEIRO</b></td>
    <td width="15%" align="center" bgcolor="#006699" class="branco"><b>FEVEREIRO</b></td>
    <td width="15%" align="center" bgcolor="#006699" class="branco"><b>MAR&Ccedil;O</b></td>
    <td width="15%" align="center" bgcolor="#006699" class="branco"><b>ABRIL</b></td>
    <td width="15%" align="center" bgcolor="#006699" class="branco"><b>MAIO</b></td>
    <td width="15%" align="center" bgcolor="#006699" class="branco"><b>JUNHO</b></td>
  </tr>
</table>
<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
    <?
  	$sqlG = "SELECT * FROM grupo";
	$resultG = $obj->executaQuery($sqlG);
	while( $linhaG = mysql_fetch_array($resultG))
	{
		$nome = $linhaG["nome"];
		$id = $linhaG['id'];
  	
	 ?>
	 <tr>
        <td width="10%" align="center" bgcolor="#cccccc" class="negrito"><? echo $nome; ?></td>
		<?
        include("ferias/janeiro_1.php");
		include("ferias/fevereiro_1.php");
		include("ferias/marco_1.php");
		include("ferias/abril_1.php");
		include("ferias/maio_1.php");
		include("ferias/junho_1.php");
		
		?>
  </tr>
		<?
		}
		?>
        
</table>	


<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#000000">
  <tr>
	<td width="10%" align="center" bgcolor="#006699" class="branco"><b>SETORES</b></td>
    <td width="15%" align="center" bgcolor="#006699" class="branco"><b>JULHO</b></td>
    <td width="15%" align="center" bgcolor="#006699" class="branco"><b>AGOSTO</b></td>
    <td width="15%" align="center" bgcolor="#006699" class="branco"><b>SETEMBRO</b></td>
    <td width="15%" align="center" bgcolor="#006699" class="branco"><b>OUTUBRO</b></td>
    <td width="15%" align="center" bgcolor="#006699" class="branco"><b>NOVEMBRO</b></td>
    <td width="15%" align="center" bgcolor="#006699" class="branco"><b>DEZEMRO</b></td>
  </tr>
</table>
  <table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
    <?
  	$sqlG = "SELECT * FROM grupo";
	$resultG = $obj->executaQuery($sqlG);
	while( $linhaG = mysql_fetch_array($resultG))
	{
		$nome = $linhaG["nome"];
		$id = $linhaG['id'];
  	
	 ?>
	 <tr>
        <td width="10%" align="center" bgcolor="#cccccc" class="negrito"><? echo $nome; ?></td>
	 <?
        include("ferias/julho_1.php");
		include("ferias/agosto_1.php");
		include("ferias/setembro_1.php");
		include("ferias/outubro_1.php");
		include("ferias/novembro_1.php");
		include("ferias/dezembro_1.php");
		
		?>
        
   </tr>
	<?
	}
	?>
        
</table>	

  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10%">&nbsp;</td>
      <td width="90%"><a href="cadastro_licenca_imprimir.php">Imprimir</a></td>
    </tr>
  </table>
</fieldset>

</body>
</html>

