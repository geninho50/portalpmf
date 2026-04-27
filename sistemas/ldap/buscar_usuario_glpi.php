<?php

// Ativar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Configuração do GLPI 10
$glpi_url = 'http://192.168.12.24:8081/apirest.php';
$app_token = 't1AC8NjwJUKTQth4Ls3r4K1uUYhCPCzMKPJhNrrv';
$user_token = 'NVQsWgOt19ksyA4F5G0SyZNhJU6fxkRBL1aBb63H';

// Capturar parâmetro GET (username)
$username = isset($_GET['username']) ? $_GET['username'] : null;
if (!$username) {
    echo json_encode(["success" => false, "message" => "O campo 'username' é obrigatório."]);
    exit();
}

// **1️⃣ Iniciar sessão no GLPI para obter `session_token`**
$session_url = $glpi_url . '/initSession';
$headers = [
    "Content-Type: application/json",
    "App-Token: $app_token",
    "Authorization: user_token $user_token"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $session_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
$session_data = json_decode($response, true);
curl_close($ch);

if (!isset($session_data['session_token'])) {
    echo json_encode(["success" => false, "message" => "Falha ao obter session_token."]);
    exit();
}

$session_token = $session_data['session_token'];

// **2️⃣ Buscar usuário no GLPI 10 usando `searchText[name]`**
$user_url = $glpi_url . "/User?searchText[name]=$username";

$headers = [
    "Content-Type: application/json",
    "App-Token: $app_token",
    "Session-Token: $session_token"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $user_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$data = json_decode($response, true);

// **🔍 Exibir resultado para debug**
echo json_encode([
    "debug" => [
        "http_code" => $http_code,
        "response_raw" => $response
    ]
], JSON_PRETTY_PRINT);

// **3️⃣ Verificar se o usuário foi encontrado**
if ($http_code === 200 && isset($data[0]['id'])) {
    echo json_encode([
        "success" => true,
        "usuario_existe" => true,
        "user_id" => $data[0]['id'],
        "message" => "Usuário encontrado."
    ], JSON_PRETTY_PRINT);
} else {
    echo json_encode([
        "success" => false,
        "usuario_existe" => false,
        "message" => "Usuário não encontrado."
    ], JSON_PRETTY_PRINT);
}

?>
