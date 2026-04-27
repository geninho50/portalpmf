<?php
// Arquivo de debug para identificar erros
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

echo "<h1>Debug - Intranet PMF</h1>";

// Teste 1: Verificar se o PHP está funcionando
echo "<h2>1. Teste PHP</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "PDO disponível: " . (extension_loaded('pdo') ? 'Sim' : 'Não') . "<br>";
echo "PDO PostgreSQL disponível: " . (extension_loaded('pdo_pgsql') ? 'Sim' : 'Não') . "<br>";

// Teste 2: Verificar se os arquivos existem
echo "<h2>2. Verificação de Arquivos</h2>";
$files = [
    'config/database.php',
    'includes/functions.php',
    'assets/css/modern.css',
    'assets/css/components.css',
    'assets/js/modern.js',
    'assets/js/dashboard.js'
];

foreach ($files as $file) {
    echo "$file: " . (file_exists($file) ? 'Existe' : 'NÃO EXISTE') . "<br>";
}

// Teste 3: Testar conexão com banco de dados
echo "<h2>3. Teste de Conexão com Banco</h2>";
try {
    require_once("config/database.php");
    echo "Conexão com banco: OK<br>";
    
    // Testar uma query simples
    $test = $pdo->query("SELECT 1 as test")->fetch();
    echo "Query de teste: OK<br>";
    
} catch (Exception $e) {
    echo "Erro na conexão: " . $e->getMessage() . "<br>";
}

// Teste 4: Verificar se as tabelas existem
echo "<h2>4. Verificação de Tabelas</h2>";
try {
    // Tabelas do sistema atual
    $tables_current = ['uni_usuarios', 'intranet_permissoes', 'intranet_perfil', 'entidades', 'grupo'];
    
    echo "<h3>Tabelas do Sistema Atual:</h3>";
    foreach ($tables_current as $table) {
        try {
            $result = $pdo->query("SELECT COUNT(*) FROM $table LIMIT 1")->fetch();
            echo "Tabela $table: Existe<br>";
        } catch (Exception $e) {
            echo "Tabela $table: NÃO EXISTE - " . $e->getMessage() . "<br>";
        }
    }
    
    // Tabelas do sistema novo
    $tables_new = ['usuarios', 'noticias', 'midias', 'eventos', 'notificacoes'];
    
    echo "<h3>Tabelas do Sistema Novo:</h3>";
    foreach ($tables_new as $table) {
        try {
            $result = $pdo->query("SELECT COUNT(*) FROM $table LIMIT 1")->fetch();
            echo "Tabela $table: Existe<br>";
        } catch (Exception $e) {
            echo "Tabela $table: NÃO EXISTE - " . $e->getMessage() . "<br>";
        }
    }
} catch (Exception $e) {
    echo "Erro ao verificar tabelas: " . $e->getMessage() . "<br>";
}

// Teste 5: Verificar sessão
echo "<h2>5. Teste de Sessão</h2>";
session_start();
echo "Sessão iniciada: " . (session_status() === PHP_SESSION_ACTIVE ? 'Sim' : 'Não') . "<br>";
echo "ID da sessão: " . session_id() . "<br>";

// Teste 6: Verificar permissões de diretório
echo "<h2>6. Permissões de Diretório</h2>";
$dirs = ['assets/css', 'assets/js', 'uploads'];
foreach ($dirs as $dir) {
    if (is_dir($dir)) {
        echo "$dir: " . (is_readable($dir) ? 'Legível' : 'NÃO LEGÍVEL') . " / " . 
             (is_writable($dir) ? 'Gravável' : 'NÃO GRAVÁVEL') . "<br>";
    } else {
        echo "$dir: Diretório não existe<br>";
    }
}

// Teste 7: Verificar se as funções estão carregadas
echo "<h2>7. Verificação de Funções</h2>";
try {
    require_once("includes/functions.php");
    $functions = ['getDashboardStats', 'getRecentNews', 'getRecentMedia', 'formatDate'];
    
    foreach ($functions as $func) {
        echo "Função $func: " . (function_exists($func) ? 'Existe' : 'NÃO EXISTE') . "<br>";
    }
} catch (Exception $e) {
    echo "Erro ao carregar funções: " . $e->getMessage() . "<br>";
}

// Teste 8: Verificar compatibilidade com sistema atual
echo "<h2>8. Teste de Compatibilidade</h2>";
try {
    require_once("config/compatibility.php");
    echo "Arquivo de compatibilidade: Carregado<br>";
    
    // Testar classe banco
    if (class_exists('banco')) {
        echo "Classe banco: Existe<br>";
    } else {
        echo "Classe banco: NÃO EXISTE<br>";
    }
    
    // Testar variável $drive
    if (isset($drive)) {
        echo "Variável \$drive: Existe<br>";
    } else {
        echo "Variável \$drive: NÃO EXISTE<br>";
    }
    
    // Testar conexão com banco antigo
    if ($drive->conecta()) {
        echo "Conexão com banco antigo: OK<br>";
        $drive->close();
    } else {
        echo "Conexão com banco antigo: ERRO<br>";
    }
    
} catch (Exception $e) {
    echo "Erro na compatibilidade: " . $e->getMessage() . "<br>";
}

echo "<h2>Debug Concluído</h2>";
echo "<p>Se você vê esta página, o PHP está funcionando. Verifique os resultados acima para identificar problemas.</p>";
?>
