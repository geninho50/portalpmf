<?php
session_start();
include_once("conexao.php");
$id_cadastro = $_POST['id_cadastro_apagar'];
echo $id_cadastro;
unset($_POST);


$select = $conn->query("DELETE FROM sim.moradores_costa WHERE id_cadastro='$id_cadastro'");
$resultado = $select->fetch(PDO::FETCH_ASSOC);
$count = $select->rowCount();

?>
    <!DOCTYPE html>
  
    <html lang="pt-br">
        <head>
            <meta charset="utf-8">
        </head>
    
        <body> <?php
            if($count != 0){
                echo "
                    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=morador_costa.php'>
                    <script type=\"text/javascript\">
                        alert(\"Cadastro Apagado: ". $id_cadastro."\");
                    </script>
                ";	
            }else{
                echo "
                   <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=morador_costa.php'>
                    <script type=\"text/javascript\">
                        alert(\"Erro ao tentar apagar ". $id_cadastro."\"\");
                    </script>
                ";	
            }?>
        </body>
    </html>