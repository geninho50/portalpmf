<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
	ob_start();
	include "conecta.php";
	$id = $_POST["id"];
	$numero = $_POST["numero"];
	$data = $_POST["data"];
	$data=substr($data,6,4).'-'.substr($data,3,2).'-'.substr($data,0,2);
	$hora = $_POST["hora"];
	$placa = $_POST["placa"];
	$servico = $_POST["servico"];
	$numordem = $_POST["numordem"];
	$permissionario = str_replace("'","`",$_POST["permissionario"]);
	$fiscal = $_POST["fiscal"];
	$comunicado = $_POST["textarea"];	
	$prazo = $_POST["prazo"];
	$terminal = $_POST["terminal"];
	$status = $_POST["status"];
	session_start();
	$matricula = $_SESSION['matricula'];
//	echo $numero;
//	echo $data;
//	echo $hora;
//	echo $placa;
//	echo $servico;
//	echo $numordem;
//	echo $permissionario;
//	echo $fiscal;
//	echo $comunicado;
//	echo $prazo;
//	echo $terminal;
//	echo $status;
	if(!empty($comunicado))
	{
		if($id != "")
		{
			$sql = "UPDATE comunica SET numero = '$numero', datacom = '$data', hora = '$hora', placa = '$placa', servico = '$servico', numordem = '$numordem', ";
			$sql = $sql."permissionario = '$permissionario', fiscal = '$fiscal', comunicado = '$comunicado', prazo = '$prazo', terminal = '$terminal', status = '$status', ";
			$sql = $sql."encerrada_por = '$matricula' WHERE id = '$id'";
			//echo $sql;
			//exit;

		}
		else
		{
			$sql="INSERT INTO comunica (numero, datacom, hora, placa, servico, numordem, permissionario, fiscal, comunicado, prazo, terminal, status, encerrada_por) ";
			$sql=$sql."VALUES ($numero, '$data', '$hora', '$placa', '$servico', '$numordem', '$permissionario', '$fiscal', '$comunicado', '$prazo', '$terminal', '$status', '$matricula')";
			//echo $sql;
			//exit;
		}
		$resultado=pg_query($sql);
		if($resultado != FALSE)
		{
			$nreg=pg_affected_rows($resultado);
			if($nreg != FALSE)
			{
				if($nreg == 1)
				{
//					session_start();
					$_SESSION['msg']= utf8_encode('Comunicado incluído com sucesso!');
					echo "Comunicado incluído com sucesso!";
				}
			}
			else
			{
				echo pg_error();
			}
		}
	}
	header("Location: comunicalista.php?op=a");
?>
</html>