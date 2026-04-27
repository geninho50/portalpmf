<?php
	$gm = $_POST['xguarda'];
	$data_inicial = $_POST['xdata_inicial'];
	$data_final = $_POST['xdata_final'];
	$atividade = $_POST['yatividade'];
	
	require ("DB_mysql.php");
	$obj = new DB_mysql;

	$arrayData = explode("-",$data_inicial);
	$mesi = $arrayData[1];

	if($atividade==1){
		if($mesi==1){
			$valor=12;
		}if($mesi==2){
			$valor=11;
		}if($mesi==3){
			$valor=10;
		}if($mesi==4){
			$valor=4;
		}if($mesi==5){
			$valor=3;
		}if($mesi==6){
			$valor=6;
		}if($mesi==7){
			$valor=7;
		}if($mesi==8){
			$valor=1;
		}if($mesi==9){
			$valor=2;
		}if($mesi==10){
			$valor=5;
		}if($mesi==11){
			$valor=8;
		}if($mesi==12){
			$valor=9;
		}	
	}
		$queryU = "select * from usuario where login='$gm'";
		$resultadoU = $obj->executaQuery($queryU);
		if ($linhaU=mysql_fetch_array($resultadoU))
		{
			$grupo = $linhaU['grupo'];
			$soma = $linhaU['soma'];
			$somaTemp = $soma+$valor;
		}
	
	$nova_data = implode("-",array_reverse(explode("-",$data_inicial)));
    // Explode a barra e retorna tr�s arrays
 	$data = explode("-", $nova_data);
 	//Cria tr�s vari�veis $ano $mes $dia
 	list($dia, $mes, $ano) = $data;
	// Recria a data invertida
 	$data = "$ano-$mes-$dia";
	
	$time_inicial = strtotime($data_inicial);
	$time_final = strtotime($data_final);
	// Calcula a diferen�a de segundos entre as duas datas:
	$diferenca = $time_final - $time_inicial; // 19522800 segundos
	// Calcula a diferen�a de dias
	$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
	$meses = ceil($dias/30);
 	if($meses==0){
		$meses=1;
	}
	$i=0;
 	while($i < $meses)
 	{
    	$data = date("Y-m-d",mktime(date("H"),date("i"),date("s"),$mes,$dia,$ano));
    	$mes = $mes+1;
		$i=$i+1;
		$queryI = "INSERT INTO ferias (login,grupo, ponto, data_inicial,data_final,atividade) values ('$gm','$grupo','$valor','$data','$data_final','$atividade')";
		$obj->executaQuery($queryI);
	} 
	$query = "UPDATE usuario set soma=(soma+$valor),ordenar=$somaTemp,data_inicial='$data_inicial',data_final='$data_final',atividade=$atividade where login='$gm'";	
	$obj->executaQuery($query);
	
	echo "<script>alert('Inserido com sucesso!');</script>";                       
	echo "<script> window.location.href = '../controle/controle_ferias.php' </script>";	
	
	// Fechando as vari�veis
	$obj->closeVar($id);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>