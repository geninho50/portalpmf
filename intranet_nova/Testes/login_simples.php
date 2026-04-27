<?php
session_start();
require_once("config/database.php");
require_once("config/compatibility.php");
require_once("includes/functions.php");

$error = '';
$success = '';

// Processar login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['matricula'] ?? '';
    $senha = $_POST['senha'] ?? '';
    
    echo "<h2>🔍 Debug do Login:</h2>";
    echo "Login recebido: $login<br>";
    echo "Senha recebida: $senha<br><br>";
    
    if (empty($login) || empty($senha)) {
        $error = 'Por favor, preencha todos os campos.';
    } else {
        // Verificar se o usuário existe (qualquer campo)
        $Login = $login;
        
        // Buscar usuário por qualquer campo
        $sqlUser = "SELECT * FROM uni_usuarios WHERE 
                    user_login = '$Login' OR 
                    user_login = '" . md5($login) . "' OR 
                    user_id = '$Login' OR 
                    user_maticula = '$Login' OR 
                    user_maticula = '" . md5($login) . "'";
        
        echo "SQL executada: $sqlUser<br><br>";
        
        $TreturnUser = $drive->pedido($sqlUser);
        $TuserDados = pg_fetch_object($TreturnUser);
        
        echo "Resultado: " . ($TuserDados ? "ENCONTRADO" : "NÃO ENCONTRADO") . "<br>";
        
        if ($TuserDados) {
            echo "✅ Usuário encontrado: " . $TuserDados->user_nome . "<br>";
            
            // Login bem-sucedido
            $_SESSION['SuserNome'] = $TuserDados->user_nome;
            $_SESSION['SuserId'] = $TuserDados->user_id;
            $_SESSION['SuserLogin'] = $Login;
            $_SESSION['SuserPass'] = $senha;
            $_SESSION['SuserEnt'] = $TuserDados->user_entidade_id;
            $_SESSION['SuserEntDefault'] = $TuserDados->user_entidade_id;
            
            echo "✅ Sessões criadas com sucesso!<br>";
            echo "🎉 <strong>LOGIN REALIZADO COM SUCESSO!</strong><br>";
            echo "<a href='index.php'>Ir para o Dashboard</a><br><br>";
            
        } else {
            echo "❌ Usuário NÃO encontrado<br>";
            $error = 'Matrícula ou senha incorretos.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Simples - Intranet PMF</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { padding: 8px; width: 200px; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h1>🧪 Login Simples</h1>
    
    <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" value="<?php echo htmlspecialchars($_POST['matricula'] ?? '3474'); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" value="<?php echo htmlspecialchars($_POST['senha'] ?? '12345'); ?>" required>
        </div>
        
        <button type="submit">Testar Login</button>
    </form>
    
    <br>
    <h3>Credenciais de Teste:</h3>
    <ul>
        <li><strong>3474</strong> / qualquer senha</li>
        <li><strong>3671</strong> / qualquer senha</li>
        <li><strong>299</strong> / qualquer senha</li>
    </ul>
</body>
</html>
