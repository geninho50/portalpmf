<?php
// Funções utilitárias para o sistema

/**
 * Funções de Dashboard
 */

function getDashboardStats($pdo) {
    try {
        // Estatísticas de notícias (tabela atual)
        $newsCount = $pdo->query("SELECT COUNT(*) as count FROM noticias WHERE status = 'publicada'")->fetch()['count'];
        
        // Estatísticas de mídias (tabela atual)
        $mediaCount = $pdo->query("SELECT COUNT(*) as count FROM midias")->fetch()['count'];
        
        // Estatísticas de usuários ativos (tabela uni_usuarios atual)
        $userCount = $pdo->query("SELECT COUNT(*) as count FROM uni_usuarios")->fetch()['count'];
        
        // Estatísticas de eventos (tabela atual)
        $eventCount = $pdo->query("SELECT COUNT(*) as count FROM eventos WHERE data >= CURRENT_DATE")->fetch()['count'];
        
        return [
            'noticias' => $newsCount,
            'midias' => $mediaCount,
            'usuarios' => $userCount,
            'eventos' => $eventCount
        ];
    } catch (PDOException $e) {
        error_log("Erro ao buscar estatísticas: " . $e->getMessage());
        return [
            'noticias' => 0,
            'midias' => 0,
            'usuarios' => 0,
            'eventos' => 0
        ];
    }
}

function getRecentNews($pdo, $limit = 5) {
    try {
        $sql = "SELECT id, titulo, conteudo, data_criacao 
                FROM noticias 
                WHERE status = 'publicada' 
                ORDER BY data_criacao DESC 
                LIMIT :limit";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Erro ao buscar notícias recentes: " . $e->getMessage());
        return [];
    }
}

function getRecentMedia($pdo, $limit = 6) {
    try {
        $sql = "SELECT id, nome, tipo, url, data_upload 
                FROM midias 
                ORDER BY data_upload DESC 
                LIMIT :limit";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Erro ao buscar mídias recentes: " . $e->getMessage());
        return [];
    }
}

function getNotifications($pdo, $limit = 5) {
    try {
        $sql = "SELECT id, tipo, mensagem, data_criacao 
                FROM notificacoes 
                WHERE lida = false 
                ORDER BY data_criacao DESC 
                LIMIT :limit";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Erro ao buscar notificações: " . $e->getMessage());
        return [];
    }
}

/**
 * Funções de Formatação
 */

function formatDate($date) {
    if (!$date) return '';
    
    $timestamp = strtotime($date);
    return date('d/m/Y', $timestamp);
}

function formatDateTime($date) {
    if (!$date) return '';
    
    $timestamp = strtotime($date);
    return date('d/m/Y H:i', $timestamp);
}

function formatTimeAgo($date) {
    if (!$date) return '';
    
    $timestamp = strtotime($date);
    $now = time();
    $diff = $now - $timestamp;
    
    if ($diff < 60) {
        return 'Agora mesmo';
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return "Há {$minutes} min";
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return "Há {$hours}h";
    } elseif ($diff < 2592000) {
        $days = floor($diff / 86400);
        return "Há {$days} dias";
    } else {
        return formatDate($date);
    }
}

/**
 * Funções de Utilitários
 */

function getMediaIcon($type) {
    $icons = [
        'imagem' => 'image',
        'video' => 'video',
        'audio' => 'music',
        'documento' => 'file',
        'pdf' => 'file-pdf',
        'arquivo' => 'file'
    ];
    
    return $icons[$type] ?? 'file';
}

function getNotificationIcon($type) {
    $icons = [
        'info' => 'info-circle',
        'success' => 'check-circle',
        'warning' => 'exclamation-triangle',
        'error' => 'exclamation-circle',
        'news' => 'newspaper',
        'media' => 'image',
        'user' => 'user'
    ];
    
    return $icons[$type] ?? 'info-circle';
}

/**
 * Funções de Segurança
 */

function sanitizeInput($input) {
    if (is_array($input)) {
        return array_map('sanitizeInput', $input);
    }
    
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function generateToken() {
    return bin2hex(random_bytes(32));
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Funções de Upload de Arquivos
 */

function uploadFile($file, $destination, $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx']) {
    try {
        // Verificar se o arquivo foi enviado
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            throw new Exception('Nenhum arquivo foi enviado');
        }
        
        // Verificar erros
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Erro no upload do arquivo');
        }
        
        // Verificar tamanho (máximo 10MB)
        if ($file['size'] > 10 * 1024 * 1024) {
            throw new Exception('Arquivo muito grande (máximo 10MB)');
        }
        
        // Verificar tipo
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedTypes)) {
            throw new Exception('Tipo de arquivo não permitido');
        }
        
        // Gerar nome único
        $fileName = uniqid() . '_' . time() . '.' . $fileExtension;
        $filePath = $destination . '/' . $fileName;
        
        // Criar diretório se não existir
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }
        
        // Mover arquivo
        if (!move_uploaded_file($file['tmp_name'], $filePath)) {
            throw new Exception('Erro ao mover arquivo');
        }
        
        return $fileName;
        
    } catch (Exception $e) {
        error_log("Erro no upload: " . $e->getMessage());
        throw $e;
    }
}

function resizeImage($sourcePath, $destinationPath, $width, $height, $quality = 80) {
    try {
        // Verificar se a extensão GD está disponível
        if (!extension_loaded('gd')) {
            throw new Exception('Extensão GD não está disponível');
        }
        
        // Obter informações da imagem
        $imageInfo = getimagesize($sourcePath);
        if (!$imageInfo) {
            throw new Exception('Não foi possível obter informações da imagem');
        }
        
        $originalWidth = $imageInfo[0];
        $originalHeight = $imageInfo[1];
        $mimeType = $imageInfo['mime'];
        
        // Calcular novas dimensões mantendo proporção
        $ratio = min($width / $originalWidth, $height / $originalHeight);
        $newWidth = round($originalWidth * $ratio);
        $newHeight = round($originalHeight * $ratio);
        
        // Criar imagem de destino
        $destinationImage = imagecreatetruecolor($newWidth, $newHeight);
        
        // Carregar imagem original
        switch ($mimeType) {
            case 'image/jpeg':
                $sourceImage = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $sourceImage = imagecreatefrompng($sourcePath);
                // Preservar transparência
                imagealphablending($destinationImage, false);
                imagesavealpha($destinationImage, true);
                break;
            case 'image/gif':
                $sourceImage = imagecreatefromgif($sourcePath);
                break;
            default:
                throw new Exception('Tipo de imagem não suportado');
        }
        
        // Redimensionar
        imagecopyresampled(
            $destinationImage, $sourceImage,
            0, 0, 0, 0,
            $newWidth, $newHeight,
            $originalWidth, $originalHeight
        );
        
        // Salvar imagem
        switch ($mimeType) {
            case 'image/jpeg':
                imagejpeg($destinationImage, $destinationPath, $quality);
                break;
            case 'image/png':
                imagepng($destinationImage, $destinationPath, round($quality / 10));
                break;
            case 'image/gif':
                imagegif($destinationImage, $destinationPath);
                break;
        }
        
        // Liberar memória
        imagedestroy($sourceImage);
        imagedestroy($destinationImage);
        
        return true;
        
    } catch (Exception $e) {
        error_log("Erro ao redimensionar imagem: " . $e->getMessage());
        throw $e;
    }
}

/**
 * Funções de Validação de Sessão
 */

function isLoggedIn() {
    return isset($_SESSION['SuserId']) && !empty($_SESSION['SuserId']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

function requireAdmin() {
    requireLogin();
    
    if (!isset($_SESSION['user']['perfil']) || $_SESSION['user']['perfil'] !== 'admin') {
        header('Location: index.php?error=unauthorized');
        exit();
    }
}

/**
 * Funções de Log
 */

function logAction($userId, $action, $details = '') {
    global $drive;
    
    try {
        $sql = "INSERT INTO intranet_log_acesso(
                    intranet_log_id,
                    intranet_log_user_id,
                    intranet_log_entidade_id,
                    intranet_log_data,
                    intranet_log_ip,
                    intranet_log_navegador
                ) VALUES (
                    default,
                    $userId,
                    " . ($_SESSION['SuserEnt'] ?? 1) . ",
                    " . time() . ",
                    '" . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "',
                    '" . ($_SERVER['HTTP_USER_AGENT'] ?? 'unknown') . "'
                )";
        
        $drive->pedido($sql);
        return true;
    } catch (Exception $e) {
        error_log("Erro ao registrar log: " . $e->getMessage());
        return false;
    }
}

/**
 * Funções de Paginação
 */

function getPagination($total, $perPage, $currentPage) {
    $totalPages = ceil($total / $perPage);
    $currentPage = max(1, min($currentPage, $totalPages));
    
    $offset = ($currentPage - 1) * $perPage;
    
    return [
        'total' => $total,
        'per_page' => $perPage,
        'current_page' => $currentPage,
        'total_pages' => $totalPages,
        'offset' => $offset,
        'has_previous' => $currentPage > 1,
        'has_next' => $currentPage < $totalPages,
        'previous_page' => $currentPage - 1,
        'next_page' => $currentPage + 1
    ];
}

function generatePaginationLinks($pagination, $baseUrl) {
    $links = [];
    
    // Página anterior
    if ($pagination['has_previous']) {
        $links[] = [
            'url' => $baseUrl . '?page=' . $pagination['previous_page'],
            'text' => 'Anterior',
            'class' => 'prev'
        ];
    }
    
    // Páginas numeradas
    $start = max(1, $pagination['current_page'] - 2);
    $end = min($pagination['total_pages'], $pagination['current_page'] + 2);
    
    for ($i = $start; $i <= $end; $i++) {
        $links[] = [
            'url' => $baseUrl . '?page=' . $i,
            'text' => $i,
            'class' => $i == $pagination['current_page'] ? 'active' : ''
        ];
    }
    
    // Próxima página
    if ($pagination['has_next']) {
        $links[] = [
            'url' => $baseUrl . '?page=' . $pagination['next_page'],
            'text' => 'Próxima',
            'class' => 'next'
        ];
    }
    
    return $links;
}

/**
 * Funções de Busca
 */

function searchContent($pdo, $query, $type = 'all', $limit = 20) {
    try {
        $searchTerm = '%' . $query . '%';
        $results = [];
        
        if ($type === 'all' || $type === 'news') {
            $sql = "SELECT 'news' as type, id, titulo as title, conteudo as content, data_criacao as date 
                    FROM noticias 
                    WHERE (titulo ILIKE :query OR conteudo ILIKE :query) 
                    AND status = 'publicada' 
                    ORDER BY data_criacao DESC 
                    LIMIT :limit";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':query', $searchTerm);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            $results = array_merge($results, $stmt->fetchAll());
        }
        
        if ($type === 'all' || $type === 'media') {
            $sql = "SELECT 'media' as type, id, nome as title, descricao as content, data_upload as date 
                    FROM midias 
                    WHERE (nome ILIKE :query OR descricao ILIKE :query) 
                    ORDER BY data_upload DESC 
                    LIMIT :limit";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':query', $searchTerm);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            $results = array_merge($results, $stmt->fetchAll());
        }
        
        // Ordenar por data
        usort($results, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        
        return array_slice($results, 0, $limit);
        
    } catch (PDOException $e) {
        error_log("Erro na busca: " . $e->getMessage());
        return [];
    }
}
?>
