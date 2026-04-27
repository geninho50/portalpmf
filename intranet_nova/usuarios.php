<?php
// Configuração de erro para debug
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

try {
    session_start();
    require_once("config/database.php");
    require_once("config/compatibility.php");
    require_once("includes/functions.php");
    require_once("includes/menu.php");

    // Verificar se está logado
    if (!isset($_SESSION['SuserId'])) {
        header("Location: login.php");
        exit();
    }

    // Inicializar gerenciador de menu
    $menuManager = new MenuManager(
        $pdo, 
        $_SESSION['SuserId'], 
        $_SESSION['SuserPerfilId'] ?? 1, 
        $_SESSION['SuserEnt'] ?? 1
    );

    // Verificar permissão de acesso
    if (!$menuManager->hasAccess('usuarios')) {
        header("Location: index.php?error=no_permission");
        exit();
    }

    // Processar ações
    $action = $_GET['action'] ?? 'list';
    $message = '';
    $error = '';

    switch ($action) {
        case 'add':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nome = $_POST['nome'] ?? '';
                $login = $_POST['login'] ?? '';
                $email = $_POST['email'] ?? '';
                $entidade_id = $_POST['entidade_id'] ?? 1;
                $perfil_id = $_POST['perfil_id'] ?? 1;
                
                if (empty($nome) || empty($login)) {
                    $error = 'Nome e login são obrigatórios';
                } else {
                    $sql = "INSERT INTO uni_usuarios (user_nome, user_login, user_email, user_entidade_id, user_senha) 
                            VALUES (:nome, :login, :email, :entidade_id, :senha)";
                    $stmt = $pdo->prepare($sql);
                    $senha = md5('123456'); // Senha padrão
                    
                    if ($stmt->execute([
                        'nome' => $nome,
                        'login' => $login,
                        'email' => $email,
                        'entidade_id' => $entidade_id,
                        'senha' => $senha
                    ])) {
                        $message = 'Usuário criado com sucesso!';
                    } else {
                        $error = 'Erro ao criar usuário';
                    }
                }
            }
            break;
            
        case 'edit':
            $userId = $_GET['id'] ?? 0;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nome = $_POST['nome'] ?? '';
                $login = $_POST['login'] ?? '';
                $email = $_POST['email'] ?? '';
                $entidade_id = $_POST['entidade_id'] ?? 1;
                
                if (empty($nome) || empty($login)) {
                    $error = 'Nome e login são obrigatórios';
                } else {
                    $sql = "UPDATE uni_usuarios SET user_nome = :nome, user_login = :login, user_email = :email, user_entidade_id = :entidade_id 
                            WHERE user_id = :id";
                    $stmt = $pdo->prepare($sql);
                    
                    if ($stmt->execute([
                        'nome' => $nome,
                        'login' => $login,
                        'email' => $email,
                        'entidade_id' => $entidade_id,
                        'id' => $userId
                    ])) {
                        $message = 'Usuário atualizado com sucesso!';
                    } else {
                        $error = 'Erro ao atualizar usuário';
                    }
                }
            }
            break;
            
        case 'delete':
            $userId = $_GET['id'] ?? 0;
            if ($userId > 0) {
                $sql = "DELETE FROM uni_usuarios WHERE user_id = :id";
                $stmt = $pdo->prepare($sql);
                
                if ($stmt->execute(['id' => $userId])) {
                    $message = 'Usuário excluído com sucesso!';
                } else {
                    $error = 'Erro ao excluir usuário';
                }
            }
            break;
    }

    // Buscar usuários
    $sql = "SELECT u.*, e.entidade_nome 
            FROM uni_usuarios u 
            LEFT JOIN entidades e ON u.user_entidade_id = e.entidade_id 
            ORDER BY u.user_nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Buscar entidades para o formulário
    $sql = "SELECT entidade_id, entidade_nome FROM entidades ORDER BY entidade_nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $entidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    error_log("Erro crítico em usuarios.php: " . $e->getMessage());
    die("Erro interno do servidor. Verifique os logs para mais detalhes.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários - Intranet PMF</title>
    
    <!-- CSS Moderno -->
    <link rel="stylesheet" href="assets/css/modern.css">
    <link rel="stylesheet" href="assets/css/components.css">
    
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-building"></i>
                    <span>Intranet PMF</span>
                </div>
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <?php echo $menuManager->generateMenu(); ?>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <h1>Gerenciar Usuários</h1>
                    <p>Administre os usuários do sistema</p>
                </div>
                
                <div class="header-right">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Buscar usuários..." id="searchUsers">
                    </div>
                    
                    <div class="header-actions">
                        <button class="notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <div class="user-menu">
                            <button class="user-menu-btn">
                                <div class="user-avatar-small">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span><?php echo htmlspecialchars($_SESSION['SuserNome'] ?? 'Usuário'); ?></span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            
                            <div class="user-dropdown">
                                <a href="perfil.php">
                                    <i class="fas fa-user"></i>
                                    <span>Meu Perfil</span>
                                </a>
                                <a href="configuracoes.php">
                                    <i class="fas fa-cog"></i>
                                    <span>Configurações</span>
                                </a>
                                <hr>
                                <a href="logout.php" class="logout-link">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Sair</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="dashboard-content">
                <!-- Messages -->
                <?php if ($message): ?>
                    <div class="alert alert-success">
                        <div class="alert-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="alert-content">
                            <div class="alert-title">Sucesso!</div>
                            <div class="alert-message"><?php echo htmlspecialchars($message); ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <div class="alert-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="alert-content">
                            <div class="alert-title">Erro!</div>
                            <div class="alert-message"><?php echo htmlspecialchars($error); ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Actions -->
                <div class="card">
                    <div class="card-header">
                        <h2>Usuários do Sistema</h2>
                        <button class="btn btn-primary" onclick="showAddUserModal()">
                            <i class="fas fa-plus"></i>
                            Novo Usuário
                        </button>
                    </div>
                    
                    <div class="card-content">
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Login</th>
                                        <th>Email</th>
                                        <th>Entidade</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($usuarios as $usuario): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($usuario['user_id']); ?></td>
                                        <td><?php echo htmlspecialchars($usuario['user_nome']); ?></td>
                                        <td><?php echo htmlspecialchars($usuario['user_login']); ?></td>
                                        <td><?php echo htmlspecialchars($usuario['user_email'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($usuario['entidade_nome'] ?? ''); ?></td>
                                        <td>
                                            <span class="table-status active">Ativo</span>
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <button class="btn btn-sm btn-ghost" onclick="editUser(<?php echo $usuario['user_id']; ?>)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-ghost" onclick="deleteUser(<?php echo $usuario['user_id']; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Adicionar Usuário -->
    <div class="modal-overlay" id="addUserModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Novo Usuário</h3>
                <button class="modal-close" onclick="closeModal('addUserModal')">×</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="?action=add">
                    <div class="form-group">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" name="nome" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Login</label>
                        <input type="text" name="login" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Entidade</label>
                        <select name="entidade_id" class="form-input form-select">
                            <?php foreach ($entidades as $entidade): ?>
                                <option value="<?php echo $entidade['entidade_id']; ?>">
                                    <?php echo htmlspecialchars($entidade['entidade_nome']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('addUserModal')">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Criar Usuário</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="assets/js/modern.js"></script>
    <script>
        function showAddUserModal() {
            document.getElementById('addUserModal').classList.add('active');
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }
        
        function editUser(userId) {
            // Implementar edição
            alert('Editar usuário ' + userId);
        }
        
        function deleteUser(userId) {
            if (confirm('Tem certeza que deseja excluir este usuário?')) {
                window.location.href = '?action=delete&id=' + userId;
            }
        }
        
        // Busca em tempo real
        document.getElementById('searchUsers').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
