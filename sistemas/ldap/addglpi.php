<?php

// Ativar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuração do GLPI
$glpi_url = 'http://192.168.12.24:8081/apirest.php';
$app_token = 't1AC8NjwJUKTQth4Ls3r4K1uUYhCPCzMKPJhNrrv';

// **INFORME AQUI OS DADOS DO USUÁRIO GLPI QUE TEM PERMISSÃO NA API**
$user_token = 'COLOQUE_AQUI_O_USER_TOKEN_DO_USUARIO_GLPI';

// Verificar se os dados foram informados corretamente
if (empty($glpi_url) || empty($app_token) || empty($user_token)) {
    die(json_encode(["success" => false, "message" => "Faltam credenciais para conectar ao GLPI."]));
}

// Iniciar sessão na API do GLPI
$url = $glpi_url . '/initSession';

$headers = [
    "Content-Type: application/json",
    "App-Token: $app_token",
    "Authorization: user_token $user_token"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Decodificar resposta JSON
$data = json_decode($response, true);

// Verificar se a conexão foi bem-sucedida
if ($http_code === 200 && isset($data['session_token'])) {
    echo json_encode([
        "success" => true,
        "message" => "Conexão com GLPI bem-sucedida!",
        "session_token" => $data['session_token']
    ], JSON_PRETTY_PRINT);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Falha na conexão com o GLPI.",
        "http_code" => $http_code,
        "response" => $data
    ], JSON_PRETTY_PRINT);
}

?>
