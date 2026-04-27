<?php

	include_once("conexao.php");
	
	//$dados = $_FILES['arquivo'];
	//var_dump($dados);
	
	if(!empty($_FILES['arquivo']['tmp_name'])){
		$arquivo = new DomDocument();
		$arquivo->load($_FILES['arquivo']['tmp_name']);
		//var_dump($arquivo);
		
		$linhas = $arquivo->getElementsByTagName("Row");
		//var_dump($linhas);
		
		$primeira_linha = true;
		
		foreach($linhas as $linha){
			if($primeira_linha == false){
                $id_linha = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
				$id_plano = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
				$sentido = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
				$horario = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
				$horario=date("H:i", strtotime($horario));
				$complemento= $linha->getElementsByTagName("Data")->item(4)->nodeValue;
				

				echo "
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Linha</th>
							<th>Plano Operacional</th>
							<th>Sentido</th>
							<th>Horario</th>
							<th>Complemento</th>

						</tr>
					</thead>
					<tbody>
					
							<tr>
								<td width=15%>  $id_linha </td>
								<td width=15%>   $id_plano </td>
								<td width=15%>  $id_linha </td>
								<td width=15%>  $id_linha </td>
								
								
							</tr>
				
					</tbody>
				</table>
				";
				echo "Linha: $id_linha <br>";
				echo "Plano Operacional: <br>";
				echo "Sentido: $sentido <br>";
				echo "Horario: $horario<br>";
				echo "Complemento Operacional: $complemento<br>";

				//Inserir o usuário no BD
            
				$sql = 'INSERT INTO sim.horarios (id_linha, id_plano , sentido, horario, complemento) VALUES (:id_linha, :id_plano, :sentido, :horario, :complemento)';
 

				$stmt = $conn->prepare ($sql);
				$stmt->bindValue(':id_linha', $id_linha);
				$stmt->bindValue(':id_plano', $id_plano);
				$stmt->bindValue(':sentido', $sentido);
				$stmt->bindValue(':horario', $horario);
				$stmt->bindValue(':complemento', $complemento);
				
				
				$stmt->execute();
				
				$count = $stmt->rowCount();;

				echo "<hr>";
			
			}
			$primeira_linha = false;
		}
	}
?>