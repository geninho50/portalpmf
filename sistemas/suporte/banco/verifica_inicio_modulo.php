<?php



include_once("gdb.php");
$gdb = new gdb();
$gdb2 =  new gdb();

//Situação: 0 nao iniciado, 1 iniciado, 2 completado, 3 falho

$gdb->open("SELECT * FROM suporteStm.registraDataHoraFiscal WHERE ID_MODULO = ".($_POST["modulo"]-1)." AND ID_USUARIO = ".$_POST["idUsuario"]." LIMIT 1"); // gbd que verifica se o modulo anterior foi completado

$gdb2->open("SELECT * FROM suporteStm.registraDataHoraFiscal WHERE ID_MODULO = ".($_POST["modulo"])." AND ID_USUARIO = ".$_POST["idUsuario"]." LIMIT 1");// gbd2 que verifica se o modulo atual está valido
	
if($_POST["modulo"] == 5){ // !!!!!PLACEHOLDER APENAS, MODULO EM CONSTRUCAO!!!! PREVINE QUE USERS INICIEM O MODULO DETERMINADO
echo 1;
}else if(($gdb->gs["SITUACAO"][0] !=2  || $gdb->linhas==0) && $_POST["modulo"] !=1){// como o modulo 1 é o primeiro, nao ha como verificar o modulo antes dele

		echo 1; // nao completou modulo anterior

}else if($gdb2->gs["SITUACAO"][0] == 2){ // modulo já completado

	echo 2;

}else if($gdb2->gs["SITUACAO"][0] == 3){ // falhou modulo


		$dataInicioFalha = $gdb2->gs['DATA_FALHA'][0];

		$prazo= $gdb2->gs['PRAZO_FALHA'][0];

	 
		//Convert it into a timestamp.
		$prazo = strtotime($prazo);
		$dataInicioFalha = strtotime($dataInicioFalha);
		 
		//Get the current timestamp.
		$now = time();
		 
		//Calculate the difference.
		$difference = $prazo - $now;
		 
		//Convert seconds into days.
		$days = floor($difference / (60*60*24) );

		//$resultado = "Data Inicio: ".date("d-m-Y",$dataInicioFalha).", Prazo: ".date("d-m-Y",$prazo)." (".$days." dia(s))";


		if($days>=0){
			echo "CONTATE O GERENTE. VOCÊ PODERÁ REFAZER O MÓDULO DENTRO DE ".$days." DIAS"; //modulo FALHO
		}else{


		$gdb->open("UPDATE suporteStm.registraDataHoraFiscal SET SITUACAO = 0 , DATA_FALHA = NULL , PRAZO_FALHA = NULL  WHERE ID_MODULO = ".($_POST["modulo"])." AND ID_USUARIO = ".$_POST["idUsuario"]);
			echo 0; // nao começou modulo, mas tem acesso a ele
			
		}
		
		
}else{


	$sql = "SELECT * FROM suporteStm.registraDataHoraFiscal WHERE ID_MODULO = ".$_POST["modulo"]." AND ID_USUARIO = ".$_POST["idUsuario"]." LIMIT 1";


	$result=$gdb->open($sql);


	if($gdb->linhas == 1){
		/*
		$dataInicio = date($gdb->gs['DATA_HORA'][0]);
		$dataFinal = date($gdb->gs['PRAZO'][0]);
		$hoje = date("Y-m-d H:m:s");
		echo ($dataInicio->format('d-m-Y'));
		*/

		$dataInicio = $gdb->gs['DATA_HORA'][0];

		$prazo= $gdb->gs['PRAZO'][0];
	 
		//Convert it into a timestamp.
		$prazo = strtotime($prazo);
		$dataInicio = strtotime($dataInicio);
		 
		//Get the current timestamp.
		$now = time();
		 
		//Calculate the difference.
		$difference = $prazo - $now;
		 
		//Convert seconds into days.
		$days = floor($difference / (60*60*24) );

		$resultado = "Data Inicio: ".date("d-m-Y",$dataInicio).", Prazo: ".date("d-m-Y",$prazo)." (".$days." dia(s))";


		echo $resultado;

		/*
		if($days<=0){

			$gdb->open("UPDATE suporteStm.registraDataHoraFiscal SET SITUACAO = 3 , DATA_FALHA = NULL , PRAZO_FALHA = NULL  WHERE ID_MODULO = ".($_POST["modulo"])." AND ID_USUARIO = ".$_POST["idUsuario"]);
			echo "CONTATE O GERENTE. VOCÊ PODERÁ REFAZER O MÓDULO DENTRO DE ".$days." DIAS"; //modulo FALHO


		}else{

		 
		echo $resultado; // ja comecou modulo, manda a resposta com o prazo 
		}
		*/
	}else{
		echo 0; // nao começou modulo, mas tem acesso a ele
	}
}
?>

