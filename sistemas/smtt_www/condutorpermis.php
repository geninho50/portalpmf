<html>
<link rel="stylesheet" type="text/css" href="estilos.css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script LANGUAGE="JavaScript">

function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
</script>
</head>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="60%" bordercolor="#7CFC00" height="80">
	<tr>
	    <td width="10%" bgcolor="#9ACD32" height="20">
	    <p align="center"><font face="verdana" size='3'>Diretoria de Fiscaliza&ccedil&atildeo</font>
		</td>
	</tr>
	<tr align="center">
		<td width="60%" height="40">
		<p align="center"> <h2><br>Condutor / Permission&aacuterios</p></h2>
				
<table border="0"> <form method="POST" action="condutorlistaperm.php">
	<tr>
		<td align="left">
<?php
require("valida_qq_sessao.php");
if(!empty($_GET["campo"]))
{ 
	if ($_GET["campo"] == 'tp')
	{
		echo "<td align='left'><font face='verdana' color='#FF0000' size='2' > Digite um CPF válido</font>";
	}
}
?>
		</td>
	</tr>
	<tr>
		<td>
			<align='center'>&nbsp;<a class='smt'>CPF do Condutor:<td align='left'></a><input type='text' size='14' name='cpf' maxlength='14' OnKeyPress="formatar('###.###.###-##', this)"></td>
		</td>
	</tr>
</table>
<input type="hidden" name="operacao" value="listar">
<p></p><input type="submit" value="LISTAR PERMISSIONARIOS" name="enviar" face="verdana">
</form>
<p align='center'><font face='Verdana' size='2'><a href='seleciona.php'>Voltar</a></font></p>
<!--<p align="center"><a class='lp' href="logout.php">Sair</a></font></p>-->
				
</html>

