<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link rel="stylesheet" type="text/css" href="estilos.css">
<?php
require("conecta.php");
if(isset($_POST["cpf"]))
{
	$cpfform = $_POST["cpf"];
	$cpf = preg_replace("/[^0-9]/", "", $cpfform);
}
//echo $cpf;
$msg="";
if($cpf == null)
{
	$cpf = 0;
	$msg ='CPF inválido';
	mensagemfalhacpf($msg);
}
else
{
	$sql = "select id, condutornome from condutores where cpf = '$cpf'";
	$resultadocond=pg_query($sql);
	if($resultadocond != FALSE)
	{
		$linhascond=pg_num_rows($resultadocond);
		if($linhascond == 1)
		{
			$idcond = pg_result($resultadocond,0,"id");
			$nomecondutor = pg_result($resultadocond,0,"condutornome");
			$sql = "SELECT condutornome, nome, numordem, perm_condutores.servico as serv FROM condutores INNER JOIN perm_condutores ON condutores.id = perm_condutores.condutor ";
			$sql=$sql."INNER JOIN permissionarios ON perm_condutores.perm = permissionarios.id ";
			$sql=$sql."INNER JOIN perm_servicos ON perm_condutores.servico = perm_servicos.servico AND permissionarios.id = perm_servicos.perm_id ";
			$sql=$sql."WHERE (condutores.id='$idcond') AND (perm_condutores.dataini <= current_date) AND (perm_condutores.datafim is null) ";
			$sql=$sql."ORDER BY numordem";
			$resultado=pg_query($sql);
			
			//$sql = "select noordem, permissionario from vencimentos where pontotaxi = '$id_ponto' order by noordem";
			//$resultado=pg_query($sql);
			if($resultado != FALSE)
			{
				$linhas=pg_num_rows($resultado);
				//echo $linhas;
				echo "<p align='center'><font face='Verdana' size='2'><a href='condutorpermis.php'>Voltar</a></font></p>";
				echo "<a class='tit'><p align='center'>Condutor: ".utf8_encode($nomecondutor)."</p></a>";
				echo "<a class='tit'><p align='center'>CPF: ".utf8_encode($cpfform)."</p></a>";
				echo "<table align='center' border=4 bordercolor='#9ACD32'>";
				if($corfundo == "#EAE9DB")
				{
					$corfundo="#FFFFFF";
				}
				else
				{
					$corfundo="#EAE9DB";
				}
				echo "<tr bgcolor=$corfundo>";
				echo "<td align='center'><font face='verdana' size='1'><b>Servi&ccedilo </b></font></td>";
				echo "<td align='center'><font face='verdana' size='1'><b>N&ordm Ordem </b></font></td>";
				echo "<td align='center'><font face='verdana' size='1'><b>Permission&aacuterio </b></font></td>";
				echo "</tr>";
				for ($i=0; $i<$linhas; $i++)
				{
					$servico=pg_result($resultado,$i,"serv");
					$noordem=pg_result($resultado,$i,"numordem");
					$permissionario=pg_result($resultado,$i,"nome");
							
					if($corfundo == "#EAE9DB")
					{
						$corfundo="#FFFFFF";
					}
					else
					{
						$corfundo="#EAE9DB";
					}
					echo "<tr bgcolor=$corfundo>";
					echo "<td align='center'><font face='verdana' size='1'>$servico </td>";
					echo "<td align='center'><font face='verdana' size='1'>$noordem </td>";
					echo "<td align='center'><font face='verdana' size='1'>".utf8_encode($permissionario)."</td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "<p align='center'><font face='Verdana' size='2'><a href='condutorpermis.php'>Voltar</a></font></p>";
			}
			else
			{
				echo pg_error();
				$msg = 'CPF '.$cpfform.' inválido ou não cadastrado';
				mensagemfalhacpf($msg);
			}
		}
		else
		{
			$msg = 'CPF '.$cpfform.' inválido ou não cadastrado';
			mensagemfalhacpf($msg);
		}
	}
	else
	{
		echo pg_error();
		$msg ='CPF '.$cpfform.' inválido';
		mensagemfalhacpf($msg);
	}
}

function mensagemfalhacpf($msg)
{	
	echo "<a class='tit'><p align='center'>".utf8_encode($msg)."</p></a>";
	echo "<p align='center'><font face='Verdana' size='2'><a href='condutorpermis.php'>Voltar</a></font></p>";
}

?>
</html>
