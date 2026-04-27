<?
include "db.php";
include "funcoes.php";
session_start();
$cpf = $_SESSION['cpf'];

if($cpf){
	$sql = $db->prepare("SELECT * FROM certificacaodigital where cpf = '$cpf'");
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);
	
	define('MPDF_PATH', 'MPDF56/');
	include(MPDF_PATH.'mpdf.php');
	$mpdf=new mPDF("", "", 0, "", 10,10,10,0,10,10,"l");

	$htmlContent = file_get_contents('documento.php');

	$data['nascimento'] = explode('-', $data['nascimento']);
	$data['nascimento'] = $data['nascimento'][2].'/'.$data['nascimento'][1].'/'.$data['nascimento'][0];
	
	$htmlContent = str_replace("<NOME>",$data['nome'],$htmlContent);
	$htmlContent = str_replace("<NASCIMENTO>",$data['nascimento'],$htmlContent);
	$htmlContent = str_replace("<ESTADORG>",$data['estadoRg'],$htmlContent);
	$htmlContent = str_replace("<RG>",$data['rg'],$htmlContent);
	$htmlContent = str_replace("<ORGAO>",$data['orgao'],$htmlContent);
	$htmlContent = str_replace("<CPF>",$data['cpf'],$htmlContent);
	$htmlContent = str_replace("<PIS>",$data['pis'],$htmlContent);
	$htmlContent = str_replace("<CEI>",$data['cei'],$htmlContent);
	$htmlContent = str_replace("<TITULO>",$data['titulo'],$htmlContent);
	$htmlContent = str_replace("<ZONA>",$data['zona'],$htmlContent);
	$htmlContent = str_replace("<SECAO>",$data['secao'],$htmlContent);
	$htmlContent = str_replace("<CIDADE>",$data['cidade'],$htmlContent);
	$htmlContent = str_replace("<ESTADOTITULO>",$data['estadoTitulo'],$htmlContent);
	$htmlContent = str_replace("<EMAIL>",$data['email'],$htmlContent);
	
	$stylesheet = file_get_contents('estilosPDF.css');
	$mpdf->WriteHTML($stylesheet,1);

	$arquivo ='Certificado Digital '.$data['nome'].'.pdf';
	$mpdf->WriteHTML($htmlContent);
	$mpdf->Output($arquivo,'I');

}else{
	header('Location: certificacaoDigital.php');
}

die;




