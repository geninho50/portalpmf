<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require_once '../config/database.php';
require_once '../includes/functions.php';

class MenuController {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function getUserMenu($perfilId) {
        try {
            // Buscar menus permitidos para o perfil
            $sql = "SELECT DISTINCT 
                        MEN.intranet_menu_id,
                        MEN.intranet_menu_nome,
                        MEN.intranet_menu_atalho,
                        MEN.intranet_menu_endereco_fisico,
                        MEN.intranet_menu_icone,
                        MEN.intranet_menu_ordem,
                        MEN.intranet_menu_tipo_pai
                    FROM intranet_menu AS MEN 
                    INNER JOIN intranet_perfil_menu AS PERF 
                        ON MEN.intranet_menu_id = PERF.intranet_perfil_menu_menu_id
                    WHERE PERF.intranet_perfil_menu_perfil_id = :perfil_id
                        AND MEN.intranet_menu_tipo = 'intranet'
                    ORDER BY MEN.intranet_menu_ordem";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['perfil_id' => $perfilId]);
            $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Buscar submenus permitidos para o perfil
            $sql = "SELECT DISTINCT 
                        SUB.intranet_submenu_id,
                        SUB.intranet_submenu_nome,
                        SUB.intranet_submenu_atalho,
                        SUB.intranet_submenu_endereco_fisico,
                        SUB.intranet_submenu_icone,
                        SUB.intranet_submenu_ordem,
                        SUB.intranet_submenu_menu_id
                    FROM intranet_submenu AS SUB 
                    INNER JOIN intranet_perfil_submenu AS PERF 
                        ON SUB.intranet_submenu_id = PERF.intranet_perfil_submenu_submenu_id
                    WHERE PERF.intranet_perfil_submenu_perfil_id = :perfil_id
                    ORDER BY SUB.intranet_submenu_ordem";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['perfil_id' => $perfilId]);
            $submenus = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Organizar submenus por menu pai
            $submenusByMenu = [];
            foreach ($submenus as $submenu) {
                $menuId = $submenu['intranet_submenu_menu_id'];
                if (!isset($submenusByMenu[$menuId])) {
                    $submenusByMenu[$menuId] = [];
                }
                $submenusByMenu[$menuId][] = $submenu;
            }
            
            // Adicionar submenus aos menus
            foreach ($menus as &$menu) {
                $menuId = $menu['intranet_menu_id'];
                $menu['submenus'] = $submenusByMenu[$menuId] ?? [];
            }
            
            return [
                'success' => true,
                'data' => $menus
            ];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function getAllMenus() {
        try {
            $sql = "SELECT 
                        intranet_menu_id,
                        intranet_menu_nome,
                        intranet_menu_atalho,
                        intranet_menu_endereco_fisico,
                        intranet_menu_icone,
                        intranet_menu_ordem,
                        intranet_menu_tipo_pai,
                        intranet_menu_tipo
                    FROM intranet_menu 
                    ORDER BY intranet_menu_ordem";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'success' => true,
                'data' => $menus
            ];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function getAllSubmenus() {
        try {
            $sql = "SELECT 
                        intranet_submenu_id,
                        intranet_submenu_nome,
                        intranet_submenu_atalho,
                        intranet_submenu_endereco_fisico,
                        intranet_submenu_icone,
                        intranet_submenu_ordem,
                        intranet_submenu_menu_id
                    FROM intranet_submenu 
                    ORDER BY intranet_submenu_ordem";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $submenus = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'success' => true,
                'data' => $submenus
            ];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function createMenu($menuData) {
        try {
            $sql = "INSERT INTO intranet_menu (
                        intranet_menu_nome,
                        intranet_menu_atalho,
                        intranet_menu_endereco_fisico,
                        intranet_menu_icone,
                        intranet_menu_ordem,
                        intranet_menu_tipo_pai,
                        intranet_menu_tipo
                    ) VALUES (
                        :nome,
                        :atalho,
                        :endereco_fisico,
                        :icone,
                        :ordem,
                        :tipo_pai,
                        :tipo
                    ) RETURNING intranet_menu_id";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'nome' => $menuData['intranet_menu_nome'],
                'atalho' => $menuData['intranet_menu_atalho'],
                'endereco_fisico' => $menuData['intranet_menu_endereco_fisico'],
                'icone' => $menuData['intranet_menu_icone'],
                'ordem' => $menuData['intranet_menu_ordem'],
                'tipo_pai' => $menuData['intranet_menu_tipo_pai'],
                'tipo' => $menuData['intranet_menu_tipo']
            ]);
            
            $menuId = $stmt->fetch(PDO::FETCH_ASSOC)['intranet_menu_id'];
            
            return [
                'success' => true,
                'data' => ['intranet_menu_id' => $menuId]
            ];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function updateMenu($menuId, $menuData) {
        try {
            $sql = "UPDATE intranet_menu SET 
                        intranet_menu_nome = :nome,
                        intranet_menu_atalho = :atalho,
                        intranet_menu_endereco_fisico = :endereco_fisico,
                        intranet_menu_icone = :icone,
                        intranet_menu_ordem = :ordem,
                        intranet_menu_tipo_pai = :tipo_pai,
                        intranet_menu_tipo = :tipo
                    WHERE intranet_menu_id = :menu_id";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'nome' => $menuData['intranet_menu_nome'],
                'atalho' => $menuData['intranet_menu_atalho'],
                'endereco_fisico' => $menuData['intranet_menu_endereco_fisico'],
                'icone' => $menuData['intranet_menu_icone'],
                'ordem' => $menuData['intranet_menu_ordem'],
                'tipo_pai' => $menuData['intranet_menu_tipo_pai'],
                'tipo' => $menuData['intranet_menu_tipo'],
                'menu_id' => $menuId
            ]);
            
            return ['success' => true, 'message' => 'Menu atualizado com sucesso'];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function deleteMenu($menuId) {
        try {
            // Verificar se há submenus associados
            $sql = "SELECT COUNT(*) as count FROM intranet_submenu WHERE intranet_submenu_menu_id = :menu_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['menu_id' => $menuId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result['count'] > 0) {
                return ['success' => false, 'message' => 'Não é possível excluir menu com submenus'];
            }
            
            // Excluir associações com perfis
            $sql = "DELETE FROM intranet_perfil_menu WHERE intranet_perfil_menu_menu_id = :menu_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['menu_id' => $menuId]);
            
            // Excluir menu
            $sql = "DELETE FROM intranet_menu WHERE intranet_menu_id = :menu_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['menu_id' => $menuId]);
            
            return ['success' => true, 'message' => 'Menu excluído com sucesso'];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function associateMenuToProfile($menuId, $perfilId) {
        try {
            $sql = "INSERT INTO intranet_perfil_menu (
                        intranet_perfil_menu_perfil_id,
                        intranet_perfil_menu_menu_id
                    ) VALUES (:perfil_id, :menu_id)";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'perfil_id' => $perfilId,
                'menu_id' => $menuId
            ]);
            
            return ['success' => true, 'message' => 'Menu associado ao perfil com sucesso'];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()];
        }
    }
    
    public function removeMenuFromProfile($menuId, $perfilId) {
        try {
            $sql = "DELETE FROM intranet_perfil_menu 
                    WHERE intranet_perfil_menu_perfil_id = :perfil_id 
                    AND intranet_perfil_menu_menu_id = :menu_id";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'perfil_id' => $perfilId,
                'menu_id' => $menuId
            ]);
            
            return ['success' => true, 'message' => 'Associação removida com sucesso'];
            
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
$menuController = new MenuController($pdo);

if ($method === 'GET') {
    if (strpos($path, '/user/') !== false) {
        // Buscar menu do usuário
        $pathParts = explode('/', trim($path, '/'));
        $perfilId = end($pathParts);
        
        $result = $menuController->getUserMenu($perfilId);
        echo json_encode($result);
    }
    elseif (strpos($path, '/submenus') !== false) {
        $result = $menuController->getAllSubmenus();
        echo json_encode($result);
    }
    else {
        $result = $menuController->getAllMenus();
        echo json_encode($result);
    }
}
elseif ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (strpos($path, '/associate') !== false) {
        $result = $menuController->associateMenuToProfile($input['menu_id'], $input['perfil_id']);
        echo json_encode($result);
    }
    else {
        $result = $menuController->createMenu($input);
        echo json_encode($result);
    }
}
elseif ($method === 'PUT') {
    $input = json_decode(file_get_contents('php://input'), true);
    $pathParts = explode('/', trim($path, '/'));
    $menuId = end($pathParts);
    
    $result = $menuController->updateMenu($menuId, $input);
    echo json_encode($result);
}
elseif ($method === 'DELETE') {
    $pathParts = explode('/', trim($path, '/'));
    
    if (strpos($path, '/associate/') !== false) {
        // Remover associação
        $menuId = $pathParts[count($pathParts) - 2];
        $perfilId = end($pathParts);
        
        $result = $menuController->removeMenuFromProfile($menuId, $perfilId);
        echo json_encode($result);
    }
    else {
        // Excluir menu
        $menuId = end($pathParts);
        $result = $menuController->deleteMenu($menuId);
        echo json_encode($result);
    }
}
elseif ($method === 'OPTIONS') {
    http_response_code(200);
}
else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
}
?>
