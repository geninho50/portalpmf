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
    <title>Intranet PMF</title>
    
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
                    <h1>Estrutura da Prefeitura</h1>
                    <p>Administre os locais, setores, cargos e colaboradores</p>
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

                <!-- Actions -->
                <div class="card text-center" >
                          
                    <!--Abas do Menu -->
                    <div class="menu-nav-bootstrap">
                        <ul class="nav nav-tabs  mb-4">

                            <li class="nav-item main-item">
                                <h3><a id="1menu" class="nav-link active" aria-current="page" href="#" onclick="trocaMenu(1)">Locais</a></h3>
                            </li>
                            <li class="nav-item main-item">
                                <h3><a id="2menu" class="nav-link" href="#" onclick="trocaMenu(2)">Setores</a></h3>
                            </li>
                            <li class="nav-item main-item">
                                <h3><a id="3menu" class="nav-link" href="#" onclick="trocaMenu(3)">Cargos</a></h3>
                            </li>
                            <li class="nav-item main-item">
                                <h3><a id="4menu" class="nav-link" href="#" onclick="trocaMenu(4)">Colaboradores</a></h3>
                            </li>
                        </ul>
                    </div>

                    <!--Locais-->
                    <div id="1new-menu" style="display:block">
                        <div class="card text-center" >
                            <!--Abas do Menu Noticias-->
                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-4">
                                    <li class="nav-item">
                                        <h3><a id="1submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(1)">Consultar</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="2submenu" class="nav-link" href="#" onclick="trocarSubMenu(2)">Incluir</a></h3>
                                    </li>
                                </ul>
                            </div>

                            <!--Consultas-->
                            <div id="1new-submenu" class="ativo">
                                <div class="card table-container">
                                    <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Endereço</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <!--mocelos/exemplo de noticia-->
                                            <tr>
                                                <td>Titulo</td>
                                                <td>Endereço da local | numero</td>
                                                <td>
                                                    <button class="btn btn-sm"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                    </div>

                                </div>
                            </div>
                            <!-- Incluir Local -->
                            <div id="2new-submenu" class="inativo">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="form-group">

                                            <div class="form-row">
                                                <div style="flex: 1;">
                                                    <label class="form-label" >Nome</label>
                                                    <input type="text" name="nome" class="form-input" placeholder="Nome " required>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div style="flex: 2;">
                                                    <label class="form-label" >Logradouro</label>
                                                    <input type="text" name="logradouro" class="form-input" placeholder="" >
                                                </div>
                                                <div style="flex: 1;">
                                                    <label class="form-label" >Numero</label>
                                                    <input type="text" name="numero" class="form-input" placeholder="" >
                                                </div>
                                                <div style="flex: 1;">
                                                    <label class="form-label" >Complemento</label>
                                                    <input type="text" name="complemento" class="form-input" placeholder="" >
                                                </div>
                                                <div style="flex: 1;">
                                                    <label class="form-label" >Bairro</label>
                                                    <input type="text" name="bairro" class="form-input" placeholder="" >
                                                </div>
                                                <div style="flex: 1;">
                                                    <label class="form-label" >CEP</label>
                                                    <input type="text" name="cep" class="form-input" placeholder="" required>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div style="flex: 1;">
                                                    <label class="form-label">Horario - Matutino</label>
                                                    <label for="horario_um" >Inicio</label><input type="time" id="horario_um" value="<?php echo date('H:i'); ?>" class="form-input" required>
                                                    <label for="horario_um" >Fim</label><input type="time" id="horario_dois" value="" class="form-input" required>
                                                </div>

                                                <div style="flex: 1;">
                                                    <label class="form-label">Horario - Noturno</label>
                                                    <label for="horario_um" >Inicio</label><input type="time" id="horario_um" value="<?php echo date('H:i'); ?>" class="form-input" required> 
                                                    <label for="horario_um" >Fim</label><input type="time" id="horario_dois" value="" class="form-input" required> 
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div style="flex: 1;">
                                                    <label class="form-label" >E-mail</label>
                                                    <input type="text" name="titulo" class="form-input" placeholder="Nome dea noticia" required>
                                                </div>
                                                <div style="flex: 1;">
                                                    <label class="form-label" >Fone</label>
                                                    <input type="text" name="titulo" class="form-input" placeholder="Nome dea noticia" required>
                                                </div>
                                                <div style="flex: 1;">
                                                    <label class="form-label" >Fax | Celular</label>
                                                    <input type="text" name="titulo" class="form-input" placeholder="Nome dea noticia" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div style="flex: 1;">
                                                    <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Setores -->
                    <div id="2new-menu" style="display:none"> 
                       <!-- Actions -->
                        <div class="card text-center" >
                                
                            <!--Abas do Menu Noticias-->
                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-4">
                                    
                                    <li class="nav-item">
                                        <h3><a id="3submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(3)">Consulta</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="4submenu" class="nav-link" href="#" onclick="trocarSubMenu(4)">Incluir</a></h3>
                                    </li>
                                </ul>
                            </div>
                          
                              <!--Consultas-->
                            <div id="3new-submenu" style="display:block;">
                                <div class="card table-container">
                                    <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>.</th>
                                                <th>Nome</th>
                                                <th>Cargo</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <!--mocelos/exemplo de noticia-->
                                            <tr>
                                                <td><i class="fa-solid fa-arrows-up-down-left-right"></i></td>
                                                <td>Nome</td>
                                                <td>Cargo</td>
                                                <td>
                                                    <button class="btn btn-sm"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                    </div>

                                </div>
                            </div>
                            <!-- Incluir Setor -->
                            <div id="4new-submenu" style="display:none;">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="form-group">

                                            <div class="form-row">
                                                <div style="flex: 5;">
                                                    <label class="form-label" >Nome</label>
                                                    <input type="text" name="titulo" class="form-input" placeholder="Nome " required>
                                                </div>
                                                <div style="flex: 1;">
                                                    <label class="form-label" >Sigla</label>
                                                    <input type="text" name="titulo" class="form-input" placeholder="ABC" required>
                                                </div>

                                                <div style="flex: 3;">
                                                    <label class="form-label" >Local</label>
                                                    <select type="text"  class="form-input">
                                                        <option> </option>    
                                                        <option>Local 1</option>
                                                        <option>Local 2</option>
                                                        <option>Local 3</option>         
                                                    <select>
                                                </div>

                                                <div style="flex: 1;">
                                                    <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                     <!-- Cargos -->
                    <div id="3new-menu" style="display:none"> 
                        <div class="card text-center" > 

                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-4">
                                    <li class="nav-item">
                                        <h3><a id="5submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(5)">Consultar</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="6submenu" class="nav-link" href="#" onclick="trocarSubMenu(6)">Incluir</a></h3>
                                    </li>
                                </ul>
                            </div>

                            <!--Consultas Cargos-->
                            <div id="5new-submenu" style="display:block;">
                                <div class="card table-container">
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>.</th>
                                                    <th>Nome</th>
                                                    <th>Cargo</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!--mocelos/exemplo de noticia-->
                                                <tr>
                                                    <td><i class="fa-solid fa-arrows-up-down-left-right"></i></td>
                                                    <td>Nome</td>
                                                    <td>Cargo</td>
                                                    <td>
                                                        <button class="btn btn-sm"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- Cargo Incluir-->
                            <div id="6new-submenu" style="display:none;">
                                  <div class="card">
                                    <div class="card-body">
                                        <form class="form-group">

                                            <div class="form-row">
                                                <div style="flex: 4;">
                                                    <label class="form-label" >Nome</label>
                                                    <input type="text" name="titulo" class="form-input" placeholder="Nome " required>
                                                </div>
                                                <div style="flex: 1;">
                                                    <label class="form-label" >Cargo e Unico?</label>
                                                    <input type="radio" id="CarogSim" name="Cargo" class="radio-label" required><label for="CarogSim" class="radio-label">Sim</label>
                                                    <input type="radio" id="CarogNao" name="Cargo" class="radio-label" required><label for="CaroNao" class="radio-label">Não</label>
                                                </div>

                                                <div style="flex: 1;">
                                                    <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Colaboradores -->
                    <div id="4new-menu" style="display:none"> 
                        <div class="card text-center" >
                                
                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-4">
                                    <li class="nav-item">
                                        <h3><a id="7submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(7)">Consultar</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="8submenu" class="nav-link" href="#" onclick="trocarSubMenu(8)">Incluir</a></h3>
                                    </li>
                                </ul>
                            </div>
                        
                            <!--Consultar Colaboradores-->
                            <div id="7new-submenu" style="display:block">
                                <div class="card table-container">
                                    <div class="card-header">
                                        <div class="form-row">
                                            <label class="form-label" >Busca por nome</label>
                                            <input type="text" name="busca" class="form-input" placeholder="" >
                                        </div>
                                    </div>

                              
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>.</th>
                                                    <th>Nome</th>
                                                    <th>Cargo</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!--mocelos/exemplo de noticia-->
                                                <tr>
                                                    <td><i class="fa-solid fa-arrows-up-down-left-right"></i></td>
                                                    <td>Nome</td>
                                                    <td>Cargo</td>
                                                    <td>
                                                        <button class="btn btn-sm"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <!--Consultar Incluir -->
                            <div id="8new-submenu" style="display:None">
                                 <div class="card">
                                    <div class="card-body">
                                        <form class="form-group">
                                            <div class="form-row">
                                                <div style="flex: 2;">
                                                    <label class="form-label">Nome</label>
                                                    <input type="text"  class="form-input" placeholder="Nome" required>
        
                                                    <label class="form-label" >E-mail</label>
                                                    <input type="text" class="form-input" placeholder="pmf.sc.gov" required>

                                                    <label class="form-label" >Telfone</label>
                                                    <input type="text"  class="form-input" placeholder="(00)0000-000" required>
                                                </div>


                                                <div style="flex: 1;">
                                                    <label class="form-label">Setor</label>
                                                    <select type="select" class="form-input" placeholder="Setor">
                                                        <option>Setor 1</option>
                                                        <option value ="setor2">Setor 2</option>
                                                    </select>
 
                                                    <label class="form-label">Cargo</label>
                                                    <select type="select" class="form-input" placeholder="Cargo">
                                                        <option value ="cargo1">Cargo 1</option>
                                                        <option value ="cargo2">Cargo 2</option>
                                                    </select>

                                                    <div class="form-row">
                                                        <div style="flex: 2;">
                                                            <label class="form-label">Gabinete</label>
                                                            <label for="gabe_um" class="radio-label">Sim</label><input type="radio" id="gabe_um" name="radioGabe" class="radio-label" required>
                                                            <label for="gabe_dois" class="radio-label">Não</label><input type="radio" id="gabe_dois" name="radioGabe" class="radio-label" required>
                                                        </div>
                                                        <div style="flex: 2;">
                                                            <label class="form-label">"Quem é quem"</label>
                                                            <label for="Quem_um" class="radio-label">Sim</label><input type="radio" id="Quem_um" name="radioQuem" class="radio-label" required>
                                                            <label for="Quem_dois" class="radio-label">Não</label><input type="radio" id="Quem_dois" name="radioQuem" class="radio-label" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div style="flex: 1;">
                                                    <img  src="https://placehold.co/15x15/EEE/31343C" alt="Placehold" width= 80%; class="foto">
                                                    <label for="input-file" class="btn custom-file">Upload</label>
                                                    <input type="file" id="input-file" hidden>
                                                </div>
                                                <div style="flex: 4;">
                                                    <textarea name="textocaixa" class="form-input" placeholder="" required rows="3"></textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
                    
            </div>
        </main>

    </div>

<!--script com varios codigos uteis-->
    <script src ="scripts/scripts_geral.js"></script>
    <script src="assets/js/modern.js"></script>

    <!--troca submenu das abas - tem que ajustar-->
    <script>
        function trocaMenu(local) {
            const menu = document.getElementById(local + 'menu');
            const newMenu = document.getElementById(local + 'new-menu');

            //limpa todas as seleções e displays
            for (let i = 1; i <=4; i++) {
                document.getElementById(i + 'menu').classList.remove('active');
                document.getElementById(i + 'new-menu').style.display = 'none';
            }
            //ativa quem for selecionado
            menu.classList.add('active');
            newMenu.style.display = 'block';
        }


        //fazer ajuster finais aqui - 09/09
        function trocarSubMenu(valor){
            const subMenu = document.getElementById(valor + 'submenu');
            const newSubMenu = document.getElementById(valor + 'new-submenu');
    
            let a, b;
            //depedendo da pagina, esse if muda o loop para remover valores nas areas corretas.

            if(valor <=2){
                a = 1; b = 2;
            }else
            if(valor <= 4){
                a = 3; b = 4;
            }else
            if(valor <= 6 ){
                a = 5; b = 6;
            }else
            if(valor <= 8){
                a = 7; b = 8;
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