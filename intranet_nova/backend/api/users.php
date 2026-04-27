<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require_once '../config/database.php';
require_once '../includes/functions.php';

class UserController {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function getUsers($entidadeId = null, $filters = []) {
        try {
            $sql = "SELECT 
                        u.user_id,
                        u.user_nome,
                        u.user_login,
                        u.user_email,
                        u.user_maticula,
                        u.user_cpf,
                        u.user_fone,
                        u.user_data_nascimento,
                        u.user_entidade_id,
                        u.user_grupo_id,
                        e.entidade_nome,
                        g.grupo_nome,
                        p.intranet_perfil_id,
                        pf.intranet_perfil_nome
                    FROM uni_usuarios u
                    LEFT JOIN entidades e ON u.user_entidade_id = e.entidade_id
                    LEFT JOIN grupo g ON u.user_grupo_id = g.grupo_id
                    LEFT JOIN intranet_permissoes p ON u.user_id = p.intranet_user_id
                    LEFT JOIN intranet_perfil pf ON p.intranet_perfil_id = pf.intranet_perfil_id
                    WHERE 1=1";
            
            $params = [];
            
            // Filtro por entidade
            if ($entidadeId) {
                $sql .= " AND u.user_entidade_id = :entidade_id";
                $params['entidade_id'] = $entidadeId;
            }
            
            // Filtros adicionais
            if (!empty($filters['search'])) {
                $sql .= " AND (u.user_nome ILIKE :search OR u.user_login ILIKE :search OR u.user_maticula ILIKE :search)";
                $params['search'] = '%' . $filters['search'] . '%';
            }
            
            if (!empty($filters['grupo_id'])) {
                $sql .= " AND u.user_grupo_id = :grupo_id";
                $params['grupo_id'] = $filters['grupo_id'];
            }
            
            if (!empty($filters['perfil_id'])) {
                $sql .= " AND p.intranet_perfil_id = :perfil_id";
                $params['perfil_id'] = $filters['perfil_id'];
            }
            
            $sql .= " ORDER BY u.user_nome";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'success' => true,
                'data' => $users
            ];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function getUser($userId) {
        try {
            $sql = "SELECT 
                        u.user_id,
                        u.user_nome,
                        u.user_login,
                        u.user_email,
                        u.user_maticula,
                        u.user_cpf,
                        u.user_fone,
                        u.user_data_nascimento,
                        u.user_entidade_id,
                        u.user_grupo_id,
                        e.entidade_nome,
                        g.grupo_nome,
                        p.intranet_perfil_id,
                        pf.intranet_perfil_nome
                    FROM uni_usuarios u
                    LEFT JOIN entidades e ON u.user_entidade_id = e.entidade_id
                    LEFT JOIN grupo g ON u.user_grupo_id = g.grupo_id
                    LEFT JOIN intranet_permissoes p ON u.user_id = p.intranet_user_id
                    LEFT JOIN intranet_perfil pf ON p.intranet_perfil_id = pf.intranet_perfil_id
                    WHERE u.user_id = :user_id";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user) {
                return ['success' => false, 'message' => 'Usuário não encontrado'];
            }
            
            return [
                'success' => true,
                'data' => $user
            ];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function createUser($userData) {
        try {
            $this->pdo->beginTransaction();
            
            // Inserir usuário
            $sql = "INSERT INTO uni_usuarios (
                        user_nome,
                        user_login,
                        user_senha,
                        user_email,
                        user_maticula,
                        user_cpf,
                        user_fone,
                        user_data_nascimento,
                        user_entidade_id,
                        user_grupo_id
                    ) VALUES (
                        :nome,
                        :login,
                        :senha,
                        :email,
                        :maticula,
                        :cpf,
                        :fone,
                        :data_nascimento,
                        :entidade_id,
                        :grupo_id
                    ) RETURNING user_id";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'nome' => $userData['user_nome'],
                'login' => $userData['user_login'],
                'senha' => md5($userData['user_senha']),
                'email' => $userData['user_email'],
                'maticula' => $userData['user_maticula'],
                'cpf' => $userData['user_cpf'],
                'fone' => $userData['user_fone'],
                'data_nascimento' => $userData['user_data_nascimento'],
                'entidade_id' => $userData['user_entidade_id'],
                'grupo_id' => $userData['user_grupo_id']
            ]);
            
            $userId = $stmt->fetch(PDO::FETCH_ASSOC)['user_id'];
            
            // Inserir permissão
            if (!empty($userData['intranet_perfil_id'])) {
                $sql = "INSERT INTO intranet_permissoes (
                            intranet_user_id,
                            intranet_perfil_id,
                            intranet_entidade_id
                        ) VALUES (
                            :user_id,
                            :perfil_id,
                            :entidade_id
                        )";
                
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'user_id' => $userId,
                    'perfil_id' => $userData['intranet_perfil_id'],
                    'entidade_id' => $userData['user_entidade_id']
                ]);
            }
            
            $this->pdo->commit();
            
            return [
                'success' => true,
                'data' => ['user_id' => $userId],
                'message' => 'Usuário criado com sucesso'
            ];
            
        } catch (Exception $e) {
            $this->pdo->rollback();
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function updateUser($userId, $userData) {
        try {
            $this->pdo->beginTransaction();
            
            // Atualizar usuário
            $sql = "UPDATE uni_usuarios SET 
                        user_nome = :nome,
                        user_login = :login,
                        user_email = :email,
                        user_maticula = :maticula,
                        u.user_cpf = :cpf,
                        user_fone = :fone,
                        user_data_nascimento = :data_nascimento,
                        user_entidade_id = :entidade_id,
                        user_grupo_id = :grupo_id
                    WHERE user_id = :user_id";
            
            $params = [
                'nome' => $userData['user_nome'],
                'login' => $userData['user_login'],
                'email' => $userData['user_email'],
                'maticula' => $userData['user_maticula'],
                'cpf' => $userData['user_cpf'],
                'fone' => $userData['user_fone'],
                'data_nascimento' => $userData['user_data_nascimento'],
                'entidade_id' => $userData['user_entidade_id'],
                'grupo_id' => $userData['user_grupo_id'],
                'user_id' => $userId
            ];
            
            // Se senha foi fornecida, atualizar
            if (!empty($userData['user_senha'])) {
                $sql = str_replace('user_login = :login,', 'user_login = :login, user_senha = :senha,', $sql);
                $params['senha'] = md5($userData['user_senha']);
            }
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            
            // Atualizar permissão
            if (!empty($userData['intranet_perfil_id'])) {
                // Remover permissão existente
                $sql = "DELETE FROM intranet_permissoes WHERE intranet_user_id = :user_id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['user_id' => $userId]);
                
                // Inserir nova permissão
                $sql = "INSERT INTO intranet_permissoes (
                            intranet_user_id,
                            intranet_perfil_id,
                            intranet_entidade_id
                        ) VALUES (
                            :user_id,
                            :perfil_id,
                            :entidade_id
                        )";
                
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'user_id' => $userId,
                    'perfil_id' => $userData['intranet_perfil_id'],
                    'entidade_id' => $userData['user_entidade_id']
                ]);
            }
            
            $this->pdo->commit();
            
            return [
                'success' => true,
                'message' => 'Usuário atualizado com sucesso'
            ];
            
        } catch (Exception $e) {
            $this->pdo->rollback();
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function deleteUser($userId) {
        try {
            $this->pdo->beginTransaction();
            
            // Remover permissões
            $sql = "DELETE FROM intranet_permissoes WHERE intranet_user_id = :user_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
            
            // Remover usuário
            $sql = "DELETE FROM uni_usuarios WHERE user_id = :user_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
            
            $this->pdo->commit();
            
            return [
                'success' => true,
                'message' => 'Usuário excluído com sucesso'
            ];
            
        } catch (Exception $e) {
            $this->pdo->rollback();
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function changePassword($userId, $currentPassword, $newPassword) {
        try {
            // Verificar senha atual
            $sql = "SELECT user_senha FROM uni_usuarios WHERE user_id = :user_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user || $user['user_senha'] !== md5($currentPassword)) {
                return ['success' => false, 'message' => 'Senha atual incorreta'];
            }
            
            // Atualizar senha
            $sql = "UPDATE uni_usuarios SET user_senha = :senha WHERE user_id = :user_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'senha' => md5($newPassword),
                'user_id' => $userId
            ]);
            
            return [
                'success' => true,
                'message' => 'Senha alterada com sucesso'
            ];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
}

// Processar requisições
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

$database = new Database();
$pdo = $database->getConnection();
$userController = new UserController($pdo);

// Verificar autenticação
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

$entidadeId = $_SESSION['user_entidade_id'] ?? null;

if ($method === 'GET') {
    $pathParts = explode('/', trim($path, '/'));
    
    if (count($pathParts) > 1 && is_numeric($pathParts[1])) {
        // Buscar usuário específico
        $userId = $pathParts[1];
        $result = $userController->getUser($userId);
        echo json_encode($result);
    } else {
        // Listar usuários
        $filters = [];
        if (!empty($_GET['search'])) $filters['search'] = $_GET['search'];
        if (!empty($_GET['grupo_id'])) $filters['grupo_id'] = $_GET['grupo_id'];
        if (!empty($_GET['perfil_id'])) $filters['perfil_id'] = $_GET['perfil_id'];
        
        $result = $userController->getUsers($entidadeId, $filters);
        echo json_encode($result);
    }
}
elseif ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (strpos($path, '/change-password') !== false) {
        $pathParts = explode('/', trim($path, '/'));
        $userId = $pathParts[1];
        $result = $userController->changePassword($userId, $input['current_password'], $input['new_password']);
        echo json_encode($result);
    } else {
        $result = $userController->createUser($input);
        echo json_encode($result);
    }
}
elseif ($method === 'PUT') {
    $input = json_decode(file_get_contents('php://input'), true);
    $pathParts = explode('/', trim($path, '/'));
    $userId = $pathParts[1];
    
    $result = $userController->updateUser($userId, $input);
    echo json_encode($result);
}
elseif ($method === 'DELETE') {
    $pathParts = explode('/', trim($path, '/'));
    $userId = $pathParts[1];
    
    $result = $userController->deleteUser($userId);
    echo json_encode($result);
}
elseif ($method === 'OPTIONS') {
    http_response_code(200);
}
else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
}
?>
