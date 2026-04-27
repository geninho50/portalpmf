<?php
session_start();
include_once("conexao.php");
$id_cadastro = $_POST['id_cadastro_apagar'];
unset($_POST);


$sql = "UPDATE sim.moradores_costa SET  
status = :status

WHERE id_cadastro=:id_cadastro";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':status', 0, PDO::PARAM_INT);
$stmt->bindValue(':id_cadastro', $id_cadastro);
$stmt->execute();

$query = "SELECT * FROM sim.moradores_costa where id_cadastro = '$id_cadastro' AND status = 0";
$resultado = $conn->query($query);
$count = $resultado->rowCount();



/*


$select = $conn->query("DELETE FROM sim.moradores_costa WHERE id_cadastro='$id_cadastro'");
$resultado = $select->fetch(PDO::FETCH_ASSOC);
$count = $select->rowCount();


*/
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