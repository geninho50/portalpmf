<?php

session_start();
include_once("conexao.php");
$id_cadastro = $_GET['id_cadastro']; 
$codigo_registro = $_GET['codigo_registro'];//recebe da pagina anterior o numero do cadastro 
$query_02 = "SELECT * FROM sim.motofrete_empresas where id_cadastro  = '$id_cadastro' AND codigo_registro  = '$codigo_registro' ";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();
?>

<!DOCTYPE HTML>
<html lang="pt-br">

<head>
 
</head>

<body>

            <?php
            if (($resultado_02_count != 0)) {
                
                $sql = "UPDATE sim.motofrete_empresas SET status = :status WHERE id_cadastro=:id_cadastro";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':status', 2);
                $stmt->bindValue(':id_cadastro', $id_cadastro);
                $stmt->execute();
                $count = $stmt->rowCount();
                
                echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=mte.php'>
                <script type=\"text/javascript\">
                    alert(\"Cadastro Validado.\");
                </script>    
            ";	
            } 
            
            else {
                echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=mte.php'>
                <script type=\"text/javascript\">
                    alert(\"Erro.\");
                </script>
            ";
            } ?>

    <br>
   
  


</body>

</html>

