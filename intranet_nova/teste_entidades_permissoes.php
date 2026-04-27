<?php
session_start();
require_once("config/compatibility.php");

echo "<h1>🔐 Teste de Permissões de Entidades</h1>";

// Verificar se está logado
if (!isset($_SESSION['SuserId'])) {
    echo "<div style='background: #f8d7da; padding: 15px; border-radius: 8px;'>";
    echo "❌ Usuário não está logado. <a href='login.php'>Fazer login</a>";
    echo "</div>";
    exit;
}

echo "<div style='background: #d4edda; padding: 15px; border-radius: 8px; margin-bottom: 20px;'>";
echo "<h2>✅ Usuário Logado</h2>";
echo "<p><strong>ID:</strong> " . $_SESSION['SuserId'] . "</p>";
echo "<p><strong>Nome:</strong> " . htmlspecialchars($_SESSION['SuserNome']) . "</p>";
echo "<p><strong>Entidade Atual:</strong> " . $_SESSION['SuserEnt'] . "</p>";
echo "<p><strong>Perfil ID:</strong> " . ($_SESSION['SuserPerfilId'] ?? 'N/A') . "</p>";
echo "</div>";

try {
    $drive->conecta();
    
    // 1. Verificar permissões do usuário
    echo "<h2>1. Permissões do Usuário</h2>";
    $sql = "SELECT p.intranet_perfil_id, p.intranet_entidade_id, 
                   pf.intranet_perfil_nome, e.entidade_nome, e.entidade_sigla
            FROM intranet_permissoes p
            LEFT JOIN intranet_perfil pf ON p.intranet_perfil_id = pf.intranet_perfil_id
            LEFT JOIN entidades e ON p.intranet_entidade_id = e.entidade_id
            WHERE p.intranet_user_id = " . $_SESSION['SuserId'];
    
    $result = $drive->pedido($sql);
    
    if (pg_num_rows($result) > 0) {
        echo "<div style='background: #f8f9fa; padding: 15px; border-radius: 8px;'>";
        echo "<h3>Permissões encontradas:</h3>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>Perfil ID</th><th>Perfil Nome</th><th>Entidade ID</th><th>Entidade Nome</th><th>Sigla</th></tr>";
        
        while ($row = pg_fetch_object($result)) {
            echo "<tr>";
            echo "<td>" . $row->intranet_perfil_id . "</td>";
            echo "<td>" . htmlspecialchars($row->intranet_perfil_nome ?? 'N/A') . "</td>";
            echo "<td>" . $row->intranet_entidade_id . "</td>";
            echo "<td>" . htmlspecialchars($row->entidade_nome ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row->entidade_sigla ?? 'N/A') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<div style='background: #fff3cd; padding: 15px; border-radius: 8px;'>";
        echo "<h3>⚠️ Nenhuma permissão específica encontrada</h3>";
        echo "<p>O usuário não tem permissões específicas na tabela intranet_permissoes.</p>";
        echo "</div>";
    }
    
    // 2. Verificar entidades disponíveis
    echo "<h2>2. Entidades Disponíveis</h2>";
    $sql = "SELECT entidade_id, entidade_nome, entidade_sigla, mostrar, entidade_excluida 
            FROM entidades 
            WHERE mostrar = true AND entidade_excluida = false 
            ORDER BY entidade_nome 
            LIMIT 10";
    
    $result = $drive->pedido($sql);
    
    if (pg_num_rows($result) > 0) {
        echo "<div style='background: #f8f9fa; padding: 15px; border-radius: 8px;'>";
        echo "<h3>Entidades ativas (primeiras 10):</h3>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Sigla</th><th>Mostrar</th><th>Excluída</th></tr>";
        
        while ($row = pg_fetch_object($result)) {
            echo "<tr>";
            echo "<td>" . $row->entidade_id . "</td>";
            echo "<td>" . htmlspecialchars($row->entidade_nome) . "</td>";
            echo "<td>" . htmlspecialchars($row->entidade_sigla ?? 'N/A') . "</td>";
            echo "<td>" . ($row->mostrar ? 'Sim' : 'Não') . "</td>";
            echo "<td>" . ($row->entidade_excluida ? 'Sim' : 'Não') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    }
    
    // 3. Testar EntitySwitcher
    echo "<h2>3. Teste do EntitySwitcher</h2>";
    require_once("includes/entity_switcher.php");
    
    $entitySwitcher = new EntitySwitcher(
        $pdo,
        $_SESSION['SuserId'],
        $_SESSION['SuserEnt'] ?? 1
    );
    
    $entities = $entitySwitcher->getUserEntities();
    
    echo "<div style='background: #f8f9fa; padding: 15px; border-radius: 8px;'>";
    echo "<h3>Entidades que o usuário pode acessar:</h3>";
    
    if (!empty($entities)) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Sigla</th><th>Selecionada</th></tr>";
        
        foreach ($entities as $entity) {
            $selected = ($entity['entidade_id'] == $_SESSION['SuserEnt']) ? '✅ Sim' : '❌ Não';
            echo "<tr>";
            echo "<td>" . $entity['entidade_id'] . "</td>";
            echo "<td>" . htmlspecialchars($entity['entidade_nome']) . "</td>";
            echo "<td>" . htmlspecialchars($entity['entidade_sigla'] ?? 'N/A') . "</td>";
            echo "<td>" . $selected . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        echo "<p><strong>Total de entidades:</strong> " . count($entities) . "</p>";
        
        if (count($entities) <= 1) {
            echo "<p style='color: #856404;'>⚠️ Usuário tem acesso a apenas uma entidade - combo não será exibida</p>";
        } else {
            echo "<p style='color: #155724;'>✅ Usuário tem acesso a múltiplas entidades - combo será exibida</p>";
        }
    } else {
        echo "<p style='color: #721c24;'>❌ Nenhuma entidade encontrada para o usuário</p>";
    }
    echo "</div>";
    
    // 4. Testar renderização
    echo "<h2>4. Renderização da Combo</h2>";
    echo "<div style='background: #f8f9fa; padding: 15px; border-radius: 8px;'>";
    echo "<h3>HTML gerado:</h3>";
    echo "<pre style='background: #fff; padding: 10px; border-radius: 4px; overflow-x: auto;'>";
    echo htmlspecialchars($entitySwitcher->render());
    echo "</pre>";
    echo "</div>";
    
    $drive->close();
    
} catch (Exception $e) {
    echo "<div style='background: #f8d7da; padding: 15px; border-radius: 8px;'>";
    echo "❌ Erro: " . $e->getMessage();
    echo "</div>";
}

echo "<hr>";
echo "<h2>🔗 Links Úteis</h2>";
echo "<p><a href='index.php' style='color: #007cba;'>→ Ir para index.php</a></p>";
echo "<p><a href='login.php' style='color: #007cba;'>→ Ir para login.php</a></p>";
echo "<p><a href='teste_conexao_simples.php' style='color: #007cba;'>→ Teste de conexão</a></p>";
?>
