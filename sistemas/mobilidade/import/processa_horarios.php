<?php
	include_once "conexao.php";
	if(!empty($_FILES['arquivo']['tmp_name'])){
?>



<!DOCTYPE html>
<html lang="pt-br">
    <head>  
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
       	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<title>Importa Base de Dados</title>
	</head>

<div class="container" theme-showcase" role="main">
            <div class="page-header">
                <h2>Importando Arquivo de Linhas</h2>

                <a href="index.php">Volta para índice de importação</a>
		<table border="1">
							<thead>
								<tr>
									<th>Linha</th>
									<th>Plano Operacional</th>
									<th>Sentido</th>
									<th>Horario</th>
									<th>Complemento</th>
								</tr>
							</thead>
		
		<?php		
	
		$arquivo = new DomDocument();
		$arquivo->load($_FILES['arquivo']['tmp_name']);
		//var_dump($arquivo);
		$linhas = $arquivo->getElementsByTagName("Row");
		$contagem_linhas_total = $arquivo->getElementsByTagName("Row")->length-1;// 6
		
		?>
		<h5>Foram encontrados <b><?php echo $contagem_linhas_total; ?> </b> registros </h5> 
		<?php	
		//echo $linhas;

		$primeira_linha = true;

		foreach($linhas as $linha){
			if($primeira_linha == false){
                $id_linha = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
				$id_plano = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
				$sentido = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
				$horario = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
				$horario=date("H:i", strtotime($horario));
				$complemento= $linha->getElementsByTagName("Data")->item(4)->nodeValue;
				

				?>

		
					<tbody>
					
							<tr>
								<td width=15%> <?php echo $id_linha ?> 		</td>
								<td width=15%> <?php echo $id_plano ?>		</td>
								<td width=15%> <?php echo $sentido ?>		</td>
								<td width=15%> <?php echo $horario ?>		</td>
								<td width=40%> <?php echo $complemento ?>	</td>
								
								
							</tr>
				
					</tbody>
				
				<?php
				

				//Inserir o usuário no BD
            
				$sql = 'INSERT INTO sim.horarios (id_linha, id_plano , sentido, horario, complemento) VALUES (:id_linha, :id_plano, :sentido, :horario, :complemento)';
 

				$stmt = $conn->prepare ($sql);
				$stmt->bindValue(':id_linha', $id_linha);
				$stmt->bindValue(':id_plano', $id_plano);
				$stmt->bindValue(':sentido', $sentido);
				$stmt->bindValue(':horario', $horario);
				$stmt->bindValue(':complemento', $complemento);
				
				
				$stmt->execute();
				

			
			}
			$primeira_linha = false;
		}
		?>
	</table>


</div>
<?php
	}
?>
