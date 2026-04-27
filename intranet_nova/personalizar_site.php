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

    // // Verificar permissão de acesso
    // if (!$menuManager->hasAccess('noticias')) {
    //     header("Location: index.php?error=no_permission");
    //     exit();
    // }


 } catch (Exception $e) {
     error_log("Erro crítico em noticias.php: " . $e->getMessage());
     die("Erro interno do servidor. Verifique os logs para mais detalhes.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Notícias - Intranet PMF</title>
    
    <!-- CSS Moderno -->
    <link rel="stylesheet" href="assets/css/modern.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"> adciona o visual dos menus noticias-->
   
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
                    <button class="header-toggle" id="headerToggle" style="display: none;"> <!--Faz a troca no side bar-->
                        <i class="fas fa-bars"></i>
                    </button>  
                    <h1>Personalização do Site</h1>
                    <p>Adicione, Altere e Remova componete das paginas</p>
                </div>
                
                <!--barra de pesquisa de noticias-->
                <div class="header-right">
                    
                    <!--Icone de notificação-->
                    <div class="header-actions">
                        <button class="notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <!--faixa do usuario-->
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
                                    Meu Perfil
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
                </div>
            </header>

            <!--Escurece a tela-->
            <div class="overlay hidden"></div>

                <!--Modal Exemplo - Visualizar-->
                <dialog class="modal hidden">
                        <button onclick="closeModal()">⨉</button>

                    <!--conteudo modal-->
                    <div class="card form-group">
                        <label class="form-label">
                            <h2>Titulo da Entidade</h2>
                            <p> 10/10/1000</p>
                        </label>
                        <div class="form-row">
                            <div style="flex: 1;">
                                <label class="form-label"><h3>Título da Pagina</h3>
                                Subtítulo da Pagina</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div style="flex: 1;">
                                <p><img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="text-image">
                                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse feugiat sodales cursus. Curabitur mollis lacus eget luctus efficitur. Integer viverra tortor sed turpis congue elementum. Praesent faucibus at ante et pharetra. Praesent justo nunc, sagittis ut ipsum a, feugiat luctus erat. In in fringilla arcu, in laoreet ipsum. Donec non elit sem. Donec dictum velit nisi, in vehicula mi sagittis non. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper leo nunc, vel scelerisque nunc tempus a. Ut iaculis scelerisque viverra. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Praesent odio velit, tincidunt vel viverra non, accumsan nec turpis. Curabitur eget nunc augue. Sed sit amet felis eros.</p>
                                <p>Sed porttitor ligula sit amet dapibus vestibulum. Praesent non lobortis eros, nec commodo felis. Duis vitae sodales felis. Vivamus posuere nisi sit amet lorem condimentum, sed imperdiet ipsum ultricies. Nam suscipit nisi ac odio dignissim eleifend. Mauris tristique consectetur ligula eget lobortis. In tristique nisl interdum elit faucibus faucibus.</p>
                            </div>
                        </div>
                        <div class="form-footer">
                            <div style="flex: 1;">
                                <label class="form-label">Arquivos</label>
                            </div>
                        </div>
                    </div>
                </dialog>

            <!-- Content -->
            <div class="dashboard-content">

                <!-- Actions -->
                <div class="card text-center" >
                          
                    <!--Abas do Menu Noticias-->
                    <div class="menu-nav-bootstrap">
                        <ul class="nav nav-tabs  mb-4">

                            <li class="nav-item main-item">
                                <h3><a id="1menu" class="nav-link active" aria-current="page" href="#" onclick="trocaMenu(1)">Pagina</a></h3>
                            </li>
                            <li class="nav-item main-item">
                                <h3><a id="2menu" class="nav-link" href="#" onclick="trocaMenu(2)">Menus</a></h3>
                            </li>
                            <li class="nav-item main-item">
                                <h3><a id="3menu" class="nav-link" href="#" onclick="trocaMenu(3)">Entrada</a></h3>
                            </li>
                        </ul>
                    </div>

                    <!--Pagina-->
                    <div id="1new-menu" style="display:block">

                            <!-- Actions -->
                        <div class="card text-center" >
                                
                            <!--Abas do Menu Noticias-->
                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-4">
                                    <li class="nav-item">
                                        <h3><a id="1submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(1)">Nova</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="2submenu" class="nav-link" href="#" onclick="trocarSubMenu(2)">Editar</a></h3>
                                    </li>
                                </ul>
                            </div>

                            <!-- Nova pagina -->
                            <div id="1new-submenu" style="display:block;">
                                <div class="card card-size">
                                    <div class="card-body">
                                        <!--topo da noticia-->

                                        
                                        <form method="POST" action="?action=add">
                                            <div class="form-group">

                                                <div class="form-row">
                                                    <div style="flex: 1;">
                                                        <label class="form-label" >Título</label>
                                                        <input type="text" name="titulo" class="form-input" placeholder="Nome dea noticia" required>
                                                    </div>
                                                </div>

                                                <!--area do texto-->
                                                <div class="form-row">
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Conteúdo da Pagina</label>
                                                        <textarea name="textocaixa" class="form-input" placeholder="" required rows="6"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Midia</label>
                                                        <select name="categoria" class="form-input">
                                                            <option value="Imagem">Imagem</option>
                                                            <option value="Video">Video</option>
                                                            <option value="Audio">Áudio</option>
                                                            <option value="Arquivo">Arquivo</option>
                                                        </select>
                                                    </div>
                                                    <div style="flex: 4;">
                                                        <label for="input-file" class="btn custom-file">Upload</label>
                                                        <input type="file" id="input-file" hidden>
                                                        
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <button type="button" class="btn btn-primary" style="color:#00B1EB;">Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!--paginas e menus -->
                            <div id="2new-submenu" style="display:none">
                                <div class="card card table-container card-size">
                                    <div class="card-body">
                                        <!-- Por pagina | Por menu -radio 
                                         show menu 1, show menu 2-->
                                        <table class="table opcao1">
                                            <thead>
                                                <td>
                                                    <th>Nome</th>
                                                    <th>Link da pagina</th>
                                                    <th>Menu</th>
                                                    <th>Ações</th>
                                                </td>
                                            </thead>

                                            <tbody>
                                                
                                                    <tr >
                                                        <td>1</td>
                                                        <td>Nome da Pagina</td>
                                                        <td>Link da pagina/link</td>
                                                        <td>Menu</td>
                                                        <td>
                                                        <button class="btn btn-sm btn-outline-warning" onclick="openModal()"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr >
                                                        <td>2</td>
                                                        <td>Nome da Pagina1</td>
                                                        <td>Link da pagina/link</td>
                                                        <td>Menu</td>
                                                        <td>
                                                        <button class="btn btn-sm btn-outline-warning" onclick="openModal()"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr >
                                                        <td>2</td>
                                                        <td>Nome da Pagina2</td>
                                                        <td>Link da pagina/link</td>
                                                        <td>Menu</td>
                                                        <td>
                                                        <button class="btn btn-sm btn-outline-warning" onclick="openModal()"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                        </table>

                                        <!-- <table class="table opcao2" style="display:none">
                                            <label class="form-label">Um teste</label>
                                        </table> -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Menus -->
                    <div id="2new-menu" style="display:none"> 
                       <!-- Actions -->
                        <div class="card text-center" >
                                
                            <!--Abas do Menu Noticias-->
                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-4">
                                    
                                    <li class="nav-item">
                                        <h3><a id="3submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(3)">Novo</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="4submenu" class="nav-link" href="#" onclick="trocarSubMenu(4)">Fixos</a></h3>
                                    </li>
                                </ul>
                            </div>
                            <!-- Montar Menu -->
                            <div id="3new-submenu" class="NN1" style="display:block;">
                                <div class="card table-container">
                                    <div class="card-body">
                                        <!--Formulario para um novo menu-->
                                        <form>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div style="flex: 4;">
                                                        <label class="form-label" >Titulo do Menu</label>
                                                        <input type="text" name="titulo" class="form-input" placeholder="Nome menu" required>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label class="form-label" >Liberar para a Internet?</label>
                                                         <label class="radio-label" for="LS">Sim</label><input type="radio" id="LS" name="liberar" >
                                                         <label class="radio-label" for="LN">Não</label><input type="radio" id="LN" name="liberar" > 
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div style="flex: 1;">
                                                        <label class="form-label" >Ação</label>
                                                        <select id="selectInput" name="status" class="form-input" onchange="toggleInputLink(this)">
                                                            <option value="subMenu" selected>Sub-Menu</option>
                                                            <option value="LInterno" >Link Interno</option>
                                                            <option value="LExterno">Link Externo</option>
                                                        </select>
                                                    </div>
                                                    <div style="flex: 3;">
                                                        <input id="LE" name="status" type="text" class="form-input" style="display:none;" placeholder="http:...">
                                                        
                                                        <select id="LI" name="status" class="form-input disfarce" style="display:none;" onchange="">
                                                            <option value="subMenu">Pagina 1</option>
                                                            <option value="subMenu">Pagina 2</option>
                                                            <option value="subMenu">Pagina 3</option>
                                                        </select>
                                                    </div>
                                                    <div style="flex:1" >
                                                        <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <!--Listra de menus-->
                                    <div class="linha"></div>
                                    <table class="table table-conteiner" >
                                        <thead>
                                            <tr>
                                                <th>Lista de Menus</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>Menu nome 1</td>
                                                <td>
                                                <button class="btn btn-sm btn-outline-warning" title="Editar" onclick="openModal()"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td>Menu nome 2</td>
                                                <td>
                                                <button class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                    </div>
                                </div>
                            </div>

                           
                            <!--Fixos-->
                            <div id="4new-submenu" class="NN2" style="display:none">
                                    <div class="card table-container">
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group" style="height:180px ;">

                                                <div class="form-row">
                                                    <div style="flex: 4;">
                                                        <label class="form-label" >Titulo do Submenu</label>
                                                        <input type="text" name="titulo" class="form-input" placeholder="Menu" required>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label class="form-label" >Liberar para a Internet?</label>
                                                        <label class="radio-label" for="LS">Sim</label><input type="radio" id="LS" name="liberar" >
                                                        <label class="radio-label" for="LN">Não</label><input type="radio" id="LN" name="liberar" > 
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Menu Fixo</label>
                                                        <select id="selectInput" name="status" class="form-input">
                                                            <option value="1"> </option>
                                                            <option value="2">Sobre a entidade</option>
                                                            <option value="3">Gestão e Transparencia</option>
                                                            <option value="4">Serviços</option>
                                                        </select>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label class="form-label" >Ação</label>
                                                            <select id="selectNewInput" name="status" class="form-input" onchange="toggleInputLink(this)">
                                                                <option value="LInterno" >Link Interno</option>
                                                                <option value="LExterno">Link Externo</option>
                                                            </select>
                                                    </div>
                                                    <div style="flex: 2;">
                                                        <input id="LI" name="status" type="text" class="form-input" style="display:none"  placeholder="http:...">
                                                        <select id="LE" name="status" class="form-input" style="display:block">
                                                            <option value="subMenu" selected>Pagina 1</option>
                                                            <option value="subMenu">Pagina 2</option>
                                                            <option value="subMenu">Pagina 3</option>
                                                        </select>
                                                    </div>
                                                     <div style="flex:1" >
                                                        <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="linha"></div>
                                    
                                    <div class="card-header">
                                        <h3 class="card-title">Sobre a Entidade</h3>
                                    </div>

                                    <table class="table">
                                        <tbody>
                                            <!--mocelos/exemplo de noticia-->
                                            <tr>
                                                <td>1</td>
                                                <td>Titulo da pagina</td>
                                                <td>Link da pagina</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="card-header">
                                        <h3 class="card-title">Gestão e Transparencia</h3>
                                    </div>
                                    <table class="table">
                                       
                                        <tbody>
                                            <!--mocelos/exemplo de noticia-->
                                            <tr>
                                                <td>1</td>
                                                <td>Titulo da pagina</td>
                                                <td>Link da pagina</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="card-header">
                                        <h3 class="card-title">Serviços</h3>
                                    </div>
                                    <table class="table">
                                        <tbody>
                                            <!--mocelos/exemplo de noticia-->
                                            <tr>
                                                <td>1</td>
                                                <td>Titulo da pagina</td>
                                                <td>Link da pagina</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- Entrada -->
                    <div id="3new-menu" style="display:none"> 
                        <div class="card text-center" > 
                            <!--Abas do Menu Noticias-->
                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-4">
                                    <li class="nav-item">
                                        <h3><a id="5submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(5)">Banner</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="6submenu" class="nav-link" href="#" onclick="trocarSubMenu(6)">Painel</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="7submenu" class="nav-link" href="#" onclick="trocarSubMenu(7)">Destaques</a></h3>
                                    </li>
                                </ul>
                            </div>

                            <!-- Banner -->
                            <div id="5new-submenu" style="display:block">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="form-row">
                                            <div style="flex: 2;">
                                                <label class="form-label" >Titulo</label>
                                                <input type="text" name="titulo" class="form-input" placeholder="Titulo Banner" required>
                                            </div>
                                            <div style="flex: 2;">
                                                <label class="form-label" >Link</label>
                                                <input type="text" name="titulo" class="form-input" placeholder="Https:/..." required>
                                            </div>
                                            <div style="flex: 1;">
                                                <label class="form-label" >Banner</label>
                                                <label for="input-file" class="btn custom-file">Upload</label>
                                                <input type="file" id="input-file" hidden>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div style="flex: 1;">
                                                <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                                                <button class="btn btn-primary" style="color:#00B1EB">Visualizar</button>
                                            </div>  
                                        </div>
                                        <div class="linha"></div>

                                        <table class="table">
                                            <tbody>
                                                <!--mocelos/exemplo de noticia-->
                                                <tr>
                                                    <td>1</td>
                                                    <td>Banner</td>
                                                    <td>Link da pagina</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Banner</td>
                                                    <td>Link da pagina</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Banner</td>
                                                    <td>Link da pagina</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                            <!--Painel-->
                            <div id="6new-submenu" style="display:none">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div style="flex: 1;">
                                                <div class="card alinhamento"> 
                                                    <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                                     <div class="form-row" >
                                                        <div style="flex: 2;">
                                                            <label class="form-label">Banner - 1</label>
                                                        </div>
                                                        <div style="flex: 1;">
                                                            <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="flex: 1;">
                                                <div class="card alinhamento"> 
                                                    <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                                     <div class="form-row" >
                                                        <div style="flex: 2;">
                                                            <label class="form-label">Banner - 2</label>
                                                        </div>
                                                        <div style="flex: 1;">
                                                            <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="flex: 1;">
                                                <div class="card alinhamento"> 
                                                    <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                                     <div class="form-row" >
                                                        <div style="flex: 2;">
                                                            <label class="form-label">Banner - 3</label>
                                                        </div>
                                                        <div style="flex: 1;">
                                                            <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div style="flex: 1;">
                                                <div class="card alinhamento"> 
                                                    <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                                     <div class="form-row" >
                                                        <div style="flex: 2;">
                                                            <label class="form-label">Banner - 4</label>
                                                        </div>
                                                        <div style="flex: 1;">
                                                            <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="flex: 1;">
                                                <div class="card alinhamento"> 
                                                    <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                                     <div class="form-row" >
                                                        <div style="flex: 2;">
                                                            <label class="form-label">Banner - 5</label>
                                                        </div>
                                                        <div style="flex: 1;">
                                                            <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="flex: 1;">
                                                <div class="card alinhamento"> 
                                                    <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                                     <div class="form-row" >
                                                        <div style="flex: 2;">
                                                            <label class="form-label">Banner - 6</label>
                                                        </div>
                                                        <div style="flex: 1;">
                                                            <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="flex: 1;">
                                                <div class="card alinhamento"> 
                                                    <img src="https://placehold.co/120x80/EEE/31343C" alt="Placehold" class="header-image">
                                                     <div class="form-row" >
                                                        <div style="flex: 2;">
                                                            <label class="form-label">Banner - 7</label>
                                                        </div>
                                                        <div style="flex: 1;">
                                                            <button  class="btn btn-sm btn-outline-danger" title="Excluir" ><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Destaques-->
                            <div id="7new-submenu" style="display:none">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="form-row">
                                            <div style="flex: 1;">
                                                <label class="form-label" >Titulo</label>
                                                <input type="text" name="titulo" class="form-input" placeholder="Titulo destaque" required>

                                                <label class="form-label" >Link</label>
                                                <input type="text" name="titulo" class="form-input" placeholder="Https:/..." required>

                                                <label class="form-label" >Imagem de Capa (opcional)</label>
                                                <label for="input-file" class="btn custom-file">Capa</label>
                                                <input type="file" id="input-file" hidden>
                                            </div>
                                            <div style="flex: 1;">
                                                <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                                                <button class="btn btn-primary" style="color:#00B1EB">Visualizar</button>
                                            </div>  
                                        </div>

                                    </div>
                                    <div class="linha"></div>
                                    
                                    <div class="card-header">
                                        <h3 class="card-title">Noticias em Destaque</h3><h4>(3/7)</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <tbody>
                                                <!--mocelos/exemplo de noticia-->
                                                <tr>
                                                    <td>1</td>
                                                    <td>Titulo da Noticia</td>
                                                    <td>Link da pagina</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Titulo da Noticia</td>
                                                    <td>Link da pagina</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Titulo da Noticia</td>
                                                    <td>Link da pagina</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                </div>


                            </div>

                        </div>
                    </div>
                    
                </div>

            </div>
        </main>
    </div>

<script src ="assets/js/modern.js"></script>
<script src ="assets/js/scripts_geral.js"></script>

    <!--Troca Menu-->
    <script>
        function trocaMenu(local) {
            const menu = document.getElementById(local + 'menu');
            const newMenu = document.getElementById(local + 'new-menu');

            //limpa todas as seleções e displays
            for (let i = 1; i <= 3; i++) {
                document.getElementById(i + 'menu').classList.remove('active');
                document.getElementById(i + 'new-menu').style.display = 'none';
            }
            //ativa quem for selecionado
            menu.classList.add('active');
            newMenu.style.display = 'block';
        }
    </script>

    <!--troca submenu, interno no menu ativo-->
    <script>
        //fazer ajuster finais aqui - 09/09
        function trocarSubMenu(valor){
            const subMenu = document.getElementById(valor + 'submenu');
            const newSubMenu = document.getElementById(valor + 'new-submenu');
    
            let a, b;
            //depedendo da pagina, esse if muda o loop para remover valores nas areas corretas.

            if(valor <= 2){
                a = 1; b = 2;
            }else
            if(valor <= 4){
                a = 3; b = 4;
            }else
            if(valor <= 7){
                a = 5; b = 7;
            }

            //limpa todas as seleções e displays
            for (let i = a; i <= b; i++) {
                document.getElementById( i + 'submenu').classList.remove('active');
                document.getElementById( i + 'new-submenu').style.display = 'none';
            }
            //ativa quem for selecionado
            subMenu.classList.add('active');
            newSubMenu.style.display = 'block';
        }
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