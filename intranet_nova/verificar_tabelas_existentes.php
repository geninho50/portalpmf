<?php
header('Content-Type: text/html; charset=utf-8');

try {
    require_once("config/database.php");
    
    echo "<h1>🔍 Verificando Tabelas Existentes no Banco</h1>";
    echo "<style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f7fa; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .success { color: #27ae60; background: #d4edda; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .error { color: #e74c3c; background: #f8d7da; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .info { color: #3498db; background: #d1ecf1; padding: 10px; border-radius: 5px; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f8f9fa; font-weight: bold; }
        .btn { display: inline-block; padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 5px; margin: 5px; }
        .btn:hover { background: #2980b9; }
        .highlight { background: #fff3cd; padding: 5px; border-radius: 3px; }
    </style>";
    
    echo "<div class='container'>";
    
    // 1. Testar conexão
    echo "<h2>1. Teste de Conexão</h2>";
    try {
        $pdo->query("SELECT 1");
        echo "<div class='success'>✅ Conexão com o banco de dados estabelecida!</div>";
    } catch (Exception $e) {
        echo "<div class='error'>❌ Erro na conexão: " . $e->getMessage() . "</div>";
        exit;
    }
    
    // 2. Listar todas as tabelas do banco
    echo "<h2>2. Todas as Tabelas do Banco de Dados</h2>";
    try {
        $tablesSql = "SELECT table_name 
                     FROM information_schema.tables 
                     WHERE table_schema = 'public' 
                     ORDER BY table_name";
        
        $tablesStmt = $pdo->query($tablesSql);
        $tables = $tablesStmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (!empty($tables)) {
            echo "<div class='info'>📊 Total de tabelas encontradas: <strong>" . count($tables) . "</strong></div>";
            
            echo "<table>";
            echo "<tr><th>Nome da Tabela</th><th>Possível Tabela de Entidades?</th></tr>";
            
            foreach ($tables as $table) {
                $isEntityTable = false;
                $reason = "";
                
                // Verificar se parece ser uma tabela de entidades
                if (stripos($table, 'entidade') !== false) {
                    $isEntityTable = true;
                    $reason = "Contém 'entidade' no nome";
                } elseif (stripos($table, 'empresa') !== false) {
                    $isEntityTable = true;
                    $reason = "Contém 'empresa' no nome";
                } elseif (stripos($table, 'unidade') !== false) {
                    $isEntityTable = true;
                    $reason = "Contém 'unidade' no nome";
                } elseif (stripos($table, 'orgao') !== false) {
                    $isEntityTable = true;
                    $reason = "Contém 'orgao' no nome";
                } elseif (stripos($table, 'secretaria') !== false) {
                    $isEntityTable = true;
                    $reason = "Contém 'secretaria' no nome";
                }
                
                $highlight = $isEntityTable ? "class='highlight'" : "";
                $icon = $isEntityTable ? "🏢" : "📋";
                
                echo "<tr $highlight>";
                echo "<td><strong>$icon $table</strong></td>";
                echo "<td>" . ($isEntityTable ? "✅ Sim - $reason" : "❌ Não") . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='error'>❌ Nenhuma tabela encontrada no banco.</div>";
        }
    } catch (Exception $e) {
        echo "<div class='error'>❌ Erro ao listar tabelas: " . $e->getMessage() . "</div>";
    }
    
    // 3. Verificar tabelas que podem ser de entidades
    echo "<h2>3. Verificando Possíveis Tabelas de Entidades</h2>";
    
    $possibleEntityTables = [];
    foreach ($tables as $table) {
        if (stripos($table, 'entidade') !== false || 
            stripos($table, 'empresa') !== false || 
            stripos($table, 'unidade') !== false || 
            stripos($table, 'orgao') !== false || 
            stripos($table, 'secretaria') !== false) {
            $possibleEntityTables[] = $table;
        }
    }
    
    if (!empty($possibleEntityTables)) {
        echo "<div class='success'>🎯 Encontradas " . count($possibleEntityTables) . " possíveis tabelas de entidades:</div>";
        
        foreach ($possibleEntityTables as $table) {
            echo "<h3>📋 Tabela: <span class='highlight'>$table</span></h3>";
            
            try {
                // Verificar estrutura da tabela
                $structureSql = "SELECT column_name, data_type, is_nullable 
                                FROM information_schema.columns 
                                WHERE table_name = '$table' 
                                ORDER BY ordinal_position";
                
                $structureStmt = $pdo->query($structureSql);
                $columns = $structureStmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (!empty($columns)) {
                    echo "<table>";
                    echo "<tr><th>Coluna</th><th>Tipo</th><th>Pode ser NULL</th></tr>";
                    
                    foreach ($columns as $column) {
                        echo "<tr>";
                        echo "<td><strong>" . htmlspecialchars($column['column_name']) . "</strong></td>";
                        echo "<td>" . htmlspecialchars($column['data_type']) . "</td>";
                        echo "<td>" . ($column['is_nullable'] == 'YES' ? 'Sim' : 'Não') . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                
                // Contar registros
                $countSql = "SELECT COUNT(*) as total FROM $table";
                $count = $pdo->query($countSql)->fetchColumn();
                echo "<div class='info'>📊 Total de registros: <strong>$count</strong></div>";
                
                // Mostrar alguns dados de exemplo
                if ($count > 0) {
                    $sampleSql = "SELECT * FROM $table LIMIT 5";
                    $sampleStmt = $pdo->query($sampleSql);
                    $samples = $sampleStmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if (!empty($samples)) {
                        echo "<h4>📝 Exemplos de dados:</h4>";
                        echo "<table>";
                        echo "<tr>";
                        foreach (array_keys($samples[0]) as $header) {
                            echo "<th>" . htmlspecialchars($header) . "</th>";
                        }
                        echo "</tr>";
                        
                        foreach ($samples as $sample) {
                            echo "<tr>";
                            foreach ($sample as $value) {
                                echo "<td>" . htmlspecialchars($value ?? '') . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                }
                
            } catch (Exception $e) {
                echo "<div class='error'>❌ Erro ao verificar tabela $table: " . $e->getMessage() . "</div>";
            }
            
            echo "<hr>";
        }
    } else {
        echo "<div class='info'>ℹ️ Nenhuma tabela com nome relacionado a entidades foi encontrada.</div>";
        echo "<div class='info'>💡 Verifique se existe uma tabela com nomes como: entidade, empresa, unidade, orgao, secretaria, etc.</div>";
    }
    
    // 4. Links úteis
    echo "<h2>4. Próximos Passos</h2>";
    echo "<div class='info'>🔧 Após identificar a tabela correta, vamos ajustar o código para usar ela.</div>";
    echo "<a href='teste_acentuacao.html' class='btn'>🧪 Teste de Acentuação</a>";
    echo "<a href='test_layout.php' class='btn'>📱 Teste de Layout</a>";
    
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Erro geral: " . $e->getMessage() . "</div>";
}
?>
