<?php   
session_start();

if(isset($_SESSION['resultado'])){
	echo $_SESSION['resultado'];
}

echo "<br> <br> <br> <br> <br> <br> <br> <br>";


if(isset($_SESSION['relatorio']) && isset($_SESSION['mostraRelatorio'])){

	if($_SESSION['mostraRelatorio'] == True){
		echo $_SESSION['relatorio'];
	}
	
}


/*
echo "<br> <br> <br> <br> ";

if(isset($_SESSION['mensagemEmail'])){
	echo $_SESSION['mensagemEmail'];
}
*/

?>

<!DOCTYPE html>
<html>
<head>
	<title>Resultado Questionario</title>
</head>
<body>

</body>
</html>
