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
                $num_contrato= $linha->getElementsByTagName("Data")->item(3)->nodeValue;
                $id_tipo_servico= $linha->getElementsByTagName("Data")->item(4)->nodeValue;
                $id_validador= $linha->getElementsByTagName("Data")->item(5)->nodeValue;
                $id_natureza_jurdica= $linha->getElementsByTagName("Data")->item(6)->nodeValue;
                $id_tipo_deslocamento= $linha->getElementsByTagName("Data")->item(7)->nodeValue;
                $id_modalidade= $linha->getElementsByTagName("Data")->item(8)->nodeValue;
                $id_classe_operacao= $linha->getElementsByTagName("Data")->item(9)->nodeValue;
                $id_tipo_operacao= $linha->getElementsByTagName("Data")->item(10)->nodeValue;
                $id_tipo_linha= $linha->getElementsByTagName("Data")->item(11)->nodeValue;
                $data_incio= $linha->getElementsByTagName("Data")->item(12)->nodeValue;
                $madrugadao= $linha->getElementsByTagName("Data")->item(13)->nodeValue;
                             
        		 //imprime lista da importação a ser efetuada

				?>
					<tbody>
					
							
                            <tr>
                                <td VALIGN="TOP" ><b>
                                    Linha <?php echo $num ?>  <br> 
                                    <?php echo $nome ?>   <br> 
                                    <?php echo $data_incio ?>  </b>   
                                  
                                </td>

                                <td  VALIGN="TOP"> 
                                    <?php echo $num_contrato ?> <br>    
                                    <?php echo $id_tipo_servico ?> <br>   
                                    <?php echo $id_validador ?> <br>   
                                </td>
                                 <td VALIGN="TOP">  
                                    <?php echo $id_tipo_transporte ?><br>  
                                    <?php echo $id_natureza_jurdica ?><br>  
                                </td>

                                <td VALIGN="TOP">
                                    <?php echo $id_modalidade ?><br>  
                                    <?php echo $id_tipo_deslocamento ?><br>  
                                    <?php echo $id_classe_operacao ?><br>  
                                    <?php echo $id_tipo_operacao ?><br> 
                                    <?php echo $id_tipo_linha ?><br> 
                                    <?php echo "madrugadão: " . $madrugadao ?><br>  
                                </td>
                                                         
                                <td  VALIGN="TOP">
                                    <?php echo "taxa de ocupação: " .  $indicador_to ?><br>
                                    <?php echo "demanda: " .  $indicador_demanda ?><br>
                                    <?php echo "tempo: " . $indicador_tempo ?><br>
                                    <?php echo "global: " .$indicador_global ?></td>
                            </tr>
                          
				
					</tbody>
				
				<?php
				

				//Inserir o usuário no BD
            
				$sql = 'INSERT INTO sim.linhas
                    (   
                        id_tipo_transporte,
                        num,
                        nome,
                        num_contrato,
                        id_tipo_servico,
                        id_validador,
                        id_natureza_jurdica,
                        id_tipo_deslocamento,
                        id_modalidade,
                        id_classe_operacao,
                        id_tipo_operacao,
                        id_tipo_linha,
                        data_incio,
                        madrugadao,
                        indicador_to,
                        indicador_demanda,
                        indicador_tempo,
                        indicador_global

                    )
                    VALUES
                    (
                        :id_tipo_transporte,
                        :num,
                        :nome,
                        :num_contrato,
                        :id_tipo_servico,
                        :id_validador,
                        :id_natureza_jurdica,
                        :id_tipo_deslocamento,
                        :id_modalidade,
                        :id_classe_operacao,
                        :id_tipo_operacao,
                        :id_tipo_linha,
                        :data_incio,
                        :madrugadao,
                        :indicador_to,
                        :indicador_demanda,
                        :indicador_tempo,
                        :indicador_global



                  )';
 

                $stmt = $conn->prepare ($sql);

                $stmt->bindValue(':id_tipo_transporte',$id_tipo_transporte);
                $stmt->bindValue(':num',$num);
                $stmt->bindValue(':nome',$nome);
                $stmt->bindValue(':num_contrato',$num_contrato);
                $stmt->bindValue(':id_tipo_servico',$id_tipo_servico);
                $stmt->bindValue(':id_validador',$id_validador);
                $stmt->bindValue(':id_natureza_jurdica',$id_natureza_jurdica);
                $stmt->bindValue(':id_tipo_deslocamento',$id_tipo_deslocamento);
                $stmt->bindValue(':id_modalidade',$id_modalidade);
                $stmt->bindValue(':id_classe_operacao',$id_classe_operacao);
                $stmt->bindValue(':id_tipo_operacao',$id_tipo_operacao);
                $stmt->bindValue(':id_tipo_linha',$id_tipo_linha);
                $stmt->bindValue(':data_incio',$data_incio);
                $stmt->bindValue(':madrugadao',$madrugadao);
                $stmt->bindValue(':indicador_to',$indicador_to);
                $stmt->bindValue(':indicador_demanda',$indicador_demanda);
                $stmt->bindValue(':indicador_tempo',$indicador_tempo);
                $stmt->bindValue(':indicador_global',$indicador_global);

          
                
				
				
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


