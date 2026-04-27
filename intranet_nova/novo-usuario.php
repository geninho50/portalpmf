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

<!--
Notas:
    -Adcionar salvamento de valores do formulado no sql
    -adcionar verificação de gral de acesso para fazere o cadastro
    -adcioanr validação de matricula/email ao cadastro
    -adicionar alerta para que todas as areas do formulario sejam preenchidas
-->


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuário - Intranet PMF</title>

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
                    <h1>Novo Usuario</h1>
                    <p>Cadastrar novo usuario ao sistema</p>
                </div>
                    
                    <div class="header-right" >
                        <a href="painel_administrativo.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
            </header>

            <!-- Conteudo da pagina -->
            <div class="dashboard-content">

            <!--Nome titular da pagina-->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fa-solid fa-user" style="padding: 10px;"></i> Novo Usuario</h2>
                    </div>
                    
                    <!--Formulario para novo usuario-->
                    <div class="card-content">
                        <div class ="card-body">
                                <form method="post" enctype="multipart/form-data" >

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div style="flex: 2;">
                                                <label class="form-label "> Nome</label>
                                                <input type="text" name="nome" class="form-input" placeholder="Nome" required>
                                            </div>
                                            <div style="flex: 2;">
                                                <label class="form-label">Matricula</label>
                                                <input type="text" name="matricula" class="form-input" placeholder="0000000" required>
                                            </div>  
                                            <div style="flex: 2;">
                                                <label class="form-label">Login</label>
                                                <input type="password" name="login" class="form-input" placeholder="Meu login" required>
                                            </div>     
                                            <div style="flex: 2;">
                                                <label class="form-label ">CPF</label>
                                                <input type="text" name="cpf" class="form-input" placeholder="0000-0000" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div style="flex: 2;">
                                                <label class="form-label">Nascimento</label>
                                                <input type="date" name="nascimento" class="form-input" placeholder="00/00/0000" required>
                                            </div>  
                                            <div style="flex: 2;">
                                                <label class="form-label ">E-mail</label>
                                                <input type="text" name="email" class="form-input" placeholder="meuEmail@mail.com" required>
                                            </div>
                                            <div style="flex: 2;">
                                                <label class="form-label">Telefone PMF</label>
                                                <input type="text" name="telfone" class="form-input" placeholder="(00)0000-000" required>
                                            </div>  
                                        </div>

                                        <div class="form-row">
                                            <div style="flex: 2;">
                                                <label class="form-label">Entidade</label>
                                                <select type="select" name="entidade" class="form-input" placeholder="A" required>
                                                <option value="adm">A</option>
                                                <option value="s_adm">B</option>
                                                <option value="m_adm">C</option>
                                                </select>
                                            </div>
                                            <div style="flex: 2;">
                                                <label class="form-label">Grupo</label>
                                                <select type="select" name="grupo" class="form-input" placeholder="1" required>
                                                <option value="adm">1</option>
                                                <option value="s_adm">2</option>
                                                <option value="m_adm">3</option>
                                                </select>
                                            </div>  
                                            <div style="flex: 2;">
                                                <label class="form-label">Nivel de Acesso</label>
                                                <select type="select" name="acesso" class="form-input" placeholder="ADM" required>
                                                <option value="adm">ADM</option>
                                                <option value="s_adm">SUPER ADM</option>
                                                <option value="m_adm">MESTRE ADM</option>
                                                </select>
                                            </div>                                       
                                        </div>
                                    </div>
                                </form>
                        </div>
                        <div class="card-footer">
                            <div class="footer-actions">
                                <div class="form-row">
                                    <div style="flex: 2;">
                                        <button type="submit" style="color:#00B1EB" class="btn btn-primary">Salvar</button>
                                    </div>
                                    <div style="flex: 2;">
                                        <button type="reset" style="color:#00B1EB" class="btn btn-primary">Cancelar</button>
                                    </div>
                                </div>
                            </div>
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

    <!-- JavaScript -  Funsao para trocar a side bar -->
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
