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

    // Usar dados da sessão antiga se disponível, senão usar estrutura moderna
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    } else {
        // Criar estrutura moderna a partir da sessão antiga
        $user = [
            'id' => $_SESSION['SuserId'],
            'nome' => $_SESSION['SuserNome'] ?? 'Usuário',
            'email' => '',
            'matricula' => $_SESSION['SuserLogin'] ?? '',
            'login' => $_SESSION['SuserLogin'] ?? '',
            'perfil' => 'Usuário'
        ];
    }

    // Inicializar gerenciador de menu
    $menuManager = new MenuManager(
        $pdo, 
        $_SESSION['SuserId'], 
        $_SESSION['SuserPerfilId'] ?? 1, 
        $_SESSION['SuserEnt'] ?? 1
    );

        // Verificar permissão de acesso
    // if (!$menuManager->hasAccess('form_radio2')) {
    //     header("Location: index.php?error=no_permission");
    //     exit();
    // }

    // Buscar entidades para o formulário
    $sql = "SELECT entidade_id, entidade_nome FROM entidades ORDER BY entidade_nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $entidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Midias</title>
    
  <!-- CSS Moderno -->
    <link rel="stylesheet" href="assets/css/modern.css">
    <link rel="stylesheet" href="assets/css/components.css">

     <!-- Os CSSs extras -->
    <link rel="stylesheet" href="assets/css/CSS_teste.css">
    
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Trumbowyg CSS -- E o que faz os editores da caixa de texto funcionarem-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.28.0/dist/ui/trumbowyg.min.css">


    

</head>

<body>
    <div class="app-container">
         <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

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

        <!--Adciona novo menus com todas as entidades-->
            <nav class="sidebar-nav">
                <ul>
                    <?php echo $menuManager->generateMenu(); ?>
                </ul>
            </nav>

            <!--Troquei de lugar -pf-->
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <span class="user-name"><?php echo htmlspecialchars($user['matricula']); ?></span>
                        <span class="user-role"><?php echo htmlspecialchars($user['perfil']); ?></span>
                    </div>
                </div>
            </div>

        </aside>

        <!-- Main Content --> 
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <button class="header-toggle" id="headerToggle" style="display: none;">
                        <i class="fas fa-bars"></i>
                    </button>              
                    <h1>Configurações</h1>
                    <p>Edite os componetes da pagina</p>
                </div>

                    <!--Icone de notificação-->    
                    <div class="header-actions">
                        <button class="notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">100</span>
                        </button>
                        
                    <!--Menu do Login-->
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

            </header>
            <!-- Content -->
             <div class="dashboard-content">
                <!--Nome titular da pagina-->
                <div class="card">
                    <div class="card-header">
                        <h2>Configurações da Intranet</h2>
                    </div>
                        
                    <!--Formulario para nova noticia-->
                    <div class="card-content">
                        <div class="card-body">
                            <p>A pagian não tem um valor de similar na Intranet atual, e pode ser haver mudanças no futuro.</p>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
<script>

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    const headerToggle = document.getElementById('headerToggle');
    
    if (!sidebar || !mainContent || !headerToggle) {
        console.log('Elementos não encontrados');
        return;
    }
    
    // Verificar se a sidebar está fechada
    const isClosed = sidebar.classList.contains('sidebar-closed');
    console.log('Sidebar fechada:', isClosed);
    
    if (isClosed) {
        // Abrir sidebar
        console.log('Abrindo sidebar...');
        sidebar.classList.remove('sidebar-closed');
        mainContent.classList.remove('main-expanded');
        headerToggle.style.display = 'none';
    } else {
        // Fechar sidebar
        console.log('Fechando sidebar...');
        sidebar.classList.add('sidebar-closed');
        mainContent.classList.add('main-expanded');
        headerToggle.style.display = 'inline-block';
    }
}
// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const headerToggle = document.getElementById('headerToggle');
    const userMenu = document.getElementById('userMenu');

    // Toggle sidebar (botão da sidebar)
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Botão sidebar clicado');
            toggleSidebar();
        });
    }
    // Toggle sidebar (botão do header)
    if (headerToggle) {
        headerToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Botão header clicado');
            toggleSidebar();
        });
    }
    // User menu toggle
    if (userMenu) {
        userMenu.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    }
    
    // Fechar sidebar ao redimensionar a tela para desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1024) {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            const headerToggle = document.getElementById('headerToggle');
            
            if (sidebar) {
                // Forçar sidebar aberta em desktop
                sidebar.classList.remove('sidebar-closed');
                mainContent.classList.remove('main-expanded');
                headerToggle.style.display = 'none';
            }
        } else {
            // Em mobile, fechar sidebar
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            const headerToggle = document.getElementById('headerToggle');
            
            if (sidebar) {
                sidebar.classList.add('sidebar-closed');
                mainContent.classList.add('main-expanded');
                headerToggle.style.display = 'inline-block';
            }
        }
    });
});

</script>


        </body>
</html>

