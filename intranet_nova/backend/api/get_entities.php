<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

try {
    require_once("../../config/database.php");
    
    // Verificar se o usuário está logado
    session_start();
    if (!isset($_SESSION['SuserId'])) {
        echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
        exit;
    }
    
    $userId = $_SESSION['SuserId'];
    
    // Buscar entidades baseadas nas permissões do usuário
    // Primeiro, verificar se o usuário tem permissões específicas
    $sql = "SELECT DISTINCT e.entidade_id, e.entidade_nome, e.entidade_sigla 
            FROM entidades e 
            INNER JOIN intranet_permissoes p ON e.entidade_id = p.intranet_entidade_id 
            WHERE p.intranet_user_id = :user_id 
            AND e.mostrar = true 
            AND e.entidade_excluida = false
            ORDER BY e.entidade_nome";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    $entities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Se o usuário tem permissões específicas, retornar apenas essas
    if (!empty($entities)) {
        // Entidades encontradas com permissões específicas
    } else {
        // Se não tem permissões específicas, verificar se é administrador
        $sqlPerfil = "SELECT intranet_perfil_id 
                     FROM intranet_permissoes 
                     WHERE intranet_user_id = :user_id 
                     LIMIT 1";
        $stmtPerfil = $pdo->prepare($sqlPerfil);
        $stmtPerfil->execute(['user_id' => $userId]);
        $perfil = $stmtPerfil->fetch(PDO::FETCH_ASSOC);
        
        // Se for administrador (perfil 1) ou não tiver permissões específicas, mostrar todas as entidades ativas
        if (!$perfil || $perfil['intranet_perfil_id'] == 1) {
            $sql = "SELECT entidade_id, entidade_nome, entidade_sigla 
                    FROM entidades 
                    WHERE mostrar = true AND entidade_excluida = false 
                    ORDER BY entidade_nome";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $entities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Se não for administrador e não tiver permissões, retornar apenas a entidade atual
            $currentEntityId = $_SESSION['SuserEnt'] ?? 1;
            $sql = "SELECT entidade_id, entidade_nome, entidade_sigla 
                    FROM entidades 
                    WHERE entidade_id = :entidade_id 
                    AND mostrar = true 
                    AND entidade_excluida = false";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['entidade_id' => $currentEntityId]);
            $currentEntity = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $entities = $currentEntity ? [$currentEntity] : [];
        }
    }
    
    echo json_encode([
        'success' => true,
        'entities' => $entities,
        'current_entity' => $_SESSION['SuserEnt'] ?? null
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    error_log("Erro ao buscar entidades: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'Erro ao buscar entidades',
        'error' => $e->getMessage()
    ]);
}
?>
