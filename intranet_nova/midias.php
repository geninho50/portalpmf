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

     <!-- Trumbowyg CSS --E o que faz os editores da caixa de texto funcionarem -->
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
                    <h1>Midias</h1>
                    <p>Busque, edite e publique</p>
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
                <!-- Actions -->
                <div class="card text-center" >
                        
                    <!--Abas do Menu-->
                    <div class="menu-nav-bootstrap">
                        <ul class="nav nav-tabs  mb-4">
                            <li class="nav-item" style="padding:0 8px; margin-left:10px;">
                                <i class="fa-solid fa-file-arrow-down"></i>
                            </li>
                            <li class="nav-item">
                                <h3><a id="1menu" class="nav-link active" aria-current="page" href="#" onclick="trocaMenu(1)">Consultar Midias</a></h3>
                            </li>
                            <li class="nav-item">
                                <h3><a id="2menu" class="nav-link" href="#" onclick="trocaMenu(2)">Editar Midias</a></h3>
                            </li>
                            <li class="nav-item">
                                <h3><a id="3menu" class="nav-link" href="#" onclick="href='midia-upload.php'">Incluir Midias</a></h3>
                            </li>
                        </ul>
                    </div>

                    <!--Ver todads as midias-->
                    <div id="1new-menu" style="display:block">
                        <div class="card form-group">
                        <div class="form-row">
                            <div style="flex:1">
                                <h2>
                                    <select id="seletorMidia" class="form-input">
                                        <option value="imagem">Imagem</option>
                                        <option value="audios">Audio</option>
                                        <option value="video">Video</option>
                                    </select>
                                </h2>
                            </div>
                            <div style="flex:4"></div>
                        </div>

                        <div class="form-row">
                            <div style="flex:1">
                            <div class="table-container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Título</th>
                                            <th>Categoria</th>
                                            <th>Autor</th>
                                            <th>Data Publicação</th>
                                            <th>Imagem</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>

                                    <tbody id="imagem" class="">
                                            <!--mocelos/exemplo de noticia-->
                                            <tr>
                                                <td>1</td>
                                                <td>Imagem Nome</td>
                                                <td><span class="badge bg-primary">Geral</span></td>
                                                <td>João</td>
                                                <td>01/09/2025 10:00</td>
                                                <td>
                                                    <div style="display:flex; align-items:center;">
                                                    <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                                    </div>
                                                </td>
                                                <td>
                                                    <button  class="btn btn-sm btn-outline-primary mb-1" title="Visualizar" ><i class="fas fa-eye"></i></button>
                                                    <button  class="btn btn-sm btn-outline-warning mb-1" title="Editar" ><i class="fas fa-edit"></i></button>
                                                    <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>2</td>
                                                <td>Imagem Dois</td>
                                                <td><span class="badge bg-primary">Geral</span></td>
                                                <td>Ana</td>
                                                <td>01/09/2025 12:00</td>
                                                <td>
                                                    <div style="display:flex; align-items:center;">
                                                    <img src="https://placehold.co/120x80/EEE/31343C"  alt="Placehold" class="header-image">
                                                    </div>
                                                </td>
                                                <td>
                                                    <button  class="btn btn-sm btn-outline-primary mb-1" title="Visualizar" ><i class="fas fa-eye"></i></button>
                                                    <button  class="btn btn-sm btn-outline-warning mb-1" title="Editar" ><i class="fas fa-edit"></i></button>
                                                    <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                    </tbody>
                                    <!--Modelo dos audios-->
                                    <tbody  id="audios" class="hidden">
                                        <tr>
                                            <td>1</td>
                                            <td>Audio Nome</td>
                                            <td><span class="badge bg-primary">Geral</span></td>
                                            <td>João</td>
                                            <td>01/09/2025 10:00</td>
                                            <td> Audio de Notica 1</td>
                                            <td>
                                                <div class="row">
                                                <button class="btn btn-sm btn-outline-primary mb-1" title="Visualizar" ><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-warning mb-1" title="Editar" ><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!--Modleo dos videos-->
                                    <tbody  id="video" class="hidden">
                                        <tr>
                                            <td>1</td>
                                            <td>Imagem Nome</td>
                                            <td><span class="badge bg-primary">Geral</span></td>
                                            <td>João</td>
                                            <td>01/09/2025 10:00</td>
                                            <td>Arquivo de Video 1</td>
                                            <td>
                                                <div class="row">
                                                <button class="btn btn-sm btn-outline-primary mb-1" title="Visualizar" ><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-warning mb-1" title="Editar" ><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                                </div> 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--editar mididas-->
                    <div id="2new-menu" style="display:none">
                        <div class="card" >
                            <div class ="card-body">
                            <div class="form-row">
                                <div style="flex: 1;">
                                    <label class="form-label"><h2>Lista de Midias</h2></label>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div style="flex: 1;">
                                    <label class="form-label">Lista Completa</label>
                                </div>
                                <div style="flex: 4;">
                                    <input type="text" class="form-input" placeholder="Buscar...">
                                </div>
                                <div style="flex: 1;">
                                    <button type="submit" class="btn btn-primary" style="color:#00B1EB">Localizar</button>
                                </div>
                            </div>

                            <div class="linha"></div>

                            <div class="form-row">
                                <div style="flex: 1;">
                                    <div class="card alinhamento">
                                        <label class="form-label">Nome Midia - 1</label>
                                        <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                        <div class="form-row" style="align-self: center;">
                                        <button  class="btn btn-sm btn-outline-primary mb-1" title="Visualizar" ><i class="fas fa-eye"></i></button>
                                        <button  class="btn btn-sm btn-outline-warning mb-1" title="Editar" ><i class="fas fa-edit"></i></button>
                                        <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div style="flex: 1;">
                                    <div class="card alinhamento">
                                        <label class="form-label">Nome Midia - 2</label>
                                        <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                        <div class="form-row" style="align-self: center;">
                                        <button  class="btn btn-sm btn-outline-primary mb-1" title="Visualizar" ><i class="fas fa-eye"></i></button>
                                        <button  class="btn btn-sm btn-outline-warning mb-1" title="Editar" ><i class="fas fa-edit"></i></button>
                                        <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div style="flex: 1;">
                                    <div class="card alinhamento">
                                        <label class="form-label">Nome Midia - 3</label>
                                        <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                        <div class="form-row" style="align-self: center;">
                                        <button  class="btn btn-sm btn-outline-primary mb-1" title="Visualizar" ><i class="fas fa-eye"></i></button>
                                        <button  class="btn btn-sm btn-outline-warning mb-1" title="Editar" ><i class="fas fa-edit"></i></button>
                                        <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div style="flex: 1;">
                                    <div class="card alinhamento">
                                        <label class="form-label">Nome Midia - 4</label>
                                        <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                        <div class="form-row" style="align-self: center;">
                                        <button  class="btn btn-sm btn-outline-primary mb-1" title="Visualizar" ><i class="fas fa-eye"></i></button>
                                        <button  class="btn btn-sm btn-outline-warning mb-1" title="Editar" ><i class="fas fa-edit"></i></button>
                                        <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div style="flex: 1;">
                                    <div class="card alinhamento">
                                        <label class="form-label">Nome Midia - 5</label>
                                        <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                        <div class="form-row" style="align-self: center;">
                                        <button  class="btn btn-sm btn-outline-primary mb-1" title="Visualizar" ><i class="fas fa-eye"></i></button>
                                        <button  class="btn btn-sm btn-outline-warning mb-1" title="Editar" ><i class="fas fa-edit"></i></button>
                                        <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div style="flex: 1;">
                                    <div class="card alinhamento">
                                        <label class="form-label">Nome Midia - 6</label>
                                        <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                        <div class="form-row" style="align-self: center;">
                                        <button  class="btn btn-sm btn-outline-primary mb-1" title="Visualizar" ><i class="fas fa-eye"></i></button>
                                        <button  class="btn btn-sm btn-outline-warning mb-1" title="Editar" ><i class="fas fa-edit"></i></button>
                                        <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div style="flex: 1;">
                                    <div class="card alinhamento">
                                        <label class="form-label">Nome Midia - 7</label>
                                        <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                        <div class="form-row" style="align-self: center;">
                                        <button  class="btn btn-sm btn-outline-primary mb-1" title="Visualizar" ><i class="fas fa-eye"></i></button>
                                        <button  class="btn btn-sm btn-outline-warning mb-1" title="Editar" ><i class="fas fa-edit"></i></button>
                                        <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div style="flex: 1;">
                                    <div class="card alinhamento">
                                        <label class="form-label">Nome Midia - 8</label>
                                        <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                        <div class="form-row" style="align-self: center;">
                                        <button  class="btn btn-sm btn-outline-primary mb-1" title="Visualizar" ><i class="fas fa-eye"></i></button>
                                        <button  class="btn btn-sm btn-outline-warning mb-1" title="Editar" ><i class="fas fa-edit"></i></button>
                                        <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div><!---->
        </main>
    </div>


        <script src ="assets/js/scripts_geral.js"></script>
        <script src="assets/js/modern.js"></script>

        <script>
            function trocaMenu(local) {
            const menu = document.getElementById(local + 'menu');
            const newMenu = document.getElementById(local + 'new-menu');

            //limpa todas as seleções e displays
            for (let i = 1; i <=2; i++) {
                document.getElementById(i + 'menu').classList.remove('active');
                document.getElementById(i + 'new-menu').style.display = 'none';
            }
            //ativa quem for selecionado
            menu.classList.add('active');
            newMenu.style.display = 'block';
            }
        </script>
    </body>
</html>

