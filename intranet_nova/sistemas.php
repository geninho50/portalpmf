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
    if (!$menuManager->hasAccess('sistemas')) {
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
                $descricao = $_POST['descricao'] ?? '';
                $url = $_POST['url'] ?? '';
                $categoria = $_POST['categoria'] ?? 'geral';
                $status = $_POST['status'] ?? 'ativo';
                
                if (empty($nome) || empty($url)) {
                    $error = 'Nome e URL são obrigatórios';
                } else {
                    $sql = "INSERT INTO sistemas (nome, descricao, url, categoria, status, data_criacao) 
                            VALUES (:nome, :descricao, :url, :categoria, :status, :data_criacao)";
                    $stmt = $pdo->prepare($sql);
                    
                    if ($stmt->execute([
                        'nome' => $nome,
                        'descricao' => $descricao,
                        'url' => $url,
                        'categoria' => $categoria,
                        'status' => $status,
                        'data_criacao' => date('Y-m-d H:i:s')
                    ])) {
                        $message = 'Sistema criado com sucesso!';
                    } else {
                        $error = 'Erro ao criar sistema';
                    }
                }
            }
            break;
            
        case 'edit':
            $sistemaId = $_GET['id'] ?? 0;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nome = $_POST['nome'] ?? '';
                $descricao = $_POST['descricao'] ?? '';
                $url = $_POST['url'] ?? '';
                $categoria = $_POST['categoria'] ?? 'geral';
                $status = $_POST['status'] ?? 'ativo';
                
                if (empty($nome) || empty($url)) {
                    $error = 'Nome e URL são obrigatórios';
                } else {
                    $sql = "UPDATE sistemas SET nome = :nome, descricao = :descricao, url = :url, categoria = :categoria, status = :status, data_atualizacao = :data_atualizacao 
                            WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    
                    if ($stmt->execute([
                        'nome' => $nome,
                        'descricao' => $descricao,
                        'url' => $url,
                        'categoria' => $categoria,
                        'status' => $status,
                        'data_atualizacao' => date('Y-m-d H:i:s'),
                        'id' => $sistemaId
                    ])) {
                        $message = 'Sistema atualizado com sucesso!';
                    } else {
                        $error = 'Erro ao atualizar sistema';
                    }
                }
            }
            break;
            
        case 'delete':
            $sistemaId = $_GET['id'] ?? 0;
            if ($sistemaId > 0) {
                $sql = "DELETE FROM sistemas WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                
                if ($stmt->execute(['id' => $sistemaId])) {
                    $message = 'Sistema excluído com sucesso!';
                } else {
                    $error = 'Erro ao excluir sistema';
                }
            }
            break;
    }

    // Buscar sistemas
    $sql = "SELECT * FROM sistemas ORDER BY nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $sistemas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    error_log("Erro crítico em sistemas.php: " . $e->getMessage());
    die("Erro interno do servidor. Verifique os logs para mais detalhes.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Sistemas - Intranet PMF</title>
    
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
                    <h1>Gerenciar Sistemas</h1>
                    <p>Administre os sistemas da intranet</p>
                </div>
                
                <div class="header-right">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Buscar sistemas..." id="searchSystems">
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
                        <h2>Sistemas da Intranet</h2>
                        <button class="btn btn-primary" onclick="showAddSystemModal()">
                            <i class="fas fa-plus"></i>
                            Novo Sistema
                        </button>
                    </div>
                    
                    <div class="card-content">
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>URL</th>
                                        <th>Categoria</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sistemas as $sistema): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($sistema['id']); ?></td>
                                        <td><?php echo htmlspecialchars($sistema['nome']); ?></td>
                                        <td><?php echo htmlspecialchars($sistema['descricao'] ?? ''); ?></td>
                                        <td>
                                            <a href="<?php echo htmlspecialchars($sistema['url']); ?>" target="_blank" class="link-external">
                                                <?php echo htmlspecialchars($sistema['url']); ?>
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge badge-secondary"><?php echo htmlspecialchars($sistema['categoria']); ?></span>
                                        </td>
                                        <td>
                                            <span class="table-status <?php echo $sistema['status'] === 'ativo' ? 'active' : 'inactive'; ?>">
                                                <?php echo ucfirst($sistema['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <button class="btn btn-sm btn-ghost" onclick="openSystem(<?php echo $sistema['id']; ?>, '<?php echo htmlspecialchars($sistema['url']); ?>')">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </button>
                                                <button class="btn btn-sm btn-ghost" onclick="editSystem(<?php echo $sistema['id']; ?>)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-ghost" onclick="deleteSystem(<?php echo $sistema['id']; ?>)">
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

    <!-- Modal Adicionar Sistema -->
    <div class="modal-overlay" id="addSystemModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Novo Sistema</h3>
                <button class="modal-close" onclick="closeModal('addSystemModal')">×</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="?action=add">
                    <div class="form-group">
                        <label class="form-label">Nome do Sistema</label>
                        <input type="text" name="nome" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-input form-textarea" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">URL</label>
                        <input type="url" name="url" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Categoria</label>
                        <select name="categoria" class="form-input form-select">
                            <option value="geral">Geral</option>
                            <option value="administrativo">Administrativo</option>
                            <option value="financeiro">Financeiro</option>
                            <option value="recursos_humanos">Recursos Humanos</option>
                            <option value="ti">Tecnologia da Informação</option>
                            <option value="comunicacao">Comunicação</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-input form-select">
                            <option value="ativo">Ativo</option>
                            <option value="inativo">Inativo</option>
                            <option value="manutencao">Em Manutenção</option>
                        </select>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('addSystemModal')">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Criar Sistema</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="assets/js/modern.js"></script>
    <script>
        function showAddSystemModal() {
            document.getElementById('addSystemModal').classList.add('active');
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }
        
        function openSystem(systemId, url) {
            window.open(url, '_blank');
        }
        
        function editSystem(systemId) {
            // Implementar edição
            alert('Editar sistema ' + systemId);
        }
        
        function deleteSystem(systemId) {
            if (confirm('Tem certeza que deseja excluir este sistema?')) {
                window.location.href = '?action=delete&id=' + systemId;
            }
        }
        
        // Busca em tempo real
        document.getElementById('searchSystems').addEventListener('input', function(e) {
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
