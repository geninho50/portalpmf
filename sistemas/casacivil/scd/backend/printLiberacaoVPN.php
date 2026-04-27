<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include "db.php";
include "funcoes.php";
session_start();
$id = $_SESSION['id'];


/*
if($id){
	$sql = $db->prepare("SELECT * FROM liberacaovpn where id = $id");
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);
	
	
	
	define('MPDF_PATH', 'MPDF56/');
	include(MPDF_PATH.'mpdf.php');

	$mpdf=new mPDF("", "", 0, "", 15,15,45,16,10,40,"l");
	
	$HeaderContent = file_get_contents('../headerVPN.php');
	$mpdf-> SetHTMLHeader($HeaderContent, "EVEN", "true");
	$htmlContent = file_get_contents('../parteCimaVPN.php');
	$htmlContent .= file_get_contents('../dadosVPN.php');
	$htmlContent .= file_get_contents('../documentoVPN.php');
	$htmlContent .= file_get_contents('../assVPN.php');
	
	$data['nomeInstituicao'] = utf8_encode ( $data['nomeInstituicao'] );
	$data['entidade'] = utf8_encode ( $data['entidade'] );
	$data['nome'] = utf8_encode ( $data['nome'] );
	$data['naturalidade'] = utf8_encode ( $data['naturalidade'] );
	$data['email'] = utf8_encode ( $data['email'] );
	$data['matricula'] = utf8_encode ( $data['matricula'] );
	$data['outrosDados'] = utf8_encode ( $data['outrosDados'] );
	$data['motivo'] = utf8_encode ( $data['motivo'] );	
	
	$data_atual = date('Y-m-d');

	$data_atual = explode("-", $data_atual);
	$mes_escrito = mesEscrito($data_atual[1]);
	
	$htmlContent = str_replace("<DIA>",$data_atual[2],$htmlContent);
	$htmlContent = str_replace("<MES>",$mes_escrito,$htmlContent);
	$htmlContent = str_replace("<ANO>",$data_atual[0],$htmlContent);

	$htmlContent = str_replace("<NOME_INSTITUICAO>",$data['nomeInstituicao'],$htmlContent);
	$htmlContent = str_replace("<RAZAO_SOCIAL>",$data['entidade'],$htmlContent);
	$htmlContent = str_replace("<NOME_FUNCIONARIO>",$data['nome'],$htmlContent);
	$htmlContent = str_replace("<CPF>",$data['cpf'],$htmlContent);
	
	$nova_data = explode("-", $data['dataNasc']);
	$data['dataNasc'] = "$nova_data[2]/$nova_data[1]/$nova_data[0]";	
	
	$htmlContent = str_replace("<NASCIMENTO>",$data['dataNasc'],$htmlContent);
	$htmlContent = str_replace("<NATURALIDADE>",$data['naturalidade'],$htmlContent);
	$htmlContent = str_replace("<TELEFONE>",$data['telefone'],$htmlContent);
	$htmlContent = str_replace("<CNPJ>",$data['cnpj'],$htmlContent);
	$data['uf'] = estado($data['uf']);
	
	$htmlContent = str_replace("<UF>",$data['uf'],$htmlContent);
	$htmlContent = str_replace("<EMAIL>",$data['email'],$htmlContent);
	$htmlContent = str_replace("<MATRICULA>",$data['matricula'],$htmlContent);
	$htmlContent = str_replace("<IP>",$data['ip'],$htmlContent);	
	if ($data['outrosDados'] == ''){
		$data['outrosDados'] = 'Não informado';
	}
	
	if ($data['motivo'] == ''){
		$data['motivo'] = 'Não informado';
	}
	
	$htmlContent = str_replace("<DADOS_ADD>",$data['outrosDados'],$htmlContent);
	$htmlContent = str_replace("<MOTIVO>",$data['motivo'],$htmlContent);

	
	$mpdf->WriteHTML($htmlContent);
	$mpdf->Output();
	
}else{
	*/
	header('Location: ../preenchimentoIP.php');
// }

die;




