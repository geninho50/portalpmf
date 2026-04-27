<?php
/**
 * Script para analisar o banco de dados existente
 * Identifica todas as tabelas e seus relacionamentos
 */

require_once("config/compatibility.php");

echo "<h1>Análise do Banco de Dados - Intranet PMF</h1>";

// 1. Listar todas as tabelas
echo "<h2>1. Todas as Tabelas do Banco</h2>";
$sql = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' ORDER BY table_name";
$result = $drive->pedido($sql);

$tabelas = [];
while ($row = pg_fetch_object($result)) {
    $tabelas[] = $row->table_name;
}

echo "<ul>";
foreach ($tabelas as $tabela) {
    echo "<li><strong>$tabela</strong></li>";
}
echo "</ul>";

// 2. Analisar estrutura das principais tabelas
echo "<h2>2. Estrutura das Tabelas Principais</h2>";

$tabelas_principais = [
    'uni_usuarios',
    'intranet_permissoes', 
    'intranet_perfil',
    'entidades',
    'grupo',
    'intranet_menu',
    'intranet_submenu',
    'intranet_menu_relacionado',
    'intranet_perfil_menu',
    'intranet_perfil_submenu',
    'intranet_log_acesso'
];

foreach ($tabelas_principais as $tabela) {
    if (in_array($tabela, $tabelas)) {
        echo "<h3>Tabela: $tabela</h3>";
        
        $sql = "SELECT column_name, data_type, is_nullable, column_default 
                FROM information_schema.columns 
                WHERE table_name = '$tabela' 
                ORDER BY ordinal_position";
        $result = $drive->pedido($sql);
        
        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
        echo "<tr><th>Coluna</th><th>Tipo</th><th>Null</th><th>Default</th></tr>";
        
        while ($row = pg_fetch_object($result)) {
            echo "<tr>";
            echo "<td>{$row->column_name}</td>";
            echo "<td>{$row->data_type}</td>";
            echo "<td>{$row->is_nullable}</td>";
            echo "<td>{$row->column_default}</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Contar registros
        $sql_count = "SELECT COUNT(*) as total FROM $tabela";
        $result_count = $drive->pedido($sql_count);
        $count = pg_fetch_object($result_count);
        echo "<p><strong>Total de registros:</strong> {$count->total}</p>";
    }
}

// 3. Analisar relacionamentos (chaves estrangeiras)
echo "<h2>3. Relacionamentos (Chaves Estrangeiras)</h2>";

$sql = "SELECT 
            tc.table_name, 
            kcu.column_name, 
            ccu.table_name AS foreign_table_name,
            ccu.column_name AS foreign_column_name 
        FROM 
            information_schema.table_constraints AS tc 
            JOIN information_schema.key_column_usage AS kcu
              ON tc.constraint_name = kcu.constraint_name
              AND tc.table_schema = kcu.table_schema
            JOIN information_schema.constraint_column_usage AS ccu
              ON ccu.constraint_name = tc.constraint_name
              AND ccu.table_schema = tc.table_schema
        WHERE tc.constraint_type = 'FOREIGN KEY' 
        ORDER BY tc.table_name, kcu.column_name";

$result = $drive->pedido($sql);

echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
echo "<tr><th>Tabela</th><th>Coluna</th><th>Tabela Referenciada</th><th>Coluna Referenciada</th></tr>";

while ($row = pg_fetch_object($result)) {
    echo "<tr>";
    echo "<td>{$row->table_name}</td>";
    echo "<td>{$row->column_name}</td>";
    echo "<td>{$row->foreign_table_name}</td>";
    echo "<td>{$row->foreign_column_name}</td>";
    echo "</tr>";
}
echo "</table>";

// 4. Analisar dados de exemplo das principais tabelas
echo "<h2>4. Dados de Exemplo</h2>";

// Usuários
echo "<h3>Usuários (primeiros 5)</h3>";
$sql = "SELECT user_id, user_nome, user_login, user_maticula, user_entidade_id FROM uni_usuarios LIMIT 5";
$result = $drive->pedido($sql);

echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
echo "<tr><th>ID</th><th>Nome</th><th>Login</th><th>Matrícula</th><th>Entidade ID</th></tr>";

while ($row = pg_fetch_object($result)) {
    echo "<tr>";
    echo "<td>{$row->user_id}</td>";
    echo "<td>{$row->user_nome}</td>";
    echo "<td>{$row->user_login}</td>";
    echo "<td>{$row->user_maticula}</td>";
    echo "<td>{$row->user_entidade_id}</td>";
    echo "</tr>";
}
echo "</table>";

// Menus
echo "<h3>Menus</h3>";
$sql = "SELECT intranet_menu_id, intranet_menu_nome, intranet_menu_atalho, intranet_menu_tipo_pai FROM intranet_menu LIMIT 10";
$result = $drive->pedido($sql);

echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
echo "<tr><th>ID</th><th>Nome</th><th>Atalho</th><th>Tipo Pai</th></tr>";

while ($row = pg_fetch_object($result)) {
    echo "<tr>";
    echo "<td>{$row->intranet_menu_id}</td>";
    echo "<td>{$row->intranet_menu_nome}</td>";
    echo "<td>{$row->intranet_menu_atalho}</td>";
    echo "<td>{$row->intranet_menu_tipo_pai}</td>";
    echo "</tr>";
}
echo "</table>";

// Submenus
echo "<h3>Submenus</h3>";
$sql = "SELECT intranet_submenu_id, intranet_submenu_nome, intranet_submenu_atalho, intranet_submenu_endereco_fisico FROM intranet_submenu LIMIT 10";
$result = $drive->pedido($sql);

echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
echo "<tr><th>ID</th><th>Nome</th><th>Atalho</th><th>Endereço Físico</th></tr>";

while ($row = pg_fetch_object($result)) {
    echo "<tr>";
    echo "<td>{$row->intranet_submenu_id}</td>";
    echo "<td>{$row->intranet_submenu_nome}</td>";
    echo "<td>{$row->intranet_submenu_atalho}</td>";
    echo "<td>{$row->intranet_submenu_endereco_fisico}</td>";
    echo "</tr>";
}
echo "</table>";

// 5. Modelo ER Resumido
echo "<h2>5. Modelo ER Resumido</h2>";

echo "<h3>Entidades Principais:</h3>";
echo "<ul>";
echo "<li><strong>uni_usuarios</strong> - Usuários do sistema</li>";
echo "<li><strong>entidades</strong> - Entidades/Órgãos</li>";
echo "<li><strong>grupo</strong> - Grupos de usuários</li>";
echo "<li><strong>intranet_perfil</strong> - Perfis de acesso</li>";
echo "<li><strong>intranet_menu</strong> - Menus principais</li>";
echo "<li><strong>intranet_submenu</strong> - Submenus/Páginas</li>";
echo "<li><strong>intranet_menu_relacionado</strong> - Menus relacionados</li>";
echo "</ul>";

echo "<h3>Relacionamentos:</h3>";
echo "<ul>";
echo "<li><strong>uni_usuarios</strong> → <strong>entidades</strong> (user_entidade_id)</li>";
echo "<li><strong>uni_usuarios</strong> → <strong>grupo</strong> (user_grupo_id)</li>";
echo "<li><strong>intranet_permissoes</strong> → <strong>uni_usuarios</strong> (intranet_user_id)</li>";
echo "<li><strong>intranet_permissoes</strong> → <strong>intranet_perfil</strong> (intranet_perfil_id)</li>";
echo "<li><strong>intranet_permissoes</strong> → <strong>entidades</strong> (intranet_entidade_id)</li>";
echo "<li><strong>intranet_perfil_menu</strong> → <strong>intranet_perfil</strong> (intranet_perfil_menu_perfil_id)</li>";
echo "<li><strong>intranet_perfil_menu</strong> → <strong>intranet_menu</strong> (intranet_perfil_menu_menu_id)</li>";
echo "<li><strong>intranet_perfil_submenu</strong> → <strong>intranet_perfil</strong> (intranet_perfil_submenu_perfil_id)</li>";
echo "<li><strong>intranet_perfil_submenu</strong> → <strong>intranet_submenu</strong> (intranet_perfil_submenu_submenu_id)</li>";
echo "</ul>";

echo "<h3>Sistema de Permissões:</h3>";
echo "<p>O sistema usa um modelo de permissões baseado em:</p>";
echo "<ol>";
echo "<li><strong>Perfis</strong> (intranet_perfil) - Define tipos de acesso</li>";
echo "<li><strong>Permissões</strong> (intranet_permissoes) - Associa usuário + perfil + entidade</li>";
echo "<li><strong>Menus Permitidos</strong> (intranet_perfil_menu) - Quais menus o perfil pode acessar</li>";
echo "<li><strong>Submenus Permitidos</strong> (intranet_perfil_submenu) - Quais páginas o perfil pode acessar</li>";
echo "</ol>";

echo "<h3>Estrutura de Menu:</h3>";
echo "<p>O menu é construído dinamicamente baseado em:</p>";
echo "<ol>";
echo "<li><strong>intranet_menu</strong> - Menus principais (tipo_pai = 'f' para menus finais)</li>";
echo "<li><strong>intranet_submenu</strong> - Submenus/páginas com endereços físicos</li>";
echo "<li><strong>intranet_menu_relacionado</strong> - Menus relacionados com caminhos físicos</li>";
echo "</ol>";

echo "<hr>";
echo "<p><strong>Análise concluída.</strong> Este é o modelo de dados atual do sistema.</p>";
?>
