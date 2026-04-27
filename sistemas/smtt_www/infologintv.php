<html>
<body>
<link rel="stylesheet" type="text/css" href="estilos.css">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="60%" bordercolor="#7CFC00" height="20">
<tr>
<td width="10%" bgcolor="#9ACD32" height="20">
<p align="center"><font face="verdana" size='3'>Download para InfoTV</font>
</td>
</tr>
</table>
<br></br>
<?php
	$username = "";
	$senha ="";
	$username = $_POST["username"];
	$senha = $_POST["senha"];
//	session_start();
//	if(isset($_SESSION['username']) && !empty($_SESSION['senha']))
//	if(isset($username) && isset($senha))	
	{
//		unset($_SESSION['msg']);
	}
//	if($_SESSION['username']=='smt_infotv' && $_SESSION['senha']=='terminais')
	if($username=='smt_infotv' && $senha=='terminais')	
	{
		echo "<p align='center'><a href='InfoTV.rar'>Download</a>";
	}
	else
	{
		echo "<form method='POST' action='infologintv.php'>";
		echo "<table align='center' border=4 bordercolor='#9ACD32'>";
		echo "<tr>";
		echo "<td align='right'><a class='smt'>Usuário: </a></td>";
		echo "<td align='center'><a class='smt'><input type='text' name='username' size='10'></a></td>";
		echo "</tr><tr>";
		echo "<td align='right'><a class='smt'>Senha: </a></td>";
		echo "<td align='center'><a class='smt'><input type='password' name='senha' size='10'></a></td>";
		echo "</tr>";
		echo "</table>";
		echo "<p align='center'><font face='verdana' size='2'><input type='submit' value='Enviar' name='enviar'></font></p>";
	}
?>
</form>
</body>
</html>