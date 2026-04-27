<?php
	ini_set('default_charset','UTF-8');

	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
	$matricula = $_GET['matricula'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$conexao = new DB_mysql ;
	$objT = new trataArquivo;
	$objS = new trataString;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<fieldset>
	<legend class="cabecalho">CADASTRO DE PERMISSÕES</legend>

<form name="form1" method="post" action="../classes/controleFuncionario.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')" enctype="multipart/form-data">

<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
 <tr>
   <td width="10%" align="center" class="branco">Nome de Guerra</td>
   <td width="90%" class="branco">Permissões de Acesso</td>
 </tr>
</table>
<table  width="98%" cellpadding="0" cellspacing="0">
 <tr>
   <td width="10%" align="center">&nbsp;</td>
   <td width="6%" class="online" align="center">DIRETORIA</td>
   <td width="6%" class="online" align="center">CENTRAL</td>
   <td width="9%" class="online" align="center">ADMINISTRATIVO</td>
   <td width="6%" class="online" align="center">EDUCAÇÃO</td>
   <td width="6%" class="online" align="center">LOGÍSTICA</td>
   <td width="6%" class="online" align="center">SENTINELA</td>
   <td width="5%" class="online" align="center">DIGITAÇÃO</td>
   <td width="6%" class="online" align="center">MATUTINO</td>
   <td width="7%" class="online" align="center">VESPERTINO</td>
   <td width="4%" class="online" align="center">ALFA</td>
   <td width="4%" class="online" align="center">BRAVO</td>
   <td width="6%" class="online" align="center">ZONA AZUL</td>
   <td width="4%" class="online" align="center">OBRAS</td>
   <td width="6%" class="online" align="center">RONDA ESCOLAR</td>
   <td width="4%" class="online" align="center">CANIL</td>
   <td width="5%" class="online" align="center">DETRAN</td>
 </tr>
</table>

    <iframe height=580 width=100% src="listar_permissao_servicoonline.php" scrolling="auto" frameBorder=0 bgcolor=#000000></iframe>

</form>
</fieldset>
</body>
</html>