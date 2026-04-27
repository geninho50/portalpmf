<?php

session_start();
include_once 'conexao.php';




   $sql = "INSERT INTO turismo.teste
   (
       nome
   )
   VALUES
   (
       'teste'
       
   )";

$stmt = $conn->prepare($sql);
//$stmt->bindValue(':nome', $name);
$stmt->execute();
//


?>