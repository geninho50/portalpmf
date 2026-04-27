<?php

function autenticarUsuarioGLPI($config) {
    $url = $config['glpi_url'] . '/initSession';
    $appToken = $config['app_token'];

    $headers = [
        "Content-Type: application/json",
        "App-Token: $appToken"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    return $data['session_token'] ?? false;
}

function buscarUsuarioGLPI($sessionToken, $username, $config) {
    $url = $config['glpi_url'] . "/search/User?criteria[0][field]=1&criteria[0][searchtype]=equals&criteria[0][value]=$username&forcedisplay[0]=2";

    $headers = [
        "App-Token: " . $config['app_token'],
        "Session-Token: $sessionToken",
        "Content-Type: application/json"
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (!empty($data['data'][0]['id'])) {
        return $data['data'][0]['id'];
    }

    return false;
}

function criarChamadoGLPI($sessionToken, $titulo, $descricao, $userId, $config) {
    $url = $config['glpi_url'] . '/Ticket';

    $dadosChamado = [
        "input" => [
            "name" => $titulo,
            "content" => $descricao,
            "status" => 1,
            "requesttypes_id" => 1,
            "itilcategories_id" => 1,
            "users_id_recipient" => $userId
        ]
    ];

    $headers = [
        "Session-Token: $sessionToken",
        "App-Token: " . $config['app_token'],
        "Content-Type: application/json"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dadosChamado));

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    return $data['id'] ?? false;
}

?>
