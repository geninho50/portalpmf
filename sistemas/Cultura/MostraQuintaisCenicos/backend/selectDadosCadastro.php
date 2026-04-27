<?php
require_once "backend/db.php";



$ordem = $_GET['ordem'];
	switch ($ordem) {
		case 'nome':
			$ordernar = 'nome';
			break;
		default:
			$ordernar = 'id';
			break;
}

$sql = $db->prepare("SELECT * FROM dadosCadastro ORDER BY id");
$sql->execute();
$data = $sql->fetchALL(PDO::FETCH_ASSOC);
$caminho = "./Pdfs/";

$tabela = '';


for($i = 0; $i < sizeof($data); $i++){
	$tabela .= "<tr>";		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['id']);
		$tabela .= "</td>";	

		$tabela .= "<td>";		
		if(utf8_encode($data[$i]['tipo']) == 1){
			$tabela .= "Mostra Oficial";
		}else{
			$tabela .= "Cena Universitaria";
		}
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['nome']);
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['cnpj']);
		$tabela .= "</td>";
		
		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['endereco']);
		$tabela .= "</td>";
		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['cidade']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['bairro']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['cep']);
		$tabela .= "</td>";
		
		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['telefone']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['email']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['responsavel']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['cpfResponsa']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['produtor']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['foneProd']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['foneProdCel']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['emailProd']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['espetaculo']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['autor']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['direcao']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['cenografia']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['iluminacao']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['figurino']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['maquiagem']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['tempoDuracao']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['tempoMontagem']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['TempoDesmonta']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['genero']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
		switch (utf8_encode($data[$i]['categoria'])){
					case "1":
						$tabela .= "Adulto";
						break;
					case "2":
					   $tabela .= "Infantojuvenil";
						break;
					case "3":
					   $tabela .= "Rua";
						break;
					default: 
					 $tabela .= utf8_encode($data[$i]['categoria']);
					  break;
					}
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['idadeIJ']);
		$tabela .= "</td>";													

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['idadeA']);
		$tabela .= "</td>";	

		$tabela .= "<td>";		
		if(utf8_encode($data[$i]['possibi']) == 1){
			$tabela .= "sim";
		}else{
			$tabela .= "não";
		}
		$tabela .= "</td>";

		$tabela .= "<td>";	
		switch (utf8_encode($data[$i]['espacoEncena'])){
					case "2":
						$tabela .= "Palco italiano";
						break;
					case "11":
					   $tabela .= "Rua";
						break;
					case "23":
					   $tabela .= "Lona";
						break;
					case "41":
					   $tabela .= "Outros";
						break;
					case "13":
					   $tabela .= "Palco Italiano e Rua";
						break;
					case "25":
					   $tabela .= "Palco Italiano e Lona";
						break;
					case "43":
					   $tabela .= "Palco Italiano e Outros";
						break;
					case "36":
					   $tabela .= "Palco Italiano, Rua e Lona";
						break;
					case "34":
					   $tabela .= "Rua e Lona";
						break;
					case "52":
					   $tabela .= "Rua e Outros";
						break;
					case "64":
					   $tabela .= "Lona e Outros";
						break;
					case "75":
					   $tabela .= "Rua, Lona e Outros";
						break;
					case "66":
					   $tabela .= "Palco Italiano, Lona e Outros";
						break;	
					case "77":
					   $tabela .= "Palco Italiano, Rua, Lona e Outros";
						break;
					default: 
					 $tabela .= utf8_encode($data[$i]['espacoEncena']);
					  break;

		}
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['citarOutros']);
		$tabela .= "</td>";

		$tabela .= "<td width='20'>";		
			$tabela .= utf8_encode($data[$i]['sinopseEspeta']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['medidasPalcoBoca']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['medidasPalcoBocaMin']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['profundidade']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['profundidadeMin']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['numeroPessoas']);
		$tabela .= "</td>";

		$tabela .= "<td>";		
			$tabela .= utf8_encode($data[$i]['siteBlog']);
		$tabela .= "</td>";

		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['linksVideo']);
		$tabela .= "</td>";			

		$tabela .= "<td>";		
			$tabela .= "<a href ='".utf8_encode($caminho.$data[$i]['id']."_".$data[$i]['link_historico_grupo'])."'  target='_blank' >Hist&oacute;rico Grupo</a>";
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= "<a href='".utf8_encode($caminho.$data[$i]['id']."_".$data[$i]['link_curriculo_grupo'])."' target='_blank' >Curr&iacute;culo Grupo</a>";
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= "<a href='".utf8_encode($caminho.$data[$i]['id']."_".$data[$i]['link_curriculo_direcao'])."' target='_blank' >Curr&iacute;culo Dire&ccedil;&atilde;o</a>";
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= "<a href='".utf8_encode($caminho.$data[$i]['id']."_".$data[$i]['link_fotos'])."' target='_blank' >Fotos</a>";
		$tabela .= "</td>";			

		$tabela .= "<td>";		
			$tabela .= "<a href='".utf8_encode($caminho.$data[$i]['id']."_".$data[$i]['link_mapa_iluminacao'])."' target='_blank' >Mapa Ilumina&ccedil;&atilde;o</a>";
		$tabela .= "</td>";	

		$tabela .= "<td>";		
			$tabela .= "<a href='".utf8_encode($caminho.$data[$i]['id']."_".$data[$i]['link_mapa_sonorizacao'])."' target='_blank' >Mapa Sonoriza&ccedil;&atilde;o</a>";
		$tabela .= "</td>";	


}

?>
