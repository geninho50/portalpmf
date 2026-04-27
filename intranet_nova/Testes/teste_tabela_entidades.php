<?php
header('Content-Type: text/html; charset=utf-8');

try {
    require_once("config/database.php");
    
    echo "<h1>🔍 Teste da Tabela Entidades</h1>";
    echo "<style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f7fa; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .success { color: #27ae60; background: #d4edda; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .error { color: #e74c3c; background: #f8d7da; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .info { color: #3498db; background: #d1ecf1; padding: 10px; border-radius: 5px; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f8f9fa; font-weight: bold; }
        .btn { display: inline-block; padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 5px; margin: 5px; }
        .btn:hover { background: #2980b9; }
    </style>";
    
    echo "<div class='container'>";
    
    // 1. Testar conexão com o banco
    echo "<h2>1. Teste de Conexão</h2>";
    try {
        $pdo->query("SELECT 1");
        echo "<div class='success'>✅ Conexão com o banco de dados estabelecida com sucesso!</div>";
    } catch (Exception $e) {
        echo "<div class='error'>❌ Erro na conexão: " . $e->getMessage() . "</div>";
        exit;
    }
    
    // 2. Verificar se a tabela entidades existe
    echo "<h2>2. Verificação da Tabela 'entidades'</h2>";
    $checkTable = "SELECT EXISTS (
        SELECT FROM information_schema.tables 
        WHERE table_name = 'entidades'
    )";
    
    try {
        $tableExists = $pdo->query($checkTable)->fetchColumn();
        
        if ($tableExists) {
            echo "<div class='success'>✅ Tabela 'entidades' encontrada no banco de dados!</div>";
        } else {
            echo "<div class='error'>❌ Tabela 'entidades' NÃO encontrada no banco de dados!</div>";
            echo "<div class='info'>💡 Você precisa criar a tabela 'entidades' primeiro.</div>";
            
            // Mostrar estrutura sugerida
            echo "<h3>Estrutura sugerida para a tabela 'entidades':</h3>";
            echo "<pre style='background: #f8f9fa; padding: 15px; border-radius: 5px; overflow-x: auto;'>
CREATE TABLE entidades (
    entidade_id SERIAL PRIMARY KEY,
    entidade_nome VARCHAR(255) NOT NULL,
    entidade_tipo VARCHAR(100),
    entidade_status BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserir algumas entidades de exemplo
INSERT INTO entidades (entidade_nome, entidade_tipo) VALUES
('Prefeitura Municipal de Florianópolis', 'Prefeitura'),
('Secretaria de Educação', 'Secretaria'),
('Secretaria de Saúde', 'Secretaria'),
('Secretaria de Transportes', 'Secretaria'),
('Secretaria de Cultura', 'Secretaria'),
('Secretaria de Administração', 'Secretaria'),
('Secretaria de Planejamento', 'Secretaria'),
('Secretaria de Meio Ambiente', 'Secretaria');
</pre>";
            exit;
        }
    } catch (Exception $e) {
        echo "<div class='error'>❌ Erro ao verificar tabela: " . $e->getMessage() . "</div>";
        exit;
    }
    
    // 3. Verificar estrutura da tabela
    echo "<h2>3. Estrutura da Tabela 'entidades'</h2>";
    try {
        $structureSql = "SELECT column_name, data_type, is_nullable, column_default 
                        FROM information_schema.columns 
                        WHERE table_name = 'entidades' 
                        ORDER BY ordinal_position";
        
        $structureStmt = $pdo->query($structureSql);
        $columns = $structureStmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (!empty($columns)) {
            echo "<table>";
            echo "<tr><th>Coluna</th><th>Tipo</th><th>Pode ser NULL</th><th>Valor Padrão</th></tr>";
            
            foreach ($columns as $column) {
                echo "<tr>";
                echo "<td><strong>" . htmlspecialchars($column['column_name']) . "</strong></td>";
                echo "<td>" . htmlspecialchars($column['data_type']) . "</td>";
                echo "<td>" . ($column['is_nullable'] == 'YES' ? 'Sim' : 'Não') . "</td>";
                echo "<td>" . htmlspecialchars($column['column_default'] ?? '-') . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='error'>❌ Não foi possível obter a estrutura da tabela.</div>";
        }
    } catch (Exception $e) {
        echo "<div class='error'>❌ Erro ao verificar estrutura: " . $e->getMessage() . "</div>";
    }
    
    // 4. Contar registros na tabela
    echo "<h2>4. Contagem de Registros</h2>";
    try {
        $countSql = "SELECT COUNT(*) as total FROM entidades";
        $count = $pdo->query($countSql)->fetchColumn();
        
        echo "<div class='info'>📊 Total de entidades cadastradas: <strong>" . $count . "</strong></div>";
        
        if ($count == 0) {
            echo "<div class='error'>⚠️ A tabela 'entidades' está vazia!</div>";
            echo "<div class='info'>💡 Você precisa inserir algumas entidades para testar a funcionalidade.</div>";
        }
    } catch (Exception $e) {
        echo "<div class='error'>❌ Erro ao contar registros: " . $e->getMessage() . "</div>";
    }
    
    // 5. Mostrar dados da tabela
    echo "<h2>5. Dados da Tabela 'entidades'</h2>";
    try {
        $dataSql = "SELECT * FROM entidades ORDER BY entidade_nome LIMIT 20";
        $dataStmt = $pdo->query($dataSql);
        $entities = $dataStmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (!empty($entities)) {
            echo "<table>";
            echo "<tr>";
            foreach (array_keys($entities[0]) as $header) {
                echo "<th>" . htmlspecialchars($header) . "</th>";
            }
            echo "</tr>";
            
            foreach ($entities as $entity) {
                echo "<tr>";
                foreach ($entity as $value) {
                    echo "<td>" . htmlspecialchars($value ?? '') . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='info'>📭 Nenhum registro encontrado na tabela.</div>";
        }
    } catch (Exception $e) {
        echo "<div class='error'>❌ Erro ao buscar dados: " . $e->getMessage() . "</div>";
    }
    
    // 6. Testar a API
    echo "<h2>6. Teste da API</h2>";
    echo "<div class='info'>🔗 <a href='backend/api/get_entities.php' target='_blank'>Clique aqui para testar a API diretamente</a></div>";
    
    // 7. Links úteis
    echo "<h2>7. Links Úteis</h2>";
    echo "<a href='teste_acentuacao.html' class='btn'>🧪 Teste de Acentuação</a>";
    echo "<a href='test_layout.php' class='btn'>📱 Teste de Layout</a>";
    echo "<a href='teste_botao_visivel.html' class='btn'>🍔 Teste do Botão</a>";
    
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Erro geral: " . $e->getMessage() . "</div>";
}
?>
