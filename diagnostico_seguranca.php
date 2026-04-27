<?php
header('Content-Type: text/plain; charset=utf-8');

echo "=== RELATÓRIO DE DIAGNÓSTICO DE SEGURANÇA ===\n";
echo "Data: " . date('Y-m-d H:i:s') . "\n";
echo "Servidor: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
echo "Usuário: " . get_current_user() . " (UID: " . getmyuid() . ")\n";
echo "Diretório Atual: " . __DIR__ . "\n\n";

// 1. Verificar Pastas/Arquivos Críticos do Ataque
echo "--- 1. VERIFICAÇÃO DE ARQUIVOS MALICIOSOS CONHECIDOS ---\n";
$suspects = ['file867', 'bet-portal', 'jogar-bet', 'cassino', 'wp-content', 'wp-includes', '.well-known', 'images/stories/file867'];
$found = false;
foreach ($suspects as $suspect) {
    if (file_exists(__DIR__ . '/' . $suspect)) {
        echo "[PERIGO] Encontrado: " . $suspect . " (Tipo: " . (is_dir(__DIR__ . '/' . $suspect) ? 'Pasta' : 'Arquivo') . ")\n";
        $found = true;
    } else {
        echo "[OK] Não encontrado: " . $suspect . "\n";
    }
}
if (!$found) echo "Nenhum arquivo/pasta óbvio do ataque encontrado na raiz.\n";

// 2. Verificar Injeções no PHP (auto_prepend_file)
echo "\n--- 2. VERIFICAÇÃO DE CONFIGURAÇÕES PHP (auto_prepend_file) ---\n";
$prepend = ini_get('auto_prepend_file');
$append = ini_get('auto_append_file');
echo "auto_prepend_file: " . ($prepend ? $prepend : "Nenhum") . "\n";
echo "auto_append_file: " . ($append ? $append : "Nenhum") . "\n";

if ($prepend || $append) {
    echo "[ALERTA] Scripts estão sendo carregados automaticamente antes de cada página!\n";
}

// 3. Verificar Integridade do .htaccess
echo "\n--- 3. CONTEÚDO DO .htaccess ---\n";
if (file_exists(__DIR__ . '/.htaccess')) {
    $htaccess = file_get_contents(__DIR__ . '/.htaccess');
    echo "Tamanho: " . filesize(__DIR__ . '/.htaccess') . " bytes\n";
    echo "Conteúdo (primeiras 20 linhas):\n";
    echo substr($htaccess, 0, 1000) . "\n...\n";
    
    if (strpos($htaccess, 'file867') !== false) {
        echo "[OK] Regras de bloqueio 'file867' encontradas no .htaccess.\n";
    } else {
        echo "[FALHA] Regras de bloqueio NÃO encontradas no .htaccess!\n";
    }
} else {
    echo "[CRÍTICO] Arquivo .htaccess NÃO ENCONTRADO na raiz!\n";
}

// 4. Verificar Integridade do index.php
echo "\n--- 4. CABEÇALHO DO index.php ---\n";
if (file_exists(__DIR__ . '/index.php')) {
    $index = file_get_contents(__DIR__ . '/index.php');
    echo substr($index, 0, 300) . "\n...\n";
    if (strpos($index, 'security.php') !== false) {
        echo "[OK] Inclusão de security.php encontrada.\n";
    } else {
        echo "[FALHA] Inclusão de security.php NÃO encontrada.\n";
    }
}

// 5. Listar Arquivos Modificados Recentemente (Últimos 7 dias)
echo "\n--- 5. ARQUIVOS MODIFICADOS NOS ÚLTIMOS 7 DIAS ---\n";
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__));
$count = 0;
foreach ($iterator as $file) {
    if ($file->isFile()) {
        if ($file->getMTime() > (time() - 7 * 24 * 3600)) {
            // Ignora arquivos de log e cache se possível
            if (strpos($file->getPathname(), '/logs/') === false && strpos($file->getPathname(), '/cache/') === false) {
                echo date('Y-m-d H:i:s', $file->getMTime()) . " - " . $file->getPathname() . "\n";
                $count++;
            }
        }
    }
    if ($count > 50) {
        echo "... (lista truncada, muitos arquivos modificados)\n";
        break;
    }
}
if ($count == 0) echo "Nenhum arquivo modificado recentemente encontrado.\n";

echo "\n=== FIM DO DIAGNÓSTICO ===\n";
?>