<?php
include_once "conexao.php";

if(!empty($_FILES['arquivo']['tmp_name'])){
        ?>

<!DOCTYPE html>
<html lang="pt-br">

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
		<table WIDTH="100%" border="1">
									
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
                
                
                
                //busca no xml cada inferencia ao item "data" e descarrega na variavel referente
                
                //colar do excel lista automatizada


                $id_tipo_transporte = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                $id_num = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                $id_plano = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
                $OrigemDestino = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
                $sentido = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
				$plataforma = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
				$id_origem= $OrigemDestino;
				$id_destino= $OrigemDestino;





        		 //imprime lista da importação a ser efetuada

				?>
					<tbody>
					
							
                            <tr>
                     
                            <td> <?php echo $id_tipo_transporte ?></td>
                            <td> <?php echo $id_num ?></td>
                            <td> <?php echo $id_plano ?></td>
                            <td> <?php echo $OrigemDestino ?></td>
                            <td> <?php echo $sentido ?></td>
							<td> <?php echo $plataforma ?></td>
							<td> <?php echo $id_origem ?></td>
							<td> <?php echo $id_destino ?></td>






                            </tr>
                          
				
					</tbody>
				
				<?php
				

				//Inserir o usuário no BD
            
				$sql = 'INSERT INTO sim.od
                    (   
                        id_tipo_transporte,
                        id_num,
                        id_plano,
                        OrigemDestino,
                        sentido,
                        plataforma,
						id_origem,
						id_destino



                    )
                    VALUES
                    (
                        :id_tipo_transporte,
                        :id_num,
                        :id_plano,
                        :OrigemDestino,
                        :sentido,
                        :plataforma,
						:id_origem,
						:id_destino



                  )';
 

                $stmt = $conn->prepare ($sql);

                $stmt->bindValue(':id_tipo_transporte',$id_tipo_transporte);
                $stmt->bindValue(':id_num',$id_num);
                $stmt->bindValue(':id_plano',$id_plano);
                $stmt->bindValue(':OrigemDestino',$OrigemDestino);
                $stmt->bindValue(':sentido',$sentido);
				$stmt->bindValue(':plataforma',$plataforma);
				$stmt->bindValue(':id_origem',$id_origem);
				$stmt->bindValue(':id_destino',$id_destino);
	
				
				$stmt->execute();
			}
			$primeira_linha = false;
		}
        ?>
        
        </table>
    </div>
    
    </div>
    
</div>

<?php
	}
?>


<?php


