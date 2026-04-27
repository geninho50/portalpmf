<html>
<body>
<link rel="stylesheet" type="text/css" href="estilos.css">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="60%" bordercolor="#7CFC00" height="20">
	    <tr>
	      <td width="10%" bgcolor="#9ACD32" height="20">
	      <p align="center"><font face="verdana" size='3'>Diretoria de Fiscaliza&ccedil&atildeo</font>
		  </td>
	    </tr>
		</table>
		<br></br>
<form method="POST" action="login.php">
<table align="center" border=4 bordercolor='#9ACD32'>
<tr>
	<td align='right'><a class='smt'>Usu&aacuterio: </a></td>
	<td align='center'><a class='smt'><input type="text" name="username" size="10"></a></td>
</tr><tr>
	<td align='right'><a class='smt'>Senha: </a></td>
	<td align='center'><a class='smt'><input type="password" name="senha" size="10"></a></td>
</tr>
</table>
<?php
	session_start();
	if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
	{
		echo "<p align='center'><font face='verdana' size='2'>".$_SESSION['msg']."</font>";
		unset($_SESSION['msg']);
	}
?>
	<p align="center"><font face="verdana" size="2"><input type="submit" value="Enviar" name="enviar"></font></p>
</form>
</body>
</html>