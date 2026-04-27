<?php
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];

	$loginF = $_POST['login'];
	$conf  = $_POST['conf'];
	$idescala  = $_POST['idescala'];
	$data  = $_POST['data'];

   
   require ("../classes/DB_mysql.php");
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
   
   //Pega a data atual
   $data_atual = date("Y-m-d");
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m?s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
	
	$queryT = "SELECT id,semana,qtdhoras1,qtdhoras2,horainicial,horafinal,data,local,he, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM escalahoraextra where id=$idescala";
	$resultadoT = $obj->executaQuery($queryT);
	while ( $linhaT = mysql_fetch_array($resultadoT) )
	{	
		$localT = $linhaT['local'];
		$semanaT = $linhaT["semana"];
		$horainicial = $linhaT["horainicial"];
		$horafinal = $linhaT["horafinal"];
		$he = $linhaT["he"];
		$diaT = $linhaT['dia'];
		$mesT = $linhaT['mes'];
		$anoT = $linhaT['ano'];
		$data = $linhaT['data'];
		$qtdhoras1 = $linhaT['qtdhoras1'];
		$qtdhoras2 = $linhaT['qtdhoras2'];
	}
	$tamanho = strlen($conf);
	if(isset($conf)) {
  		foreach($conf as $loginF => $value){
			$query = "SELECT sum(hora1) as horat1,sum(hora2) as horat2 from listaescala where login='$value' and data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-12-31' group by login";
			$result = $obj->executaQuery($query);
			while($linha = mysql_fetch_array($result)){
				$somah1 = $linha['horat1'];
				//$mediaH1 = $hora1/$parametro;
				$somah1 = number_format( $somah1, 2, ".", "," );
				
				$somah2 = $linha['horat2'];
				//$mediaH2 = $hora2/$parametro;
				$somah2 = number_format( $somah2, 2, ".", "," );
							
				$queryT = "insert into tempescala(idescala,login,data,hora1,hora2,somah1,somah2,he) values($idescala,'$value','$data',$qtdhoras1,$qtdhoras2,$somah1,$somah2,$he);";
				$temp = $obj->executaQuery($queryT);
			}
		}
	}	

			
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<a href="montar_escala_he_media.php?idescala=<? echo $idescala;?>">Seguir</a></body>
</html>
