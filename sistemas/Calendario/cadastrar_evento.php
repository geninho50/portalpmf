<?php 
        include "conexao.php";
                            
        $nome = $_POST["nome"];
        $start = $_POST["start"];
        $hora = $_POST["hora"];
        $hora2 = $_POST["hora2"];


        
        $query = "INSERT INTO `eventos` (`title`, `start`, `end`, `hora`, `hora2`) VALUES ('$nome', '$start', '$start', '$hora', '$hora2')";
        
        $exec = $conexao->exec($query);                         
        
        if($exec){            
            echo "1";     
        }
        else{
            echo "0";
        }
       
        
?>