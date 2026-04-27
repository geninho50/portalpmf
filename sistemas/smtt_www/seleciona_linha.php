<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<title>HORÁRIO ÔNIBUS</title>
</head>
<?php

include_once("conecta_db.php");
	//Lista as empresas
	function lista_empresas()
	{
		$_consulta = pg_query("Select empresa, nome_empresa, emp From 
									empresas ORDER BY emp");	
		echo "<option></option>";
			while( $_row = pg_fetch_assoc($_consulta) ){
					//Um if para manter selecionado a empresa que foi selecionada
					if($_row['empresa'] == $_GET['empresa'])
					{
						echo "<option selected value=\"{$_row['empresa']}\">".utf8_encode($_row['emp'])."</option>\n";
					}
					else
					{
						echo "<option value=\"{$_row['empresa']}\">".utf8_encode($_row['emp'])."</option>\n";
					}
			}
	}

	//Lista os numeros das linhas de onibus 
	//Pode receber o id da empresa como parametro de busca
	//echo "Empresa:";
	//echo $_GET["empresa"];
	function lista_num_linhas()
	{
		if(isset($_GET["empresa"]) && !empty($_GET["empresa"]))
			{
			$_numero_empresa = $_GET['empresa'];
			$_consulta = pg_query("Select l.linha, l.nome_linha, l.empresa From linhas l " .
				"JOIN horarios h ON l.linha = h.linha WHERE " .
				"l.empresa LIKE '%".$_numero_empresa."%' " .
				"GROUP BY l.linha, l.nome_linha, l.empresa ORDER BY l.linha");
			}
		else
			{
			$_consulta = pg_query("Select l.linha, l.nome_linha, l.empresa From linhas l " .
				"JOIN horarios h ON l.linha = h.linha " .
				"GROUP BY l.linha, l.nome_linha, l.empresa ORDER BY l.linha");
			}	
		echo "<option></option>";
			while( $_row = pg_fetch_assoc($_consulta) ){
				echo "<option value=\"{$_row['linha']}\">{$_row['linha']} - ".utf8_encode($_row['nome_linha'])."</option>\n";
			}
	}
	
	//Lista os nomes das linhas de onibus
	//Pode receber o id da empresa como parametro de busca
	function lista_nome_linhas()
		{
		if(isset($_GET["empresa"]) && !empty($_GET["empresa"]))
			{
			$_numero_empresa = $_GET['empresa'];
			$_consulta = pg_query("Select l.linha, l.nome_linha, l.empresa From linhas l " .
				"JOIN horarios h ON l.linha = h.linha WHERE " .
				"l.empresa LIKE '%".$_numero_empresa."%' " .
				"GROUP BY l.linha, l.nome_linha, l.empresa ORDER BY l.nome_linha");
			}
		else
			{
			$_consulta = pg_query("Select l.linha, l.nome_linha, l.empresa From linhas l " .
				"JOIN horarios h ON l.linha = h.linha " .
				"GROUP BY l.linha, l.nome_linha, l.empresa ORDER BY l.nome_linha");
			}
		echo "<option></option>";
			while( $_row = pg_fetch_assoc($_consulta) ){
				echo "<option value=\"{$_row['linha']}\">".utf8_encode($_row['nome_linha'])." - {$_row['linha']}</option>\n";
			}	
		}
		
	function muda_nome_linha()
	{
			$_consulta=pg_query("UPDATE linhas SET nome_linha = n.novo_nome FROM linhas_nomes n
								WHERE n.codlinha=linha AND n.dataref <= current_date");
	}
?>

<script language="JavaScript">
	//Redireciona para o site que monta a tabela de horarios
	//Passando o numero da linha como parametro	
	function jump(value) {
				window.open('PGHorarios.php?numero_linha='+value, '_blank');
		
	}
	//Atualiza a pagina enviando o id da empresa para 
	//Filtrar as linhas da empresa
	function empresa_selecionada(value){
		window.location = "seleciona_linha.php?empresa="+value;
	}
</script>
<body>
<link rel="stylesheet" type="text/css" href="estilos.css">
	<div align="center">
<?php   
echo "<tr>";
echo "<td>";
echo "<h3>SECRETARIA MUNICIPAL DE MOBILIDADE URBANA</h3>";
echo "</td>";
echo "</tr>";
echo "<p></p>";
//echo "<p><img src='http://www.pmf.sc.gov.br/brasao.jpg' width='200' height='174' /></p>";
echo "<tr>";
echo "<td>";
echo "<h2>QUADRO DE HOR&AacuteRIOS E ITINER&AacuteRIOS</h2>";
echo "</td>";
echo "</tr>";
muda_nome_linha();
 ?> 	
 
		<form name="horarios" method="get" action="seleciona_linha.php">
			<table border='2' bordercolor='#9ACD32' id="horarios_table">
				<tr>
					<td width="30%" align='right'><a class='smt'>Empresa:&nbsp;&nbsp;</a></td>
					<td width="70%" align='left'>
						<select name="numero_empresa" id="numero_empresa" onchange="empresa_selecionada(this.value);">
							<?php lista_empresas(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="30%" align='right'><a class='smt'>C&oacutedigo da Linha:&nbsp;&nbsp;</a></td>
					<td width="70%" align='left'>
						<select name="numero_linha" id="numero_linha" onchange="jump(this.value);">
							<?php lista_num_linhas(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="30%" align='right'><a class='smt'>Nome da Linha:&nbsp;&nbsp;</a></td>
					<td width="70%" align='left'>
						<select name="nome_linha" id="nome_linha" onchange="jump(this.value);">
							<?php lista_nome_linhas(); ?>
						</select>
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>