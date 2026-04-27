<html>
<link rel="stylesheet" type="text/css" href="estilos.css">
<title >Cadastro e autenticação</title>
	<body>

<script Language="JavaScript">
function Valida()
{
	if (document.gcada.senha.value == ""){
    alert("Digite sua Senha");
	document.gcada.senha.style.background = "D5D5D5"
    return false;
	}
return true;
}
</script>
<?php
include "conecta.php";
require("valida_qq_sessao.php");
session_start();

$matricula=$_SESSION['matricula'];
$senhausuario=$_SESSION["senhausuario"];
$resultado = pg_query ("SELECT * FROM usuarios WHERE username='$matricula'");
		
		if($resultado!=FALSE)
		{
			$linhas = pg_num_rows ($resultado);
			
			if($linhas==0)
			{
				echo "<p><a class='smt'>Não tem nada para ser mostrado</a></p>";
			}
			else
			{			
				if ($senhausuario != pg_result($resultado, 0, "senha")) // confere senha		
				{
					$_SESSION['msg'] = "A senha está incorreta!";
					header ("Location: pontologin.php");
					exit;
				}
				$nome=pg_result($resultado,$i,"nome");
				$email=pg_result($resultado,$i,"email");
				
			}
		}	
		else
		{
			echo pg_error();
		}	
pg_close($conecta);
 ?>
	
<table align="center" border="0" cellpadding="0" cellspacing="0" width="60%" bordercolor="#7CFC00" height="20">
	    <tr>
	      <td width="10%" bgcolor="#9ACD32" height="20">
	      <p align="center"><font face="verdana" size='3'>Diretoria de Fiscaliza&ccedil&atildeo</font>
		  </td>
	    </tr>
		</table>
<h2 align="center">Cadastro do usu&aacuterio</h2>
	<form name="gcada" method="POST" action="gerencia_cadastro.php">
  <input type="hidden" name="operacao" value="cadastrar">
 <table border="0" align="center" width="70%"><tr>
 <?php
 echo "<td align='right'><a class='smt'> Matricula: </td><td><input type='text' name=matricula value='".$matricula."' size='10' ></a></td></tr>";
 
  echo "<tr><td align='right'><a class='smt'> Nome: </td><td><input type='text' name='nome' value='".$nome."' size='50'></a></td></tr>";
  ?>
  <tr><td align="right"><a class='smt'> Senha: </td><td><input type="password" name="senha" size="10"></a></td></tr>
  <tr><td align="right"><a class='smt'> Confirmar Senha:</td> <td><input type="password" name="csenha" size="10"></a></td></tr>
 <?php 
  echo "<tr><td align='right'><a class='smt'> Email: </td><td><input type='text' name='email' value='".$email."' size='20'></a></td></tr>";
	echo "<table border='0' align='center' width='70%'>";
	echo "<tr><td>";
	
 
	if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
	{
		echo "<p align='center'><a class='smt'>".$_SESSION['msg']."</a>";
		unset($_SESSION['msg']);
	}	
	echo "</td></tr>";
	?> 
 </table>
  <p align="center"><input type="submit" value="Cadastrar" name="enviar" onclick="return Valida()">
</form>
<p align="center"><a class='lp' href="logout.php">Sair</a></font></p>
	</body>
	</html>

