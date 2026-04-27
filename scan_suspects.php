<?php
/**
 * Ferramenta de Varredura de Arquivos Suspeitos
 * RODE ESTE ARQUIVO NO SERVIDOR E DEPOIS APAGUE-O!
 */

header('Content-Type: text/plain; charset=utf-8');

echo "INICIANDO VARREDURA DE ARQUIVOS SUSPEITOS...\n";
echo "Diretório Raiz: " . __DIR__ . "\n\n";

$suspectPatterns = ['bet', 'cassino', 'slot', 'game', 'jogar', 'file867', 'wp-', 'bak', 'old'];
$suspectExtensions = ['php', 'html', 'htm', 'js'];
$ignoreDirs = ['.', '..', '.git', 'vendor', 'node_modules'];

function scanDirRecursive($dir) {
    global $suspectPatterns, $suspectExtensions, $ignoreDirs;
    
    $files = scandir($dir);
    
    foreach ($files as $file) {
        if (in_array($file, $ignoreDirs)) continue;
        
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        
        if (is_dir($path)) {
            // Verifica se o nome da pasta é suspeito
            foreach ($suspectPatterns as $pattern) {
                if (stripos($file, $pattern) !== false) {
                    echo "[PASTA SUSPEITA] " . $path . "\n";
                }
            }
            scanDirRecursive($path);
        } else {
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            
            // Verifica arquivos PHP modificados recentemente (últimos 30 dias)
            if ($ext == 'php') {
                $mtime = filemtime($path);
                if (time() - $mtime < 30 * 24 * 3600) {
                    echo "[PHP RECENTE] " . $path . " (Modificado em: " . date("d/m/Y H:i:s", $mtime) . ")\n";
                }
            }
            
            // Verifica nome do arquivo
            foreach ($suspectPatterns as $pattern) {
                if (stripos($file, $pattern) !== false) {
                    echo "[ARQUIVO SUSPEITO] " . $path . "\n";
                }
            }
            
            // Verifica conteúdo de arquivos PHP (busca rápida por strings comuns de malware)
            if ($ext == 'php') {
                $content = file_get_contents($path);
                if (stripos($content, 'eval(') !== false || 
                    stripos($content, 'base64_decode') !== false || 
                    stripos($content, 'gzinflate') !== false ||
                    stripos($content, 'str_rot13') !== false) {
                    // echo "[CONTEÚDO SUSPEITO] " . $path . " (Pode conter código ofuscado)\n";
                }
            }
        }
    }
}

scanDirRecursive(__DIR__);

echo "\nVARREDURA CONCLUÍDA.\n";
?>