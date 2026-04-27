<?php   


include_once("gdb.php");
$gdb = new gdb();
$gdb2 = new gdb();
$gdb3 = new gdb();


$gdb->open("SELECT * FROM suporteStm.registraDataHoraFiscal ORDER BY ID_MODULO");




?>
<!DOCTYPE html>
<html>
<head>
	<title>Usuários Fiscalização</title>
	<style type="text/css">
		table,th,td{
			border:1px solid black;
		}
	</style>
</head>
<body>
	<h2>Lista de usuários que interagiram com o Ambiente de Aprendizagem da fiscalização:</h2>
	<table style="border:1px solid black;">
		<tr class="header">
			<td>Nome</td>
			<td>Módulo</td>
			<td>Status</td>
			<td>Nota(s)</td>
		</tr>
		<?php
		for($i = 0; $i < count($gdb->gs['ID']); $i++){

			$idUser = $gdb->gs['ID_USUARIO'][$i];
			$modulo = $gdb->gs['ID_MODULO'][$i];

			if($idUser != '25'){
				$gdb2->open("SELECT * FROM suporteStm.usuarioFiscalizacao WHERE ID ='".$idUser."'");

				echo "<tr>";
				
				//echo "<td>".$gdb->gs['ID_USUARIO'][$i]."</td>";
				echo "<td>".$gdb2->gs['NOME_FISCAL'][0]."</td>";
				echo "<td>".$modulo."</td>";

				$situacaoGbd = $gdb->gs['SITUACAO'][$i];
				$situacao ="";
				if($situacaoGbd == "1"){
					$situacao .= "Iniciado";
					echo "<td>".$situacao."</td>";
				}else if($situacaoGbd == "2"){
					$situacao .= "Completado";
					echo "<td style='color:green'>".$situacao."</td>";
				}else if($situacaoGbd == "3"){
					$situacao .= "Falho";
					echo "<td style='color:red'>".$situacao."</td>";
				}
				
				$gdb3->open("SELECT * from suporteStm.questionarioFiscalizacao where ID_USUARIO = '".$idUser."' and ID_MODULO ='".$modulo."'");

				$notas = "";

				
				for($j = 0; $j < count($gdb3->gs['ID']); $j++){
					$notas .= $gdb3->gs['PONTUACAO'][0].", ";

				}
				

			
				echo "<td>".$notas."</td>";
				echo "</tr>";
			}
		}

		?>
	</table>
</body>
</html>
