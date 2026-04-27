<?php
echo "<h1>🔍 Teste Simples de Conexão</h1>";

// Teste 1: Verificar se os arquivos existem
echo "<h2>1. Verificando Arquivos</h2>";
if (file_exists("config/compatibility.php")) {
    echo "✅ config/compatibility.php existe<br>";
} else {
    echo "❌ config/compatibility.php NÃO existe<br>";
}

if (file_exists("scripts/php/funcoes_bd.php")) {
    echo "✅ scripts/php/funcoes_bd.php existe<br>";
} else {
    echo "❌ scripts/php/funcoes_bd.php NÃO existe<br>";
}

if (file_exists("scripts/php/config.php")) {
    echo "✅ scripts/php/config.php existe<br>";
} else {
    echo "❌ scripts/php/config.php NÃO existe<br>";
}

// Teste 2: Tentar incluir os arquivos
echo "<h2>2. Testando Inclusão de Arquivos</h2>";
try {
    require_once("config/compatibility.php");
    echo "✅ Arquivos incluídos com sucesso<br>";
} catch (Exception $e) {
    echo "❌ Erro ao incluir arquivos: " . $e->getMessage() . "<br>";
}

// Teste 3: Verificar se a variável $drive foi criada
echo "<h2>3. Verificando Variável \$drive</h2>";
if (isset($drive)) {
    echo "✅ Variável \$drive existe<br>";
    echo "Tipo: " . get_class($drive) . "<br>";
} else {
    echo "❌ Variável \$drive NÃO existe<br>";
}

// Teste 4: Tentar conectar
echo "<h2>4. Testando Conexão</h2>";
if (isset($drive)) {
    try {
        $resultado = $drive->conecta();
        if ($resultado) {
            echo "✅ Conexão estabelecida com sucesso!<br>";
            
            // Teste 5: Verificar tabela uni_usuarios
            echo "<h2>5. Testando Tabela uni_usuarios</h2>";
            $sql = "SELECT COUNT(*) as total FROM uni_usuarios";
            $result = $drive->pedido($sql);
            
            if ($result) {
                $row = pg_fetch_object($result);
                echo "✅ Tabela uni_usuarios encontrada! Total: " . $row->total . " usuários<br>";
                
                // Mostrar 3 usuários de exemplo
                $sql = "SELECT user_id, user_nome, user_login FROM uni_usuarios LIMIT 3";
                $result = $drive->pedido($sql);
                
                echo "<h3>Usuários de Exemplo:</h3>";
                echo "<ul>";
                while ($user = pg_fetch_object($result)) {
                    echo "<li>ID: " . $user->user_id . " - Nome: " . htmlspecialchars($user->user_nome) . " - Login: " . htmlspecialchars($user->user_login) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "❌ Erro ao acessar tabela uni_usuarios<br>";
            }
            
            $drive->close();
        } else {
            echo "❌ Falha na conexão<br>";
        }
    } catch (Exception $e) {
        echo "❌ Erro na conexão: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ Não é possível testar conexão - variável \$drive não existe<br>";
}

echo "<hr>";
echo "<h2>🔗 Links</h2>";
echo "<p><a href='login.php'>→ Ir para login.php</a></p>";
echo "<p><a href='index.php'>→ Ir para index.php</a></p>";
?>
