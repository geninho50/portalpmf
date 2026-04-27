<?php

include "db.php";
include "funcoes.php";
session_start();
$id = $_SESSION['id'];



if($id){
	$sql = $db->prepare("SELECT * FROM liberacaoip where id = $id");
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);
	
	
	
	define('MPDF_PATH', 'MPDF56/');
	include(MPDF_PATH.'mpdf.php');
	$mpdf=new mPDF("", "", 0, "", 15,15,45,16,10,40,"l");
	$HeaderContent = file_get_contents('../headerIP.php');
	$mpdf-> SetHTMLHeader($HeaderContent, "EVEN", "true");
	$htmlContent = file_get_contents('../parteCimaIp.php');
	$htmlContent .= file_get_contents('../dadosIP.php');
	$htmlContent .= file_get_contents('../documentoLiberacaoIp.php');
	$htmlContent .= file_get_contents('../assIP.php');
	
	$data['nome']  = utf8_decode ( $data['nome'] );
	$data['setor'] = utf8_decode ( $data['setor'] );
	$data['secretaria'] = utf8_decode ( $data['secretaria'] );
	$data['rg'] = utf8_decode ( $data['rg'] );
	$data['matricula'] = utf8_decode ( $data['matricula'] );
	
	$data_atual = date('Y-m-d');

	$data_atual = explode("-", $data_atual);
	$mes_escrito = mesEscrito($data_atual[1]);
	$htmlContent = str_replace("<DIA>",$data_atual[2],$htmlContent);
	$htmlContent = str_replace("<MES>",$mes_escrito,$htmlContent);
	$htmlContent = str_replace("<ANO>",$data_atual[0],$htmlContent);
	$htmlContent = str_replace("<NOME>",$data['nome'],$htmlContent);
	$htmlContent = str_replace("<NOMEUSUARIO>",$data['nome'],$htmlContent);
	$htmlContent = str_replace("<SETOR>",$data['setor'],$htmlContent);
	$htmlContent = str_replace("<SECRETARIA>",$data['secretaria'],$htmlContent);
	$htmlContent = str_replace("<CPF>",$data['cpf'],$htmlContent);
	$htmlContent = str_replace("<IDENTIDADE>",$data['rg'],$htmlContent);
	$htmlContent = str_replace("<MATRICULA>",$data['matricula'],$htmlContent);
	$htmlContent = str_replace("<TELEFONE>",$data['telefone'],$htmlContent);
	$htmlContent = str_replace("<IP>",$data['ip'],$htmlContent);
	$mpdf->WriteHTML($htmlContent);
	$mpdf->Output();
	
}else{
	header('Location: ../preenchimentoIP.php');
}

die;




