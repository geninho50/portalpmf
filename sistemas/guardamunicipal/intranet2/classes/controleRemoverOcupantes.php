<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>
<?php

	require ("DB_mysql.php");
	$obj = new DB_mysql();

//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");

	$idGuarnicao = $_POST['idGuarnicao'];
	$guarda1 = $_POST['xGM1_1'];
	$guarda2  = $_POST['GM1_2'];
	$guarda3  = $_POST['GM1_3'];
	$guarda4  = $_POST['GM1_4'];
	$guarda5  = $_POST['GM1_5'];
	$guarda5  = $_POST['GM1_5'];
	$vtr  = $_POST['yvtr'];
	$setor  = $_POST['setor'];
	$outros  = $_POST['youtros'];
	
	$guarda1Temp = $_POST['guarda1'];
	$guarda2Temp  = $_POST['guarda2'];
	$guarda3Temp  = $_POST['guarda3'];
	$guarda4Temp  = $_POST['guarda4'];
	$guarda5Temp  = $_POST['guarda5'];
	$vtr1Temp  = $_POST['vtr1'];
	$setor1Temp  = $_POST['setor1'];
	$outrosTemp  = $_POST['outros'];
	
	$sql = "SELECT * FROM vtr where vtr='$vtr'";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$id = $linha["id"]; 
		$idclasse = $linha["idclasse"];  
	}
	
	if( $vtr == 'A PE'){
		$idclasse=4;
	}else{
		if( $vtr == 'ADMINISTRATIVO'){
			$idclasse=5;
		}
	}

	$query = "update guarnicao set guarda1='$guarda1',guarda2='$guarda2',guarda3='$guarda3',guarda4='$guarda4',guarda5='$guarda5', vtr='$vtr', setor='$setor', outros='$outros', idclassevtr=$idclasse where id=$idGuarnicao";
	$obj->executaQuery($query);
	$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Guarnicao $guarda1Temp $guarda2Temp $guarda3Temp $guarda4Temp $guarda5Temp $vtr1Temp $setor1Temp $outrosTemp substuida pela guarnicao $guarda1 $guarda2 $guarda3 $guarda4 $guarda5 $vtr $setor $outros')";
	$obj->executaQuery($queryA);
	$queryV = "update vtr set status=0 where vtr='$vtr1Temp'";
	$obj->executaQuery($queryV);
	$queryVT = "update vtr set status=1 where vtr='$vtr'";
	$obj->executaQuery($queryVT);
	
	echo "<script>alert('Remocao realizada com sucesso!');</script>";                       

   $obj->closeVar($query);      
   $obj->closeQuery();
   $obj->closeConexaoGeral();
?>