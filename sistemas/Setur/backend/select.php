<?php
require_once "db.php";



$ordem = $_GET['ordem'];
	switch ($ordem) {
		case 'nome':
			$ordernar = 'nome';
			break;
		default:
			$ordernar = 'id';
			break;
}

$sql = $db->prepare("SELECT * FROM setur ORDER BY id");
$sql->execute();
$data = $sql->fetchALL(PDO::FETCH_ASSOC);
$tabela = '';


for($i = 0; $i < sizeof($data); $i++){
	$tabela .= "<tr>";		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['id']);
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['nome']);
		$tabela .= "</td>";	


		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['dataNasc']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['rg']);
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['cpf']);
		$tabela .= "</td>";	


		$tabela .= "<td>";		
		if(utf8_encode($data[$i]['genero']) == 1){
			$tabela .= "Masculino";
		}else{
			$tabela .= "Feminino";
		}
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['rua']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['numero']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['bairro']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['cep']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
		switch (utf8_encode($data[$i]['escolaridade'])){
					case "1":
						$tabela .= "2° Grau Completo";
						break;
					case "2":
					   $tabela .= "2° Grau Incompleto ";
						break;
					case "3":
					   $tabela .= "Superior Completo";
						break;
					case "4":
					   $tabela .= "Superior Incompleto";
						break;
					default: 
					 $tabela .= utf8_encode($data[$i]['escolaridade']);
					  break;
					}
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['email']);
		$tabela .= "</td>";													

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['telefone']);
		$tabela .= "</td>";	

		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['celular']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
		if(utf8_encode($data[$i]['profissional']) == 1){
			$tabela .= "Sim";
		}else{
			$tabela .= "Não";
		}
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['qual']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
		if(utf8_encode($data[$i]['ctps']) == 1){
			$tabela .= "Sim";
		}else{
			$tabela .= "Não";
		}
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['area']);
		$tabela .= "</td>";	


}

?>
