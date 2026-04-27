<?php

// Ativar exibição de erros para depuração (remover em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Configuração do GLPI
$glpi_url = 'http://192.168.12.24:8081/apirest.php';
$app_token = 't1AC8NjwJUKTQth4Ls3r4K1uUYhCPCzMKPJhNrrv';
$user_token = 'NVQsWgOt19ksyA4F5G0SyZNhJU6fxkRBL1aBb63H';

// Capturar parâmetros GET (username, titulo, descricao)
$username = isset($_GET['username']) ? $_GET['username'] : null;
$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : 'Chamado via API';
$descricao = isset($_GET['descricao']) ? $_GET['descricao'] : 'Descrição padrão do chamado';

if (!$username) {
    echo json_encode(["success" => false, "message" => "O campo 'username' é obrigatório."]);
    exit();
}

// **1️⃣ Iniciar sessão no GLPI para obter `Session-Token`**
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

// **2️⃣ Buscar o ID do usuário pelo `name` (Login do AD)**
function getUserData($glpi_url, $session_token, $app_token, $username) {
    $ch = curl_init("$glpi_url/User?searchText=$username&searchFields[0]=name");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Session-Token: $session_token",
        "App-Token: $app_token"
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);
    
    return $data[0] ?? null; // Retorna os dados do usuário ou null se não encontrado
}

// **Obter ID do Usuário e Entidade**
$user_data = getUserData($glpi_url, $session_token, $app_token, $username);

if (!$user_data) {
    echo json_encode(["success" => false, "message" => "Usuário não encontrado no GLPI."]);
    exit();
}

$user_id = $user_data['id'];
$entity_id = $user_data['entities_id']; // Obtém a entidade automaticamente

// **3️⃣ Criar chamado diretamente no nome do usuário informado pelo Typebot**
$ticket_url = $glpi_url . "/Ticket";
$ticket_data = [
    "input" => [
        "name" => $titulo,
        "content" => $descricao,
        "status" => 1,
        "requesttypes_id" => 1,  // Tipo de solicitação (1 = padrão)
        "itilcategories_id" => 1, // Categoria padrão
        "users_id_recipient" => $user_id, // Define para quem o chamado é direcionado
        "users_id" => $user_id, // Criador do chamado
        "entity_id" => $entity_id, // Herda a entidade do usuário
        "actors" => [
            [
                "users_id" => $user_id,
                "type" => 1 // 1 = Solicitante (Requester)
            ]
        ]
    ]
];

$headers = [
    "Content-Type: application/json",
    "App-Token: $app_token",
    "Session-Token: $session_token"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ticket_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($ticket_data));

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$ticket_response = json_decode($response, true);

// **4️⃣ Verificar se o chamado foi criado corretamente**
if ($http_code === 201 && isset($ticket_response['id'])) {
    $ticket_id = $ticket_response['id'];
    echo json_encode([
        "success" => true,
        "ticket_id" => $ticket_id,
        "ticket_url" => "http://192.168.12.24:8081/front/ticket.form.php?id=$ticket_id",
        "message" => "Chamado criado com sucesso!"
    ], JSON_PRETTY_PRINT);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Erro ao criar chamado.",
        "debug" => [
            "http_code" => $http_code,
            "response" => $ticket_response
        ]
    ], JSON_PRETTY_PRINT);
}

?>
