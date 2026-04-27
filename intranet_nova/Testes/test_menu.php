<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Teste do Sistema de Menu</h1>";

try {
    require_once("config/database.php");
    require_once("config/compatibility.php");
    require_once("includes/menu.php");

    // Simular dados de sessão
    $_SESSION['SuserId'] = 1;
    $_SESSION['SuserPerfilId'] = 1;
    $_SESSION['SuserEnt'] = 1;

    // Criar conexão PDO
    $database = new Database();
    $pdo = $database->getConnection();

    echo "<h2>1. Testando MenuManager</h2>";
    
    // Inicializar gerenciador de menu
    $menuManager = new MenuManager($pdo, 1, 1, 1);
    
    echo "<h3>2. Gerando menu:</h3>";
    $menuHtml = $menuManager->generateMenu();
    
    echo "<div style='border: 1px solid #ccc; padding: 20px; margin: 20px 0;'>";
    echo "<h4>Menu Gerado:</h4>";
    echo $menuHtml;
    echo "</div>";
    
    echo "<h3>3. Estrutura HTML gerada:</h3>";
    echo "<pre>" . htmlspecialchars($menuHtml) . "</pre>";
    
    echo "<h2>✅ Teste concluído com sucesso!</h2>";
    
} catch (Exception $e) {
    echo "<h2>❌ Erro no teste:</h2>";
    echo "<p><strong>Mensagem:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>Arquivo:</strong> " . $e->getFile() . "</p>";
    echo "<p><strong>Linha:</strong> " . $e->getLine() . "</p>";
    echo "<p><strong>Trace:</strong></p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>
