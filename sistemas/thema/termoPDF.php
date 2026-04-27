<?
include "backend/db.php";
include "backend/funcoes.php";
session_start();
$id =  $_SESSION['id'];

if($id){
	$sql = $db->prepare("SELECT * FROM thema where id = $id");
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);

	
	include('backend/MPDF56/mpdf.php');
	$mpdf=new mPDF("", "", 0, "", 15,15,45,16,10,40,"l");
	$HeaderContent = file_get_contents('header.php');
	$mpdf-> SetHTMLHeader($HeaderContent, "EVEN", "true");
	$htmlContent = file_get_contents('parteCima.php');
	$htmlContent .= file_get_contents('dados.php');
	$htmlContent .= file_get_contents('documentoLiberacao.php');
	$htmlContent .= file_get_contents('ass.php');
	
	$data['nome']     = ( $data['nome'] );
	$data['orgao']    = ( $data['orgao'] );
	$data['telefone'] = ( $data['telefone'] );
	$data['cpf']      = ( $data['cpf'] );
	
	$data_atual = date('Y-m-d');

	$data_atual  = explode("-", $data_atual);
	$mes_escrito = mesEscrito($data_atual[1]);
	$htmlContent = str_replace("<DIA>",$data_atual[2],$htmlContent);
	$htmlContent = str_replace("<MES>",$mes_escrito,$htmlContent);
	$htmlContent = str_replace("<ANO>",$data_atual[0],$htmlContent);
	$htmlContent = str_replace("<NOME>",$data['nome'],$htmlContent);
	$htmlContent = str_replace("<SECRETARIA>",$data['orgao'],$htmlContent);
	$htmlContent = str_replace("<CPF>",$data['cpf'],$htmlContent);
	$htmlContent = str_replace("<TELEFONE>",$data['telefone'],$htmlContent);
	$mpdf->WriteHTML($htmlContent);
	$mpdf->Output();
}else{
	header('Location: cadastro.php');
}
die;




