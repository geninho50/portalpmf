<?php
/**
 * Gerenciador de Menu Dinâmico
 * Baseado em permissões do usuário
 */

class MenuManager {
    private $pdo;
    private $userId;
    private $userPerfilId;
    private $userEntidadeId;
    
    public function __construct($pdo, $userId, $userPerfilId, $userEntidadeId) {
        $this->pdo = $pdo;
        $this->userId = $userId;
        $this->userPerfilId = $userPerfilId;
        $this->userEntidadeId = $userEntidadeId;
    }
    
    /**
     * Gerar menu completo para o usuário
     */
    public function generateMenu() {
        try {
            $menuItems = $this->getMenuItems();
            return $this->renderMenu($menuItems);
        } catch (Exception $e) {
            error_log("Erro ao gerar menu: " . $e->getMessage());
            return $this->renderErrorMenu();
        }
    }
    
    /**
     * Obter itens do menu baseado nas permissões
     */
    private function getMenuItems() {
        $items = [];
        
        try {
            // Verificar se a tabela existe
            $checkTable = $this->pdo->query("SELECT 1 FROM information_schema.tables WHERE table_name = 'intranet_menu'");
            if ($checkTable->rowCount() == 0) {
                throw new Exception("Tabela intranet_menu não existe");
            }
            
            // Primeiro, vamos verificar a estrutura real da tabela
            $structureSql = "SELECT column_name FROM information_schema.columns WHERE table_name = 'intranet_menu' ORDER BY ordinal_position";
            $structureStmt = $this->pdo->query($structureSql);
            $columns = [];
            while ($row = $structureStmt->fetch(PDO::FETCH_ASSOC)) {
                $columns[] = $row['column_name'];
            }
            
            // Verificar se as colunas necessárias existem
            $requiredColumns = ['intranet_menu_id', 'intranet_menu_atalho'];
            foreach ($requiredColumns as $col) {
                if (!in_array($col, $columns)) {
                    throw new Exception("Coluna obrigatória não encontrada: $col");
                }
            }
            
            // Construir query dinamicamente baseada nas colunas existentes
            $selectFields = [];
            $selectFields[] = "intranet_menu_id as id";
            
            if (in_array('intranet_menu_nome', $columns)) {
                $selectFields[] = "intranet_menu_nome as nome";
            } else {
                $selectFields[] = "intranet_menu_atalho as nome"; // Usar atalho como nome se não existir nome
            }
            
            $selectFields[] = "intranet_menu_atalho as atalho";
            
            
            if (in_array('intranet_menu_endereco_fisico', $columns)) {
                $selectFields[] = "intranet_menu_endereco_fisico as url";
            } else {
                $selectFields[] = "'' as url"; // URL vazia se não existir
            }
            
            if (in_array('intranet_menu_icone', $columns)) {
                $selectFields[] = "intranet_menu_icone as icone";
            } else {
                $selectFields[] = "'' as icone"; // Ícone vazio se não existir
            }
            
            if (in_array('intranet_menu_ordem', $columns)) {
                $selectFields[] = "intranet_menu_ordem as ordem";
            } else {
                $selectFields[] = "1 as ordem"; // Ordem padrão se não existir
            }

            
            $selectFields = ['intranet_menu_id',' intranet_menu_titulo',' intranet_menu_atalho', 'intranet_menu_endereco_fisico', 'intranet_menu_posicao', 'intranet_menu_tipo' ];

            $novoNome = [ 'id', 'nome', 'atalho' , 'url', 'ordem','tipo' ]; //nome para os menus laterais   

            // Menus principais
            $sql = "SELECT " . implode(', ', $selectFields) ."AS ".implode($novoNome) ." FROM intranet_menu";
            
            // Adicionar WHERE se a coluna tipo_pai existir
            if (in_array('intranet_menu_tipo_pai', $columns)) {
                $sql .= " WHERE intranet_menu_tipo_pai = 'f'";
            }
            
            // Adicionar ORDER BY se a coluna ordem existir
            if (in_array('intranet_menu_ordem', $columns)) {
                $sql .= " ORDER BY intranet_menu_ordem";
            }
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $items[] = $row;
            }
            
            // Submenus (se a tabela existir)
            $checkSubmenuTable = $this->pdo->query("SELECT 1 FROM information_schema.tables WHERE table_name = 'intranet_submenu'");
            if ($checkSubmenuTable->rowCount() > 0) {
                $submenuStructureSql = "SELECT column_name FROM information_schema.columns WHERE table_name = 'intranet_submenu' ORDER BY ordinal_position";
                $submenuStructureStmt = $this->pdo->query($submenuStructureSql);
                $submenuColumns = [];
                while ($row = $submenuStructureStmt->fetch(PDO::FETCH_ASSOC)) {
                    $submenuColumns[] = $row['column_name'];
                }
                
                $submenuSelectFields = [];
                $submenuSelectFields[] = "intranet_submenu_id as id";
                
                if (in_array('intranet_submenu_nome', $submenuColumns)) {
                    $submenuSelectFields[] = "intranet_submenu_nome as nome";
                } else {
                    $submenuSelectFields[] = "intranet_submenu_atalho as nome";
                }
                
                $submenuSelectFields[] = "intranet_submenu_atalho as atalho";
                
                if (in_array('intranet_submenu_endereco_fisico', $submenuColumns)) {
                    $submenuSelectFields[] = "intranet_submenu_endereco_fisico as url";
                } else {
                    $submenuSelectFields[] = "'' as url";
                }
                
                if (in_array('intranet_submenu_icone', $submenuColumns)) {
                    $submenuSelectFields[] = "intranet_submenu_icone as icone";
                } else {
                    $submenuSelectFields[] = "'' as icone";
                }
                
                if (in_array('intranet_submenu_ordem', $submenuColumns)) {
                    $submenuSelectFields[] = "intranet_submenu_ordem as ordem";
                } else {
                    $submenuSelectFields[] = "1 as ordem";
                }
                
                $submenuSelectFields[] = "'submenu' as tipo";
                
                $submenuSql = "SELECT " . implode(', ', $submenuSelectFields) . " FROM intranet_submenu";
                
                if (in_array('intranet_submenu_ordem', $submenuColumns)) {
                    $submenuSql .= " ORDER BY intranet_submenu_ordem";
                }
                
                $submenuStmt = $this->pdo->prepare($submenuSql);
                $submenuStmt->execute();
                
                while ($row = $submenuStmt->fetch(PDO::FETCH_ASSOC)) {
                    $items[] = $row;
                }
            }
            
            // Ordenar por ordem
            usort($items, function($a, $b) {
                return $a['ordem'] <=> $b['ordem'];
            });
            
        } catch (Exception $e) {
            error_log("Erro ao buscar itens do menu: " . $e->getMessage());
            // Retornar menu padrão em caso de erro
            $items = $this->getDefaultMenuItems();
        }
        
        return $items;
    }

    private function getDefaultMenuItems() {
        return [
            [
                'id' => 1,
                'nome' => 'Dashboard',
                'atalho' => 'dashboard',
                'url' => 'index.php',
                'icone' => 'fas fa-home',
                'ordem' => 1,
                'tipo' => 'menu'

            ],
            [
                'id' => 2,
                'nome' => 'Meus Dados',
                'atalho' => 'dados',
                'url' => 'usuariodados.php',
                'icone' => 'fa-regular fa-id-card',
                'ordem' => 2,
                'tipo' => 'menu'
            ],
            [
                'id' => 3,
                'nome' => 'Painel Administrativo',
                'atalho' => 'administrativo',
                'url' => 'painel_administrativo.php',
                'icone' => 'fa-solid fa-gear',
                'ordem' => 3,
                'tipo' => 'menu'
            ],
            [
                'id' => 4,
                'nome' => 'Mídias',
                'atalho' => 'midias',
                'url' => 'midias.php',
                'icone' => 'fas fa-images',
                'ordem' => 4,
                'tipo' => 'menu'
            ],
            [
                'id' => 5,
                'nome' => 'Radio',
                'atalho' => 'radio',
                'url' => 'radio.php',
                'icone' => 'fa-solid fa-radio',
                'ordem' => 5,
                'tipo' => 'menu'
            ],
            [
                'id' => 6,
                'nome' => 'Quadro de Avisos',
                'atalho' => 'avisos',
                'url' => 'avisos.php',
                'icone' => 'fa-regular fa-bell',
                'ordem' => 6,
                'tipo' => 'menu'
            ],
            [
                'id' => 7,
                'nome' => 'Relatórios Ouvidoria',
                'atalho' => 'relatorios',
                'url' => 'relatorio_ouvidoria.php',
                'icone' => 'fa-regular fa-paste',
                'ordem' => 7,
                'tipo' => 'menu'
            ],
            [
                'id' => 8,
                'nome' => 'Notícias e Eventos',
                'atalho' => 'noticias',
                'url' => 'noticias.php',
                'icone' => 'fas fa-newspaper',
                'ordem' => 8,
                'tipo' => 'menu'
            ],
            [
                'id' => 9,
                'nome' => 'Personalizar Site',
                'atalho' => 'personalizar',
                'url' => 'personalizar_site.php',
                'icone' => 'fa-solid fa-sliders',
                'ordem' => 9,
                'tipo' => 'menu'
            ],
            [
                'id' => 10,
                'nome' => 'Estrutura da Prefeitura',
                'atalho' => 'estrutura',
                'url' => 'estrutura_prefeitura.php',
                'icone' => 'fa-solid fa-building-user',
                'ordem' => 10,
                'tipo' => 'menu'
            ],
            [
                'id' => 11,
                'nome' => 'Gestão e Transparencia',
                'atalho' => 'gestao',
                'url' => 'gestao_trans.php',
                'icone' => 'fa-solid fa-diagram-project',
                'ordem' => 11,
                'tipo' => 'menu'
            ],
            [
                'id' => 12,
                'nome' => 'Guia de Serviços',
                'atalho' => 'servicos',
                'url' => 'guia_servicos.php',
                'icone' => 'fa-solid fa-signs-post',
                'ordem' => 12,
                'tipo' => 'menu'
            ],
            //  [
            //     'id' => 13,
            //     'nome' => 'Testes',
            //     'atalho' => 'servicos',
            //     'url' => 'teste.php',
            //     'icone' => '',
            //     'ordem' => 13,
            //     'tipo' => 'menu'
            // ]

            
            // [
            //     'id' => 11,
            //     'nome' => '(X) Mailing',
            //     'atalho' => 'mailling',
            //     'url' => 'teste.php',
            //     'icone' => 'fa-regular fa-clipboard',
            //     'ordem' => 0,
            //     'tipo' => 'menu'
            // ],
            // [
            //     'id' => 14,
            //     'nome' => '(X) Comunicação Interna',
            //     'atalho' => 'comunicacao',
            //     'url' => 'teste.php',
            //     'icone' => 'fa-regular fa-address-book',
            //     'ordem' => 0,
            //     'tipo' => 'menu'
            // ],
            // [
            //     'id' => 15,
            //     'nome' => '(X) Sistemas',
            //     'atalho' => 'sistema',
            //     'url' => 'teste.php',
            //     'icone' => 'fa-solid fa-gears',
            //     'ordem' => 0,
            //     'tipo' => 'menu'
            // ],
            // [
            //     'id' => 16,
            //     'nome' => '(X) Informações',
            //     'atalho' => 'informacao',
            //     'url' => 'teste.php',
            //     'icone' => 'fa-solid fa-laptop-file',
            //     'ordem' => 7,
            //     'tipo' => 'menu'
            // ],
            //  [
            //     'id' => 17,
            //     'nome' => '(X) Alterar Senha LDAP',
            //     'atalho' => 'ldap',
            //     'url' => 'teste.php',
            //     'icone' => 'fa-solid fa-unlock-keyhole',
            //     'ordem' => 0,
            //     'tipo' => 'menu'
            // ]
          
        ];
    }
    
    /**
     * Renderizar menu HTML
     */
    private function renderMenu($items) {
        $html = '<ul class="sidebar__menu">';
        
        foreach ($items as $item) {
            $html .= $this->renderMenuItem($item);
        }
        
        $html .= '</ul>';
        return $html;
    }
    
    /**
     * Renderizar menu de erro
     */
    private function renderErrorMenu() {
        return '<ul class="sidebar__menu">
                    <li class="sidebar__item">
                        <a href="index.php" class="sidebar__link">
                            <i class="fas fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar__item">
                        <a href="#" class="sidebar__link">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>Erro no Menu</span>
                        </a>
                    </li>
                </ul>';
    }
    
    /**
     * Renderizar item do menu
     */
    private function renderMenuItem($item) {
        $currentPage = $_GET['atalho'] ?? 'dashbord'; /*puxa o nome do atalho*/
        
        $isActive = ($currentPage === $item['atalho']) ? 'active' : ''; /*o active não esta passando para os outro itens do menus*/
        $icon = $this->getIconForMenu($item['icone'], $item['nome']);
        
        return "
        <li class=\"sidebar__item\">
             <ul>
                <li>
                    <a href=\"{$item['url']}\" class=\"sidebar__link {$isActive}\">
                    <i class=\"{$icon}\"></i>
                    <span>{$item['nome']}</span>
                    </a>
                </li>
            </ul>
        </li>";
    }
    
    /**
     * Obter ícone para o menu
     */
    private function getIconForMenu($icon, $name) {
        if (!empty($icon)) {
            return $icon;
        }
        
        // Mapeamento de ícones padrão
        $iconMap = [
            'dashboard' => 'fas fa-home',
            'usuarios' => 'fas fa-users',
            'noticias' => 'fas fa-newspaper',
            'midias' => 'fas fa-images',
            'sistemas' => 'fas fa-cogs',
            'calendario' => 'fas fa-calendar',
            'mailing' => 'fas fa-envelope',
            'configuracoes' => 'fas fa-cog',
            'relatorios' => 'fas fa-chart-bar',
            'eventos' => 'fas fa-calendar-alt'
        ];
        
        $nameLower = strtolower($name);
        foreach ($iconMap as $key => $iconClass) {
            if (strpos($nameLower, $key) !== false) {
                return $iconClass;
            }
        }
        
        return 'fas fa-circle'; // Ícone padrão
    }
    
    /**
     * Verificar permissão específica
     */
    public function checkPermission($permission) {
        // Implementar verificação de permissões específicas
        return true; // Por enquanto, retorna true
    }
}

/**
 * Função helper para verificar acesso
 */
function hasMenuAccess($pageAtalho) {
    // Implementar verificação de acesso
    return true;
}
?>

