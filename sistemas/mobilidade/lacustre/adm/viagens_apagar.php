<?php
session_start();
include_once("conexao.php");
$numero_id = $_POST['eid'];
$data = $_POST['data']; 
$numresultados = $_POST['numresultados'];
unset($_POST);


$select = $conn->query("DELETE FROM lacustre.viagens WHERE id='$numero_id'");
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
                    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=lacustre_adm.php?numresultados=". $numresultados."&data=". $data  ."'>
                    <script type=\"text/javascript\">
                        alert(\"Cadastro Apagado.\");
                    </script>
                ";	
            }else{
                echo "
                   <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=lacustre_adm.php'>
                    <script type=\"text/javascript\">
                        alert(\"Erro ao tentar apagar.\");
                    </script>
                ";	
            }?>
        </body>
    </html>
