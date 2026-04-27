<?php

include_once("./src/database/conexao.php");

try {

    $sql = "SELECT * FROM turismo.viagens ORDER BY id_viagem DESC";
    $query_result = $conn->prepare($sql);
    $query_result->execute();
    $table_fields = $query_result->fetchAll(PDO::FETCH_COLUMN);
    $count = $query_result->rowCount();

    } catch (PDOException $e) {
        echo $e->getMessage();
}

?>