<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
</head>
<link rel="stylesheet" type="text/css" href="estilos.css">
<script type="text/javascript" src="funcoes.js">
</script>
<body>
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="80%" bordercolor="#008000" height="80">
	    <tr>
	      <td width="60%" bgcolor="#9ACD32" height="20">
	        <p align="center"><font face="verdana" size="3">Diretoria de Fiscaliza&ccedil&atildeo</font>
		  </td>
	    </tr>
	    <tr align="center">
		    <td width="50%" height="50">
				<p>&nbsp;&nbsp; <br><a class='smt'>Escolha o Servi&ccedilo, N&ordm de Ordem ou a Placa para listar os ve&iacuteculos correspondentes</a></p>
				<form method="POST" action="vistoria.php">
				</tr> 
				</table>
				<table align="center" border="0" bordercolor="#008000">
				<?php
				require("conecta.php");
				require("valida_qq_sessao.php");
				echo "<tr><td align='right'><a class='smt'>Servi&ccedilo:</a></td><td align='left'><SELECT name='servico'>"; 
				echo "<OPTION></OPTION>";
				$sql="SELECT nomeservico FROM vencimentos GROUP BY nomeservico";
				$resultado=pg_query($sql);
				$linhas=pg_num_rows($resultado);
				for ($i=0;$i<$linhas;$i++)
				{
					$nomeservico=pg_result($resultado,$i,"nomeservico");
					echo "<OPTION>$nomeservico</OPTION>";
				}
				pg_close($conecta);
				echo "</td><td width='60'></td></tr>";
				?>
				
	
	<tr><td align="right"><a class='smt'><input type="radio" name="vt" value="T" CHECKED T /> Todos
	</a></td>
	<td align="left"><a class='smt'><input type="radio" name="vt" value="V"/> Vencidos
	</a></td></tr>
	
				
			</td>
		</tr>
		<tr align="center">
		<td align="right">
				
					<align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class='smt'>N&ordm de Ordem:<td align="left"></a><input type="text" size='10' name="noordem"></td>
					
		<td>
		</tr>
	    <tr align="center">
		    <td align="right">
			<align="center"><a class='smt'>Placa do Ve&iacuteculo:</td><td align="left"></a><input type="text" size='10' name="placa"></td>
					
			</td>
	    </tr>
		</table>
	<p align="center"><input type="hidden" name="operacao" value="cadastro" >
					<input type="submit" value="Listar Veiculos" name="enviar"></p>
				</form>
	<?php
//	    echo "<tr align='center'>";
//		echo "<td width='60%' height='40'>";
//		echo "<form method='POST' action='cadvencidos.php'>";
//		echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='Listar só Vencidos' name='enviar'>";
//		echo "<input type='hidden' name='servico'>";
//		echo "</form>";
//		echo "</td>";
//	    echo "</tr>";
		session_start();
//		$_SESSION['ultform'] = 'seleciona';
		if($_SESSION['cadastro'] == 'C')
		{
	    
		echo "<p align='center'>";
		echo "<a class='lp' href='cadvistoria.php'>Listar Todo o Cadastro</a>";
	    echo "</p>";
		}
	?>		
	<p align="center"><a class='lp'href="logout.php">Sair</a></p>
	
</body>
