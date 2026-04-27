<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require_once '../config/database.php';
require_once '../includes/functions.php';

class AuthController {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function login($login, $senha) {
        try {
            // Buscar usuário
            $sql = "SELECT 
                        u.user_id,
                        u.user_nome,
                        u.user_login,
                        u.user_entidade_id,
                        u.user_grupo_id,
                        p.intranet_perfil_id
                    FROM uni_usuarios u
                    LEFT JOIN intranet_permissoes p ON u.user_id = p.intranet_user_id
                    WHERE u.user_login = :login 
                    AND u.user_senha = :senha
                    LIMIT 1";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'login' => $login,
                'senha' => md5($senha)
            ]);
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user) {
                return ['success' => false, 'message' => 'Credenciais inválidas'];
            }
            
            // Buscar entidades do usuário
            $sql = "SELECT DISTINCT 
                        e.entidade_id,
                        e.entidade_nome,
                        e.entidade_tipo
                    FROM entidades e
                    INNER JOIN intranet_permissoes p ON e.entidade_id = p.intranet_entidade_id
                    WHERE p.intranet_user_id = :user_id
                    ORDER BY e.entidade_nome";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['user_id' => $user['user_id']]);
            $entities = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Entidade atual (primeira da lista)
            $currentEntity = $entities[0] ?? null;
            
            // Iniciar sessão
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_nome'] = $user['user_nome'];
            $_SESSION['user_login'] = $user['user_login'];
            $_SESSION['user_entidade_id'] = $currentEntity['entidade_id'] ?? null;
            $_SESSION['user_perfil_id'] = $user['intranet_perfil_id'] ?? null;
            
            return [
                'success' => true,
                'user' => $user,
                'entity' => $currentEntity,
                'entities' => $entities
            ];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function switchEntity($userId, $entidadeId) {
        try {
            // Verificar se usuário tem permissão para a entidade
            $sql = "SELECT COUNT(*) as count 
                    FROM intranet_permissoes 
                    WHERE intranet_user_id = :user_id 
                    AND intranet_entidade_id = :entidade_id";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'user_id' => $userId,
                'entidade_id' => $entidadeId
            ]);
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result['count'] == 0) {
                return ['success' => false, 'message' => 'Usuário não tem permissão para esta entidade'];
            }
            
            // Buscar dados da entidade
            $sql = "SELECT entidade_id, entidade_nome, entidade_tipo 
                    FROM entidades 
                    WHERE entidade_id = :entidade_id";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['entidade_id' => $entidadeId]);
            $entity = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Atualizar sessão
            session_start();
            $_SESSION['user_entidade_id'] = $entidadeId;
            
            return [
                'success' => true,
                'entity' => $entity
            ];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function logout() {
        session_start();
        session_destroy();
        return ['success' => true, 'message' => 'Logout realizado com sucesso'];
    }
    
    public function checkAuth() {
        session_start();
        
        if (!isset($_SESSION['user_id'])) {
            return ['success' => false, 'message' => 'Usuário não autenticado'];
        }
        
        return [
            'success' => true,
            'user_id' => $_SESSION['user_id'],
            'user_nome' => $_SESSION['user_nome'],
            'user_entidade_id' => $_SESSION['user_entidade_id'],
            'user_perfil_id' => $_SESSION['user_perfil_id']
        ];
    }
}

// Processar requisições
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];
$pathParts = explode('/', trim($path, '/'));

$database = new Database();
$pdo = $database->getConnection();
$authController = new AuthController($pdo);

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (strpos($path, '/login') !== false) {
        $result = $authController->login($input['login'], $input['senha']);
        echo json_encode($result);
    }
    elseif (strpos($path, '/switch-entity') !== false) {
        session_start();
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
            exit;
        }
        
        $result = $authController->switchEntity($userId, $input['entidade_id']);
        echo json_encode($result);
    }
    elseif (strpos($path, '/logout') !== false) {
        $result = $authController->logout();
        echo json_encode($result);
    }
}
elseif ($method === 'GET') {
    if (strpos($path, '/check') !== false) {
        $result = $authController->checkAuth();
        echo json_encode($result);
    }
}
elseif ($method === 'OPTIONS') {
    // Preflight request
    http_response_code(200);
}
else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
}
?>
