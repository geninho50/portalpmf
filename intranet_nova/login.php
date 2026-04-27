<?php
session_start();
require_once("config/compatibility.php");

// Se já estiver logado, redirecionar
if (isset($_SESSION['SuserId']) && !empty($_SESSION['SuserId'])) {
    header("Location: index.php");
    exit();
}

$error = '';
$success = '';

// Processar login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['matricula'] ?? '';
    $senha = md5( $_POST['senha'] ) ?? '';
    
    if (empty($login) || empty($senha)) {
        $error = 'Por favor, preencha todos os campos.';
    } else {
        // Conectar ao banco
        $drive->conecta();
        
        // Buscar usuário por qualquer campo (incluindo MD5)
        $sqlUser = "SELECT * 
                      FROM uni_usuarios 
                     WHERE ( user_login     = '$login' OR 
                             user_maticula  = '$login' OR 
                             user_email     = '$login' ) 
                       AND   user_senha     = '$senha'
                       AND   user_bloqueado = false";
        
        $TreturnUser = $drive->pedido($sqlUser);
        $TuserDados = pg_fetch_object($TreturnUser);

        // print "<pre>";
        // print_r($sqlUser);
        // print_r($TreturnUser);
        // print "</pre>";
        // die();

        if ($TuserDados) {
            // Login bem-sucedido - usar a mesma estrutura de sessão do sistema antigo
            $_SESSION['SuserNome'] = $TuserDados->user_nome;
            $_SESSION['SuserId'] = $TuserDados->user_id;
            $_SESSION['SuserLogin'] = $login;
            $_SESSION['SuserPass'] = $senha;
            $_SESSION['SuserEnt'] = $TuserDados->user_entidade_id;
            $_SESSION['SuserEntDefault'] = $TuserDados->user_entidade_id;
            
            // Buscar perfil do usuário
            $sqlPerfil = "SELECT * FROM intranet_permissoes WHERE intranet_user_id = " . $TuserDados->user_id . " AND intranet_entidade_id = " . $TuserDados->user_entidade_id;
            $TreturnPerfil = $drive->pedido($sqlPerfil);
            $TperfilDados = pg_fetch_object($TreturnPerfil);
            $TperfilInicial = $TperfilDados ? $TperfilDados->intranet_perfil_id : 1;
            
            $_SESSION['SuserPerfilId'] = $TperfilInicial;
            
            // Buscar nome do perfil
            $sqlPerfilNome = "SELECT intranet_perfil_nome FROM intranet_perfil WHERE intranet_perfil_id = $TperfilInicial";
            $TreturnPerfilNome = $drive->pedido($sqlPerfilNome);
            $TperfilNome = pg_fetch_object($TreturnPerfilNome);
            
            // Criar estrutura de sessão compatível com sistema moderno
            $_SESSION['user_id'] = $TuserDados->user_id;
            $_SESSION['user'] = [
                'id' => $TuserDados->user_id,
                'nome' => $TuserDados->user_nome,
                'email' => $TuserDados->user_email ?? '',
                'matricula' => $TuserDados->user_maticula ?? $login,
                'login' => $TuserDados->user_login,
                'perfil' => $TperfilNome ? $TperfilNome->intranet_perfil_nome : 'Usuário'
            ];
            
            // Registrar log
            $sqlLog = "INSERT INTO intranet_log_acesso(
                        intranet_log_id,
                        intranet_log_user_id,
                        intranet_log_entidade_id,
                        intranet_log_data,
                        intranet_log_ip,
                        intranet_log_navegador
                    ) VALUES (
                        default,
                        " . $TuserDados->user_id . ",
                        " . ($_SESSION['SuserEnt'] ?? 1) . ",
                        " . time() . ",
                        '" . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "',
                        '" . ($_SERVER['HTTP_USER_AGENT'] ?? 'unknown') . "'
                    )";
            $drive->pedido($sqlLog);
            
            // Redirecionar
            header("Location: index.php");
            exit();
        } else {
            $error = 'Matrícula ou senha incorretos.';
        }
        
        $drive->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Intranet PMF</title>
    
    <!-- CSS removido para evitar conflitos -->
    
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Reset e base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        /* Cores */
        :root {
            --primary-50: #eff6ff;
            --primary-100: #dbeafe;
            --primary-500: #3b82f6;
            --primary-600: #2563eb;
            --primary-700: #1d4ed8;
            --secondary-50: #f8fafc;
            --secondary-200: #e2e8f0;
            --secondary-400: #94a3b8;
            --secondary-600: #475569;
            --secondary-700: #334155;
            --danger-50: #fef2f2;
            --danger-200: #fecaca;
            --danger-700: #b91c1c;
            --success-50: #f0fdf4;
            --success-200: #bbf7d0;
            --success-700: #15803d;
        }
        
        .login-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            animation: slideUp 0.6s ease;
        }
        
        .login-header {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        
        .login-logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
        }
        
        .login-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .login-subtitle {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .login-form {
            padding: 40px 30px;
        }
        
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .input-group {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
        }
        
        .input-with-icon {
            padding-left: 48px;
        }
        
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 16px;
            padding: 4px;
            border-radius: 4px;
            transition: color 0.3s ease;
        }
        
        .password-toggle:hover {
            color: #475569;
        }
        
        .login-btn {
            width: 100%;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
        }
        
        .login-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .alert-error {
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        
        .alert-success {
            background-color: #f0fdf4;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }
        
        .login-footer {
            text-align: center;
            padding: 20px 30px;
            background-color: #f8fafc;
            font-size: 12px;
            color: #475569;
            line-height: 1.5;
        }
        
        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @media (max-width: 480px) {
            .login-card {
                margin: 0;
                border-radius: 0;
                min-height: 100vh;
            }
            
            .login-header {
                padding: 30px 20px;
            }
            
            .login-form {
                padding: 30px 20px;
            }
            
            .login-footer {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <i class="fas fa-building"></i>
                </div>
                <h1 class="login-title">Intranet PMF</h1>
                <p class="login-subtitle">Prefeitura Municipal de Florianópolis</p>
            </div>
            
            <form class="login-form" method="POST" id="loginForm">
                <?php if ($error): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="matricula" class="form-label">Matrícula</label>
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input 
                            type="text" 
                            id="matricula" 
                            name="matricula" 
                            class="form-input input-with-icon" 
                            placeholder="Digite sua matrícula"
                            value="<?php echo htmlspecialchars($_POST['matricula'] ?? ''); ?>"
                            required
                            autocomplete="username"
                        >
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="senha" class="form-label">Senha</label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            id="senha" 
                            name="senha" 
                            class="form-input input-with-icon" 
                            placeholder="Digite sua senha"
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="password-toggle" id="passwordToggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="login-btn" id="loginBtn">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Entrar</span>
                </button>
            </form>
            
            <div class="login-footer">
                <p>
                    <strong>Acesso exclusivo</strong> a administradores do sistema.<br>
                    Entre em contato com a Dgov para liberação do seu acesso.
                </p>
                <p style="margin-top: 12px; font-size: 11px;">
                    <i class="fas fa-shield-alt"></i>
                    Sistema seguro com criptografia SSL
                </p>
            </div>
        </div>
    </div>

    <script>
        // Toggle de senha
        const passwordToggle = document.getElementById('passwordToggle');
        const senhaInput = document.getElementById('senha');
        
        passwordToggle.addEventListener('click', () => {
            const type = senhaInput.type === 'password' ? 'text' : 'password';
            senhaInput.type = type;
            
            const icon = passwordToggle.querySelector('i');
            icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });
        
        // Validação do formulário
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        
        loginForm.addEventListener('submit', (e) => {
            const matricula = document.getElementById('matricula').value.trim();
            const senha = document.getElementById('senha').value.trim();
            
            if (!matricula || !senha) {
                e.preventDefault();
                showToast('Por favor, preencha todos os campos.', 'error');
                return;
            }
            
            // Mostrar loading
            loginBtn.disabled = true;
            loginBtn.innerHTML = '<div class="loading-spinner"></div><span>Entrando...</span>';
        });
        
        // Foco automático no primeiro campo
        document.getElementById('matricula').focus();
        
        // Sistema de toast simples
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'error' ? '#ef4444' : '#3b82f6'};
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
                z-index: 10000;
                animation: slideInRight 0.3s ease;
            `;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }
        
        // Adicionar CSS para animações
        if (!document.getElementById('toast-styles')) {
            const style = document.createElement('style');
            style.id = 'toast-styles';
            style.textContent = `
                @keyframes slideInRight {
                    from {
                        opacity: 0;
                        transform: translateX(100%);
                    }
                    to {
                        opacity: 1;
                        transform: translateX(0);
                    }
                }
                
                @keyframes slideOutRight {
                    from {
                        opacity: 1;
                        transform: translateX(0);
                    }
                    to {
                        opacity: 0;
                        transform: translateX(100%);
                    }
                }
            `;
            document.head.appendChild(style);
        }
    </script>
</body>
</html>
