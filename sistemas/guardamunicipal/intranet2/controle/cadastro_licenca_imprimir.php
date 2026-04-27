<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	 //Pega a data atual
   $data_atual = date("Y-m-d");
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
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
<fieldset>
	<legend class="cabecalho">GABARITO DE LICENÇAS<? echo $ano_atual; ?> </legend>
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
        include("ferias/janeiro.php");
		include("ferias/fevereiro.php");
		include("ferias/marco.php");
		include("ferias/abril.php");
		include("ferias/maio.php");
		include("ferias/junho.php");
		
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
        include("ferias/julho.php");
		include("ferias/agosto.php");
		include("ferias/setembro.php");
		include("ferias/outubro.php");
		include("ferias/novembro.php");
		include("ferias/dezembro.php");
		
		?>
	</tr>
		<?
	}
		?>
</table>	

</fieldset>

</body>
</html>

