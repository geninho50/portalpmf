<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/database.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

try {
    session_start();
    
    if (!isset($_SESSION['SuserId'])) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
        exit;
    }
    
    $input = json_decode(file_get_contents('php://input'), true);
    $entidadeId = $input['entidade_id'] ?? null;
    
    if (!$entidadeId) {
        echo json_encode(['success' => false, 'message' => 'ID da entidade não fornecido']);
        exit;
    }
    
    $database = new Database();
    $pdo = $database->getConnection();
    
    // Verificar se usuário tem permissão para a entidade
    $sql = "SELECT COUNT(*) as count 
            FROM intranet_permissoes 
            WHERE intranet_user_id = :user_id 
            AND intranet_entidade_id = :entidade_id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'user_id' => $_SESSION['SuserId'],
        'entidade_id' => $entidadeId
    ]);
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] == 0) {
        echo json_encode(['success' => false, 'message' => 'Usuário não tem permissão para esta entidade']);
        exit;
    }
    
    // Buscar dados da entidade
    $sql = "SELECT entidade_id, entidade_nome, entidade_tipo 
            FROM entidades 
            WHERE entidade_id = :entidade_id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['entidade_id' => $entidadeId]);
    $entity = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$entity) {
        echo json_encode(['success' => false, 'message' => 'Entidade não encontrada']);
        exit;
    }
    
    // Atualizar sessão
    $_SESSION['SuserEnt'] = $entidadeId;
    
    echo json_encode([
        'success' => true,
        'message' => 'Entidade alterada com sucesso',
        'entity' => $entity
    ]);
    
} catch (Exception $e) {
    error_log("Erro ao trocar entidade: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Erro interno do servidor']);
}
?>
