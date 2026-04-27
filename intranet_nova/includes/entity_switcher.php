<?php
/**
 * Componente de Troca de Entidade
 * Permite ao usuário trocar entre diferentes entidades
 */

class EntitySwitcher {
    private $pdo;
    private $userId;
    private $currentEntityId;
    
    public function __construct($pdo, $userId, $currentEntityId) {
        $this->pdo = $pdo;
        $this->userId = $userId;
        $this->currentEntityId = $currentEntityId;
    }
    
    /**
     * Obter entidades disponíveis para o usuário
     */
    public function getUserEntities() {
        try {
            // Buscar entidades baseadas nas permissões do usuário
            // Primeiro, verificar se o usuário tem permissões específicas
            $sql = "SELECT DISTINCT e.entidade_id,
                                    e.entidade_nome,
                                    e.entidade_sigla
                    FROM            entidades e
                    INNER JOIN      intranet_permissoes p
                    ON              e.entidade_id = p.intranet_entidade_id
                    WHERE           p.intranet_user_id = :user_id
                    AND             e.mostrar = true 
                    AND             e.entidade_excluida = false
                    ORDER BY        e.entidade_nome";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['user_id' => $this->userId]);
            $entities = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Se o usuário tem permissões específicas, retornar apenas essas
            if (!empty($entities)) {
                return $entities;
            }
            
            // Se não tem permissões específicas, verificar se é administrador
            // Buscar perfil do usuário
            $sqlPerfil = "SELECT intranet_perfil_id 
                         FROM intranet_permissoes 
                         WHERE intranet_user_id = :user_id 
                         LIMIT 1";
            $stmtPerfil = $this->pdo->prepare($sqlPerfil);
            $stmtPerfil->execute(['user_id' => $this->userId]);
            $perfil = $stmtPerfil->fetch(PDO::FETCH_ASSOC);
            
            // Se for administrador (perfil 1) ou não tiver permissões específicas, mostrar todas as entidades ativas
            if (!$perfil || $perfil['intranet_perfil_id'] == 1) {
                $sql = "SELECT entidade_id, entidade_nome, entidade_sigla 
                        FROM entidades 
                        WHERE mostrar = true AND entidade_excluida = false 
                        ORDER BY entidade_nome";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
            // Se não for administrador e não tiver permissões, retornar apenas a entidade atual
            $sql = "SELECT entidade_id, entidade_nome, entidade_sigla 
                    FROM entidades 
                    WHERE entidade_id = :entidade_id 
                    AND mostrar = true 
                    AND entidade_excluida = false";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['entidade_id' => $this->currentEntityId]);
            $currentEntity = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $currentEntity ? [$currentEntity] : [];
            
        } catch (Exception $e) {
            error_log("Erro ao buscar entidades: " . $e->getMessage());
            // Retornar entidades padrão em caso de erro
            return [
                ['entidade_id' => 1, 'entidade_nome' => 'Prefeitura Municipal'],
                ['entidade_id' => 2, 'entidade_nome' => 'Secretaria de Educação'],
                ['entidade_id' => 3, 'entidade_nome' => 'Secretaria de Saúde'],
                ['entidade_id' => 4, 'entidade_nome' => 'Secretaria de Transportes'],
                ['entidade_id' => 5, 'entidade_nome' => 'Secretaria de Cultura']
            ];
        }
    }
    
    /**
     * Obter entidade atual
     */
    public function getCurrentEntity() {
        try {
            $sql = "SELECT entidade_id, entidade_nome, entidade_sigla 
                    FROM entidades 
                    WHERE entidade_id = :entidade_id 
                    AND mostrar = true 
                    AND entidade_excluida = false";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['entidade_id' => $this->currentEntityId]);
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar entidade atual: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Renderizar componente de troca de entidade
     */
    public function render() {
        $entities = $this->getUserEntities();
        $currentEntity = $this->getCurrentEntity();
        
        // Se usuário só tem uma entidade, não mostrar o switcher
        if (count($entities) <= 1) {
            return '';
        }
        
        $html = '<div class="entity-switcher">';
        $html .= '<label for="entity-select" class="entity-switcher__label">Entidade:</label>';
        $html .= '<select id="entity-select" class="entity-switcher__select" onchange="switchEntity(this.value)">';
        
        foreach ($entities as $entity) {
            $selected = ($entity['entidade_id'] == $this->currentEntityId) ? 'selected' : '';

            //ajuste, troca do metodo utef8 e adissão de sigla a frenter do nome
            $name = is_scalar($entity['entidade_nome']) ? (string) $entity['entidade_nome'] : '';
            $name = mb_convert_encoding($name, 'UTF-8', mb_detect_encoding($name) ?: 'UTF-8');

            $sigla = '';
            if (!empty($entity['entidade_sigla'])) {
                $sigla = is_scalar($entity['entidade_sigla']) ? (string) $entity['entidade_sigla'] : '';
                $sigla = mb_convert_encoding($sigla, 'UTF-8', mb_detect_encoding($sigla) ?: 'UTF-8');
            }

            $displayName = $sigla !== '' ? $sigla . ' - ' . $name : $name;

            
            $html .= '<option value="' . $entity['entidade_id'] . '" ' . $selected . '>';
            $html .= $displayName;
            $html .= '</option>';
        }
        
        $html .= '</select>';
        $html .= '</div>';
        
        // JavaScript para troca de entidade já está no index.php
        
        return $html;
    }
}
?>
