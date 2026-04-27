<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;

	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$comando = $linha["comando"];
		$setorpessoal = $linha["setorpessoal"];
		$central = $linha["central"];
	}
	
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>


<style type="text/css">
#imgpos {
position:absolute;
left:50%;
top:50%;
margin-left:-290px;
margin-top:-210px;
}
#imgpos1 {
position:absolute;
left:50%;
top:50%;
margin-left:-100px;
margin-top:-100px;
}
.style7 {font-size: 11px; font-weight: bold; font-family: Arial, Helvetica, sans-serif;}
.style8 {color: #CCCCCC}
</style>

<SCRIPT LANGUAGE="JavaScript">
<!--
var estiloPosiciona = 'imgpos';
	function getBrowserName()
	{   		
		if( navigator.appName == 'Microsoft Internet Explorer' )
		{			
			// É o Microsoft Internet Explorer
		}
		else
		{
			// Não é Internet Explore'
			estiloPosiciona = 'imgpos';
		}
	}	
	getBrowserName();
//-->
</SCRIPT>

<title>SIGA - Sistema de Gerenciamento Administrativo</title></head>



<body bgcolor="#ffffff" >

<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="150" align="center" class="style1 style8">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="style1 style8">

	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="28%">&nbsp;</td>
    <td width="44%" align="center"><img src="images/painel/siga.png"></td>
    <td width="28%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td height="200" align="center">
			<? if(strlen($linha['adm']) > 0 && $linha['adm']=='S'){?>
				<a href="framePrincipal.php"><img src="images/painel/adm.jpg" width="123" height="167"></a>
			<? } else{?><img src="images/painel/adm_cinza.jpg" width="123" height="167"><? }?>	
			</td>
			<td align="center">
			<? if(strlen($linha['comando']) > 0 && $linha['comando']=='S'){?>
				<a href="framePrincipal.php"><img src="images/painel/comando.png" width="123" height="167"></a>
			<? } else{?><img src="images/painel/comando_cinza.png" width="123" height="167"><? }?>
			</td>
			<td align="center">
			<? if(strlen($linha['guardaonline']) > 0 && $linha['guardaonline']=='S'){?>
				<a href="framePrincipal.php"><img src="images/painel/guarda_online.jpg" width="123" height="167"></a>
			<? } else{?><img src="images/painel/guarda_online_cinza.jpg" width="123" height="167"><? }?>
			</td>
		    <td align="center">
			<? if(strlen($linha['educacao']) > 0 && $linha['educacao']=='S'){?>
				<a href="framePrincipal.php"><img src="images/painel/educacao.jpg" width="123" height="167"></a>
			<? } else{?>
			<img src="images/painel/educacao_cinza.jpg" width="123" height="167">			<? }?>
			</td>
		  </tr>
		</table>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="100" align="center"><img src="images/painel/logogmf.png"></td>
    <td>&nbsp;</td>
  </tr>
</table>	</td>
  </tr>
</table>
</body>
</html>
