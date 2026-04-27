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
     error_log("Erro crítico em guias_serviços.php: " . $e->getMessage());
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
                    <button class="header-toggle" id="headerToggle" style="display: none;">
                        <i class="fas fa-bars"></i></button>  <!--Faz a troca no side bar-->
                    <h1>Guia de Serviços</h1>
                    <p>Consulte, Edite e Inclua</p>
                </div>
                
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
                    <div class="card-body">
                        <div class="form-row">
                            <div style="flex:1">
                            <label class="form-label"><h2>Passos</h2></label>

                            <label class="form-label">Descrição do passo</label>
                            <textarea name="textocaixa" class="form-input" placeholder="" required rows="6"></textarea>

                            <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                            </div>
                        </div>

                        <div class="form-row">
                            <div style="flex:1; text-align: center;">
                                 <!-- adcionar lista de passos -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Content -->
            <div class="dashboard-content">
                <div class="card text-center" >
                    <div class="menu-nav-bootstrap">
                        <ul class="nav nav-tabs  mb-3">
                            <li class="nav-item main-item">
                                <h3><a id="1menu" class="nav-link active" aria-current="page" href="#" onclick="trocaMenu(1)">Serviços</a></h3>
                            </li>
                            <li class="nav-item main-item">
                                <h3><a id="2menu" class="nav-link" href="#" onclick="trocaMenu(2)">Categorias</a></h3>
                            </li>
                            <li class="nav-item main-item">
                                <h3><a id="3menu" class="nav-link" href="#" onclick="trocaMenu(3)">Tema</a></h3>
                            </li>
                        </ul>
                    </div>
                

                    <!--Serviços-->
                    <div id="1new-menu" style="display:block">
                        <div class="card text-center" >
                            <!--Abas do Menu -->
                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-3">
                                    <li class="nav-item">
                                        <h3><a id="1submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(1)">Indexar</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="2submenu" class="nav-link" href="#" onclick="trocarSubMenu(2)">Editar</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="3submenu" class="nav-link" href="#" onclick="trocarSubMenu(3)">Incluir</a></h3>
                                    </li>
                                </ul>
                            </div>

                            <!--indexar-->
                            <div id="1new-submenu" class="ativo">
                                <div class="card">
                                    <div class="card-body">
                                <div class="table-container card-size">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Editor</th>
                                                <th>Data</th>
                                                <th>Hora</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <!--mocelos/exemplo de noticia-->
                                            <tr>
                                                <td>João</td>
                                                <td>14/10/2000</td>
                                                <td>14:30</td>
                                                <td>
                                                    <button class="btn btn-sm"><i class="fa-solid fa-floppy-disk"></i></button>
                                                </td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                </div>
                            </div>

                            <!-- editar -->
                            <div id="2new-submenu" class="inativo">
                                <div class="card">

                                 <div class="card-header">
                                        <div class="form-row">
                                            <label class="form-label" >Busca por nome</label>
                                            <input type="text" name="busca" class="form-input" placeholder="" >
                                        </div>
                                    </div>

                                    <div class="card-body">
                                       <div class="table-container card-size">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Titulo</th>
                                                <th>Categoria</th>
                                                <th>Disponivel On-line</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <!--mocelos/exemplo de noticia-->
                                            <tr>
                                                <td>001</td>
                                                <td>Serviço 1</td>
                                                <td>Serviço Pro Cidadão</td>
                                                <td>SIM</td>
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
                            </div>
                            <!-- Incluir -->
                            <div id="3new-submenu" class="inativo">
                               <div class="card">
                                    <div class="card-body">
                                        <form class="card-size form-group">

                                            <div class="form-row">
                                                <div style="flex: 1;">
                                                    <label class="form-label" >Nome do serviço</label>
                                                    <input type="text" name="titulo" class="form-input" placeholder="Nome " required>
                                                </div>
                                            </div>

                                           
                                            <div class="form-row">
                                                <div style="flex: 1;">
                                                    <label class="form-label">Solicitante</label>
                                                    <select class="form-input">
                                                        <option>opção 1</option>
                                                    </select>
                                                </div>

                                                <div style="flex: 1;">
                                                    <label class="form-label">Categoria - Cidadão</label>
                                                    <select class="form-input">
                                                        <option>opção 1</option>
                                                    </select>
                                                </div>

                                                <div style="flex: 1;">
                                                    <label class="form-label">Categoria - Empresa</label>
                                                    <select class="form-input">
                                                        <option>opção 1</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="linha"></div>

                                            <div class="form-row">
                                                <div style="flex: 1;">
                                                    <label class="form-label" >Passos</label>
                                                    <button type="" class="btn btn-primary" style="color:#00B1EB" onclick="openModal()">Criar Passo</button>

                                                </div>
                                                <div style="flex: 1;">
                                                     <label class="form-label" >Requisitos</label>
                                                    <button type="" class="btn btn-primary" style="color:#00B1EB" onclick="openModal()">Criar Requisito</button>

                                                </div>
                                                <div style="flex: 1;">
                                                     <label class="form-label" >Documentos</label>
                                                    <button type="" class="btn btn-primary" style="color:#00B1EB" onclick="openModal()">Incluir Documento</button>

                                                </div>
                                            </div>

                                            <div class="linha"></div>
                                             <div class="form-row">
                                                <div style="flex: 1;">
                                                    <label class="radio-label">Serviço Disponivel Online?</label>
                                                    <label class="radio-label" for="LS">Sim</label><input type="radio" id="LS" name="liberar" >
                                                    <label class="radio-label" for="LN">Não</label><input type="radio" id="LN" name="liberar" >
                                                </div>
                                                <div style="flex: 1;">
                                                    <label class="radio-label">Abrir Online em Nova pagina?</label>
                                                    <label class="radio-label" for="LS">Sim</label><input type="radio" id="LS" name="liberar2" >
                                                    <label class="radio-label" for="LN">Não</label><input type="radio" id="LN" name="liberar2" >
                                                </div>
                                                <div style="flex: 1;">
                                                    <label class="radio-label">Divulgar Serviço no portal?</label>
                                                    <label class="radio-label" for="LS">Sim</label><input type="radio" id="LS" name="liberar3" >
                                                    <label class="radio-label" for="LN">Não</label><input type="radio" id="LN" name="liberar3" >
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div style="flex: 3;">
                                                    <label class="form-label" >Descrição</label>
                                                    <textarea name="textocaixa" class="form-input" placeholder="" required rows="6"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div style="flex: 4;">
                                                    <label class="form-label">Endereço do serviço:</label>
                                                    <input type="text" name="titulo" class="form-input" placeholder="http:www..." required>
                                                </div>
                                                <div style="flex: 2;">
                                                    <label class="form-label">Tag's</label>
                                                    <input type="text" name="titulo" class="form-input" placeholder="" required>
                                                </div>
                                            </div>

                                            <div class="linha"></div>

                                             <div class="form-row">
                                                <div style="flex: 1;">
                                                    <label class="form-label">Temas</label>
                                                </div>
                                            </div>
                                           <div class="form-row">
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label"> Assistência Social</label></div>
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label"> Educação</label></div>
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label"> Empresas</label></div>
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label"> Eventos</label></div>
                                            </div>
                                            <div class="form-row">
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label"> IPTU</label></div>
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label"> Licenciamentos e Alvarás</label></div>
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label"> MEI</label></div>
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label"> Melhorias urbanas</label></div>
                                            </div>
                                            <div class="form-row">
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label">NFe</label></div>
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label">Obras</label></div>
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label">Pró-cidadão</label></div>
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label">Servidor municipal</label></div>
                                            </div>
                                            <div class="form-row">
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label">Pró-cidadão</label></div>
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label">Servidor municipal</label></div>
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label">Temporada</label></div>
                                                <div style="flex: 1;"><input type="checkbox" name="temas[]"><label for="temas[]" class="radio-label">Temporada</label></div>
                                            </div>
                                            <div class="form-row">
                                                <div style="flex: 1;">
                                                    <label class="form-label">Exibir</label>
                                                </div>
                                            </div>
                                             <div class="form-row">
                                                <div style="flex: 1;">
                                                    <input name="exibir"type="checkbox" id="L1">
                                                    <label for="exibir" class="radio-label">Consultar Processo</label>
                                                </div>
                                                 <div style="flex: 1;">
                                                    <input name="exibir" type="checkbox" id="L2" >
                                                     <label for="exibir" class="radio-label">Verificações de documentos Eletronicos</label>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="card-footer">
                                        <div class="form-row">
                                            <div style="flex: center;">
                                                <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Categrias -->
                    <div id="2new-menu" style="display:none"> 
                       <!-- Actions -->
                        <div class="card text-center" >
                                
                            <!--Abas do Menu-->
                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-4">
                                    
                                    <li class="nav-item">
                                        <h3><a id="4submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(4)">Consultar</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="5submenu" class="nav-link" href="#" onclick="trocarSubMenu(5)">Editar</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="6submenu" class="nav-link" href="#" onclick="trocarSubMenu(6)">Incluir</a></h3>
                                    </li>
                                </ul>
                            </div>
                          
                            <!--Consultas-->
                            <div id="4new-submenu" class="ativo">
                                <div class="card table-container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>.</th>
                                                <th>Nome</th>
                                                <th>Titulo Banner</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <!--mocelos/exemplo de noticia-->
                                            <tr>
                                                <td><i class="fa-solid fa-arrows-up-down-left-right"></i></td>
                                                <td>Nome</td>
                                                <td>Nome banner</td>
                                                <td>
                                                    <button class="btn btn-sm"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <!-- Editar -->
                            <div id="5new-submenu" class="inativo">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="form-group">

                                            <div class="form-row">
                                                <div style="flex:1 ;">
                                                    <label class="form-label" >Nome</label>
                                                    <input type="text"class="form-input" value="Titulo da noticia" required>
                                                </div>
                                                <div style="flex: 2;">
                                                    <label class="form-label" >Titulo do Banner</label>
                                                    <input type="text" class="form-input" value="Nome do Banner" required>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div style="flex: 1;">
                                                    <label class="form-label" >Banner</label>
                                                    <img src="https://placehold.co/300x150/EEE/31343C" width="300" height="150" alt="Placehold" class="header-image">
                                                </div>
                                                <div style="flex: 2;">
                                                    <label class="form-label" >Descrição</label>
                                                    <textarea type="text" rows="5" class="form-input" required>O banner aparece na frente da pagina para ...</textarea>
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
                            <!-- Incluir -->
                            <div id="6new-submenu" class="inativo">
                                 <div class="card">
                                    <div class="card-body">
                                        <form class="form-group">
                                            <div class="form-row">
                                                <div style="flex:1 ;">
                                                    <label class="form-label" >Nome</label>
                                                    <input type="text"class="form-input" placeholder="Nome " required>
                                                </div>
                                                <div style="flex: 2;">
                                                    <label class="form-label" >Titulo do Banner</label>
                                                    <input type="text" class="form-input" placeholder="Nome " required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div style="flex: 1;">
                                                    <label class="form-label" >Banner</label>
                                                    <input type="file" id="input-file" hidden>
                                                    <label for="input-file" class="btn custom-file">Upload</label>
                                                </div>
                                                <div style="flex: 2;">
                                                    <label class="form-label" >Descrição</label>
                                                    <textarea type="text" rows="3" class="form-input" placeholder="Nome " required></textarea>
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

                    <!--Tema-->
                    <div id="3new-menu" style="display:none"> 
                        <div class="card text-center" > 

                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-4">
                                    <li class="nav-item">
                                        <h3><a id="7submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(7)">Consultar</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="8submenu" class="nav-link" href="#" onclick="trocarSubMenu(8)">Editar</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="9submenu" class="nav-link" href="#" onclick="trocarSubMenu(9)">Incluir</a></h3>
                                    </li>
                                </ul>
                            </div>

                            <!--Consultas -->
                            <div id="7new-submenu" class="ativo">
                                <div class="card table-container">
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Tema Nome</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <!--mocelos/exemplo de noticia-->
                                                <tr>
                                                    <td><i class="fa-solid fa-arrows-up-down-left-right"></i></td>
                                                    <td>Nome</td>
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
                            <!--Editar-->
                            <div id="8new-submenu" class="inativo">
                                  <div class="card">
                                    <div class="card-body">
                                        <form class="form-group">
                                            <div class="form-row">
                                                <div style="flex:2 ;">
                                                    <label class="form-label" >Nome</label>
                                                    <input type="text"class="form-input" value= "Tema nome" required>
                                                </div>
                                                <div style="flex: 1;">
                                                    <button type="submit" class="btn btn-primary" style="color:#00B1EB">Salvar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Incluir -->
                            <div id="9new-submenu" class="inativo">
                                  <div class="card">
                                    <div class="card-body">
                                        <form class="form-group">
                                            <div class="form-row">
                                                <div style="flex:2 ;">
                                                    <label class="form-label" >Nome</label>
                                                    <input type="text"class="form-input" placeholder="Nome " required>
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

                </div>
            </div>
        </main>
    </div>

    <!--script com varios codigos uteis-->
    <script src ="scripts/scripts_geral.js"></script>
    <script src="assets/js/modern.js"></script>

    <!--troca menu e submenu das abas - tem que ajustar-->
    <script>
        function trocaMenu(local) {
            const menu = document.getElementById(local + 'menu');
            const newMenu = document.getElementById(local + 'new-menu');

            //limpa todas as seleções e displays
            for (let i = 1; i <=3; i++) {
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

            if(valor <=3){
                a = 1; b = 3;
            }else
            if(valor <= 6){
                a = 4; b = 6;
            }else
            if(valor <= 9 ){
                a = 7; b = 9;
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