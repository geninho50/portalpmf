<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
</head>
<body>
<link rel="stylesheet" type="text/css" href="estilos.css">
<form action="enviando_email.php" method="POST">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="60%" bordercolor="#7CFC00" height="20">
	<tr>
	    <td width="10%" bgcolor="#9ACD32" height="20">
	    <p align="center"><font face="verdana" size='3'>Diretoria de Fiscaliza&ccedil&atildeo</font>
		</td>
	</tr>
	<tr align="center">
		<td width="50%" height="50">
		<p> <br><h2>Contate o Suporte - em manuten&ccedil&atildeo, favor n&atildeo utilizar</h2></p>
</table>
<table align="center" border="0">
	<tr><td align="right"><a class="smt"> Seu Nome: </td><td align="left"> <input type="text" name="nome"></a></td></tr>
	<tr><td align="right" ><a class="smt">Seu E-Mail: </td><td align="left" width="70%"><input type="text" name="email" size="30"></a></td></tr>
	<tr><td align="right" ><a class="smt">Assunto: </td><td align="left" width="70%"><input type="text" name="assunto" size="30"></a></td></tr>
	<tr><td align="right"><a class="smt">Mensagem: </td><td align="left" height="80"><textarea name="mensagem" rows="6" cols="30"></textarea></a></td></tr>
</table>
<?php
session_start();
if(isset($_SESSION['msgenvio']))
{
	echo "<p align='center'><a class='smt'>".$_SESSION['msgenvio']."</a>";
}
unset($_SESSION["msgenvio"]);
?>
<p align="center"><input type="submit" name="enviar" value="Enviar"></p>
</form>
</body>
</html>