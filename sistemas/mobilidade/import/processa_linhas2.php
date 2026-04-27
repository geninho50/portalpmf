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
                $num= $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                $nome= $linha->getElementsByTagName("Data")->item(2)->nodeValue;
                $id_validador= $linha->getElementsByTagName("Data")->item(5)->nodeValue;
                                                     
        		 //imprime lista da importação a ser efetuada

				?>
					<tbody>
					
							
                            <tr>

                                <td VALIGN="TOP">  
                                    <?php echo $id_tipo_transporte ?><br>  
                                </td>

                                <td VALIGN="TOP" ><b>
                                <?php echo $id_validador ?> <br>   
                                         
                                </td>

                                <td  VALIGN="TOP"> 
                                 
                                Linha <?php echo $num ?>  <br> 
                                </td>

                                <td VALIGN="TOP">
                                <?php echo $nome ?>   <br> 

                                </td>

                           
                            </tr>
                          
				
					</tbody>
				
				<?php
				

				//Inserir o usuário no BD
            
				$sql = 'INSERT INTO sim.linhas
                    (   
                        id_tipo_transporte,
                        num,
                        nome,
                        id_validador
                 
                   
                    )
                    VALUES
                    (
                        :id_tipo_transporte,
                        :num,
                        :nome,

                        :id_validador
                   
                     



                  )';
 

                $stmt = $conn->prepare ($sql);

                $stmt->bindValue(':id_tipo_transporte',$id_tipo_transporte);
                $stmt->bindValue(':num',$num);
                $stmt->bindValue(':nome',$nome);
                $stmt->bindValue(':id_validador',$id_validador);
           	
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


