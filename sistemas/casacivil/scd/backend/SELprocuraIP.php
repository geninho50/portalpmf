<?php

include "db.php";

$campo = $_POST['campo'];

	$sql = $db->prepare("SELECT * FROM scd.liberacaoip 
						 WHERE nome LIKE '%$campo%' or secretaria LIKE '%$campo%' or secretaria LIKE '%$campo%' order by id DESC");
	$sql->execute();
	$data = $sql->fetchALL(PDO::FETCH_ASSOC);
	$tabela = '<tr>
					<th>Status</th>
	  				<th class="nomeTabela">Nome</th>
	  				<th>Setor</th>
	  				<th>Função</th>
	  				<th>Telefone</th>
	  				<th>Ver Mais</th>
	  			</tr>';

	for($i = 0; $i < sizeof($data); $i++){
			switch ( $data[$i]['liberacao'] ) {
				case 0:
					$tabela .= "<tr class='danger'>";
					$tabela .= "<td>";
					$tabela .= "Aguardando";
					break;
				case 1:
					$tabela .= "<tr class='warning'>";
					$tabela .= "<td>";
					$tabela .= "aprovado";
					break;
				case 2:
					$tabela .= "<tr class='active'>";
					$tabela .= "<td>";
					$tabela .= "cancelado";
					break;
				case 3:
					$tabela .= "<tr class='success'>";
					$tabela .= "<td>";
					$tabela .= "finalizado";
					break;
			}
			$tabela .= "<td>";		
				$tabela .= utf8_decode($data[$i]['nome']);
			$tabela .= "</td>";	
			$tabela .= "<td>";		
				$tabela .= utf8_decode($data[$i]['secretaria']);
			$tabela .= "</td>";	
			$tabela .= "<td>";		
				$tabela .= utf8_decode($data[$i]['setor']);
			$tabela .= "</td>";	
			$tabela .= "<td>";		
				$tabela .= $data[$i]['telefone'];
			$tabela .= "</td>";	
			
			if($liberacao != 2){
				$tabela .= "<td>";		
				$id = $data[$i]['id'];
				$tabela .= "<input type='button' value='Ver mais' id=$id class='botaoVerMais btn btn-primary btn-xs' onCLick=verMais($id)>";
				$tabela .= "</td>";		
			}
			$tabela .= "</tr>";
	}

if($data != ''){
	echo json_encode(array('success' => 1, 'resultado' => $tabela));
}
?>
