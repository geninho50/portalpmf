<?php

session_start();
include_once './conexao.php';
$nomes = $_POST["nome"];
$documentos = $_POST["documento"];
$datas_rotas = $_POST["data_rota"];
$rotas_saidas = $_POST["rota_saida"];
$rotas_chegadas = $_POST["rota_chegada"];

foreach ($nomes as $key => $value) {
    $values[] = $value;
    $i_pax_max++;
}

// $i = 0;
for ($i = 0; $i < $i_pax_max; $i++) {
    $result[$i] =   array('nome' => $nomes[$i], 'documento' => $documentos[$i]);
};

$passageiros = json_encode($result);

// rotas

foreach ($datas_rotas as $key_n => $value_n) {
    $values_n[] = $value_n;
    $i_rotas_max++;
}

$i = 0;
for ($i = 0; $i < $i_rotas_max; $i++) {
    $result_rotas[$i] =  array(
        'data' => $datas_rotas[$i], 
        'rota_saida' => $rotas_saidas[$i], 
        'rota_chegada' => $rotas_chegadas[$i]
    );
};

$rotas = json_encode($result_rotas);
var_dump($rotas);
$sql = "INSERT INTO turismo.selo
    (
        passageiros,
        rotas
    )
    VALUES
    (
        :passageiros,
        :rotas
    )";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':passageiros', $passageiros);
$stmt->bindValue(':rotas', $rotas);
$stmt->execute();
$count = $stmt->rowCount();

//puxar da base 

//decode json

$array_passageiros = json_decode($passageiros, true);


echo  "Foram registratos " . $i_pax_max . " passageiros cadastros.<hr>";

foreach ($array_passageiros as $key1 => $value1) {

    echo $value1['nome'] . " - " . $value1['documento'] . " <br> ";
};

$array_rotas = json_decode($rotas, true);

echo  "<br><hr>Foram registradas " . $i_rotas_max . " rotas.<hr>";

foreach ($array_rotas as $key => $value) {

    echo $value['data'] . " - " . $value['rota_saida'] ." - " . $value['rota_chegada'] . "  <br> ";
};