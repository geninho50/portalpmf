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
    <title>Radio PMF</title>
    
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
                    <h1>Radio</h1>
                    <p>Nova Noticia</p>
                </div>

                <!--Icone de notificação-->    
                <div class="header-actions">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">0</span>
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
                            <a href="usuariodados.php">
                                <i class="fas fa-user"></i>
                                    Perfil
                                </a>
                                <a href="page_config.php">
                                    <i class="fas fa-cog"></i>
                                    Configurações
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
                <!-- Conteudo da pagina -->
            <div class="dashboard-content">
                <!--Nome titular da pagina-->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fa-solid fa-tower-broadcast"></i></i>Editar Noticia</h2>
                    </div>
                        
                    <!--Formulario para nova noticia-->
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-container">
                                <form method="post" enctype="multipart/form-data" >
                                    <div class="form-group">
                                        <!--Tema | Data-->
                                        <div class="form-row">
                                            <div style="flex: 3;">
                                                <label class="form-label "> Titulo</label>
                                                <input type="text" name="titulo" class="form-input" placeholder="Titulo da Noticia" required>                                            
                                            </div>
                                            <div style="flex: 1;">
                                                <label class="form-label "> Tema</label>
                                                <input type="text" name="nome" class="form-input" placeholder="Tema da Noticia" required>
                                            </div>                                       
                                        </div>
                                        <div class="form-row" >
                                        <div style="flex: 3;">
                                            <label class="form-label" >Noticia</label>
                                            <textarea name="textocaixa" class="form-input" placeholder="" required rows="6"></textarea>
                                        </div>
                                            <div style="flex: 1;">
                                                <label class="form-label">Data da noticia</label>
                                                <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-input" required>
                                        
                                                <label class="form-label">Reporter</label>
                                                <input type="text" name="reporter" class="form-input" placeholder="Nome do Reporter" required>
            
                                                <label class="form-label">Audio</label>
                                                <!-- <input type="file" name="arquivo" class="form-arquivo" id="arquivo" accept="audio/mp3">   -->

                                                <input type="file" id="input-file" hidden>
                                                <label for="input-file" class="btn custom-file">Upload</label>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">Salvar Noticia</button>
                            <button type="reset" class="btn btn-secondary">Cancelar</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </main>
    </div>

    <!--Script par ao side bar funcionar-->

    <script src ="scripts/scripts_geral.js"></script>
     <script src="assets/js/modern.js"></script>

    </script>

    <!-- Trumbowyg JS -- Cria o menu de edição da caixa de texto -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.28.0/dist/trumbowyg.min.js"></script>
    <script>
    $(function() {
        $('textarea[name="textocaixa"]').trumbowyg({
            btns: [
                ['undo', 'redo'],
                ['formatting'],
                ['bold', 'italic', 'underline'],
                ['link'],
                ['unorderedList', 'orderedList'],
                ['removeformat']
            ]
        });
    });
    </script>

 </body>
</html>