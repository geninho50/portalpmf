<?php 
	require_once("../../valida_session.php");
	require_once("../../../scripts/php/funcoes_bd.php"); 
	require_once("../../../scripts/php/config.php");	

	$titulo = $_POST['Ftitulo'];
	$ano = $_POST['Fano'];
	$mes = $_POST['Fmes'];
	$pdf = $_FILES['Farquivo'];
	$anoAtual = intval( Date('Y') );
	$uploaddir = '../../../ouvidoria/pdf/';

	if(trim($titulo) == ''){
		header("location: http://www.pmf.sc.gov.br/intranet/inicio.php?pagina=RelOuvCad&menu=13&msg=1"); 
		die;
	}

	if( intval( $ano ) > $anoAtual){
		header("location: http://www.pmf.sc.gov.br/intranet/inicio.php?pagina=RelOuvCad&menu=13&msg=2"); 
		die;
	}

	if( $_FILES['Farquivo']['type'] != 'application/pdf' ){
		header("location: http://www.pmf.sc.gov.br/intranet/inicio.php?pagina=RelOuvCad&menu=13&msg=3"); 
		die;
	}
	$nome_arquivo = $titulo . $mes . $ano . ".pdf";
	$nome_arquivo = str_replace(' ', '', $nome_arquivo);
	
	$uploadfile = $uploaddir . $nome_arquivo;

	if (move_uploaded_file($_FILES['Farquivo']['tmp_name'], $uploadfile)) {
		$drive->conecta();

		$sql = "INSERT INTO relatorios_ouvidoria (arquivo, titulo, mes, ano) VALUES ('$nome_arquivo', '$titulo', '$mes', '$ano')";

		$Tresult = $drive->pedido($sql);

		if($Tresult == true){
			header("location: http://www.pmf.sc.gov.br/intranet/inicio.php?pagina=RelOuvCad&menu=13&msg=0"); 
			die;
		} else {
		   header("location: http://www.pmf.sc.gov.br/intranet/inicio.php?pagina=RelOuvCad&menu=13&msg=404"); 
		   die;
		}
	}
	
	?>