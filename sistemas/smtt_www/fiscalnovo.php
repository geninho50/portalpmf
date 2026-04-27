<html>
<link rel="stylesheet" type="text/css" href="estilos.css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="60%" bordercolor="#7CFC00" height="80">
	<tr>
	    <td width="10%" bgcolor="#9ACD32" height="20">
	    <p align="center"><font face="verdana" size='3'>Diretoria de Fiscaliza&ccedil&atildeo</font>
		</td>
	</tr>
	<tr align="center">
		<td width="60%" height="40">
		<p align="center"> <h2><br>Controle de Ponto</p></h2>
				
<table border="0"> <form method="POST" action="listaponto.php">
<tr><td align="left">
<?php
require("valida_qq_sessao.php");
if(!empty($_GET["campo"]))
	{ 
		if ($_GET["campo"] == 'nf')
		{
			echo "<td align='left'><font face='verdana' color='#FF0000' size='2' > Escolha um nome ou digite um dia</font>";
		}
	}
?>
	</td></tr>
	<tr>
<?php
	
	require("conecta.php");
	echo " <td align='right'><a class='smt'>Nome:</a></td>";
	session_start();
	
	if ($_SESSION['admin']=="A")
	{
		echo "<td align='left'><SELECT name='nome' align='center'>";
		echo "<OPTION></OPTION>";
		$sql="SELECT nome, usuario_id FROM usuarios ORDER BY nome";
		$resultado=pg_query($sql);
		$linhas=pg_num_rows($resultado);
		for ($i=0;$i<$linhas;$i++)
		{
			$fiscalnome=pg_result($resultado,$i,"nome");
			$us_id=pg_result($resultado,$i,"usuario_id");
			echo "<OPTION value=".$us_id.">".utf8_encode($fiscalnome)."</OPTION>";
		}
		echo "</td>";
	}
	else
	{
		echo "<td width='60%' height='80%'><a class='hr'>";
		echo utf8_encode($_SESSION['nomeusuario']);
		echo "</td></a>";
	}
?>
</tr>
<tr align="center">
	<td align='right'><a class='smt'>Dia: </a></td>
<?php
	
	$dia=date('d',time());
	echo "<td align='left'><a class='smt'><input type='text' name='dia' value='$dia' size='2' maxlength='2'></a></td>";
?>
</tr>
<tr align="center">
	<td align='right'width="20%" height="80%">
<?php 
    
	echo "<a class='smt'>M&ecircs:</a> </td>";
    echo "<td align='left'><SELECT name='mesnum' >";
		$sql="SELECT nomemes, mesnum FROM meses";
		$resultado=pg_query($sql);
		$linhas=pg_num_rows($resultado);
		for ($i=0;$i<$linhas;$i++)
				{
					$nomemes=pg_result($resultado,$i,"nomemes");
					$mesnum=pg_result($resultado,$i,"mesnum");
					$mes=date('n',time());
					if($mesnum==$mes)
					{
						echo "<OPTION SELECTED value=$mesnum>$nomemes</OPTION>";
					}
					else
					{
						echo "<OPTION value=$mesnum>$nomemes</OPTION>";
					}
				}
				
				echo "</td>";
?>
					
      
 </tr>
 <tr align="center">
		    <td align='right' width="20%" height="80%">
				<?php 
				echo "<a class='smt'>Ano:</a></td>";
				echo "<td align='left'><SELECT name='ano'>";
				$sql="SELECT ano FROM anos";
				$resultado=pg_query($sql);
				$linhas=pg_num_rows($resultado);
				for ($i=0;$i<$linhas;$i++)
				{
					$ano=pg_result($resultado,$i,"ano");
					$anocor=date('Y',time());
					if($ano==$anocor)
					{
						echo "<OPTION SELECTED>$ano</OPTION>";
					}
					else
					{
						echo "<OPTION>$ano</OPTION>";
					}
				}
				echo "</td>";
				pg_close($conecta)
				?>	
</table>
 <input type="hidden" name="operacao" value="listar">
				<p></p><input type="submit" value="LISTAR PONTO" name="enviar" face="verdana">
				</form>
				<p align="center"><a class='hr' href="gerenciaponto.php">Listar por Periodo</a></font></p>
				<p align="center"><a class='hr' href="gerenciapontoh.php">Listar por Periodo com Total de Horas</a></font></p>
				<p align="center"><a class='lp' href="logout.php">Sair</a></font></p>
				
</html>

