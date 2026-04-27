<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link rel="stylesheet" type="text/css" href="estilos.css">
<body>
<script Language="JavaScript">
function Valida()
{
  if (document.cadastro.username.value == ""){
  	alert("Digite o usuario");
  	document.cadastro.username.style.background = "D5D5D5"
    return false;
  }
  if (document.cadastro.senha.value == ""){
    alert("Digite sua Senha");
    return false;
  }
  if ((document.cadastro.entsai[0].checked == false) && (document.cadastro.entsai[1].checked == false)){
	alert("Indique se Entrada ou Saida");
	return false;
  }
  return true;
}
</script>
<?php
	$nome_usuario="";
	session_start();
	if(isset($_SESSION['matricula']) && !empty($_SESSION['matricula']))
	{
	$nome_usuario=$_SESSION['matricula'];
	$admin=$_SESSION['admin'];
	}
?>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="60%" bordercolor="#7CFC00" height="20">
	    <tr>
	      <td width="10%" bgcolor="#9ACD32" height="20">
	      <p align="center"><font face="verdana" size='3'>Diretoria de Fiscaliza&ccedil&atildeo</font>
		  </td>
	    </tr>
		</table>
		<br></br>
<form name='cadastro' method=post action="login.php">
<table align="center" border=4 bordercolor='#9ACD32'>
<input type="hidden" name="operacao" value="ponto">
<tr>
	<td align='right'><a class='smt'>Usu&aacuterio: </a></td>
	<?php
	echo "<td align='center'><b><input type='text' name='username' value='$nome_usuario' size='10'></b></td>";
	?>
</tr><tr>
	<td align='right'><a class='smt'>Senha: </a></td>
	<td align='center'><a class='smt'><input type="password" name="senha" size="10"></a></td>
</tr><tr>
	<td>	
	<a class='smt'><input type="radio" name="entsai" value="E" /> Entrada
	</a></td><td>
	<a class='smt'><input type="radio" name="entsai" value="S" /> Sa&iacuteda
	</a>
	</td>
</tr>
</table>
<?php
	if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
	{
		echo "<p align='center'><a class='smt'>".$_SESSION['msg']."</a>";
		unset($_SESSION['msg']);
	}	
	
	if(isset($_SESSION['admin']) && $_SESSION['admin']=='A')
	{ 
	echo "<p></p>";
	
	echo "<p align='center'><font face='verdana' size='2'><a href='fiscalnovo.php'>Acesso ao Controle de Ponto</a></p>";
	
	echo "<p></p>";
	
	echo "<p align='center'><font face='verdana' size='2'><a href='cadastro.php'>Alterar Cadastro</a></p>";
	}
	if(isset($_SESSION['admin']) && $_SESSION['admin']=='Z') 
	{
	echo "<p></p>";
	
	echo "<p align='center'><font face='verdana' size='2'><a href='fiscalnovo.php'>Vizualizar o seu ponto</a></p>";
	
	echo "<p></p>";
	
	echo "<p align='center' ><font face='verdana' size='2'><a href='cadastro.php'>Alterar Cadastro </a></p>";
	}
	echo "<table border='0' align='center' width='70%'>";
	echo "<tr><td>";
	
	if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
	{
		echo "<p align='center'><a class='smt'>".$_SESSION['msg']."</a>";
		unset($_SESSION['msg']);
	}	
	echo "</td></tr>";
	echo "</table>";
?>
<p align="center"><input value="Enviar" name="enviar" type="submit" onclick="return Valida()">
</form>
<?php
if (isset($_SESSION['matricula']) && !empty ($_SESSION['matricula']))
{
echo "<p align='center'><a class='lp' href='logout.php'>Sair</a></font></p>";
}
?>
</body>
</html>

