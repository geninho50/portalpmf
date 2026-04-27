<?php

include "backend/db.php";
include "backend/funcoes.php";

$sql = $db->prepare("SELECT * FROM servidoreswindows");
$sql->execute();
$data = $sql->fetchALL(PDO::FETCH_ASSOC);

$tabela = '';

for($i = 0; $i < sizeof($data); $i++){
	$tabela .= "<tr>";
		$tabela .= "<td>";		
			$tabela .= $i+1;
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['name_vm'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['ip'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['disco'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['os'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['memoria'];
		$tabela .= "</td>";			
		$tabela .= "<td>";		
			$tabela .= $data[$i]['core'];
		$tabela .= "</td>";	
		$tabela .= "<td>";		
			$tabela .= $data[$i]['host_name'];
		$tabela .= "</td>";
	$tabela .= "</tr>";
}

$html = '<!DOCTYPE html>';
$html .= '<html>';
$html .= '<head>';
$html .= '	<meta charset="utf-8">';
$html .= '	<meta http-equiv="X-UA-Compatible" content="IE=edge">';
$html .= '	<meta name="viewport" content="width=device-width, initial-scale=1">';
$html .= '	<link rel="stylesheet" type="text/css" href="estilo.css" />';
$html .= '	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">';
$html .= '	<title>Lista de Servidores Windows</title>';
$html .= '</head>';
$html .= '<body>';
$html .= '	<h2 class="text-center">Tabela Servidores Windows</h2>';
$html .= '	<div class="tabelaServidor">';
$html .= '	<table class="table table-striped table-bordered table-condensed">';
$html .= '		<tr>';
$html .= '			<th>#</th>';
$html .= '			<th>Name VM (CIASC)</th>';
$html .= '			<th>IP Address</th>';
$html .= '			<th>DISCO</th>';
$html .= '			<th>OS</th>';
$html .= '			<th>Memoria</th>';
$html .= '			<th>CORE</th>';
$html .= '			<th>Host Name</th>';
$html .= '		</tr>';
$html .= 	$tabela;
$html .= '	</table>';
$html .= '	</div>';
$html .= '</body>';
$html .= '</html>';

include('backend/MPDF56/mpdf.php');
$mpdf=new mPDF('utf-8', 'A4-L');
$mpdf-> SetHTMLHeader($HeaderContent, "EVEN", "true");
$mpdf->WriteHTML($html);
$mpdf->Output();

?>