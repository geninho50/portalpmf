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

    // Processar ações
    $action = $_GET['action'] ?? 'list';
    $message = '';
    $error = '';

    switch ($action) {
        case 'add':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $titulo = $_POST['titulo'] ?? '';
                $conteudo = $_POST['conteudo'] ?? '';
                $categoria = $_POST['categoria'] ?? 'geral';
                $status = $_POST['status'] ?? 'ativo';
                
                if (empty($titulo) || empty($conteudo)) {
                    $error = 'Título e conteúdo são obrigatórios';
                } else {
                    $sql = "INSERT INTO noticias (titulo, conteudo, categoria, status, autor_id, data_criacao) 
                            VALUES (:titulo, :conteudo, :categoria, :status, :autor_id, :data_criacao)";
                    $stmt = $pdo->prepare($sql);
                    
                    if ($stmt->execute([
                        'titulo' => $titulo,
                        'conteudo' => $conteudo,
                        'categoria' => $categoria,
                        'status' => $status,
                        'autor_id' => $_SESSION['SuserId'],
                        'data_criacao' => date('Y-m-d H:i:s')
                    ])) {
                        $message = 'Notícia criada com sucesso!';
                    } else {
                        $error = 'Erro ao criar notícia';
                    }
                }
            }
            break;
            
        case 'edit':
            $noticiaId = $_GET['id'] ?? 0;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $titulo = $_POST['titulo'] ?? '';
                $conteudo = $_POST['conteudo'] ?? '';
                $categoria = $_POST['categoria'] ?? 'geral';
                $status = $_POST['status'] ?? 'ativo';
                
                if (empty($titulo) || empty($conteudo)) {
                    $error = 'Título e conteúdo são obrigatórios';
                } else {
                    $sql = "UPDATE noticias SET titulo = :titulo, conteudo = :conteudo, categoria = :categoria, status = :status, data_atualizacao = :data_atualizacao 
                            WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    
                    if ($stmt->execute([
                        'titulo' => $titulo,
                        'conteudo' => $conteudo,
                        'categoria' => $categoria,
                        'status' => $status,
                        'data_atualizacao' => date('Y-m-d H:i:s'),
                        'id' => $noticiaId
                    ])) {
                        $message = 'Notícia atualizada com sucesso!';
                    } else {
                        $error = 'Erro ao atualizar notícia';
                    }
                }
            }
            break;
            
        case 'delete':
            $noticiaId = $_GET['id'] ?? 0;
            if ($noticiaId > 0) {
                $sql = "DELETE FROM noticias WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                
                if ($stmt->execute(['id' => $noticiaId])) {
                    $message = 'Notícia excluída com sucesso!';
                } else {
                    $error = 'Erro ao excluir notícia';
                }
            }
            break;
    }

     // Buscar notícias
    //  $sql = "SELECT n.*, u.user_nome as autor_nome 
    //          FROM noticias n 
    //          LEFT JOIN uni_usuarios u ON n.autor_id = u.user_id 
    //          ORDER BY n.data_criacao DESC";
    //  $stmt = $pdo->prepare($sql);
    //  $stmt->execute();
    //  $noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
   
    
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Trumbowyg CSS --E o que faz os editores da caixa de texto funcionarem -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.28.0/dist/ui/trumbowyg.min.css">

<style>

    .menu-nav-bootstrap {
        display: flex;
        justify-content: Left;
        align-items: center;
        margin-bottom: 1rem;
        border-bottom: 2px solid Lavender;
    }
     .main-item{
       font-size: 20px;
    }

    .menu-nav-bootstrap .nav-tabs {
        list-style-type: none;
        margin-top: 5px;
        display:flex;
    }

    .menu-nav-bootstrap .nav-link {
        font-weight: bold;
        color: black;
        margin: 0 15px;
        padding: 5px 15px;
        border-radius: 15px 15px 0 0;
        transition: background 0.2s, color 0.3s;
        display:flex;  
        text-decoration: none;
    }

    .menu-nav-bootstrap .nav-link.active,
    .menu-nav-bootstrap .nav-link:hover,
    .menu-nav-bootstrap .nav-link:focus {
        background:Lavender;
    }

    .form-label{
        font-size: 18px;
         font-weight:bold;
         margin:5px;
         padding:1px;
    }
    .form-row{
        display: flex;
        gap: 16px;
        padding:5px;
        align-items: flex-end;
        font-size: 10px;
    }
    .form-footer{
        display: flex;
        gap: 16px;
        padding:5px;
        align-items: flex-end;
        font-size: 12px;
        background-color: #777;
    }

    .container {
        display: inline-block;
        position: relative;
    }

    .container p {
        position: absolute;
        top: 145px;
        right: 20px;
        font-size: 40px;
        color: white;
    }
    

/*area de ajuste visual do modal*/
    .modal {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;

        gap: 5px;
        width: 750px;
        min-height: 450px;
        padding:20px;

        position: absolute;

        background-color: white;
        border: 1px solid #ddd;
        border-radius: 18px;
        z-index: 2;

    }
    .modal .form-label{
        margin:15px;
        padding:5px;

    }

    .modal p {
        font-size: 0.9rem;
        color: #777;
        margin: 20px 12px;
        min-width: 10%;
    }

    .modal .text-image{
        width:20%;
        display: block;
        position: relative;
        float: left;
        padding: 15px;
        border-radius: 5%;
    }

    .modal button {
        cursor: pointer;
        text-align: right;
        margin:18px;
        border: none;
        border-radius: 18px;
        color:red;
        padding: 12px;
    }

    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(3px);
        z-index: 1;
    }

    .hidden {
        display: none;
    }

</style>

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
                    <button class="header-toggle" id="headerToggle" style="display: none;"> <!--Faz a troca no side bar-->
                        <i class="fas fa-bars"></i>
                    </button>  
                    <h1>Gestao e Transparencia</h1>
                    <p>Em construção</p>
                </div>
                
                <!--barra de pesquisa de noticias-->
                <div class="header-right">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Buscar notícias..." id="searchNews">
                    </div>
                    
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
                <section class="modal hidden">
                        <button class="btn-primary" onclick="closeModal()">⨉</button>

                    <!--conteudo modal-->
                    <div class="card form-group">
                        <label class="form-label">
                            <h2>Titulo da Entidade</h2>
                            <p> 10/10/1000</p>
                        </label>
                        <div class="form-row">
                            <div style="flex: 1;">
                                <label class="form-label"><h3>Título da noticia</h3>
                                Subtítulo da noticia</label>
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
                </section>

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
                <div class="card text-center" >
                          
                    <!--Abas do Menu Noticias-->
                    <div class="menu-nav-bootstrap">
                        <ul class="nav nav-tabs  mb-4">

                            <li class="nav-item main-item">
                                <h3><a id="1menu" class="nav-link active" aria-current="page" href="#" onclick="trocaMenu(1)">1</a></h3>
                            </li>
                            <li class="nav-item main-item">
                                <h3><a id="2menu" class="nav-link" href="#" onclick="trocaMenu(2)">2</a></h3>
                            </li>
                            <li class="nav-item main-item">
                                <h3><a id="3menu" class="nav-link" href="#" onclick="trocaMenu(3)">3</a></h3>
                            </li>
                            <li class="nav-item main-item">
                                <h3><a id="4menu" class="nav-link" href="#" onclick="trocaMenu(4)">4</a></h3>
                            </li>
                        </ul>
                    </div>

                    <!--Noticias-->
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
                                        <h3><a id="2submenu" class="nav-link" href="#" onclick="trocarSubMenu(2)">Importar</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="3submenu" class="nav-link" href="#" onclick="trocarSubMenu(3)">Publicadas</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="4submenu" class="nav-link" href="#" onclick="trocarSubMenu(4)">Arquivados</a></h3>
                                    </li>
                                </ul>
                            </div>

                            <!-- Modal Adicionar Notícia -->
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

                                                <div class="form-row">
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Editoria</label>
                                                        <select name="categoria" class="form-input">
                                                            <option value="geral">Geral</option>
                                                            <option value="tecnologia">Tecnologia</option>
                                                            <option value="administrativo">Administrativo</option>
                                                            <option value="eventos">Eventos</option>
                                                            <option value="comunicados">Comunicados</option>
                                                        </select>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Data</label>
                                                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-input" required>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Horario de Publicação</label>
                                                        <input type="time" name="hora" value="<?php echo date('H:i'); ?>" class="form-input" required>
                                                    </div>
                                                </div>

                                                <!--area do texto-->
                                                <div class="form-row">
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Conteúdo</label>
                                                        <textarea name="textocaixa" class="form-input" placeholder="" required rows="6"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Status</label>
                                                        <select name="status" class="form-input">
                                                        <option value="ativo">Ativo</option>
                                                        <option value="rascunho">Rascunho</option>
                                                        <option value="arquivado">Arquivado</option>
                                                        </select>
                                                    </div>
                                                     <div style="flex: 1;">
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
                                                            <div style="flex: 1;">
                                                                <input type="file" class="form-input" placeholder="Midia">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <button type="submit" class="btn btn-primary" style="color:#00B1EB">Criar Notícia </button>
                                                        <button type="button" class="btn btn-primary" onclick="closeModal('2new-menu')"  style="color:#00B1EB;">Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!--importar -->
                            <div id="2new-submenu" style="display:none">
                                <div class="card table-container card-size">
                                    <div class="card-header">
                                        <h3 class="card-title">Importadas de outras entidade</h3>
                                        <p><label class="form-label">Entidade</label>
                                            <select name="status" class="form-input">
                                                <option >Secretaria</option>
                                                <option >Municipio</option>
                                                <option >Orgão</option>
                                            </select>
                                        </p>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th>ID</th>
                                            <th>Título</th>
                                            <th>Categoria</th>
                                            <th>Autor</th>
                                            <th>Data</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <!--mocelos/exemplo de noticia-->
                                            <tr>
                                                <td>1</td>
                                                <td>Título Noticia Um</td>
                                                <td><span class="badge bg-primary">Geral</span></td>
                                                <td>João</td>
                                                <td>01/09/2025 10:00</td>
                                                <td>
                                                <span class="badge bg-success">Ativo</span>
                                                </td>
                                                <td>
                                                <button class="btn btn-sm btn-outline-primary" onclick="openModal()"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-warning" ><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>

                            <!--Publicadas-->
                            <div id="3new-submenu" style="display:none;">
                                <div class="card table-container card-size">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Título</th>
                                                <th>Categoria</th>
                                                <th>Autor</th>
                                                <th>Data</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <!--mocelos/exemplo de noticia-->
                                            <tr>
                                                <td>1</td>
                                                <td>Título Noticia Um</td>
                                                <td><span class="badge bg-primary">Geral</span></td>
                                                <td>João</td>
                                                <td>01/09/2025 10:00</td>
                                                <td>
                                                    <span class="badge bg-success">Ativo</span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm" onclick="openModal()"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Título Noticia Dois</td>
                                                <td><span class="badge bg-primary">Geral</span></td>
                                                <td>Ana</td>
                                                <td>02/09/2025 10:00</td>
                                                <td>
                                                    <span class="badge bg-success">Ativo</span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm" onclick="openModal()"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Título Noticia Três</td>
                                                <td><span class="badge bg-primary">Geral</span></td>
                                                <td>João</td>
                                                <td>03/09/2025 10:00</td>
                                                <td>
                                                    <span class="badge bg-success">Ativo</span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm" onclick="openModal()"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            <!--Chama as noticias do banco _ Tem que configurar-->
                                            <!--<?php foreach ($noticias as $noticia): ?>-->
                                                <tr>
                                                    <td><?php echo htmlspecialchars($noticia['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($noticia['titulo']); ?></td>
                                                    <td>
                                                        <span class="badge bg-primary"><?php echo htmlspecialchars($noticia['categoria']); ?></span>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($noticia['autor_nome'] ?? 'Sistema'); ?></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($noticia['data_criacao'])); ?></td>
                                                    <td>
                                                        <span class="table-status <?php echo $noticia['status'] === 'ativo' ? 'active' : 'inactive'; ?>">
                                                            <?php echo ucfirst($noticia['status']); ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="table-actions">
                                                            <button class="btn btn-sm btn-outline-primary" title="Visualizar" onclick="viewNews(<?php echo $noticia['id']; ?>)">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-warning" title="Editar" onclick="editNews(<?php echo $noticia['id']; ?>)">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="deleteNews(<?php echo $noticia['id']; ?>)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <!--<?php endforeach; ?>-->
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <!--Menu de edição e noticias não publicadas-->
                            <div id="4new-submenu" style="display:none">
                                <div class="card table-container card-size">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Título</th>
                                                <th>Categoria</th>
                                                <th>Autor</th>
                                                <th>Data</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <!--Um mocelo/exemplo de noticia-->
                                            <tr>
                                                <td>2</td>
                                                <td>Um belo titulo</td>
                                                <td><span class="badge bg-primary">Geral</span></td>
                                                <td>João</td>
                                                <td>01/09/2025 10:00</td>
                                                <td>
                                                    <span class="badge bg-success">Arquivado</span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary" onclick="openModal()"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            <!--Chama as noticias do banco _ Tem que configurar-->
                                            <!--<?php foreach ($noticias as $noticia): ?>-->
                                            <tr>
                                                <td><?php echo htmlspecialchars($noticia['id']); ?></td>
                                                <td><?php echo htmlspecialchars($noticia['titulo']); ?></td>
                                                <td>
                                                    <span class="badge badge-primary"><?php echo htmlspecialchars($noticia['categoria']); ?></span>
                                                </td>
                                                <td><?php echo htmlspecialchars($noticia['autor_nome'] ?? 'Sistema'); ?></td>
                                                <td><?php echo date('d/m/Y H:i', strtotime($noticia['data_criacao'])); ?></td>
                                                <td>
                                                    <span class="table-status <?php echo $noticia['status'] === 'ativo' ? 'active' : 'inactive'; ?>">
                                                        <?php echo ucfirst($noticia['status']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="table-actions">
                                                        <button class="btn btn-sm btn-ghost" onclick="viewNews(<?php echo $noticia['id']; ?>)">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-ghost" onclick="editNews(<?php echo $noticia['id']; ?>)">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-ghost" onclick="deleteNews(<?php echo $noticia['id']; ?>)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--<?php endforeach; ?>-->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Eventos -->
                    <div id="2new-menu" style="display:none"> 
                       <!-- Actions -->
                        <div class="card text-center" >
                                
                            <!--Abas do Menu Noticias-->
                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-4">
                                    
                                    <li class="nav-item">
                                        <h3><a id="5submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(5)">Nova</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="6submenu" class="nav-link" href="#" onclick="trocarSubMenu(6)">Publicadas</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="7submenu" class="nav-link" href="#" onclick="trocarSubMenu(7)">Arquivados</a></h3>
                                    </li>
                                </ul>
                            </div>
                            <!-- Modal Adicionar Notícia -->
                            <div id="5new-submenu" class="NN1" style="display:block;">

                                <div class="card">
                                    <!-- <div class="card-header">
                                        <h3 class="card-title">Nova Notícia</h3>
                                        <button class="modal-close" onclick="closeModal('2new-menu')">×</button>
                                    </div> -->
                                    <div class="card-body">
                                        <!--topo da noticia-->
                                        <form method="POST" action="?action=add">
                                            <div class="form-group">

                                                <div class="form-row">
                                                    <div style="flex: 2;">
                                                        <label class="form-label" >Titulo</label>
                                                        <input type="text" name="titulo" class="form-input" placeholder="Nome do evento" required>
                                                    </div>
                                                    <div style="flex: 2;">
                                                        <label class="form-label" >Banner</label>
                                                        <input type="file" name="titulo" class="form-input" placeholder="Seu Banner">
                                                    </div>
                                                </div>

                                                 <!--area do texto-->
                                                <div class="form-row">
                                                    <div style="flex: 1;">
                                                    <label class="form-label">Descrição</label>
                                                    <textarea name="textocaixa" class="form-input" placeholder="" required rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Data inicio</label>
                                                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-input" required>
                                                    </div>
                                                     <div style="flex: 1;">
                                                        <label class="form-label">Data Fim</label>
                                                        <input type="date" name="date" value="" class="form-input" required>
                                                    </div>
             
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Horario de inicio</label>
                                                        <input type="time" name="hora" value="<?php echo date('H:i'); ?>" class="form-input" required>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Horario Final</label>
                                                        <input type="time" name="hora" value="" class="form-input" required>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Status</label>
                                                        <select name="status" class="form-input">
                                                        <option value="ativo">Ativo</option>
                                                        <option value="rascunho">Rascunho</option>
                                                        <option value="arquivado">Arquivado</option>
                                                        </select>
                                                    </div>
                                                    <div style="flex: 1;"></div>
                                                    <div style="flex: 1;">
                                                        <button type="submit" class="btn btn-primary" style="color:#00B1EB">Criar Notícia </button>
                                                        <button type="button" class="btn btn-primary" onclick="closeModal('2new-menu')"  style="color:#00B1EB;">Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>


                                </div>
                            </div>
                           
                            <!--Publicadas-->
                            <div id="6new-submenu" class="NN2" style="display:none">
                                    <div class="card table-container">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Título</th>
                                                    <th>Banner</th>
                                                    <th>Data de Inicio</th>
                                                    <th>Data de Termino</th>
                                                    <th>Horario de Inicio</th>
                                                    <th>Horario de Termino</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!--mocelos/exemplo de noticia-->
                                                   <tr>
                                                    <td>1</td>
                                                    <td>Evento Z</td>

                                                    <td><img src="https://placehold.co/120x80/EEE/31343C" width= 70%; alt="Placehold" class="header-image"></td>
                                                    
                                                    <td>18/02/2099</td>
                                                    <td>23/02/2099</td>
                                                    <td>07:00</td>
                                                    <td>12:00</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Evento Y</td>

                                                    <td><img src="https://placehold.co/120x80/EEE/31343C" width= 70%; alt="Placehold" class="header-image"></td>
                                                    
                                                    <td>01/04/2099</td>
                                                    <td>02/04/2099</td>
                                                    <td>07:00</td>
                                                    <td>12:00</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <!--Chama as noticias do banco _ Tem que configurar-->
                                                <!--<?php foreach ($noticias as $noticia): ?>-->
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($noticia['id']); ?></td>
                                                        <td><?php echo htmlspecialchars($noticia['titulo']); ?></td>
                                                        <td>
                                                            <span class="badge bg-primary"><?php echo htmlspecialchars($noticia['categoria']); ?></span>
                                                        </td>
                                                        <td><?php echo htmlspecialchars($noticia['autor_nome'] ?? 'Sistema'); ?></td>
                                                        <td><?php echo date('d/m/Y H:i', strtotime($noticia['data_criacao'])); ?></td>
                                                        <td>
                                                            <span class="table-status <?php echo $noticia['status'] === 'ativo' ? 'active' : 'inactive'; ?>">
                                                                <?php echo ucfirst($noticia['status']); ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="table-actions">
                                                                <button class="btn btn-sm btn-outline-primary" title="Visualizar" onclick="viewNews(<?php echo $noticia['id']; ?>)">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-warning" title="Editar" onclick="editNews(<?php echo $noticia['id']; ?>)">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="deleteNews(<?php echo $noticia['id']; ?>)">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <!--<?php endforeach; ?>-->
                                            </tbody>
                                        </table>
                                    </div>
                            </div>

                            <!--Menu de edição e noticias não publicadas-->
                            <div id="7new-submenu" class="NN3" style="display:none">
                                <div class="card table-container">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Título</th>
                                                    <th>Banner</th>
                                                    <th>Data de Inicio</th>
                                                    <th>Data de Termino</th>
                                                    <th>Horario de Inicio</th>
                                                    <th>Horario de Termino</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!--Um mocelo/exemplo de noticia-->
                                                <tr>
                                                    <td>7</td>
                                                    <td>Evento A</td>

                                                    <td><img src="https://placehold.co/120x80/EEE/31343C" width= 70%; alt="Placehold" class="header-image"></td>
                                                    
                                                    <td>10/02/2099</td>
                                                    <td>15/02/2099</td>
                                                    <td>07:00</td>
                                                    <td>12:00</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" title="Publicar"><i class="fa-solid fa-share"></i></button>
                                                        <button class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <!--Chama as noticias do banco _ Tem que configurar-->
                                                <!--<?php foreach ($noticias as $noticia): ?>-->
                                                <tr>
                                                    <td><?php echo htmlspecialchars($noticia['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($noticia['titulo']); ?></td>
                                                    <td>
                                                        <span class="badge badge-primary"><?php echo htmlspecialchars($noticia['categoria']); ?></span>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($noticia['autor_nome'] ?? 'Sistema'); ?></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($noticia['data_criacao'])); ?></td>
                                                    <td>
                                                        <span class="table-status <?php echo $noticia['status'] === 'ativo' ? 'active' : 'inactive'; ?>">
                                                            <?php echo ucfirst($noticia['status']); ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="table-actions">
                                                            <button class="btn btn-sm btn-ghost" onclick="viewNews(<?php echo $noticia['id']; ?>)">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-ghost" onclick="editNews(<?php echo $noticia['id']; ?>)">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-ghost" onclick="deleteNews(<?php echo $noticia['id']; ?>)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!--<?php endforeach; ?>-->

                                            </tbody>
                                        </table>
                                    </div>
                            </div>

                        </div>
                    
                    </div>

                     <!-- Editoria -->
                    <div id="3new-menu" style="display:none"> 
                        <div class="card text-center" > 
                            <!--Abas do Menu Noticias-->
                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-4">
                                    <li class="nav-item">
                                        <h3><a id="8submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(8)">Nova</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="9submenu" class="nav-link" href="#" onclick="trocarSubMenu(9)">Consultar</a></h3>
                                    </li>
                                </ul>
                            </div>

                            <!-- Modal Adicionar Notícia -->
                            <div id="8new-submenu" style="display:block">
                                <div class="card">
                                    <!-- <div class="card-header">
                                        <h3 class="card-title">Nova Editoria</h3>
                                        <button class="modal-close" onclick="closeModal('2new-menu')">×</button>
                                    </div> -->
                                    <div class="card-body">
                                        <div class="form-group">
                                        <div style="flex: 1;">
                                        <label class="form-label" >Nome</label>
                                        <input type="text" name="titulo" class="form-input" placeholder="Nome dea noticia" required>

                                        <label class="form-label" >Descrição</label>
                                        <input type="text" name="titulo" class="form-input" placeholder="Nome dea noticia" required>
                                    </div>    
                                    </div>
                                        <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                                    </div>
                                </div>
                            </div>

                            <!--Publicadas-->
                            <div id="9new-submenu" style="display:none">
                                    <div class="card table-container">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nome</th>
                                                    <th>Descrição</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!--mocelos/exemplo de noticia-->
                                                <tr>
                                                    <td>1</td>
                                                    <td>Geral</td>
                                                    <td><span class="badge bg-primary">Um texto</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Municipio</td>
                                                    <td><span class="badge bg-primary">Um texto</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Orgão</td>
                                                    <td><span class="badge bg-primary">Um texto</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>

                            
                                            </tbody>
                                        </table>
                                    </div>
                            </div>

                        </div>
                    </div>

                     <!-- Menu Calendario -->
                    <div id="4new-menu" style="display:none"> 
                        <div class="card text-center" >
                                
                            <!--subMenus do calendsario-->
                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-4">
                                    <li class="nav-item">
                                        <h3><a id="10submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(10)">Novo</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="11submenu" class="nav-link" href="#" onclick="trocarSubMenu(11)">Publicados</a></h3>
                                    </li>
                                </ul>
                            </div>
                        
                            <!--Calendario - Nova-->
                            <div id="10new-submenu" style="display:block">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div style="flex: 5;">
                                                    <label class="form-label" >Titulo</label>
                                                    <input type="text" name="titulo" class="form-input" placeholder="titulo" required>

                                                    <label class="form-label" >Complemento</label>
                                                    <input type="text" name="complemnto" class="form-input" placeholder="Infomções adcionais">

                                                    <label class="form-label" >Eventos Relacioandos</label>
                                                    <input type="text" name="eventos_r" class="form-input" placeholder="site.com.br">
                                                </div>
                                                <div style="flex: 1;">
                                                    <label class="form-label">Data</label>
                                                    <input type="date" name="data" value="<?php echo date('Y-m-d'); ?>" class="form-input" required>

                                                    <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                                                </div>                      
                                            </div>
                                        </div>
                                    </div>
                                        
                                </div>
                            </div>

                            <!--Calendarios - Publicados-->
                            <div id="11new-submenu" style="display:None">
                                <div class="card table-container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Titulo</th>
                                            <th>Observação</th>
                                            <th>Data</th>
                                            <th>Eventos Relacionados</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Calendario de Março</td>
                                            <td>Havera variso eventos em Março, Evento A. Evento B...</td>
                                            <td>10/03/20XX</td>
                                            <td>site.evento@eventos.pmf.sc.gov.br</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Calendario de Abril</td>
                                            <td>Havera variso eventos em Abril, Evento A. Evento B...</td>
                                            <td>02/04/20XX</td>
                                            <td>site.evento@eventos.pmf.sc.gov.br</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
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
        </main>
    </div>

    <!--Abrir/Fechar Modal-->
    <script>
        const modal = document.querySelector(".modal");
        const overlay = document.querySelector(".overlay");

        function openModal() {
            modal.classList.remove("hidden");
            overlay.classList.remove("hidden");
        }

        const closeModal = function () {
            modal.classList.add("hidden");
            overlay.classList.add("hidden");
        };

    </script>

    <!--Artiva e desativa menu lateral-->
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

    <!--Troca menu Noticias|eventos|Edital|calendario-->
    <script>
        function trocaMenu(local) {
            const menu = document.getElementById(local + 'menu');
            const newMenu = document.getElementById(local + 'new-menu');

            //limpa todas as seleções e displays
            for (let i = 1; i <= 4; i++) {
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

            if(valor <=4){
                a = 1; b = 4;
            }else
            if(valor <= 7){
                a = 5; b = 7;
            }else
            if(valor <= 9 ){
                a = 8; b = 9;
            }else
            if(valor <= 11){
                a = 10; b = 11;
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

    <!-- JavaScript -->
    <script src="assets/js/modern.js"></script>
    <script>
        function showAddNewsModal() {
            document.getElementById('addNewsModal').classList.add('active');
        }
        
        function closeModal(modalId) {
            //document.getElementById(modalId).classList.remove('active');
            alert("A Edição foi cancelada");
        }
        
        function viewNews(newsId) {
            // Implementar visualização
            alert('Visualizar notícia ' + newsId);
        }
        
        function editNews(newsId) {
            // Implementar edição
            alert('Editar notícia ' + newsId);
        }
        
        function deleteNews(newsId) {
            if (confirm('Tem certeza que deseja excluir esta notícia?')) {
                window.location.href = '?action=delete&id=' + newsId;
            }
        }
        
        // Busca em tempo real
        document.getElementById('searchNews').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
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