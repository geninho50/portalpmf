<?php
try {
    // Configuração da conexão com o novo usuário
    $db = new PDO('mysql:host=192.168.12.24;port=3311;dbname=portal-bd', 'portal', 'Change2024');
    
    // Configura PDO para lançar exceções em caso de erro
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "✅ Conexão bem-sucedida!";
} catch (PDOException $e) {
    //echo "❌ Erro de conexão: " . $e->getMessage();
}
?>

