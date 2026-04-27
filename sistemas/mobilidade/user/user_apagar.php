<?php
session_start();
include_once("conexao.php");
$id_user = $_POST['id'];
unset($_POST);
$select = $conn->query("DELETE FROM login.usuarios WHERE id='$id_user'");
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
                    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=user.php'>
                    <script type=\"text/javascript\">
                        alert(\"Cadastro Apagado.\");
                    </script>
                ";	
            }else{
                echo "
                   <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=user.php'>
                    <script type=\"text/javascript\">
                        alert(\"Erro.\");
                    </script>
                ";	
            }?>
        </body>
    </html>
 
        